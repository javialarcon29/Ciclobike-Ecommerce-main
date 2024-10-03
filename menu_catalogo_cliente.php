<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Variables */
        :root {
            --fucsia: #F24B6A;
            --magenta: #A62E4E;
            --violeta: #43143E;
            --azul: #47AABE;
        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: #ffffff url('https://subtlepatterns.com/patterns/cream_pixels.png');
        }

        h1 {
            text-align: center;
            font-weight: normal;
            font-size: 2.4em;
            color: #cc3e3e;
            margin: 50px 0;
            position: relative;
            overflow: hidden;
        }

        h1::before, h1::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: linear-gradient(90deg, transparent, #cc3e3e, transparent);
            animation: slide 3s infinite;
        }

        h1::after {
            animation-delay: 1.5s;
        }

        @keyframes slide {
            0% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        ul {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            table-layout: fixed; /* optional */
        }

        ul li {
            display: table-cell;
            width: auto;
            text-align: center;
        }

        ul li a {
            padding: 20px;
            text-decoration: none;
            color: white;
            display: block;
            width: 100%;
            height: 100%;
            text-transform: uppercase;
            border-bottom: 10px solid;
            transition: background-color 0.3s, border-bottom-color 0.3s;
        }

        ul li:nth-child(1) a {
            background-color: var(--fucsia);
            border-bottom-color: darken(var(--fucsia), 5%);
        }

        ul li:nth-child(2) a {
            background-color: var(--magenta);
            border-bottom-color: darken(var(--magenta), 5%);
        }

        ul li:nth-child(3) a {
            background-color: var(--violeta);
            border-bottom-color: darken(var(--violeta), 5%);
        }

        ul li:nth-child(4) a {
            background-color: var(--azul);
            border-bottom-color: darken(var(--azul), 5%);
        }

        ul li a:hover {
            background-color: #8bc5ff; /* Azul claro */
            border-bottom-color: var(--azul);
        }

    </style>
    <title>Catálogo</title>
</head>
<body>
    <h1><strong>Catálogo</strong></h1>

    <ul id='menu'>
        <li class="button"><a class='actual' href='carretera_cliente.php'>Carretera</a></li>
        <li class="button"><a href='ciudad_cliente.php'>Ciudad</a></li>
        <li class="button"><a href='accesorio_cliente.php'>Accesorios</a></li>
        <li class="button"><a href='equipamiento_cliente.php'>Equipamiento</a></li>
    </ul>
</body>
</html>
