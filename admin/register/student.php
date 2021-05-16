<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Register Student</h3>
            <hr>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 11%;">Student ID</th>
                        <th style="width: auto;">Student Name</th>
                        <th style="width: 10%;">Student Email</th>
                        <th style="width: 11%;">Modified By</th>
                        <th style="width: 11%;">Modified On</th>
                        <th style="width: 11%;">Update</th>
                        <th style="width: 5%;">Delete</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php 
                    include "../../DB.php";

                    $sql = "SELECT * FROM student";
                    $result = $conn->query($sql);
                    $num=0;

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            ++$num;
                        
                    ?>
                        <tr>
                        <td id="id<?= $num ?>"><?= $row['id']; ?> <b></td>
                        <td id="name<?= $num ?>" contentEditable="false"><?= ucfirst($row['name']); ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['modiBy'] ?></td>
                        <td id><?= date('d-m-Y H:i:s', strtotime($row['modiOn'])); ?></td>
                        <td>
                            <button id="update<?php echo $num ?>" onclick="edit(<?php echo $num ?>)" class="btn btn-sm updateBtn">
                                <i class="bi bi-pencil-square" style="color: blue;"></i>
                            </button>
                            <button id="save<?php echo $num ?>" onclick="update(<?php echo $num ?>)" class="btn btn-sm">
                                <i class="bi bi-save2" style="color: blue;"></i>
                            </button>
                            <button id="cancel<?php echo $num ?>" onclick="cancel(<?php echo $num ?>)" class="btn btn-sm cancelBtn">
                                <i class="bi bi-x-square" style="color: gray;"></i>
                            </button>
                        </td>
                        <td>
                            <button id="delete<?php echo $num ?>" class="btn btn-sm" onclick="remove(<?php echo $num ?>)">
                                <i class="bi bi-trash" style="color: red;"></i>
                            </button>
                        </td>
                    </tr>
                    <?php 
                        }
                    }else  
                        echo "0 results";
                    
                    $conn->close();
                            
                    ?>
                    <tr>
                        <form method="POST">
                            <td><input style="width: 60px;" name="id" value="" type="text" minlength="4" maxlength="8" required></td>
                            <td><input style="width: 360px;" name="name" value="" type="text" required></td>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button name="add" class="btn btn-sm" href="#?">
                                    <i class="bi bi-plus-square" style="color: green;"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                    
                    <?php 
                    
                    include "../../DB.php";

                    if(isset($_POST['add'])){
                        $id = $_POST['id'];
                        $id = strtoupper($id);
                        $name = $_POST['name'];
                        $email = $id."@siswa.uthm.edu.my";
                        $modiBy = "Super admin";
                        $modiOn = date("Y-m-d H:i:s");                
                        $sql = "INSERT INTO student (id, name, email, password, modiBy, modiOn) VALUES('$id', '$name', '$email', '$id', '$modiBy', '$modiOn')";

                        if ($conn->query($sql) === true) {
                            // Success
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else {
                            // Failed
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $conn->close();
                    
                    ?>




                </tbody>
            </table>
            
        </div>
    </div>
</div>

<?php include('../../templates/footer.php') ?>

<script>
    var defaultText, t;

    window.onload = function() {
        var table = document.getElementById("table");
        var rows = table.getElementsByTagName("tr");
        for (var x = 1; x <= rows.length; x++) {
            document.getElementById("save" + x).hidden = true;
            document.getElementById("cancel" + x).hidden = true;
        }

    };


    function edit(n) {
        if (defaultText != null) {
            document.getElementById("name" + t).contentEditable = false;
            document.getElementById("update" + t).hidden = false;
            document.getElementById("save" + t).hidden = true;
            document.getElementById("cancel" + t).hidden = true;
            document.getElementById("name" + t).style.outlineStyle = "";
            document.getElementById("name" + t).style.outlineOffset = "";
            document.getElementById("name" + t).innerText = defaultText;
        }
        defaultText = document.getElementById("name" + n).innerText;
        document.getElementById("name" + n).contentEditable = true;
        document.getElementById("name" + n).focus();
        document.getElementById("update" + n).hidden = true;
        document.getElementById("save" + n).hidden = false;
        document.getElementById("cancel" + n).hidden = false;
        document.getElementById("name" + n).style.outlineStyle = "solid";
        document.getElementById("name" + n).style.outlineOffset = "-10px";
        t = n;
    }

    function cancel(n) {
        // document.getElementById("id" + n).contentEditable = false;
        document.getElementById("name" + n).contentEditable = false;
        document.getElementById("update" + n).hidden = false;
        document.getElementById("save" + n).hidden = true;
        document.getElementById("cancel" + n).hidden = true;
        document.getElementById("name" + n).style.outlineStyle = "";
        document.getElementById("name" + n).style.outlineOffset = "";
        document.getElementById("name" + n).innerText = defaultText;
        // location.reload();
    }

    function update(n) {
        var id = document.getElementById("id" + n).innerText;
        var name = document.getElementById("name" + n).innerText;
        var url = ("../update.php?table=student&id=" + id + "&name=" + name);
        var msg = "Are you sure want to update this record?";
        var conf = confirm(msg);
        if (conf)
            window.location = "" + url;
    }

    function remove(n) {
        var id = document.getElementById("id" + n).innerText;
        var name = document.getElementById("name" + n).innerText;
        var url = ("../delete.php?table=student&id=" + id);
        var msg = "Are you sure want to delete this record?\n\nAdmin ID :\n" + id + "\n\nNAME :\n" + name;
        var conf = confirm(msg);
        if (conf)
            window.location = "" + url;
    }
</script>