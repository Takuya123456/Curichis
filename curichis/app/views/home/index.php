<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curichis — El sabor de la Amazonía</title>
    <link rel="stylesheet" href="<?= APP_URL ?>/css/style.css">
    <style>
        .hero-section {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background: #060610;
        }
        .hero-media {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0d0520 0%, #1a0830 40%, #0d1530 70%, #060610 100%);
        }
        .hero-media video,
        .hero-media img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .media-placeholder {
            position: absolute;
            inset: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px dashed rgba(232,64,122,0.3);
            border-radius: 20px;
            gap: 12px;
            pointer-events: none;
        }
        .media-placeholder .ph-icon { font-size: 4rem; opacity: 0.35; }
        .media-placeholder .ph-text { font-family:'Fredoka One',cursive; font-size:1.2rem; color:rgba(232,64,122,0.5); letter-spacing:.1em; }
        .media-placeholder .ph-sub  { font-size:.78rem; color:rgba(255,255,255,0.2); }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                rgba(0,0,0,0.2) 0%,
                rgba(0,0,0,0.1) 35%,
                rgba(0,0,0,0.45) 75%,
                rgba(6,6,16,0.97) 100%);
            z-index: 1;
        }
        .hero-nav {
            position: absolute;
            top: 0; left: 0; right: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 48px;
        }
        .hero-nav-logo {
            font-family: 'Fredoka One', cursive;
            font-size: 1.8rem;
            color: #fff;
            text-shadow: 0 2px 12px rgba(0,0,0,.6);
            letter-spacing: .03em;
        }
        .hero-nav-logo span { color: var(--primary); }
        .hero-nav-links { display:flex; gap:12px; align-items:center; }
        .btn-ghost {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.22);
            color: #fff;
            padding: 9px 22px;
            border-radius: 50px;
            font-family:'Nunito',sans-serif;
            font-weight: 800;
            font-size: .875rem;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-ghost:hover { background:rgba(255,255,255,.2); transform:translateY(-2px); }
        .btn-hero-cta {
            background: var(--primary);
            color: #fff;
            padding: 9px 22px;
            border-radius: 50px;
            font-family:'Nunito',sans-serif;
            font-weight: 800;
            font-size: .875rem;
            text-decoration: none;
            transition: all .2s;
            box-shadow: 0 4px 20px rgba(232,64,122,.45);
        }
        .btn-hero-cta:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(232,64,122,.65); }

        .hero-content {
            position: absolute;
            bottom: 80px; left: 48px;
            z-index: 5;
            max-width: 580px;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(232,64,122,.18);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(232,64,122,.4);
            color: #ffb3cc;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .08em;
            margin-bottom: 14px;
            text-transform: uppercase;
        }
        .hero-title {
            font-family:'Fredoka One',cursive;
            font-size: clamp(2.4rem, 5.5vw, 4rem);
            color: #fff;
            line-height: 1.08;
            margin-bottom: 14px;
            text-shadow: 0 2px 24px rgba(0,0,0,.55);
        }
        .hero-title .accent { color: var(--primary); }
        .hero-sub {
            color: rgba(255,255,255,.62);
            font-size: 1.02rem;
            line-height: 1.65;
            margin-bottom: 30px;
        }
        .hero-actions { display:flex; gap:12px; flex-wrap:wrap; }
        .btn-ver-demo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.93);
            color: #111;
            padding: 12px 30px;
            border-radius: 50px;
            font-family:'Nunito',sans-serif;
            font-weight: 800;
            font-size: 1rem;
            text-decoration: none;
            transition: all .25s;
            box-shadow: 0 8px 30px rgba(0,0,0,.35);
        }
        .btn-ver-demo:hover { background:#fff; transform:translateY(-3px); box-shadow:0 12px 40px rgba(0,0,0,.45); }

        .scroll-hint {
            position: absolute;
            bottom: 26px; left: 50%;
            transform: translateX(-50%);
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,.3);
            font-size: .68rem;
            letter-spacing: .2em;
            font-weight: 700;
        }
        .scroll-line {
            width: 1px; height: 38px;
            background: linear-gradient(to bottom, rgba(255,255,255,.35), transparent);
            animation: scrollPulse 1.6s ease-in-out infinite;
        }
        @keyframes scrollPulse { 0%,100%{opacity:.3} 50%{opacity:.8} }

        /* sabores chips */
        .sabores-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }
        .chip {
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,.15);
            color: rgba(255,255,255,.8);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 700;
        }

        /* Features */
        .features-section { background:var(--bg2); padding:72px 48px; border-top:1px solid var(--border); }
        .section-header { text-align:center; margin-bottom:48px; }
        .section-label {
            display:inline-block;
            background:rgba(232,64,122,.1);
            border:1px solid rgba(232,64,122,.3);
            color:var(--primary);
            padding:4px 14px; border-radius:20px;
            font-size:.73rem; font-weight:800; letter-spacing:.1em; margin-bottom:12px;
        }
        .section-title { font-family:'Fredoka One',cursive; font-size:2.2rem; margin-bottom:10px; }
        .section-sub { color:var(--text-muted); font-size:.95rem; }
        .features-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; max-width:960px; margin:0 auto; }
        .feature-card {
            background:var(--card); border:1px solid var(--border);
            border-radius:16px; padding:30px 26px;
            transition:all .3s; cursor:pointer; position:relative; overflow:hidden;
        }
        .feature-card::before {
            content:''; position:absolute; top:0;left:0;right:0; height:3px;
            background:linear-gradient(90deg,var(--primary),var(--secondary));
            transform:scaleX(0); transition:transform .3s;
        }
        .feature-card:hover::before { transform:scaleX(1); }
        .feature-card:hover { border-color:rgba(232,64,122,.3); transform:translateY(-6px); box-shadow:0 16px 48px rgba(0,0,0,.3); }
        .feature-icon { font-size:2.5rem; margin-bottom:14px; display:block; }
        .feature-title { font-family:'Fredoka One',cursive; font-size:1.2rem; margin-bottom:10px; }
        .feature-desc { color:var(--text-muted); font-size:.875rem; line-height:1.7; }
        .feature-link { display:inline-flex; align-items:center; gap:4px; color:var(--primary); font-weight:800; font-size:.85rem; text-decoration:none; margin-top:14px; transition:gap .2s; }
        .feature-link:hover { gap:8px; }

        .home-footer {
            background:var(--bg);
            border-top:1px solid var(--border);
            padding:22px 48px;
            display:flex; align-items:center; justify-content:space-between;
            font-size:.8rem; color:var(--text-muted);
        }
        .footer-logo { font-family:'Fredoka One',cursive; color:var(--primary); font-size:1.1rem; }

        @media(max-width:768px){
            .hero-nav{padding:16px 20px;}
            .hero-content{left:20px;right:20px;bottom:60px;}
            .features-section{padding:48px 20px;}
            .home-footer{padding:16px 20px;flex-direction:column;gap:8px;text-align:center;}
        }
    </style>
