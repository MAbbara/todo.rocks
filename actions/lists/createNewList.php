<?php
    include "../../db.php";

    function randomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        $n = random_int(6, 8);

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $resp = array();
        if (isset($_POST['listName'])) {
            $time = time();
            $listID = randomString();
            $listName = $con->real_escape_string($_POST['listName']);

            if ($con->query("INSERT INTO lists (listID, listName, createdOn, updatedOn) VALUES ('$listID', '$listName', '$time', '$time')")) {
                $resp['success'] = true;
                $resp['listID'] = $listID;
            } else {
                $resp['success'] = false;
                $resp['message'] = 'An error occurred adding list to database. ' ;
            }   
        } else {
            $resp['success'] = false;
            $resp['message'] = 'Missing parameters.';
        }
        echo json_encode($resp);
    } else {
        http_response_code(405);
    }