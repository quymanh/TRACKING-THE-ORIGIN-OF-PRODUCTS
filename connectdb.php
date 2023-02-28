<?php
	function openConnection(){
		$host="localhost";
		$user="root";
		$pw="";
		$db="supplychain";

		$con = new mysqli($host, $user, $pw,$db) or die("Connect failed: %s\n". $con -> error);
		return $con; 
	}

	define('BASE_URL', 'http://doan.test/');
	define("MOD_REWRITE", "On");
	function closeConnection($con){
		$con -> close();
	}
?>