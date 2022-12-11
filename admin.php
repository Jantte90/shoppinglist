<?php
require('./include/header.php');
require_once 'include/functions.php';


$db = openSQLite();

session_start();


if (isset($_SESSION["username"])) {

    $getAdminlevel = "select level from ADMIN where (username = '" . $_SESSION["username"] . "')";
    $getAdminlevel = selectAsJson($db, $getAdminlevel);


    if (count($getAdminlevel) > 0) {

        if (!isset($_GET["action"])) {
            http_response_code(400);
            echo('no action');
            return;
        }


        if (isset($_GET["action"])) {
            $action = $_GET["action"];

            switch($action) {
                case "addTuote":
                    $id = $_POST['id'];
                    $username = $_POST['username'];
                    $tuote = $_POST['tuote'];

                    $sql = "INSERT INTO ostoslista (id,username, tuote) VALUES ('$id','$username', '$tuote'); ";

                    try {
                        executeInsert($db, $sql);
                        echo json_encode('Tuote onnistuneesti lisätty ostoslistaan');
                    } catch (PDOException $pdoex) {
                        returnError($pdoex);
                        echo "Failed";
                    }
                break;

                case "removeTuote":
                    $id = $_POST['id'];

                    $sql = "DELETE FROM ostoslista WHERE id = '$id' ";

                    try {
                        executeInsert($db, $sql);
                        echo json_encode('Tuote ' . $id ."  poistettu onnistuneesti ostoslistasta");
                    } catch (PDOException $pdoex) {
                        returnError($pdoex);
                        echo "Failed";
                    }
                break;
             
                case "getLevel":
                    http_response_code(200);
                    echo json_encode(['User is an admin', true, 'isAdmin', $getAdminlevel]);
                    return;
                break;
            }
        }   
    } else {
        http_response_code(401);
        echo "Et ole admin, tarvitset admin oikeudet.";
        return;
    }  
} else { 
    http_response_code(401);
    echo "Et ole kirjautunut sisään.";
    return;
}       
                    
?>