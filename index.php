<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>index</title>

    <style>
        #video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50vh;
            object-fit: cover;
            z-index: -1;
        }

        .hero {
            position: relative;
            height: 50vh;
        }

        .bike-container {
            position: relative;
            width: 100%;
            height: 70vh;
            background: url('https://example.com/bike-image.jpg') no-repeat center center;
            background-size: cover;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 3s ease-in-out;
            margin-top: 60px;
        }

        .bike-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .bike-content {
            position: relative;
            z-index: 2;
            color: #fff;
            text-align: center;
            font-size: 2rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
<?php require 'head_cliente_inicio.php'; ?>

<div class="hero">
    <video autoplay muted loop id="video-background">
        <source src="img/videoindexx.mp4" type="video/mp4">
        Tu navegador no admite videos HTML5.
    </video>
</div>

<div class="bike-container">
    <div class="bike-content">
        <h1>Descubre la tienda del ciclismo por excelencia</h1>
        <p>
Explore nuestra amplia gama de bicicletas y accesorios.</p>
    </div>
</div>

<div class="cont s--inactive">
  <div class="cont__inner">
    <div class="el">
      <div class="el__overflow">
        <div class="el__inner">
          <div class="el__bg"></div>
          <div class="el__preview-cont">
            <h2 class="el__heading">Catalogo</h2>
          </div>
          <div class="el__content">
            <div class="el__text">Whatever</div>
            <div class="el__close-btn"></div>
          </div>
        </div>
      </div>
      <div class="el__index">
        <div class="el__index-back">1</div>
        <div class="el__index-front">
          <div class="el__index-overlay" data-index="1">1</div>
        </div>
      </div>
    </div>
    <!-- el end -->
    <!-- el start -->
    <div class="el">
      <div class="el__overflow">
        <div class="el__inner">
          <div class="el__bg"></div>
          <div class="el__preview-cont">
            <h2 class="el__heading">Ciudad</h2>
          </div>
          <div class="el__content">
            <div class="el__text">Whatever</div>
            <div class="el__close-btn"></div>
          </div>
        </div>
      </div>
      <div class="el__index">
        <div class="el__index-back">2</div>
        <div class="el__index-front">
          <div class="el__index-overlay" data-index="2">2</div>
        </div>
      </div>
    </div>
    <!-- el end -->
    <!-- el start -->
    <div class="el">
      <div class="el__overflow">
        <div class="el__inner">
          <div class="el__bg"></div>
          <div class="el__preview-cont">
            <h2 class="el__heading">Carretera</h2>
          </div>
          <div class="el__content">
            <div class="el__text"></div>
            <div class="el__close-btn"></div>
          </div>
        </div>
      </div>
      <div class="el__index">
        <div class="el__index-back">3</div>
        <div class="el__index-front">
          <div class="el__index-overlay" data-index="3">3</div>
        </div>
      </div>
    </div>
    <!-- el end -->
    <!-- el start -->
    <div class="el">
      <div class="el__overflow">
        <div class="el__inner">
          <div class="el__bg"></div>
          <div class="el__preview-cont">
          <h2 class="el__heading">Equipamiento</h2>
          </div>
          <div class="el__content">
            <div class="el__text"></div>
            <div class="el__close-btn"></div>
          </div>
        </div>
      </div>
      <div class="el__index">
        <div class="el__index-back">4</div>
        <div class="el__index-front">
          <div class="el__index-overlay" data-index="4">4</div>
        </div>
      </div>
    </div>
    <!-- el end -->
    <!-- el start -->
    <div class="el">
      <div class="el__overflow">
        <div class="el__inner">
          <div class="el__bg"></div>
          <div class="el__preview-cont">
            <h2 class="el__heading">Accesorios</h2>
          </div>
          <div class="el__content">
            <div class="el__text"></div>
            <div class="el__close-btn"></div>
          </div>
        </div>
      </div>
      <div class="el__index">
        <div class="el__index-back">5</div>
        <div class="el__index-front">
          <div class="el__index-overlay" data-index="5">5</div>
        </div>
      </div>
    </div>
    <!-- el end -->
  </div>
</div>

<?php require 'footer.php'; ?>

<script src="js/indexjs.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.el').forEach(function(elemento) {
        elemento.addEventListener('click', function() {
            var indice = this.querySelector('.el__index-overlay').getAttribute('data-index');
            switch (indice) {
                case '1':
                    window.location.href = 'catalogo.php';
                    break;
                case '2':
                    window.location.href = 'ciudad_cliente.php';
                    break;
                case '3':
                    window.location.href = 'carretera_cliente.php';
                    break;
                case '4':
                    window.location.href = 'equipamiento_cliente.php';
                    break;
                case '5':
                    window.location.href = 'accesorio_cliente.php';
                    break;
                default:
                    break;
            }
        });
    });
});
</script>

</body>
</html>
