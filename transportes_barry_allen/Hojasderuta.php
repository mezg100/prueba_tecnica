<?php

class Hojasderuta {

	private $hojas_de_ruta = array();

	function __construct(array $elementos)
	{	

	}	

	private function setHojasderuta(array &$elementos): void
	{
        foreach ($elementos as $elemento) {
        	if($elemento instanceof Viajes){
        		$this->hojas_de_ruta['viajes'][]=$elemento;
        	}
        	else{
        		if(is_array($elemento)){
        			$this->hojas_de_ruta['hojasderuta'][]=$elemento;
        		}
        	}
        }
    }

	public function getHojasderuta(): array
	{
		return $this->hojas_de_ruta;
	}

	#recibe como parametro un array de hojas de rutas existentes o vacio y un array viajes
	#el parametro modo indica si solo deben agregarse viajes o crear hoja de ruta 
	#para crear un nuevo elemento al elemento con key hojasderuta
	public static function prepareHojasDeRuta(array &$hojasderuta, array $viajes, string $modo='hojasderuta'): void
	{
		if(empty($hojasderuta))$hojasderuta = array();

		if($modo=='hojasderuta'){
			if(!isset($hojasderuta['hojasderuta'])){
				$hojasderuta['hojasderuta'] = array();
			}
			$hojasderuta['hojasderuta'][]=$viajes;
		}else{
			if(!isset($hojasderuta['viajes'])){
				$hojasderuta['viajes'] = array();
			}
			foreach( $viajes as $viaje)$hojasderuta['viajes'][]=$viaje;			
		}


	}

}