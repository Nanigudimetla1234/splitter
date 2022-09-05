<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BillSplitter|login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comfortaa&display=swap');

        body {
            background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%);
        }

        .login {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
            font-family: 'Comfortaa', cursive;
        }

        @media only screen and (max-width: 760px) {
            .login {
                width: 360px;
                padding: 25% 0 0;
                margin: auto;
                font-family: 'Comfortaa', cursive;
            }
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            border-radius: 10px;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
        }

        .form input {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            border-radius: 5px;
            margin: 0 0 20px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Comfortaa', cursive;
        }

        .form input:focus {
            background: #dbdbdb;
        }

        #buttons {
            font-family: 'Comfortaa', cursive;
            text-transform: uppercase;
            outline: 0;
            background: #4b6cb7;
            width: 100%;
            border: 0;
            border-radius: 5px;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        #buttons:hover {
            background: #395591;
        }

        .form span {
            font-size: 2.5rem;
            color: #4b6cb7;
            position: relative;
            top: -15px;
        }

        /* heading */

        span {
            color: #fff;
            font-family: "Rubik", sans-serif;
            font-size: 2em;
            line-height: 1em;
            text-transform: uppercase;
            display: inline-block;
            opacity: 0;
            transform: scale(0.2) rotate(-40deg);
            text-shadow: 0 1px 0 hsl(0, 0%, 80%), 0 2px 0 hsl(0, 0%, 75%),
                0 3px 0 hsl(0, 0%, 70%), 0 4px 0 hsl(0, 0%, 65%), 0 5px 0 hsl(0, 0%, 60%),
                0 6px 0 hsl(0, 0%, 55%), 0 7px 1px hsla(0, 0%, 0%, 20%),
                0 0 5px hsla(0, 0%, 0%, 10%), 0 1px 3px hsla(0, 0%, 0%, 30%),
                0 3px 5px hsla(0, 0%, 0%, 20%), 0 5px 10px hsla(0, 0%, 0%, 25%),
                0 10px 10px hsla(0, 0%, 0%, 20%), 0 25px 25px hsla(0, 0%, 0%, 15%);
        }

        .show {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            transition-timing-function: cubic-bezier(0.6, 0.56, 0.66, 1.54);
            transition-duration: 1s;
        }
    </style>
</head>

<body>
    <p style="margin-bottom:0px;" id="heading">Bill<br>Splitter<br>
    <div class="login">
        <div class="form">
            <form class="login-form" action="includes/login.inc.php" method="post" novalidate>
                <span>Login</span><br>
                <input type="text" name="number" id="number" placeholder="Phone Number">
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" value="Login" name="submit" id="buttons">
            </form>
            <h3>if you are not a user ? </h3><a href="register.php"> Register Here</a </div>
        </div>
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
                }, 0 * (k + 1));
            }
        </script>

</body>


</html>