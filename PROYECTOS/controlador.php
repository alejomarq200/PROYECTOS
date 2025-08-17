<?php

//Validamos el método que que necesitamos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Definimos estructura (array) y guardamos parametros
    $arreglo =
        [
            trim($_POST['user']),
            trim($_POST['pwd'])
        ];

    //Arreglo indefinido
    $mensajesError = [];

    //Definimos patron de validación
    $patronNombre = "/^[A-Za-zÑñÁÉÍÓÚáéíóú\s'-]+$/";

    //Semaforo - Control validación
    $semaforo = true;

    //ISSET - EMPTY
    if (empty($arreglo[0])) {
        $semaforo = false;
        $mensajesError[] = 'el nombre de usuario es obligatorio';
    }

    //ISSET - EMPTY
    if (empty($arreglo[1])) {
        $semaforo = false;
        $mensajesError[] = 'la contraseña es obligatorioa';
    }

    'SELECT id FROM usuarios WHERE id = 1';

    if ($semaforo) {
        echo 'los datos llegaron correctamente';
    } else {
        //Iteramos el mensaje error
        foreach ($mensajesError as $error) {
            echo '<br>' . $error . '</br>';
        }
    }
} else {
    //Redirigimos
    header('Location: error.php');
}
