<?php include('../templates/header.php');

// User type verification
if ($_SESSION['usertable'] != 'lecturer')
    header("Location: /index.php");

$userID = $_SESSION['userid'];
$userName = $_SESSION['usersname'];
?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3>Welcome, <?= $_SESSION['usersname'] ?></h3>
        <hr>


        <?php
        include "../database/DB.php";

        $sql = "SELECT s.name AS subject_name, s.id AS subject_id FROM SUBJECT S JOIN workload wl ON s.id = wl.subject_id JOIN lecturer l ON wl.lecturer_id = l.id WHERE l.id = '$userID';";
        $result = $conn->query($sql);
        $num = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                ++$num;
        ?>

                <h5><?= $row['subject_id'] . " : " . $row['subject_name'] ?></h5>

                <div id="subjectCard" class="row row-cols-1 row-cols-md-3">
                    <div class="col mb-4">
                        <div class="card">
                            <img src="/img/task.svg" class="card-img-top pt-4" style="width: 50%; margin:auto">
                            <div class="card-body" style="text-align: center;">
                                <hr>
                                <h5 class="card-title">Assignment & Tutorial</h5>
                                <div class="row">
                                    <div class="col">
                                        <a type="button" class="btn btn-outline-dark btn-block" href="create/assignment.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>">
                                            Create / View
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
                                        <a type="button" class="btn btn-outline-dark btn-block" href="create/true-false-quiz.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>">
                                            Create / View
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a type="button" class="btn btn-outline-dark btn-block" href="view/true-false-result.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>">
                                            Check Result
                                        </a>
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
                                        <a type="button" class="btn btn-outline-dark btn-block" href="create/objective-quiz.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>">
                                            Create / View
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a type="button" class="btn btn-outline-dark btn-block" href="view/objective-result.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>">
                                            Check Result
                                        </a>
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
            echo "0 results";
        }
        $conn->close();
        ?>


    </div>

</div>

<?php include('../templates/footer.php'); ?>