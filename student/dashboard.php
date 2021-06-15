<?php include('../templates/header.php');

// User type verification
if ($_SESSION['usertable'] != 'student')
    header("Location: /index.php");

$userName = ucfirst($_SESSION['usersname']);
$userID = strtoupper($_SESSION['userid']);


?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h1>Student Dashboard</h1>
        <h2>Welcome, <?= $userName . " " . $userID ?> </h2>
        <hr>
        <h2>Subject List</h2>
        <div class="table-responsive shadow rounded">
            <table class="table" id="dashboard-student">
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
                    include '../database/DB.php';

                    $sql = "SELECT l.name AS lecturer_name, l.id AS lecturer_id, s.name AS subject_name, 
                            ss.subject_id AS subject_id, ss.tf_marks AS tf_marks, ss.mc_marks AS mc_marks
                            FROM student_subject ss
                            JOIN lecturer l ON ss.lecturer_id = l.id
                            JOIN subject s ON ss.subject_id = s.id
                            WHERE ss.student_id = '$userID';";
                    $result = $conn->query($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$num;

                    ?>
                            <tr>
                                <th scope="row"><?= $num; ?></th>
                                <td><?= $row['lecturer_name']; ?></td>
                                <td><?= $row['subject_id'] . " - " . $row['subject_name']; ?></td>
                                <td style="display:flex; align-items:center; justify-content:center; ">
                                    <button class=" btn btn-sm " title="View Assignment & Tutorial" onclick="location.href = 'view/assignment.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>&lid=<?= $row['lecturer_id'] ?>';">
                                        <i class="bi bi-file-earmark-text" style="font-size: 28px;"></i></button>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <button class="btn btn-sm" title="View True False Quiz" onclick="location.href = 'view/true-false-quiz.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';" <?php if ($row['tf_marks'] > 0) echo 'disabled'  ?>>
                                            <i class="bi bi-clipboard" style="font-size: 28px; "></i></button>
                                    </div>
                                </td>
                                <td><i style="font-style:normal;" class="badge badge-<?php echo ($row['tf_marks'] <= 0) ? 'danger' :  'success'; ?>"><?= $row['tf_marks'] ?></i></td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <button class="btn btn-sm" title="View Objective Quiz" onclick="location.href = 'view/objective-quiz.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';" <?php if ($row['mc_marks'] > 0) echo 'disabled'  ?>>
                                            <i class=" bi bi-clipboard" style="font-size: 28px;"></i></button>
                                    </div>
                                </td>
                                <td><i style="font-style:normal;" class="badge badge-<?php echo ($row['mc_marks'] <= 0) ? 'danger' :  'success'; ?>"><?= $row['mc_marks'] ?></i></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "No results found";
                    }

                    $conn->close();
                    ?>


                </tbody>
            </table>
        </div>
        <hr>

        <div class="container">
            <?php include('../templates/alert_msg.php') ?>
            <h4>Register Subject</h4>
            <form method="POST">
                <?php
                include '../database/DB.php';

                // $sql = "SELECT l.id AS lecturer_id, l.name AS lecturer_name 
                //         FROM SUBJECT S 
                //         JOIN workload wl ON s.id = wl.subject_id 
                //         JOIN lecturer l ON wl.lecturer_id = l.id 
                //         GROUP BY l.id, l.name;";
                    $sql = "SELECT s.name AS subject_name, s.id AS subject_id 
                    FROM subject s 
                    JOIN workload wl ON s.id = wl.subject_id 
                    JOIN lecturer l ON wl.lecturer_id = l.id
                    GROUP BY s.id, s.name";
                    $result = $conn->query($sql);
                ?>
                <!-- <select name="lecturer_name" id="lecturer_table" class="custom-select" style=" width:45%; text-transform: uppercase;"> -->
                <select name="subject_name" id="subject_table" class="custom-select" style=" width:45%; text-transform: uppercase;">
                    <option value="#">--SELECT SUBJECT--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { //Whileloop starts here
                    ?>
                            <option value="<?= $row['subject_id'] ?>"> <?= $row['subject_name'] ?></option>

                    <?php
                        } //End Whileloop
                    }
                    $conn->close();
                    ?>
                </select>
                <select id="lecturer_table" name="lecturer_table" class="custom-select" style="width:45%;">
                    <option value="">--SELECT LECTURER--</option>
                </select>

                <button name="add" class="btn btn-sm" title="Register Subject">
                    <i class="bi bi-plus-square" style="font-size: 28px;"></i></button>
                <hr>
            </form>
        </div>

        <?php
        //Register Subjects for students
        include "../database/DB.php";
        if (isset($_POST['add'])) {
            $lecturerId = $_POST['lecturer_name'];
            $subjectId = $_POST['subject_table'];
            $studentId = $userID;

            $sql = "INSERT INTO student_subject (subject_id, student_id, lecturer_id) VALUES ('$subjectId', '$studentId', '$lecturerId')";

            //
            if ($conn->query($sql) === true) {
                // Success
                $_SESSION['msg'] = "Subject added successfully!";
                $_SESSION['status'] = "Success";
            } else {
                // Failed
                $_SESSION['msg'] = "Error: " . $sql . " | " . $conn->error;
                $_SESSION['status'] = "Fail";
            }
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $conn->close();

        ?>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#subject_table').on("change", function() {
                var subjectID = $(this).val();
                if (subjectID) {
                    $.ajax({
                        url: "dependent.php",
                        type: "POST",
                        cache: false,
                        data: {
                            subjectID: subjectID
                        },
                        success: function(data) {
                            $("#lecturer_table").html(data);
                        }
                    });
                }
            })
        });
    </script>

    <?php include('../templates/footer.php'); ?>