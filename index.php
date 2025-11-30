<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpressLog - Logística Inteligente e Confiável</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Updated favicon to use ExpressLog logo -->
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <!-- Modern tracking section with gradient and animations -->
    <section class="tracking-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 1.5rem; font-size: 2rem; font-weight: 800; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">🔍 Rastreie sua encomenda em tempo real</h2>
            <form class="tracking-form" action="rastreio.php" method="POST">
                <input type="text" name="codigo" class="tracking-input" placeholder="Digite o código de rastreamento" required>
                <button type="submit" class="btn btn-primary">Rastrear Agora</button>
            </form>
        </div>
    </section>

    <!-- Modern hero with animated gradient -->
    <section class="hero">
        <div class="container">
            <h1>🚀 Logística que conecta o Brasil</h1>
            <p>Soluções completas em transporte e logística com tecnologia avançada, segurança garantida e entregas no prazo. Sua encomenda no melhor caminho, sempre.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; margin-top: 3rem; flex-wrap: wrap; position: relative; z-index: 1;">
                <a href="sobre.php" class="btn btn-primary">Conheça a ExpressLog</a>
                <a href="servicos.php" class="btn" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 2px solid white; color: white; font-weight: 800;">Nossos Serviços</a>
            </div>
        </div>
    </section>

    <!-- Ultra-compact stats section with smaller cards -->
    <section style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); padding: 4rem 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div style="background: white; padding: 2rem 1.5rem; border-radius: 16px; text-align: center; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border-top: 4px solid #2563eb;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 30px rgba(37,99,235,0.25)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'">
                    <div style="font-size: 3rem; font-weight: 900; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 0.4rem;">500k+</div>
                    <div style="color: var(--muted-foreground); font-weight: 600; font-size: 0.95rem;">Entregas realizadas</div>
                </div>
                <div style="background: white; padding: 2rem 1.5rem; border-radius: 16px; text-align: center; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border-top: 4px solid #16a34a;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 30px rgba(22,163,74,0.25)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'">
                    <div style="font-size: 3rem; font-weight: 900; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 0.4rem;">98%</div>
                    <div style="color: var(--muted-foreground); font-weight: 600; font-size: 0.95rem;">Entregas no prazo</div>
                </div>
                <div style="background: white; padding: 2rem 1.5rem; border-radius: 16px; text-align: center; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border-top: 4px solid #dc2626;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 30px rgba(220,38,38,0.25)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'">
                    <div style="font-size: 3rem; font-weight: 900; background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 0.4rem;">24h</div>
                    <div style="color: var(--muted-foreground); font-weight: 600; font-size: 0.95rem;">Tempo médio</div>
                </div>
                <div style="background: white; padding: 2rem 1.5rem; border-radius: 16px; text-align: center; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border-top: 4px solid #2563eb;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 30px rgba(37,99,235,0.25)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'">
                    <div style="font-size: 3rem; font-weight: 900; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 0.4rem;">1000+</div>
                    <div style="color: var(--muted-foreground); font-weight: 600; font-size: 0.95rem;">Cidades atendidas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Updated service images to use proper placeholder syntax -->
    <section class="services">
        <div class="container">
            <h2 class="section-title">✨ Nossos Serviços</h2>
            <div class="services-grid">
                <div class="service-card">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/entrega-expressa.jpg" alt="Entrega Expressa">
                    <h3>🚚 Entrega Expressa</h3>
                    <p>Entregas rápidas e seguras em todo o território nacional com prazos reduzidos e rastreamento em tempo real. Tecnologia de ponta para garantir que sua encomenda chegue no prazo.</p>
                </div>
                <div class="service-card">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/logistica-integrada.jpg" alt="Logística Integrada">
                    <h3>📊 Logística Integrada</h3>
                    <p>Soluções completas de armazenagem, distribuição e gestão de estoque com tecnologia de ponta. Sistema automatizado para máxima eficiência operacional.</p>
                </div>
                <div class="service-card">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/rastreamento.jpg" alt="Rastreamento">
                    <h3>📱 Rastreamento Inteligente</h3>
                    <p>Acompanhe sua encomenda em tempo real com nossa plataforma avançada de monitoramento. Notificações automáticas e visibilidade completa do processo.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern about section with enhanced layout -->
    <section class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>💡 Tecnologia e Inovação</h2>
                    <p>A ExpressLog utiliza as mais avançadas tecnologias em logística para garantir que sua encomenda chegue ao destino com segurança e no prazo correto.</p>
                    <p>Nossa plataforma integrada oferece visibilidade completa do processo de entrega, desde a coleta até a entrega final, proporcionando tranquilidade e confiança aos nossos clientes.</p>
                    <a href="sobre.php" class="btn btn-primary">Saiba Mais Sobre Nós</a>
                </div>
                <div class="about-image">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/centro-controle.jpg" alt="Centro de Controle ExpressLog">
                </div>
            </div>
        </div>
    </section>

    <!-- Added Prime Partner section with image from user -->
    <section style="background: linear-gradient(135deg, #fef3e2 0%, #fde8c8 100%); padding: 6rem 0;">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <p style="color: #2563eb; font-weight: 700; margin-bottom: 1rem;">Prime Partner</p>
                    <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Indique, Ganhe e Cresça com a ExpressLog</h2>
                    <p style="font-size: 1.1rem; margin-bottom: 1rem;">Você vende pela internet, representa uma agência, é consultor, professor de e-commerce ou influenciador digital?</p>
                    <p style="font-size: 1.1rem; margin-bottom: 2rem;">Então o Programa de Parceiros da ExpressLog foi feito para você!</p>
                    <p style="color: var(--muted-foreground); margin-bottom: 2rem;">Com o Prime Partners, você pode ganhar comissões recorrentes indicando a ExpressLog para lojistas e empreendedores que precisam de soluções de frete mais acessíveis, flexíveis e sem burocracia.</p>
                    <a href="#" class="btn" style="background: #f97316; color: white; font-weight: 700; padding: 1rem 2.5rem; border-radius: 50px;">Quero participar</a>
                </div>
                <div class="about-image">
                    <img src="/assets/images/prime-partner.jpg" alt="Programa Prime Partner" style="border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                </div>
            </div>
        </div>
    </section>

    <!-- Added freight management section with carousel -->
    <section style="background: white; padding: 6rem 0;">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <p style="color: #2563eb; font-weight: 700; margin-bottom: 1rem;">Gestão de Fretes</p>
                    <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Simplifique seus envios de encomendas</h2>
                    <p style="font-size: 1.1rem; margin-bottom: 2rem;">Plataforma completa para gestão de fretes, economize e envie com as melhores transportadora.</p>
                    <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 2rem;">
                        <div style="background: #2563eb; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700;">✓</div>
                        <div>
                            <p style="font-weight: 600; margin-bottom: 0.5rem;">Inicie a cotação de fretes com a ExpressLog e descubra como economizar</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button style="background: none; border: none; color: #f97316; font-size: 2rem; cursor: pointer;">‹</button>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <span style="width: 12px; height: 12px; background: #f97316; border-radius: 50%;"></span>
                            <span style="width: 12px; height: 12px; background: #e5e7eb; border-radius: 50%;"></span>
                        </div>
                        <button style="background: none; border: none; color: #f97316; font-size: 2rem; cursor: pointer;">›</button>
                    </div>
                </div>
                <div class="about-image">
                    <img src="/assets/images/gestao-fretes-2.jpg" alt="Gestão de Fretes" style="border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                </div>
            </div>
        </div>
    </section>

    <!-- Updated news section images -->
    <section class="news">
        <div class="container">
            <h2 class="section-title">🔥 Últimas Novidades</h2>
            <div class="services-grid">
                <div class="service-card">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/frota-sustentavel.jpg" alt="Frota Sustentável">
                    <h3>🌱 Frota 100% Sustentável</h3>
                    <p>ExpressLog investe em veículos elétricos e tecnologias limpas para reduzir o impacto ambiental das entregas. Compromisso com o futuro do planeta.</p>
                </div>
                <div class="service-card">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/ia-logistica.jpg" alt="IA em Logística">
                    <h3>🤖 IA na Logística</h3>
                    <p>Implementação de inteligência artificial para otimização de rotas e previsão de demanda em tempo real. Tecnologia que transforma a logística.</p>
                </div>
                <div class="service-card">
                    <!-- Updated to use local image -->
                    <img src="/assets/images/expansao-nacional.jpg" alt="Expansão Nacional">
                    <h3>🏢 Expansão Nacional</h3>
                    <p>Inauguração de novos centros de distribuição para ampliar nossa cobertura e reduzir prazos de entrega. Crescimento contínuo para melhor atendê-lo.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
