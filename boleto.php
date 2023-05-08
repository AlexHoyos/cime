<?php
    include './app/main.php';
    include './app/Includes/header.php';
?>

<section class="row m-0 p-0" id="movieDetails">
  <div class="col-md-4">
    <img src="pelicula.jpg" alt="Imagen de la Película" class="movie-image">
  </div>
  <div class="col-md-8">
    <h1>Película: El Gran Hotel Budapest</h1>
    <ul>
      <li>Formato: Digital</li>
      <li>Idioma: Español</li>
      <li>Día: Viernes 3 de mayo</li>
      <li>Hora: 20:30 hrs</li>
      <li>Sala: 3</li>
      <li>Asientos: Fila 5, Asientos 10-12</li>
    </ul>
    <h2>BOLETOS</h2>
    <ul>
      <li>Adulto: 2 x $200 = $400</li>
      <li>Estudiante: 1 x $150 = $150</li>
      <li>Niño: 1 x $100 = $100</li>
    </ul>
    <h3>Total: $650</h3>
  </div>
</section>

<?php
    include './app/Includes/footer.php';
?>
