<?php
	require('inc/headers.php');
	require_once 'inc/functions.php';
	
	global $json;
	
	$db = openSQLite();

	if (isset($_GET["action"])) {
		$action = $_GET["action"];
		
		switch ($action) {
			case "getItems":
				$query = 'select * from ostoslista';
				if (
					isset($_GET["categoriesToGet"]) ||
					isset($_GET["searchTerm"])
				) {
					$query = $query . ' WHERE (';
					
							if (isset($_GET["searchTerm"])) {
								$query = $query . "(bookName LIKE '%" . $_GET["searchTerm"] . "%' OR ";
								$query = $query . "author LIKE '%" . $_GET["searchTerm"] . "%' OR ";
								$query = $query . "year LIKE '%" . $_GET["searchTerm"] . "%')";
							}
					
					if (isset($_GET["categoriesToGet"]) && (isset($_GET["searchTerm"]))) {
						$query = $query . " AND ";
					}
							if (isset($_GET["categoriesToGet"])) {
								$query = $query . "categoryId IN (" . $_GET["categoriesToGet"] . ")" ;
							}
					
					$query = $query . ')';
				} else if (isset($_GET["bookIds"])) {
					$query = $query . ' WHERE (';
					$query = $query . "bookId IN (" . $_GET["bookIds"] . "))" ;
				}
			break;
			
			case "getCatProducts":
				if (isset($_GET["category"])) {
					$query = 'select * from BOOK where categoryId in ' . $_GET["category"] . 'order by categoryId';     // = > in
				} else {
					http_response_code(400);
					echo "Missing argument";
					return;
				}
			break;
			
			case "getCategories":
				$query = 'select * from CATEGORY';
			break;

			case "getBookDetails":
				if (isset($_GET["bookId"])) {
					$query = 'select * from BOOK where bookId = '. $_GET["bookId"]; 
				} else {
					http_response_code(400);
					echo "Missing argument";
				}
			break;
			
		} try {
			$json = selectAsJson($db, $query);
			$json = json_encode($json);
			print $json;
		} catch (PDOException $pdoex) {
			returnError($pdoex);
		}
	} else {
		http_response_code(400);
		echo "no action";
	}
?>