<?php


class Modelo {

	private $volumen;
	private $pesomaximo;

	function __construct(float $volumen, float $pesomaximo)
	{
		$this->volumen = $volumen;
		$this->pesomaximo = $pesomaximo;
	}

	public function getVolumen(): float
	{
		return $this->volumen;
	}
	public function getPesomaximo():float
	{
		return $this->pesomaximo;
	}	

}