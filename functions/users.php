<?php
require_once '../processes/connection.php';

function chkOperator($role)
{
    if (!isset($_SESSION['role'])) {
        header("location: ../pages/login.php");
    } else {
        if ($role !== 'operator') {
            echo ("
            <script>
                alert('Only OPERATORs Can Access This Page!');
                history.go(-1);
            </script>
            ");
        }
    }
}

function chkAdmin($role)
{
    if (!isset($_SESSION['role'])) {
        header("location: ../pages/login.php");
    } else {
        if ($role !== 'admin') {
            echo ("
            <script>
                alert('Only ADMINs Can Access This Page!');
                history.go(-1);
            </script>
            ");
        }
    }
}

function chkSuper($role)
{
    if (!isset($_SESSION['role'])) {
        header("location: ../pages/login.php");
    } else {
        if ($role !== 'super admin') {
            echo ("
            <script>
                alert('Only SUPER ADMINs Can Access This Page!');
                history.go(-1);
            </script>
            ");
        }
    }
}

function indexUser($sql)
{
    $data = array();
    $conn = shopConn();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) <= 0) {
        mysqli_close($conn);
        return null;
    }
    $z = 0;
    while ($rows = mysqli_fetch_assoc($result)) {
        $data[$z]['id'] = $rows['id'];
        $data[$z]['username'] = $rows['username'];
        $data[$z]['password'] = $rows['password'];
        $data[$z]['name'] = $rows['name'];
        $data[$z]['role'] = $rows['role'];
        $z++;
    }
    mysqli_close($conn);
    return $data;
}

function allowedUser($name, $role)
{
    $roleUC = strtoupper($role);

    if ($role == 'super admin') {
        echo "<h4><center>Welcome " . $roleUC . " : " . $name . " | Date/Time : <span id='dt'></span> | <a href='goods-index.php'>GOODS</a> | <a href='user-index.php'>USERS</a> | <a href='../process/logout.php'>LOGOUT</a></h4>";
    } else if ($role == 'admin') {
        echo "<h4><center>Welcome " . $roleUC . " : " . $name . " | Date/Time : <span id='dt'></span> | <a href='goods-index.php'>GOODS</a> | <a href='user-index.php'>USERS</a> | <a href='../process/logout.php'>LOGOUT</a></h4>";
    } else {
        echo "<h5><center>Welcome " . $roleUC . ": " . $name . " | Date/Time: <span id='dt'></span></h5>";
    }
}

function login($username)
{
    $koneksi = shopConn();
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $hasil = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($hasil) > 0) {
        $baris = mysqli_fetch_assoc($hasil);
        $data['id'] = $baris['id'];
        $data['username'] = $baris['username'];
        $data['password'] = $baris['password'];
        $data['name'] = $baris['name'];
        $data['role'] = $baris['role'];
        mysqli_close($koneksi);
        return $data;
    } else {
        mysqli_close($koneksi);
        return null;
    }
}

function showUser($id)
{
    $koneksi = shopConn();
    $sql = "SELECT * FROM user WHERE id ='$id'";
    $hasil = mysqli_query($koneksi, $sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah > 0) {
        $baris = mysqli_fetch_assoc($hasil);
        $data['id'] = $baris['id'];
        $data['username'] = $baris['username'];
        $data['password'] = $baris['password'];
        $data['name'] = $baris['name'];
        $data['role'] = $baris['role'];
    } else {
        $data = null;
        mysqli_close($koneksi);
    }
    return $data;
}

function authUser($username, $password)
{
    $datauser = array();
    $passmd5 = md5($password);
    $datauser = login($username);
    if ($datauser != null) {
        if ($passmd5 == $datauser['password']) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function storeUser($username, $password, $name, $role)
{
    $conn = shopConn();
    $sql = "INSERT INTO user(username, password, name, role) VALUES('$username', '$password', '$name', '$role')";
    $hasil = 0;
    if (mysqli_query($conn, $sql)) {
        $hasil = 1;
    }
    Mysqli_close($conn);
    return $hasil;
}

function updateUser($sql)
{
    $conn = shopConn();
    $result = 0;
    if (mysqli_query($conn, $sql)) {
        $result = 1;
    }
    mysqli_close($conn);
    return $result;
}

function destroyUser($id)
{
    $conn = shopConn();
    $sql = "DELETE from user where id = $id";
    if (mysqli_query($conn, $sql)) {
        $hasil = mysqli_affected_rows($conn);
    }
    mysqli_close($conn);
    return $hasil;
}
