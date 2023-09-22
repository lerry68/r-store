<?php
session_start();
session_unset();
session_destroy();

echo ("
<script> 
     alert('Successfully Logged Out..');
     document.location.href = '../pages/login.php';
</script>;
");
