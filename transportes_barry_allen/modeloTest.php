<?php

require_once('Modelo.php');

class modeloTest{

    function __construct()
	{}
    
	public function testInstanciarModelo($volumen, $pesomaximo){
        if(is_float($volumen)===false || is_float($pesomaximo)===false) return false;
		return new Modelo($volumen, $pesomaximo);
	}

	public function verficiarNuevaInstancia(modelo $esperado, $resultado, &$mensaje): bool
	{
		if(($resultado instanceof $esperado)===false){
			$mensaje.= 'Error al instanciar Modelo, los argumentos esperados para instanciar modelo son : float $volumen, float $pesomaximo ';
            return false;
		}else{
			$mensaje.= 'Se realizo correctamente la nueva instancia de modelo';
            return true;
		}
	}
}

$modeloTest = new modeloTest();
$instanciaModelo =$modeloTest->testInstanciarModelo(222.00,'test');

$result = $modeloTest->verficiarNuevaInstancia(new Modelo(11.22,10.33),$instanciaModelo,$mensaje);
if($result===false){
    print_r("Falló: \n" . $mensaje);
}else{
    print_r("Prueba exitosa \n" . $mensaje);
}


