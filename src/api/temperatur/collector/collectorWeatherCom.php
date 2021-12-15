<?php
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/collector/collector.php"             );
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversionCelsius.php"    );
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversionFahrenheit.php" );

	class WeatherCom extends TemperatureCollector {
		// Get mocked data using XML file as sample 
		public function getData( $city, $date ) {
			$file = __DIR__ . "/../../../../data/temps.xml";

			if( file_exists($file) ) {
				$celsius    = new Celsius;
				$fahrenheit = new Fahrenheit;

				if( !self::acceptDate( $date ) )
					return false;

				$xml = simplexml_load_file($file);

				// Full validation is not needed for mocked data
				//if( strcasecmp(strtolower($scale = (string)$xml->attributes()['scale'], 'celsius')) )
				//if( !strcasecmp(self::getCity(), (string) $xml->city) )

				if( strcasecmp("Amsterdam", $city) )
					return false;

				$start = microtime(true);
				$limit = 60;

				foreach( $xml->prediction as $v ) {
					if( microtime(true) - $start >= $limit ) {
						break;
					}

					$celsius->setTemperatur( (string) $v->{'value'} );
					self::setTemperatur( $fahrenheit->getTemperatur() );
				}
			} else 
				echo 'Failed to open ' . $file;

			return false;
		}
	}
