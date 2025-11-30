<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Notícias e Novidades | ExpressLog</title>
    <!-- Adding favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <section class="page-header">
        <div class="container">
            <h1>Blog ExpressLog</h1>
            <p>Fique por dentro das últimas novidades, dicas e tendências do setor logístico</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 4rem;">
                <div>
                    <!-- Compact blog post cards -->
                    <article class="service-card" style="margin-bottom: 1.5rem;">
                        <img src="/assets/images/electric-fleet.jpg" alt="Frota Elétrica" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <div style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; flex-wrap: wrap;">
                            <span class="status-badge" style="background: var(--accent-color); color: white;">Sustentabilidade</span>
                            <span style="color: var(--muted-foreground); font-size: 0.85rem;">15 de Janeiro, 2025</span>
                        </div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; margin-bottom: 0.75rem; color: var(--primary-color);">ExpressLog investe R$ 50 milhões em frota elétrica</h2>
                        <p style="color: var(--muted-foreground); line-height: 1.7; margin-bottom: 1rem; font-size: 0.95rem;">A ExpressLog anuncia o maior investimento em sustentabilidade da sua história: R$ 50 milhões para aquisição de 200 veículos elétricos que vão compor nossa frota de entregas urbanas. A iniciativa faz parte do compromisso da empresa em reduzir em 60% as emissões de carbono até 2030...</p>
                        <a href="#" style="color: var(--accent-color); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Ler mais →</a>
                    </article>

                    <article class="service-card" style="margin-bottom: 1.5rem;">
                        <img src="/assets/images/ai-logistics.jpg" alt="IA na Logística" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <div style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; flex-wrap: wrap;">
                            <span class="status-badge" style="background: var(--accent-secondary); color: white;">Tecnologia</span>
                            <span style="color: var(--muted-foreground); font-size: 0.85rem;">10 de Janeiro, 2025</span>
                        </div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; margin-bottom: 0.75rem; color: var(--primary-color);">Como a IA está revolucionando a logística brasileira</h2>
                        <p style="color: var(--muted-foreground); line-height: 1.7; margin-bottom: 1rem; font-size: 0.95rem;">A inteligência artificial chegou para transformar o setor logístico. Na ExpressLog, utilizamos algoritmos avançados de machine learning para otimizar rotas, prever demandas e reduzir custos operacionais. Descubra como a tecnologia está tornando as entregas mais rápidas e eficientes...</p>
                        <a href="#" style="color: var(--accent-color); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Ler mais →</a>
                    </article>

                    <article class="service-card" style="margin-bottom: 1.5rem;">
                        <img src="/assets/images/packaging-tips.jpg" alt="E-commerce" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <div style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; flex-wrap: wrap;">
                            <span class="status-badge" style="background: var(--primary-color); color: white;">Dicas</span>
                            <span style="color: var(--muted-foreground); font-size: 0.85rem;">5 de Janeiro, 2025</span>
                        </div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; margin-bottom: 0.75rem; color: var(--primary-color);">10 dicas para embalar produtos e evitar avarias</h2>
                        <p style="color: var(--muted-foreground); line-height: 1.7; margin-bottom: 1rem; font-size: 0.95rem;">A embalagem adequada é fundamental para garantir que seus produtos cheguem intactos ao destino. Neste artigo, compartilhamos as melhores práticas de embalagem utilizadas por grandes e-commerces, incluindo escolha de materiais, técnicas de proteção e dicas para reduzir custos...</p>
                        <a href="#" style="color: var(--accent-color); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Ler mais →</a>
                    </article>

                    <article class="service-card" style="margin-bottom: 1.5rem;">
                        <img src="/assets/images/new-facility.jpg" alt="Nova Unidade" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius); margin-bottom: 1rem;">
                        <div style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; flex-wrap: wrap;">
                            <span class="status-badge" style="background: var(--accent-color); color: white;">Expansão</span>
                            <span style="color: var(--muted-foreground); font-size: 0.85rem;">28 de Dezembro, 2024</span>
                        </div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; margin-bottom: 0.75rem; color: var(--primary-color);">ExpressLog inaugura novo centro de distribuição em Manaus</h2>
                        <p style="color: var(--muted-foreground); line-height: 1.7; margin-bottom: 1rem; font-size: 0.95rem;">Expandindo nossa presença na região Norte, inauguramos um moderno centro de distribuição em Manaus com capacidade para processar 50 mil encomendas por dia. A nova unidade vai reduzir em até 40% o prazo de entregas para a região amazônica...</p>
                        <a href="#" style="color: var(--accent-color); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Ler mais →</a>
                    </article>

                    <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 3rem;">
                        <button class="btn btn-primary">1</button>
                        <button class="btn" style="background: var(--muted); color: var(--foreground);">2</button>
                        <button class="btn" style="background: var(--muted); color: var(--foreground);">3</button>
                        <button class="btn" style="background: var(--muted); color: var(--foreground);">→</button>
                    </div>
                </div>

                <aside>
                    <div class="service-card" style="margin-bottom: 2rem; position: sticky; top: 100px;">
                        <h3 style="margin-bottom: 1.5rem;">Categorias</h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <a href="#" style="color: var(--foreground); text-decoration: none; padding: 0.75rem; background: var(--muted); border-radius: var(--radius); display: flex; justify-content: space-between; transition: all 0.3s;">
                                <span>Tecnologia</span>
                                <span style="color: var(--muted-foreground);">12</span>
                            </a>
                            <a href="#" style="color: var(--foreground); text-decoration: none; padding: 0.75rem; background: var(--muted); border-radius: var(--radius); display: flex; justify-content: space-between; transition: all 0.3s;">
                                <span>Sustentabilidade</span>
                                <span style="color: var(--muted-foreground);">8</span>
                            </a>
                            <a href="#" style="color: var(--foreground); text-decoration: none; padding: 0.75rem; background: var(--muted); border-radius: var(--radius); display: flex; justify-content: space-between; transition: all 0.3s;">
                                <span>Dicas</span>
                                <span style="color: var(--muted-foreground);">15</span>
                            </a>
                            <a href="#" style="color: var(--foreground); text-decoration: none; padding: 0.75rem; background: var(--muted); border-radius: var(--radius); display: flex; justify-content: space-between; transition: all 0.3s;">
                                <span>Expansão</span>
                                <span style="color: var(--muted-foreground);">6</span>
                            </a>
                            <a href="#" style="color: var(--foreground); text-decoration: none; padding: 0.75rem; background: var(--muted); border-radius: var(--radius); display: flex; justify-content: space-between; transition: all 0.3s;">
                                <span>Novidades</span>
                                <span style="color: var(--muted-foreground);">10</span>
                            </a>
                        </div>
                    </div>

                    <div class="service-card">
                        <h3 style="margin-bottom: 1.5rem;">Posts Populares</h3>
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <div>
                                <h4 style="font-size: 1rem; margin-bottom: 0.5rem; line-height: 1.4;"><a href="#" style="color: var(--foreground); text-decoration: none;">Como rastrear encomendas em tempo real</a></h4>
                                <span style="color: var(--muted-foreground); font-size: 0.85rem;">20 de Dezembro, 2024</span>
                            </div>
                            <div>
                                <h4 style="font-size: 1rem; margin-bottom: 0.5rem; line-height: 1.4;"><a href="#" style="color: var(--foreground); text-decoration: none;">Logística reversa: guia completo</a></h4>
                                <span style="color: var(--muted-foreground); font-size: 0.85rem;">15 de Dezembro, 2024</span>
                            </div>
                            <div>
                                <h4 style="font-size: 1rem; margin-bottom: 0.5rem; line-height: 1.4;"><a href="#" style="color: var(--foreground); text-decoration: none;">Tendências logísticas para 2025</a></h4>
                                <span style="color: var(--muted-foreground); font-size: 0.85rem;">10 de Dezembro, 2024</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
