<?php
require_once 'conexion.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Obtener los datos JSON enviados desde el cliente
$data = json_decode(file_get_contents('php://input'), true);

// Validar que se hayan recibido los datos necesarios
if (empty($data['cedula']) ) {
    echo json_encode(array('error' => 'La cédula es requerida para eliminar un usuario'));
    exit;
}

//Validar que la cédula no exista ya en la base de datos
$stmtCedula = $bd->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
$stmtCedula->bindValue(':cedula', $data['cedula'], PDO::PARAM_STR);
$stmtCedula->execute();   

if($stmtCedula->rowCount() > 0){
    $stmtDelete = $bd->prepare("DELETE FROM usuarios WHERE cedula = :cedula");
    $stmtDelete->bindValue(':cedula', $data['cedula'], PDO::PARAM_STR);
    $stmtDelete->execute();
    if($stmtDelete->rowCount() > 0){
        echo json_encode(array('mensaje' => 'Usuario eliminado con éxito'));
    } else {
        echo json_encode(array('error' => 'Error al eliminar el usuario'));
    }
} else {
    echo json_encode(array('error' => 'La cédula ingresada no existe'));
    exit;
}
?>