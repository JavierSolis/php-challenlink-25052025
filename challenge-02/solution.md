# Solution Challenge 02

## Versión 1

- Se implementó la solución en el archivo solution.php.
- Se tiene una región para los test delimitado por REGION TEST - ENDREGION TEST.
- Se uso método recursivo para ir buscando las combinaciones posibles.

## Versión 2

- Se implemento el algoritmo de ventana deslizante
- Se mantuvo los test.

# Algoritmo de ventana deslizante

La idea central es tener dos punteros: right (derecho) y left (izquierdo). Inicialmente, ambos se posicionan al principio de la cadena N. El puntero right comienza a recorrer la cadena N, expandiendo la ventana hasta que esta cumpla la condición de contener todos los caracteres requeridos del string K.

Una vez que se encuentra la primera combinación válida, entra en juego el puntero left. Mientras la ventana actual (que va desde left hasta right) siga cumpliendo la condición, el puntero left se mueve hacia la derecha, intentando "achicar la ventana". En este proceso de contracción pueden pasar dos cosas:

- Si la ventana reducida sigue cumpliendo la condición: Se verifica su tamaño. Si es menor que la longitud mínima encontrada hasta el momento, se guarda esta nueva longitud y la subcadena correspondiente. Luego, el puntero left continúa achicando la ventana.
- Si la ventana reducida ya no cumple la condición: El puntero left se detiene en esa posición (justo donde la ventana dejó de ser válida), y el bucle de contracción termina.

Cuando el bucle de contracción finaliza, el puntero right vuelve a avanzar. Esto se conoce como "agrandar la ventana" nuevamente, buscando que la subcadena (desde la posición actual de left hasta right) vuelva a cumplir la condición de contener todos los caracteres de K.

Una vez que la condición se cumple de nuevo, se repite el proceso de "achicar la ventana" con el puntero left. Este ciclo de "agrandar" y "achicar" la ventana continúa hasta que el puntero right haya recorrido toda la cadena N. Al finalizar, nos quedaremos con la combinación más pequeña encontrada.

Referencia: https://www.geeksforgeeks.org/find-the-smallest-window-in-a-string-containing-all-characters-of-another-string/

# Pruebas

**Realizadas tanto en la versión 1 y 2**

```php
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
```

![Pruebas](../assets/challenge02_test.png)
