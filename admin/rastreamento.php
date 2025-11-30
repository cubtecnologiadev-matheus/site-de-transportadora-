<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit;
}

include '../includes/functions.php';

// Processar atualizações de status
if ($_POST && isset($_POST['acao'])) {
    if ($_POST['acao'] === 'atualizar_status') {
        $remessa = $_POST['remessa'];
        $status = $_POST['status'];
        $descricao = $_POST['descricao'];
        $local = $_POST['local'];
        
        if (atualizarStatusEnvio($remessa, $status, $descricao, $local)) {
            $mensagem = "Status atualizado com sucesso!";
        } else {
            $erro = "Erro ao atualizar status!";
        }
    } elseif ($_POST['acao'] === 'configurar_pagamento') {
        $remessa = $_POST['remessa'];
        $ativo = isset($_POST['pagamento_ativo']) ? true : false;
        $valorTaxa = $_POST['valor_taxa'] ?? '200,00';
        
        if (configurarPagamentoPendente($remessa, $ativo, $valorTaxa)) {
            $mensagem = "Configuração de pagamento atualizada com sucesso!";
        } else {
            $erro = "Erro ao configurar pagamento!";
        }
    } elseif ($_POST['acao'] === 'adicionar_evento') {
        $remessa = $_POST['remessa'];
        $descricao = $_POST['descricao_evento'];
        $local = $_POST['local_evento'];
        
        if (adicionarEventoRastreio($remessa, $descricao, $local)) {
            $mensagem = "Evento adicionado com sucesso!";
        } else {
            $erro = "Erro ao adicionar evento!";
        }
    }
}

// Buscar envio específico se fornecido
$envio_selecionado = null;
if (isset($_GET['remessa'])) {
    $envios = listarEnvios();
    foreach ($envios as $envio) {
        if ($envio['remessa'] === $_GET['remessa']) {
            $envio_selecionado = $envio;
            break;
        }
    }
}

