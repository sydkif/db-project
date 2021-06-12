<?php include('../../templates/header.php');

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$user = $_SESSION['usersname'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/lecturer/dashboard.php"></a>Create True/False Quiz</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <?php include('../../templates/alert_msg.php') ?>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: left; width:auto;">Question</th>
                        <th style="text-align: center;">Answer</th>
                        <th style="text-align: center; width: 13%">Modified By</th>
                        <th style="text-align: center; width: 13%">Modified On</th>
                        <th style="text-align: center;">Update</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    //Displaying data in table
                    include('../../database/DB.php');

                    $sql = "SELECT id, question, answer, modiBy, modiOn FROM tf_quiz WHERE subject_id = '$code'";
                    $result = $conn->querY($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $num++;

                    ?>
                            <tr>
                                <th scope="row" style="text-align: center;"><?= $num ?></th>
                                <td id="question<?= $num ?>" style="text-align: left;"><?= $row['question'] ?></td>
                                <td style="text-align: center;"><span class="text-wrap btn-block badge badge-<?php echo ($row['answer']) ? 'success' : 'danger' ?>"><?php echo ($row['answer']) ? 'True' : 'False' ?></span></td>
                                <td id="modi" style="text-align: center; font-size:12px;"><?= $row['modiBy'] ?></td>
                                <td id="modi" style="text-align: center; font-size:12px;"><?= $row['modiOn'] ?></td>
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

                                                            <h5 class="modal-title" id="staticBackdropLabel">Update Question</h5>
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
                                                                <input type="radio" name="answer" value="1" <?php if ($row['answer'] == 1) echo "checked" ?> required>
                                                                <label>True</label>
                                                                <br>
                                                                <input type="radio" name="answer" value="0" <?php if ($row['answer'] == 0) echo "checked" ?> required>
                                                                <label>False</label>
                                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
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
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove_question('tf_quiz',<?= $num . ',' . $row['id'] ?>)">
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
                                <input type="radio" name="answer" value="1" required>
                                <label>True</label>
                                <br>
                                <input type="radio" name="answer" value="0" required>
                                <label>False</label>

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
            $answer = $_POST['answer'];
            $modiOn = date("Y-m-d h:i:s");

            $sql = "INSERT INTO tf_quiz (subject_id, question, answer, modiBy, modiOn) VALUES ('$code', '$question', '$answer', '$user','$modiOn')";

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
            $answer = $_POST['answer'];
            $modiOn = date("Y-m-d h:i:s");

            $sql = "UPDATE tf_quiz SET question = '$question', answer = '$answer', modiBy = '$user', modiOn = '$modiOn' WHERE id = '$id'";

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