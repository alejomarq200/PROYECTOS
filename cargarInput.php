<?php
// Configuración de cabeceras para JSON
require_once 'conexion.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['userId'])) {
    echo json_encode(array('error' => 'ID es requerido'));
}

$stmtSearch = $bd->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmtSearch->bindValue(':id', $data['userId'], PDO::PARAM_INT);
$stmtSearch->execute();

if ($stmtSearch->rowCount() > 0) {
    $usuario = $stmtSearch->fetch();
    echo json_encode(array(
        'id' => $usuario->id,
        'cedula' => $usuario->cedula,
        'nombre' => $usuario->nombre,
        'apellido' => $usuario->apellido
    ));
} else {
    echo json_encode(array('error' => 'Usuario no encontrado'));
}
