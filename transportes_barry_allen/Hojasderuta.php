<?php

class Hojasderuta {

	private $viajes = array();
	private $childs = null;

	private function __construct()
	{	

	}	

	#método que prepara un arbol para que luego pueda instanciarse una hoja de ruta
	public static function prepareHojasDeRuta(array &$hojasderuta, array $viajes, ?int $hojaderutaToAdd=null): void
	{
			if(is_null($hojaderutaToAdd)){
				$hojasderuta[]=['viajes'=>$viajes,'childs'=>array()];
			}else{
				if(isset($hojasderuta[$hojaderutaToAdd])){
					$hojasderuta[$hojaderutaToAdd]['childs']=['viajes'=>$viajes,'childs'=>array()];
				}
			}
	}	

	private function addViajes(self &$hojaDeruta, array $viajes): void
	{	
		$hojaDeruta->viajes = $viajes;
	}

	private function addChild(self &$hojaDeruta, self &$child): void
	{	
		$hojaDeruta->childs = $child;
	}

	public static function crearHojasDeRuta(array $hojasderuta): self
	{	
		#instancia padre
		$hojaDeRuta = new self();
		$hojaDeRuta->crearChilds($hojaDeRuta,$hojasderuta);

		return $hojaDeRuta;
	}

	private function crearChilds(self &$hojaDeRutaPadre, array &$hojasderuta): void
	{	
		foreach($hojasderuta as $hojaderuta){
			if(isset($hojaderuta['viajes'])&&count($hojaderuta['viajes'])>0){
				$hojaDeRutaPadre->addViajes($hojaDeRutaPadre,$hojaderuta['viajes']);
			}			
			if(isset($hojaderuta['childs'])&&count($hojaderuta['childs'])>0){
				$newChild = new self();
				$hojaDeRutaPadre->addChild($hojaDeRutaPadre, $newChild);
				$newChild->crearChilds($newChild, $hojaderuta);
			}		
		}
	}

	public function getCosto(): float
	{	
		return $this->getTotales('costo');
	}

	public function getPesoTotal(): float
	{
		return $this->getTotales('peso');
	}

	public function getVolumenTotal(): float
	{
		return $this->getTotales('volumen');
	}

	#params #tipoTotal ['costo', 'peso', 'volumen'];
	private function getTotales(string $tipoTotal): float
	{
		$valortotal=0.00;

		#primero los viajes de la instancia Padre
		foreach($this->viajes as $viaje){
			if($tipoTotal=='costo')$valortotal+=$viaje->getCosto();
			elseif($tipoTotal=='peso'){
				$valortotal+=$viaje->getPesoTotal();
			}
			elseif($tipoTotal=='volumen'){
				$valortotal+=$viaje->getVolumenTotal();
			}			
		}

		$valorTotalChilds=0.00;
		$this->getTotalesChilds($this->childs,$tipoTotal,$valorTotalChilds);

		$valortotal+=$valorTotalChilds;
		$valortotal=round($valortotal,2);
		return $valortotal;
	}

	private function getTotalesChilds(self $childs, string $tipoTotal, float &$subtotal): float
	{	
		#static $valorChilds=0.00;

		if(isset($childs->viajes)&&count($childs->viajes)>0){
			foreach($childs->viajes as $viaje){
				if($tipoTotal=='costo')$subtotal+=$viaje->getCosto();
				elseif($tipoTotal=='peso'){
					$subtotal+=$viaje->getPesoTotal();
				}
				elseif($tipoTotal=='volumen'){
					$subtotal+=$viaje->getVolumenTotal();
				}	
			}
		}			
		if(isset($childs->childs)&&$childs->childs instanceof self){
				$childs->getTotalesChilds($childs->childs,$tipoTotal,$subtotal);
		}

		return $subtotal;		
	}

	public function getCapacidades():array
	{
		return ['getVolumenTotal'=>$this->getVolumenTotal,'getPesoTotal'=>$this->getPesoTotal()];
	}

	public function getViajes(): array
	{
		return $this->viajes;
	}

	public function getChilds(): self
	{
		return $this->childs;
	}	

}