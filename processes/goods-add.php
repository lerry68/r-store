<?php

session_start();
include '../functions/goods.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../admin/goods.php');
}

$goodsCode = strtoupper($_POST['goodsCode']);
$goodsName = $_POST['goodsName'];
$goodsPrice = $_POST['goodsPrice'];
$goodsStock = $_POST['goodsStock'];

$data = storeGoods($goodsCode, $goodsName, $goodsPrice, $goodsStock);

if ($data) {
    echo ("
    <script> 
        alert('Successfully added new Items..');
        document.location.href = '../admin/goods.php';
    </script>");
} else {
    echo ("
    <script> 
        alert('Failed to add new Items!');
        document.location.href = '../admin/goods.php';
    </script>");
}
