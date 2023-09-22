<?php
include "../functions/users.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../admin/users-edit.php');
}

error_reporting(0);

$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$chkpass = md5($_POST['password2']);
$role = $_POST['role'];

// update data
if (array_key_exists('btnUpdate', $_POST)) {
    $conn = shopConn();
    $chk = mysqli_query($conn, "SELECT * FROM user where username='$username'");
    $data = mysqli_num_rows($chk);

    if ($data < 1) {
        //username belum pernah digunakan
        $sql = "UPDATE user SET username ='$username', name ='$name', role = '$role' WHERE id = '$id'";
        $data = updateUser($sql);
        echo ("
        <script>
            alert('Data succesfully updated..');
            history.go(-2);
        </script>
        ");
    } else {
        //jika username sudah pernah digunakan
        echo ("
        <script>
            alert('Username has been taken!');
            history.go(-1);
        </script>
    ");
    }
}

// update password
if (array_key_exists('btnUpdatePW', $_POST)) {
    if ($password === $chkpass) {
        $sql = "UPDATE user SET password = '$password' WHERE id = '$id'";
        $data = updateUser($sql);
        echo ("
            <script>
                alert('Data Succesfully Updated..');
                history.go(-3);
            </script>
            ");
    } else {
        echo ("
        <script>
            alert('Password Doesnt Match!');
            history.go(-1);
        </script>
        ");
    }
}
