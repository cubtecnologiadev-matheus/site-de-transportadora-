<div class="admin-header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>ExpressLog - Painel Administrativo</h1>
            <a href="logout.php" style="color: var(--primary-foreground); text-decoration: none;">Sair</a>
        </div>
    </div>
</div>

<div class="admin-nav">
    <div class="container">
        <ul>
            <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="clientes.php" class="<?= basename($_SERVER['PHP_SELF']) === 'clientes.php' ? 'active' : '' ?>">Clientes</a></li>
            <li><a href="envios.php" class="<?= basename($_SERVER['PHP_SELF']) === 'envios.php' ? 'active' : '' ?>">Envios</a></li>
            <li><a href="rastreamento.php" class="<?= basename($_SERVER['PHP_SELF']) === 'rastreamento.php' ? 'active' : '' ?>">Rastreamento</a></li>
        </ul>
    </div>
</div>
