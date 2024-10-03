<?php
// Verificar si se ha enviado el formulario desde el carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['total_carrito'])) {
    $total_carrito = $_POST['total_carrito'];
    $owner_email = $_POST['OwnerEmail']; // Obtener la dirección de correo electrónico del propietario

    // Código para enviar el correo electrónico
    $to = $owner_email;
    $subject = 'Confirmación de pago';
    $message = 'Estimado usuario, su pago por ' . $total_carrito . ' ha sido procesado con éxito.';
    $headers = 'From: adriancampayo@hotmail.com' . "\r\n" .
        'Reply-To: adriancampayo@hotmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Enviar el correo electrónico
    mail($to, $subject, $message, $headers);

    // Otro código relacionado con el procesamiento del pago y redirección, etc.
}
?>
