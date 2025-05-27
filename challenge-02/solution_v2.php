<?php

function noIterate($strArr)
{
    $N = $strArr[0]; // La cadena grande donde vamos a buscar la combinación
    $K = $strArr[1]; // Los caracteres que debe contener nuestra subcadena mínima

    $lenN = strlen($N);
    $lenK = strlen($K);

  
    // Paso 1: Preparamos K - Creamos su contador de caracteres
    // Contamos cuántas veces aparece cada caracter en K 
    // esto lo usaremos para comparar si se cumple la consición
    $kCharCounts = array_count_values(str_split($K));
    // contador de cantidad de caracteres diferentes necesitamos, es mas barato de comparar
    $requiredChars = count(array_keys($kCharCounts));

    // Inicializamos nuestros contadores de control
    $windowCharCounts = []; // Aquí contaremos los caracteres que están DENTRO de nuestra ventana actual
    $matchedChars = 0;      // Nos dice cuántos caracteres de K ya hemos "encontrado" en la ventana
    $minLength = PHP_INT_MAX; // La longitud más pequeña que hemos visto hasta ahora
    $result = "";           // La subcadena más corta que cumple la condición

    $left = 0; 

    // Paso 2: El puntero 'right' comienza a ir a la derecha (agrandar la ventana)
    for ($right = 0; $right < $lenN; $right++) {
        $char = $N[$right];
        // Registramos este caracter en el contador de la ventana
        $windowCharCounts[$char] = ($windowCharCounts[$char] ?? 0) + 1;

        // Si este caracter es uno que necesitamos de K...
        // Y si su cantidad en la ventana ya llegó a la cantidad que pide K...
        // ¡Entonces hemos "cubierto" uno de nuestros TIPOS de caracteres de K!
        if (isset($kCharCounts[$char]) && $windowCharCounts[$char] === $kCharCounts[$char]) {
            $matchedChars++;
        }

        // Paso 3: La ventana ya contiene todos los caracteres de K, cumple la condición, ahora toca achicar la ventana
        // Este bucle se activa SÓLO si nuestra ventana actual ya tiene todos los tipos de caracteres necesarios de K
        while ($matchedChars === $requiredChars) {
            // Calculamos la longitud de la ventana actual (desde 'left' hasta 'right')
            $currentWindowLength = $right - $left + 1;

            // Si esta ventana es más pequeña que la mejor que hemos encontrado...
            if ($currentWindowLength < $minLength) {
                $minLength = $currentWindowLength; // Actualizamos la longitud mínima
                $result = substr($N, $left, $minLength); // Y guardamos la subcadena
            }

            // Ahora intentamos ACHICAR la ventana desde la izquierda para ver si podemos hacerla aún más pequeña
            $leftChar = $N[$left]; // El caracter que está a punto de salir de la ventana

            // Disminuimos su conteo (porque ya no estará en la ventana)
            // no nos preocupamos que no exista porque esta ventana es la que ya se recorrió
            $windowCharCounts[$leftChar]--;

            // Si KChar contiene ese caracter
            // y Si el caracter que salió era uno que necesitábamos de K
            // Y si al quitarlo, la cantidad de ese caracter en la ventana ya no cumple la condición
            // entonces quitamos una caracter del match
            if (isset($kCharCounts[$leftChar]) && $windowCharCounts[$leftChar] < $kCharCounts[$leftChar]) {
                $matchedChars--;
            }

            $left++; // Movemos el puntero izquierdo, achicando la ventana
        }
    }

    // Paso 4: Devolvemos la subcadena más pequeña que encontramos en todo el recorrido
    return $result;
}


// keep this function call here
echo noIterate(["ahffaksfajeeubsne", "jefaa"]);


//REGION test
function logg($str) {
    echo "\n $str \n";
}

function assertEquals($expected, $actual) {
    echo ($expected === $actual) ? "✅ : $expected === $actual\n" : "❌ : $expected !== $actual\n";
}

function runTestSuit()
{
    echo "\n\n🧪 Test Suit:\n\n";

    assertEquals("dae", noIterate(["aaabaaddae", "aed"]));
    assertEquals("aabd", noIterate(["aabdccdbcacd", "aad"]));
    assertEquals("aksfaje", noIterate(["ahffaksfajeeubsne", "jefaa"]));
    assertEquals("affhkkse", noIterate(["aaffhkksemckelloe", "fhea"]));

    assertEquals("a", noIterate(["aaaaaaaaaa", "a"]));
    assertEquals("aa", noIterate(["aaaaaaaaaa", "aa"]));
    assertEquals("aaaaaaaaaa", noIterate(["aaaaaaaaaa", "aaaaaaaaaa"]));
    assertEquals("b", noIterate(["aaaaaaaaab", "b"]));
    assertEquals("bb", noIterate(["aaaaaaaabb", "bb"]));
    assertEquals("b", noIterate(["aaaabaaaaa", "b"]));
    assertEquals("bnnnnnnnnnnnna", noIterate(["bnnnnnnnnnnnna", "ab"]));
    assertEquals("annnnnnnnnnnnb", noIterate(["annnnnnnnnnnnb", "ab"]));
    assertEquals("aaffhkksemckelloe", noIterate(["aaffhkksemckelloe", "aaffhkksemckelloe"]));
}
// Descomentar para ejecutar los casos de prueba
// runTestSuit();
//ENDREGION test