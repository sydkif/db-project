<?php session_start();      
include('./database/DB.php');
        
        
        $username = $_POST['user'];  
        $password = $_POST['pass'];
		$table = $_POST['usertype'];

        
        $_SESSION["userid"] = $username;
        $_SESSION["userpassword"] = $password;
        $_SESSION['usertable'] = $table;
        echo "Session variables are set.";

        
         
          
            //to prevent from mysqli injection  
            
            $sql = "select * from $table where id = '$username' and password = '$password'"; 
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);

            $query = "SELECT name FROM $table WHERE id='$username'";
            $results = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($results);
            $_SESSION['usersname'] = $row['name'];
            
            
        
              
            if($table == "admin" && $count == 1){  
                if($username == $password){header("Location: ../reset/reset.php?id=$username");} else{
                echo $username . $table . "login successful admin";
                header("Location: admin/dashboard.php?id=".$_SESSION['userid']."&name=". $_SESSION['usersname'] . "");
                
                
				}
				
            }
			else if($table == "lecturer" && $count == 1){  
                echo $username . $table . "login successful lecturer";
				
            }
            else if($table == "student" && $count == 1){  
                echo $username . $table . "login successful student";
				
            }
            else{  
                echo "<h1> Login failed. Invalid username or password.</h1>";  
            }
            
			echo "<script>console.log('Table: ". $table. "');</script>" ; 
			echo "<script>console.log('Username: ". $username . "');</script>" ; 
              
            
    ?>   ?>