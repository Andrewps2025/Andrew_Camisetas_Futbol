<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Camiseta Bayern Munich</title>

  <!-- CSS principal y específico para producto -->
  <link rel="stylesheet" href="camiseta1.css"/>
  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <!-- Favicon -->
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
</head>

<body>
  <!-- Incluye el header general con logo y menú -->
  <?php include 'header.php'; ?>

  <!-- SECCIÓN: Detalle del Producto -->
  <section class="producto-detalle">
    <!-- Galería de miniaturas -->
    <div class="producto-galeria">
      <img src="images/Polo_Modelo20/Polo_modelo20.png" alt="Miniatura 1" onclick="changeImage(this)" class="selected"/>
      <img src="images/Polo_Modelo20/Polo_modelo20.1.png" alt="Miniatura 2" onclick="changeImage(this)"/>
      <img src="images/Polo_Modelo20/Polo_modelo20.2.png" alt="Miniatura 3" onclick="changeImage(this)"/>
      <img src="images/Polo_Modelo20/Polo_modelo20.3.png" alt="Miniatura 4" onclick="changeImage(this)"/>
      <img src="images/Polo_Modelo20/Polo_modelo20.4.png" alt="Miniatura 5" onclick="changeImage(this)"/>
      <img src="images/Polo_Modelo20/Polo_modelo20.5.png" alt="Miniatura 6" onclick="changeImage(this)"/>
    </div>

    <!-- Imagen Principal -->
    <div class="imagen-principal-container">
      <img id="imagenPrincipal" src="images/Polo_Modelo20/Polo_modelo20.png" alt="Imagen Principal" class="imagen-principal" onclick="openModal()" />
    </div>

    <!-- Información del Producto -->
    <div class="producto-info">
      <h2 class="titulo-producto">Camiseta Bayern Munich</h2>
      <p class="subtitulo">Temporada 2014/2015</p>

      <!-- Detalles Técnicos -->
      <div class="ficha-tecnica">
        <div><span>Equipo:</span> Bayern Munich</div>
        <div><span>Versión:</span> Jugador Pro</div>
        <div><span>Temporada:</span> 14/15</div>
        <div><span>Entrega:</span> 4 - 7 días</div>
      </div>

      <!-- Selección de tallas -->
      <div>
        <label class="etiqueta-talla">Selecciona tu talla:</label>
        <div class="botones-tallas" id="botonesTallas">
          <button type="button" class="btn-talla" onclick="seleccionarTalla(this)">XS</button>
          <button type="button" class="btn-talla" onclick="seleccionarTalla(this)">S</button>
          <button type="button" class="btn-talla" onclick="seleccionarTalla(this)">M</button>
          <button type="button" class="btn-talla" onclick="seleccionarTalla(this)">L</button>
          <button type="button" class="btn-talla" onclick="seleccionarTalla(this)">XL</button>
        </div>
      </div>

      <!-- Formulario para personalización -->
      <form class="form-personalizacion">
        <div class="inputs-nombre-numero">
          <div class="campo-input">
            <label for="nombre">Nombre del jugador:</label>
            <input type="text" id="nombre" placeholder="Ejemplo: Müller" />
          </div>
          <div class="campo-input">
            <label for="numero">Número:</label>
            <input type="text" id="numero" placeholder="Ejemplo: 25" />
          </div>
        </div>
      </form>

      <!-- Botón para abrir modal de guía de tallas -->
      <div class="guia-talla">
        <button onclick="document.getElementById('modalTalla').style.display='block'">
          <i class="fas fa-ruler-combined"></i> Ver guía de tallas
        </button>
      </div>

      <!-- Modal guía de tallas -->
      <div id="modalTalla" class="modal-talla">
        <div class="modal-contenido">
          <span onclick="document.getElementById('modalTalla').style.display='none'">&times;</span>
          <img src="images/tabla_tallas.png" alt="Tabla de tallas">
        </div>
      </div>

      <!-- Servicios adicionales -->
      <div class="detalle-servicios">
        <div class="servicio"><i class="fa fa-truck"></i><br/>Envío<br/>Rápido</div>
        <div class="servicio"><i class="fa fa-store"></i><br/>Recojo en<br/>Tienda</div>
        <div class="servicio"><i class="fa fa-check-circle"></i><br/>Garantía<br/>Original</div>
      </div>
    </div>

    <!-- Bloque de Precio y control de cantidad -->
    <div class="bloque-precio">
      <div class="precio-descuento">
        <h2>S/ 120.00</h2>
        <span class="descuento">-25%</span>
      </div>
      <p class="precio-anterior">S/ 159.90</p>

      <!-- Controles de cantidad -->
      <div class="cantidad-container">
        <button type="button" class="btn-cantidad" onclick="cambiarCantidad(-1)">−</button>
        <input type="text" id="cantidad" name="cantidad" class="input-cantidad" value="1" readonly>
        <button type="button" class="btn-cantidad" onclick="cambiarCantidad(1)">+</button>
      </div>
      <span class="nota-cantidad">Máximo 10 unidades.</span>

      <!-- Formulario para agregar al carrito -->
      <form id="formAgregarcarrito" method="POST">
        <input type="hidden" name="producto_id" value="1">
        <input type="hidden" name="cantidad" id="cantidadInputHidden" value="1">

        <!-- input oculto para talla -->
        <input type="hidden" name="talla" id="tallaSeleccionada" value="">

        <button type="submit" class="btn-carrito">Agregar al Carrito</button>
      </form>
    </div>
  </section>

  <!-- SECCIÓN: Comentarios del Producto -->
  <section class="comentarios-producto">
    <h3>Comentarios de este producto</h3>
    <div class="calificacion-general">
      <div class="puntaje">4.5/5</div>
      <div class="estrellas">
        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
      </div>
      <div class="total-comentarios">25 comentarios</div>
    </div>

    <!-- Barras de puntuación -->
    <div class="barras-puntuacion">
      <div class="barra">
        <span>5 <i class="fas fa-star"></i></span>
        <progress value="19" max="25"></progress>
      </div>
      <div class="barra">
        <span>4 <i class="fas fa-star"></i></span>
        <progress value="2" max="25"></progress>
      </div>
      <div class="barra">
        <span>3 <i class="fas fa-star"></i></span>
        <progress value="1" max="25"></progress>
      </div>
      <div class="barra">
        <span>2 <i class="fas fa-star"></i></span>
        <progress value="3" max="25"></progress>
      </div>
      <div class="barra">
        <span>1 <i class="fas fa-star"></i></span>
        <progress value="0" max="25"></progress>
      </div>
    </div>

    <!-- Lista de comentarios -->
    <div class="lista-comentarios">
      <div class="comentario">
        <div class="comentario-header">
          <span class="nombre">Miryan</span>
          <span class="fecha">hace 2 semanas</span>
          <span class="estrellas">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </span>
        </div>
        <p>1 persona encuentra útil este comentario.</p>
      </div>

      <div class="comentario">
        <div class="comentario-header">
          <span class="nombre">Sussan</span>
          <span class="fecha">hace 1 mes</span>
          <span class="estrellas">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </span>
        </div>
      </div>

      <div class="comentario">
        <div class="comentario-header">
          <span class="nombre">MATERIAL CÓMODO</span><br/>
          <span class="autor">por CAMILA ARISMENDI PALMA</span>
          <span class="fecha">hace 1 mes</span>
          <span class="estrellas">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </span>
        </div>
        <p>ES UN PRODUCTO DE BUEN MATERIAL, NO SE PERCUDE, NO REQUIERE MAYORES CUIDADOS AL MOMENTO DE LAVAR, ECONÓMICA Y ATEMPORAL</p>
        <small>Publicado originalmente en falabella.com</small>
      </div>
    </div>
  </section>

  <!-- FOOTER GENERAL -->
  <footer>
    <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
  </footer>

  <!-- ======= CARRITO LATERAL ======= -->
  <aside id="carritoLateral" class="carrito-lateral">
    <div class="carrito-header">
      <h3>Mi Carrito</h3>
      <button id="btnCerrarCarrito" class="btn-cerrar">&times;</button>
    </div>
    <div id="productosCarrito" class="productos-carrito">
      <!-- Aquí se insertan los productos agregados -->
    </div>
    <div class="carrito-footer">
      <div class="barra-envio">
        <div class="barra-progreso">
          <div id="barraFill" class="barra-fill"></div>
        </div>
        <p id="textoEnvioGratis">¡Solo te falta S/ 100.00 para un envío gratis!</p>
      </div>
      <div class="totales">
        <div><strong>Subtotal:</strong> <span id="subtotalCarrito">S/ 0.00</span></div>
        <div><strong>Descuento:</strong> <span id="descuentosCarrito">- S/ 0.00</span></div>
      </div>
      <a href="ver_carrito.php" class="btn-comprar">Comprar</a>
    </div>
  </aside>

  <!-- Vincula tu archivo de scripts externos -->
  <script>

