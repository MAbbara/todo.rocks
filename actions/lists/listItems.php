<?php
    include "../../db.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $resp = array();

        if (isset($_POST['action']) && isset($_POST['listID'])) {
            $action = $_POST['action'];
            $listID = $con->real_escape_string($_POST['listID']);
            $time = time();

            if ($action == "addItem") {
                if (isset($_POST['itemName']) && isset($_POST['description']) && isset($_POST['date'])) {
                    $itemName = $con->real_escape_string($_POST['itemName']);
                    $itemDescription = !empty($_POST['description']) ? $con->real_escape_string($_POST['description']) : '';
                    $date = !empty($_POST['date']) ? strtotime($_POST['date']) : 0;

                    if ($con->query("INSERT INTO list_items (listID, item, `description`, dueDate) VALUES ('$listID', '$itemName', '$itemDescription', '$date')")) {
                        $resp['success'] = true;
                        $resp['itemID'] = $con->insert_id;
                    } else {
                        $resp['success'] = false;
                        $resp['message'] = 'An error occurred adding item to database. ' . $con->error ;
                    }

                } else {
                    $resp['success'] = false;
                    $resp['message'] = 'Missing parameters.';
                }
            } else if ($action == "deleteItem") {
                if (isset($_POST['itemID'])) {
                    $itemID = $con->real_escape_string($_POST['itemID']);

                    if ($con->query("DELETE FROM list_items WHERE itemID='$itemID' AND listID='$listID'")) {
                        $resp['success'] = true;
                    } else {
                        $resp['success'] = false;
                        $resp['message'] = 'An error occurred deleting item from database. ' ;
                    }

                } else {
                    $resp['success'] = false;
                    $resp['message'] = 'Missing parameters.';
                }
            } else if ($action == "updateItem") {
                if (isset($_POST['itemID'])) {
                    $itemID = $con->real_escape_string($_POST['itemID']);
                    $checked = $con->real_escape_string($_POST['checked']);

                    $con->query("UPDATE list_items SET checked='$checked' WHERE listID='$listID' AND itemID='$itemID'");
                    if ($con->affected_rows > 0) {
                        $resp['success'] = true;
                    } else {
                        $resp['success'] = false;
                        $resp['message'] = 'An error occurred updating item in the database. ' ;
                    }

                } else {
                    $resp['success'] = false;
                    $resp['message'] = 'Missing parameters.';
                }
            }

            else {
                $resp['success'] = false;
                $resp['message'] = 'Invalid Action.';
            }
            
        } else {
            $resp['success'] = false;
            $resp['message'] = 'Missing parameters.';
        }
        echo json_encode($resp);
    } else {
        http_response_code(405);
    }
