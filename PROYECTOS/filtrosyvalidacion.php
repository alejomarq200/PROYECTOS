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
foreach ($retornar as $key => $campo) {
    if (!$campo) {
        echo '<br>hay un error en el campo: ' . $key . '</br>';
    } else {
        echo $key . '=> ' . $campo;
    }
}

/*if ($retornar['nombre'] && $retornar['pwd']) {
    echo 'llegaron los datos c';
} else {
    echo 'no llegaron los datos c';
}*/
//echo $retornar ? 'Llegaron los datos correctamente' : 'No llegaron los datos correctamente';

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="nombre" id="">
    <input type="password" name="pwd" id="">
    <button type="submit">Enviar y Validar</button>
</form>