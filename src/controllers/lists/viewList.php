<?php
    $listID = $con->real_escape_string($listID);
    $current = "view";

    $listModel = new ListModel($con, $listID);

    if (!$listModel->idExists($listID)) {
        header("location: $base/");
        die();
    }
    $overDue = $listModel->getOverDue();
    $upcoming = $listModel->getUpcoming();
    $items = $listModel->getAllItems();
    $listName = $listModel->getListName();

    echo $twig->render('view.html.twig', [
        'title' => "Todo Lists Rock!",
        "base" => $base,
        "listName" => $listName,
        "overdue" => $overDue,
        "upcoming" => $upcoming,
        "listID" => $listID,
        "items" => $items,
        "csrf_token" => $_SESSION['csrf_token'],
        "current" => $current,
        "messages" => $messages
    ]);
