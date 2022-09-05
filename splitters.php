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
    <title></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/1043f0857c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/split.css">

</head>

<body>
    <a href="index.php">

        <button style="margin-left: 2rem;margin-top:0.5rem" class="btn btn-outline-primary">Back</button>
    </a>
    <h1>complete Split report of : <?php echo $_GET['groupname']; ?></h1>
    <div class="tabs">

        <input type="radio" id="tab1" name="tab-control" checked>
        <input type="radio" id="tab2" name="tab-control">
        <input type="radio" id="tab3" name="tab-control">
        <input type="radio" id="tab4" name="tab-control">
        <ul>
            <li title="Features"><label for="tab1" role="button"><svg viewBox="0 0 24 24">
                        <path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z" />
                    </svg><br><span>Group Details</span></label></li>
            <li title="Delivery Contents"><label for="tab2" role="button"><svg viewBox="0 0 24 24">
                        <path d="M2,10.96C1.5,10.68 1.35,10.07 1.63,9.59L3.13,7C3.24,6.8 3.41,6.66 3.6,6.58L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.66,6.72 20.82,6.88 20.91,7.08L22.36,9.6C22.64,10.08 22.47,10.69 22,10.96L21,11.54V16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V10.96C2.7,11.13 2.32,11.14 2,10.96M12,4.15V4.15L12,10.85V10.85L17.96,7.5L12,4.15M5,15.91L11,19.29V12.58L5,9.21V15.91M19,15.91V12.69L14,15.59C13.67,15.77 13.3,15.76 13,15.6V19.29L19,15.91M13.85,13.36L20.13,9.73L19.55,8.72L13.27,12.35L13.85,13.36Z" />
                    </svg><br><span>Total Epenses</span></label></li>
            <li title="Shipping"><label for="tab3" role="button"><svg viewBox="0 0 24 24">
                        <path d="M3,4A2,2 0 0,0 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8H17V4M10,6L14,10L10,14V11H4V9H10M17,9.5H19.5L21.47,12H17M6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5M18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5Z" />
                    </svg><br><span>Transactions</span></label></li>
            <li title="Returns"><label for="tab4" role="button"><svg viewBox="0 0 24 24">
                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                    </svg><br><span>Payments status</span></label></li>
        </ul>

        <div class="slider">
            <div class="indicator"></div>
        </div>
        <div class="content">
            <section>

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

            </section>
            <section>
                <?php
                $count = 0;
                $totalexpenses = 0;
                $retreive = " SELECT * FROM `expenses` WHERE adminnumber='" . $adminnumber . "' and groupname='" . $groupname . "'";

                $data = mysqli_query($conn, $retreive);
                while ($row = mysqli_fetch_assoc($data)) {
                    $count++;
                    $totalexpenses = $totalexpenses + (int)$row['amount'];
                }
                ?>
                <h1 style="text-align: center;">Group Name : <?php echo $groupname; ?></h1>
                <h3> Total Expenses in the group : <span style="color: blue;"><?php echo $totalexpenses;  ?></span> Rupees</h3><?php
                                                                                                                                echo "<br>";
                                                                                                                                ?><h3> Group Size : <span style="color: blue;"> <?php echo $members;  ?></span> Members</h3>
            </section>
            <section>
                <h2>expenses</h2>
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
            </section>
            <section>

                <h2>Status</h2>

                <h3>Get and Pay Transactions</h3>
                <div style="background-color:#8F00FF ;color:white;padding:1rem;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">


                    <?php
                    $averageamount = $totalexpenses / $members;
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
                            echo $number . " need to get : " . round(abs($amount), 2);
                            echo "<br>";
                        } else {
                            $positives[$number] = $amount;
                            echo $number . " need to pay : " . round(abs($amount), 2);
                            echo "<br>";
                        }
                    }
                    ?>
                </div>
                <br>
                <h3>who Need to give to whoom</h3>
                <div style="background-color:#8F00FF ;color:white;padding:1rem;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                    <?php
                    foreach ($positives as $number => $amount) {
                        $percentages[$number] = $amount / $negativesum;
                    }
                    $deletenotification = "delete from notification where adminnumber='$adminnumber' and groupname='$groupname'";
                    $notificationdeleted = mysqli_query($conn, $deletenotification);

                    foreach ($positives as $number => $amount) {
                        $percentage = $percentages[$number];
                        foreach ($negatives as $number2 => $amount2) {
                            echo "<br>";
                            $amounttopay = abs($percentage * $amount2);
                            echo $number . " ===> " . $number2 . " of  " . round($amounttopay, 2);

                            $insertnotification = "insert into notification values (DEFAULT,'$adminnumber','$groupname','$number','$number2','$amounttopay',0,0,DEFAULT)";
                            $executenotification = mysqli_query($conn, $insertnotification);
                        }
                    }

                    ?>
                </div>
            </section>
        </div>
    </div>

</body>

</html>