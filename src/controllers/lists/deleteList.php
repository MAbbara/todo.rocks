<?php

    $listID = $con->real_escape_string($listID);
    $resp = array("success" => true);

    parse_str(file_get_contents('php://input'), $_DELETE);

    if (!isset($_DELETE['csrf_token'])) {
        $resp['success'] = false;
        $resp['message'] = "Missing csrf token.";
        print_r(json_encode($resp));
        die();
    }

    $csrf = $_DELETE['csrf_token'];
    $csrfValidate = csrf::validate($csrf);

    if (!$csrfValidate['success']) {
        $resp['success'] = false;
        $resp['message'] = "Invalid csrf token.";
        print_r(json_encode($resp));
        die();
    }

    $listModel = new ListModel($con);
    $listModel->setListID($listID);

    if (!$listModel->deleteList()) {
        $resp['success'] = false;
        $resp['message'] = "An error occurred updating item.";
        print_r(json_encode($resp));
        die();
    }

    print_r(json_encode($resp));