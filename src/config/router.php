<?php
	class router {
		private $resource;

		public function do() {
			$this->parse($_SERVER["REQUEST_URI"]);
			$controller = $this->setController();

			call_user_func([$controller, "do"], '');
		}

		private function parse($url) {
			$explode_url = explode('/', trim($url)     );
			$resource    = explode('?', $explode_url[1]);

			@$uri->controller = $resource[0];

			switch($uri->controller) {
				case "forecast":
					$uri->controller = "forecast";
					break;
				default:
					if(empty($uri->controller))
						$uri->controller = "home";
					break;
			}

			$this->setResource($uri);
		}

		public function setResource($value) {
			$this->resource = $value;
		}

		public function setController() {
			$name = $this->resource->controller . "Controller";
			$file = $_SERVER["DOCUMENT_ROOT"] . '/controllers/' . $name . '.php';

			if( !file_exists($file) ) {
				$name = "errorController";
				$file = $_SERVER["DOCUMENT_ROOT"] . '/controllers/' . $name . '.php';
			}

			require_once($file);
			$controller = new $name();
			return $controller;
		}
	}
