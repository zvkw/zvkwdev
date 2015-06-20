<?php

/**
	Marker-Interface. Dient primär dazu, um sicherstellen zu können, dass zum Zeitpunkt einer
	Programmausführung auch das zugehörige Framework geladen wurde.	 
	
	* Konvertierung des Files in UTF8.
	* Ergänzung Funktion get_version();
	
*/
	
	interface zvwkinterface_plugin_specs {
		function get_version();
	}
	
?>