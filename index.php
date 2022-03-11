<?php

require_once 'includes.php';

$sql = 'SELECT * FROM `user` ORDER BY `id` DESC LIMIT 5';

$users = $connection
    ->query($sql)
    ->fetchAll(PDO::FETCH_ASSOC);

/**
 * @todo Update user
 * @todo Delete User
 *
 * @todo Pagination
 */

$isDelete = isset($_POST['delete']);

if ($isDelete) {
    $sqlDelete = 'DELETE FROM `user` WHERE `id`=:id';

    $queryDelete = $connection->prepare($sqlDelete);
    $queryDelete->bindValue('id', $_POST['delete']);
    $result = $queryDelete->execute();

    if ($result) {
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}
?>

<?php
require_once 'template_head.php';
?>

<h3>Users</h3>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <form method="get" action="edit-user.php">
                    <button type="submit" value="<?= $user['id'] ?>" name="edit">Edit</button>
                </form>

                <form method="post">
                    <button type="submit" name="delete" value="<?= $user['id'] ?>">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>