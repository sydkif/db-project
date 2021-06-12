<?php include('../../templates/header.php');

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$user = $_SESSION['usersname'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/lecturer/dashboard.php"></a>Create Assignment / Tutorial / Lab</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <form method="POST" enctype="multipart/form-data">
            <h5>Task Title : <input type="text" name="title" id="file">
                <input type="file" name="assignment" id="file=upload" style="width:260px;">
                <button class="btn btn-sm" name="uploadBtn"><i class="bi bi-upload" style="font-size: 28px;"></i></button>
        </form>
        </h5>

        <?php
        include('../../database/DB.php');

        //Uploading file to database
        if (isset($_POST['uploadBtn'])) {
            $statusMsg = '';

            // File upload path
            $targetDir = __DIR__ . '\assignment_files\\';
            $fileName = basename($_FILES['assignment']['name']);
            $fileName = addslashes($fileName); // To ensure names with special characters are accepted
            $targetFilePath = $targetDir . $fileName;
            $filetmp = $_FILES['assignment']['tmp_name'];
            $fileSize = $_FILES['assignment']['size'];

            // Opening file for read
            $fp = fopen($filetmp, 'r');
            $content = fread ($fp, filesize($filetmp));
            $content = addslashes($content);
            fclose($fp);        
            // Getting file type
            $fileType = substr(strrchr($fileName, '.'), 1);
            $fileType = strtolower($fileType);

            // Title from task title
            $title = $_POST['title'];

            //Checking if button is pressed and file exists
            if (isset($_POST['uploadBtn']) && !empty($_FILES['assignment']['name'])) {
                // List of all allowed file type
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'txt');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['assignment']['tmp_name'], $targetFilePath)) {
                        $sql = "INSERT INTO assignment (subject_id, title, file_name, file, size, type, modiBy, modiOn) 
                                VALUES ('$code', '$title', '$fileName', '$content', '$fileSize', '$fileType', '$user', NOW())";

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
        }

        $conn->close();
        //Alert message display
        include('../../templates/alert_msg.php');
        ?>

        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: left;">Title</th>
                        <th style="text-align: left;">Filename</th>
                        <th style="text-align: center; width: 13%">Modified By</th>
                        <th style="text-align: center; width: 13%">Modified On</th>
                        <th style="text-align: center;">Content</th>
                        <th style="text-align: center;">Submission</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //Displaying data in table
                    include('../../database/DB.php');

                    $sql = "SELECT id, title, file_name, modiBy, modiOn, file FROM assignment WHERE subject_id = '$code';";
                    $result = $conn->querY($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>

                            <tr>
                                <th><?= $num ?></th>
                                <td id="id" style="display:none"><?= $row['id']; ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['file_name'] ?></td>
                                <td style="text-align: center; font-size:12px;"><?= $row['modiBy'] ?></td>
                                <td style="text-align: center; font-size:12px;"><?= $row['modiOn'] ?></td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm" title="View Content" onclick="window.open('assignment_files/<?= $row['file_name'] ?>')">
                                        <i class="bi bi-file-earmark-text" style="font-size: 28px; color:blue;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;" title="View Submission">
                                    <button class="btn btn-sm" onclick="location.href = '../view/assignment.php?code=<?= $code ?>&name=<?= $name ?>&id=<?= $row['id'] ?>';">
                                        <i class="bi bi-file-earmark-check" style="font-size: 28px; color:forestgreen;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;" title="Delete">
                                    <button id="delete" name="delete" class="btn btn-sm" del_id="<?= $row['id'] ?>">
                                        <i class="bi bi-trash" style="font-size: 28px; color:red;"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else
                        echo "0 Results";

                    $conn->close();


                    ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    //Deleting function
    $(document).on('click', '#delete', function() {
        var msg = "Are you sure want to delete this task?";
        var conf = confirm(msg);
        if (conf) {
            var del_id = $(this).attr('del_id');
            var $ele = $(this).parent().parent();
            $.ajax({
                type: "POST",
                url: "../../database/delete.php",
                data: {
                    del_id: del_id
                },
                success: function(data) {
                    $ele.fadeOut().remove();
                }
            });
            location.reload();
        }
    });
</script>
<?php include('../../templates/footer.php'); ?>