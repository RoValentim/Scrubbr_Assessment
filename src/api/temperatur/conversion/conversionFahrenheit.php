<?php
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversion.php" );

	class Fahrenheit extends TemperatureConversion {
		public function getTemperatur() {
			return self::$temperatur;
		}

		public function setTemperatur( $value ) {
			self::$temperatur = $value;
		}
	}
