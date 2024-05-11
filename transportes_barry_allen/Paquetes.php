<?php


class Paquetes {

	private  $peso;
	private  $alto;
	private  $ancho;
	private  $largo;

	function __construct()
	{

	}

	public function setPeso(float $peso): void
	{
		$this->peso=$peso;
	}

	public function setAlto(float $alto): void
	{
		$this->alto=$alto;
	}

	public function setAncho(float $ancho): void
	{
		$this->ancho=$ancho;
	}

	public function setLargo(float $largo): void
	{
		$this->largo=$largo;
	}	

	public function getPeso(): float
	{
		return $this->peso;
	}

	public function getAlto(): float
	{
		return $this->alto;
	}

	public function getAncho(): float
	{
		return $this->ancho;
	}

	public function getLargo(): float
	{
		return $this->largo;
	}

	public function getVolumen(): float
	{
		return $this->alto * $this->ancho * $this->largo;
	}	

}