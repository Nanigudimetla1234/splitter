<?php
require('./includes/db.php');
session_start();
if (!$_SESSION['user']) {
    header("location:login.php");
}
?>

<!-- 123 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bill_splitter</title>
    </title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"><!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/1043f0857c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <?php
    $fetchname = "select * from users where phno='" . $_SESSION['user'] . "'";
    $names = mysqli_query($conn, $fetchname);
    $row = mysqli_fetch_assoc($names);
    $name = $row['name'];
    $debits = $row['debits'];
    $credits = $row['credits'];
    ?>
    <div class="row">
        <div class="col-lg-2 sidenavbar">
            <div>
                <p id="heading">Bill<br>Splitter</p>
            </div>
            <div data-aos="fade-right" data-aos-duration="1500">
                <h5>WELCOME BACK <br>
                    <h3 style=" color: #9FC9F3;"><?php echo $name ?></h3>
                </h5>
                <br>
                <h6>
                    <?php
                    $debits = 0;
                    $credits = 0;
                    $user = $_SESSION['user'];
                    $debitsquery = "select * from notification where fromnumber='$user' and status='0' and statusbypaid='0'";
                    $executedebit = mysqli_query($conn, $debitsquery);
                    if (!$executedebit) {
                        echo mysqli_error(($conn));
                    }
                    while ($row = mysqli_fetch_assoc($executedebit)) {
                        $debits = $debits + $row['amount'];
                    }
                    $creditquery = "select * from notification where tonumber='$user' and status='0' and statusbypaid='0'";
                    $executecredit = mysqli_query($conn, $creditquery);
                    while ($row = mysqli_fetch_assoc($executecredit)) {
                        $credits = $credits + $row['amount'];
                    }
                    ?>
                    Your Debits : <?php echo $debits; ?> &nbsp;<i class="bi bi-arrow-up-square-fill"></i>
                </h6>
                <br>
                <h6>
                    Your Credits : <?php echo $credits; ?> &nbsp;<i class="bi bi-arrow-down-square-fill"></i>
                </h6>
                </h6>
            </div>
            <div class="col-md-0 footer">
                <p>Made with &#10084; by <br> Narayana Rao</p>
            </div>
        </div>

        <div class="col-lg-10 cols main_cols">
            <div style="width: 100%;">
                <div class="topnavbar" style="display: flex;background-color:#4b4376;flex-wrap:wrap">
                    <a href="pendingpayments.php"><button type="button" class="btn btn-outline-warning" data-aos="fade-left" data-aos-duration="600">Pending Payments</button></a>
                    <a href="verifypayments.php"><button type="button" class="btn btn-outline-warning" data-aos="fade-left" data-aos-duration="800">Verify Payments</button></a>

                    <button type="button" class="btn btn-outline-warning" id="join" data-aos="fade-left" data-aos-duration="1200">Join Group</button>
                    <a href="./includes/logout.php"><button type="button" class="btn btn-outline-warning" data-aos="fade-left" data-aos-duration="1600">Logout</button></a>

                </div>
            </div>

            <div style="display: flex;justify-content:start;">
                <button type="button" class="btn btn-info" id="firstbutton">Created Groups </button>
                <button type="button" class="btn btn-info" id="secondbutton">Added Groups</button>

            </div>

            <div id="first">
                <div class="row" data-aos="fade-up">
                    <?php

                    $fetching = "SELECT * FROM `teams` WHERE adminnumber='" . $_SESSION['user'] . "' group by groupname";
                    $fetched  = mysqli_query($conn, $fetching);
                    while ($row = mysqli_fetch_assoc($fetched)) {
                    ?>

                        <div class=" col-md-4 col-sm-12 box" style="margin:2rem;">
                            <h6>Group Name : <?php echo $row["groupname"]; ?></h6>
                            <div class="buttons" style="display: flex;">

                                <button class="btn btnsize btn-primary addpart" id="<?php echo $row['groupname']; ?>">Add Participent</button>
                                <button class="btn btnsize btn-primary addexpenses" id="<?php echo $row['groupname']; ?>">Add Expenses</button></a>


                            </div>

                            <center>

                                <a href="splitters.php?groupname=<?php echo $row["groupname"]; ?>"><button class="btn btnsize2 btn-outline-success">Go For Split</button></a>
                            </center>

                        </div>


                    <?php
                    } ?>
                    <!-- for Adding template  -->

                    <div style="display:flex;justify-content:end">

                        <div class="centerplus">
                            <i class="bi bi-plus-circle plus" id="box"></i>
                        </div>

                    </div>
                </div>
            </div>



            <!-- ------------------- -->

            <!-- <div class="col-lg-10 cols main_cols" id="second" style="display:none"> -->

            <div id="second" style="display:none">
                <div class="row">
                    <?php
                    $fething2 = "select * FROM `teams` WHERE membernumber='" . $_SESSION['user'] . "'";
                    $fetched2  = mysqli_query($conn, $fething2);
                    while ($row = mysqli_fetch_assoc($fetched2)) {
                    ?>
                        <div class=" col-md-4 col-sm-12 box" style="margin:2rem;">
                            <h6>Group Name : <?php echo $row["groupname"]; ?></h6>
                            <h6>Group Admin Number : <?php echo $row["adminnumber"]; ?></h6>
                            <div class="buttons" style="display: flex;">
                                <button class="btn btn-primary toaddexpenses <?php echo $row["adminnumber"]; ?>" id="<?php echo $row['groupname']; ?>">Add Expenses</button>
                            </div>

                        </div>


                    <?php
                    } ?>
                </div>
            </div>

        </div>
    </div>

    </div>
    <!-- <footer>
        <div>
            <p>Made with love by narayana Rao</p>
        </div>
    </footer> -->
    <script>
        let phno = <?php echo $_SESSION['user']; ?>;
        console.log(phno);
    </script>
    <script>
        //Add <span> to letters
        var string = document.getElementById("heading").innerHTML;
        result = string.replace(/(?![^<]*>)[^<]/g, (c) => `<span>${c}</span>\n`);
        document.getElementById("heading").innerHTML = result;
        document.getElementById("heading").style["opacity"] = "1";

        //Show letters
        let thetag = document.querySelectorAll("span");
        for (var i = 0; i < thetag.length; i++) {
            let k = i;
            setTimeout(function() {
                thetag[k].className = "show";
            }, 20 * (k + 1));
        }
    </script>
    <script src="./assets/js/index.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>