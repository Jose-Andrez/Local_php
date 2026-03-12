<?php

echo "Ingrese 3 números enteros:\n\n";

$n1 = leerNumero("Número 1: ");
$n2 = leerNumero("Número 2: ");
$n3 = leerNumero("Número 3: ");

$numeros = [$n1, $n2, $n3];

echo "\n¿Qué desea hacer?\n";
echo "1) Mostrar el mayor\n";
echo "2) Ver números primos\n";
$opcion = trim(readline("Elija (1 o 2): "));

if ($opcion === '1') {
    $mayor = max($numeros);
    echo "\nEl número mayor es: $mayor\n";
    echo "Números ingresados: " . implode(" - ", $numeros) . "\n";
} 
elseif ($opcion === '2') {
    echo "\nNúmeros primos:\n";
    $hayPrimos = false;
    foreach ($numeros as $num) {
        if (esPrimo($num)) {
            echo "$num → ES PRIMO\n";
            $hayPrimos = true;
        } else {
            echo "$num → no es primo\n";
        }
    }
    if (!$hayPrimos) {
        echo "Ninguno es número primo.\n";
    }
} else {
    echo "Opción no válida.\n";
}

// Función auxiliar para leer número válido
function leerNumero($mensaje) {
    do {
        $entrada = trim(readline($mensaje));
        $num = filter_var($entrada, FILTER_VALIDATE_INT);
        if ($num === false) {
            echo "¡Por favor ingrese un número entero válido!\n";
        }
    } while ($num === false);
    return $num;
}

// Función esPrimo (la misma que tenías)
function esPrimo($num) {
    if ($num <= 1) return false;
    if ($num == 2) return true;
    if ($num % 2 == 0) return false;
    
    $limite = (int)sqrt($num);
    for ($i = 3; $i <= $limite; $i += 2) {
        if ($num % $i == 0) return false;
    }
    return true;
}