<?php

require_once('Paquetes.php');

class paquetesTest{

    function __construct()
	{}
    
	public function testGetVolumen(paquetes $paqueteTest): float
	{
        return $paqueteTest->getVolumen();
	}

	public function verficiarGetVolumen(float $esperado, $resultado, &$mensaje): bool
	{
		if(round($esperado,2)!==round($resultado,2)){
			$mensaje.= 'Error al devolver valor el volumen. El mismo debe ser alto * ancho * largo';
            return false;
		}else{
			$mensaje.= 'El valor del volumen devuelto es el correcto';
            return true;
		}
	}
}

$paquetesTest = new paquetesTest();

$nuevoPaquete = new Paquetes();
$nuevoPaquete->setAlto(2.5);
$nuevoPaquete->setAncho(1.5);
$nuevoPaquete->setLargo(3.5);


$result = $paquetesTest->verficiarGetVolumen(2.5*1.5*3.5,$nuevoPaquete->getVolumen(),$mensaje);
if($result===false){
    print_r("Falló: \n" . $mensaje);
}else{
    print_r("Prueba exitosa \n" . $mensaje);
}