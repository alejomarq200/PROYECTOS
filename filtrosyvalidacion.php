<?php

//Filtros: Input array
$filtros = [
    "nombre" => FILTER_VALIDATE_EMAIL,
    "pwd" => array(
        "filter" => FILTER_VALIDATE_INT,
        array(
            'options' => array(
                'min_range' => 1,
                'max_range' => 10
            )
        )
    )
];

$retornar = filter_input_array(INPUT_POST, $filtros);
//var_dump($retornar);

//Iteramos para saber dónde hay el error
function validarConFiltrosBucle($retornar)
{
    foreach ($retornar as $key => $campo) {
        if (!$campo) {
            echo '<br>hay un error en el campo: ' . $key . '</br>';
        }
    }
    return $campo;
}


function validarConFiltrosMatch($retornar)
{
    //Separamos array en 2 partes y con ternario evaluamos lo devuelto para convertir en string
    $clave = ($retornar['nombre'] ? '1' : '0') . '-' . ($retornar['pwd'] ? '1' : '0');

    $return_value = match ($clave) {
        '1-1' => 'Campos con formato correcto',
        '0-1' => 'El nombre no cumple con el foramto correcto',
        '1-0' => 'La contraseña no cumple con el foramto correcto',
        default => 'Campos con formato incorrecto',
    };
    return $return_value;
}

function validarConFiltrosSwitch($retornar)
{
    $mensaje = null;
    
    $array =
        [
            (String)$retornar['nombre'],
            (String)$retornar['pwd']
        ];
    /*$array = [
        true,
        false
    ];*/

    switch ($array) {
        case array(1, 1):
            $mensaje = 'campos correctos';
            break;

        case array(0, 1):
            $mensaje = 'campo nombre formato incorrecto';
            break;

        case array(1, 0):
            $mensaje = 'campo pwd formato incorrecto';
            break;
        default:
            $mensaje = 'campos incorrectos';
            break;
    }

    return $mensaje;
}

var_dump($retornar);
echo $cadena = validarConFiltrosSwitch($retornar);

//$campo = validarConFiltrosBucle($retornar);

//$campo = validarConFiltrosMatch($retornar);
//var_dump($campo);



/*if (empty($campo)) {
    //Se valida la función para una posterior manipulación de variables
    echo 'los dato se procesaron correctamente';
}*/

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="nombre" id="">
    <input type="password" name="pwd" id="">
    <button type="submit">Enviar y Validar</button>
</form>