<?php
//funcion definida
function retornar()
{
    return 2 * 1;
}

function retornarOperacion($numero)
{
    $multiplo = 15;
    return $multiplo * $numero;
}

function retornarUnValor($numero)
{
    $numero = $numero * 2;
    return $numero;
}

function retornarBool($numero)
{
    if (!empty($numero) && is_numeric($numero)) {
        return true;
    } else {
        // echo 'el valor no es númerico';
        return false;
    }
}

function retornarArray($nombre, $edad)
{
    return array('nombre' => $nombre, 'edad' => $edad);
}
$palabra = 'Hola';

function contarCaracteres($palabra)
{
    for ($i = 0; $i < strlen($palabra); $i++) {
    }
    return ' el total de letra es :' . $i;
}

$cadena = ['HOLA', 'yo'];

function convertirPalabrasMin(array $cadena)
{
    $retornado = null;
    foreach ($cadena as $c) {
        if (ctype_lower($c)) {
            $retornado = 'el valor se encuentra en minúsculas ' . $c;
        } else {
            $retornado = 'el valor no se encuentra en minúsculas ' . $c;
        }
    }
    return $retornado;
}

$cadena2 = ['no', 'hola'];

$convertidorMin = convertirPalabrasMin($cadena2);

function convertirPalabras(array $cadena)
{
    $retornado = [];
    foreach ($cadena as $c) {
        if (ctype_upper($c)) {
            $retornado[] = 'el valor se encuentra en mayúsculas ' . $c;
        } else {
            $retornado[] = 'el valor no se encuentra en mayúsculas ' . $c;
        }
    }
    return $retornado;
}

$total = retornar();
$operacion = retornarOperacion(20);
$valor = retornarUnValor(5);
$bool = retornarBool(1);
$datos = retornarArray('Jose', 15);
$contador = contarCaracteres($palabra);
$palabrasMay = convertirPalabras($cadena);
$palabrasMin = convertirPalabrasMin($cadena2);

echo '<br>' . $total . '</br>';
echo '<br>' . $operacion . '</br>';
echo '<br>' . $valor . '</br>';
echo $bool ? true : false;
echo '<br>' . $datos['nombre'] . ', ' . $datos['edad'] . '</br>';
echo '<br>' . $contador . '</br>';
echo '<br>' . $palabrasMin . '</br>';

//Iteramos arreglo para obtener valores
for ($i = 0; $i < count($palabrasMay); $i++) {
    echo '<br>' . $palabrasMay[$i] . '</br>';
}
