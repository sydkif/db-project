<?php include("../../templates/header.php");  ?>

<div class="container mt-5 align-items-center">
    <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>View Assignment / Tutorial / Lab</h3>
    <hr>
    <h5>BIC20303 : Database</h5>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores exercitationem alias numquam. Molestiae amet reiciendis cum officia, voluptatem quia! Error!</h5>
                <input type="radio" id="1a" name="q1" value="a">
                <label for="q1">Akif</label><br />
                <input type="radio" id="1b" name="q1" value="b">
                <label for="q1">Mantul</label><br />
                <input type="radio" id="1c" name="q1" value="c">
                <label for="q1">Mantap</label><br />
                <input type="radio" id="1d" name="q1" value="d">
                <label for="q1">Wow</label><br />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>2. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis, distinctio.</h5>
                <input type="radio" id="2a" name="q2" value="a">
                <label for="q1">Akif</label><br />
                <input type="radio" id="2b" name="q2" value="b">
                <label for="q1">Mantul</label><br />
                <input type="radio" id="2c" name="q2" value="c">
                <label for="q1">Mantap</label><br />
                <input type="radio" id="2d" name="q2" value="d">
                <label for="q1">Wow</label><br />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>3. Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ipsum ipsa voluptate omnis, adipisci quos.</h5>
                <input type="radio" id="3a" name="q3" value="a">
                <label for="q1">Akif</label><br />
                <input type="radio" id="3b" name="q3" value="b">
                <label for="q1">Mantul</label><br />
                <input type="radio" id="3c" name="q3" value="c">
                <label for="q1">Mantap</label><br />
                <input type="radio" id="3d" name="q3" value="d">
                <label for="q1">Wow</label><br />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h5>4. Lorem ipsum dolor sit amet.</h5>
                <input type="radio" id="4a" name="q4" value="a">
                <label for="q1">Akif</label><br />
                <input type="radio" id="4b" name="q4" value="b">
                <label for="q1">Mantul</label><br />
                <input type="radio" id="4c" name="q4" value="c">
                <label for="q1">Mantap</label><br />
                <input type="radio" id="4d" name="q4" value="d">
                <label for="q1">Wow</label><br />
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <input id="submitButton" class="btn btn-primary btn-lg btn-block" type="submit" value="Finish Quiz" style="border-radius: 10px;">    
    </div>
</div>

<script>
    document.getElementById("submitButton").onclick = function(){
        location.href = "/student/dashboard.php";
    };
</script>