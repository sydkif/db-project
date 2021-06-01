<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Author Wannabe System</title>
</head>

<body>

    <?php

    $_SESSION['status'] = "";
    $_SESSION['msg'] = "";


    if (isset($_SESSION['loginErr']) == "error") {
        echo '<script language="javascript">';
        echo 'alert("Error Login Credential")';
        echo '</script>';
        $_SESSION['loginErr'] = "ok";
    }

    // var_dump($_SESSION['userid']);
    // die();

    ?>

    <link rel="stylesheet" href="/css/login.css">

    <!-- Login Form START -->
    <div class="container">

        <div id="loginCard" class="col col-sm-5 col-xl-4 form-box shadow" style="margin: auto; text-align:center;">
        <img src="/img/logo.png" alt="">
        <hr>
            <form name="login" action="filechecker.php" onsubmit="return validation()" method="POST" class="needs-validation" novalidate="" autocomplete="on">
                <div class="form-group">
                    <input type="text" class="form-control" id="user" name="user" placeholder="User ID">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
                <div class="form-group wrapper" style="margin:auto;">

                    <input type="radio" name="usertype" id="option-1" value="student">
                    <input type="radio" name="usertype" id="option-2" value="lecturer">
                    <input type="radio" name="usertype" id="option-3" value="admin">

                    <label for="option-1" class="option option-1">
                        <div class="dot"></div>
                        <span>Student</span>
                    </label>

                    <label for="option-2" class="option option-2">
                        <div class="dot"></div>
                        <span>Lecturer</span>
                    </label>

                    <label for="option-3" class="option option-3">
                        <div class="dot"></div>
                        <span>Admin</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-custom btn-block login-btn" id="login"><span>Login</span></button>
            </form>

            <br>
        </div>
    </div>



    <script>
        function validation() {

            var id = document.login.user.value;
            var pass = document.login.pass.value;
            var radio = document.login.usertype.value;

            if (id.length == "" && pass.length == "" && radio.length == "") {
                alert("All fields are empty");
                return false;

            } else {
                if (id.length == "") {
                    alert("User Name is empty");
                    return false;
                }

                if (pass.length == "") {
                    alert("Password field is empty");
                    return false;
                }

                if (radio.length == "") {
                    alert("User type is not selected");
                    return false;
                }
            }
        }
    </script>

</body>

</html>