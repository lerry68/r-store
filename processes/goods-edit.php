<?php
include "../functions/goods.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../super/goods-edit.php');
}

$goodsCode = $_POST['goodsCode'];
$goodsName = $_POST['goodsName'];
$goodsPrice = $_POST['goodsPrice'];
$goodsStock = $_POST['goodsStock'];
$data = updateGoods($goodsCode, $goodsName, $goodsPrice, $goodsStock);

if ($data) {
    echo ("
        <script>
            alert('Data successfully Updated..');
            history.go(-2);
        </script>
    ");
} else {
    echo ("
        <script>
            alert('Data failed to Update!');
            history.go(-1);
        </script>
        ");
}
