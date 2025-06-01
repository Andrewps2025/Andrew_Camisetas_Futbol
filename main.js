// main.js - Funciones para mejorar la experiencia en la página principal

// ========== 1. CONTADOR REGRESIVO PARA OFERTA FLASH ==========
function setupCountdown(endTimeStr, elementId) {
  const countdownEl = document.getElementById(elementId);
  if (!countdownEl) return;

  const endTime = new Date(endTimeStr).getTime();

  function updateCountdown() {
    const now = new Date().getTime();
    const distance = endTime - now;

    if (distance < 0) {
      countdownEl.textContent = "00:00:00";
      clearInterval(intervalId);
      return;
    }

    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    countdownEl.textContent = 
      `${hours.toString().padStart(2, "0")}:` +
      `${minutes.toString().padStart(2, "0")}:` +
      `${seconds.toString().padStart(2, "0")}`;
  }

  updateCountdown();
  const intervalId = setInterval(updateCountdown, 1000);
}

// Llamar al contador con fecha límite ejemplo (cambia la fecha a cuando quieras que termine)
setupCountdown("2025-12-31T23:59:59", "countdown");


// ========== 2. BOTÓN "IR ARRIBA" ==========
const btnScrollTop = document.getElementById("btnScrollTop");
if (btnScrollTop) {
  // Mostrar botón cuando se hace scroll hacia abajo
  window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
      btnScrollTop.style.display = "block";
    } else {
      btnScrollTop.style.display = "none";
    }
  });

  // Al hacer click, se mueve suavemente hacia arriba
  btnScrollTop.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}


// ========== 3. ANIMACIONES AL HACER SCROLL (AOS) ==========
// Nota: para que funcione debes incluir las librerías AOS en tu HTML
// <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
// <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

if (window.AOS) {
  window.addEventListener("load", () => {
    AOS.init({
      duration: 800,         // Duración de la animación
      easing: "ease-in-out", // Suavizado
      once: true,            // Animar solo una vez
      mirror: false,         // No animar cuando se hace scroll hacia arriba
    });
  });
}


// ========== 4. EFECTOS DE HOVER EN CATEGORÍAS INTERACTIVAS ==========
const categoriaCards = document.querySelectorAll(".categoria-card");
categoriaCards.forEach(card => {
  card.addEventListener("mouseenter", () => {
    card.style.transform = "scale(1.05)";
    card.style.boxShadow = "0 8px 25px rgba(0,0,0,0.2)";
  });
  card.addEventListener("mouseleave", () => {
    card.style.transform = "scale(1)";
    card.style.boxShadow = "0 3px 15px rgba(0,0,0,0.1)";
  });
});


// ========== 5. CARRUSEL SIMPLE AUTOMÁTICO PARA PRODUCTOS DESTACADOS ==========
// Asume que tienes un contenedor con clase 'carousel-container' y cada producto con clase 'carousel-item'
function setupAutoCarousel(containerSelector, interval = 4000) {
  const container = document.querySelector(containerSelector);
  if (!container) return;

  let index = 0;
  const items = container.querySelectorAll(".carousel-item");
  const total = items.length;

  if (total <= 1) return; // No rotar si solo hay 1 o ninguno

  function showItem(i) {
    items.forEach((item, idx) => {
      item.style.display = idx === i ? "block" : "none";
    });
  }

  showItem(index);

  setInterval(() => {
    index = (index + 1) % total;
    showItem(index);
  }, interval);
}

// Llama a setupAutoCarousel con el selector adecuado cuando el DOM esté listo
window.addEventListener("DOMContentLoaded", () => {
  setupAutoCarousel(".productos-destacados > div", 5000); // Cambia el selector según tu HTML
});

// === ABRIR / CERRAR CARRITO LATERAL ===
document.addEventListener("DOMContentLoaded", function () {
  const btnAbrirCarrito = document.getElementById("abrirCarrito") || document.querySelector("a[href='#carrito']");
  const panelCarrito = document.getElementById("carritoLateral");
  const cerrarBtn = document.getElementById("cerrarCarrito");

  if (btnAbrirCarrito && panelCarrito && cerrarBtn) {
    btnAbrirCarrito.addEventListener("click", function (e) {
      e.preventDefault();
      panelCarrito.style.display = "block";
    });

    cerrarBtn.addEventListener("click", function () {
      panelCarrito.style.display = "none";
    });
  }
});
