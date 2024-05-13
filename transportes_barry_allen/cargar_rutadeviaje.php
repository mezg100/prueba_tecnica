<?php

require_once('Modelo.php');
require_once('Camion.php');
require_once('Normales.php');
require_once('Prioritarios.php');
require_once('Devoluciones.php');
require_once('Paquetes.php');
require_once('Origen.php');
require_once('Destino.php');
require_once('Hojasderuta.php');

class cargar_rutadeviaje {


	function iniciar(): void
	{
		
		#creo modelo
		$nuevoModelo = new Modelo(27,18916);

		#creo camion
		$nuevoCamion = new Camion();
		$nuevoCamion->setModelo($nuevoModelo);
		$nuevoCamion->setPatente('AA1122AA');

		print_r("El camion patente: " .$nuevoCamion->getPatente() . " tiene un volumen de : ". $nuevoModelo->getVolumen() . " y un peso maximo de : ". $nuevoModelo->getPesomaximo());


		#creo array de paquetes
		$paquetes =$this->crearPaquets();

		#creo origen
		$origen = new Origen();
		$origen->setDireccion('Avenida origen 1234');
		$origen->setLatitud(-34.63344754641283);
		$origen->setLongitud(-58.5655217973553 );

		#creo Destino
		$destino = new Destino();
		$destino->setDireccion('Calle destino 5678');
		$destino->setLatitud(-34.59813408802297);
		$destino->setLongitud(-58.381234459753074);

		 #creo viajes normales
		 $nuevoViajeNormal=new Normales($origen, $destino, [$paquetes[0],$paquetes[1]]);
		 $nuevoViajeNormal_2=new Normales($origen, $destino, [$paquetes[4]]);
		 $nuevoViajePrioritario=new Prioritarios($origen, $destino, [$paquetes[2]]);
		 $nuevoDevoluciones=new Devoluciones($origen, $destino, [$paquetes[3]]);
		 $nuevoDevoluciones_2=new Devoluciones($origen, $destino, [$paquetes[5]]);

		 #preparo array para instanciar Hojas de Ruta
		 $hojasDeRuta = array();
		 Hojasderuta::prepareHojasDeRuta($hojasDeRuta,[$nuevoViajeNormal,$nuevoViajePrioritario]);
		 Hojasderuta::prepareHojasDeRuta($hojasDeRuta,[$nuevoViajeNormal_2,$nuevoDevoluciones],0);
		 Hojasderuta::prepareHojasDeRuta($hojasDeRuta,[$nuevoViajeNormal_2,$nuevoDevoluciones],0);
		 $hojasDeRuta[0]['childs']['childs']=['viajes'=>[$nuevoDevoluciones_2],'childs'=>array()];

		 #creo instancia
		 $hojaDeRuta = Hojasderuta::crearHojasDeRuta($hojasDeRuta);

		 print_r("\nEl costo total de la hoja de ruta es de $: ".$hojaDeRuta->getCosto().
		 	"\nEl peso total de todos los paquetes de cada viaje: " .$hojaDeRuta->getPesoTotal()."\nEl Volumen total de todos los paquetes de cada viaje: ".$hojaDeRuta->getVolumenTotal());

		 try{ 
		 	$nuevoCamion->asignarHojaDeRuta($hojaDeRuta);
		 }catch (Exception $e) {
    		print_r("\nExcepción: ". $e->getMessage(). "\n");
		}
			
	}

	private function crearPaquets(): array{

			$paquete1 = new Paquetes();
			$paquete1->setPeso(2.500);  
			$paquete1->setAlto(0.25);
			$paquete1->setAncho(0.35);
			$paquete1->setLargo(0.25);

			$paquete2 = new Paquetes();
			$paquete2->setPeso(3.500);  
			$paquete2->setAlto(0.75);
			$paquete2->setAncho(0.65);
			$paquete2->setLargo(0.75);

			$paquete3 = new Paquetes();
			$paquete3->setPeso(4.600);  
			$paquete3->setAlto(2.50);
			$paquete3->setAncho(1.20);
			$paquete3->setLargo(3.25);			

			$paquete4 = new Paquetes();
			$paquete4->setPeso(9300);  
			$paquete4->setAlto(3.30);
			$paquete4->setAncho(0.5);
			$paquete4->setLargo(1.90);				

			$paquete5 = new Paquetes();
			$paquete5->setPeso(5.100);  
			$paquete5->setAlto(2.55);
			$paquete5->setAncho(1.25);
			$paquete5->setLargo(3.30);			

			$paquete6 = new Paquetes();
			$paquete6->setPeso(9600);  
			$paquete6->setAlto(3.35);
			$paquete6->setAncho(0.6);
			$paquete6->setLargo(2.00);	

			return [$paquete1, $paquete2, $paquete3, $paquete4, $paquete5, $paquete6];
	}

}


$cargar_rutadeviaje = new cargar_rutadeviaje();
$cargar_rutadeviaje->iniciar();
