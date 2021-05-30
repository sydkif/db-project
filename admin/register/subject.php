<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3><a id="back" class="bi bi-caret-left-fill" href="/admin/dashboard.php"></a>Register Subject</h3>
            <hr>
            <?php include('../../templates/alert_msg.php') ?>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">Subject ID</th>
                        <th style="width: auto;">Subject Name</th>
                        <th style="width: 20%;">Modified By</th>
                        <th style="width: 20%;">Modified On</th>
                        <th style="width: 11%;">Update</th>
                        <th style="width: 5%;">Delete</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    //connecting to database
                    include "../../DB.php";

                    //getting data from db
                    $sql = "SELECT * FROM subject";
                    $result = $conn->query($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        //outputting data in table
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>
                            <tr>
                                <td id="id<?= $num ?>" style="text-transform: uppercase;"><b><?= $row['id']; ?> <b></td>
                                <td id="name<?= $num ?>" contentEditable="false" style="text-transform: uppercase;"><?= $row['name']; ?></td>
                                <td id="modi"><?= $row['modiBy'] ?></td>
                                <td id="modi"><?= date('d-m-Y H:i:s', strtotime($row['modiOn'])); ?></td>
                                <td>
                                    <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm updateBtn">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                    <button id="save<?= $num ?>" onclick="update('subject',<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-save2" style="color: blue;"></i>
                                    </button>
                                    <button id="cancel<?= $num ?>" onclick="cancel(<?= $num ?>)" class="btn btn-sm cancelBtn">
                                        <i class="bi bi-x-square" style="color: gray;"></i>
                                    </button>
                                </td>
                                <td>
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove('subject',<?= $num ?>)">
                                        <i class="bi bi-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else
                        echo "0 Result";

                    $conn->close();
                    ?>

                    <tr>
                        <form method="POST">
                            <td><input style="width: 85px;" name="id" value="" type="text" required></td>
                            <td><input style="width: 330px;" name="name" value="" type="text" required></td>
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

                    //Adding data to database
                    if (isset($_POST['add'])) {
                        $id = $_POST['id'];
                        $name = strtoupper($_POST['name']);
                        $modiBy = "Super admin";
                        $modiOn = date("Y-m-d H:i:s");
                        $sql = "INSERT INTO subject (id, name, modiBy, modiOn) VALUES ('$id', '$name', '$modiBy', '$modiOn')";

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

<?php include('../../templates/footer.php') ?>