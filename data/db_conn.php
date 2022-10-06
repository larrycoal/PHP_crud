<?php
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'example');
    define('DB_HOST', 'db');
    define('DB_NAME', 'Shophova');

    $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        OR die('Could not connect to MySQL: ' . mysqli_connect_error());
    mysqli_set_charset($dbc, 'utf8');

    function prepare_string($dbc, $string) {
        $string_trimmed = trim($string);
        $string = mysqli_real_escape_string($dbc, $string_trimmed);
        return $string;
    }
?>