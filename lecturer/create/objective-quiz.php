<?php include('../../templates/header.php');

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$user = $_SESSION['usersname'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/lecturer/dashboard.php"></a>Create Objective Quiz</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <?php include('../../templates/alert_msg.php') ?>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: left; vertical-align: middle; width:30%;">Question</th>
                        <th colspan="4" style="text-align: center; ">Answer</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle; width:13%;">Modified By</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle; width:13%;">Modified On</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Update</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Delete</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">A</th>
                        <th style="text-align: center;">B</th>
                        <th style="text-align: center;">C</th>
                        <th style="text-align: center;">D</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    //Displaying data in table
                    include('../../database/DB.php');

                    $sql = "SELECT * FROM mc_quiz WHERE subject_id = '$code'";
                    $result = $conn->querY($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $num++;

                    ?>
                            <tr>
                                <th scope="row" style="text-align: center;"><?= $num ?></th>
                                <td id="question<?= $num ?>" style="text-align: left;"><?= $row['question'] ?></td>
                                <td style="text-align: center;"><span class="btn-block text-wrap badge badge-<?php echo ($row['answer'] == 'A') ? 'success' :  ''; ?>"><?= $row['option_a'] ?></span></td>
                                <td style="text-align: center;"><span class="btn-block text-wrap badge badge-<?php echo ($row['answer'] == 'B') ? 'success' :  ''; ?>"><?= $row['option_b'] ?></span></td>
                                <td style="text-align: center;"><span class="btn-block text-wrap badge badge-<?php echo ($row['answer'] == 'C') ? 'success' :  ''; ?>"><?= $row['option_c'] ?></span></td>
                                <td style="text-align: center;"><span class="btn-block text-wrap badge badge-<?php echo ($row['answer'] == 'D') ? 'success' :  ''; ?>"><?= $row['option_d'] ?></span></td>
                                <td style="text-align: center; font-size:12px;"><?= $row['modiBy'] ?></td>
                                <td style="text-align: center; font-size:12px;"><?= $row['modiOn'] ?></td>
                                <td style="text-align: center;">
                                    <button id="update<?= $num ?>" class="btn btn-sm" data-toggle="modal" data-target="#staticBackdrop<?= $num ?>">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                    <div style="text-align: left;">
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop<?= $num ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST">
                                                        <div class="modal-header">

                                                            <h5 class="modal-title" id="staticBackdropLabel">Add Question</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label class="col-form-label"><b>Question</b></label>
                                                                <textarea class="form-control" id="question" name="question" required><?= $row['question'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">

                                                                <label class="col-form-label"><b>Answer</b></label>
                                                                <br>
                                                                <div class="input-group mt-1">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="mr-2">A</span>
                                                                            <input type="radio" name="answer" value="A" <?php if ($row['answer'] == 'A') echo "checked" ?> required>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="option_a" value="<?= $row['option_a'] ?>" required>
                                                                </div>

                                                                <div class="input-group mt-1">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="mr-2">B</span>
                                                                            <input type="radio" name="answer" value="B" <?php if ($row['answer'] == 'B') echo "checked" ?> required>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="option_b" value="<?= $row['option_b'] ?>" required>
                                                                </div>

                                                                <div class="input-group mt-1">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="mr-2">C</span>
                                                                            <input type="radio" name="answer" value="C" <?php if ($row['answer'] == 'C') echo "checked" ?> required>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="option_c" value="<?= $row['option_c'] ?>" required>
                                                                </div>

                                                                <div class="input-group mt-1">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="mr-2">D</span>
                                                                            <input type="radio" name="answer" value="D" <?php if ($row['answer'] == 'D') echo "checked" ?> required>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="option_d" value="<?= $row['option_d'] ?>" required>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td style="text-align: center;">
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove_question('mc_quiz',<?= $num . ',' . $row['id'] ?>)">
                                        <i class="bi bi-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>

                    <?php

                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();

                    ?>

                </tbody>
            </table>
        </div>

        <br>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Add Question
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">

                            <h5 class="modal-title" id="staticBackdropLabel">Add Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label class="col-form-label"><b>Question</b></label>
                                <textarea class="form-control" id="question" name="question" required></textarea>
                            </div>
                            <div class="form-group">

                                <label class="col-form-label"><b>Answer</b></label>
                                <br>
                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="mr-2">A</span>
                                            <input type="radio" name="answer" value="A" required>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="option_a" required>
                                </div>

                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="mr-2">B</span>
                                            <input type="radio" name="answer" value="B" required>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="option_b" required>
                                </div>

                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="mr-2">C</span>
                                            <input type="radio" name="answer" value="C" required>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="option_c" required>
                                </div>

                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="mr-2">D</span>
                                            <input type="radio" name="answer" value="D" required>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="option_d" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php

        include "../../database/DB.php";
        date_default_timezone_set("Asia/Kuala_Lumpur");

        if (isset($_POST['add'])) {

            $question = $_POST['question'];
            $option_a =  $_POST['option_a'];
            $option_b =  $_POST['option_b'];
            $option_c =  $_POST['option_c'];
            $option_d =  $_POST['option_d'];
            $answer = $_POST['answer'];
            $modiOn = date("Y-m-d h:i:s");

            $sql = "INSERT INTO mc_quiz (subject_id, question, option_a, option_b, option_c, option_d, answer, modiBy, modiOn) 
                    VALUES ('$code', '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$answer', '$user','$modiOn')";

            if ($conn->query($sql) === true) {
                // Success
                $_SESSION['msg'] = "Question added successfully!";
                $_SESSION['status'] = "Success";
            } else {
                // Failed
                $_SESSION['msg'] = "Error: " . $sql . " | " . $conn->error;
                $_SESSION['status'] = "Fail";
            }
            echo "<meta http-equiv='refresh' content='0'>";
        }


        if (isset($_POST['update'])) {

            $id = $_POST['id'];
            $question = $_POST['question'];
            $option_a =  $_POST['option_a'];
            $option_b =  $_POST['option_b'];
            $option_c =  $_POST['option_c'];
            $option_d =  $_POST['option_d'];
            $answer = $_POST['answer'];
            $modiOn = date("Y-m-d h:i:s");

            $sql = "UPDATE mc_quiz 
                    SET question = '$question', 
                        answer = '$answer', 
                        option_a = '$option_a', 
                        option_b = '$option_b', 
                        option_c = '$option_c', 
                        option_d = '$option_d', 
                        modiBy = '$user', 
                        modiOn = '$modiOn' 
                    WHERE id = '$id'";

            if ($conn->query($sql) === true) {
                // Success
                $_SESSION['msg'] = "Question updated successfully!";
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

    <?php include('../../templates/footer.php'); ?>

    <script>
        function remove_question(table, n, id) {
            var question = document.getElementById("question" + n).innerText;
            var url = ("delete-question.php?table=" + table + "&id=" + id);
            var msg = "Are you sure want to delete this question?\n\n ID :\n" + id + "\n\n Question :\n" + question;
            var conf = confirm(msg);
            if (conf)
                window.location = "" + url;
        }
    </script>