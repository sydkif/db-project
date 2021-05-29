<?php include("../../templates/header.php");  ?>

<div class="container mt-5 align-items-center">
    <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>View Assignment / Tutorial / Lab</h3>
    <hr>
    <h5>BIC20303 : Database</h5>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores exercitationem alias numquam. Molestiae amet reiciendis cum officia, voluptatem quia! Error!</h5>
                <input type="radio" id="true" name="q1" value="true" required>
                <label for="q1">True</label><br />
                <input type="radio" id="false" name="q1" value="false">
                <label for="q1">False</label><br />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>2. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis, distinctio.</h5>
                <input type="radio" id="true" name="q1" value="true">
                <label for="q1">True</label><br />
                <input type="radio" id="false" name="q1" value="false">
                <label for="q1">False</label><br />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>3. Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ipsum ipsa voluptate omnis, adipisci quos.</h5>
                <input type="radio" id="true" name="q1" value="true">
                <label for="q1">True</label><br />
                <input type="radio" id="false" name="q1" value="false">
                <label for="q1">False</label><br />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>4. Lorem ipsum dolor sit amet.</h5>
                <input type="radio" id="true" name="q1" value="true">
                <label for="q1">True</label><br />
                <input type="radio" id="false" name="q1" value="false">
                <label for="q1">False</label><br />
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Finish Quiz" style="border-radius: 10px;" onclick="location.href = '/student/dashboard.php';">    
    </div>
</div>