const images = [
  "images/Polo_Modelo20/Polo_modelo20.png",
  "images/Polo_Modelo20/Polo_modelo20.1.png",
  "images/Polo_Modelo20/Polo_modelo20.2.png",
  "images/Polo_Modelo20/Polo_modelo20.3.png",
  "images/Polo_Modelo20/Polo_modelo20.4.png",
  "images/Polo_Modelo20/Polo_modelo20.5.png"
];

// Variables para controlar la imagen en el modal y la interacción de zoom/arrastre
let currentImageIndex = 0;
let offsetX = 0, offsetY = 0, scale = 1;
let isDragging = false;

// ===========================
// Cambiar imagen principal al hacer clic en miniatura
// ===========================
function changeImage(miniatura) {
  document.getElementById('imagenPrincipal').src = miniatura.src;
  currentImageIndex = images.findIndex(img => miniatura.src.includes(img));
  if(currentImageIndex === -1) currentImageIndex = 0;
}

// ===========================
// Abrir modal para imagen ampliada con zoom y arrastre
// ===========================
function openModal() {
  const modal = document.createElement('div');
  modal.classList.add('modal');

  modal.innerHTML = `
    <div class="modal-content" style="position: relative; max-width: 100vw; max-height: 100vh; overflow: auto;">
      <img src="${images[currentImageIndex]}" id="modalImagen" style="cursor: grab; user-select:none;">
    </div>
    <span id="cerrarModal" class="cerrar" 
          style="position: absolute; top: 30px; right: 20px; font-size: 35px; cursor: pointer; color: white;">&times;</span>
  `;

  document.body.appendChild(modal);
  document.body.style.overflow = 'hidden';

  const zoomImage = document.getElementById('modalImagen');

  // Zoom con rueda del mouse
  zoomImage.addEventListener('wheel', function(event) {
    event.preventDefault();
    scale += event.deltaY < 0 ? 0.1 : -0.1;
    if (scale < 1) scale = 1;
    zoomImage.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(${scale})`;
  });

  // Arrastrar imagen con mouse
  zoomImage.addEventListener('mousedown', function (event) {
    isDragging = true;
    const startX = event.clientX - offsetX;
    const startY = event.clientY - offsetY;
    document.body.style.cursor = 'grabbing';

    function dragMove(e) {
      if (isDragging) {
        offsetX = e.clientX - startX;
        offsetY = e.clientY - startY;
        zoomImage.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(${scale})`;
      }
    }

    function stopDrag() {
      isDragging = false;
      document.removeEventListener('mousemove', dragMove);
      document.removeEventListener('mouseup', stopDrag);
      document.body.style.cursor = 'default';
    }

    document.addEventListener('mousemove', dragMove);
    document.addEventListener('mouseup', stopDrag);
  });

  // Cerrar modal con "X"
  document.getElementById('cerrarModal').addEventListener('click', closeModal);
}

