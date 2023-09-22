<?php
require_once '../processes/connection.php';

function formatRp($rupiah)
{
    if ($rupiah == '') {
        $resultRp = null;
    } else {
        $resultRp = "Rp" . number_format($rupiah, 2, ',', '.');
    }
    return $resultRp;
}

function indexGoods()
{
    $data = array();
    $sql = "SELECT * FROM goods";
    $conn = shopConn();
    $hasil = mysqli_query($conn, $sql);
    if (mysqli_num_rows($hasil) <= 0) {
        mysqli_close($conn);
        return null;
    }
    $i = 0;
    while ($baris = mysqli_fetch_assoc($hasil)) {
        $data[$i]['goods_code'] = $baris['goods_code'];
        $data[$i]['goods_name'] = $baris['goods_name'];
        $data[$i]['goods_price'] = $baris['goods_price'];
        $data[$i]['stock'] = $baris['stock'];
        $i++;
    }
    mysqli_close($conn);
    return $data;
}

function showGoods($goodsCode)
{
    $conn = shopConn();
    $sql = "SELECT * FROM goods WHERE goods_code ='$goodsCode'";
    $hasil = mysqli_query($conn, $sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah > 0) {
        $baris = mysqli_fetch_assoc($hasil);
        $data['goods_code'] = $baris['goods_code'];
        $data['goods_name'] = $baris['goods_name'];
        $data['goods_price'] = $baris['goods_price'];
        $data['stock'] = $baris['stock'];
    } else {
        $data = null;
        mysqli_close($conn);
    }
    return $data;
}

function indexGoodsDetails()
{
    $data = array();
    $sql = "SELECT * FROM goods_details";
    $conn = shopConn();
    $hasil = mysqli_query($conn, $sql);
    // if(mysqli_num_rows($hasil) <= 0){
    //     mysqli_close($conn);
    //     return null;
    // }
    $i = 0;
    while ($baris = mysqli_fetch_assoc($hasil)) {
        $data[$i]['id'] = $baris['id'];
        $data[$i]['username'] = $baris['username'];
        $data[$i]['goods_code'] = $baris['goods_code'];
        $data[$i]['goods_name'] = $baris['goods_name'];
        $data[$i]['goods_price'] = $baris['goods_price'];
        $data[$i]['quantity'] = $baris['quantity'];
        $data[$i]['subtotal'] = $baris['subtotal'];
        $i++;
    }
    mysqli_close($conn);
    return $data;
}

function showGoodsDetails($username)
{
    $data = array();
    $sql = "SELECT * FROM goods_details WHERE username = '$username'";
    $conn = shopConn();
    $hasil = mysqli_query($conn, $sql);
    if (mysqli_num_rows($hasil) <= 0) {
        mysqli_close($conn);
        return null;
    }
    $i = 0;
    while ($baris = mysqli_fetch_assoc($hasil)) {
        $data[$i]['id'] = $baris['id'];
        $data[$i]['username'] = $baris['username'];
        $data[$i]['goods_code'] = $baris['goods_code'];
        $data[$i]['goods_name'] = $baris['goods_name'];
        $data[$i]['goods_price'] = $baris['goods_price'];
        $data[$i]['quantity'] = $baris['quantity'];
        $data[$i]['subtotal'] = $baris['subtotal'];
        $i++;
    }
    mysqli_close($conn);
    return $data;
}

function storeGoodsDetails($username, $goodsCode, $goodsName, $goodsPrice, $goodsQty)
{
    $conn = shopConn();
    $subtotal = $goodsPrice * $goodsQty;
    $sql = "INSERT into goods_details (username, goods_code, goods_name, goods_price, quantity, subtotal) VALUES('$username','$goodsCode','$goodsName', '$goodsPrice', '$goodsQty', '$subtotal')";
    $hasil = 0;
    if (mysqli_query($conn, $sql)) {
        $hasil = 1;
    }
    Mysqli_close($conn);
    return $hasil;
}

function destroyGoodsDetails($id)
{
    $conn = shopConn();
    $sql = "DELETE FROM goods_details WHERE id = '$id'";
    $result = 0;
    if (mysqli_query($conn, $sql)) {
        $result = 1;
    }
    mysqli_close($conn);
    return $result;
}

function getSalesNo()
{
    $sql = "SELECT sales_no FROM sales ORDER BY sales_no DESC LIMIT 1";
    $conn = shopConn();
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);

    if ($total > 0) {
        $rows = mysqli_fetch_assoc($result);
        $salesNo = $rows['sales_no'];
    } else {
        $salesNo = 0;
    }
    mysqli_close($conn);
    return $salesNo;
}

function getSalesTotal($username)
{
    $total = 0;
    $sql = "SELECT SUM(subtotal) AS total FROM goods_details WHERE username = '$username'";
    $conn = shopConn();
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    $subtotal = $rows['total'];
    $total = $subtotal + $total;
    if ($total == NULL) {
        $total = 0;
    }
    mysqli_close($conn);
    return $total;
}

function storeSales($salesNo, $date, $total, $username)
{
    $conn = shopConn();
    date_default_timezone_set('Asia/Jakarta');
    $date = date('y-m-d h:i:s');
    $sql = "INSERT INTO sales(sales_no, sales_date, total, username) VALUES('$salesNo', '$date', '$total', '$username')";
    $result = 0;

    if (mysqli_query($conn, $sql)) {
        $result = 1;
        mysqli_close($conn);
        return $result;
    }
}

function storeSalesDetail($salesNo, $username)
{
    $conn = shopConn();
    $sql = "SELECT * FROM goods_details WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $data) {
        $goodsCode = $data['goods_code'];
        $goodsPrice = $data['goods_price'];
        $qty = $data['quantity'];
        $username = $data['username'];
        $result = mysqli_query($conn, "INSERT into sales_detail(username, sales_no, goods_code, price, qty) 
        VALUES('$username','$salesNo','$goodsCode','$goodsPrice','$qty')");
    }

    $sql = "DELETE FROM goods_details WHERE username = '$username'";
    $result = 0;
    if (mysqli_query($conn, $sql)) {
        $result = 1;
    }
    mysqli_close($conn);
    return $result;
}

function reduceStock($goodsCode, $goodsQty)
{
    $conn = shopConn();
    $sql = "SELECT * FROM goods WHERE goods_code = '$goodsCode'";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $data) {
        $stock = $data['stock'];
    }
    $reduce = $stock - $goodsQty;
    $sql2 = "UPDATE goods SET stock = '$reduce' WHERE goods_code  = '$goodsCode'";
    $result2 = mysqli_query($conn, $sql2);
    return $result2;
}

function appendStock($goodsCode, $goodsQty)
{
    $conn = shopConn();
    $sql = "SELECT * FROM goods WHERE goods_code = '$goodsCode'";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $data) {
        $stock = $data['stock'];
    }
    $append = $stock + $goodsQty;
    $sql2 = "UPDATE goods SET stock = '$append' WHERE goods_code  = '$goodsCode'";
    $result2 = mysqli_query($conn, $sql2);
    return $result2;
}


function storeGoods($goodsCode, $goodsName, $goodsPrice, $goodsStock)
{
    $conn = shopConn();
    $sql = "INSERT INTO goods VALUES('$goodsCode','$goodsName','$goodsPrice', '$goodsStock')";
    $result = 0;
    if (mysqli_query($conn, $sql)) {
        $result = 1;
    }
    mysqli_close($conn);
    return $result;
}

function updateGoods($goodsCode, $goodsName, $goodsPrice, $goodsStock)
{
    $conn = shopConn();
    $sql = "UPDATE goods SET goods_name = '$goodsName', goods_price = '$goodsPrice', stock = '$goodsStock' WHERE goods_code = '$goodsCode'";
    $result = 0;
    if (mysqli_query($conn, $sql)) {
        $result = 1;
    }
    mysqli_close($conn);
    return $result;
}

function destroyGoods($goodsCode)
{
    $conn = shopConn();
    $sql = "DELETE FROM goods WHERE goods_code = '$goodsCode'";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_affected_rows($conn);
    }
    mysqli_close($conn);
    return $result;
}
