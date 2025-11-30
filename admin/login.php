<?php
session_start();

if ($_POST) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    // Credenciais simples para demonstração
    if ($usuario === 'admin' && $senha === 'iphone123') {
        $_SESSION['admin_logado'] = true;
        header('Location: index.php');
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Administrativo ExpressLog</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--muted);">
        <div class="service-card" style="max-width: 400px; width: 100%;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="color: var(--primary-color);">ExpressLog</h1>
                <h2>Painel Administrativo</h2>
            </div>
            
            <?php if (isset($erro)): ?>
                <div style="background: #fef2f2; color: #dc2626; padding: 1rem; border-radius: var(--radius); margin-bottom: 1rem;">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Usuário</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Entrar</button>
            </form>
            
            <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--border); font-size: 0.875rem; color: var(--muted-foreground);">
            </div>
        </div>
    </div>
</body>
</html>
