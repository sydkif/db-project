<?php include('../../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3>Create True/False Quiz</h3>
        <hr>
        <h5>BIC21404 : DATABASE</h5>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: left; width:auto;">Question</th>
                        <th style="text-align: center;">True?</th>
                        <th style="text-align: center; width: 13%">Modified By</th>
                        <th style="text-align: center; width: 13%">Modified On</th>
                        <th style="text-align: center;">Update</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $quiz_list = [
                        [
                            'question' => 'DBMS is an acronym for Relational Database Management System.',
                            'isTrue' => true,
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:11:42'
                        ], [
                            'question' => 'The process of performing corrections on the existing data is Editing.',
                            'isTrue' => true,
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:12:42'
                        ], [
                            'question' => 'DBMS is an acronym for Database Merging System.',
                            'isTrue' => false,
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:13:42'
                        ], [
                            'question' => 'This is a true answer question!',
                            'isTrue' => true,
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:15:22'
                        ], [
                            'question' => 'This is a false answer question!',
                            'isTrue' => false,
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:16:12'
                        ]
                    ];



                    foreach ($quiz_list as $num => $quiz) : ?>
                        <tr>
                            <th scope="row" style="text-align: center;"><?= $num + 1 ?></th>
                            <td style="text-align: left;"><?= $quiz['question'] ?></td>
                            <td style="text-align: center;"><input type="checkbox" <?php if ($quiz['isTrue']) echo "checked" ?> disabled></td>
                            <td id="modi" style="text-align: center;"><?= $quiz['modiBy'] ?></td>
                            <td id="modi" style="text-align: center;"><?= $quiz['modiOn'] ?></td>
                            <td style="text-align: center;">
                                <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm">
                                    <i class="bi bi-pencil-square" style="color: blue;"></i>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove(<?= $num ?>)">
                                    <i class="bi bi-trash" style="color: red;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <form>
                            <td></td>
                            <td><input style="width: 360px;" name="question" value="" type="text" required></td>
                            <td style="text-align: center;"><input name="answer" value="" type="checkbox"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;">
                                <button name="add" class="btn btn-sm">
                                    <i class="bi bi-plus-square" style="color: green;"></i>
                                </button>
                            </td>
                        </form>
                    </tr>


                </tbody>
            </table>
        </div>

    </div>

    <?php include('../../templates/footer.php'); ?>