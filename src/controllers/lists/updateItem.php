<?php

    $listID = $con->real_escape_string($listID);
    $resp = array("success" => true);

    if (!isset($_POST['csrf_token'])) {
        $resp['success'] = false;
        $resp['message'] = "Missing csrf token.";
        print_r(json_encode($resp));
        die();
    }

    $csrf = $_POST['csrf_token'];
    $csrfValidate = csrf::validate($csrf);

    if (!$csrfValidate['success']) {
        $resp['success'] = false;
        $resp['message'] = "Invalid csrf token.";
        print_r(json_encode($resp));
        die();
    }

    $listModel = new ListModel($con);
    $listModel->setListID($listID);
    $checked = intval($_POST['checked']);
    $itemID = intval($_POST['itemID']);

    if (!isset($_POST['checked']) && !isset($_POST['itemID'])) {
        $resp['success'] = false;
        $resp['message'] = "Missing parameters.";
        print_r(json_encode($resp));
        die();
    }

    if (!$listModel->updateItem($itemID, $checked)) {
        $resp['success'] = false;
        $resp['message'] = "An error occurred updating item.";
        print_r(json_encode($resp));
        die();
    }

    print_r(json_encode($resp));