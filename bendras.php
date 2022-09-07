<?php
include("db.php");

$sql = "SELECT id, name, surname, phone, education, round(salary/100,0) as salary FROM employees";
$pstm = $pdo->prepare($sql);
$pstm->execute();
$darbuotojai = $pstm->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT id, name, base_salary FROM positions";
$pstm2 = $pdo->prepare($sql2);
$pstm2->execute();
$pareigos = $pstm2->fetchAll(PDO::FETCH_ASSOC);

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
            <table class="table mt-3 table-success  table-striped-columns">
                <tr>
                    <th></th>
                    <th>Vardas</th>
                    <th>Pavardė</th>
                    <th>Tel. nr.</th>
                    <th>Išsilavinimas</th>
                    <th>Alga</th>
                    <th></th>
                </tr>
                <?php foreach ($darbuotojai as $darbuotojas) { ?>
                    <tr>
                        <td><?= $darbuotojas['id'] ?></td>
                        <td><?= $darbuotojas['name'] ?></td>
                        <td><?= $darbuotojas['surname'] ?></td>
                        <td><?= $darbuotojas['phone'] ?></td>
                        <td><?= $darbuotojas['education'] ?></td>
                        <td><?= $darbuotojas['salary'] . ' ' . 'EUR' ?></td>
                        <td><a class="btn btn-success" href="asmeninis.php?id=<?= $darbuotojas['id'] ?>">Plačiau</a></td>
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
                            <th></th>
                            <th>Pareigos</th>
                            <th>Bazinis darbo užmokestis</th>
                            <th></th>
                        </tr>
                        <?php foreach ($pareigos as $pozicija) { ?>
                            <tr>
                                <td><?= $pozicija['id'] ?></td>
                                <td><?= $pozicija['name'] ?></td>
                                <td><?= $pozicija['base_salary'] ?></td>
                                <td><a href="#" class="btn btn-success">Rodyti darbuotojus</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>