$envios = listarEnvios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastreamento Administrativo - ExpressLog Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .config-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #0066cc;
        }
        .config-section h4 {
            margin-top: 0;
            color: #0066cc;
        }
        .switch-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1rem 0;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #0066cc;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .success-box {
            background: #d4edda;
            border: 1px solid #28a745;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-content">
        <div class="container">
            <h1>Rastreamento Administrativo</h1>
            
            <?php if (isset($mensagem)): ?>
                <div class="success-box"><?= $mensagem ?></div>
            <?php endif; ?>
            
            <?php if (isset($erro)): ?>
                <div class="alert alert-error"><?= $erro ?></div>
            <?php endif; ?>
            
            <!-- Buscar Envio -->
            <div class="service-card" style="margin-bottom: 2rem;">
                <h3>Buscar Envio para Rastreamento</h3>
                <form method="GET" style="display: flex; gap: 1rem; align-items: end;">
                    <div style="flex: 1;">
                        <label>Código de Rastreamento:</label>
                        <input type="text" name="remessa" class="form-input" placeholder="EXP..." value="<?= $_GET['remessa'] ?? '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            
            <?php if ($envio_selecionado): ?>
                <!-- Detalhes do Envio -->
                <div class="service-card" style="margin-bottom: 2rem;">
                    <h3>Detalhes do Envio: <?= htmlspecialchars($envio_selecionado['remessa']) ?></h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                        <div>
                            <h4>Informações Gerais</h4>
                            <p><strong>Destinatário:</strong> <?= htmlspecialchars($envio_selecionado['destinatario']) ?></p>
                            <p><strong>CPF:</strong> <?= htmlspecialchars($envio_selecionado['cpf_destinatario']) ?></p>
                            <p><strong>Status Atual:</strong> 
                                <span class="status-badge status-<?= $envio_selecionado['status'] ?>">
                                    <?= ucfirst($envio_selecionado['status']) ?>
                                </span>
                            </p>
                            <p><strong>Data de Criação:</strong> <?= date('d/m/Y H:i', strtotime($envio_selecionado['data_criacao'])) ?></p>
                        </div>
                        
                        <div>
                            <h4>Endereços</h4>
                            <p><strong>Origem:</strong><br><?= htmlspecialchars($envio_selecionado['endereco_origem']) ?></p>
                            <p><strong>Destino:</strong><br><?= htmlspecialchars($envio_selecionado['endereco_destino']) ?></p>
                        </div>
                    </div>
                    
                    <!-- Configuração de Pagamento Pendente -->
                    <div class="config-section">
                        <h4>⚠️ Configuração de Pagamento Pendente</h4>
                        <p>Ative esta opção para exibir a mensagem de pagamento pendente na página de rastreamento do cliente.</p>
                        
                        <form method="POST">
                            <input type="hidden" name="acao" value="configurar_pagamento">
                            <input type="hidden" name="remessa" value="<?= $envio_selecionado['remessa'] ?>">
                            
                            <div class="switch-container">
                                <label class="switch">
                                    <input type="checkbox" name="pagamento_ativo" <?= isset($envio_selecionado['pagamento_pendente']) && $envio_selecionado['pagamento_pendente'] ? 'checked' : '' ?>>
                                    <span class="slider"></span>
                                </label>
                                <strong>Ativar Mensagem de Pagamento Pendente</strong>
                            </div>
                            
                            <div style="margin-top: 1rem;">
                                <label><strong>Valor da Taxa (R$):</strong></label>
                                <input type="text" name="valor_taxa" class="form-input" 
                                       value="<?= $envio_selecionado['valor_taxa'] ?? '200,00' ?>" 
                                       placeholder="200,00" style="max-width: 200px;">
                                <small style="display: block; margin-top: 0.5rem; color: #666;">
                                    Use vírgula para separar os centavos (ex: 200,00)
                                </small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">
                                Salvar Configuração
                            </button>
                        </form>
                        
                        <?php if (isset($envio_selecionado['pagamento_pendente']) && $envio_selecionado['pagamento_pendente']): ?>
                            <div class="warning-box" style="margin-top: 1rem;">
                                <strong>✓ Mensagem de pagamento ATIVA</strong><br>
                                O cliente verá a mensagem de pagamento pendente ao rastrear este envio.
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Histórico de Rastreamento -->
                    <h4>Histórico de Rastreamento</h4>
                    <div class="tracking-history">
                        <?php foreach (array_reverse($envio_selecionado['historico']) as $evento): ?>
                            <div class="tracking-event">
                                <div class="tracking-date">
                                    <strong><?= $evento['data'] ?></strong><br>
                                    <small><?= $evento['hora'] ?></small>
                                </div>
                                <div class="tracking-info">
                                    <strong><?= htmlspecialchars($evento['descricao']) ?></strong><br>
                                    <small><?= htmlspecialchars($evento['local']) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Adicionar Evento Personalizado -->
                <div class="service-card" style="margin-bottom: 2rem;">
                    <h3>➕ Adicionar Evento Personalizado</h3>
                    <p>Adicione eventos personalizados à timeline de rastreamento (ex: "Objeto em transferência", "Saiu para entrega", etc.)</p>
                    
                    <form method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <input type="hidden" name="acao" value="adicionar_evento">
                        <input type="hidden" name="remessa" value="<?= $envio_selecionado['remessa'] ?>">
                        
                        <div>
                            <label>Local:</label>
                            <input type="text" name="local_evento" required class="form-input" 
                                   placeholder="Ex: São Paulo/SP">
                        </div>
                        
                        <div style="grid-column: 1 / -1;">
                            <label>Descrição do Evento:</label>
                            <input type="text" name="descricao_evento" required class="form-input" 
                                   placeholder="Ex: Objeto em transferência - por favor aguarde">
                        </div>
                        
                        <div style="grid-column: 1 / -1;">
                            <button type="submit" class="btn btn-primary">Adicionar Evento</button>
                        </div>
                    </form>
                    
                    <div style="margin-top: 1.5rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                        <strong>💡 Exemplos de eventos comuns:</strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem;">
                            <li>Objeto em transferência - por favor aguarde</li>
                            <li>Objeto saiu para entrega ao destinatário</li>
                            <li>Objeto encaminhado para [cidade/estado]</li>
                            <li>Objeto chegou à unidade de destino</li>
                            <li>Tentativa de entrega realizada</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Atualizar Status -->
                <div class="service-card">
                    <h3>Atualizar Status do Envio</h3>
                    <form method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <input type="hidden" name="acao" value="atualizar_status">
                        <input type="hidden" name="remessa" value="<?= $envio_selecionado['remessa'] ?>">
                        
                        <div>
                            <label>Novo Status:</label>
                            <select name="status" required class="form-input">
                                <option value="">Selecione...</option>
                                <option value="pending">Pendente</option>
                                <option value="collected">Coletado</option>
                                <option value="transit">Em Trânsito</option>
                                <option value="out_for_delivery">Saiu para Entrega</option>
                                <option value="delivered">Entregue</option>
                                <option value="returned">Devolvido</option>
                            </select>
                        </div>
                        
                        <div>
                            <label>Local:</label>
                            <input type="text" name="local" required class="form-input" placeholder="Cidade/Estado">
                        </div>
                        
                        <div style="grid-column: 1 / -1;">
                            <label>Descrição da Atualização:</label>
                            <input type="text" name="descricao" required class="form-input" placeholder="Ex: Objeto saiu para entrega">
                        </div>
                        
                        <div style="grid-column: 1 / -1;">
                            <button type="submit" class="btn btn-primary">Atualizar Status</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            
            <!-- Lista de Todos os Envios -->
            <div class="service-card">
                <h3>Todos os Envios (<?= count($envios) ?>)</h3>
                
                <?php if (empty($envios)): ?>
                    <p>Nenhum envio cadastrado ainda.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Destinatário</th>
                                    <th>Origem → Destino</th>
                                    <th>Status</th>
                                    <th>Última Atualização</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_reverse($envios) as $envio): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($envio['remessa']) ?></strong></td>
                                        <td><?= htmlspecialchars($envio['destinatario']) ?></td>
                                        <td><?= htmlspecialchars($envio['origem']) ?> → <?= htmlspecialchars($envio['destino']) ?></td>
                                        <td>
                                            <span class="status-badge status-<?= $envio['status'] ?>">
                                                <?= ucfirst($envio['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php 
                                            $ultimo_evento = end($envio['historico']);
                                            echo $ultimo_evento['data'] . ' ' . $ultimo_evento['hora'];
                                            ?>
                                        </td>
                                        <td>
                                            <a href="?remessa=<?= $envio['remessa'] ?>" class="btn btn-small">Gerenciar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
