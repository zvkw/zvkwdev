<?php
/**
    Plugin Name: zvkwframework
    Version: v1.0.1
    Plugin URI: http://www.zvkw.de/node_group/zvkwframework
    Author: T2M
    Author URI: http://www.stuelken.com
    Text Domain: zvkwtemplateengine
    Description: This plugin is required for the functionality of several ZVKW plugins. It contains a class as a wrapper for several wordpress and other functions.
	
    Copyright 2015 Timm Stuelken

    Thanks to WordPress to provide a documentation on how to use their global functions.


	=== ZVKW Template Engine ===
	
	Developer: T2M (poststelle@zvkw.de)
	Tags: framework, zvwkframework
	Requires at least: 3.6
	Tested up to: 4.2
	Stable Tag: 1.0.1

	== Description ==

	This plugin is required for the functionality of several ZVKW plugins. 
	It contains a class as a wrapper for several wordpress and other functions.

	== Installation ==

	1. Extract the zip file into your plugins directory into its own folder.
	2. Activate the plugin in the Plugin options.
	3. Customize the settings from the Options panel, if desired.

	Enjoy.

	== Change Log ==

	 ver. 1.0.2 18-Jun-2015
	 + added a class-exists condition
	 + added use of ZVKWs wrapper functions

	 ver. 1.0.0 1-Jun-2015
	 + Created plugin based upon former functions of a theme 
	 + released 
	 
	== Wishlist ==
	
	+ More features.
	

	== LICENSE ==
	
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/




	//_ -------------------------------------------------------------------------------------------
	//_ REQUIREMENTS AND INCLUDES
	//_ -------------------------------------------------------------------------------------------
	
	/**
	* 
	*/
	require_once('zvkwinterface_plugin_specs.inc.php');

	
	
	
	//_ -------------------------------------------------------------------------------------------
	//_ CLASS DEFINITION
	//_ -------------------------------------------------------------------------------------------	

	/**
	* Wrapper-Klasse zum Kapseln häufig benötigter Funktionen
	*/

	class zvkwframework {

		/** 
		* Kapselt die Singleton-Instanz dieser Klasse 
		*/
		static private $instance = null;
		
		/** 
		* Factory-Funktion, welche die Referenz auf das 
		* Singleton-Objekt liefert oder die erste Instanz erzeugt 
		*/
		static public function getInstance() {
			if (null === self::$instance) {
				self::$instance = new self;
			}
			return self::$instance;	
		}
		
		/**
		* Privater, parameterloser Konstruktor. 
		*/
		private function __construct() { }
		
		/**
		* Klonen der Klasse unterbinden.
		*/
		private function __clone() { }
		
		//_ /////////////////////////
		//_ FUNKTIONALITÄT DER KLASSE
		//_ /////////////////////////
		
		/**
		* Wrapper für die WordPress Funktion check_admin_referer
		*/
		
		function check_admin_referer($p) {
			include("check_admin_referer.function.php");
		}
		
		/**
		* Beispielfunktion
		*/		
		
		function machwas() {
			include("machwas.function.php");
		}
		
		/**
		* Liefert einen Array mit allen Tabellennamen. 
		*/
		function getDBTableNamesAsArray($options="") {
			global $wpdb; //_ WordPress Database Object
			
			$sql = "SHOW TABLES LIKE '%'";
			$results = $wpdb->get_results($sql);

			if(is_array($results)) {
				/*
				foreach($results as $index => $value) {
					foreach($value as $tableName) {
						echo $tableName . '<br />';
					}
				}
				*/				
				return $results;
			} else {
				return "";
			}
		}
		
		/**
		* @return Returns a prefix string like z__ for naming purposes in databases.
		*/
		function get_zvkw_db_prefix() {
			return "z__";
		}
		
		/**
		* @return Returns a prefix string like z__mypluginname__.
		*/
		function get_plugin_db_prefix($options) {
			$prefix_String = ZZZ()->get_wp_db_prefix() . ZZZ()->get_zvkw_db_prefix().$options["plugin_name"]."__";
			return $prefix_String;
		}
		
		function get_wp_db_prefix() {
			global $wpdb;
			return $wpdb->prefix;
			// appzet_z__zvkwloginshield__lockdowns
			// appzet_z__zvkwloginshield__lockdowns
			
			// appzet_z__zvkwloginshield__login_fails
			// appzet_z__zvkwloginshield__login_fails
		}
		
		
	} //_ Ende der Klasse
	
	
	
	
	
	//_ -------------------------------------------------------------------------------------------
	//_ CREATE SINGLETON INSTANCE AND IMPLEMENT GLOBAL WRAPPER FUNCTION
	//_ -------------------------------------------------------------------------------------------		
	
	/**
	* Globale Singleton-Instanz erzeugen.
	*/

	/**
	* Globale Funktion zur Rückgabe einer Referenz auf die Wrapper-Klasse.
	* Zurückgegeben wird eine Singleton-Instanz, dh. immer das selbe Objekt.
	*
	* Beispiel für eine Nutzung innerhalb von Funktionen oder auch Klassenfunktionen anderer
	* Plugins oder auch Themes: Wir rufen hier eine globale Funktion von WordPress über diese
	* Wrapper-Klasse auf, dh. die Funktionalität der Funktion wird in Wirklichkeit in diesem
	* beispiel eigentlich dadurch bewirkt, dass das Singleton-Objekt in seiner Funktion
	* die globale Funktion check_admin_referer(...) aufruft.
	*
	* function irgendwas() {
	* 	ZZZ()->check_admin_referer($p);
	* }
	*/ 

	if(!function_exists) {
		function ZZZ() {
			return zvkw_wp_wrapper::getInstance();
		}
	}

?>