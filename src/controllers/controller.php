<?php
	class controller {
		protected $jsonData;

		protected $errorProtocol    = ["Error" => "Data protocol mismatch."];
		protected $methodNotAllowed = ["Error" => "Method not allowed."];
		protected $pageNotFound     = ["Error" => "Page not found."];

		protected function returnValue($value) {
			header("Content-Type: text/plain");
			echo $value;
		}
	}
