-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 12:34:50
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` longblob NOT NULL,
  `descripcion` text DEFAULT NULL,
  `material` varchar(100) DEFAULT NULL,
  `categoria` enum('carretera','ciudad','accesorios','equipamiento') NOT NULL DEFAULT 'carretera',
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `precio`, `imagen`, `descripcion`, `material`, `categoria`, `cantidad`) VALUES
(4, 'Bicicleta Rids one 1a', 1200.00, 0x75706c6f6164732f62696369312e6a7067, 'La mejor bicicleta de todos los tiempos', 'carbono', 'ciudad', 0),
(6, 'Rider line', 3400.00, 0x696d672f62696369312e6a7067, 'Con suspensión delantera y trasera para absorber impactos en terrenos accidentados. Su cuadro de aluminio resistente y frenos de disco hidráulicos brindan estabilidad y control en todo tipo de condiciones. Perfecta para aventuras off-road, desde senderos técnicos hasta descensos empinados.', 'carbono', 'carretera', 0),
(7, 'Ran saas', 400.00, 0x696d672f62696369322e6a7067, 'Diseñada pensando en la comodidad y la practicidad en entornos urbanos. Su cuadro de acero duradero ofrece una conducción suave, mientras que los guardabarros y el sistema de cambios de fácil uso la hacen ideal para desplazamientos diarios. Equipada con luces integradas para mayor seguridad en la noche.', 'carbono', 'carretera', 0),
(8, 'Reen det', 900.00, 0x696d672f62696369332e6a7067, 'Construida para ofrecer un rendimiento excepcional en competiciones y entrenamientos de carretera. Su cuadro de fibra de carbono ofrece una combinación perfecta de ligereza y rigidez, mientras que los componentes de calidad, como el grupo de transmisión Shimano Ultegra, garantizan cambios suaves y precisos.', 'aluminio', 'ciudad', 0),
(9, 'Pen Side', 750.00, 0x696d672f62696369332e6a7067, 'Equipada con características específicas para largos viajes y aventuras. Sus portaequipajes delantero y trasero permiten llevar carga adicional, mientras que los neumáticos resistentes y la geometría estable ofrecen comodidad durante todo el día. Ideal para explorar nuevos horizontes sobre dos ruedas.', 'carbono', 'carretera', 0),
(10, 'Kep deep', 7600.00, 0x696d672f62696369342e6a7067, 'Perfecta para desplazamientos urbanos y viajes de corta distancia. Su diseño compacto y sistema de plegado rápido la hacen fácil de transportar y almacenar en espacios reducidos. Equipada con un motor eléctrico que proporciona asistencia en la pedalada, brindando un impulso adicional en cada trayecto.', 'carbono', 'ciudad', 0),
(11, 'Cleo th', 3400.00, 0x696d672f62696369352e6a7067, ' Diseñada para explorar caminos menos transitados y terrenos mixtos. Su geometría versátil y neumáticos de mayor grosor ofrecen estabilidad y tracción en una variedad de superficies. Perfecta para aventuras fuera de la carretera y largas travesías donde la versatilidad es clave.', 'aluminio', 'ciudad', 0),
(12, 'Ter Terten', 5000.00, 0x696d672f62696369362e6a706567, ' Diseñada para explorar caminos menos transitados y terrenos mixtos. Su geometría versátil y neumáticos de mayor grosor ofrecen estabilidad y tracción en una variedad de superficies. Perfecta para aventuras fuera de la carretera y largas travesías donde la versatilidad es clave.', 'aluminio', 'ciudad', 0),
(13, 'Aranda sid', 8900.00, 0x696d672f62696369382e6a7067, ' Construida para alcanzar velocidades máximas en competiciones de triatlón. Su cuadro aerodinámico y componentes de alta gama minimizan la resistencia al viento, mientras que la posición aerodinámica del ciclista maximiza la eficiencia. Ideal para aquellos que buscan mejorar sus tiempos en la disciplina del triatlón.', 'carbono', 'carretera', 0),
(14, 'Mostol Green', 4850.00, 0x696d672f62696369392e6a7067, ' Construida para alcanzar velocidades máximas en competiciones de triatlón. Su cuadro aerodinámico y componentes de alta gama minimizan la resistencia al viento, mientras que la posición aerodinámica del ciclista maximiza la eficiencia. Ideal para aquellos que buscan mejorar sus tiempos en la disciplina del triatlón.', 'carbono', 'carretera', 0),
(15, 'Teju Mas', 12000.00, 0x696d672f6269636931302e6a7067, ' Construida para alcanzar velocidades máximas en competiciones de triatlón. Su cuadro aerodinámico y componentes de alta gama minimizan la resistencia al viento, mientras que la posición aerodinámica del ciclista maximiza la eficiencia. Ideal para aquellos que buscan mejorar sus tiempos en la disciplina del triatlón.', 'carbono', 'ciudad', 0),
(16, 'Gar naat', 3250.00, 0x696d672f62696369636c6574612d64652d6d6f6e74616e612d32392d78722d747261696c2d3930302d3234762d706f72746164612e6a7067, ' Construida para alcanzar velocidades máximas en competiciones de triatlón. Su cuadro aerodinámico y componentes de alta gama minimizan la resistencia al viento, mientras que la posición aerodinámica del ciclista maximiza la eficiencia. Ideal para aquellos que buscan mejorar sus tiempos en la disciplina del triatlón.', 'carbono', 'carretera', 0),
(17, 'Mer Fley', 5000.00, 0x696d672f6e756576612e6a7067, 'Un diseño atemporal con cuadro de acero resistente y estilo vintage. Equipada con guardabarros y portaequipajes trasero para mayor funcionalidad en la ciudad. Sus luces delanteras y traseras integradas garantizan visibilidad en condiciones de poca luz, ofreciendo un viaje seguro y elegante.', 'carbono', 'carretera', 0),
(18, 'Soporte movil ', 34.00, 0x696d672f736f706f7274652d6d6f76696c2d6d616e696c6c61722d62696369636c6574612e6a7067, 'Este soporte está diseñado para mantener tu dispositivo móvil de forma segura mientras estás en movimiento. Con un diseño ajustable y seguro, puedes colocar fácilmente tu teléfono en posición vertical u horizontal para una visualización óptima. Sus materiales duraderos y agarre firme aseguran que tu dispositivo permanezca en su lugar incluso en terrenos irregulares. Perfecto para usar en bicicletas, motocicletas o cualquier otro vehículo, este soporte móvil te permite acceder a tus aplicaciones de navegación, música o llamadas con total comodidad y tranquilidad.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'todos', 'accesorios', 0),
(19, 'Pedestal madera', 60.00, 0x696d672f706564657374616c2e6a7067, 'Este pedestal combina funcionalidad y estilo para exhibir tu bicicleta de forma segura y estética en tu hogar o espacio de trabajo. Construido con madera de alta calidad, este soporte proporciona una base estable y duradera para tu bicicleta, protegiendo tanto el suelo como el cuadro de arañazos y daños. Su diseño minimalista y acabado natural complementan cualquier decoración interior, mientras que su forma ergonómica sostiene la bicicleta de manera segura sin necesidad de apoyos adicionales. Ideal para mostrar tu bicicleta con orgullo mientras no está en uso, este pedestal de madera añade un toque de elegancia a cualquier ambiente.', 'todos', 'accesorios', 0),
(20, 'clothing war', 100.00, 0x696d672f6571756970616d69656e746f322e6a7067, ' Esta prenda está confeccionada con nylon de alta calidad, ofreciendo una combinación perfecta de ligereza y durabilidad. El tejido de nylon proporciona una protección efectiva contra el viento y la lluvia ligera, manteniéndote cómodo y seco en condiciones climáticas variables. Su diseño ergonómico y transpirable garantiza una total libertad de movimiento, mientras que sus detalles reflectantes mejoran la visibilidad en condiciones de poca luz. Perfecta para actividades al aire libre como senderismo, carrera o ciclismo, esta vestimenta de nylon es una opción versátil y funcional para tus aventuras.', 'todos', 'equipamiento', 0),
(21, 'cloting blue', 250.00, 0x696d672f6571756970616d69656e746f332e6a7067, ' Esta prenda está confeccionada con nylon de alta calidad, ofreciendo una combinación perfecta de ligereza y durabilidad. El tejido de nylon proporciona una protección efectiva contra el viento y la lluvia ligera, manteniéndote cómodo y seco en condiciones climáticas variables. Su diseño ergonómico y transpirable garantiza una total libertad de movimiento, mientras que sus detalles reflectantes mejoran la visibilidad en condiciones de poca luz. Perfecta para actividades al aire libre como senderismo, carrera o ciclismo, esta vestimenta de nylon es una opción versátil y funcional para tus aventuras.', 'todos', 'equipamiento', 0),
(22, 'Camiseta Stir', 90.00, 0x696d672f4d41494c4c4f542d4349434c495354412d43495449432d534c494d2d32332d484f4d4252452d312d343230783435312d312e6a706567, 'Esta camiseta está confeccionada con nylon de alta calidad, ofreciendo un equilibrio perfecto entre comodidad y rendimiento. El tejido de nylon proporciona una sensación suave y ligera contra la piel, mientras que su capacidad de absorción de la humedad te mantiene fresco y seco durante tus actividades deportivas. Su diseño ergonómico y elástico se adapta a tu cuerpo, proporcionando una total libertad de movimiento en cada movimiento. Ya sea para correr, entrenar en el gimnasio o disfrutar de actividades al aire libre, esta camiseta de nylon es una opción imprescindible para mantenerte cómodo y enfocado en tus objetivos.', 'todos', 'equipamiento', 0),
(23, 'Mallas Nail', 200.00, 0x696d672f4249424c494f544543415f4954454d535f363736315f32303232303232385f544143544943434152474f5f3638395f485f3430382e6a7067, 'Estas mallas están fabricadas con nylon de alta calidad, ofreciendo una combinación perfecta de elasticidad y suavidad. El tejido de nylon proporciona un ajuste ceñido que se adapta a tu cuerpo, brindando soporte y libertad de movimiento durante tus entrenamientos o actividades deportivas. Su diseño transpirable ayuda a mantenerte fresco y seco, incluso en los entrenamientos más intensos. Con detalles de costura reforzada para una mayor durabilidad, estas mallas son ideales para correr, hacer yoga, entrenar en el gimnasio o cualquier actividad que requiera comodidad y rendimiento.', 'todos', 'equipamiento', 0),
(24, 'Kit bike', 75.00, 0x696d672f61636365736f72696f362e6a7067, 'Este kit incluye todo lo que necesitas para tus sesiones de entrenamiento o actividades al aire libre. Confeccionado con nylon de alta calidad, cada pieza ofrece una combinación óptima de elasticidad y durabilidad. El conjunto incluye una camiseta de manga corta transpirable y elástica, mallas ajustadas que proporcionan soporte muscular y libertad de movimiento, y una chaqueta ligera resistente al viento y al agua para protegerte en condiciones adversas. Con detalles reflectantes para mayor visibilidad y seguridad, este kit de nylon es la elección perfecta para mantenerse cómodo y enfocado en cualquier situación. Ideal para correr, entrenar en el gimnasio o cualquier actividad deportiva al aire libre.', 'todos', 'equipamiento', 0),
(25, 'Kit venture', 80.00, 0x696d672f61636365736f72696f372e6a7067, 'Este kit incluye todo lo que necesitas para tus sesiones de entrenamiento o actividades al aire libre. Confeccionado con nylon de alta calidad, cada pieza ofrece una combinación óptima de elasticidad y durabilidad. El conjunto incluye una camiseta de manga corta transpirable y elástica, mallas ajustadas que proporcionan soporte muscular y libertad de movimiento, y una chaqueta ligera resistente al viento y al agua para protegerte en condiciones adversas. Con detalles reflectantes para mayor visibilidad y seguridad, este kit de nylon es la elección perfecta para mantenerse cómodo y enfocado en cualquier situación. Ideal para correr, entrenar en el gimnasio o cualquier actividad deportiva al aire libre.', 'todos', 'equipamiento', 0),
(26, 'Mallas ven', 30.00, 0x696d672f6667662e6a7067, 'Estas mallas están diseñadas para ofrecer comodidad y rendimiento durante tus actividades deportivas. Fabricadas con nylon de alta calidad, proporcionan un ajuste ceñido que se adapta a tu cuerpo y ofrece soporte muscular. El tejido elástico permite una amplia gama de movimientos sin restricciones, mientras que su construcción resistente garantiza una durabilidad excepcional. Ideales para correr, hacer yoga, entrenar en el gimnasio o cualquier actividad que requiera movilidad y resistencia, estas mallas de nylon te brindarán la comodidad y el soporte que necesitas para alcanzar tus metas deportivas.', 'todos', 'equipamiento', 0),
(40, 'Mountain Bike Pro X', 2000.00, 0x696d672f6269636932302e6a7067, 'La Mountain Bike Pro X está diseñada para los aventureros que buscan explorar terrenos difíciles. Con su suspensión delantera de alta gama y frenos de disco hidráulicos, proporciona un control excepcional. Su cuadro de aluminio ligero y ruedas de 29 pulgadas aseguran una conducción suave y estable. Ideal para senderos y caminos de montaña. Disponible en varios tamaños y colores.', 'todos', 'ciudad', 0),
(41, 'City Commuter 500', 6700.00, 0x696d672f6269636932312e6a7067, 'La City Commuter 500 es perfecta para tus desplazamientos urbanos diarios. Equipado con un cuadro de aluminio ligero y transmisión de 7 velocidades, este modelo te permite moverte con facilidad por la ciudad. Sus frenos de disco garantizan una parada segura, mientras que los guardabarros y portaequipajes añaden funcionalidad y comodidad. Estilo y eficiencia en cada viaje.', 'carbono', 'carretera', 0),
(42, 'Road Racer Elite', 3000.00, 0x696d672f6269636932332e6a7067, 'La Road Racer Elite es la elección ideal para los ciclistas de carretera apasionados. Con un cuadro de carbono aerodinámico y componentes de alta gama, esta bicicleta ofrece velocidad y rendimiento inigualables. Su sistema de cambio Shimano Ultegra de 22 velocidades asegura una transición suave entre marchas. Perfecta para largas distancias y competiciones. Diseño elegante y ligero.', 'todos', 'ciudad', 0),
(43, 'La Hybrid Explorer 700', 3400.00, 0x696d672f6269636932342e6a7067, 'La Hybrid Explorer 700 combina lo mejor de las bicicletas de montaña y de carretera. Su cuadro versátil y suspensión delantera te permiten enfrentar tanto caminos pavimentados como senderos ligeros. Equipado con 21 velocidades y frenos de disco, es ideal para el ciclista que busca flexibilidad y comodidad en diferentes terrenos. Ideal para paseos recreativos y desplazamientos diarios.', 'carbono', 'ciudad', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos`
--

