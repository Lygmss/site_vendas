<?php 
 
//  $numero1 = 10;
//  $numero2 = 5;

//  $resultado = $numero1 + $numero2;
//  echo "sua soma é: $resultado"; 

//  $numero1 = 1000;
//  $numero2 = 5;

//  $resultado = $numero1 + $numero2;
//  echo "sua soma é: $resultado"; 

// ------------------------------------------------------

// Implementação de função de dois numeros
function soma($n1,$n2){
    $resultado= $n1+$n2;
    echo $resultado;
    echo "<br>";
}

// executar a funcao
// nome da funcao + parametros
// ex: soma= nome
// 10 = primeiro parametro
// 5 = segundo  paramentro 

soma(10,5);
soma(50,44);
echo "<hr>";

function subtracao($n1,$n2){
    $resultado= $n1-$n2;
    echo $resultado;
    echo "<br>";
}

subtracao(9,6);
subtracao(20,8);
echo "<hr>";

function multiplicacao($n1,$n2){
    $resultado= $n1*$n2;
    echo $resultado;
    echo "<br>";

}

multiplicacao(55,96);
echo "<hr>";

function divisao($n1,$n2){
    $resultado= $n1/$n2;
    echo $resultado;
    echo "<br>";

}

divisao(55,96);
echo "<hr>";


?>