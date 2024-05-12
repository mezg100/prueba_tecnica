<?php

require_once('Viajes.php');

 class Devoluciones extends Viajes {
	
    public function getCosto(): float
    {	
        return 1000.00;
    }

}