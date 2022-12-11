<?php
require('./include/header.php');
require_once('./include/functions.php');

$db = openSQLite();

session_start();

if (isset($_SESSION["username"])) {

    $getAdminLevel = "select level from ADMIN where (username = '" . $_SESSION["username"] . "')";
    $getAdminLevel = selectAsJson($db, $getAdminLevel);

    if (count($getAdminLevel) > 0) {
        //jos tarvitaan adminille eri tasoja, voidaan määrittää mitä voivat tehdä milläkin tasolla esim 1-3
        echo "Admin level: " . $getAdminLevel[0]["level"] . PHP_EOL;

        if (isset($_GET["action"])) {
            $action = $_GET["action"];

            switch ($action) {

                case "additem":

                    $user = $_SESSION["username"];
                    $tuote = $_POST['tuote'];

                    $sql = "INSERT INTO ostoskori (username, tuote) VALUES ('$user', '$tuote'); ";

                    try {
                        executeInsert($db, $sql);
                        echo json_encode(['Tuote onnistuneesti lisätty ostoslistaan', true, 'itemAdded']);
                    } catch (PDOException $pdoex) {
                        returnError($pdoex);
                        echo "Failed";
                    }
            }
        }
    } else {
        http_response_code(401);
        echo "Ei lupaa. Ainoastaan admin saa lisätä ja poistaa ostoslistasta.";
    }
} else {
    http_response_code(401);
    echo "Ei lupaa. Ei olemassaolevaa sessiodataa. Kirjaudu sisälle.";
}
