<?php

class Camion {

	private $patente;
	private $modelo;
	private $hojasderutaasignada;

	function __construct()
	{

	}

	public function setModelo(Modelo $modelo): void
	{
		$this->modelo=$modelo;
	}

	public function setPatente(string $patente): void
	{
		$this->patente=$patente;
	}

	public function getPatente(): string
	{
		return $this->patente;
	}

	public function getModelo(): Modelo
	{
		return $this->modelo;
	}

	public function asignarHojaDeRuta(Hojasderuta $hojasderuta): void
	{	
		$volumenTotalHojaDeRuta = $hojasderuta->getVolumenTotal();
		$pesoTotalHojaDeRuta = $hojasderuta->getPesoTotal();

		$limiteSuperado=false;
		if($volumenTotalHojaDeRuta>$this->modelo->getVolumen()){
			$message='El volumen total supera el limite del modelo';
			$limiteSuperado=true;
		}elseif($pesoTotalHojaDeRuta>$this->modelo->getPesomaximo()){
			$message='El peso total supera el limite del modelo';
			$limiteSuperado=true;
		}

		if($limiteSuperado){
			throw new Exception($message);
		}else{
			$this->hojasderutaasignada=$hojasderuta;
		}

	}

	public function getHojaDeRutaAsignada(): Hojasderuta
	{
		return $this->hojasderutaasignada;
	}

}