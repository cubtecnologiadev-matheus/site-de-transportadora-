<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit;
}

include '../includes/functions.php';

// Processar ações
if ($_POST) {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'cadastrar':
                $dados = [
                    'destinatario' => $_POST['destinatario'],
                    'email_destinatario' => $_POST['email_destinatario'],
                    'telefone_destinatario' => $_POST['telefone_destinatario'],
                    'cpf_destinatario' => $_POST['cpf_destinatario'],
                    
                    'rua_origem' => $_POST['rua_origem'],
                    'numero_origem' => $_POST['numero_origem'],
                    'bairro_origem' => $_POST['bairro_origem'],
                    'cep_origem' => $_POST['cep_origem'],
                    'cidade_origem' => $_POST['cidade_origem'],
                    'estado_origem' => $_POST['estado_origem'],
                    'endereco_origem' => $_POST['rua_origem'] . ', ' . $_POST['numero_origem'] . ', ' . $_POST['bairro_origem'] . ', CEP: ' . $_POST['cep_origem'],
                    
                    'rua_destino' => $_POST['rua_destino'],
                    'numero_destino' => $_POST['numero_destino'],
                    'bairro_destino' => $_POST['bairro_destino'],
                    'cep_destino' => $_POST['cep_destino'],
                    'cidade_destino' => $_POST['cidade_destino'],
                    'estado_destino' => $_POST['estado_destino'],
                    'endereco_destino' => $_POST['rua_destino'] . ', ' . $_POST['numero_destino'] . ', ' . $_POST['bairro_destino'] . ', CEP: ' . $_POST['cep_destino'],
                    
                    'peso' => $_POST['peso'],
                    'valor_declarado' => $_POST['valor_declarado'],
                    'conteudo_declarado' => $_POST['conteudo_declarado'],
                    'origem' => $_POST['cidade_origem'] . '/' . $_POST['estado_origem'],
                    'destino' => $_POST['cidade_destino'] . '/' . $_POST['estado_destino']
                ];
                $remessa = salvarEnvio($dados);
                $mensagem = "Envio cadastrado com sucesso! Código de rastreamento: $remessa";
                break;
                
            case 'excluir':
                excluirEnvio($_POST['remessa']);
                $mensagem = "Envio excluído com sucesso!";
                break;
        }
    }
}

$envios = listarEnvios();

