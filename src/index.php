<?php
        require_once __DIR__ . "/api/temperatur/collector.php";
        require_once __DIR__ . "/api/temperatur/conversion.php";

	$wc = new WeatherCom;
        $ia = new IAmsterdam;
        $bb = new BBC;

        $celsius    = new Celsius;
        $fahrenheit = new Fahrenheit;

        $fahrenheit->setTemperatur( 77 );
        $wc->addTemperatur( $fahrenheit->getTemperatur() );
        $fahrenheit->setTemperatur( $wc->getAverageTemperatur() );

        $celsius->setTemperatur( 0 );
        $ia->addTemperatur( $fahrenheit->getTemperatur() );
        $fahrenheit->setTemperatur( $wc->getAverageTemperatur() );

        $celsius->setTemperatur( 40 );
        $bb->addTemperatur( $fahrenheit->getTemperatur() );
        $fahrenheit->setTemperatur( $wc->getAverageTemperatur() );


	$uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
	$uri = explode( '/', $uri );
 
echo print_r($uri, true) . PHP_EOL;
/*
	if( (isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3]) ) {
echo "404" . PHP_EOL;
		header("HTTP/1.1 404 Not Found");
		exit();
	}
 */
echo "End" . PHP_EOL;

/*
	require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
 
	$objFeedController = new UserController();
	$strMethodName = $uri[3] . 'Action';
	$objFeedController->{$strMethodName}();
*/
