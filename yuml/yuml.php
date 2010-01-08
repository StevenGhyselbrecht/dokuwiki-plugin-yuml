<?php

	class Yuml{
	
	function renderYuml($input, $diagramType){
			$uml_code = preg_replace(array("/\n/", "/,,/"), array(", ",   ","   ),	trim($input));
			$output = "<img src=\"http://yUML.me/diagram/scruffy/" . $diagramType . "/";
			return $output.htmlspecialchars( $uml_code )."\"/>";
		}
	}
?>