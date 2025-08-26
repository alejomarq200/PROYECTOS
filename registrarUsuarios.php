<?php
require_once 'conexion.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Obtener los datos JSON enviados desde el cliente
/* El fragmento de código PHP json_decode(file_get_contents('php://input'), true)
se usa comúnmente en aplicaciones PHP para recibir y procesar datos JSON enviados 
en el cuerpo de una solicitud HTTP, particularmente para puntos finales de API. */

$data = json_decode(file_get_contents('php://input'), true);

// Validar que se hayan recibido los datos necesarios
if (empty($data['cedula']) || empty($data['nombre']) || empty($data['apellido'])) {
    echo json_encode(array('error' => 'Faltan datos requeridos'));
    exit;
}

//Validar que la cédula no exista ya en la base de datos
$stmtCedula = $bd->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
$stmtCedula->bindValue(':cedula', $data['cedula'], PDO::PARAM_STR);
$stmtCedula->execute();   

if($stmtCedula->rowCount() > 0){
    echo json_encode(array('error' => 'La cédula ya está registrada'));
    exit;
}

// Insertar el nuevo usuario en la base de datos
$stmt = $bd->prepare('INSERT INTO usuarios (cedula, nombre, apellido) VALUES (:cedula, :nombre, :apellido)');
$stmt->bindValue(':cedula', $data['cedula'], PDO::PARAM_STR);
$stmt->bindValue(':nombre', $data['nombre'], PDO::PARAM_STR);
$stmt->bindValue(':apellido', $data['apellido'], PDO::PARAM_STR);
$stmt->execute();

if($stmt->rowCount() > 0){
    echo json_encode(array('success' => 'Usuario registrado con éxito'));
} else {
    echo json_encode(array('error' => 'Error al registrar el usuario'));
}