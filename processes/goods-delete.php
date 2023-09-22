<?php

include "../functions/goods.php";

$goodsCode = $_GET['goods_code'];
$data = destroyGoods($goodsCode);

if ($data) {
    echo ("
    <script>
        alert('Data successfully Deleted..');
        history.go(-1);
    </script>
");
} else {
    echo ("
    <script>
        alert('Data failed to Delete!');
        history.go(-1);
    </script>
    ");
}
