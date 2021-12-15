<?php
	declare(strict_types=1);
	use PHPUnit\Framework\TestCase;

	require_once __DIR__ . "/../src/api/temperatur/conversion/conversion.php";
	require_once __DIR__ . "/../src/api/temperatur/conversion/conversionCelsius.php";
	require_once __DIR__ . "/../src/api/temperatur/conversion/conversionFahrenheit.php";

	class TemperatureConversionTest extends TestCase {
		public function getPrivateProperty( $className, $propertyName ) {
			$reflector = new ReflectionClass( $className );
			$property = $reflector->getProperty( $propertyName );
			$property->setAccessible( true );

			return $property;
		}

		public function testSetTemperaturCelsius() : void {
			$temperaturCelsius    = array( -10,  0, 25,  40 );
			$temperaturFahrenheit = array(  14, 32, 77, 104 );

			$celsius = new Celsius;

			foreach( $temperaturCelsius as $k => $v ) {
				echo "\tTested temperatur of " . $v . "°C"  . PHP_EOL;

				$celsius->setTemperatur( $v );

				$property = $this->getPrivateProperty( 'TemperatureConversion', 'temperatur' );

				$this->assertEquals( $temperaturFahrenheit[$k], $property->getValue($celsius) );
			}
		}

		public function testGetTemperaturCelsius() : void {
			$temperaturCelsius = array( -10, 0, 25, 40 );

			$celsius = new Celsius;

			foreach( $temperaturCelsius as $v ) {
				echo "\tTested temperatur of " . $v . "°C"  . PHP_EOL;

				$celsius->setTemperatur( $v );

				$this->assertEquals( $v, $celsius->getTemperatur() );
			}
		}

		public function testSetTemperaturFahrenheit() : void {
			$temperaturFahrenheit = array( 14, 32, 77, 104 );

			$fahrenheit = new Fahrenheit;

			foreach( $temperaturFahrenheit as $k => $v ) {
				echo "\tTested temperatur of " . $v . "°F"  . PHP_EOL;

				$fahrenheit->setTemperatur( $v );

				$property = $this->getPrivateProperty( 'TemperatureConversion', 'temperatur' );

				$this->assertEquals( $temperaturFahrenheit[$k], $property->getValue($fahrenheit) );
			}
		}

		public function testGetTemperaturFahrenheit() : void {
			$temperaturFahrenheit = array( 14, 32, 77, 104 );

			$fahrenheit = new Fahrenheit;

			foreach( $temperaturFahrenheit as $v ) {
				echo "\tTested temperatur of " . $v . "°F"  . PHP_EOL;

				$fahrenheit->setTemperatur( $v );

				$this->assertEquals( $v, $fahrenheit->getTemperatur() );
			}
		}

		public function testConversionTemperaturCelsiusToFahrenheit() : void {
			$temperaturCelsius    = array( -10,  0, 25,  40 );
			$temperaturFahrenheit = array(  14, 32, 77, 104 );

			$celsius    = new Celsius;
			$fahrenheit = new Fahrenheit;

			foreach( $temperaturCelsius as $k => $v ) {
				echo "\tTested temperatur of " . $v . "°C"  . PHP_EOL;

				$celsius->setTemperatur( $v );

				$this->assertEquals( $temperaturFahrenheit[$k], $fahrenheit->getTemperatur() );
			}
		}

		public function testConversionTemperaturFahrenheitToCelsius() : void {
			$temperaturCelsius    = array( -10,  0, 25,  40 );
			$temperaturFahrenheit = array(  14, 32, 77, 104 );

			$celsius    = new Celsius;
			$fahrenheit = new Fahrenheit;

			foreach( $temperaturFahrenheit as $k => $v ) {
				echo "\tTested temperatur of " . $v . "°F"  . PHP_EOL;

				$fahrenheit->setTemperatur( $v );

				$this->assertEquals( $temperaturCelsius[$k], $celsius->getTemperatur() );
			}
		}
	}
