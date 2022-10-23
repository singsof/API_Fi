<?php
date_default_timezone_set('Asia/Bangkok');
include_once("./config/connectdb.php");

$key = isset($_GET["key"]) ? $_GET["key"] : null;

if (isset($key) && $key === "tPmAT5Ab3j7F9") {

    $IR = isset($_GET["IR"]) ? $_GET["IR"] : null;
    $pH = isset($_GET["pH"]) ? $_GET["pH"] : null;

    $stm = DB::prepare("INSERT INTO `ir` (`id_ir`, `ir`, `date_ir`) VALUES (NULL, '$IR', current_timestamp());");

    $id_ir = null;
    if($stm->execute()){
        // DB::getLink()->commit();
        $id_ir = DB::getLink()->lastInsertId();
    }
 
    if (DB::query("INSERT INTO `esp8266` (`id`, `id_ir`, `pH`, `day`) VALUES (NULL, '$id_ir', '$pH', current_timestamp());")) {
        echo "success";
    } else {
        echo "error";
    }
}
 