<?php
    require_once "../db.php";
    require_once "../lib/AltoRouter.php";
    require_once "../lib/csrf.class.php";
    require_once "../src/models/ListModel.class.php";
    require_once "../src/models/Encryption.class.php";

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $loader = new FilesystemLoader('../views');
    $twig = new Environment($loader, [
        'debug' => true
    ]);

    $base = $_ENV['BASE'];
    $messages = array(
        "success" => isset($_SESSION['success']) ? $_SESSION['success'] : null,
        "warning" => isset($_SESSION['warning']) ? $_SESSION['warning'] : null,
        "error" => isset($_SESSION['error']) ? $_SESSION['error'] : null
    );

    $router = new AltoRouter();
    $router->setBasePath($base);
    
    unset($_SESSION['success'], $_SESSION['warning'], $_SESSION['error']);

    csrf::init();

    // Backwards compatibility
    if (isset($_SERVER['REDIRECT_URL']) && !empty($_SERVER['REDIRECT_URL']) && end(explode("/", $_SERVER['REDIRECT_URL'])) == "viewList.php" && !empty($_SERVER['QUERY_STRING'])) {
        $listID = end(explode("=", $_SERVER['QUERY_STRING']));
        header("location: $base/view/$listID");
        die();
    }
    

    $router->map("GET", "/", function() {
        global $twig, $base, $messages;
        $current = "home";

        echo $twig->render('index.html.twig', [
            'title' => "Todo Lists Rock!",
            "base" => $base,
            "csrf_token" => $_SESSION['csrf_token'],
            "current" => $current,
            "messages" => $messages
        ]);
    });

    // $router->map("GET", "/faq", function() {
    //     global $twig, $base, $messages;
    //     $current = "faq";

    //     echo $twig->render('faq.html.twig', [
    //         'title' => "Todo Lists Rock!",
    //         "base" => $base,
    //         "current" => $current,
    //         "messages" => $messages
    //     ]);
    // });

    // $router->map("GET", "/changelog", function() {
    //     global $twig, $base, $messages;
    //     $current = "changelog";

    //     echo $twig->render('changelog.html.twig', [
    //         'title' => "Todo Lists Rock!",
    //         "base" => $base,
    //         "current" => $current,
    //         "messages" => $messages
    //     ]);
    // });

    $router->map("GET", "/view/[a:listID]", function($listID) {
        global $con, $twig, $base, $messages;

        include "../src/controllers/lists/viewList.php";
    }); 

    $router->map("POST", "/create/[**:name]", function($name) {
        global $con, $base;
        $name = urldecode($name);
        
        include "../src/controllers/lists/createList.php";
    }); 

    $router->map("POST", "/updateItem/[a:listID]", function($listID) {
        global $con, $base;

        include "../src/controllers/lists/updateItem.php";
    });

    $router->map("POST", "/addItem/[a:listID]", function($listID) {
        global $con, $base;

        include "../src/controllers/lists/addItem.php";
    });

    $router->map("DELETE", "/deleteItem/[a:listID]", function($listID) {
        global $con;

        include "../src/controllers/lists/deleteItem.php";
    });

    $router->map("DELETE", "/deleteList/[a:listID]", function($listID) {
        global $con;

        include "../src/controllers/lists/deleteList.php";
    });


    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        // no route was matched
        header('HTTP/1.1 404 Not Found');
        // echo "not found ya bro";
        // header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }