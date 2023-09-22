<?php
session_start();
include('../functions/goods.php');
$date = date('d/m/Y');
$username = $_SESSION['username'];


if (array_key_exists('searchBtn', $_POST)) {
    $goodsCode = trim($_POST['goodsCode']);
    $result = array();
    $result = showGoods($goodsCode);
    if ($result != null) {
        $_SESSION['goods_code'] = $goodsCode;
        $_SESSION['result'] = $result;
        header("location: ../operator/sales.php");
    } else {
        $_SESSION['goods_code'] = "";
        unset($_SESSION['result']);
        echo ("
        <script> 
            alert('Items doesn\'t exist');
            document.location.href = '../operator/sales.php';
        </script>");
    }
}

if (array_key_exists('addBtn', $_POST)) {
    $goodsCode = strtoupper($_SESSION['goods_code']);
    if (!empty($goodsCode)) {
        $result = $_SESSION['result'];
        $goodsName = $result['goods_name'];
        $goodsPrice = $result['goods_price'];
        $goodsQty = $_POST['goodsQty'];
        $stock = $result['stock'];

        // untuk validasi jika stok habis atau kurang
        if ($stock == 0) {
            echo "
            <script> 
                alert('Sorry, the stock is empty..');
                document.location.href = '../operator/sales.php';
            </script>";
        } else if ($stock < $goodsQty) {
            echo "
            <script> 
                alert('Insufficient stock!');
                document.location.href = '../operator/sales.php';
            </script>";
        } else {
            storeGoodsDetails($username, $goodsCode, $goodsName, $goodsPrice, $goodsQty);
            reduceStock($goodsCode, $goodsQty);
            $_SESSION['goods_code'] = "";
            unset($_SESSION['result']);
            header("location: ../operator/sales.php");
        }
    } else {
        echo ("
        <script> 
            alert('Please insert the Items first!');
            document.location.href = '../operator/sales.php';
        </script>");
    }
}

if (array_key_exists('submitBtn', $_POST)) {
    $salesNo = getSalesNo() + 1;
    $total = getSalesTotal($username);

    if ($total != null) {
        storeSales($salesNo, $date, $total, $username);
        storeSalesDetail($salesNo, $username);
        echo ("
        <script> 
            alert('Successfully submitted..');
            document.location.href = '../operator/sales.php';
        </script>");
    } else {
        echo ("
        <script> 
            alert('Please add the Items first!');
            document.location.href = '../operator/sales.php';
        </script>");
    }
}
