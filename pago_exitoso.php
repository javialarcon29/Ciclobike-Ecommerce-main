<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <!-- Agrega el CDN de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <!-- Contenido de tu página pago_exitoso.php -->
    

    <!-- Script para mostrar la SweetAlert -->
    <script>
        // Muestra la alerta SweetAlert
        Swal.fire({
            title: '¡Pago Exitoso!',
            text: 'Tu pago se ha procesado correctamente.',
            icon: 'success'
        }).then((result) => {
            // Redirigir al usuario después de cerrar la alerta
            window.location.href = 'pasarela.php'; // Cambiar por la URL correcta
        });
    </script>
</body>
</html>
