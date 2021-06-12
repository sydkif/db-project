<?php include("../../templates/header.php");

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$userId = $_SESSION['userid'];

?>

<link rel="stylesheet" href="/css/quiz.css">

<div class="container mt-5 align-items-center">
    <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>Quiz (True / False)</h3>
    <hr>
    <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
    <div class="col">

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

                <div class="row">
                    <div class="card w-100 shadow-sm">
                        <div class="card-body">
                            <p>Question <?= $num ?></p>
                            <h5><?= $row['question'] ?></h5>
                            <hr>
                            <form id="answer">
                                <input id="true<?= $num ?>" name="answer_q<?= $num ?>" value="1" type="radio" />
                                <label for="true<?= $num ?>">True</label>
                                <br>
                                <input id="false<?= $num ?>" name="answer_q<?= $num ?>" value="0" type="radio" />
                                <label for="false<?= $num ?>">False</label>
                            </form>
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
            <input id="submitButton" class="btn btn-primary btn-lg btn-block" type="submit" value="Finish Quiz" style="border-radius: 10px;">
        </div>
    </div>
</div>

<script>
    document.getElementById("submitButton").onclick = function() {
        location.href = "/student/dashboard.php";
    };
</script>

<?php include('../../templates/footer.php'); ?>