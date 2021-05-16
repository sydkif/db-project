<?php include("../templates/header.php") ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Assign Workload Lecturer</h3>
            <hr>
        </div>

        <div class="table-responsive shadow rounded">
            <table id="table" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: auto;">Lecturer</th>
                        <th style="width: auto;">Subject</th>
                        <th style="width: 11%;">Update</th>
                        <th style="width: 8%;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../DB.php";

                    $sql = "SELECT lecturer_id, subject_id FROM workload ORDER BY lecturer_id";

                    $result = $conn->query($sql);
                    $num = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                            // $lecturer_name = $row['lecturer_id'];

                            $sql2 = "SELECT name FROM lecturer WHERE id = " . $row['lecturer_id'];
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();

                            $subject_name = $row['subject_id'];
                            $sql3 = "SELECT name FROM subject WHERE id = '" . $row['subject_id'] . "'";
                            $result3 = $conn->query($sql3);
                            $row3 = $result3->fetch_assoc();
                    ?>

                            <tr>
                                <form method="post">
                                    <th><?= $num ?></th>
                                    <td style="text-transform: uppercase;"><?= $row2['name'] ?>
                                        <input type="hidden" name="lecturerId" value="<?= $row['lecturer_id'] ?>">
                                    </td>
                                    <td style="text-transform: uppercase;"><?= $row3['name'] ?>
                                        <input type="hidden" name="subjectId" value="<?= $row['subject_id'] ?>">
                                    </td>
                                    <td>
                                        <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm">
                                            <i class="bi bi-pencil-square" style="color: blue;"></i>
                                        </button>
                                        <button id="save<?= $num ?>" onclick="update(<?= $num ?>)" class="btn btn-sm">
                                            <i class="bi bi-save2" style="color: blue;"></i>
                                        </button>
                                        <button id="cancel<?= $num ?>" onclick="cancel(<?= $num ?>)" class="btn btn-sm">
                                            <i class="bi bi-x-square" style="color: gray;"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button name="delete" id="delete<?= $num ?>" class="btn btn-sm" onclick="return confirm('Are you sure?');">
                                            <i class="bi bi-trash" style="color: red;"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>


                    <tr>
                        <form method="post">
                            <th></th>
                            <td>
                                <select name="lecturer_id" class="custom-select">
                                    <option selected>Please Choose</option>

                                    <?php
                                    include "../DB.php";

                                    $sql = "SELECT id, name FROM lecturer";
                                    $result = $conn->query($sql);
                                    $num = 0;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ++$num;
                                    ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>

                                </select>
                            </td>
                            <td>
                                <select name="subject_id" class="custom-select">
                                    <option selected>Please Choose</option>

                                    <?php
                                    include "../DB.php";

                                    $sql = "SELECT id, name FROM subject";
                                    $result = $conn->query($sql);
                                    $num = 0;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ++$num;
                                    ?>
                                            <option value="<?= $row['id']  ?>"><?= $row['name'] ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>

                                </select>
                            </td>
                            <td></td>
                            <td>
                                <button name="add" class="btn btn-sm" href="#?">
                                    <i class="bi bi-plus-square" style="color: green;"></i>
                                </button>
                            </td>
                        </form>
                    </tr>

                    <?php

                    include "../DB.php";
                    if (isset($_POST['add'])) {

                        $lecturer = $_POST['lecturer_id'];
                        $subject = $_POST['subject_id'];
                        $sql = "INSERT INTO workload (lecturer_id, subject_id) VALUES ('$lecturer', '$subject')";

                        if ($conn->query($sql) === true) {
                            // Success
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else {
                            // Failed
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    if (isset($_POST['delete'])) {

                        $lecturer = $_POST['lecturerId'];
                        $subject =  $_POST['subjectId'];

                        $sql = "DELETE FROM workload WHERE lecturer_id = $lecturer AND subject_id= '" . $subject . "'";

                        if ($conn->query($sql) === true) {
                            // Success
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else {
                            // Failed
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $conn->close();

                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        var table = document.getElementById("table");
        var rows = table.getElementsByTagName("tr");
        for (var x = 1; x <= rows.length; x++) {
            document.getElementById("save" + x).hidden = true;
            document.getElementById("cancel" + x).hidden = true;
        }
    };
</script>

<?php include("../templates/footer.php") ?>