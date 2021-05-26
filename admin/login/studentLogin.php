<?php
include('templates/header.php');
$_SESSION['status'] = null;
$_SESSION['msg'] = null;
?>


<!-- Login Form START -->
<div class="container p-5">
    <h2 style="text-align: center;">Lord Chin CHin</h2>
    <h2 style="text-align: center;">Login Page</h2>
    <hr>
    
    <div class="col-xl-6 col-lg-6 col col-md-10 col-sm-12 form-box border rounded mt-6 shadow" style="margin:auto; background-color:rgb(246, 246, 246) ;">
    <form  action="admin/register/student.php">
        <div>
            <label for="inputId"><b>ID</b></label>
            <input type="text" class="form-control" name="inputId" placeholder="Please enter your ID" required >
        </div>
        <div>
            <label for="inputPassword"><b>Password</b></label>
            <input type="password" class="form-control" name="txt_password" placeholder="Enter your password" required>
        </div>
        <br>
        <button input type="submit" class="btn btn-primary btn-block" id="login">Login</button>
        </form>

        <br>
    </div>
</div>
<?php include('templates/footer.php') ?>