<?php include("../../templates/header.php");

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$userId = $_SESSION['userid'];

?>

<link rel="stylesheet" href="/css/quiz.css">

<div class="container mt-5 align-items-center">
    <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>Quiz (Multiple Choice)</h3>
    <hr>
    <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
    <div class="col">
        <form method="POST">
            <?php

            //Displaying data in table
            include('../../database/DB.php');

            $sql = "SELECT question, option_a, option_b, option_c, option_d FROM mc_quiz WHERE subject_id = '$code'";
            $result = $conn->querY($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $num++;

            ?>

                    <div class="row">
                        <div class="card w-100 shadow-sm">
                            <div class="card-body">
                                <p>Question <?= $num ?></p>
                                <h5><?= $row['question'] ?></h5>
                                <hr>
                                <!-- <form id="answer"> -->
                                <input id="option_a<?= $num ?>" name="answer_q<?= $num ?>" value="A" type="radio" required />
                                <label for="option_a<?= $num ?>"><?= $row['option_a'] ?></label>
                                <br>
                                <input id="option_b<?= $num ?>" name="answer_q<?= $num ?>" value="B" type="radio" />
                                <label for="option_b<?= $num ?>"><?= $row['option_b'] ?></label>
                                <br>
                                <input id="option_c<?= $num ?>" name="answer_q<?= $num ?>" value="C" type="radio" />
                                <label for="option_c<?= $num ?>"><?= $row['option_c'] ?></label>
                                <br>
                                <input id="option_d<?= $num ?>" name="answer_q<?= $num ?>" value="D" type="radio" />
                                <label for="option_d<?= $num ?>"><?= $row['option_d'] ?></label>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>

            <?php

                }
            } else {
                echo "0 results";
            }
            $conn->close();

            ?>



            <div class="row" style="margin-top: 20px;">
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Finish Quiz" style="border-radius: 10px;">
            </div>
        </form>
    </div>


    <?php include("../../templates/footer.php") ?>