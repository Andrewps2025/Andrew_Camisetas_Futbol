<!-- footer.php -->
<footer style="background-color: #003366; color: white; text-align: center; padding: 20px;">
  <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
</footer>

<!-- ==== PANEL FLOTANTE CARRITO (tipo Miniso) ==== -->
<div id="carritoLateral" class="modal-carrito" style="display: none; position: fixed; top: 0; right: 0; width: 360px; height: 100vh; background: white; box-shadow: -4px 0 12px rgba(0,0,0,0.2); z-index: 10000; overflow-y: auto; font-family: Arial, sans-serif;">
  <!-- Encabezado del carrito -->
  <div style="padding: 15px; background: #003366; color: white; display: flex; justify-content: space-between; align-items: center;">
    <h2 style="font-weight: 600; font-size: 18px; margin: 0;">Mi bolsa</h2>
    <button id="cerrarCarrito" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
  </div>

  <!-- Productos -->
  <div id="productosCarrito" style="padding: 15px;">
    <!-- Se insertan con JavaScript -->
  </div>

  <!-- Totales -->
  <div style="padding: 15px; border-top: 1px solid #ccc; font-size: 14px;">
    <div id="infoEnvioGratis" style="margin-bottom: 10px; font-weight: 600; color: #e60023;">
      ¡Solo te falta S/ 150.00 para un envío gratis!
    </div>
    <div style="display: flex; justify-content: space-between;">
      <span>Subtotal</span>
      <span id="subtotalCarrito">S/ 0.00</span>
    </div>
    <div style="display: flex; justify-content: space-between;">
      <span>Descuentos</span>
      <span id="descuentosCarrito">S/ 0.00</span>
    </div>
    <p style="margin-top: 10px; font-size: 12px; color: #666;">
      Los gastos de envío serán calculados antes de finalizar tu compra.
    </p>
    <button id="btnComprarCarrito" style="width: 100%; background: #ff597b; border: none; color: white; padding: 12px; font-size: 16px; border-radius: 6px; cursor: pointer; margin-top: 10px;">
      Comprar
    </button>
  </div>
</div>