CREATE TABLE `lista_deseos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_deseos`
--

INSERT INTO `lista_deseos` (`id`, `id_producto`, `fecha_agregado`) VALUES
(28, 4, '2024-05-07 08:24:11'),
(29, 4, '2024-05-07 08:29:26'),
(30, 4, '2024-05-07 08:34:57'),
(31, 4, '2024-05-07 08:36:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paypalk`
--

CREATE TABLE `paypalk` (
  `datos` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paypalk`
--

INSERT INTO `paypalk` (`datos`) VALUES
('{\"id\":\"WH-2S7447749P3462453-4BM99355N15814941\",\"event_version\":\"1.0\",\"create_time\":\"2024-05-07T11:13:41.602Z\",\"resource_type\":\"capture\",\"resource_version\":\"2.0\",\"event_type\":\"PAYMENT.CAPTURE.COMPLETED\",\"summary\":\"Payment completed for $ 2400.0 USD\",\"resource\":{\"payee\":{\"email_address\":\"sb-rblzv30010320@business.example.com\",\"merchant_id\":\"QE2EYEHQU59D6\"},\"amount\":{\"value\":\"2400.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"supplementary_data\":{\"related_ids\":{\"order_id\":\"6TE359973E1623718\"}},\"update_time\":\"2024-05-07T11:13:37Z\",\"create_time\":\"2024-05-07T11:13:37Z\",\"final_capture\":true,\"seller_receivable_breakdown\":{\"exchange_rate\":{\"source_currency\":\"USD\",\"target_currency\":\"EUR\",\"value\":\"0.8627555079\"},\"paypal_fee\":{\"value\":\"81.90\",\"currency_code\":\"USD\"},\"gross_amount\":{\"value\":\"2400.00\",\"currency_code\":\"USD\"},\"net_amount\":{\"value\":\"2318.10\",\"currency_code\":\"USD\"},\"receivable_amount\":{\"value\":\"1999.95\",\"currency_code\":\"EUR\"}},\"links\":[{\"method\":\"GET\",\"rel\":\"self\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/80T32625AU1469500\"},{\"method\":\"POST\",\"rel\":\"refund\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/80T32625AU1469500/refund\"},{\"method\":\"GET\",\"rel\":\"up\",\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/6TE359973E1623718\"}],\"id\":\"80T32625AU1469500\",\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-2S7447749P3462453-4BM99355N15814941\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-2S7447749P3462453-4BM99355N15814941/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}'),
('{\"id\":\"WH-2EW57541HD2768942-35L37360RR7204648\",\"event_version\":\"1.0\",\"create_time\":\"2024-05-07T12:55:04.896Z\",\"resource_type\":\"capture\",\"resource_version\":\"2.0\",\"event_type\":\"PAYMENT.CAPTURE.COMPLETED\",\"summary\":\"Payment completed for $ 2400.0 USD\",\"resource\":{\"payee\":{\"email_address\":\"sb-rblzv30010320@business.example.com\",\"merchant_id\":\"QE2EYEHQU59D6\"},\"amount\":{\"value\":\"2400.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"supplementary_data\":{\"related_ids\":{\"order_id\":\"4W159265FS961320L\"}},\"update_time\":\"2024-05-07T12:55:01Z\",\"create_time\":\"2024-05-07T12:55:01Z\",\"final_capture\":true,\"seller_receivable_breakdown\":{\"exchange_rate\":{\"source_currency\":\"USD\",\"target_currency\":\"EUR\",\"value\":\"0.8627555079\"},\"paypal_fee\":{\"value\":\"81.90\",\"currency_code\":\"USD\"},\"gross_amount\":{\"value\":\"2400.00\",\"currency_code\":\"USD\"},\"net_amount\":{\"value\":\"2318.10\",\"currency_code\":\"USD\"},\"receivable_amount\":{\"value\":\"1999.95\",\"currency_code\":\"EUR\"}},\"links\":[{\"method\":\"GET\",\"rel\":\"self\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/00N25152NL908982R\"},{\"method\":\"POST\",\"rel\":\"refund\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/00N25152NL908982R/refund\"},{\"method\":\"GET\",\"rel\":\"up\",\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4W159265FS961320L\"}],\"id\":\"00N25152NL908982R\",\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-2EW57541HD2768942-35L37360RR7204648\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-2EW57541HD2768942-35L37360RR7204648/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}'),
('{\"id\":\"WH-8XK48833B3321121F-39B96585S27340905\",\"event_version\":\"1.0\",\"create_time\":\"2024-05-07T13:14:36.053Z\",\"resource_type\":\"capture\",\"resource_version\":\"2.0\",\"event_type\":\"PAYMENT.CAPTURE.COMPLETED\",\"summary\":\"Payment completed for $ 1200.0 USD\",\"resource\":{\"payee\":{\"email_address\":\"sb-rblzv30010320@business.example.com\",\"merchant_id\":\"QE2EYEHQU59D6\"},\"amount\":{\"value\":\"1200.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"supplementary_data\":{\"related_ids\":{\"order_id\":\"38U96921DK703692W\"}},\"update_time\":\"2024-05-07T13:14:31Z\",\"create_time\":\"2024-05-07T13:14:31Z\",\"final_capture\":true,\"seller_receivable_breakdown\":{\"exchange_rate\":{\"source_currency\":\"USD\",\"target_currency\":\"EUR\",\"value\":\"0.8627555079\"},\"paypal_fee\":{\"value\":\"41.10\",\"currency_code\":\"USD\"},\"gross_amount\":{\"value\":\"1200.00\",\"currency_code\":\"USD\"},\"net_amount\":{\"value\":\"1158.90\",\"currency_code\":\"USD\"},\"receivable_amount\":{\"value\":\"999.85\",\"currency_code\":\"EUR\"}},\"links\":[{\"method\":\"GET\",\"rel\":\"self\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/1YP818254L357100D\"},{\"method\":\"POST\",\"rel\":\"refund\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/1YP818254L357100D/refund\"},{\"method\":\"GET\",\"rel\":\"up\",\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/38U96921DK703692W\"}],\"id\":\"1YP818254L357100D\",\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-8XK48833B3321121F-39B96585S27340905\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-8XK48833B3321121F-39B96585S27340905/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}'),
('{\"id\":\"WH-56Y243442B146740F-9KJ911895F288892C\",\"event_version\":\"1.0\",\"create_time\":\"2024-05-07T13:45:08.309Z\",\"resource_type\":\"capture\",\"resource_version\":\"2.0\",\"event_type\":\"PAYMENT.CAPTURE.COMPLETED\",\"summary\":\"Payment completed for $ 2400.0 USD\",\"resource\":{\"payee\":{\"email_address\":\"sb-rblzv30010320@business.example.com\",\"merchant_id\":\"QE2EYEHQU59D6\"},\"amount\":{\"value\":\"2400.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"supplementary_data\":{\"related_ids\":{\"order_id\":\"5GA43180V9993562B\"}},\"update_time\":\"2024-05-07T13:45:04Z\",\"create_time\":\"2024-05-07T13:45:04Z\",\"final_capture\":true,\"seller_receivable_breakdown\":{\"exchange_rate\":{\"source_currency\":\"USD\",\"target_currency\":\"EUR\",\"value\":\"0.8627555079\"},\"paypal_fee\":{\"value\":\"81.90\",\"currency_code\":\"USD\"},\"gross_amount\":{\"value\":\"2400.00\",\"currency_code\":\"USD\"},\"net_amount\":{\"value\":\"2318.10\",\"currency_code\":\"USD\"},\"receivable_amount\":{\"value\":\"1999.95\",\"currency_code\":\"EUR\"}},\"links\":[{\"method\":\"GET\",\"rel\":\"self\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/36K2712429527900N\"},{\"method\":\"POST\",\"rel\":\"refund\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/36K2712429527900N/refund\"},{\"method\":\"GET\",\"rel\":\"up\",\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/5GA43180V9993562B\"}],\"id\":\"36K2712429527900N\",\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-56Y243442B146740F-9KJ911895F288892C\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-56Y243442B146740F-9KJ911895F288892C/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}'),
('{\"id\":\"WH-50K76595JJ906552U-22W81558KG746160H\",\"event_version\":\"1.0\",\"create_time\":\"2024-05-07T13:48:44.268Z\",\"resource_type\":\"capture\",\"resource_version\":\"2.0\",\"event_type\":\"PAYMENT.CAPTURE.COMPLETED\",\"summary\":\"Payment completed for $ 1200.0 USD\",\"resource\":{\"payee\":{\"email_address\":\"sb-rblzv30010320@business.example.com\",\"merchant_id\":\"QE2EYEHQU59D6\"},\"amount\":{\"value\":\"1200.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"supplementary_data\":{\"related_ids\":{\"order_id\":\"56A60117D5179805E\"}},\"update_time\":\"2024-05-07T13:48:40Z\",\"create_time\":\"2024-05-07T13:48:40Z\",\"final_capture\":true,\"seller_receivable_breakdown\":{\"exchange_rate\":{\"source_currency\":\"USD\",\"target_currency\":\"EUR\",\"value\":\"0.8627555079\"},\"paypal_fee\":{\"value\":\"41.10\",\"currency_code\":\"USD\"},\"gross_amount\":{\"value\":\"1200.00\",\"currency_code\":\"USD\"},\"net_amount\":{\"value\":\"1158.90\",\"currency_code\":\"USD\"},\"receivable_amount\":{\"value\":\"999.85\",\"currency_code\":\"EUR\"}},\"links\":[{\"method\":\"GET\",\"rel\":\"self\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/2GJ79038WG155393D\"},{\"method\":\"POST\",\"rel\":\"refund\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/2GJ79038WG155393D/refund\"},{\"method\":\"GET\",\"rel\":\"up\",\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/56A60117D5179805E\"}],\"id\":\"2GJ79038WG155393D\",\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-50K76595JJ906552U-22W81558KG746160H\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-50K76595JJ906552U-22W81558KG746160H/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}'),
('{\"id\":\"WH-9MY051421N0617109-3GB91205XK534352T\",\"event_version\":\"1.0\",\"create_time\":\"2024-05-07T13:53:47.763Z\",\"resource_type\":\"capture\",\"resource_version\":\"2.0\",\"event_type\":\"PAYMENT.CAPTURE.COMPLETED\",\"summary\":\"Payment completed for $ 1200.0 USD\",\"resource\":{\"payee\":{\"email_address\":\"sb-rblzv30010320@business.example.com\",\"merchant_id\":\"QE2EYEHQU59D6\"},\"amount\":{\"value\":\"1200.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"supplementary_data\":{\"related_ids\":{\"order_id\":\"6BD95838NF020584R\"}},\"update_time\":\"2024-05-07T13:53:43Z\",\"create_time\":\"2024-05-07T13:53:43Z\",\"final_capture\":true,\"seller_receivable_breakdown\":{\"exchange_rate\":{\"source_currency\":\"USD\",\"target_currency\":\"EUR\",\"value\":\"0.8627555079\"},\"paypal_fee\":{\"value\":\"14.70\",\"currency_code\":\"USD\"},\"gross_amount\":{\"value\":\"1200.00\",\"currency_code\":\"USD\"},\"net_amount\":{\"value\":\"1185.30\",\"currency_code\":\"USD\"},\"receivable_amount\":{\"value\":\"1022.62\",\"currency_code\":\"EUR\"}},\"links\":[{\"method\":\"GET\",\"rel\":\"self\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/9T1320837L104451L\"},{\"method\":\"POST\",\"rel\":\"refund\",\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/9T1320837L104451L/refund\"},{\"method\":\"GET\",\"rel\":\"up\",\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/6BD95838NF020584R\"}],\"id\":\"9T1320837L104451L\",\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-9MY051421N0617109-3GB91205XK534352T\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-9MY051421N0617109-3GB91205XK534352T/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paypal_orders`
--

CREATE TABLE `paypal_orders` (
  `payment_id` varchar(50) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `username2` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `link_href` varchar(200) DEFAULT NULL,
  `direccion` varchar(500) NOT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `nombrecompleto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paypal_orders`
--

INSERT INTO `paypal_orders` (`payment_id`, `event_type`, `user_email`, `username`, `username2`, `precio`, `create_time`, `update_time`, `link_href`, `direccion`, `provincia`, `codigo_postal`, `ciudad`, `nombrecompleto`) VALUES
('05063789CB767723L', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'alexas', 'alex', 4800.00, '2024-05-07 14:42:13', '2024-05-07 14:42:29', 'https://api.sandbox.paypal.com/v2/checkout/orders/05063789CB767723L', '', NULL, NULL, NULL, NULL),
('0C729375HC637353S', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aranda', 'ara', 4800.00, '2024-05-07 14:47:29', '2024-05-07 14:47:49', 'https://api.sandbox.paypal.com/v2/checkout/orders/0C729375HC637353S', '', NULL, NULL, NULL, NULL),
('0LL41072CL754472Y', 'adriancampasayo@hotmail.com', 'adriancampasayo@hotmail.com', 'eetee', 'ere', 4800.00, '2024-05-07 15:11:17', '2024-05-07 15:11:38', 'https://api.sandbox.paypal.com/v2/checkout/orders/0LL41072CL754472Y', 'aver si funciona', 'ÁVILA', '29008', 'malaga', NULL),
('0U731310GX822074G', 'javielafrikano@gmail.com', 'javielafrikano@gmail.com', 'holiholiiii', 'alarcon', 10450.00, '2024-05-26 21:47:23', '2024-05-26 21:48:44', 'https://api.sandbox.paypal.com/v2/checkout/orders/0U731310GX822074G', 'asd', 'MÁLAGA', '29006', 'malaga', NULL),
('0X1391071E450841G', 'adriancampasayo@hotmail.com', 'adriancampasayo@hotmail.com', 'aranda', 'ara', 4800.00, '2024-05-07 14:53:56', '2024-05-07 14:54:52', 'https://api.sandbox.paypal.com/v2/checkout/orders/0X1391071E450841G', 'aver si funciona', NULL, NULL, NULL, NULL),
('11192746C59716645', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aasd', 'alarconeeee', 2400.00, '2024-05-07 21:58:10', '2024-05-07 21:59:16', 'https://api.sandbox.paypal.com/v2/checkout/orders/11192746C59716645', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('13F01836N5691102U', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aasd', 'alarcon', 1200.00, '2024-05-08 10:43:45', '2024-05-08 10:44:27', 'https://api.sandbox.paypal.com/v2/checkout/orders/13F01836N5691102U', 'asd', 'ALMERÍA', '29006', 'malaga', NULL),
('165564832V6458226', 'adriancampayo6@gmail.com', 'adriancampayo6@gmail.com', 'aasd', 'asdas', 6000.00, '2024-05-07 21:42:16', '2024-05-07 21:46:23', 'https://api.sandbox.paypal.com/v2/checkout/orders/165564832V6458226', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('1T61343952701331V', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'asd', 'asd', 2400.00, '2024-05-07 22:23:31', '2024-05-07 22:24:14', 'https://api.sandbox.paypal.com/v2/checkout/orders/1T61343952701331V', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('2DR719705P919435C', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'root', 'asdasd', 1200.00, '2024-05-07 14:29:00', '2024-05-07 14:29:18', 'https://api.sandbox.paypal.com/v2/checkout/orders/2DR719705P919435C', '', NULL, NULL, NULL, NULL),
('35J00138MY504311C', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'ukltimapruebva', 'jaimukltimapruebvae', 4800.00, '2024-05-07 15:12:13', '2024-05-07 15:12:39', 'https://api.sandbox.paypal.com/v2/checkout/orders/35J00138MY504311C', 'aver si funciona', 'ÁVILA', '29008', 'malaga', NULL),
('3KM19122V52175536', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aranda', 'ara', 4800.00, '2024-05-07 14:49:44', '2024-05-07 14:49:59', 'https://api.sandbox.paypal.com/v2/checkout/orders/3KM19122V52175536', '', NULL, NULL, NULL, NULL),
('48C49173YC8456817', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'javi', 'aaa', 2400.00, '2024-05-07 22:13:26', '2024-05-07 22:14:19', 'https://api.sandbox.paypal.com/v2/checkout/orders/48C49173YC8456817', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('4EY200427L1883342', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'Adrian', 'martin', 2400.00, '2024-05-07 22:21:51', '2024-05-07 22:22:26', 'https://api.sandbox.paypal.com/v2/checkout/orders/4EY200427L1883342', 'asdas', 'ALMERÍA', '29006', 'malaga', NULL),
('4F64224221289213X', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'adriani', 'campayoo', 4800.00, '2024-05-07 15:18:22', '2024-05-07 15:19:03', 'https://api.sandbox.paypal.com/v2/checkout/orders/4F64224221289213X', 'aver si funciona', 'ÁVILA', '29008', 'malaga', NULL),
('5JH31475SY715103H', 'francisco.romero@cesurformacion.com', 'francisco.romero@cesurformacion.com', 'Francisco', 'Francisco Romero', 1050.00, '2024-05-16 07:04:25', '2024-05-16 07:07:23', 'https://api.sandbox.paypal.com/v2/checkout/orders/5JH31475SY715103H', 'dsdasdas', 'BARCELONA', '23456', 'malaga', NULL),
('5KU908930R0870223', 'adriancampayowwwwarwik@hotmail.com', 'adriancampayowwwwarwik@hotmail.com', 'asd', 'asd', 10450.00, '2024-05-26 21:44:10', '2024-05-26 21:45:31', 'https://api.sandbox.paypal.com/v2/checkout/orders/5KU908930R0870223', 'asd', 'MÁLAGA', '29006', 'malaga', NULL),
('5SM31575UV497702R', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'adrianre', 'campaye', 4800.00, '2024-05-07 15:21:28', '2024-05-07 15:21:48', 'https://api.sandbox.paypal.com/v2/checkout/orders/5SM31575UV497702R', 'aver si funciona', 'ÁVILA', '29008', 'malaga', NULL),
('69W21923G64444744', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'asd', 'asd', 2400.00, '2024-05-07 22:18:22', '2024-05-07 22:18:57', 'https://api.sandbox.paypal.com/v2/checkout/orders/69W21923G64444744', 'asd', 'MÁLAGA', '29006', 'malaga', NULL),
('6PS055775U254930W', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'terere', 'terere', 1200.00, '2024-05-07 14:36:58', '2024-05-07 14:37:19', 'https://api.sandbox.paypal.com/v2/checkout/orders/6PS055775U254930W', '', NULL, NULL, NULL, NULL),
('75560968KS472651P', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'Adrian', 'martin', 1200.00, '2024-05-08 11:00:16', '2024-05-08 11:00:56', 'https://api.sandbox.paypal.com/v2/checkout/orders/75560968KS472651P', 'calle hamlet numero 40', 'CASTELLÓN', '29006', 'malaga', NULL),
('79B57290BF7415339', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aaaaa', 'aaa', 2400.00, '2024-05-07 21:51:25', '2024-05-07 21:52:28', 'https://api.sandbox.paypal.com/v2/checkout/orders/79B57290BF7415339', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('81A592702T784472J', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aaaaa', 'aaa', 2400.00, '2024-05-07 21:55:42', '2024-05-07 21:56:36', 'https://api.sandbox.paypal.com/v2/checkout/orders/81A592702T784472J', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('8C472044XF905080M', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'root', 'asdasd', 1200.00, '2024-05-07 14:32:32', '2024-05-07 14:32:48', 'https://api.sandbox.paypal.com/v2/checkout/orders/8C472044XF905080M', '', NULL, NULL, NULL, NULL),
('8EM84278A8066605R', 'adriancampasayo@hotmail.com', 'adriancampasayo@hotmail.com', 'rete', 'rete', 4800.00, '2024-05-07 15:02:46', '2024-05-07 15:03:10', 'https://api.sandbox.paypal.com/v2/checkout/orders/8EM84278A8066605R', 'aver si funciona', 'CUENCA', 'malaga', '29008', NULL),
('8U180825V8666772M', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'Adrian', 'martin', 2400.00, '2024-05-07 22:04:42', '2024-05-07 22:05:29', 'https://api.sandbox.paypal.com/v2/checkout/orders/8U180825V8666772M', 'asd', 'BIZKAIA', '29006', 'malaga', NULL),
('8YN21147SW427593P', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'aaaaa', 'aaa', 6000.00, '2024-05-07 21:49:34', '2024-05-07 21:50:31', 'https://api.sandbox.paypal.com/v2/checkout/orders/8YN21147SW427593P', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('902534320F1880931', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'javi', 'alarcon', 6000.00, '2024-05-07 21:47:25', '2024-05-07 21:48:43', 'https://api.sandbox.paypal.com/v2/checkout/orders/902534320F1880931', 'Calle Mefistofeles 16', 'Málaga', '29006', 'Málaga', NULL),
('97189003SL7865247', 'adriancampasayo@hotmail.com', 'adriancampasayo@hotmail.com', 'jaymeererer', 'jaime', 4800.00, '2024-05-07 15:07:37', '2024-05-07 15:08:08', 'https://api.sandbox.paypal.com/v2/checkout/orders/97189003SL7865247', 'aver si funciona', 'ÁVILA', 'malaga', '29008', NULL),
('9A1912262L0427307', 'adriancampasayo@hotmail.com', 'adriancampasayo@hotmail.com', 'raul', 'jaime', 4800.00, '2024-05-07 15:09:28', '2024-05-07 15:09:44', 'https://api.sandbox.paypal.com/v2/checkout/orders/9A1912262L0427307', 'aver si funciona', 'ÁVILA', '29008', 'malaga', NULL),
('9KW0456573978933W', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'adriano', 'campaye', 4800.00, '2024-05-07 15:20:15', '2024-05-07 15:20:37', 'https://api.sandbox.paypal.com/v2/checkout/orders/9KW0456573978933W', 'aver si funciona', 'ÁVILA', '29008', 'malaga', NULL),
('9PF58927K44784437', 'adriancampayo@hotmail.com', 'adriancampayo@hotmail.com', 'javi', 'asdas', 1200.00, '2024-05-08 10:50:48', '2024-05-08 10:57:02', 'https://api.sandbox.paypal.com/v2/checkout/orders/9PF58927K44784437', 'asd', 'ALMERÍA', '29006', 'malaga', NULL),
('WH-0F625967KP7144124-2RS471369H3539227', '', '', '', '', 0.00, '2024-05-07 21:50:35', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-0F625967KP7144124-2RS471369H3539227', '', '', '', '', NULL),
('WH-0LB79464GY620071X-01967810C2152190F', '', '', '', '', 0.00, '2024-05-07 15:21:52', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-0LB79464GY620071X-01967810C2152190F', '', '', '', '', NULL),
('WH-0U844373MY1007454-37923645GP126922E', '', '', '', '', 0.00, '2024-05-07 15:12:44', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-0U844373MY1007454-37923645GP126922E', '', '', '', '', NULL),
('WH-19M7918391887725U-8WY53455NL251043J', '', '', '', '', 0.00, '2024-05-07 21:48:48', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-19M7918391887725U-8WY53455NL251043J', '', '', '', '', NULL),
('WH-2RN2279322461682E-6WD888413B570363C', '', '', '', '', 0.00, '2024-05-07 14:37:23', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-2RN2279322461682E-6WD888413B570363C', '', NULL, NULL, NULL, NULL),
('WH-36J69441H61719911-8P5668381E862440T', '', '', '', '', 0.00, '2024-05-07 15:06:40', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-36J69441H61719911-8P5668381E862440T', '', '', '', '', NULL),
('WH-38863509T9784103C-67E10802PU9440356', '', '', '', '', 0.00, '2024-05-07 15:03:14', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-38863509T9784103C-67E10802PU9440356', '', '', '', '', NULL),
('WH-4HF400528K325101R-52M75007756920405', '', '', '', '', 0.00, '2024-05-07 22:22:31', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-4HF400528K325101R-52M75007756920405', '', '', '', '', NULL),
('WH-4HY44959MX674391R-58C96130TW470992B', '', '', '', '', 0.00, '2024-05-07 15:19:08', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-4HY44959MX674391R-58C96130TW470992B', '', '', '', '', NULL),
('WH-5AR57806939295236-28S32755KV955834S', '', '', '', '', 0.00, '2024-05-07 14:54:57', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-5AR57806939295236-28S32755KV955834S', '', NULL, NULL, NULL, NULL),
('WH-5H6128759K985452Y-1TV54802X8803163W', '', '', '', '', 0.00, '2024-05-07 15:11:41', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-5H6128759K985452Y-1TV54802X8803163W', '', '', '', '', NULL),
('WH-5PB3523629231910V-3G618776GK5834349', '', '', '', '', 0.00, '2024-05-07 21:52:32', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-5PB3523629231910V-3G618776GK5834349', '', '', '', '', NULL),
('WH-5VP813836U994064J-62G52414UM530591F', '', '', '', '', 0.00, '2024-05-07 22:19:02', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-5VP813836U994064J-62G52414UM530591F', '', '', '', '', NULL),
('WH-60V01341U2815000J-37R36353E9742184F', '', '', '', '', 0.00, '2024-05-07 21:56:40', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-60V01341U2815000J-37R36353E9742184F', '', '', '', '', NULL),
('WH-62454201D3573462B-2XA14390446735819', '', '', 'root', '', 0.00, '2024-05-07 14:32:52', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-62454201D3573462B-2XA14390446735819', '', NULL, NULL, NULL, NULL),
('WH-6G647131R9117393F-6TN32756GJ740725C', '', '', '', '', 0.00, '2024-05-07 14:42:34', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-6G647131R9117393F-6TN32756GJ740725C', '', NULL, NULL, NULL, NULL),
('WH-6SW5976236384694L-8KT01382VA248645W', '', '', 'root', '', 0.00, '2024-05-07 14:29:22', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-6SW5976236384694L-8KT01382VA248645W', '', NULL, NULL, NULL, NULL),
('WH-6UK63606A0590732V-2UK68401PN631582U', '', '', '', '', 0.00, '2024-05-07 15:09:48', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-6UK63606A0590732V-2UK68401PN631582U', '', '', '', '', NULL),
('WH-7E264933NM736652P-1BL37554W8610884X', '', '', '', '', 0.00, '2024-05-07 14:47:53', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7E264933NM736652P-1BL37554W8610884X', '', NULL, NULL, NULL, NULL),
('WH-7EM75359XA817360P-81G41005N0186490Y', '', '', '', '', 0.00, '2024-05-07 22:05:34', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7EM75359XA817360P-81G41005N0186490Y', '', '', '', '', NULL),
('WH-7FY67499V6773645X-58E32808J2773441W', '', '', 'root', '', 0.00, '2024-05-07 14:33:47', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7FY67499V6773645X-58E32808J2773441W', '', NULL, NULL, NULL, NULL),
('WH-86812776NY1088238-9M158144B6109780S', '', '', '', '', 0.00, '2024-05-07 22:24:19', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-86812776NY1088238-9M158144B6109780S', '', '', '', '', NULL),
('WH-91R2697132576771F-7ND154265G507800C', '', '', '', '', 0.00, '2024-05-07 21:46:27', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-91R2697132576771F-7ND154265G507800C', '', '', '', '', NULL),
('WH-9GS35170RT577112R-4NM18067C75545417', '', '', '', '', 0.00, '2024-05-07 15:08:12', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-9GS35170RT577112R-4NM18067C75545417', '', '', '', '', NULL),
('WH-9RX12836W5752864B-1NW56624E1502000X', '', '', '', '', 0.00, '2024-05-07 21:59:21', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-9RX12836W5752864B-1NW56624E1502000X', '', '', '', '', NULL),
('WH-9TE236979S594171H-1G398545FT709944C', '', '', '', '', 0.00, '2024-05-07 15:20:41', '0000-00-00 00:00:00', 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-9TE236979S594171H-1G398545FT709944C', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `nombre`, `direccion`, `metodo_pago`, `total`, `fecha_pedido`, `estado`, `cantidad`, `email`) VALUES
(1, '', '', '', 13970.00, '2024-03-27 21:23:21', 'aceptado', 1, 'adriancampayo@hotmail.com'),
(2, '', '', '', 13970.00, '2024-03-27 21:23:26', 'pendiente', 1, NULL),
(3, '', '', '', 13970.00, '2024-03-27 21:24:28', 'aceptar', 1, NULL),
(4, 'asd', 'asd', 'asd', 13970.00, '2024-03-27 21:30:47', 'rechazar', 1, NULL),
(5, 'adrian campayo martin', 'calle martin rosarios tal', 'paypal', 10290.00, '2024-03-27 21:31:18', 'c2', 1, NULL),
(6, 'asd', 'asd', 'visa', 10290.00, '2024-03-27 21:38:22', 'aceptar', 1, NULL),
(7, 'jose', 'asda', 'visa', 8450.00, '2024-03-27 21:42:13', 'aceptar', 1, NULL),
(8, 'este', 'asdasd', 'visa', 8485.00, '2024-03-27 21:53:11', 'aceptado', 1, NULL),
(9, 'asd', 'asdasd', 'visa', 8485.00, '2024-03-27 21:53:58', 'pendiente', 1, NULL),
(10, 'Jesus', 'jesus@gmail.com', 'visa', 35.00, '2024-03-27 21:54:43', '', 1, NULL),
(11, 'adrianaaa', 'asdas', 'mastercard', 1880.00, '2024-03-29 13:31:28', 'rechazar', 1, NULL),
(12, 'dsa', 'dasd', 'visa', 1880.00, '2024-03-29 13:39:30', 'aceptado', 1, NULL),
(13, 'yuuuuuuuuuuuuuuuuu', 'ytyttytyy', 'visa', 980.00, '2024-03-29 14:54:14', 'pendiente', 1, NULL),
(14, 'asd', 'adas', 'visa', 3680.00, '2024-04-09 09:20:48', 'pendiente', 1, 'asd'),
(15, 'adriancmpayo', 'adas', 'visa', 3680.00, '2024-04-09 09:24:00', 'pendiente', 1, NULL),
(16, 'araaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'adas', 'visa', 3680.00, '2024-04-09 09:26:44', 'pendiente', 1, NULL),
(17, 'araaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'adas', 'visa', 3680.00, '2024-04-09 09:28:59', 'pendiente', 1, NULL),
(18, 'intento', 'adas', 'visa', 3680.00, '2024-04-09 09:31:06', 'pendiente', 1, NULL),
(19, 'intento2', 'adas', 'visa', 3680.00, '2024-04-09 09:34:13', 'pendiente', 1, 'adriancampayo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens_recuperacion`
--

CREATE TABLE `tokens_recuperacion` (
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tokens_recuperacion`
--

INSERT INTO `tokens_recuperacion` (`correo`, `token`) VALUES
('adrian@adrian.com', 'a0101cb5802026e1c6cc27dfa5f157b3'),
('adriancampayo@hotmail.com', '7c6ad290b335fad99a6c9d2de6521d23'),
('adriancampayo@hotmail.com', '495e20326427798f7384eb509e3070b0'),
('adriancampayo@hotmail.com', '106fdcdcc91cdd11dad494a59a16d472'),
('adriancampayo@hotmail.com', 'f82c36b5969250c78cf85cac8e2abac7'),
('adriancampayo@hotmail.com', '8a63a3b76de480332ea9cf560bd6cbe1'),
('adriancampayo@hotmail.com', '1be6de97d495ff4544f904d6585bb751'),
('adriancampayo@hotmail.com', '54111744393cc8af27c1a1c4e9136973'),
('adriancampayo@hotmail.com', 'cd58444fe5d5e262f9c4fda8f136e101'),
('adriancampayo@hotmail.com', '91cc3c219b0d43485bf04cfcb24e5d15'),
('javielafrikano@gmail.com', '8c230f3fcdac4cbf003c6a296198902c'),
('javielafrikano@gmail.com', '98a0a5e10b26089a0406df625bcd97ac'),
('javielafrikano@gmail.com', '36127aa91105c7c30c575b781cd68d7a'),
('javielafrikano@gmail.com', 'd9c2d2074185ba3630538c291a7d8a3a'),
('javielafrikano@gmail.com', '9593906bfe5b0bede30a8775ccecfc6c'),
('javielafrikano@gmail.com', '883c1680a45702c0867936842c482db2'),
('javielafrikano@gmail.com', '9782966b351948e527814fbb373c3141'),
('javielafrikano@gmail.com', '208ef0ef209844f110847b9974f24525'),
('javielafrikano@gmail.com', '4e8ba84873b92ea9f1600a816fc63661'),
('javielafrikano@gmail.com', 'e21bf991480429ed414fe85333d55dd2'),
('javielafrikano@gmail.com', '5753182f1e6a69d53aac067a20fc569a'),
('adrian@adrian.com', 'a0101cb5802026e1c6cc27dfa5f157b3'),
('adriancampayo@hotmail.com', '7c6ad290b335fad99a6c9d2de6521d23'),
('adriancampayo@hotmail.com', '495e20326427798f7384eb509e3070b0'),
('adriancampayo@hotmail.com', '106fdcdcc91cdd11dad494a59a16d472'),
('adriancampayo@hotmail.com', 'f82c36b5969250c78cf85cac8e2abac7'),
('adriancampayo@hotmail.com', '8a63a3b76de480332ea9cf560bd6cbe1'),
('adriancampayo@hotmail.com', '1be6de97d495ff4544f904d6585bb751'),
('adriancampayo@hotmail.com', '54111744393cc8af27c1a1c4e9136973'),
('adriancampayo@hotmail.com', 'cd58444fe5d5e262f9c4fda8f136e101'),
('adriancampayo@hotmail.com', '91cc3c219b0d43485bf04cfcb24e5d15'),
('javielafrikano@gmail.com', '8c230f3fcdac4cbf003c6a296198902c'),
('javielafrikano@gmail.com', '98a0a5e10b26089a0406df625bcd97ac'),
('javielafrikano@gmail.com', '36127aa91105c7c30c575b781cd68d7a'),
('javielafrikano@gmail.com', 'd9c2d2074185ba3630538c291a7d8a3a'),
('javielafrikano@gmail.com', '9593906bfe5b0bede30a8775ccecfc6c'),
('javielafrikano@gmail.com', '883c1680a45702c0867936842c482db2'),
('javielafrikano@gmail.com', '9782966b351948e527814fbb373c3141'),
('javielafrikano@gmail.com', '208ef0ef209844f110847b9974f24525'),
('javielafrikano@gmail.com', '4e8ba84873b92ea9f1600a816fc63661'),
('javielafrikano@gmail.com', 'e21bf991480429ed414fe85333d55dd2'),
('javielafrikano@gmail.com', '5753182f1e6a69d53aac067a20fc569a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `primer_apellido`, `segundo_apellido`, `correo`, `contrasena`, `rol`) VALUES
(1, 'adrianadministradorer', 'adrianadministrador', 'adrian', 'adrian@adrian.com', 'adrian', 'admin'),
(3, 'adrian', 'adrian', 'adrian', 'adrian@adrisan.com', 'adrian', 'user'),
(4, 'adrian', 'adrian', 'adrian', 'adrian@adrissssan.com', 'adrian', 'user'),
(5, 'adrian', 'adrian', 'adrian', 'adriasn@adrisan.com', 'adrian', 'user'),
(6, 'adas', 'asd', 'asd', 'adrian@aadrian.com', '453453', 'user'),
(8, 'holita', 'asd', 'asd', 'adriai@aadrian.com', '89789', 'user'),
(10, 'asd', 'asd', 'asd', 'adriancsssampayo@gmail.com', 'holaaaaa', 'user'),
(12, 'asd', 'asd', 'asd', 'adriancampayowwww@hotmail.com', 'rere', 'user'),
(14, 'asd', 'asd', 'asd', 'adriancampsdsdayowwww@hotmail.com', '32', 'user'),
(15, 'asd', 'asd', 'asd', 'adriancampsdsdayosdwwww@hotmail.com', 'asdas', 'user'),
(17, 'asd', 'asd', 'dasd', 'adriancampaddsyo6@gmail.com', 'hola123', 'user'),
(18, 'asd', 'asd', 'asd', '12121mpayo@gmail.com', 'se ha creadfo ono ?', 'user'),
(29, 'asd', 'sda', 'asd', 'adriancampayo@hotmail.com', 'asdas', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paypal_orders`
--
ALTER TABLE `paypal_orders`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
