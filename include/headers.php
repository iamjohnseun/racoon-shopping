<?php
    $response = array();
    // Set $wildcard to TRUE if you do not plan to check or limit the domains
    $wildcard = TRUE;
    // Set $credentials to TRUE if expects credential requests (Cookies, Authentication, SSL certificates)
    $credentials = FALSE;
    $allowedOrigins = array('https://decothings.co.za', '107.180.107.36');
    if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        $origin = $_SERVER['HTTP_ORIGIN'];
    }
    else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $origin = $_SERVER['HTTP_REFERER'];
    } else {
        $origin = $_SERVER['REMOTE_ADDR'];
    }
    if (!in_array($origin, $allowedOrigins) && !$wildcard) {
        // Origin is not allowed
        header("HTTP/1.1 403 Access Forbidden");
        $response['status'] = 'FAIL';
        exit;
    }
    $origin = $wildcard && !$credentials ? '*' : $origin;

    header("Access-Control-Allow-Origin: " . $origin);
    if ($credentials) {
        header("Access-Control-Allow-Credentials: true");
    }
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // Makes IE to support cookies
    header('P3P: CP="CAO PSA OUR"');

    // Handling the Preflight
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        $response['status'] = 'FAIL';
        exit;
    }

    // Response
    header('Access-Control-Max-Age: 86400');
    header("Content-Type: application/json; charset=utf-8");
    // header("Content-Type: text/plain; charset=utf-8");
    $response['status'] = 'OK';
?>
