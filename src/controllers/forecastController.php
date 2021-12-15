<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . '/models/forecast.php');

	class forecastController extends controller {
		public function do() {
			if( $_SERVER["REQUEST_METHOD"] != "GET" ) {
				$this->returnValue($this->methodNotAllowed);
				die();
			}

			$call = new forecast();
                        $ret  = $call->getData();

			$this->returnValue($ret);
		}
	}
?>