// ===========================
// Cerrar modal y resetear transformaciones
// ===========================
function closeModal() {
  const modal = document.querySelector('.modal');
  if (modal) modal.remove();
  document.body.style.overflow = 'auto';
  offsetX = 0;
  offsetY = 0;
  scale = 1;
}

// ===========================
// Cerrar modal con tecla ESC
// ===========================
document.addEventListener('keydown', function (event) {
  if (event.key === "Escape") closeModal();
});

// ===========================
// Cambiar imagen principal con flechas (si existen)
// ===========================
window.addEventListener("DOMContentLoaded", function () {
  const flechaIzquierda = document.getElementById('flechaIzquierda');
  const flechaDerecha = document.getElementById('flechaDerecha');
  if (flechaIzquierda && flechaDerecha) {
    flechaIzquierda.addEventListener('click', () => cambiarImagenPrincipal(-1));
    flechaDerecha.addEventListener('click', () => cambiarImagenPrincipal(1));
  }
});

// ===========================
// Cambiar imagen principal con flechas
// ===========================
function cambiarImagenPrincipal(direccion) {
  currentImageIndex += direccion;
  if (currentImageIndex < 0) currentImageIndex = images.length - 1;
  if (currentImageIndex >= images.length) currentImageIndex = 0;
  document.getElementById('imagenPrincipal').src = images[currentImageIndex];
}

