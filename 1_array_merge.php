<?php

/* 
dada una lista de nombres y otra de colores, crear una función que devuelva un array 
en el cual, de forma ordenada, a cada nombre se le asigne un color de la lista de colores (en caso de que existan menos colores
que nombres, se debe volver a empezar por el primer color), por ej:

[
    ['name' => 'name1', 'color' => 'red'],
    ['name' => 'name2', 'color' => 'green'],
    ['name' => 'name3', 'color' => 'blue'],
    ['name' => 'name4', 'color' => 'yellow'],
    ['name' => 'name5', 'color' => 'white'],    
    ['name' => 'name6', 'color' => 'red'],
    ['name' => 'name7', 'color' => 'green'],
    ...
    ['name' => 'name10', 'color' => 'white'],
    ['name' => 'name11', 'color' => 'red'],
]

La función debe seguir funcionando, ya sea se le agreguen o quiten nombres o colores

 */

function assignColorsToNames(array $names, array $colors): array {
    $result = [];
    $colorIndex = 0;
    foreach ($names as $name) {
        $result[] = ['name' => $name, 'color' => $colors[$colorIndex]];
        $colorIndex++;
        if ($colorIndex >= count($colors)) {
            $colorIndex = 0;
        }
    }
    return $result;
}

$getNames = function(){
    $names = [];
    for($i=0;$i<21;$i++){
        $names[] = 'name' . ($i + 1);
    }
    return $names;
};

$names = $getNames();

$colors = ['red', 'green', 'blue', 'yellow', 'white'];

$result = assignColorsToNames($names, $colors);

print_r($result);

/*
Array
(
    [0] => Array
        (
            [name] => name1
            [color] => red
        )

    [1] => Array
        (
            [name] => name2
            [color] => green
        )

    [2] => Array
        (
            [name] => name3
            [color] => blue
        )

    [3] => Array
        (
            [name] => name4
            [color] => yellow
        )

    [4] => Array
        (
            [name] => name5
            [color] => white
        )

    [5] => Array
        (
            [name] => name6
            [color] => red
        )

    [6] => Array
        (
            [name] => name7
            [color] => green
        )

    [7] => Array
        (
            [name] => name8
            [color] => blue
        )

    [8] => Array
        (
            [name] => name9
            [color] => yellow
        )

    [9] => Array
        (
            [name] => name10
            [color] => white
        )

    [10] => Array
        (
            [name] => name11
            [color] => red
        )

    [11] => Array
        (
            [name] => name12
            [color] => green
        )

    [12] => Array
        (
            [name] => name13
            [color] => blue
        )

    [13] => Array
        (
            [name] => name14
            [color] => yellow
        )

    [14] => Array
        (
            [name] => name15
            [color] => white
        )

    [15] => Array
        (
            [name] => name16
            [color] => red
        )

    [16] => Array
        (
            [name] => name17
            [color] => green
        )

    [17] => Array
        (
            [name] => name18
            [color] => blue
        )

    [18] => Array
        (
            [name] => name19
            [color] => yellow
        )

    [19] => Array
        (
            [name] => name20
            [color] => white
        )

    [20] => Array
        (
            [name] => name21
            [color] => red
        )

)
 */