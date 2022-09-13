<?php
include("db.php");


if (isset($_POST['action']) && $_POST['action'] == 'update') {
    print_r($_POST);
    $sql = "UPDATE employees SET name=?, surname=?, phone=?, education=?, salary=?, positions_id=?  WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_POST['name'], $_POST['surname'], $_POST['phone'], $_POST['education'],  $_POST['salary'], $_POST['positions_id'], $_POST['id']]);
    header("location:bendras.php");
    die();
}
$darbuotojas = [];
$positions = [];
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM employees WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_GET['id']]);
    $darbuotojas = $stm->fetch(PDO::FETCH_ASSOC);


    $sql = "SELECT * FROM positions";
    $stm = $pdo->prepare($sql);
    $stm->execute([]);
    $positions = $stm->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("location:bendras.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">Pridėti naują šalį</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $darbuotojas['id'] ?>">
                            <div class="mb-3">
                                <label for="" class="form-label">Vardas</label>
                                <input name="name" type="text" class="form-control" value="<?= $darbuotojas['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Pavardė</label>
                                <input name="surname" type="text" class="form-control" value="<?= $darbuotojas['surname'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tel. nr.</label>
                                <input name="phone" type="text" class="form-control" required value="<?= $darbuotojas['phone'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Išsilavinimas</label>
                                <input name="education" type="text" class="form-control" required value="<?= $darbuotojas['education'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alga</label>
                                <input name="salary" type="number" class="form-control" required value="<?= $darbuotojas['salary'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Pareigos: </label>
                                <select name="positions_id" class="form-control">
                                    <?php foreach ($positions as $position) { ?>
                                        <option value="<?= $position['id'] ?>" <?= ($position['id'] == $darbuotojas['positions_id']) ? 'selected' : '' ?>><?= $position['name'] ?></option>
                                    <?php } ?>


                                </select>

                            </div>
                            <button class="btn btn-success">Atnaujinti</button>
                            <a href="bendras.php" class="btn btn-info float-end">Atgal</a>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>