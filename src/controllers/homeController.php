<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . '/models/home.php');

	class homeController extends controller {
		public function do() {
			$call = new home();
			$ret = $call->render();
		}
	}
?>
