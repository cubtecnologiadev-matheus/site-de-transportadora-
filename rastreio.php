<?php
include 'includes/functions.php';

$resultado = null;
$erro = null;
$debug_info = null;

if ($_POST) {
    $codigo = trim($_POST['codigo']);
    if (!empty($codigo)) {
        $envios = listarEnvios();
        $debug_info = [
            'codigo_pesquisado' => $codigo,
            'total_envios' => count($envios),
            'envios_encontrados' => []
        ];
        
        foreach ($envios as $envio) {
            $debug_info['envios_encontrados'][] = [
                'remessa' => $envio['remessa'],
                'cpf' => $envio['cpf_destinatario'],
                'destinatario' => $envio['destinatario']
            ];
        }
        
        $resultado = buscarEncomenda($codigo);
        if (!$resultado) {
            $erro = "Encomenda não encontrada. Verifique o código informado.";
        }
    } else {
        $erro = "Por favor, informe o CPF ou número da remessa.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastreamento - ExpressLog</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/tracking-timeline.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <section class="rastreio-container" style="margin-top: 120px; padding: 2rem 0;">
        <div class="container">
            <h1 class="section-title" style="margin-bottom: 2rem;">Rastreamento de Encomendas</h1>
            
            <div class="rastreio-form" style="background: white; padding: 2rem; border-radius: var(--radius); box-shadow: var(--shadow); margin-bottom: 2rem;">
                <form method="POST" style="display: flex; gap: 1rem; align-items: end; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-color);">Digite o CPF ou número da remessa:</label>
                        <input type="text" name="codigo" class="form-input" placeholder="Ex: 123.456.789-01 ou EXP123456789BR" value="<?= isset($_POST['codigo']) ? htmlspecialchars($_POST['codigo']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Rastrear</button>
                </form>
            </div>

            <?php if ($debug_info && $_GET['debug'] == '1'): ?>
                <div class="alert" style="background: #f0f0f0; border: 1px solid #ccc; margin: 1rem 0;">
                    <h4>Debug Information:</h4>
                    <p><strong>Código pesquisado:</strong> <?= htmlspecialchars($debug_info['codigo_pesquisado']) ?></p>
                    <p><strong>Total de envios no sistema:</strong> <?= $debug_info['total_envios'] ?></p>
                    <?php if (!empty($debug_info['envios_encontrados'])): ?>
                        <p><strong>Envios cadastrados:</strong></p>
                        <ul>
                            <?php foreach ($debug_info['envios_encontrados'] as $envio): ?>
                                <li><?= htmlspecialchars($envio['remessa']) ?> - <?= htmlspecialchars($envio['destinatario']) ?> (CPF: <?= htmlspecialchars($envio['cpf']) ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p><em>Nenhum envio encontrado no sistema.</em></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($erro): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($erro) ?>
                    <?php if (!$debug_info || $debug_info['total_envios'] == 0): ?>
                        <br><small>Adicione ?debug=1 na URL para ver informações de debug.</small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($resultado): ?>
                <?php
                $envios = listarEnvios();
                $envio_completo = null;
                foreach ($envios as $envio) {
                    if ($envio['remessa'] === $resultado['remessa']) {
                        $envio_completo = $envio;
                        break;
                    }
                }
                
                $pagamento_pendente = isset($envio_completo['pagamento_pendente']) && $envio_completo['pagamento_pendente'];
                $valor_taxa = $envio_completo['valor_taxa'] ?? '200,00';
                ?>
                
                <!-- New Correios-style tracking display -->
                <div class="correios-tracking-container">
                    <!-- Tracking Code Header -->
                    <div class="tracking-code-header">
                        <h2>Código de Rastreio: <?= htmlspecialchars($resultado['remessa']) ?></h2>
                    </div>

                    <!-- Status Badge -->
                    <div class="tracking-status-badge">
                        <div class="status-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <?php if ($pagamento_pendente): ?>
                                <!-- Show payment pending status when configured by admin -->
                                <h3 class="status-title">Aguardando pagamento</h3>
                                <p class="status-subtitle">Efetue o pagamento até às 23:59 para liberação do seu pedido</p>
                            <?php else: ?>
                                <h3 class="status-title"><?= htmlspecialchars($resultado['status_texto']) ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Payment Warning (shown when admin activates payment pending) -->
                    <?php if ($pagamento_pendente): ?>
                        <div class="payment-warning-box">
                            <div class="warning-icon">⚠️</div>
                            <div class="warning-content">
                                <h4>Último dia para regularizar</h4>
                                <p>Identificamos que seu pedido encontra-se retido nos Correios devido à necessidade de pagamento de uma taxa obrigatória no valor de R$ <?= htmlspecialchars($valor_taxa) ?>.</p>
                                
                                <div class="info-section">
                                    <div class="info-icon">💡</div>
                                    <div>
                                        <strong>Por que essa taxa é necessária?</strong>
                                        <p>Essa taxa é uma exigência dos Correios para a liberação do envio e regularização da entrega do seu produto.</p>
                                    </div>
                                </div>

                                <div class="important-section">
                                    <strong>⚠ Importante:</strong> Enquanto o valor não for quitado, o produto permanecerá retido e não poderá ser entregue.
                                </div>

                                <p style="margin-top: 1rem;">Pedimos a gentileza de realizar o pagamento o quanto antes para que possamos concluir o envio rapidamente.</p>
                                
                                <button class="btn-release-payment" onclick="alert('Entre em contato pelo WhatsApp para receber a chave Pix e regularizar seu envio.')">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="5" y="11" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 15v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    LIBERAR ENVIO DO OBJETO
                                </button>

                                <p class="secure-note">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Todas as transações são seguras e criptografadas.
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Timeline -->
                    <div class="tracking-timeline">
                        <?php foreach ($resultado['historico'] as $index => $evento): ?>
                            <div class="timeline-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="timeline-icon">
                                    <?php if ($evento['descricao'] === 'Objeto postado'): ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7l8 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    <?php elseif (strpos($evento['descricao'], 'transferência') !== false || strpos($evento['descricao'], 'trânsito') !== false): ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php elseif (strpos($evento['descricao'], 'Aguardando') !== false || strpos($evento['descricao'], 'Pendente') !== false || strpos($evento['descricao'], 'pagamento') !== false): ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    <?php elseif (strpos($evento['descricao'], 'Leilão') !== false): ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                            <path d="M12 8v4m0 4h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="timeline-content">
                                    <h4><?= htmlspecialchars($evento['descricao']) ?></h4>
                                    <p class="timeline-location"><?= htmlspecialchars($evento['local']) ?></p>
                                    <p class="timeline-date"><?= htmlspecialchars($evento['data']) ?> às <?= htmlspecialchars($evento['hora']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Additional Info -->
                    <div class="tracking-additional-info">
                        <div class="info-card">
                            <h4>👤 Informações do Destinatário</h4>
                            <p><strong>Nome:</strong> <?= htmlspecialchars($resultado['nome']) ?></p>
                            <p><strong>CPF:</strong> <?= htmlspecialchars($resultado['cpf']) ?></p>
                        </div>
                        <div class="info-card">
                            <h4>📍 Endereço de Entrega</h4>
                            <?php if ($envio_completo): ?>
                                <p><strong>Rua:</strong> <?= htmlspecialchars($envio_completo['rua_destino']) ?></p>
                                <p><strong>Número:</strong> <?= htmlspecialchars($envio_completo['numero_destino']) ?></p>
                                <p><strong>Bairro:</strong> <?= htmlspecialchars($envio_completo['bairro_destino']) ?></p>
                                <p><strong>Cidade:</strong> <?= htmlspecialchars($envio_completo['cidade_destino']) ?></p>
                                <p><strong>Estado:</strong> <?= htmlspecialchars($envio_completo['estado_destino']) ?></p>
                                <p><strong>CEP:</strong> <?= htmlspecialchars($envio_completo['cep_destino']) ?></p>
                            <?php else: ?>
                                <p><strong>Origem:</strong> <?= htmlspecialchars($resultado['origem']) ?></p>
                                <p><strong>Destino:</strong> <?= htmlspecialchars($resultado['destino']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="info-card">
                            <h4>📦 Detalhes do Pacote</h4>
                            <?php if ($envio_completo): ?>
                                <p><strong>Peso:</strong> <?= htmlspecialchars($envio_completo['peso']) ?> kg</p>
                                <!-- Updated to show table-like format without checkmarks -->
                                <div class="package-content-toggle">
                                    <button class="btn-toggle-content" onclick="togglePackageContent(this)">
                                        <span>Conteúdo Declarado</span>
                                        <svg class="toggle-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <div class="package-content-details" style="display: none;">
                                        <?php 
                                        $conteudo = $envio_completo['conteudo_declarado'] ?? $envio_completo['observacoes'] ?? '';
                                        
                                        // Split by newlines first (for properly formatted content)
                                        $items = preg_split('/[\n\r]+/', $conteudo);
                                        $items = array_filter(array_map('trim', $items));
                                        
                                        // If no newlines, try to parse as numbered list
                                        if (count($items) <= 1 && !empty($conteudo)) {
                                            $items = [];
                                            if (preg_match_all('/(\d+)\s+([^0-9]+?)(?=\d+\s+|$)/s', $conteudo, $matches, PREG_SET_ORDER)) {
                                                foreach ($matches as $match) {
                                                    $quantity = trim($match[1]);
                                                    $item = trim($match[2]);
                                                    if (!empty($item)) {
                                                        $items[] = $quantity . ' ' . $item;
                                                    }
                                                }
                                            } else {
                                                // Fallback: just show the content as-is
                                                $items = [$conteudo];
                                            }
                                        }
                                        
                                        if (!empty($items) && count($items) > 1): 
                                            $item_count = count($items);
                                        ?>
                                            <div class="content-header">
                                                <span class="content-count"><?= $item_count ?> <?= $item_count === 1 ? 'item' : 'itens' ?></span>
                                            </div>
                                            <div class="content-table">
                                                <?php foreach ($items as $item): ?>
                                                    <?php if (!empty($item)): ?>
                                                        <div class="content-row">
                                                            <?= htmlspecialchars($item) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <p class="content-simple"><?= htmlspecialchars($conteudo) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div style="margin-top: 4rem; text-align: center; background: var(--muted); padding: 3rem; border-radius: var(--radius);">
                <h2>Precisa de Ajuda?</h2>
                <p>Nossa equipe de atendimento está pronta para ajudar você.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 1.5rem; flex-wrap: wrap;">
                    <a href="contato.php" class="btn btn-primary">Entre em Contato</a>
                    <a href="index.php" class="btn" style="background: var(--muted-foreground); color: white;">Voltar ao Início</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    
    <!-- Added JavaScript for package content toggle -->
    <script>
        function togglePackageContent(button) {
            const contentDiv = button.nextElementSibling;
            const icon = button.querySelector('.toggle-icon');
            
            if (contentDiv.style.display === 'none') {
                contentDiv.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            } else {
                contentDiv.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>
</html>
