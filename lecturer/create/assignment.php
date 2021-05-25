<?php include('../../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3>Create Assignment / Tutorial / Lab</h3>
        <hr>
        <h5>BIC21404 : DATABASE</h5>
        <h5>Title : <input type="text" name="file" id="file"></h5>
        <h5>File to upload : <button class="btn btn-sm btn-outline-dark">Choose File</button> No file chosen
            <button class="btn btn-sm btn-outline-dark">Upload</button>
        </h5>

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

                    $all_list = [
                        [
                            'title' => 'Lab 1',
                            'filename' => 'BIC21404_Labsheet1-2021.doc',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:12:42'
                        ], [
                            'title' => 'Lab 2',
                            'filename' => 'BIC21404_Labsheet2-2021.doc',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '20-05-2021 14:12:22'
                        ], [
                            'title' => 'Lab 3',
                            'filename' => 'BIC21404_Labsheet2-2021.doc',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '20-05-2021 14:12:22'
                        ], [
                            'title' => 'Individual Assignment 1',
                            'filename' => 'BIC21404-Individual Assignment 1-2021.doc',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '20-05-2021 14:12:22'
                        ], [
                            'title' => 'Lab 2',
                            'filename' => 'BIC21404_Labsheet2-2021.doc',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '20-05-2021 14:12:22'
                        ], [
                            'title' => 'Lab 2',
                            'filename' => 'BIC21404_Labsheet2-2021.doc',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '20-05-2021 14:12:22'
                        ]
                    ];


                    foreach ($all_list as $num => $list) :
                    ?>

                        <tr>
                            <th><?= $num + 1 ?></th>
                            <td><?= $list['title'] ?></td>
                            <td><?= $list['filename'] ?></td>
                            <td style="text-align: center; font-size:12px;"><?= $list['modiBy'] ?></td>
                            <td style="text-align: center; font-size:12px;"><?= $list['modiOn'] ?></td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="View Content">
                                    <i class="bi bi-file-earmark-text" style="font-size: 28px; color:blue;"></i>
                                </button>
                            </td>
                            <td style="text-align: center;" title="View Submission">
                                <button class="btn btn-sm">
                                    <i class="bi bi-file-earmark-check" style="font-size: 28px; color:forestgreen;"></i>
                                </button>
                            </td>
                            <td style="text-align: center;" title="Delete">
                                <button class="btn btn-sm">
                                    <i class="bi bi-trash" style="font-size: 28px; color:red;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>

    <?php include('../../templates/footer.php'); ?>