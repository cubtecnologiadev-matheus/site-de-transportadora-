<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header class="header">
    <div class="container">
        <div class="header-content">
            <a href="index.php" class="logo">ExpressLog</a>
            <nav>
                <ul class="nav">
                    <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Início</a></li>
                    <li><a href="sobre.php" class="<?php echo ($current_page == 'sobre.php') ? 'active' : ''; ?>">Sobre</a></li>
                    <li><a href="servicos.php" class="<?php echo ($current_page == 'servicos.php') ? 'active' : ''; ?>">Serviços</a></li>
                    <li><a href="rastreio.php" class="<?php echo ($current_page == 'rastreio.php') ? 'active' : ''; ?>">Rastreamento</a></li>
                    <li><a href="sustentabilidade.php" class="<?php echo ($current_page == 'sustentabilidade.php') ? 'active' : ''; ?>">Sustentabilidade</a></li>
                    <li><a href="unidades.php" class="<?php echo ($current_page == 'unidades.php') ? 'active' : ''; ?>">Unidades</a></li>
                    <li><a href="contato.php" class="<?php echo ($current_page == 'contato.php') ? 'active' : ''; ?>">Contato</a></li>
                </ul>
            </nav>
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
        </div>
    </div>
</header>

<script>
function toggleMobileMenu() {
    const nav = document.querySelector('.nav');
    nav.classList.toggle('active');
}

document.addEventListener('click', function(event) {
    const nav = document.querySelector('.nav');
    const btn = document.querySelector('.mobile-menu-btn');
    
    if (!nav.contains(event.target) && !btn.contains(event.target)) {
        nav.classList.remove('active');
    }
});

document.querySelectorAll('.nav a').forEach(link => {
    link.addEventListener('click', function() {
        const nav = document.querySelector('.nav');
        nav.classList.remove('active');
    });
});
</script>
