<?php include("../../templates/header.php");

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$userId = strtoupper($_SESSION['userid']);

?>

<link rel="stylesheet" href="/css/quiz.css">

<div class="container mt-5 align-items-center">
    <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>Quiz (True / False)</h3>
    <hr>
    <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
    <div class="col">
        <form action="../validate_quiz.php" method="post">
            <?php

            //Displaying data in table
            include('../../database/DB.php');

            $sql = "SELECT question FROM tf_quiz WHERE subject_id = '$code'";
            $result = $conn->querY($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $num++;
            ?>
                    <div id="subjectCard" class="row mb-3">
                        <div class="card w-100 shadow-sm">
                            <div class="card-body">
                                <p>Question <?= $num ?></p>
                                <h5><?= $row['question'] ?></h5>
                                <hr>
                                <input id="true<?= $num ?>" name="answer_q<?= $num ?>" value="1" type="radio" required />
                                <label for="true<?= $num ?>">True</label>
                                <br>
                                <input id="false<?= $num ?>" name="answer_q<?= $num ?>" value="0" type="radio" required />
                                <label for="false<?= $num ?>">False</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_questions" value="<?= $num ?>">
            <?php

                }
            } else {
                echo "<br>";
                $_SESSION['msg'] = "Quiz is not available yet.";
                $_SESSION['status'] = "Fail";
                include('../../templates/alert_msg.php');
                include('../../templates/footer.php');
                die();
            }

            // To redirect user if he/she already answered
            $marks = $conn->query("SELECT tf_marks FROM student_subject WHERE (subject_id = '$code' && student_id = '$userId')")->fetch_object()->tf_marks;
            if ($marks > 0) {
                echo '<script> alert("Oi, you already answer la, go back."); window.location = "/index.php";</script>';
            }

            $conn->close();

            ?>

            <div class="row" style="margin-top: 20px;">
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Finish Quiz" style="border-radius: 10px;">
            </div>
            <input type="hidden" name="quiz" value="tf_quiz">
            <input type="hidden" name="marks" value="tf_marks">
            <input type="hidden" name="subject_code" value="<?= $code ?>">
            <input type="hidden" name="student_id" value="<?= $userId ?>">
            <input type="hidden" name="total_questions" value="<?= $num ?>">
        </form>
    </div>
</div>

<?php include('../../templates/footer.php'); ?>