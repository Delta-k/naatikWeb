<?php
	class Database {
		private static $dbName 			= '2005B_01' ;
		private static $dbHost 			= 'localhost' ;
		private static $dbUsername 		= 'u2005_01';
		private static $dbUserPassword 	= 'Q$Tcbo%2nW1K';

		private static $cont  = null;

		public function __construct() {
			exit('Init function is not allowed');
		}

		public static function connect(){
		   // One connection through whole application
	    	if ( null == self::$cont ) {
		    	try {
		        	self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
		        }
		        catch(PDOException $e) {
		        	die($e->getMessage());
		        }
	       	}
	       	return self::$cont;
		}

		public static function disconnect() {
			self::$cont = null;
		}
	}
?>
