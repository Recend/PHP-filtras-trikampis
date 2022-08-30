<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
    

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header text-center">Skelbimų sąrašas</div>
                    <div class="card-body">
                        <?php include "skelbimai.php";
                        $d = "";
                        if(isset($_GET['d'])){
                        $d = $_GET['d'];
                        $order = $_GET['orderBy'];
                        usort($skelbimai, function ($a, $b) use ($order) {
                            $d = $_GET['d'];
                            if ($d == "DESC") {
                                return $a[$order] <=> $b[$order];
                            } else {
                                return $b[$order] <=> $a[$order];
                            }
                        });
                        }
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php if ($d == "ASC") { ?>
                                            <a href="funk.php?orderBy=id&d=DESC"> ID&uparrow;</a>
                                        <?php } else { ?>
                                            <a href="funk.php?orderBy=id&d=ASC"> ID&downarrow;</a>
                                        <?php } ?>
                                    </th>
                                    <th><?php if ($d == "ASC") { ?>
                                            <a href="funk.php?orderBy=text&d=DESC"> Skelbimas&uparrow;</a>
                                        <?php } else { ?>
                                            <a href="funk.php?orderBy=text&d=ASC"> Skelbimas&downarrow;</a>
                                        <?php } ?>
                                    </th>
                                    <th><?php if ($d == "ASC") { ?>
                                            <a href="funk.php?orderBy=cost&d=DESC"> Kaina&uparrow;</a>
                                        <?php } else { ?>
                                            <a href="funk.php?orderBy=cost&d=ASC"> Kaina&downarrow;</a>
                                        <?php } ?>
                                    </th>
                                    <th><?php if ($d == "ASC") { ?>
                                            <a href="funk.php?orderBy=onPay&d=DESC"> Apmokejimas&uparrow;</a>
                                        <?php } else { ?>
                                            <a href="funk.php?orderBy=onPay&d=ASC"> Apmokejimas&downarrow;</a>
                                        <?php } ?>
                                    </th>
                                </tr>                                
                            </thead>
                            <tbody>
                                <?php foreach ($skelbimai as $skelbimas) { ?>
                                    <tr>
                                        <td><?= $skelbimas['id'] ?></td>
                                        <td><?= $skelbimas['text'] ?></td>
                                        <td><?= $skelbimas['cost'] ?></td>
                                        <td><?php if ($skelbimas['onPay'] > 0) {
                                                echo date('Y-m-d', $skelbimas['onPay']);
                                            } else {
                                                echo "neapmoketa";
                                            } ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php

                        $count = 0;
                        $apmoketa = 0;
                        $suma = 0;
                        $skola = 0;
                        foreach ($skelbimai as $skelbimas) {
                            $count++;
                            if ($skelbimas['onPay'] > 0) {
                                $apmoketa++;
                                $suma += $skelbimas['cost'];
                            } else {
                                $skola += $skelbimas['cost'];
                            }
                        }
                        echo "Viso skelbimų yra $count <br>";
                        echo "Apmokėtų sąskaitų yra $apmoketa <br>";
                        echo "Už skelbimus gauta $suma EU <br>";
                        echo "Suma kuri dar turetu buti apmoketa $skola EU";

                        ?>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-3 mx-auto">
<h1 class="text-center">Trikampis</h1>

    <form class="form-control" action="" method="POST">
        <input class="form-control" type="number" name="ilgis1" placeholder="Kraštinė a"><br>
        <input class="form-control" type="number" name="ilgis2" placeholder="Kraštinė b"><br>
        <input class="form-control" type="number" name="ilgis3" placeholder="Kraštinė c"><br>
        <button class="btn btn-primary mt-1">Skaičiuoti</button>
     
    <?php


    if (isset($_POST['ilgis1'])) {
        $a = $_POST['ilgis1'];
        $b = $_POST['ilgis2'];
        $c = $_POST['ilgis3'];
        if (($a + $b > $c) && ($b + $c > $a) && ($a + $c > $b)) {
            echo "Trikampio plotas yra ".plotas($a, $b, $c);
        } else {
            echo 'Trikampis negali būti sudarytas';
        }
    }

    function plotas($a, $b, $c){
        $p = ($a + $b + $c) / 2;
        return round(sqrt($p * ($p - $a) * ($p - $b) * ($p - $c)),2);
    }    
?>
 </form>
 </div>
   </div>


</body>

</html>