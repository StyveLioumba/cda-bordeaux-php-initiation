<?php

require_once 'includes.php';

if (mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $newUser = $connection->prepare(
        "INSERT INTO `user` (full_name, first_name, name, gender, email, phone)
                VALUE (:full_name, :first_name, :name, :gender, :email, :phone)"
    );

    $newUser->bindValue('full_name', $_POST['first_name'] . ' ' . $_POST['name']);
    $newUser->bindValue('first_name', $_POST['first_name']);
    $newUser->bindValue('name', $_POST['name']);
    $newUser->bindValue('gender', $_POST['gender']);
    $newUser->bindValue('email', $_POST['email']);
    $newUser->bindValue('phone', $_POST['phone']);

    $newUser->execute();

    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}
?>

<?php
require_once 'template_head.php';
?>

<form method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name">
    </div>

    <div>
        <label for="gender-male">Male</label>
        <input type="radio" name="gender" id="gender-male" value="male">
        <label for="gender-female">Female</label>
        <input type="radio" name="gender" id="gender-female" value="female">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone">
    </div>

    <div><input type="submit" value="Envoyer"></div>
</form>
</body>
</html>