<?php
header("Access-Control-Allow-Origin: *");
require_once 'src/Mandrill.php';

try {
    $mandrill = new Mandrill('gNY9JCZnJKFIAfE9jkjdmQ');
    $message = array(
        'html' => '<!DOCTYPE html><html><head><meta charset="utf-8"></head><body><div style="padding-left:50px;padding-right:50px;"><body><h1>Has recibido un nuevo mensaje desde el contacto de la pagina web, estos son los datos del cliente:</h1><h2>Nombre: '.$_POST["nombre"].'</h2><h3>Correo Electronico: '.$_POST["email"].'<h5>Mensaje del cliente: '.$_POST["messages"]',
        'text' => '',
        'subject' => 'Contacto ',
        'from_email' => "noreply@bpr.com.mx",
        'from_name' => 'El equipo de Trinova',
        'to' => array(
            array(
                'email' => "ventas@bpr.com.mx",
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
