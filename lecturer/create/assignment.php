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

        if(isset($_POST['uploadBtn'])){
            $statusMsg = '';

            //File upload path
            $targetDir = __DIR__ . '\assignment_files\\';
            $fileName = basename($_FILES['assignment']['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $title = $_POST['title'];

            if(isset($_POST['uploadBtn']) && !empty($_FILES['assignment']['name'])){
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'txt');
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES['assignment']['tmp_name'], $targetFilePath)){
                        $sql = "INSERT INTO assignment (subject_id, title, file_name, file, modiBy, modiOn) VALUES ('$code', '$title', '$fileName', '".$fileName."', '$user', NOW())";
                        $insert = $conn->query($sql);

                        if($insert){
                            $statusMsg = "The file " . $fileName . " has been uploaded succesfully.";            
                        }else
                            $statusMsg = "File failed to upload";
                    }else
                        $statusMsg = "There was error upload";
                }else
                    $statusMsg = "Sorry only pdf doc docx";
            }
        }

        $conn->close();

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

                    $sql = "SELECT title, file_name, modiBy, modiOn FROM assignment WHERE subject_id = '$code';";
                    $result = $conn->querY($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>

                            <tr>
                                <th><?= $num ?></th>
                                <td id="id <?= $num ?>" style="display:none"><?= $row['id']; ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['file_name'] ?></td>
                                <td style="text-align: center; font-size:12px;"><?= $row['modiBy'] ?></td>
                                <td style="text-align: center; font-size:12px;"><?= $row['modiOn'] ?></td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm" title="View Content">
                                        <i class="bi bi-file-earmark-text" style="font-size: 28px; color:blue;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;" title="View Submission">
                                    <button class="btn btn-sm" onclick="location.href = '../view/assignment.php?code=<?= $code ?>&name=<?= $name ?>&title=<?= $row['title'] ?>';">
                                        <i class="bi bi-file-earmark-check" style="font-size: 28px; color:forestgreen;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;" title="Delete">
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove('assignment, <?= $num ?>')">
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

<script src="../../js/script.js"></script>
<?php include('../../templates/footer.php'); ?>