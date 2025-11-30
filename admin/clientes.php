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
                    'nome' => $_POST['nome'],
                    'cpf' => $_POST['cpf'],
                    'email' => $_POST['email'],
                    'telefone' => $_POST['telefone'],
                    'data_nascimento' => $_POST['data_nascimento'],
                    'endereco' => $_POST['endereco'],
                    'cidade' => $_POST['cidade'],
                    'estado' => $_POST['estado'],
                    'cep' => $_POST['cep']
                ];
                $id = salvarCliente($dados);
                $mensagem = "Cliente cadastrado com sucesso! ID: $id";
                break;
                
            case 'excluir':
                excluirCliente($_POST['id']);
                $mensagem = "Cliente excluído com sucesso!";
                break;
        }
    }
}

$clientes = listarClientes();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes - ExpressLog Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-content">
        <div class="container">
            <h1>Gerenciar Clientes</h1>
            
            <?php if (isset($mensagem)): ?>
                <div class="alert alert-success"><?= $mensagem ?></div>
            <?php endif; ?>
            
            <!-- Formulário de Cadastro -->
            <div class="service-card" style="margin-bottom: 2rem;">
                <h3>Cadastrar Novo Cliente</h3>
                <form method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <input type="hidden" name="acao" value="cadastrar">
                    
                    <div>
                        <label>Nome Completo:</label>
                        <input type="text" name="nome" required class="form-input">
                    </div>
                    
                    <div>
                        <label>CPF:</label>
                        <input type="text" name="cpf" required class="form-input" placeholder="000.000.000-00">
                    </div>
                    
                    <div>
                        <label>Email:</label>
                        <input type="email" name="email" required class="form-input">
                    </div>
                    
                    <div>
                        <label>Telefone:</label>
                        <input type="text" name="telefone" required class="form-input" placeholder="(00) 00000-0000">
                    </div>
                    
                    <div>
                        <label>Data de Nascimento:</label>
                        <input type="date" name="data_nascimento" required class="form-input">
                    </div>
                    
                    <div>
                        <label>CEP:</label>
                        <input type="text" name="cep" required class="form-input" placeholder="00000-000">
                    </div>
                    
                    <div style="grid-column: 1 / -1;">
                        <label>Endereço Completo:</label>
                        <input type="text" name="endereco" required class="form-input" placeholder="Rua, número, bairro">
                    </div>
                    
                    <div>
                        <label>Cidade:</label>
                        <input type="text" name="cidade" required class="form-input">
                    </div>
                    
                    <div>
                        <label>Estado:</label>
                        <select name="estado" required class="form-input">
                            <option value="">Selecione...</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    
                    <div style="grid-column: 1 / -1;">
                        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
                    </div>
                </form>
            </div>
            
            <!-- Lista de Clientes -->
            <div class="service-card">
                <h3>Clientes Cadastrados (<?= count($clientes) ?>)</h3>
                
                <?php if (empty($clientes)): ?>
                    <p>Nenhum cliente cadastrado ainda.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Cidade/Estado</th>
                                    <th>Data Cadastro</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($cliente['nome']) ?></td>
                                        <td><?= htmlspecialchars($cliente['cpf']) ?></td>
                                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                                        <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                                        <td><?= htmlspecialchars($cliente['cidade']) ?>/<?= htmlspecialchars($cliente['estado']) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($cliente['data_cadastro'])) ?></td>
                                        <td>
                                            <button onclick="verDetalhes('<?= $cliente['id'] ?>')" class="btn btn-small">Ver</button>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                                                <input type="hidden" name="acao" value="excluir">
                                                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
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
        function verDetalhes(id) {
            // Implementar modal ou página de detalhes
            alert('Funcionalidade de detalhes será implementada em breve!');
        }
    </script>
</body>
</html>
