<?php include('templates/header.php') ?>

<!-- Login Form START -->
<div class="container p-5">
    <h2 style="text-align: center;"><del>Author</del></h2>
    <h2 style="text-align: center;">Login Page</h2>
    <hr class="col-6">
    <div class="col-6 offset-3 form-box border rounded mt-6" style="background-color:rgb(246, 246, 246) ;">
        <form class="mt-3">
            <div class="form-group">
                <label for="inputId"><b>ID</b></label>
                <input type="text" class="form-control" id="inputId" placeholder="Please enter your ID">
            </div>
            <div class="form-group">
                <label for="inputPassword"><b>Password</b></label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <div class="form-group" style="margin-left: 10px;">
                <label class="form-check-label"><input type="radio" name="account_type" id="student">
                    Student</label><br>
                <label class="form-check-label"><input type="radio" name="account_type" id="lecturer">
                    Lecturer</label><br>
                <label class="form-check-label"><input type="radio" name="account_type" id="admin">
                    Admin</label><br>
            </div>
            <button onclick="nextPage()" type="button" class="btn btn-primary" id="login">Login</button>
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
            window.location.href = "admin/register/admin.php";
        else
            alert('Please select a user type');
    }
</script>

<?php include('templates/footer.php') ?>