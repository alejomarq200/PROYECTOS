<?php
// Configuración de cabeceras para JSON
require_once 'conexion.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$stmt = $bd->prepare("SELECT * FROM usuarios");
$stmt->execute();
$usuarios = $stmt->fetchAll();
if($stmt->rowCount() > 0){
    $datos = array();
    foreach ($usuarios as $usuario) {
        $datos[] = array(
            'id' => $usuario->id,
            'cedula' => $usuario->cedula,
            'nombre' => $usuario->nombre
        );
    }
    echo json_encode($datos);
} else {
    echo json_encode(array('message' => 'No users found'));
}