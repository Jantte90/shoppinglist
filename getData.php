<?php
	require('./include/header.php');
	require_once 'include/functions.php';
	
	global $json;
	
	$db = openSQLite();
	
	if (isset($_GET["action"])) {
		$action = $_GET["action"];
		
		switch ($action) {

			case "getOstoslista":
				$query = 'select tuote from ostoslista';
			break;
			
			case "getUsers":
				$query = 'select user from ostoslista';
			break;
			
			
		} try {
			$json = selectAsJson($db, $query);
			$json = json_encode($json);
			echo $json;
		} catch (PDOException $pdoex) {
			returnError($pdoex);
		}
	} else {
		http_response_code(400);
		echo "no action";
	}
?>