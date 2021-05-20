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
    <form  method="post">
        <div>
            <label for="inputId"><b>ID</b></label>
            <input type="text" class="form-control" name="inputId" placeholder="Please enter your ID" required id="inputId" />
        </div>
        <div>

            <label for="inputPassword"><b>Password</b></label>
            <input type="password" class="form-control" name="txt_password" required>

        </div>
        <div style="margin-left: 10px;">
            <label class="form-check-label"><input type="radio" name="account_type" id="student">
                Chinpira</label><br>
            <label class="form-check-label"><input type="radio" name="account_type" id="lecturer">
                Lycra Chromosome</label><br>
            <label class="form-check-label"><input type="radio" name="account_type" id="admin">
                Yadaran</label><br>
        </div>
        <button href="admin/register/student.php" type="submit" class="btn btn-primary btn-block" id="login">Login</button>
        </form>

        <br>
    </div>
</div>

<!-- Login Form END -->
<script>
    function nextPage() {
        if (document.getElementById('student').checked)
            window.location.href = "admin/register/student.php";
        else if (document.getElementById('lecturer').checked)
            window.location.href = "admin/register/lecturer.php";
        else if (document.getElementById('admin').checked)
            window.location.href = "admin/dashboard.php";
        else
            alert('Please select a user type');
    }
</script>


<?php include('templates/footer.php') ?>