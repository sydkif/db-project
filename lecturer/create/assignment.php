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

        

        //Uploading file function
        if (isset($_POST['uploadBtn'])) {
            if (isset($_FILES['assignment'])) {

                //receiving details of the uploaded files
                $title = $_POST['title'];                
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $modiOn = date('Y-m-d H:i:s');
                $data = $_FILES['assignment']['tmp_name'];
                $fileName = $_FILES['assignment']['name'];
                $fileType = $_FILES['assignment']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                $allowedFileExtensions = array('doc', 'xls', 'txt', 'jpg', 'png', 'pdf', 'docx');
                $otherFileExtension = array('doc', 'docx', 'pdf', 'png', 'txt');

                if (in_array($fileExtension, $allowedFileExtensions)) {

                    //Directory of uploaded file
                    $uploadFileDir = __DIR__ . '\assignment_files\\';
                    $dest_path = $uploadFileDir . $fileName;
                    if(in_array($fileExtension, $otherFileExtension)){
                        if($doc_blob = fopen($data, "rb")){
                            try {
                                $dbh = new PDO("mysql:host=localhost;dbname=dbprojekt", "root", "");
                                // set the PDO error mode to exception
                                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                echo "Connected successfully";
                              } catch(PDOException $e) {
                                echo "Connection failed: " . $e->getMessage();
                              }
                            $sql = "INSERT INTO assignment (subject_id, title, file_name, file, modiBy, modiOn) VALUES (':code', ':title', ':fileName', ':doc_blob', ':user', ':modiOn')";
                            $stmt = $dbh->prepare($sql);
                            $stmt->bindParam(':code', $code);
                            $stmt->bindParam(':title', $title);
                            $stmt->bindParam(':fileName', $fileName);
                            $stmt->bindParam(':doc_blob', $doc_blob);
                            $stmt->bindParam(':user', $user);                                                        
                            $stmt->bindParam(':modiOn', $modiOn);
                            

                            if ($stmt->execute() === FALSE) {
                                echo 'Could not save information to the database';
                            } else {
                                echo 'Information saved';
                            }
                        }else{
                            echo 'Could not open the attached pdf file';
                        }
                    }else{                    
                        $sql = "INSERT INTO assignment (subject_id, title, file_name, file, modiBy, modiOn) VALUES ('$code', '$title', '$fileName', '$data', '$user', '$modiOn')";
                    }

                    if ($conn->query($sql) === true) {
                        // Success
                        $_SESSION['msg'] = "Record added successfully!";
                        $_SESSION['status'] = "Success";
                    } else {
                        $_SESSION['msg'] = "Error: " . $sql . " | " . $conn->error;
                        $_SESSION['status'] = "Fail";
                    }
                } else
                    $message = 'Error: File Extension is not allowed';
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