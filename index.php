<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mayor y Primos - PHP básico</title>
    <style>
        input[type="number"] {
            -moz-appearance: textfield;
        }
        
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>

<h2>Ingrese 3 números</h2>

<form method="post">
    Número 1: <input type="number" name="n1" value="<?php echo $_POST['n1'] ?? ''; ?>" required><br><br>
    Número 2: <input type="number" name="n2" value="<?php echo $_POST['n2'] ?? ''; ?>" required><br><br>
    Número 3: <input type="number" name="n3" value="<?php echo $_POST['n3'] ?? ''; ?>" required><br><br>
    
    <button type="submit" name="accion" value="mayor">Mostrar el mayor</button>
    <button type="submit" name="accion" value="primos">Ver números primos</button>
</form>

<hr>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $n1 = filter_input(INPUT_POST, 'n1', FILTER_VALIDATE_INT);
    $n2 = filter_input(INPUT_POST, 'n2', FILTER_VALIDATE_INT);
    $n3 = filter_input(INPUT_POST, 'n3', FILTER_VALIDATE_INT);
    $accion = $_POST['accion'] ?? '';

    if ($n1 === false || $n2 === false || $n3 === false) {
        echo "<p style='color:red'>Ingrese solo números enteros válidos.</p>";
    } else {
        $numeros = [$n1, $n2, $n3];

        if ($accion === 'mayor') {
            $mayor = max($numeros);
            echo "<p><b>El número mayor es: $mayor</b></p>";
            echo "Números ingresados: " . implode(" - ", $numeros) . "<br>";
        } 
        elseif ($accion === 'primos') {
            echo "<p><b>Números primos:</b></p>";
            
            $hayPrimos = false;
            foreach ($numeros as $num) {
                if (esPrimo($num)) {
                    echo "$num → ES PRIMO<br>";
                    $hayPrimos = true;
                } else {
                    echo "$num → no es primo<br>";
                }
            }
            
            if (!$hayPrimos) {
                echo "<p>Ninguno es número primo.</p>";
            }
        }
    }
}

// Función para saber si es primo
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

?>

</body>
</html>