<?php include('../../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/lecturer/dashboard.php"></a>View Objective Results</h3>
        <hr>
        <h5>BIC 21404 : DATABASE</h5>
        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center; width: 40%;">Student Name</th>
                        <th style="text-align: center;">Student ID</th>
                        <th style="text-align: center;">Result Quiz Objective</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $quiz_list = [
                        [
                            'name' => 'Salama',
                            'id' => 'AI000069',
                            'result' => 2
                        ], [
                            'name' => 'Salama 2',
                            'id' => 'AI690000',
                            'result' => 4
                        ], [
                            'name' => 'Salama 3',
                            'id' => 'AI006900',
                            'result' => 6
                        ], [
                            'name' => 'Akif Mantul',
                            'id' => 'CI190063',
                            'result' => NULL
                        ]
                    ];

                    $count_pass = 0; //Count number of pass 
                    $count_fail = 0; //Count number of fails

                    foreach ($quiz_list as $num => $quiz) : ?>
                        <tr>
                            <th scope="row" style="text-align: center;"><?= $num + 1 ?></th>
                            <td style="text-align: center"><?= $quiz['name'] ?></td>
                            <td style="text-align: center"><?= $quiz['id'] ?></td>
                            <td style="text-align: center"><?= $quiz['result'] ?></td>
                        </tr>

                    <?php

                        if ($quiz['result'] > 2)
                            $count_pass++;
                        else
                            $count_fail++;

                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <br />
        <div class="row justify-content-start">
            <div class="alert alert-success col-2" style="margin-left: 14px;" role="alert">
                Number of Pass: <?= $count_pass ?>
            </div>
            <div class="alert alert-danger col-2" role="alert">
                Number of Fails: <?= $count_fail ?>
            </div>
        </div>
    </div>
</div>



<?php include('../../templates/footer.php'); ?>