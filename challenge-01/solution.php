<?php

//verifica si alguna de las dos lista es vacía
function isEmptyList($list1, $list2){
  return trim($list1)==="" || trim($list2)==="";
}

//convierte las listas en dos listas de números
function convertToListNumber($strArr1, $strArr2){
  $list1 = array_map('intval', array_map('trim', explode(',', $strArr1)));
  $list2 = array_map('intval', array_map('trim', explode(',', $strArr2)));
  return [$list1,$list2];
}

//se arma la respuesta segun las reglas de negocio
function makeResponse($intersection){
  return empty($intersection) ? 'false' : implode(',', $intersection);
}

//funcion principal
function findPoint($strArr)
{
  //se valida si son listas vacías para dar una respuesta rapida
  if(isEmptyList($strArr[0],$strArr[1])){
    return "false";
  }
  //en caso de no estar vacías se convierte a lista de númerose
  list($list1, $list2) = convertToListNumber($strArr[0],$strArr[1]);
  $intersection = array_intersect($list1, $list2);
  return makeResponse($intersection);
}

//keep this function call here
echo findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']);


//REGION test
function assertEquals($expected, $actual) {
  echo ($expected === $actual)?"✅ : $expected === $actual\n":"❌ : $expected !== $actual\n";
}

function runTestSuit()
{
  echo "\n\n🧪 Test Suit:\n\n"; 
  assertEquals("1,4,13",findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']));
  assertEquals("1,4,13",findPoint(['1, 2, 4, 13, 15','1, 3, 4, 7, 13']));
  assertEquals("false",findPoint(['1, 3, 4, 7, 13','']));
  assertEquals("false",findPoint(['','1, 3, 4, 7, 13']));
  assertEquals("false",findPoint(['','']));
  assertEquals("1,2,3",findPoint(['1,2,3','1,2,3']));
}
//desconemtar para ejecutar los casos de prueba
//runTestSuit();
//ENDREGION test

