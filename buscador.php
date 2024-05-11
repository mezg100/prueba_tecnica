<?php

$ejemploDestinos1 = [
  [
    "nombre" => "America", 
    "hijos" => [
      [
        "nombre" => "Argentina",
        "hijos" => [
          [
            "nombre" => "Buenos Aires", 
            "hijos" => [
              [
                "nombre" => "Pilar",
                "hijos" => [["nombre" => "Manzanares"]]
              ]
            ]
          ],
          ["nombre" => "Córdoba"]
        ],
      ],
      [
        "nombre" => "Venezuela",
        "hijos" => [
          ["nombre" => "Caracas"],
          ["nombre" => "Vargas"]
        ]
      ]
    ]
  ]
];

$ejemploDestinos2 = [
  [
    "nombre" => "America", 
    "hijos" => [
      [
        "nombre" => "Argentina",
        "hijos" => [
          ["nombre" => "Buenos Aires"],
          ["nombre" => "Córdoba"],
          ["nombre" => "Santa Fe"]
        ],
      ],
      [
        "nombre" => "EEUU",
        "hijos" => [
          ["nombre" => "Arizona"],
          ["nombre" => "Florida"]
        ]
      ]
    ]
  ],
  [
      "nombre" => "Europa",
      "hijos" => [
          ["nombre" => "España"],
          ["nombre" => "Italia"],
      ]
  ]
];

function buscarDestinos(array $destinos, string $substring) : array {
    static $encontrados = array();

    foreach($destinos as $destino){
      if(isset($destino['nombre'])){
          $nombre=str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú'], ['a','e','i','o','u','A','E','I','O','U'],$destino['nombre']);
          $nombre=strtolower($nombre);
          $nombresubstring=str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú'], ['a','e','i','o','u','A','E','I','O','U'],$substring);
          $nombresubstring=strtolower($nombresubstring);
          if(strpos($nombre,$nombresubstring)!==false)$encontrados[]=$destino['nombre'];
      }      
      if(isset($destino['hijos'])){
        buscarDestinos($destino['hijos'], $substring);
      }
    }
    return $encontrados;
}

//ej
$coincidencias = buscarDestinos($ejemploDestinos2, "ar"); //["Argentina", "Arizona"]
print_r($coincidencias);