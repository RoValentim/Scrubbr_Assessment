<?php
	abstract class TemperatureCollector {
		private static $city;
		private static $day;
		private static $temperatur = array();

		public function acceptDate( $value ) {
			$now  = date("Ymd"); 
			$date = date( $value );

			if( $now > $date )
				return false;

			$datediff = $date - $now;

			if( $datediff < 0 || $datediff > 10 )
				return false;

			self::setDay( $datediff );

			return true;	
		}

		public function getAverageTemperatur() {
			$average = 0;
			$len = count(self::$temperatur);

			if( !$len )
				return false;

			foreach(self::$temperatur as $value) {
				$average += $value;
			}

			$average /= $len;

			return $average;
		}

		public function getCity() {
			return self::$city;
		}

		public function setCity( $value ) {
			if( !empty($value) )
				self::$city = $value;
		}

		public function getDay() {
			return self::$day;
		}

		public function setDay( $value ) {
			if( !empty($value) )
				self::$day = $value;
		}

		public function getTemperatur() {
			return self::$temperatur;
		}

		public function setTemperatur( $value ) {
			if( !empty($value) )
				self::$temperatur[] = round( $value, 2 );
		}
	}