// ===========================
// Cambiar cantidad (+ y -)
// ===========================
function cambiarCantidad(valor) {
  const input = document.getElementById("cantidad");
  const hiddenInput = document.getElementById("cantidadInputHidden");
  let cantidad = parseInt(input.value);

  if (isNaN(cantidad)) cantidad = 1;
  cantidad += valor;
  if (cantidad < 1) cantidad = 1;
  if (cantidad > 10) cantidad = 10;

  input.value = cantidad;
  if (hiddenInput) hiddenInput.value = cantidad;
}

// ===========================
// Agregar producto al carrito con AJAX y mostrar panel lateral sin recarga y sin mensaje confirmación
// ===========================
document.addEventListener("DOMContentLoaded", function () {
  const formAgregar = document.getElementById("formAgregarcarrito");
  const carrito = document.getElementById("carritoLateral");
  const productos = document.getElementById("productosCarrito");
  const subtotal = document.getElementById("subtotalCarrito");
  const descuento = document.getElementById("descuentosCarrito");
  const envioGratis = document.getElementById("textoEnvioGratis");
  const btnCerrarCarrito = document.getElementById("btnCerrarCarrito");
  const btnComprar = document.querySelector('.btn-comprar'); // Botón comprar

  // Validar existencia
  if (!formAgregar) {
    console.error("No se encontró el formulario con id 'formAgregarcarrito'");
    return;
  }
  if (!carrito) {
    console.error("No se encontró el carrito lateral con id 'carritoLateral'");
    return;
  }

  // Cerrar carrito con botón
  if (btnCerrarCarrito) {
    btnCerrarCarrito.addEventListener("click", () => {
      carrito.classList.remove("abierto");
    });
  }

  // Enviar formulario con AJAX evitando recarga y mensaje de confirmación
  formAgregar.addEventListener("submit", function(event) {
    event.preventDefault(); // Evita envío tradicional y recarga

    const formData = new FormData(formAgregar);

    fetch("agregar_carrito.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        carrito.classList.add("abierto"); // Mostrar carrito

        const cantidad = formData.get("cantidad");
        productos.innerHTML = `
          <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
            <img src="images/Polo_Modelo20/Polo_modelo20.png" alt="Camiseta" style="width: 60px; height: 60px; object-fit: contain; border-radius: 6px; border: 1px solid #ccc;">
            <div>
              <p style="margin: 0; font-weight: 700;">Camiseta Bayern Munich</p>
              <p style="margin: 0; color: #555;">S/ 120.00</p>
              <p style="margin: 0; color: #555;">Cantidad: ${cantidad}</p>
            </div>
          </div>
        `;

        subtotal.textContent = `S/ ${120 * cantidad}.00`;
        descuento.textContent = "- S/ 0.00";
        envioGratis.textContent = "¡Solo te falta S/ 100.00 para un envío gratis!";

        // Limpia el historial para evitar confirmación de reenvío
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }

      } else {
        alert("Error al agregar al carrito: " + data.message);
      }
    })
    .catch(error => {
      alert("Error de conexión: " + error.message);
    });
  });

  // ===========================
  // Redirigir al hacer click en el botón Comprar
  // ===========================
  if (btnComprar) {
    btnComprar.addEventListener('click', () => {
      window.location.href = 'ver_carrito.php';
    });
  }
});

// ===========================
// Variable global para guardar la talla seleccionada
// ===========================
let tallaSeleccionada = '';

// ===========================
// Función para seleccionar talla y actualizar visualmente
// ===========================
function seleccionarTalla(boton) {
  // Quitar clase 'selected' a todos los botones de talla
  const botones = document.querySelectorAll('.btn-talla');
  botones.forEach(b => b.classList.remove('selected'));

  // Agregar clase 'selected' al botón clickeado
  boton.classList.add('selected');

  // Guardar la talla seleccionada en variable y en input oculto (si existe)
  tallaSeleccionada = boton.textContent.trim();
  const inputTalla = document.getElementById('tallaSeleccionada');
  if (inputTalla) inputTalla.value = tallaSeleccionada;
}
</script>

</body>
</html>
