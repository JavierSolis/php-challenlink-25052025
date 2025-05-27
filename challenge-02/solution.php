<?php

/**
 * Retorna si es posible encontrar una combinación de $K en $N
 */
function isPossibleFoundCombination($N, $K, $minLenCurrent) {
    // Si la cadena K es mayor a la cadena N, no es posible que esté dentro
    if (strlen($N) < strlen($K)) {
        return false;
    }
    // Si la menor combinación es igual a la longitud de K, ya no es posible que sea menor
    if ($minLenCurrent == strlen($K)) {
        return false;
    }
    return true;
}


function removeFirst($string, $charToDelete) {
    $position = strpos($string, $charToDelete);
    if ($position !== false) {
        return substr_replace($string, "", $position, 1);
    } else {
        return $string;
    }
}

/**
 * Función recursiva que irá buscando la combinación en la cadena aún más pequeña
 * Condición de detenerse será:
 * - o la combinación ya no es posible de ser menor
 * - o la cadena ya es menor a la combinación buscada
 *
 * $N primera cadena donde se buscará la combinación mínima
 * $K la cadena que se buscará
 * $minCombination es el mínimo actual que se encontró
 *
 */
function searchSmallCombination($N, $K, $minCombination) {
    if (!isPossibleFoundCombination($N, $K, strlen($minCombination))) {
        return $minCombination;
    }

    // Se inicia en -1 en caso no encuentre la subcadena
    $lenCombination = PHP_INT_MAX;
    $posInitial = -1;
    $posEnd = -1;
    // Flag para indicar que se encontró el primer caracter y iniciar los valores
    $flagIsFirst = true;
    // KCopy se usará para llevar la cuenta si la combinación tiene todos los caracteres de K
    $kCopy = $K;
    // Se itera buscando cada caracter en N y quitándolo de la copia de K, si K queda vacío se obtuvo toda la combinación
    for ($indexN = 0; $indexN < strlen($N); $indexN++) {
        $char = $N[$indexN];

        if (str_contains($K, $char)) {
            $kCopy = removeFirst($kCopy, $char);
            if ($flagIsFirst) {
                $flagIsFirst = false;
                $posInitial = $indexN;
            }
        }

        if (strlen($kCopy) < 1) {
            $posEnd = $indexN;
            $lenCombination = $posEnd - $posInitial + 1;
            break;
        }
    }

    // Se escoge la mínima combinación de la hallada vs la actual min
    if ($posEnd != -1 && $lenCombination < strlen($minCombination)) {
        $minCombination = substr($N, $posInitial, $lenCombination);
    }

    return searchSmallCombination(substr($N, 1), $K, $minCombination);
}

function noIterate($strArr)
{
    return searchSmallCombination($strArr[0], $strArr[1], $strArr[0]);
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
//runTestSuit();
//ENDREGION test