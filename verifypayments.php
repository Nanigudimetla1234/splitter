<?php
session_start();
if (!$_SESSION['user']) {
    header("location:login.php");
}
require('./includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pendingpayments</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/1043f0857c.js" crossorigin="anonymous"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #4b4376;
        }

        tbody {
            color: white;
        }

        @media only screen and (min-width: 760px) {
            .width {
                width: 80vw;
                display: block;
                margin: auto;
            }
        }
    </style>
</head>

<body>
    <a href="index.php">

        <button style="margin-left: 2rem;margin-top:0.5rem" class="btn btn-outline-warning">Back</button>
    </a>
    <center>

        <h3 style="color:white;display:block;margin :auto;padding-bottom:2vh;">Please verify the payments</h3>
        <br>
    </center>
    <?php
    $admin = $_SESSION['user'];
    $pendingpayments = "select * from notification where tonumber='$admin' and statusbypaid='1' and status='0' ";
    $execute = mysqli_query($conn, $pendingpayments);
    ?>
    <div class=" width">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Group Name</th>
                        <th scope="col">Payement From</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment Gateway</th>
                        <th scope="col">Verify</th>


                    </tr>
                </thead>
                <tbody>

                    <?php
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($execute)) {
                        $count++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $row['groupname']; ?></td>
                            <td><?php echo $row['fromnumber']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td>Please verify the payment at : <?php echo $row['description']; ?></td>
                            <td><button class="button <?php echo $row['groupname']; ?> <?php echo $row['adminnumber']; ?> btn btn-outline-warning" id="<?php echo $row['fromnumber']; ?>">Verify</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </div>


            <script>
                let buttons = document.getElementsByClassName("button");
                for (let i = 0; i < buttons.length; i++) {
                    buttons[i].addEventListener("click", () => {
                        let adminnumber = buttons[i].classList[2];
                        let groupname = buttons[i].classList[1];
                        let fromnumber = buttons[i].id;
                        fetch("./api/verify.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                    adminnumber: adminnumber,
                                    groupname: groupname,
                                    fromnumber: fromnumber,
                                }),
                            })
                            .then((response) => response.text())
                            .then((data) =>
                                Swal.fire(`${data}`).then(() => {
                                    location.reload();
                                })
                            );

                    })
                }
            </script>

</body>

</html>