<?php
date_default_timezone_set('Asia/Bangkok');
include_once("./config/connectdb.php");

$key = isset($_GET["key"]) ? $_GET["key"] : null;

if (isset($key) && $key === "tPmAT5Ab3j7F9") {

    $IR = isset($_GET["IR"]) ? $_GET["IR"] : null;
    $pH = isset($_GET["pH"]) ? $_GET["pH"] : null;
    if (DB::query("INSERT INTO `esp8266` (`id`, `ir`, `pH`, `day`) VALUES (NULL, '$IR', '$pH', current_timestamp());")) {
        echo "success";
    } else {
        echo "error";
    }
}
