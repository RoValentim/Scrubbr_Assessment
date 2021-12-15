<?php
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/collector/collector.php"             );
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversionCelsius.php"    );
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/api/temperatur/conversion/conversionFahrenheit.php" );

	class IAmsterdam extends TemperatureCollector {
		// Get mocked data using JSON file as sample 
		public function getData( $city, $date ) {
			$file = $_SERVER["DOCUMENT_ROOT"] . "/../data/temps.csv";

			if( !self::acceptDate( $date ) )
				return false;

			if( file_exists($file) ) {
				$celsius    = new Celsius;
				$fahrenheit = new Fahrenheit;

				if( ($fd = fopen($file, "r")) !== FALSE ) {
					$start = microtime(true);
					$limit = 60;
					$row   = 0;

					while( ($data = fgetcsv($fd, 0, ",")) !== FALSE ) {
						if( microtime(true) - $start >= $limit ) {
							break;
						}

						if( $row ) {
							// Full validation is not needed for mocked data
							//if( $row == 1 && strcasecmp(strtolower($data[0], 'celsius')) )
							//if( $row == 1 && !strcasecmp(self::getCity(), $data[1]) )
							if( strcasecmp("Amsterdam", $city) ) {
								fclose( $fd );
								return false;
							}

							$celsius->setTemperatur( $data[4] ); 
							self::setTemperatur( $fahrenheit->getTemperatur() );
						}

						$row++;
					}

					fclose( $fd );
				}
			} else {
				exit('Failed to open ' . $file);
			}

			return true;
		}
	}
