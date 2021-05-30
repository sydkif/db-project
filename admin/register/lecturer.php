<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3><a id="back" class="bi bi-caret-left-fill" href="/admin/dashboard.php"></a>Register Lecturer</h3>
            <hr>
            <?php include('../../templates/alert_msg.php') ?>
        </div>

        <div class="table-responsive shadow rounded">
            <table id="table" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">Lecturer ID</th>
                        <th style="width: auto;">Lecturer Name</th>
                        <th style="width: 20%;">Modified By</th>
                        <th style="width: 20%;">Modified On</th>
                        <th style="width: 11%;">Update</th>
                        <th style="width: 8%;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../../DB.php";

                    $sql = "SELECT * FROM lecturer";
                    $result = $conn->query($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;

                    ?>

                            <tr>
                                <td id="id<?= $num ?>"><b><?= $row["id"] ?><b></td>
                                <td contentEditable=" false" id="name<?= $num ?>" style="text-transform: uppercase;"><?= $row["name"] ?></td>
                                <td id="modi"><?= $row["modiBy"] ?></td>
                                <td id="modi"><?= date('d-m-Y H:i:s', strtotime($row['modiOn'])); ?></td>
                                <td>
                                    <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                    <button id="save<?= $num ?>" onclick="update('lecturer',<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-save2" style="color: blue;"></i>
                                    </button>
                                    <button id="cancel<?= $num ?>" onclick="cancel(<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-x-square" style="color: gray;"></i>
                                    </button>
                                </td>
                                <td>
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove('lecturer',<?= $num ?>)">
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


                    <tr>
                        <form method="post">
                            <td><input style="width: 60px;" name="id" value="" type="text" minlength="4" maxlength="4" pattern="\d*" required></td>
                            <td><input style="width: 360px;" name="name" value="" type="text" required></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button name="add" class="btn btn-sm" href="#?">
                                    <i class="bi bi-plus-square" style="color: green;"></i>
                                </button>
                            </td>
                        </form>
                    </tr>

                    <?php

                    include "../../DB.php";
                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    if (isset($_POST['add'])) {
                        $id = $_POST['id'];
                        $name = strtoupper($_POST['name']);
                        $modiBy = "Super Admin"; // TODO Change to session_id later on
                        $modiOn = date("Y-m-d h:i:s");
                        $sql = "INSERT INTO lecturer (id, name, modiBy, modiOn) VALUES ('$id', '$name', '$modiBy', '$modiOn')";

                        if ($conn->query($sql) === true) {
                            // Success
                            $_SESSION['msg'] = "Record added successfully!";
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

                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include '../../templates/footer.php' ?>