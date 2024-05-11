<?php

require_once('Viajes.php');

 class Prioritarios extends Viajes {
	
    public function getCosto(): float
    {	
    	$totalKilos = 0.00;
        $totalVolumen = 0.00;
    	foreach($this->paquetes as $paquete){
    		$totalKilos+=$paquete->getPeso();
            $totalVolumen+=$paquete->getVolumen();
    	}

        $primerCalculo= 4 * $totalKilos * $this->getDistanceBetweenPoints($this->origen->getLatitud(), $this->origen->getLongitud(), $this->destino->getLatitud(), $this->destino->getLongitud());

        $segundoCalculo= 10 * $totalVolumen * $this->getDistanceBetweenPoints($this->origen->getLatitud(), $this->origen->getLongitud(), $this->destino->getLatitud(), $this->destino->getLongitud());

        if($primerCalculo>$segundoCalculo)return (round($primerCalculo,2));
        else return (round($segundoCalculo,2));
    }

}