<?php


abstract class Viajes {

	protected $paquetes = array();
	protected $origen;
	protected $destino;

	function __construct(Origen $origen, Destino $destino, array $paquetes)
	{	
		$this->origen=$origen;
		$this->destino=$destino;
		$this->setPaquetes($paquetes);
	}
	

	private function setPaquetes(array &$paquetes): void
	{
        foreach ($paquetes as $paquete) {
            if ($paquete instanceof Paquetes) {
                $this->paquetes[] = $paquete;
            } else {
                throw new InvalidArgumentException('El parametro paquetes debe ser un array de la clase Paquetes');
       		}
		}
	}

	abstract protected function getCosto(): float;

	protected function getDistanceBetweenPoints(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float
	{
	    $theta = $longitude1 - $longitude2; 
	    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
	    $distance = acos($distance); 
	    $distance = rad2deg($distance); 
	    $distance = $distance * 60 * 1.1515; 
	    $distance = $distance * 1.609344;
	    return (round($distance,2)); 
	}
}