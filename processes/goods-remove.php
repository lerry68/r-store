<?php
session_start();
include '../functions/goods.php';
$id = $_GET['id'];

$conn = shopConn();
$sql = "SELECT * FROM goods_details WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
foreach ($result as $data) {
    $goodsCode = $data['goods_code'];
    $goodsQty = $data['quantity'];
}

appendStock($goodsCode, $goodsQty);
destroyGoodsDetails($id);

echo ("
    <script>
        alert('Items successfully removed..');
        history.go(-1);
    </script>
    ");
