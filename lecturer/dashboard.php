<?php include('../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h1>Lecturer Dashboard</h1>
        <hr>
        <h2>Your Subject List</h2>
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
                                <td style="display:flex; align-items:center; justify-content:center; ">
                                    <button class=" btn btn-sm " title="Add New Assignment & Tutorial"><i class="bi bi-file-earmark-plus" style="font-size: 28px;"></i></button>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <button class="btn btn-sm" title="Add New True False Quiz" style="margin-right: 10px;" onclick="location.href = 'create/true-false-quiz.php';">
                                            <i class=" bi bi-clipboard-plus" style="font-size: 28px; color:forestgreen;"></i></button>
                                        <button class="btn btn-sm" title="View True False Result"><i class="bi bi-clipboard-data" style="font-size: 28px;"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <button class="btn btn-sm" title="Add New Objective Quiz" style="margin-right: 10px;" onclick="location.href = 'create/objective-quiz.php';">
                                            <i class=" bi bi-clipboard-plus" style="font-size: 28px; color:forestgreen;"></i></button>
                                        <button class="btn btn-sm" title="View Objective Result"><i class=" bi bi-clipboard-data" style="font-size: 28px;"></i></button>
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