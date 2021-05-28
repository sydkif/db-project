<?php include('../../templates/header.php');

$code = $_GET['code'];
$name = $_GET['name'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="javascript:history.back();"></a>Assignment / Tutorial / Lab Submission</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <h5>Title : <?= $_GET['title'] ?></h5>

        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th style="text-align: left;">Student Name</th>
                        <th style="text-align: center;">Student ID</th>
                        <th style="text-align: center;">File Name</th>
                        <th style="text-align: center; width: 13%">View Content</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $all_list = [
                        [
                            'name' => 'ARMISHA',
                            'id' => 'AI190161',
                            'file' => 'Answer ' . $_GET['title'] . ' - AI190161.docx'
                        ], [
                            'name' => 'ABDUL RAHMAN BIN AMZAL',
                            'id' => 'AI160085',
                            'file' => 'Answer ' . $_GET['title'] . ' - AI19085.docx'
                        ]
                    ];

                    foreach ($all_list as $num => $list) :
                    ?>
                        <tr>
                            <th><?= $num + 1 ?></th>
                            <td><?= $list['name'] ?></td>
                            <td style="text-align: center;"><?= $list['id'] ?></td>
                            <td style="text-align: center;"><?= $list['file'] ?></td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="View Content">
                                    <i class="bi bi-file-earmark-text" style="font-size: 28px; color:blue;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>



    <?php include('../../templates/footer.php'); ?>