<?php
require_once "metode.php";
$obj_barang = new barang();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_barang->get_tiket($id);
        } else {
            $obj_barang->get_tikets();
        }
        break;
    case 'POST':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_barang->update_tiket($id);
        } else {
            $obj_barang->insert_tiket();
        }
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $obj_barang->delete_tiket($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}