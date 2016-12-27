<?php
header("Access-Control-Allow-Origin: *");
require_once 'src/Mandrill.php';

try {
    $mandrill = new Mandrill('_pdH4ZMORJjpfKLCL2lxpQ');
    $message = array(
        'html' => '<!DOCTYPE html><html><head><meta charset="utf-8"></head><body><div style="padding-left:50px;padding-right:50px;"><body><h1>Has recibido un nuevo mensaje desde el contacto de la pagina web, estos son los datos del cliente:</h1><h2>Nombre: '.$_POST["nombre"].'</h2><h3>Correo Electronico: '.$_POST["email"].'</h3><h4>Telefono: '.$_POST["phone"].'<h5>Mensaje del cliente: '.$_POST["messages"].'</h5><p>Ciudad de donde cotiza: '.$_POST["city"].'.</p><p>$'.$_POST["inversion"].' cantidad de inversion del cliente.</p></body></html>',
        'text' => '',
        'subject' => 'Contacto ',
        'from_email' => "noreply@trinova.com.mx",
        'from_name' => 'El equipo de Trinova',
        'to' => array(
            array(
                'email' => "ventas@trinova.com.mx",
                // 'name' => 'Recipient Name',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => $_POST["email"]),



    );
    $async = false;
    $result = $mandrill->messages->send($message, $async);
    print_r($result);
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}

?>
