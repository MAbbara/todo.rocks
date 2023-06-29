<?php
    $listID = $con->real_escape_string($listID);
    $resp = array("success" => true);

    if (!isset($_POST['csrf_token'])) {
        $_SESSION['error'] = "Missing csrf token";
        header("location: $base");
        die();
        // $resp['success'] = false;
        // $resp['message'] = "Missing csrf token.";
        // print_r(json_encode($resp));
        // die();
    }

    $csrf = $_POST['csrf_token'];
    $csrfValidate = csrf::validate($csrf);

    if (!$csrfValidate['success']) {
        $_SESSION['error'] = "Missing csrf token";
        header("location: $base");
        die();
        // $resp['success'] = false;
        // $resp['message'] = "Invalid csrf token.";
        // print_r(json_encode($resp));
        // die();
    }

    $listModel = new ListModel($con);
    $listModel->setListID($listID);

    if (!isset($_POST['item'])) {
        $_SESSION['error'] = "Missing Parameters";
        header("location: $base/view/$listID");
        die();
        // $resp['success'] = false;
        // $resp['message'] = "Missing parameters.";
        // print_r(json_encode($resp));
        // die();
    }

    $item = $_POST['item'];
    $description = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : null;
    $dueDate = isset($_POST['date']) && !empty($_POST['date']) ? $_POST['date'] : null;

    if (!$listModel->addItem($item, $description, $dueDate)) {
        $_SESSION['error'] = "An error occurred adding item.";
        header("location: $base/view/$listID");
        die();
        // $resp['success'] = false;
        // $resp['message'] = "An error occurred adding item.";
    }

    header("location: $base/view/$listID");
    // print_r(json_encode($resp));