<?php
require('./include/header.php');
require_once('./include/functions.php');

$db = openSQLite();


$username = urlencode($_POST["username"]);
$checkUserExist = "select * from USER where (username = '" . $username . "')";
$checkUserExist = selectAsJson($db, $checkUserExist);
if (count($checkUserExist) != 0) {                  //jos käyttäjänimellä löytyy tunnus tietokannasta
    http_response_code(409);
    echo json_encode("Käyttäjänimi löytyy jo tietokannasta");
     return;
        } else {
            $hash = password_hash(urlencode($_POST["passwd"]),PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (username, passwd) VALUES ('$username', '$hash'); ";
            try {
                executeInsert($db, $sql);
                echo json_encode('Käyttäjä luotu onnistuneesti');
                http_response_code(200);
                } catch (Exception $e) {
                    echo "Failed";
                    print_r($e);
                    }
                }
