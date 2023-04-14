<?php

/* 

1) importar en una base de datos mysql montada localmente, el archivo datos.sql.
    El mismo contiene dos tablas:

    tabla users:
        id: int
        first_name: varchar
        last_name: varchar
        email: varchar
        status: enum

    tabla user_stats:
        id: int
        user_id: int
        views: int
        clicks: int
        conversions: int
        date: datetime

2) crear una clase llamada UserStats, que debe contener al menos un método publico llamado getStats(). 

    getStats debe recibir tres parametros: 
        dateFrom    : fecha desde en formato año-mes-día (Y-M-D) - requerido
        dateTo      : fecha hasta en formato año-mes-día (Y-M-D) - requerido
        totalClicks : número entero o NULL - NO es requerido

    Debe conectar por mysql a la db creada en el paso anterior y ejecutar una consulta a la tabla de user_stats, filtrando 
    por fechas desde-hasta (usando los parametros dateFrom y dateTo) y solamente los usuarios activos (campo "status", valor "active" en la tabla de users).

    En caso que el parámetro totalClicks este presente y no sea NULL, se debe filtrar por el total de clicks para que sea mayor o igual al valor pasado en totalClicks

    Finalmente el método debe devolver de cada usuario, la siguiente información:

        - full_name: nombre y apellido (ambos datos en una sola linea)
        - total_views: total de views
        - total_clicks: total de clicks
        - total_conversions: total de conversions
        - cr: (conversion rate) calcularlo con la siguiente formula (total de conversions / total de clicks)*100 y redondearlo a 2 decimales
        - last_date: última fecha en que el usuario tuvo estadísticas dentro del rango filtrado. Fecha en formato año-mes-día (Y-M-D)


    A modeo de test, llamando al método getStats('2022-10-01', '2022-10-15', 9000), la salida debe ser:

    Array
    (
        [0] => Array
            (
                [full_name] => marge simpson
                [total_views] => 8312072
                [total_clicks] => 9271
                [total_conversions] => 639
                [cr] => 6.89
                [last_date] => 2022-10-15
            )

        [1] => Array
            (
                [full_name] => bart simpson
                [total_views] => 9513413
                [total_clicks] => 9436
                [total_conversions] => 655
                [cr] => 6.94
                [last_date] => 2022-10-14
            )

    )


*/

require_once "database.php";
require_once "models/UserStats.php";

$db = new Database();

$conn = $db->getConnection();

Class UserStats {
    private $model;

    public function __construct($conn){
        $this->model = new UserStatsModel($conn);
    }

    public function getStats($dateFrom, $dateTo, $totalClicks = null){
        $result = $this->model->selectStats($dateFrom, $dateTo, $totalClicks);

        $stats = array();
        while($row = $result->fetch_assoc()) {
            $stats[] = array(
                'full_name' => $row['full_name'],
                'total_views' => $row['total_views'],
                'total_clicks' => $row['total_clicks'],
                'total_conversions' => $row['total_conversions'],
                'cr' => $row['cr'],
                'last_date' => $row['last_date']
            );
        }

        return $stats;
    }
    
}

$userStats = new UserStats($conn);
$resultStats = $userStats->getStats('2022-10-01', '2022-10-15', 9000);

print_r($resultStats);

/*

Array
(
    [0] => Array
        (
            [full_name] => marge simpson
            [total_views] => 8312072
            [total_clicks] => 9271
            [total_conversions] => 639
            [cr] => 6.89
            [last_date] => 2022-10-15 10:00:11
        )

    [1] => Array
        (
            [full_name] => bart simpson
            [total_views] => 9513413
            [total_clicks] => 9436
            [total_conversions] => 655
            [cr] => 6.94
            [last_date] => 2022-10-14 16:39:29
        )

)

*/