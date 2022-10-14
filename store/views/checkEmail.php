<?php
require 'connection.php';
$emails = $connect->query('SELECT * FROM users');
$emails = $emails->fetchAll();
$isEmail = 0;
if (isset($_POST['email'])) {
    $userEmail = $_POST['email'];
    foreach ($emails as $email) {
        if ($email['email'] == $userEmail) {
            $isEmail = 1;
        }
    }
    echo $isEmail;
}
?>
