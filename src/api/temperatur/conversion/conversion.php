<?php
	abstract class TemperatureConversion {
		protected static $temperatur;

		abstract function getTemperatur();
		abstract function setTemperatur( $value );
	}
