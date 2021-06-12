<?php include('../../templates/header.php');

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$lecturerId = $_GET['lid'];
$userId = $_SESSION['userid'];

?>


<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>View Assignment / Tutorial / Lab</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <div class="table-responsive shadow rounded">
            <?php include('../../templates/alert_msg.php'); ?>
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th style="text-align: left;">Assignment/Tutorial/Lab</th>
                        <th style="text-align: center;">Your File</th>
                        <th style="text-align: center; width: 13%">Download Task</th>
                        <th style="text-align: center; width: 13%">Submission</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../../database/DB.php";

                    //Retrieving all available assignment from assignment table
                    $sql2 = "INSERT INTO assignment_student (assignment_id, student_id, lecturer_id, file_name, file, TYPE) 
                            (SELECT id, '$userId', '$lecturerId', '', '', '' FROM assignment WHERE subject_id = '$code') 
                            ON DUPLICATE KEY UPDATE assignment_id = assignment_id";

                    $conn->query($sql2);

                    //Retrieving assignments for display

                    $sql = "SELECT assgnStud.assignment_id AS assignment_id, assgn.title AS title, assgn.file_name AS lecturerFile, assgn.file_name AS file, assgn.type AS type, assgnStud.file_name AS studentFile 
                            FROM assignment_student assgnStud
                            JOIN assignment assgn ON assgnStud.assignment_id = assgn.id
                            JOIN student stud ON assgnStud.student_id = stud.id
                            WHERE assgn.subject_id = '$code' AND stud.id = '$userId'";

                    $result = $conn->query($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>
                            <tr>
                                <th><?= $num ?></th>
                                <td><?= $row['title'] ?></td>
                                <td style="text-align: center;"><?= $row['studentFile'] ?></td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm" title="Download Task" onclick="window.open('../../lecturer/create/assignment_files/<?= $row['file'] ?>')">
                                        <i class="bi bi-file-earmark-arrow-down" style="font-size: 28px; color:dimgray;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm" title="Submit Task" data-toggle="modal" data-target="#ModalSubmitForm">
                                        <i class="bi bi-file-earmark-arrow-up" style="font-size: 28px; color:darkgoldenrod;"></i>
                                    </button>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="ModalSubmitForm" tabindex="-1" aria-labelledby="ModalSubmitForm" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalSubmitFormTitle"><?= $row['title'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <h5>Upload submission here: </h5>
                                                    <p>Rename your file to answer, assignment name - student id </p>
                                                    <p>Example: Answer Lab 1 - AI160085</p>
                                                    <input type="hidden" name="assignment_id" value="<?= $row['assignment_id'] ?>">
                                                    <input type="file" name="assignment" id="file_upload" style="margin-top: 10px;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" name="uploadBtn">Upload file</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                    <?php }
                    } else
                        echo "0 results";

                    $conn->close();
                    ?>

                    <?php
                    include('../../database/DB.php');

                    //Student upload assignment
                    if (isset($_POST['uploadBtn'])) {
                        $assignmentId = $_POST['assignment_id'];
                        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/student_assignment/'; //Getting from root direcotry to student assignment folder
                        $fileName = basename($_FILES['assignment']['name']);
                        $targetFilePath = $targetDir . $fileName;
                        $filetmp = $_FILES['assignment']['tmp_name'];
                        $fileSize = $_FILES['assignment']['size'];
                        $fileType = strtolower(substr(strrchr($fileName, '.'), 1));

                        // Opening file for read
                        $fp = fopen($filetmp, 'r');
                        $content = fread($fp, filesize($filetmp));
                        $content = addslashes($content);
                        fclose($fp);

                        //Checking if button is pressed and file exits
                        if (isset($_POST['uploadBtn']) && !empty($_FILES['assignment']['name'])) {
                            $allowedTypes = array('pdf', 'doc', 'docx');
                            if (in_array($fileType, $allowedTypes)) {
                                if (move_uploaded_file($_FILES['assignment']['tmp_name'], $targetFilePath)) {
                                    $sql = "UPDATE assignment_student
                                            SET file_name = '$fileName', file = '$content', size = '$fileSize', type = '$fileType'
                                            WHERE assignment_id = '$assignmentId' AND student_id = '$userId'";

                                    $insert = $conn->query($sql);

                                    if ($insert) {
                                        $_SESSION['msg'] = "The file " . $fileName . " has been uploaded succesfully.";
                                        $_SESSION['status']  = "Success";
                                    } else {
                                        $_SESSION['msg'] = "File failed to upload";
                                        $_SESSION['status']  = "Fail";
                                    }
                                } else {
                                    $_SESSION['msg'] = "There was error upload";
                                    $_SESSION['status']  = "Fail";
                                }
                            } else {
                                $_SESSION['msg'] = "Sorry only pdf doc docx";
                                $_SESSION['status']  = "Fail";
                            }
                        }
                        
                        echo "<meta http-equiv='refresh' content='0'>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <?php include('../../templates/footer.php'); ?>