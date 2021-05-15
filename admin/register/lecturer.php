<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Register Lecturer</h3>
            <hr>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">Lecturer ID</th>
                        <th style="width: auto;">Lecturer Name</th>
                        <th style="width: 20%;">Modified By</th>
                        <th style="width: 20%;">Modified On</th>
                        <th style="width: 5%;">Update</th>
                        <th style="width: 5%;">Delete</th>
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
                                <td id="id<?php echo $num ?>"><b><?php echo $row["id"] ?><b></td>
                                <td contentEditable=" false" id="name<?php echo $num ?>" style="text-transform: uppercase;"><?php echo $row["name"] ?></td>
                                <td><?php echo $row["modiBy"] ?></td>
                                <td><?php echo $row["modiOn"]  ?></td>
                                <td>
                                    <button id="update<?php echo $num ?>" onclick="edit(<?php echo $num ?>)" class="btn btn-sm updateBtn">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                </td>
                                <td>
                                    <button id="delete<?php echo $num ?>" class="btn btn-sm" onclick="remove(<?php echo $num ?>)">
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
                        <form action="" method="post">
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

                    if (isset($_POST['add'])) {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $sql = "INSERT INTO lecturer (id, name) VALUES ('$id', '$name')";

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

<?php include '../../templates/footer.php' ?>