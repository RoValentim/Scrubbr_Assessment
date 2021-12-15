<?php
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversion.php" );

	class Celsius extends TemperatureConversion {
		public function getTemperatur() {
			$converted = round( (self::$temperatur - 32) * (5/9), 2 );
			return $converted;
		}

		public function setTemperatur( $value ) {
			$temp = ($value * (9/5)) + 32;
			self::$temperatur = $temp;
		}
	}
