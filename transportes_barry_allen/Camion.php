<?php

class Camion {

	private $patente;
	private $modelo;

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

}