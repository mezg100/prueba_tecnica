<?php


class OrigenDestino {

	private $direccion;
	private $latitud;
	private $longitud;

	function __construct()
	{
	
	}
	
	public function setDireccion(string $direccion): void 
	{
		$this->direccion=$direccion;
	}
	
	public function setLatitud(float $latitud): void 
	{
		$this->latitud=$latitud;
	}

	public function setLongitud(float $longitud): void 
	{
		$this->longitud=$longitud;
	}

	public function getDireccion(): string
	{
		return $this->direccion;
	}

	public function getLatitud(): float
	{	
		return $this->latitud;
	}

	public function getLongitud(): float
	{	
		return $this->longitud;
	}	
}