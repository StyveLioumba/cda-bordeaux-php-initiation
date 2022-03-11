<?php

require_once 'includes.php';
$user = '';
if (mb_strtolower($_SERVER['REQUEST_METHOD']) === 'get') {
    $queryEdit = $connection->prepare(
        "SELECT * FROM `user` WHERE `id`=:id"
    );
    $queryEdit->bindValue('id', $_GET['edit']);
    $queryEdit->execute();
    $user = $queryEdit->fetchAll(PDO::FETCH_ASSOC);
}

if (mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $querUpdate = $connection->prepare(
        "UPDATE `user` SET
                full_name=:full_name, first_name=:first_name, name=:name, gender=:gender, email=:email, phone=:phone
                WHERE id=:id"
    );

    $querUpdate->bindValue('id', $_POST['id']);
    $querUpdate->bindValue('full_name', $_POST['first_name'] . ' ' . $_POST['name']);
    $querUpdate->bindValue('first_name', $_POST['first_name']);
    $querUpdate->bindValue('name', $_POST['name']);
    $querUpdate->bindValue('gender', $_POST['gender']);
    $querUpdate->bindValue('email', $_POST['email']);
    $querUpdate->bindValue('phone', $_POST['phone']);

    $result = $querUpdate->execute();


    if (isset($_SERVER["HTTP_REFERER"]) && $result) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }


}
?>

<?php
require_once 'template_head.php';
?>

<form method="post">
    <div hidden>
        <label for="id">id</label>
        <input type="number" id="id" name="id" value="<?= $user[0]['id']?>">
    </div>
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= $user[0]['name']?>">
    </div>
    <div>
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?= $user[0]['first_name']?>">
    </div>

    <div>
        <label for="gender-male">Male</label>
        <input type="radio" name="gender" id="gender-male" value="male" checked>
        <label for="gender-female">Female</label>
        <input type="radio" name="gender" id="gender-female" value="female">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?= $user[0]['email']?>">
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="<?= $user[0]['phone']?>">
    </div>

    <div><input type="submit" value="modifier" name="update"></div>
</form>

</body>
</html>