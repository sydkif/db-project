<?php include("../templates/header.php") ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Assign Workload Lecturer</h3>
            <hr>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: auto;">Lecturer</th>
                        <th style="width: auto;">Subject</th>
                        <th style="width: 5%;">Update</th>
                        <th style="width: 5%;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../DB.php";

                    $sql = "SELECT lecturer_id, subject_id FROM workload ORDER BY lecturer_id";
                    // $sql = "SELECT lecturer.name, subject.name 
                    //         FROM lecturer
                    //         INNER JOIN subject ON lecturer.subject = subject.id";

                    // "SELECT object.name,formulation.formulation_name as formulation FROM object INNER JOIN formulation ON object.formulation_fk = formulation.id" 

                    $result = $conn->query($sql);
                    $num = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                            // $lecturer_name = $row['lecturer_id'];

                            $sql2 = "SELECT * FROM lecturer WHERE id = " . $row['lecturer_id'];
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();

                            $subject_name = $row['subject_id'];
                            $sql3 = "SELECT * FROM subject WHERE id = '" . $row['subject_id'] . "'";
                            $result3 = $conn->query($sql3);
                            $row3 = $result3->fetch_assoc();
                    ?>

                            <tr>
                                <th><?php echo $num ?></th>
                                <td><?php echo $row2['name'] ?></td>
                                <td><?php echo $row3['name'] ?></td>
                                <td><button class="btn btn-sm btn-primary">Update</button></td>
                                <td><button class="btn btn-sm btn-danger">Delete</button></td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>



                    <tr>
                        <th></th>
                        <td>
                            <select class="custom-select">
                                <option selected>Please Choose</option>

                                <?php
                                include "../DB.php";

                                $sql = "SELECT name FROM lecturer";
                                $result = $conn->query($sql);
                                $num = 0;
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        ++$num;
                                ?>
                                        <option value="<?php echo $num ?>"><?php echo $row['name'] ?></option>
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
                            <select class="custom-select">
                                <option selected>Please Choose</option>

                                <?php
                                include "../DB.php";

                                $sql = "SELECT name FROM subject";
                                $result = $conn->query($sql);
                                $num = 0;
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        ++$num;
                                ?>
                                        <option value="<?php echo $num ?>"><?php echo $row['name'] ?></option>
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
                        <td><button class="btn btn-sm btn-secondary">Add</button></td>
                    </tr>



                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../templates/footer.php") ?>