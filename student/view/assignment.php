<?php include('../../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>View Assignment / Tutorial / Lab</h3>
        <hr>
        <h5>BIC20404 : Database</h5>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th style="text-align: left;">Assignment/Tutorial/Lab</th>
                        <th style="text-align: center;">Your File</th>
                        <th style="text-align: center; width: 13%">Download Task</th>
                        <th style="text-align: center; width: 13%">Submission</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $all_list = [
                        [
                            'name' => 'Lab 1',
                            'file' => 'file_name_file_name.docx'
                        ], [
                            'name' => 'Lab 2',
                            'file' => 'file_name_file_name.docx'
                        ], [
                            'name' => 'Lab 3',
                            'file' => 'file_name_file_name.docx'
                        ], [
                            'name' => 'Lab 4',
                            'file' => '',
                        ]
                    ];

                    foreach ($all_list as $num => $list) :
                    ?>
                        <tr>
                            <th><?= $num + 1 ?></th>
                            <td><?= $list['name'] ?></td>
                            <td style="text-align: center;"><?= $list['file'] ?></td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="Download Task">
                                    <i class="bi bi-file-earmark-arrow-down" style="font-size: 28px; color:dimgray;"></i>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="Submit Task">
                                    <i class="bi bi-file-earmark-arrow-up" style="font-size: 28px; color:darkgoldenrod;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>



    <?php include('../../templates/footer.php'); ?>