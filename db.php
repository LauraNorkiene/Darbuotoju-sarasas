<?php

$dsn = "mysql:host=localhost;dbname=employees;charset=utf8mb4";
$pdo = new PDO($dsn, 'root', '');

/*$sql = "SELECT * FROM employees";
$pstm = $pdo->prepare($sql);
$pstm->execute();
$darbuotojai = $pstm->fetchAll(PDO::FETCH_ASSOC);

print_r($darbuotojai);



while ($row=$result->fetch(PDO::FETCH_ASSOC)){
    echo $row['name'].'<br>';
}
*/