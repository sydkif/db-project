<?php
include('templates/header.php');

$_SESSION['status'] = "";
$_SESSION['msg'] = "";


if ($_SESSION['loginErr']==null){
    echo '<script language="javascript">';
    echo 'alert("Error Login Credential")';
    echo '</script>';
    $_SESSION['loginErr']="ok";
}

?>


<!-- Login Form START -->
<div class="container p-5">
    <h2 style="text-align: center;">Admin</h2>
    <h2 style="text-align: center;">Login Page</h2>
    <hr>
    
    <div class="col-xl-6 col-lg-6 col col-md-10 col-sm-12 form-box border rounded mt-6 shadow" style="margin:auto; background-color:rgb(246, 246, 246) ;">
        <form class="mt-3" name="login" action= "filechecker.php" onsubmit = "return validation()" method = "POST" class="needs-validation" novalidate="" autocomplete="on">
            <div class="form-group">
                <label for="inputId"><b>ID</b></label>
                <input type="text" class="form-control" id="user" name="user" placeholder="Please enter your ID">
            </div>
            <div class="form-group">
                <label for="inputPassword"><b>Password</b></label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" >
            </div>
            <div class="form-group" style="margin-left: 10px;">
                <label class="form-check-label"><input type="radio" name="usertype" id="student" value="student">
                    Student</label><br>
                <label class="form-check-label"><input type="radio" name="usertype" id="lecturer" value="lecturer">
                    Lecturer</label><br>
                <label class="form-check-label"><input type="radio" name="usertype" id="admin" value="admin">
                    Admin</label><br>
            </div>

            <button type="submit" class="btn btn-primary btn-block login-btn" id="login"><span>Login</span></button>

        </form>
        

        <br>
    </div>
</div>



<script>

         function validation()  
            {  
                var id=document.login.user.value;  
                var pass=document.login.pass.value;  
                if(id.length=="" && pass.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (pass.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }
                // if (document.getElementById('student').checked)
                //     window.location.href = "student/dashboard.php";
                // else if (document.getElementById('lecturer').checked)
                //      window.location.href = "lecturer/dashboard.php";
                // else if (document.getElementById('admin').checked)
                //      window.location.href = "admin/dashboard.php";
                // else{
                //     alert('Please select a user type');   
                //     window.location.href = "index.php";      
                // }
                                                       
              }

</script>

<?php include('templates/footer.php') ?>