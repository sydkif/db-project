<?php include('../../templates/header.php') ?>


<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Register Admin</h3>
            <hr>
        </div>

        <div class="col-12">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">Admin ID</th>
                        <th style="width: auto;">Admin Name</th>
                        <th style="width: 18%;">Update</th>
                        <th style="width: 12%;">Delete</th>
                    </tr>
                </thead>
                <tbody id="table">


                    <?php
                    include "../../DB.php";

                    $sql = "SELECT id, name FROM admin";
                    $result = $conn->query($sql);
                    $num = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>

                            <tr>
                                <td id="id<?php echo $num ?>"><b><?php echo $row["id"] ?><b></th>
                                <td contentEditable=" false" id="name<?php echo $num ?>" style="text-transform: uppercase;"><?php echo $row["name"] ?></td>
                                <td>
                                    <button id="update<?php echo $num ?>" onclick="edit(<?php echo $num ?>)" class="btn btn-sm btn-primary btn-block">Update</button>
                                    <button id="save<?php echo $num ?>" onclick="update(<?php echo $num ?>)" class=" btn btn-sm btn-primary">Save</button>
                                    <button id="cancel<?php echo $num ?>" onclick="cancel(<?php echo $num ?>)" class="btn btn-sm btn-secondary ">Cancel</button>
                                </td>
                                <td><a id="delete<?php echo $num ?>" class="btn btn-sm btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href="../delete.php?table=admin&id=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>

                    <tr>
                        <form method="POST">
                            <td><input style="width: 60px;" name="id" value="" type="text" minlength="4" maxlength="4" pattern="\d*" required></td>
                            <td><input style="width: 360px;" name="name" value="" type="text" required></td>
                            <td></td>
                            <td><button name="add" class="btn btn-sm btn-success" href="#?">Add New</button></td>
                        </form>
                    </tr>

                    <?php

                    include "../../DB.php";

                    if (isset($_POST['add'])) {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $sql = "INSERT INTO admin (id, name) VALUES ('$id', '$name')";

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

<script>
    window.onload = function() {

        var table = document.getElementById("table");
        var rows = table.getElementsByTagName("tr");
        for (var x = 1; x <= rows.length; x++) {
            document.getElementById("save" + x).hidden = true;
            document.getElementById("cancel" + x).hidden = true;
        }

    };

    function confirmationDelete(anchor) {
        var msg = "Are you sure want to delete this record?";
        var conf = confirm(msg);
        if (conf)
            window.location = anchor.attr("href");
    }

    function edit(n) {
        // document.getElementById("id" + n).contentEditable = true;
        document.getElementById("name" + n).contentEditable = true;
        document.getElementById("update" + n).hidden = true;
        document.getElementById("save" + n).hidden = false;
        document.getElementById("cancel" + n).hidden = false;
        document.getElementById("name" + n).style.border = "thick solid #007BFF";


    }

    function cancel(n) {
        // document.getElementById("id" + n).contentEditable = false;
        document.getElementById("name" + n).contentEditable = false;
        document.getElementById("update" + n).hidden = "false";
        document.getElementById("save" + n).hidden = true;
        document.getElementById("cancel" + n).hidden = true;
        location.reload();
    }

    function update(n) {
        var id = document.getElementById("id" + n).innerText;
        var name = document.getElementById("name" + n).innerText;
        var url = ("../update.php?table=admin&id=" + id + "&name=" + name);
        var msg = "Are you sure want to update this record?";
        var conf = confirm(msg);
        if (conf)
            window.location = "" + url;
    }
</script>

<?php include '../../templates/footer.php' ?>