<?php
session_start();
include '../functions/users.php';

$uname = $_POST['username'];
$pword = $_POST['password'];

$data = authUser($uname, $pword);
if ($data) {
    $_SESSION['username'] = $uname;
    $datauser = array();
    $datauser = login($uname);
    $_SESSION['username'] = $datauser['username'];
    $_SESSION['name'] = $datauser['name'];
    $_SESSION['role'] = $datauser['role'];
    $_SESSION['login'] = "Login";
    $role = $_SESSION['role'];

    if ($role == 'super admin') {
        header('Location: ../super/index.php');
    } else if ($role == 'admin') {
        header('Location: ../admin/index.php');
    } else {
        header('Location: ../operator/index.php');
    }
} else {
    header('Location: ../login.php?error');
}
