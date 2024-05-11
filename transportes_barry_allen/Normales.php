<?php

require_once('Viajes.php');

 class Normales extends Viajes {
	

    public function getCosto(): float
    {	
    	$totalKilos = 0.00;
    	foreach($this->paquetes as $paquete){
    		$totalKilos+=$paquete->getPeso();
    	}

        return round(2 * $totalKilos * $this->getDistanceBetweenPoints($this->origen->getLatitud(), $this->origen->getLongitud(), $this->destino->getLatitud(), $this->destino->getLongitud()),2);
    }

}