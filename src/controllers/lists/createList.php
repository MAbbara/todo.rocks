<?php

    $name = $con->real_escape_string($name);

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
    
    if (!is_string($name)) {
        $resp['success'] = false;
        $resp['message'] = "Name is not a string.";
        print_r(json_encode($resp));
        die();
    }
    
    if (empty($name)) {
        $resp['success'] = false;
        $resp['message'] = "List name is empty.";
        print_r(json_encode($resp));
        die();
    }
    
    $listModel = new ListModel($con);
    
    $listID = $listModel->createList($name);
    
    if ($listID === false) {
        $resp['success'] = false;
        $resp['message'] = "An error occurred creating list.";
        print_r(json_encode($resp));
        die();
    }
    
    $resp['listID'] = $listID;
    print_r(json_encode($resp));