<?php
if(file_exists('../Server_processing/config.inc') === false){
	die("Bad config error. Mising configuration files.");
}


/**
* PDOConnection
*/
class PDOConnection
{
	
	function __construct()
	{
		require 'config.inc';
		if (isset($actual_connection) === false) {
			$actual_connection = 'dev';
		}

		if(isset($connection) && array_key_exists($actual_connection, $connection)) {
			$required_items = ['host', 'user', 'password', 'database'];
			foreach ($required_items as $item) {
				if (array_key_exists($item, $connection[$actual_connection]) === false){
					die("Bad config error. Key " . $item . " is not in actual \"" . $actual_connection . "\" configuration.");
				}
			}
			$config = $connection[$actual_connection];
			$data_source_name = "mysql:host=" . $config['host'] . ";dbname=" . $config['database'];
			$user = $config['user'];
			$password = $config['password'];
			$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
			try{
				$this->db = new PDO($data_source_name, $user, $password, $options);
			} catch (PDOException $e) {
				die("Bad config error. Bad database connection settings.");
			}
		} else {
			die('Bad config error. Missing configuration settings.');
		}
	}
}
?>