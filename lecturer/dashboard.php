<?php include('../templates/header.php'); ?>

<br>

<div class="container">
    <h3>Your Subject List</h3>
    <hr>
    <div class="table-responsive shadow rounded">
        <table id="dashboard-lecturer" class="table">
            <thead class="thead-dark">
                <tr>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                    <th rowspan="2" style="text-align: left; vertical-align: middle;">Subject</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Assignment<br>& Tutorial</th>
                    <th colspan="2" style="text-align: center;">Quiz</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-size:small;">True / False</th>
                    <th style="text-align: center; font-size:small;">Objective</th>
                </tr>
            </thead>
            <tbody>

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

                        <tr>
                            <th scope="row"><?= $num ?></th>
                            <td><?= $row['name'] ?></td>
                            <div>
                                <td><button class=" btn btn-outline-dark btn-block "><i class="bi bi-file-earmark-plus"></i> Create</button></td>
                            </div>
                            <td>
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <button class="btn btn-outline-dark " style="margin-right: 10px;"><i class="bi bi-clipboard-plus"></i> Create/View</button>
                                    <button class=" btn btn-outline-dark "><i class=" bi bi-clipboard-data"></i> Result</button>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <button class="btn btn-outline-dark " style="margin-right: 10px;"><i class="bi bi-clipboard-plus"></i> Create/View</button>
                                    <button class=" btn btn-outline-dark "><i class=" bi bi-clipboard-data"></i> Result</button>
                                </div>
                            </td>
                        </tr>


                <?php
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>



            </tbody>
        </table>
    </div>

</div>

<?php include('../templates/footer.php'); ?>