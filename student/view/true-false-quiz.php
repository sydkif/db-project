<?php include("../../templates/header.php");  ?>

<!-- <link rel="stylesheet/less" type="text/css" href="/css/quiz.less" />
<script src="//cdn.jsdelivr.net/npm/less@3.13"></script> -->

<link rel="stylesheet" href="/css/quiz.css">

<div class="container mt-5 align-items-center">
    <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>View Assignment / Tutorial / Lab</h3>
    <hr>
    <h5>BIC20303 : Database</h5>
    <div class="col">

        <?php

        $q_list = [
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                           Maiores exercitationem alias numquam. Molestiae amet reiciendis 
                           cum officia, voluptatem quia! Error!'
            ],
            [
                'question' =>  'Lorem ipsum dolor sit amet.'
            ],
            [
                'question' =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ipsum ipsa voluptate omnis, adipisci quos.'
            ],
            [
                'question' =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Maiores exercitationem alias numquam. Molestiae amet reiciendis 
                            cum officia, voluptatem quia! Error!'
            ],
            [
                'question' =>  'Lorem ipsum dolor sit amet.'
            ],
            [
                'question' =>  'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis, distinctio.'
            ],
            [
                'question' =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Maiores exercitationem alias numquam. Molestiae amet reiciendis 
                            cum officia, voluptatem quia! Error!'
            ]
        ];

        foreach ($q_list as $num => $q) : ?>

            <div class="row">
                <div class="card w-100 shadow-sm">
                    <div class="card-body">
                        <p>Question <?= $num + 1 ?> of <?= sizeof($q_list) ?></p>
                        <h5><?= $q['question'] ?></h5>
                        <hr>
                        <form id="answer">
                            <input id="true<?= $num + 1 ?>" name="q<?= $num + 1 ?>" type="radio" />
                            <label for="true<?= $num + 1 ?>">True</label>
                            <br>
                            <input id="false<?= $num + 1 ?>" name="q<?= $num + 1 ?>" type="radio" />
                            <label for="false<?= $num + 1 ?>">False</label>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <div class="row" style="margin-top: 20px;">
            <input id="submitButton" class="btn btn-primary btn-lg btn-block" type="submit" value="Finish Quiz" style="border-radius: 10px;">
        </div>
    </div>
</div>

<script>
    document.getElementById("submitButton").onclick = function() {
        location.href = "/student/dashboard.php";
    };
</script>

<?php include('../../templates/footer.php'); ?>