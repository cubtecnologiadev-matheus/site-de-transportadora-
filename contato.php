<?php
$mensagem = null;

if ($_POST) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $assunto = trim($_POST['assunto']);
    $mensagem_texto = trim($_POST['mensagem']);
    
    if (!empty($nome) && !empty($email) && !empty($mensagem_texto)) {
        // Salvar contato em arquivo
        $contato = [
            'data' => date('Y-m-d H:i:s'),
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'assunto' => $assunto,
            'mensagem' => $mensagem_texto
        ];
        
        if (!file_exists('data')) {
            mkdir('data', 0777, true);
        }
        
        file_put_contents('data/contatos.txt', json_encode($contato) . "\n", FILE_APPEND);
        $mensagem = "Mensagem enviada com sucesso! Entraremos em contato em breve.";
    } else {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - ExpressLog</title>
    <!-- Adding favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <section style="margin-top: 120px; padding: 4rem 0;">
        <div class="container">
            <h1 class="section-title">Entre em Contato</h1>
            
            <?php if ($mensagem): ?>
                <div style="background: #f0f9ff; color: #0369a1; padding: 1rem; border-radius: var(--radius); margin-bottom: 2rem; text-align: center;">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <!-- Adding hero image for contact page -->
            <div style="margin-bottom: 3rem;">
                <!-- Updated to use local image -->
                <img src="/assets/images/atendimento.jpg" alt="Atendimento ExpressLog" style="width: 100%; height: 300px; object-fit: cover; border-radius: var(--radius); box-shadow: var(--shadow-lg);">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">
                <div>
                    <h2>Fale Conosco</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label>Nome *</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Assunto</label>
                            <select name="assunto" class="form-control">
                                <option value="">Selecione um assunto</option>
                                <option value="duvida">Dúvida</option>
                                <option value="reclamacao">Reclamação</option>
                                <option value="sugestao">Sugestão</option>
                                <option value="franquia">Franquia</option>
                                <option value="comercial">Comercial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mensagem *</label>
                            <textarea name="mensagem" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                    </form>
                </div>
                
                <div>
                    <h2>Informações de Contato</h2>
                    
                    <!-- Adding image to contact info card -->
                    <div class="service-card">
                        <!-- Updated to use local image -->
                        <img src="/assets/images/central-atendimento.jpg" alt="Central de Atendimento" style="width: 100%; height: 150px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <h3>Central de Atendimento</h3>
                        <p><strong>Telefone:</strong> 41 8424-8716<br>
                        <strong>WhatsApp:</strong> (41) 98424-8716<br>
                        <strong>E-mail:</strong> atendimento@expresslog.com.br<br>
                        <strong>Horário:</strong> Segunda a Sexta, 8h às 18h</p>
                    </div>
                    
                    <div class="service-card">
                        <!-- Updated to use local image -->
                        <img src="/assets/images/matriz.jpg" alt="Matriz ExpressLog" style="width: 100%; height: 150px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <h3>Matriz</h3>
                        <p><strong>Endereço:</strong><br>
                        Rua Comandante Soares Junior, 101 - Letra A<br>
                        Artur Bernardes - Lavras/MG<br>
                        CEP: 37205-034</p>
                    </div>
                    
                    <div class="service-card">
                        <!-- Updated to use local image -->
                        <img src="/assets/images/comercial.jpg" alt="Comercial" style="width: 100%; height: 150px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <h3>Comercial</h3>
                        <p><strong>E-mail:</strong> comercial@expresslog.com.br<br>
                        <strong>Telefone:</strong> 41 8424-8716<br>
                        <strong>CNPJ:</strong> 01.374.153/0001-61</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
