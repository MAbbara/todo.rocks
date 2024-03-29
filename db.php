<?php
    session_start();

    error_reporting(E_ALL); 
    ini_set('ignore_repeated_errors', TRUE); 
    ini_set('display_errors', FALSE); 
    ini_set('log_errors', TRUE);
    ini_set('error_log', 'errors.log'); 
    ini_set('log_errors_max_len', 1024);

    include "vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $timezone = "Asia/Riyadh";
    
    if (isset($_SESSION['timezone']) && !(empty($_SESSION['timezone']))){
        $timezone = $_SESSION['timezone'];
    } else {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    
        $data = json_decode(file_get_contents("http://ip-api.com/json/$ip"));
        $status = $data->status;
        if ($status == "success") {
            $timezone = $data->timezone;
        } 

        $_SESSION['timezone'] = $timezone;
    }

    if ($_ENV['ENV'] == "dev") {
        $con = new mysqli("localhost", "root", "", "todo");

    } else {
        $con = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DB']);
    }

    $con->query("SET NAMES utf8mb4");
    $con->set_charset('utf8mb4');
    
    date_default_timezone_set($timezone);
