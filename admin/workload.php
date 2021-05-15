<?php include("../templates/header.php") ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Assign Workload Lecturer</h3>
            <hr>
        </div>

        <div class="col-12">
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

                    $sql = "SELECT lecturer_id, subject_id FROM workload";
                    $result = $conn->query($sql);
                    $num = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                            // $lecturer_name = $row['lecturer_id'];
                            $lecturer_name =  $row['lecturer_id'];
                            $subject_name = $row['subject_id'];
                    ?>

                            <tr>
                                <th><?php echo $num ?></th>
                                <td><?php echo $lecturer_name ?></td>
                                <td><?php echo $subject_name ?></td>
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
                                <option value="1">CHUAH CHAI WEN</option>
                                <option value="2">SHAREEM KASIM</option>
                                <option value="3">NURHANIFAH MURLI</option>
                                <option value="4">SOFIA NAJWA</option>
                                <option value="5">MUNIRAH YUSOF</option>
                            </select>
                        </td>
                        <td>
                            <select class="custom-select">
                                <option selected>Please Choose</option>
                                <option value="1">OBJECT ORIENTED PROGRAMMING</option>
                                <option value="2">CRYPTOGRAPHY</option>
                                <option value="3">SPECIAL TOPIC INFORMATION SECURITY</option>
                                <option value="4">ALGEBRA</option>
                                <option value="5">MATH</option>
                                <option value="6">DATABASE SYSTEM</option>
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