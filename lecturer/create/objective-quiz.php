<?php include('../../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3>Create Objective Quiz</h3>
        <hr>
        <h5>BIC21404 : DATABASE</h5>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: left; vertical-align: middle; width:auto;">Question</th>
                        <th colspan="5" style="text-align: center; ">Answer</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Modified By</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Modified On</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Update</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Delete</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">A</th>
                        <th style="text-align: center;">B</th>
                        <th style="text-align: center;">C</th>
                        <th style="text-align: center;">D</th>
                        <th style="text-align: center;">Correct</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $quiz_list = [
                        [
                            'question' => 'A report is printed information based on',
                            'A' => 'Data',
                            'B' => 'Form',
                            'C' => 'Input',
                            'D' => 'Question',
                            'correct' => 'D',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:11:42'
                        ], [
                            'question' => 'The set of processed data is called',
                            'A' => 'Database',
                            'B' => 'Information',
                            'C' => 'Datum',
                            'D' => 'Data',
                            'correct' => 'B',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:12:42'
                        ], [
                            'question' => 'A row in a table represent',
                            'A' => 'Record',
                            'B' => 'Field',
                            'C' => 'File',
                            'D' => 'Column',
                            'correct' => 'A',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:13:42'
                        ], [
                            'question' => 'A row in a table represent A row in a table represent A row in a table represent A row in a table represent',
                            'A' => 'Record Record',
                            'B' => 'Field Record',
                            'C' => 'File Record',
                            'D' => 'Column Record',
                            'correct' => 'A',
                            'modiBy' => 'CHUAH CHAI WEN',
                            'modiOn' => '16-05-2021 16:13:42'
                        ]
                    ];



                    foreach ($quiz_list as $num => $quiz) : ?>
                        <tr>
                            <th scope="row" style="text-align: center;"><?= $num + 1 ?></th>
                            <td style="text-align: left;"><?= $quiz['question'] ?></td>
                            <td style="text-align: center;"><?= $quiz['A'] ?></td>
                            <td style="text-align: center;"><?= $quiz['B'] ?></td>
                            <td style="text-align: center;"><?= $quiz['C'] ?></td>
                            <td style="text-align: center;"><?= $quiz['D'] ?></td>
                            <td style="text-align: center;"><?= $quiz['correct'] ?></td>
                            <td style="text-align: center; font-size:12px;"><?= $quiz['modiBy'] ?></td>
                            <td style="text-align: center; font-size:12px;"><?= $quiz['modiOn'] ?></td>
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
                            <td><input name="question" value="" type="text" required></td>
                            <td style="text-align: center;"><input name="question" value="" type="text" style="width: 60px;" required></td>
                            <td style="text-align: center;"><input name="question" value="" type="text" style="width: 60px;" required></td>
                            <td style="text-align: center;"><input name="question" value="" type="text" style="width: 60px;" required></td>
                            <td style="text-align: center;"><input name="question" value="" type="text" style="width: 60px;" required></td>
                            <td style="text-align: center;">
                                <select name="correct_answer" class="custom-select">
                                    <option selected></option>
                                    <option style="text-transform: uppercase;" value="A">A</option>
                                    <option style="text-transform: uppercase;" value="B">B</option>
                                    <option style="text-transform: uppercase;" value="C">C</option>
                                    <option style="text-transform: uppercase;" value="D">D</option>
                                </select>
                            </td>
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