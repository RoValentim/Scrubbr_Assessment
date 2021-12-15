<?php
        require_once($_SERVER["DOCUMENT_ROOT"] . '/config/api.php');

	class forecast extends models {
		const NOT_AVAILABLE = 'Forecast not available';

		public function getData() {
			if( !isset($_GET['city']) || !isset($_GET['date']) ) {
				return false;
			}

			$data1 = new IAmsterdam;
			$val = $data1->getData( $_GET['city'], $_GET['date']);

			if( $val === false )
				return self::NOT_AVAILABLE;

			$c = new Celsius;
			$f = new Fahrenheit;

			$f->setTemperatur( $data1->getAverageTemperatur() );
			$ret = $c->getTemperatur() . "°C" . PHP_EOL . $f->getTemperatur() . "°F";
			
			return $ret;
		}
	}
?>