$estados = [
    'AC' => 'Acre',
    'AL' => 'Alagoas', 
    'AP' => 'Amapá',
    'AM' => 'Amazonas',
    'BA' => 'Bahia',
    'CE' => 'Ceará',
    'DF' => 'Distrito Federal',
    'ES' => 'Espírito Santo',
    'GO' => 'Goiás',
    'MA' => 'Maranhão',
    'MT' => 'Mato Grosso',
    'MS' => 'Mato Grosso do Sul',
    'MG' => 'Minas Gerais',
    'PA' => 'Pará',
    'PB' => 'Paraíba',
    'PR' => 'Paraná',
    'PE' => 'Pernambuco',
    'PI' => 'Piauí',
    'RJ' => 'Rio de Janeiro',
    'RN' => 'Rio Grande do Norte',
    'RS' => 'Rio Grande do Sul',
    'RO' => 'Rondônia',
    'RR' => 'Roraima',
    'SC' => 'Santa Catarina',
    'SP' => 'São Paulo',
    'SE' => 'Sergipe',
    'TO' => 'Tocantins'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Envios - ExpressLog Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }
        .form-section h4 {
            margin: 0 0 1rem 0;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        .form-grid-full {
            grid-column: 1 / -1;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .form-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-content">
        <div class="container">
            <h1>Gerenciar Envios</h1>
            
            <?php if (isset($mensagem)): ?>
                <div class="alert alert-success"><?= $mensagem ?></div>
            <?php endif; ?>
            
            <!-- Formulário de Cadastro -->
            <div class="service-card" style="margin-bottom: 2rem;">
                <h3>Cadastrar Novo Envio</h3>
                <form method="POST">
                    <input type="hidden" name="acao" value="cadastrar">
                    
                    <!-- Seção completa de dados do destinatário -->
                    <div class="form-section">
                        <h4>📋 Dados do Destinatário</h4>
                        <div class="form-grid">
                            <div>
                                <label>Nome Completo:</label>
                                <input type="text" name="destinatario" required class="form-input" placeholder="Nome completo do destinatário">
                            </div>
                            <div>
                                <label>E-mail:</label>
                                <input type="email" name="email_destinatario" required class="form-input" placeholder="email@exemplo.com">
                            </div>
                            <div>
                                <label>Telefone:</label>
                                <input type="text" name="telefone_destinatario" required class="form-input" placeholder="(11) 99999-9999">
                            </div>
                            <div>
                                <label>CPF:</label>
                                <input type="text" name="cpf_destinatario" required class="form-input" placeholder="000.000.000-00">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Endereço completo de origem -->
                    <div class="form-section">
                        <h4>📍 Endereço de Origem</h4>
                        <div class="form-grid">
                            <div>
                                <label>Nome da Rua:</label>
                                <input type="text" name="rua_origem" required class="form-input" placeholder="Ex: Rua das Flores">
                            </div>
                            <div>
                                <label>Número:</label>
                                <input type="text" name="numero_origem" required class="form-input" placeholder="Ex: 123">
                            </div>
                            <div>
                                <label>Bairro:</label>
                                <input type="text" name="bairro_origem" required class="form-input" placeholder="Ex: Centro">
                            </div>
                            <div>
                                <label>CEP:</label>
                                <input type="text" name="cep_origem" required class="form-input" placeholder="00000-000">
                            </div>
                            <div>
                                <label>Cidade:</label>
                                <input type="text" name="cidade_origem" required class="form-input" placeholder="Ex: São Paulo">
                            </div>
                            <div>
                                <label>Estado:</label>
                                <select name="estado_origem" required class="form-input">
                                    <option value="">Selecione o estado...</option>
                                    <?php foreach ($estados as $sigla => $nome): ?>
                                        <option value="<?= $sigla ?>"><?= $nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Endereço completo de destino -->
                    <div class="form-section">
                        <h4>🎯 Endereço de Destino</h4>
                        <div class="form-grid">
                            <div>
                                <label>Nome da Rua:</label>
                                <input type="text" name="rua_destino" required class="form-input" placeholder="Ex: Avenida Paulista">
                            </div>
                            <div>
                                <label>Número:</label>
                                <input type="text" name="numero_destino" required class="form-input" placeholder="Ex: 456">
                            </div>
                            <div>
                                <label>Bairro:</label>
                                <input type="text" name="bairro_destino" required class="form-input" placeholder="Ex: Bela Vista">
                            </div>
                            <div>
                                <label>CEP:</label>
                                <input type="text" name="cep_destino" required class="form-input" placeholder="00000-000">
                            </div>
                            <div>
                                <label>Cidade:</label>
                                <input type="text" name="cidade_destino" required class="form-input" placeholder="Ex: Rio de Janeiro">
                            </div>
                            <div>
                                <label>Estado:</label>
                                <select name="estado_destino" required class="form-input">
                                    <option value="">Selecione o estado...</option>
                                    <?php foreach ($estados as $sigla => $nome): ?>
                                        <option value="<?= $sigla ?>"><?= $nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informações da encomenda -->
                    <div class="form-section">
                        <h4>📦 Informações da Encomenda</h4>
                        <div class="form-grid">
                            <div>
                                <label>Peso (kg):</label>
                                <input type="number" name="peso" step="0.1" required class="form-input" placeholder="0.0">
                            </div>
                            <div>
                                <label>Valor Declarado (R$):</label>
                                <input type="number" name="valor_declarado" step="0.01" required class="form-input" placeholder="0.00">
                            </div>
                            <div class="form-grid-full">
                                <!-- Changed label from Observações to Conteúdo Declarado -->
                                <label>Conteúdo Declarado:</label>
                                <textarea name="conteudo_declarado" class="form-input" rows="3" placeholder="Descreva o conteúdo do pacote (ex: 1 Carregador original, 1 Capinha de proteção...)"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem;">
                        ✅ Cadastrar Envio Completo
                    </button>
                </form>
            </div>
            
            <!-- Lista de Envios -->
            <div class="service-card">
                <h3>📋 Envios Cadastrados (<?= count($envios) ?>)</h3>
                
                <?php if (empty($envios)): ?>
                    <p style="text-align: center; color: #666; padding: 2rem;">Nenhum envio cadastrado ainda.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Código Rastreamento</th>
                                    <th>Destinatário</th>
                                    <th>Origem → Destino</th>
                                    <th>Status</th>
                                    <th>Data Criação</th>
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
                                        <td><?= date('d/m/Y H:i', strtotime($envio['data_criacao'])) ?></td>
                                        <td>
                                            <a href="rastreamento.php?remessa=<?= $envio['remessa'] ?>" class="btn btn-small">Rastrear</a>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                                                <input type="hidden" name="acao" value="excluir">
                                                <input type="hidden" name="remessa" value="<?= $envio['remessa'] ?>">
                                                <button type="submit" class="btn btn-small btn-danger">Excluir</button>
                                            </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Máscara para CPF
            document.querySelectorAll('input[name="cpf_destinatario"]').forEach(function(input) {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                    e.target.value = value;
                });
            });

            // Máscara para telefone
            document.querySelectorAll('input[name="telefone_destinatario"]').forEach(function(input) {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                    e.target.value = value;
                });
            });

            // Máscara para CEP
            document.querySelectorAll('input[name$="_origem"], input[name$="_destino"]').forEach(function(input) {
                if (input.name.includes('cep')) {
                    input.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/\D/g, '');
                        value = value.replace(/(\d{5})(\d)/, '$1-$2');
                        e.target.value = value;
                    });
                }
            });
        });
    </script>
</body>
</html>
