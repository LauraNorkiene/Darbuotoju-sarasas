<?php
include("db.php");

$sql = "SELECT id, name, surname, phone, birthday, education, round(salary/100,2) as salary FROM employees WHERE id=?";
$pstm = $pdo->prepare($sql);
$pstm->execute([$_GET['id']]);
$darbuotojai = $pstm->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Darbuotojo informacija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        hr {
            border: solid 3px green;
            background-color: green;
            width: 31%;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <?php foreach ($darbuotojai as $darbuotojas) { ?>
                        <h1><?= $darbuotojas['name'] . ' ' . $darbuotojas['surname'] ?></h1>
                        <hr>
                </div>




            </div>

            <div class="col-md-5 mt-5">

                <p>
                    <b>Gimimo data: </b> <br /> <?= $darbuotojas['birthday'] ?>
                </p>
                <div class="mt-5">
                    <p>
                        <b>Mėnesinė alga: </b> <br /><?= $atlyginimas = $darbuotojas['salary'] ?><?php echo ' ' . 'EUR' ?>

                    </p>
                </div>

            </div>
            <div class="col-md-6 mt-5">

                <p>
                    <b>Telefonas: </b> <br /> <?= $darbuotojas['phone'] ?>
                </p>


            <?php } ?>
            </div>

            <div class="col-md-6 mt-3">

                <div>
                    <div class="fs-3"><b>Mokesčiai</b></div>


                    <table class="table mt-3 table-success  table-striped-columns">

                        <tr>
                            <td>Priskaičiuotas atlyginimas „ant popieriaus“:</td>
                            <td class="curr"> <?php echo $atlyginimas; ?><?php echo ' ' . 'EUR' ?></td>


                        </tr>
                        <tr>
                            <td>Pritaikytas NPD</td>
                            <td class="curr"><?php if ($atlyginimas <= 1704) {
                                                    $NPD =  540 - 0.34 * ($atlyginimas - 730);
                                                } else {
                                                    $NPD =  400 - 0.18 * ($atlyginimas - 642);
                                                }
                                                echo $NPD; ?><?php echo ' ' . 'EUR' ?></td>


                        </tr>
                        <tr>
                            <td>Pajamų mokestis 20 %</td>
                            <td class="curr"><?php echo $GPM = ($atlyginimas - $NPD) * 0.2 ?><?php echo ' ' . 'EUR' ?></td>


                        </tr>
                        <tr>
                            <td>Sodra. Sveikatos draudimas 6 %</td>
                            <td class="curr"><?php echo $SD = $atlyginimas * 0.06 ?><?php echo ' ' . 'EUR' ?></td>


                        </tr>
                        <tr>
                            <td>Sodra. Pensijų ir soc. draudimas 12 %</td>
                            <td class="curr"><?php echo $PSD = $atlyginimas * 0.12 ?><?php echo ' ' . 'EUR' ?></td>


                        </tr>

                        <tr class="info">
                            <td>Išmokamas atlyginimas "į rankas":</td>
                            <td class="curr"><b><?php echo $IR = $atlyginimas - $GPM - $SD - $PSD ?><?php echo ' ' . 'EUR' ?></b></td>
                        </tr>

                        <tr>
                            <td colspan="2"><b>Darbo vietos kaina</b></td>
                        </tr>

                        <tr>
                            <td>Sodra 30.98 %:</td>
                            <td class="curr"><?php echo $SODRA = $atlyginimas * 0.3098 ?><?php echo ' ' . 'EUR' ?></td>
                        </tr>

                        <tr>
                            <td>Įmokos į garantinį fondą 0.16 % :</td>
                            <td class="curr"><?php echo $GF = $atlyginimas * 0.0016 ?><?php echo ' ' . 'EUR' ?></td>

                        </tr>
                        <tr class="info">
                            <td>Visa darbo vietos kaina :</td>
                            <td class="curr"><b><?php echo $VK = $GF + $SODRA + $atlyginimas ?><?php echo ' ' . 'EUR' ?></b></td>

                        </tr>
                    </table>
                </div>
            </div>



        </div>

    </div>

</body>

</html>