</head>
<body>

<section class="hero-section">

    <!-- ╔══════════════════════════════════════════════╗
         ║  ZONA PARA TU VIDEO O FOTO DE FONDO         ║
         ║                                              ║
         ║  VIDEO: borra .media-placeholder y pon:     ║
         ║  <video autoplay muted loop playsinline>    ║
         ║    <source src="<?= APP_URL ?>/img/hero.mp4"║
         ║      type="video/mp4">                      ║
         ║  </video>                                   ║
         ║                                              ║
         ║  FOTO: borra .media-placeholder y pon:     ║
         ║  <img src="<?= APP_URL ?>/img/hero.jpg"     ║
         ║    alt="Curichis">                          ║
         ╚══════════════════════════════════════════════╝ -->
   <div class="hero-media">
    <video autoplay muted loop playsinline>
        <source src="/curichis/Imagenes%20y%20foto/video.mp4" type="video/mp4">
        Tu navegador no soporta videos.
    </video>
</div>
    </div>

    <div class="hero-overlay"></div>

    <nav class="hero-nav">
        <div class="hero-nav-logo">🧊 <span>Curichis</span></div>
        <div class="hero-nav-links">
            <a href="<?= APP_URL ?>/login" class="btn-ghost">Iniciar sesión</a>
            <a href="<?= APP_URL ?>/login/register" class="btn-hero-cta">Registrarse</a>
        </div>
    </nav>

    <div class="hero-content">
        <div class="hero-badge">🧊 El sabor de la Amazonía peruana</div>
        <h1 class="hero-title">
            Hola de nuevo,<br>
            <span class="accent">¡bienvenido!</span>
        </h1>
        <div class="sabores-chips">
            <span class="chip">🟡 Maracuyá</span>
            <span class="chip">🔴 Fresa</span>
            <span class="chip">🟤 Aguaje</span>
            <span class="chip">🟣 Chicha</span>
            <span class="chip">🥥 Coco</span>
            <span class="chip">🟢 Camu camu</span>
        </div>
        <p class="hero-sub">
            Gestiona las ventas de tus curichis y marcianos desde un solo lugar. Controla sabores, clientes y ventas fácilmente.
        </p>
        <div class="hero-actions">
            <a href="<?= APP_URL ?>/login" class="btn-ver-demo">Ver demo →</a>
            <a href="#features" class="btn-ghost" style="padding:12px 24px;">Conocer más</a>
        </div>
    </div>

    <div class="scroll-hint">
        <div class="scroll-line"></div>
        SCROLL
    </div>
</section>

<section class="features-section" id="features">
    <div class="section-header">
        <div class="section-label">MÓDULOS DEL SISTEMA</div>
        <h2 class="section-title">¿Qué puedes hacer?</h2>
        <p class="section-sub">Todo lo que necesitas para gestionar tu negocio de curichis</p>
    </div>
    <div class="features-grid">
        <div class="feature-card" onclick="location.href='<?= APP_URL ?>/login'">
            <span class="feature-icon">💰</span>
            <div class="feature-title">Registro de ventas</div>
            <p class="feature-desc">Registra y controla las transacciones de venta, asociando clientes, productos, cantidades y montos para una mejor gestión administrativa y financiera.</p>
            <a href="<?= APP_URL ?>/login" class="feature-link">Ver demo →</a>
        </div>
        <div class="feature-card" onclick="location.href='<?= APP_URL ?>/login'">
            <span class="feature-icon">🧊</span>
            <div class="feature-title">Panel de productos</div>
            <p class="feature-desc">Visualiza y administra todos tus sabores y presentaciones: curichis, marcianos, paletas y granizados. Controla precios, stock y categorías fácilmente.</p>
            <a href="<?= APP_URL ?>/login" class="feature-link">Ver demo →</a>
        </div>
        <div class="feature-card" onclick="location.href='<?= APP_URL ?>/login'">
            <span class="feature-icon">👥</span>
            <div class="feature-title">Clientes</div>
            <p class="feature-desc">Gestiona tu cartera de clientes, registra sus datos y haz seguimiento de su historial de compras para una atención más personalizada.</p>
            <a href="<?= APP_URL ?>/login" class="feature-link">Ver demo →</a>
        </div>
    </div>
</section>

<footer class="home-footer">
    <span class="footer-logo">🧊 Curichis</span>
    <span>© 2026 Todos los derechos reservados.</span>
</footer>

<script src="<?= APP_URL ?>/js/app.js"></script>
</body>
</html>
