<?php

include "../functions/users.php";

$id = $_GET['id'];
$data = destroyUser($id);

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
