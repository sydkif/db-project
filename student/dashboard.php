<?php include('../templates/header.php');

// User type verification
if ($_SESSION['usertable'] != 'student')
    header("Location: /index.php");

$userName = ucfirst($_SESSION['usersname']);
$userID = strtoupper($_SESSION['userid']);


?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3>Welcome, <?= ucwords(strtolower($_SESSION['usersname'])); ?> !</h3>
        <hr>


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
                $subjectID = $row['subject_id'];
                $tf_pass = mysqli_num_rows($conn->query("SELECT question FROM tf_quiz WHERE subject_id = '$subjectID'"));
                $mc_pass = mysqli_num_rows($conn->query("SELECT question FROM mc_quiz WHERE subject_id = '$subjectID'"));
                ++$num;

        ?>

                <h5><?= $row['subject_id'] . " : " . $row['subject_name'] . " - " . ucwords(strtolower($row['lecturer_name']))  ?></h5>

                <div id="subjectCard" class="row row-cols-1 row-cols-md-3">
                    <div class="col mb-4">
                        <div class="card">
                            <img src="/img/task.svg" class="card-img-top pt-4" style="width: 50%; margin:auto">
                            <div class="card-body" style="text-align: center;">
                                <hr>
                                <h5 class="card-title">Assignment & Tutorial</h5>
                                <div class="row">
                                    <div class="col">
                                        <a type="button" class="btn btn-outline-dark btn-block" href="view/assignment.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>&lid=<?= $row['lecturer_id'] ?>">
                                            Submit / View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card">
                            <img src="/img/true-false.svg" class="card-img-top pt-4" style="width: 50%; margin:auto">
                            <div class="card-body" style="text-align: center;">
                                <hr>
                                <h5 class="card-title">True / False Quiz</h5>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-outline-dark btn-block" title="View True False Quiz" onclick="location.href = 'view/true-false-quiz.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';" <?php if ($row['tf_marks'] > 0) echo 'disabled'  ?>>
                                            View
                                        </button>
                                    </div>
                                    <div class="col">
                                        <div class="btn btn-<?php echo ($row['tf_marks'] >= $tf_pass) ? 'success' : 'danger' ?> btn-block">

                                            <?php
                                            if ($row['tf_marks'] == NULL) echo 'N/A';
                                            elseif ($row['tf_marks'] < 0) echo '0';
                                            else echo $row['tf_marks'];
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card">
                            <img src="/img/objective.svg" class="card-img-top pt-4" style="width: 50%; margin:auto">
                            <div class="card-body" style="text-align: center;">
                                <hr>
                                <h5 class="card-title"> Objective Quiz</h5>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-outline-dark btn-block" title="View Objective Quiz" onclick="location.href = 'view/objective-quiz.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';" <?php if ($row['mc_marks'] > 0) echo 'disabled'  ?>>
                                            View
                                        </button>
                                    </div>
                                    <div class="col">
                                        <div type="button" class="btn btn-<?php echo ($row['mc_marks']  >= $mc_pass) ? 'success' : 'danger' ?> btn-block">

                                            <?php
                                            if ($row['mc_marks'] == NULL) echo 'N/A';
                                            elseif ($row['mc_marks'] < 0) echo '0';
                                            else echo $row['mc_marks'];
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

        <?php
            }
        } else {
            echo "No results found";
        }

        $conn->close();
        ?>

    </div>
    <hr>

    <div class="container">
        <?php include('../templates/alert_msg.php') ?>
        <h4>Register Subject</h4>
        <form method="POST">
            <?php
            include '../database/DB.php';

            $sql = "SELECT s.name AS subject_name, s.id AS subject_id 
                    FROM subject s 
                    JOIN workload wl ON s.id = wl.subject_id 
                    JOIN lecturer l ON wl.lecturer_id = l.id
                    GROUP BY s.id, s.name";
            $result = $conn->query($sql);
            ?>

            <select name="subject_id" id="subject_table" class="custom-select" style=" width:45%; text-transform: uppercase;">
                <option value="#">--SELECT SUBJECT--</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { //Whileloop starts here
                ?>
                        <option value="<?= $row['subject_id'] ?>"> <?= $row['subject_id'] . " : " . $row['subject_name'] ?></option>

                <?php
                    } //End Whileloop
                }
                $conn->close();
                ?>
            </select>
            <select id="lecturer_table" name="lecturer_id" class="custom-select" style="width:45%;">
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
        $lecturerId = $_POST['lecturer_id'];
        $subjectId = $_POST['subject_id'];
        $studentId = $userID;


        $sql = "INSERT INTO student_subject (subject_id, student_id, lecturer_id) VALUES ('$subjectId', '$studentId', '$lecturerId')";

        //
        if ($conn->query($sql) === true) {
            // Success
            $_SESSION['msg'] = "Subject added successfully!";
            $_SESSION['status'] = "Success";
        } else {
            // Failed
            if ($conn->errno == '1062')
                $_SESSION['msg'] = "Subject ID (" . $subjectId . ") already registered.";
            else
                $_SESSION['msg'] = $sql . "<br>" . $conn->error . "<br>" . $conn->errno;
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