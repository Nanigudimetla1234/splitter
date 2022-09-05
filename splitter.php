<?php
session_start();
require('./includes/db.php');
if (!$_SESSION['user']) {
    header("location:login.php");
}

$groupname = $_GET['groupname'];
$adminnumber = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/1043f0857c.js" crossorigin="anonymous"></script>
    <title>Splitter</title>
</head>

<body>



    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name of Member</th>
                <th scope="col">Phone number</th>
                <th scope="col">Mail id</th>
                <th scope="col">Amount Spended</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $memmbers = 0;
            $count = 0;
            $members = 0;

            $paymentlist = array();

            $needtopay = array();



            $distinct = "select name,phno,mail from users where phno in (SELECT DISTINCT paidnumber FROM `expenses` WHERE adminnumber='" . $adminnumber . "' and groupname='" . $groupname . "')";

            $distinctexecuted = mysqli_query($conn, $distinct);
            while ($row = mysqli_fetch_assoc($distinctexecuted)) {
                $members++;
                $count++;
            ?>
                <!-- echo $row['name'];
                echo $row['phno'];
                echo "<br>"; -->
                <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phno']; ?></td>
                    <td><?php echo $row['mail']; ?></td>

                    <?php
                    $fetchpaidamount = "select amount from transexpenses WHERE adminnumber='" . $adminnumber . "' and groupname='" . $groupname . "' and paymentnumber='" . $row['phno'] . "'";

                    $executefetchpaidamount = mysqli_query($conn, $fetchpaidamount);
                    if (!$executefetchpaidamount) {
                        echo mysqli_error($conn);
                    }
                    while ($rows = mysqli_fetch_assoc($executefetchpaidamount)) {
                    ?>
                        <td><?php echo $rows['amount'] ?></td>
                    <?php
                        $paymentlist[$row['phno']] = $rows['amount'];
                    }
                    ?>
                </tr>

            <?php
            }

            ?>

        </tbody>
    </table>

    <h6>Dash board which consists of all the transactions of the group </h6>
    <br>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">paid number</th>
                <th scope="col">Amount</th>
                <th scope="col">description</th>
                <th scope="col">date</th>
                <th scope="col">time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            $totalexpenses = 0;
            $retreive = " SELECT * FROM `expenses` WHERE adminnumber='" . $adminnumber . "' and groupname='" . $groupname . "'";

            $data = mysqli_query($conn, $retreive);
            while ($row = mysqli_fetch_assoc($data)) {
                $count++;
                $totalexpenses = $totalexpenses + (int)$row['amount'];
            ?>

                <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $row['paidnumber']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr>


            <?php

            }
            ?>
        </tbody>
    </table>
    <?php
    echo "<br>";
    echo "<br>";
    ?><h2> Total Expenses in the group : <?php echo $totalexpenses;  ?></h2><?php
                                                                                    echo "<br>";
                                                                                    ?><h2> Total number of members in the group : <?php echo $members;  ?></h2>
    <?php
    echo "<br>";
    echo "<br>";


    $averageamount = $totalexpenses / $members;
    echo "average amount" . $averageamount . "<br>";
    foreach ($paymentlist as $number => $amount) {
        $needtopay[$number] = $averageamount - $amount;
    }

    echo "<br>";
    $positives = array();

    $negatives = array();

    $percentages = array();

    $negativesum = 0;
    foreach ($needtopay as $number => $amount) {
        if ($amount < 0) {
            $negatives[$number] = $amount;
            $negativesum = $negativesum + abs($amount);
            echo $number . " need to get :" . abs($amount);
            echo "<br>";
        } else {
            $positives[$number] = $amount;
            echo $number . " need to pay :" . abs($amount);
            echo "<br>";
        }
    }


    echo "<br>";
    echo "<br>";
    foreach ($positives as $number => $amount) {
        echo $number . " positive array :" . $amount;
        echo "<br>";
    }
    foreach ($negatives as $number => $amount) {
        echo $number . " negative aray :" . $amount;
        echo "<br>";
    }
    foreach ($positives as $number => $amount) {
        $percentages[$number] = $amount / $negativesum;

        echo "percentages:" . $percentages[$number];
        echo "<br>";
    }

    echo "<br>";
    echo "<br>";

    $deletenotification = "delete from notification where adminnumber='$adminnumber' and groupname='$groupname'";
    $notificationdeleted = mysqli_query($conn, $deletenotification);

    foreach ($positives as $number => $amount) {
        $percentage = $percentages[$number];
        foreach ($negatives as $number2 => $amount2) {
            echo "<br>";
            $amounttopay = abs($percentage * $amount2);
            echo $number . " need to give to " . $number2 . " of  " . $amounttopay;

            $insertnotification = "insert into notification values (DEFAULT,'$adminnumber','$groupname','$number','$number2','$amounttopay',0,0,DEFAULT)";
            $executenotification = mysqli_query($conn, $insertnotification);
        }
    }


    ?>
</body>

</html>