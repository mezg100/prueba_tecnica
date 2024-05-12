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
		$nuevoModelo = new Modelo(100.99,2500);

		#creo camion
		$nuevoCamion = new Camion();
		$nuevoCamion->setModelo($nuevoModelo);
		$nuevoCamion->setPatente('AA1122AA');

		print_r("El camion patente: " .$nuevoCamion->getPatente() . " tiene un volumen de : ". $nuevoModelo->getVolumen() . " y un peso maximo de : ". $nuevoModelo->getPesomaximo());
		print_r("\ncreando viaje normal...");


		#creo array de paquetes
		$paquetes =$this->crearPaquets();

		#creo origen
		$origen = new Origen();
		$origen->setDireccion('Avenida origen 1234');
		$origen->setLatitud(-34.66748559085055);
		$origen->setLongitud(-58.66042360452752);

		#creo Destino
		$destino = new Destino();
		$destino->setDireccion('Calle destino 5678');
		$destino->setLatitud(-34.61092907047732);
		$destino->setLongitud(-58.38038360262478);

		#echo "\nLos datos de los paquetes son:\n";
		#print_r($paquetes);

		 #creo viaje Normal
		 $nuevoViajeNormal=new Normales($origen, $destino, [$paquetes[0],$paquetes[1]]);
		 $nuevoPrioritario=new Prioritarios($origen, $destino, [$paquetes[2]]);
		 $nuevoDevoluciones=new Devoluciones($origen, $destino, [$paquetes[3]]);

		 $hojasDeRuta = array();
		 Hojasderuta::prepareHojasDeRuta($hojasDeRuta,[$nuevoViajeNormal]);
		 Hojasderuta::prepareHojasDeRuta($hojasDeRuta,[$nuevoPrioritario]);
		 Hojasderuta::prepareHojasDeRuta($hojasDeRuta,[$nuevoDevoluciones],'viajes');
		 print_r($hojasDeRuta);die();

		 


		// try{
		// 	$nuevoPrioritario=new Prioritarios($origen, $destino, $paquetes);
		// }catch(exception $e){
		// 	print_r("\nATENCIÓN! Excepción capturada: ".$e->getMessage());
		// }
		
		/* try{
		 	$nuevoDevoluciones=new Devoluciones($origen, $destino, $paquetes);
		 }catch(exception $e){
		 	print_r("\nATENCIÓN! Excepción capturada: ".$e->getMessage());
		}*/
		echo "\nLos datos del viaje prioritario son:\n";
		print_r($nuevoDevoluciones);
		print_r("Direccion origine: " . $origen->getDireccion()."\nDireccion Destino: ". $destino->getDireccion());
		print_r("\nEl costo de viaje prioritario es : ". $nuevoDevoluciones->getCosto()."\n");
			
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

			return [$paquete1, $paquete2, $paquete3, $paquete4];
	}

}


$cargar_rutadeviaje = new cargar_rutadeviaje();
$cargar_rutadeviaje->iniciar();
