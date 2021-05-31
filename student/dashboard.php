<?php include('../templates/header.php'); ?>

<?php 
    //Hardcode test

    $_SESSION['userId'] = 'CI123';
    $_SESSION['table'] = 'student';

    $userID = $_SESSION['userId'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h1>Student Dashboard</h1>
        <hr>
        <h2>Subject List</h2>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: left; vertical-align: middle;">Lecturer</th>
                        <th rowspan="2" style="text-align: left; vertical-align: middle;">Subject</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Assignment<br>& Tutorial</th>
                        <th colspan="4" style="text-align: center;">Quiz & Marks</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center; font-size:small;">True / False</th>
                        <th colspan="2" style="text-align: center; font-size:small;">Objective</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                include '../DB.php';

                $sql = "SELECT l.name AS lecturer_name, s.name AS subject_name FROM SUBJECT S JOIN workload wl ON s.id = wl.subject_id JOIN lecturer l ON wl.lecturer_id = l.id;";
                $result = $conn->query($sql);
                $num = 0;

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ++$num;
                
                ?>


                    <tr>
                        <th scope="row"><?= $num; ?></th>
                        <td><?= $row['lecturer_name']; ?></td>
                        <td><?= $row['subject_name']; ?></td>
                        <!-- TO DO LIST - ADD ASSIGNMENT, TRUE FALSE, OBJECTIVE -->
                        <td style="display:flex; align-items:center; justify-content:center; ">
                            <button class=" btn btn-sm " title="View Assignment & Tutorial" onclick="location.href = 'view/assignment.php';">
                                <i class="bi bi-file-earmark-text" style="font-size: 28px;"></i></button>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View True False Quiz" onclick="location.href = 'view/true-false-quiz.php';"><i class="bi bi-clipboard" style="font-size: 28px; "></i></button>
                            </div>
                        </td>
                        <td> <i style="font-style:normal; ">9/10</i></td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View Objective Quiz"><i class=" bi bi-clipboard" style="font-size: 28px;"></i></button>
                            </div>
                        </td>
                        <td><i style="font-style:normal; ">4/15</i></td>
                    </tr>
                <?php 
                    }
                }else{
                    echo "No results found";
                }

                $conn->close();
                ?>


                </tbody>
            </table>
        </div>
        <hr>

        <div class="container">
            <h4>Register Subject</h4>
            <form method="POST">
            <?php 
                include '../DB.php';

                $sql = "SELECT l.name AS lecturer_name, s.name AS subject_name, s.id AS subject_id FROM SUBJECT S JOIN workload wl ON s.id = wl.subject_id JOIN lecturer l ON wl.lecturer_id = l.id;";
                $result = $conn->query($sql);
                $num = 0;                
            ?>
            <select name="subject_id" class="custom-select" style=" width:50%; text-transform: uppercase;">
                <?php     
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                ?>
                <option value="<?= $row['subject_id'] ?>"> <?= $row['lecturer_name'] . " - " . $row['subject_name'] ?></option>

            <?php 
                    } //End Whileloop
                }
            ?>
            </select>

            <button name="add" class="btn btn-sm" title="Register Subject">
                <i class="bi bi-plus-square" style="font-size: 28px;"></i></button>
            <hr>
            </form>
        </div>

        <?php 
        //Register Subjects for students
        include "../DB.php";
        if(isset($_POST['add'])){
            $subjectId = $_POST['subject_id'];
            $studentId = $_SESSION['userId'];

            $sql = "INSERT INTO student_subject (subject_code, student_id) VALUES ('$subjectId', '$studentId')";
            
            if($conn->query($sql) === true){
                // Success
                $_SESSION['msg'] = "Subject added successfully!";
                $_SESSION['status'] = "Success";
            }else{
                // Failed
                $_SESSION['msg'] = "Error: " . $sql . " | " . $conn->error;
                $_SESSION['status'] = "Fail";
            }
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $conn->close();

        ?>

    </div>

    <?php include('../templates/footer.php'); ?>