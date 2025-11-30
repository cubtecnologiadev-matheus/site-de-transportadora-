<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Frete - Orçamento | ExpressLog</title>
    <!-- Adding favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <section class="page-header">
        <div class="container">
            <h1>Calcular Frete</h1>
            <p>Simule o valor e prazo de entrega para sua encomenda</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <!-- Adding hero image for quote calculator page -->
            <div style="margin-bottom: 3rem;">
                <!-- Updated to use local image -->
                <img src="/assets/images/calculadora-frete.jpg" alt="Calculadora de Frete" style="width: 100%; height: 300px; object-fit: cover; border-radius: var(--radius); box-shadow: var(--shadow-lg);">
            </div>

            <div style="max-width: 800px; margin: 0 auto;">
                <div class="service-card">
                    <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; margin-bottom: 2rem; color: var(--primary-color);">Calculadora de Frete</h2>
                    
                    <form id="freteForm" style="display: grid; gap: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div class="form-group">
                                <label>CEP de Origem</label>
                                <input type="text" class="form-input" placeholder="00000-000" maxlength="9" required>
                            </div>
                            <div class="form-group">
                                <label>CEP de Destino</label>
                                <input type="text" class="form-input" placeholder="00000-000" maxlength="9" required>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
                            <div class="form-group">
                                <label>Peso (kg)</label>
                                <input type="number" class="form-input" placeholder="0.0" step="0.1" min="0" required>
                            </div>
                            <div class="form-group">
                                <label>Altura (cm)</label>
                                <input type="number" class="form-input" placeholder="0" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>Largura (cm)</label>
                                <input type="number" class="form-input" placeholder="0" min="1" required>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div class="form-group">
                                <label>Comprimento (cm)</label>
                                <input type="number" class="form-input" placeholder="0" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>Valor Declarado (R$)</label>
                                <input type="number" class="form-input" placeholder="0.00" step="0.01" min="0">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">Calcular Frete</button>
                    </form>

                    <div id="resultados" style="display: none; margin-top: 3rem; padding-top: 3rem; border-top: 2px solid var(--border);">
                        <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; margin-bottom: 2rem; color: var(--primary-color);">Opções Disponíveis</h3>
                        
                        <div style="display: grid; gap: 1.5rem;">
                            <div style="border: 2px solid var(--accent-color); border-radius: var(--radius); padding: 1.5rem; background: rgba(0, 123, 255, 0.05);">
                                <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 1rem;">
                                    <div>
                                        <h4 style="color: var(--accent-color); font-size: 1.3rem; margin-bottom: 0.5rem;">ExpressLog Expresso</h4>
                                        <p style="color: var(--muted-foreground); margin-bottom: 0.5rem;">Entrega em até 24 horas</p>
                                        <span class="status-badge" style="background: var(--accent-color); color: white;">Mais Rápido</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 2rem; font-weight: 700; color: var(--accent-color);">R$ 45,90</div>
                                        <p style="color: var(--muted-foreground); font-size: 0.9rem;">Entrega: Amanhã</p>
                                    </div>
                                </div>
                            </div>

                            <div style="border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem;">
                                <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 1rem;">
                                    <div>
                                        <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 0.5rem;">ExpressLog Padrão</h4>
                                        <p style="color: var(--muted-foreground); margin-bottom: 0.5rem;">Entrega em 2 a 3 dias úteis</p>
                                        <span class="status-badge" style="background: var(--accent-secondary); color: white;">Recomendado</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 2rem; font-weight: 700; color: var(--primary-color);">R$ 25,90</div>
                                        <p style="color: var(--muted-foreground); font-size: 0.9rem;">Entrega: 3 dias úteis</p>
                                    </div>
                                </div>
                            </div>

                            <div style="border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem;">
                                <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 1rem;">
                                    <div>
                                        <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 0.5rem;">ExpressLog Econômico</h4>
                                        <p style="color: var(--muted-foreground); margin-bottom: 0.5rem;">Entrega em 4 a 5 dias úteis</p>
                                        <span class="status-badge" style="background: var(--muted); color: var(--foreground);">Melhor Preço</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 2rem; font-weight: 700; color: var(--primary-color);">R$ 15,90</div>
                                        <p style="color: var(--muted-foreground); font-size: 0.9rem;">Entrega: 5 dias úteis</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 2rem; padding: 1.5rem; background: var(--muted); border-radius: var(--radius);">
                            <p style="font-size: 0.9rem; color: var(--muted-foreground); margin-bottom: 0.5rem;">✓ Todos os serviços incluem seguro básico</p>
                            <p style="font-size: 0.9rem; color: var(--muted-foreground); margin-bottom: 0.5rem;">✓ Rastreamento em tempo real</p>
                            <p style="font-size: 0.9rem; color: var(--muted-foreground);">✓ Notificações por SMS e email</p>
                        </div>

                        <a href="contato.php" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">Contratar Serviço</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="background: var(--muted); padding: 4rem 0;">
        <div class="container">
            <h2 class="section-title">Serviços Adicionais</h2>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Seguro Adicional</h3>
                    <p>Proteja encomendas de alto valor com cobertura estendida de até R$ 50.000.</p>
                    <div style="margin-top: 1rem; color: var(--accent-color); font-weight: 600;">A partir de R$ 5,00</div>
                </div>
                <div class="service-card">
                    <h3>Coleta Agendada</h3>
                    <p>Agende a coleta no endereço de sua preferência com hora marcada.</p>
                    <div style="margin-top: 1rem; color: var(--accent-color); font-weight: 600;">A partir de R$ 8,00</div>
                </div>
                <div class="service-card">
                    <h3>Entrega Agendada</h3>
                    <p>Escolha dia e horário específico para recebimento da encomenda.</p>
                    <div style="margin-top: 1rem; color: var(--accent-color); font-weight: 600;">A partir de R$ 12,00</div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('freteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('resultados').style.display = 'block';
            document.getElementById('resultados').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    </script>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
