<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit;
}

include '../includes/functions.php';

$clientes = listarClientes();
$envios = listarEnvios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Painel Administrativo ExpressLog</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-content">
        <div class="container">
            <h1>Dashboard</h1>
            
            <div class="services-grid" style="margin-bottom: 3rem;">
                <div class="service-card" style="text-align: center;">
                    <h3 style="font-size: 3rem; color: var(--primary-color);"><?= count($clientes) ?></h3>
                    <p>Clientes Cadastrados</p>
                </div>
                <div class="service-card" style="text-align: center;">
                    <h3 style="font-size: 3rem; color: var(--secondary-color);"><?= count($envios) ?></h3>
                    <p>Envios Registrados</p>
                </div>
                <div class="service-card" style="text-align: center;">
                    <h3 style="font-size: 3rem; color: var(--accent-color);"><?= count(array_filter($envios, fn($e) => $e['status'] === 'transit')) ?></h3>
                    <p>Em Trânsito</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="service-card">
                    <h3>Últimos Clientes</h3>
                    <?php if (empty($clientes)): ?>
                        <p>Nenhum cliente cadastrado ainda.</p>
                    <?php else: ?>
                        <?php foreach (array_slice(array_reverse($clientes), 0, 5) as $cliente): ?>
                            <div style="padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
                                <strong><?= htmlspecialchars($cliente['nome']) ?></strong><br>
                                <small><?= htmlspecialchars($cliente['email']) ?></small>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="service-card">
                    <h3>Últimos Envios</h3>
                    <?php if (empty($envios)): ?>
                        <p>Nenhum envio registrado ainda.</p>
                    <?php else: ?>
                        <?php foreach (array_slice(array_reverse($envios), 0, 5) as $envio): ?>
                            <div style="padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
                                <strong><?= htmlspecialchars($envio['remessa']) ?></strong><br>
                                <small><?= htmlspecialchars($envio['destinatario']) ?> - 
                                <span class="status-badge status-<?= $envio['status'] ?>">
                                    <?= ucfirst($envio['status']) ?>
                                </span></small>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
