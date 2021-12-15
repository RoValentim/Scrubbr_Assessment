<?php
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/collector/collector.php"             );
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversionCelsius.php"    );
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversionFahrenheit.php" );

	class BBC extends TemperatureCollector {
		// Get mocked data using JSON file as sample 
		public function getData( $city, $date ) {
			$file = __DIR__ . "/../../../../data/temps.json";

			if( !self::acceptDate( $date ) )
                                return false;

			if( file_exists($file) ) {
				$fahrenheit = new Fahrenheit;

				$json      = file_get_contents( $file );
				$json_data = json_decode( $json, true );

				// Full validation is not needed for mocked data
				//if( strcasecmp(strtolower($scale = $json_data['predictions']['-scale'], 'celsius')) )
				//if( !strcasecmp(self::getCity(), $json_data['predictions']['city']) )
				if( strcasecmp("Amsterdam", $city) )
				       return false;	

				$start = microtime(true);
				$limit = 60;

				foreach( $json_data['predictions']['prediction'] as $v ) {
					if( microtime(true) - $start >= $limit ) {
						break;
					}

					$fahrenheit->setTemperatur( $v['value'] ); 
					self::setTemperatur( $fahrenheit->getTemperatur() );
				}
			} else 
				echo 'Failed to open ' . $file;

			return true;
		}
	}
