<?php
// producto_detalle.php

// 1. Configuración conexión base datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "andrew_camisetas_de_futbol";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// 2. Obtener ID del producto desde URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Consulta producto por ID
$sql = "SELECT * FROM productos WHERE id = $id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Producto no encontrado.";
    exit;
}
$producto = $result->fetch_assoc();

// 4. Preparar array de imágenes (principal + miniaturas)
$imagenes = [];
$basePath = "images/Polo_Modelo" . $producto['id'] . "/";
$imagenes[] = $basePath . $producto['imagen']; // Imagen principal

for ($i = 1; $i <= 6; $i++) {
    $ruta = $basePath . pathinfo($producto['imagen'], PATHINFO_FILENAME) . ".$i.png";
    if (file_exists($ruta)) {
        $imagenes[] = $ruta;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($producto['nombre']); ?></title>

  <!-- CSS principal y específico -->
  <link rel="stylesheet" href="camiseta1.css"/>
  <!-- FontAwesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <!-- Favicon -->
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<!-- Sección detalle producto -->
<section class="producto-detalle">

  <!-- Galería miniaturas -->
  <div class="producto-galeria">
    <?php foreach ($imagenes as $index => $img) : ?>
      <img 
        src="<?php echo htmlspecialchars($img); ?>" 
        alt="Miniatura <?php echo $index + 1; ?>" 
        class="miniatura <?php echo ($index === 0) ? 'selected' : ''; ?>" 
        onclick="actualizarImagen(<?php echo $index; ?>)" 
      />
    <?php endforeach; ?>
  </div>

  <!-- Imagen principal -->
  <div class="imagen-principal-container">
    <img 
      id="imagenPrincipal" 
      src="<?php echo htmlspecialchars($imagenes[0]); ?>" 
      alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
      class="imagen-principal" 
    />
  </div>

  <!-- Info producto -->
  <div class="producto-info">
    <h2 class="titulo-producto"><?php echo strtoupper(htmlspecialchars($producto['nombre'])); ?></h2>
    <p class="subtitulo">Temporada <?php echo htmlspecialchars($producto['descripcion']); ?></p>

    <div class="ficha-tecnica">
      <div><span>Equipo:</span> <?php echo htmlspecialchars($producto['equipo'] ?? 'No disponible'); ?></div>
      <div><span>Versión:</span> <?php echo htmlspecialchars($producto['version'] ?? 'No disponible'); ?></div>
      <div><span>Temporada:</span> <?php echo htmlspecialchars($producto['descripcion']); ?></div>
      <div><span>Entrega:</span> <?php echo htmlspecialchars($producto['entrega'] ?? 'No disponible'); ?></div>
    </div>

    <!-- Selector de tallas -->
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

    <!-- Personalización -->
    <form class="form-personalizacion" id="formAgregarCarrito" onsubmit="return enviarCarrito(event)">
      <div class="inputs-nombre-numero">
        <div class="campo-input">
          <label for="nombre">Nombre del jugador:</label>
          <input type="text" id="nombre" name="nombre" placeholder="Ejemplo: Müller" />
        </div>
        <div class="campo-input">
          <label for="numero">Número:</label>
          <input type="text" id="numero" name="numero" placeholder="Ejemplo: 25" />
        </div>
      </div>

      <!-- Cantidad -->
      <div class="cantidad-container">
        <button type="button" class="btn-cantidad" onclick="cambiarCantidad(-1)">−</button>
        <input type="text" id="cantidad" name="cantidad" class="input-cantidad" value="1" readonly />
        <button type="button" class="btn-cantidad" onclick="cambiarCantidad(1)">+</button>
      </div>
      <span class="nota-cantidad">Máximo 10 unidades.</span>

      <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>" />
      <input type="hidden" id="tallaSeleccionada" name="talla" value="" />

      <button type="submit" class="btn-carrito">Agregar al Carrito</button>
    </form>
  </div>

</section>

<!-- SECCIÓN COMENTARIOS -->
<section class="comentarios-producto">
  <h3>Comentarios de este producto</h3>
  
  <!-- Calificación general -->
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

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- JS -->
<script>
  // Cambiar cantidad (botones + y -)
  function cambiarCantidad(cambio) {
    const inputCantidad = document.getElementById('cantidad');
    let cantidad = parseInt(inputCantidad.value);
    cantidad += cambio;
    if (cantidad < 1) cantidad = 1;
    if (cantidad > 10) cantidad = 10;
    inputCantidad.value = cantidad;
  }

  // Seleccionar talla
  function seleccionarTalla(boton) {
    const botones = document.querySelectorAll('.btn-talla');
    botones.forEach(btn => btn.classList.remove('selected'));

    boton.classList.add('selected');
    document.getElementById('tallaSeleccionada').value = boton.textContent;
  }

  // Cambiar imagen principal (al hacer clic en miniaturas)
  function actualizarImagen(index) {
    const miniaturas = document.querySelectorAll('.producto-galeria .miniatura');
    const imagenPrincipal = document.getElementById('imagenPrincipal');

    if (index < 0) index = miniaturas.length - 1;
    if (index >= miniaturas.length) index = 0;

    imagenPrincipal.src = miniaturas[index].src;

    miniaturas.forEach((mini, i) => {
      mini.classList.toggle('selected', i === index);
    });
  }

  // Validar y enviar formulario vía AJAX para agregar al carrito
  async function enviarCarrito(event) {
    event.preventDefault();

    // Validar campos
    const talla = document.getElementById('tallaSeleccionada').value;
    const nombre = document.getElementById('nombre').value.trim();
    const numero = document.getElementById('numero').value.trim();
    const cantidad = document.getElementById('cantidad').value;

    if (!talla) {
      alert('Por favor, selecciona una talla.');
      return false;
    }
    if (!nombre) {
      alert('Por favor, ingresa el nombre del jugador.');
      return false;
    }
    if (!numero) {
      alert('Por favor, ingresa el número del jugador.');
      return false;
    }

    // Preparar datos para enviar
    const formData = new FormData();
    formData.append('producto_id', <?php echo $producto['id']; ?>);
    formData.append('cantidad', cantidad);
    formData.append('talla', talla);
    formData.append('nombre_jugador', nombre);
    formData.append('numero_jugador', numero);

    try {
      // Enviar datos al backend (agregar_carrito.php)
      const response = await fetch('agregar_carrito.php', {
        method: 'POST',
        body: formData
      });

      const data = await response.json();

      if (data.success) {
        alert(data.message); // Aquí puedes reemplazar con una notificación más amigable
        // Aquí puedes agregar lógica para actualizar el carrito lateral si tienes
      } else {
        alert('Error: ' + data.message);
      }
    } catch (error) {
      alert('Error al comunicarse con el servidor.');
      console.error(error);
    }
  }
</script>

<?php $conn->close(); ?>
</body>
</html>
