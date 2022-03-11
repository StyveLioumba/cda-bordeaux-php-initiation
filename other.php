<?php

/*$personnes = [
    1 => ['name' => 'Khalid', 'age' => 25],
    2 => ['name' => 'Amel', 'age' => 4],
    3 => ['name' => 'Noam', 'age' => 1]
];

$som = 0;

foreach ($personnes as $item){
    if ($item['age']>=18){
        echo $item['name'].'<br>';
    }else{
        $som = $som + $item['age'];
    }

}

echo $som;


$cars = [
    "peugeot" => [
        ["make" => "5008", "year" => 2015, "doors" => 5],
        ["make" => "3008", "year" => 2009, "doors" => 5],
        ["make" => "108", "year" => 2015, "doors" => 3],
        ["make" => "208", "year" => 2015, "doors" => 2],
        ["make" => "5008", "year" => 2020, "doors" => 5],
    ],
    "renault" => [
        ["make" => "Mégane", "year" => 2015, "doors" => 5],
        ["make" => "Scénic", "year" => 2009, "doors" => 5],
        ["make" => "Clio", "year" => 2015, "doors" => 3],
    ]
];

/**
 * @todo Je veux une chainne de caratères séparé par des | des peugeot qui ont 5 portes
 *
 * @todo Je veux les Renault d'avant 2010
 *
 * @todo Je veux rajouter une peugeot 2008 de 2022 avec 5 portes
 *
 * @todo Je veux supprimer les peugeot d'avant 2010
 */

/*
$peugeot5Doors = [];
$renaultBefore2010 = [];
foreach ($cars as $brand => $makes) {
    if ($brand === 'peugeot') {
        foreach ($makes as $car) {
            if ($car['doors'] === 5) {
                $peugeot5Doors[] = $car['make'];
            }
        }
    }

    if ($brand === 'renault') {
        foreach ($makes as $car) {
            if ($car['year'] < 2010) {
                $renaultBefore2010[] = $car;
            }
        }
    }
}

$car = ["make" => "2008", "year" => 2022, "doors" => 5];

$cars['peugeot'][] = $car;

$peugeotMakes5Doors = implode(' | ', $peugeot5Doors);
//var_dump($peugeotMakes5Doors);
//var_dump($renaultBefore2010);
//var_dump($cars);


foreach ($cars['peugeot'] as $key => $car) {
    if($car["year"] < 2010) {
        unset($cars['peugeot'][$key]);
    }
}
var_dump($cars);

*/

$cars = [
    "peugeot" => [
        ["make" => "5008", "year" => 2015, "doors" => 5],
        ["make" => "3008", "year" => 2009, "doors" => 5],
        ["make" => "108", "year" => 2015, "doors" => 3],
        ["make" => "208", "year" => 2015, "doors" => 2],
        ["make" => "5008", "year" => 2020, "doors" => 5],
    ],
    "renault" => [
        ["make" => "Mégane", "year" => 2015, "doors" => 5],
        ["make" => "Scénic", "year" => 2009, "doors" => 5],
        ["make" => "Clio", "year" => 2015, "doors" => 3],
    ]
];


$isFiveDoor = ' | ';
$outputPeugeot = 'Peugeot with 5 doors : ';
$outputRenault = 'Renault before 2010 : ';

foreach ($cars['peugeot'] as $peugeot){
    if ($peugeot['doors'] === 5){
        $outputPeugeot .= $peugeot['make'] . $isFiveDoor;
    }

}

foreach ($cars['renault'] as $renault){
    if ($renault['year'] <= 2010){
        $outputRenault .= $renault['make'];
    }
}

$newPeugeot = ['make'=>'2008','year'=>2022,'doors'=>5];

if (!in_array($newPeugeot,$cars['peugeot'])){
    array_push($cars['peugeot'], $newPeugeot);
}

echo trim($outputPeugeot,' | ').'<br>';
echo trim($outputRenault,' | ').'<br>';


foreach ($cars['renault'] as $key => $renault ){
    if ($renault['year'] < 2010){
        $result =array_splice($renault, $key,-1);
        print_r($result);

    }
}

?>


<?php

require_once 'includes.php';

try {
    $connection = new PDO("mysql:host=localhost;dbname=course", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    var_dump($e);
    die;
}

$sql = 'SELECT * FROM `user` ORDER BY `id` DESC LIMIT 5';

$users = $connection
    ->query($sql)
    ->fetchAll(PDO::FETCH_ASSOC);

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

/**
 * @todo
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

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
            <td><button>Edit</button></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>