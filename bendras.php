<?php
include("db.php");

if (isset($_GET['action']) && $_GET['action'] == 'delete') {

    $sql = "DELETE FROM employees WHERE id=?";
    $pstm = $pdo->prepare($sql);
    $pstm->execute([$_GET['id']]);
}

$sql = "SELECT employees .*, positions.name as positions_name  FROM employees LEFT JOIN positions ON employees.positions_id=positions.id";
$pstm = $pdo->prepare($sql);
$pstm->execute([]);
$darbuotojai = $pstm->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT positions.name, positions.base_salary, COUNT(`positions_id`) as kiekis FROM employees e LEFT JOIN positions ON e.positions_id=positions.id GROUP BY positions.name";
$pstm2 = $pdo->prepare($sql2);
$pstm2->execute([]);
$pareigos = $pstm2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT COUNT(id) as skaicius, AVG(`salary`) as vidutinis, MIN(`salary`) as maziausias, MAX(`salary`) as didziausias FROM `employees`";
$pstm3 = $pdo->prepare($sql3);
$pstm3->execute([]);
$statistika = $pstm3->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Darbuotoju sarasas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>
    <div class="container mt-5">
        <div class="col-md-12">

            <div class="fs-3"><b>Darbuotojų sąrašas</b></div>
            <div>
                <a href="new.php" class="btn  btn-primary float-end mb-3">Pridėti naują darbuotoja</a>
            </div>
            <table class="table mt-3 table-success  table-striped-columns">
                <tr>
                    <th></th>
                    <th>Vardas</th>
                    <th>Pavardė</th>
                    <!--<th>Tel. nr.</th>
                    <th>Išsilavinimas</th>
                    <th>Alga</th>-->
                    <th>Pareigos</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($darbuotojai as $darbuotojas) { ?>
                    <tr>
                        <td><?= $darbuotojas['id'] ?></td>
                        <td><?= $darbuotojas['name'] ?></td>
                        <td><?= $darbuotojas['surname'] ?></td>
                        <!-- <td><?= $darbuotojas['phone'] ?></td>
                        <td><?= $darbuotojas['education'] ?></td>
                        <td>
                            <?= $darbuotojas['salary'] / 100 . ' ' . 'EUR' ?>
                        </td>-->
                        <td><?= $darbuotojas['positions_name'] ?></td>


                        <td><a href="projects.php?id=<?= $darbuotojas['id'] ?>" class="btn btn-info">Pridėti projektą</a></td>



                        <td><a class="btn btn-success" href="asmeninis.php?id=<?= $darbuotojas['id'] ?>">Plačiau</a></td>
                        <td>
                            <a href="update.php?id=<?= $darbuotojas['id'] ?>" class="btn btn-info">Redaguoti</a>
                            <a href="bendras.php?action=delete&id=<?= $darbuotojas['id'] ?>" class="btn btn-danger">Ištrinti</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="fs-3"><b>Baziniai darbo užmokesčiai</b></div>

                    <table class="table mt-3 table-success  table-striped-columns">
                        <tr>

                            <th>Pareigos</th>
                            <th>Bazinis darbo užmokestis</th>
                            <th>Darbuotojų skaicius</th>
                            <th></th>
                        </tr>
                        <?php foreach ($pareigos as $pozicija) { ?>
                            <tr>

                                <td><?= $pozicija['name'] ?></td>
                                <td><?= $pozicija['base_salary'] ?></td>
                                <td><?= $pozicija['kiekis'] ?></td>
                                <td><a href="#" class="btn btn-success">Rodyti darbuotojus</a></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="fs-3"><b>Imones statistika</b></div>

                    <table class="table mt-3 table-success  table-striped-columns">
                        <tr>

                            <th>Imoneje dirbanciu zmoniu skaicius</th>
                            <th>Vidutinis darbo uzmokestis</th>
                            <th>Minimalus darbo uzmokestis</th>
                            <th>Maksimalus darbo uzmokestis</th>
                        </tr>
                        <?php foreach ($statistika as $rezultatas) { ?>
                            <tr>

                                <td><?= $rezultatas['skaicius'] ?></td>
                                <td><?= $rezultatas['vidutinis'] ?></td>
                                <td><?= $rezultatas['maziausias'] ?></td>
                                <td><?= $rezultatas['didziausias'] ?></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>