<?php

session_start();
include 'connection.php';
include '../functions/users.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../admin/user-add.php');
}

$username = $_POST['username'];
$password = md5($_POST['password']);
$chkpass = md5($_POST['password2']);
$name = $_POST['name'];
$role = $_POST['role'];

if ($password === $chkpass) {
    if ($role === 'null') {
        echo ("
        <script>
            alert('Please Select the Role!');
            history.go(-1);
        </script>
    ");
    } else {
        $conn = shopConn();
        $chk = mysqli_query($conn, "SELECT * FROM user where username='$username'");
        $data = mysqli_num_rows($chk);

        if ($data < 1) {
            //username belum pernah digunakan
            $data = storeUser($username, $password, $name, $role);
            echo ("
            <script>
                alert('Successfully added a new Users');
                history.go(-1);
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
} else {
    echo ("
    <script>
        alert('Password doesnt match!');
        history.go(-1);
    </script>
    ");
}
