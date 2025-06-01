<?php
// No necesitamos session_start() aquí porque se hace en header.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Andrew Camisetas de Fútbol</title>

  <!-- CSS principal -->
  <link rel="stylesheet" href="styles.css" />
  <!-- FontAwesome para íconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <!-- AOS para animaciones -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
</head>

<body>

  <!-- ✅ HEADER centralizado -->
  <?php include 'header.php'; ?>

  <!-- HERO / BANNER -->
  <section class="hero" data-aos="fade-up">
    <div class="hero-content">
      <h1>La mejor selección de camisetas de fútbol</h1>
      <p>Calidad, estilo y pasión en cada prenda</p>
      <a href="productos.php" class="btn-primary">Compra Ahora</a>
    </div>
  </section>

  <main class="main-content">

    <!-- NUEVAS LLEGADAS -->
    <section class="nuevas-llegadas" data-aos="fade-right">
      <h2>Nuevas Llegadas</h2>
      <div class="cards-container">
        <div class="card-product">
          <img src="images/real_madrid.png" alt="Camiseta Temporada 2025" />
          <h3>Camiseta Temporada 2025</h3>
          <p class="price">S/ 130.00</p>
          <a href="#" class="btn-secondary">Ver detalles</a>
        </div>
        <div class="card-product">
          <img src="images/foto1.png" alt="Camiseta Edición Especial" />
          <h3>Camiseta Edición Especial</h3>
          <p class="price">S/ 150.00</p>
          <a href="#" class="btn-secondary">Ver detalles</a>
        </div>
        <div class="card-product">
          <img src="images/foto3.png" alt="Camisetas futbol Retro" />
          <h3>Camiseta Futbol Retro</h3>
          <p class="price">S/ 115.00</p>
          <a href="#" class="btn-secondary">Ver detalles</a>
        </div>
      </div>
    </section>

    <!-- PRODUCTOS DESTACADOS -->
    <section class="productos-destacados" data-aos="fade-left">
      <h2>Productos Destacados</h2>
      <div class="cards-container destacados">
        <div class="card-product small">
          <img src="images/Polo_Modelo20/Polo_modelo20.png" alt="Camiseta Bayern" />
          <h3>Camiseta Bayern de Múnich</h3>
          <p class="price">S/ 110.00</p>
          <a href="camiseta1.php" class="btn-secondary">Ver detalles</a>
        </div>
        <div class="card-product small">
          <img src="images/Polo_modelo1/polo_modelo1.png" alt="Real Madrid" />
          <h3>Camiseta Real Madrid</h3>
          <p class="price">S/ 95.00</p>
          <a href="camiseta2.html" class="btn-secondary">Ver detalles</a>
        </div>
        <div class="card-product small">
          <img src="images/Polo_modelo2/polo_modelo2.png" alt="Barcelona" />
          <h3>Camiseta Barcelona</h3>
          <p class="price">S/ 120.00</p>
          <a href="camiseta3.html" class="btn-secondary">Ver detalles</a>
        </div>
        <div class="card-product small">
          <img src="images/Polo_modelo4/polo_modelo4.png" alt="Liverpool" />
          <h3>Camiseta Liverpool</h3>
          <p class="price">S/ 105.00</p>
          <a href="camiseta4.html" class="btn-secondary">Ver detalles</a>
        </div>
      </div>
    </section>

    <!-- PROMOCIONES -->
    <section class="promociones" data-aos="zoom-in">
      <h2>Promociones Exclusivas</h2>
      <p>Aprovecha descuentos especiales en packs por tiempo limitado.</p>
      <a href="productos.php" class="btn-primary">Ver promociones</a>
    </section>

    <!-- OFERTA FLASH CON COUNTDOWN -->
    <section class="oferta-flash" data-aos="fade-up">
      <h2>Oferta Flash: ¡Solo por tiempo limitado!</h2>
      <p>Consigue descuentos antes que termine el tiempo.</p>
      <div id="countdown">00:00:00</div>
      <a href="productos.php" class="btn-countdown">¡Compra ya!</a>
    </section>

    <!-- CATEGORÍAS -->
    <section class="categorias-interactivas" data-aos="fade-right">
      <h2>Compra por Categorías</h2>
      <div class="categorias-container">
        <div class="categoria-card">
          <img src="images/camiseta-fan.png" alt="Camisetas Fan" />
          <div class="categoria-label">Camisetas Fan</div>
        </div>
        <div class="categoria-card">
          <img src="images/camiseta-jugador.png" alt="Camisetas Jugador" />
          <div class="categoria-label">Camisetas Jugador</div>
        </div>
        <div class="categoria-card">
          <img src="images/llaveros.png" alt="Llaveros" />
          <div class="categoria-label">Llaveros</div>
        </div>
      </div>
    </section>

    <!-- GALERÍA CLIENTES -->
    <section class="galeria-clientes" data-aos="fade-up">
      <h2>Galería de Clientes</h2>
      <div class="galeria-container">
        <img src="images/cliente1.png" alt="Cliente 1" />
        <img src="images/cliente2.png" alt="Cliente 2" />
        <img src="images/cliente3.png" alt="Cliente 3" />
        <img src="images/cliente4.png" alt="Cliente 4" />
      </div>
    </section>

    <!-- PREGUNTAS FRECUENTES -->
    <section class="faq" data-aos="fade-left">
      <h2>Preguntas Frecuentes</h2>
      <div class="faq-container">
        <details>
          <summary>¿Cuáles son las opciones de envío?</summary>
          <p>Envíos gratis desde 2 camisetas. Delivery rápido a todo el Perú.</p>
        </details>
        <details>
          <summary>¿Cómo puedo devolver un producto?</summary>
          <p>Hasta 30 días con empaque original. Ver términos en nuestra política de devoluciones.</p>
        </details>
        <details>
          <summary>¿Las camisetas son oficiales?</summary>
          <p>Sí. Todos nuestros productos son oficiales, importados y con garantía.</p>
        </details>
      </div>
    </section>

    <!-- BLOG -->
    <section class="blog" data-aos="fade-up">
  <h2>Noticias & Tips</h2>
  <div class="cards-container blog-container">

    <!-- Noticia 1: PSG gana su primera Champions League -->
    <article class="blog-item">
      <img src="images/psg_champions.png" alt="PSG gana la Champions League" />
      <div class="blog-content">
        <h3>PSG conquista su primera Champions League</h3>
        <p>El Paris Saint-Germain logró su primer título europeo al vencer 5-0 al Inter de Milán en la final de la Champions League 2025.</p>
        <a href="https://www.aljazeera.com/sports/2025/5/31/psg-beat-inter-milan-to-lift-champions-league-football-doue-paris-saint-germain" target="_blank">Leer más</a>
      </div>
    </article>

    <!-- Noticia 2: Désiré Doué, figura destacada en la final -->
    <article class="blog-item">
      <img src="images/doue_figura.png" alt="Désiré Doué destacado en la final" />
      <div class="blog-content">
        <h3>Désiré Doué brilla en la final de la Champions</h3>
        <p>El joven de 19 años anotó dos goles y dio una asistencia, siendo clave en la histórica victoria del PSG.</p>
        <a href="https://www.goal.com/en-us/lists/desire-doue-makes-history-matches-cristiano-ronaldo-record-psg-sensational-champions-league-final-against-inter/blt368e74b5c4045ce9" target="_blank">Leer más</a>
      </div>
    </article>

    <!-- Noticia 3: PSG completa el triplete en la temporada -->
    <article class="blog-item">
    <img src="images/xabi_alonso_real.png" alt="Xabi Alonso nuevo DT del Real Madrid" />
    <div class="blog-content">
    <h3>Real Madrid ficha a Xabi Alonso como DT</h3>
    <p>El exjugador blanco Xabi Alonso regresa a casa para liderar al Real Madrid como nuevo entrenador para la temporada 2025-2026.</p>
    <a href="https://www.realmadrid.com/es-ES/noticias/futbol/primer-equipo/actualidad/acto-de-presentacion-de-xabi-alonso-26-05-2025" target="_blank">Leer más</a>
    </div>
    </article>

     </div>
    </section>


    <!-- NEWSLETTER -->
    <section class="newsletter" data-aos="zoom-in">
      <h2>Suscríbete y recibe ofertas exclusivas</h2>
      <form>
        <input type="email" placeholder="Tu correo electrónico" required />
        <button type="submit">Suscribirme</button>
      </form>
    </section>
  </main>

  <!-- WHATSAPP FLOTANTE -->
  <a href="https://wa.me/51963345510" target="_blank" class="btn-whatsapp">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- BOTÓN IR ARRIBA -->
  <button id="btnScrollTop" title="Ir arriba" class="btn-scroll-top">
    <i class="fas fa-arrow-up"></i>
  </button>

  <!-- FOOTER -->
  <footer class="footer">
    <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
    <div class="social-icons">
      <a href="https://wa.me/963345510" target="_blank"><i class="fab fa-whatsapp"></i></a>
      <a href="https://www.facebook.com/tu_usuario" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/tu_usuario" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
  </footer>

  <!-- JS ANIMACIONES Y COMPORTAMIENTO -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });

    const btnScrollTop = document.getElementById('btnScrollTop');
    window.addEventListener('scroll', () => {
      btnScrollTop.style.display = window.scrollY > 300 ? 'block' : 'none';
    });
    btnScrollTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    function startCountdown(durationSeconds) {
      const countdownElement = document.getElementById('countdown');
      let timeLeft = durationSeconds;
      const interval = setInterval(() => {
        if (timeLeft <= 0) {
          clearInterval(interval);
          countdownElement.textContent = '00:00:00';
          return;
        }
        const hours = Math.floor(timeLeft / 3600);
        const minutes = Math.floor((timeLeft % 3600) / 60);
        const seconds = timeLeft % 60;
        countdownElement.textContent =
          `${hours.toString().padStart(2, '0')}:` +
          `${minutes.toString().padStart(2, '0')}:` +
          `${seconds.toString().padStart(2, '0')}`;
        timeLeft--;
      }, 1000);
    }

    startCountdown(3600); // 1 hora
  </script>

  <script src="main.js"></script>
</body>
</html>
