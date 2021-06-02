<?php
if (isset($_SESSION['msg']))
    if (($_SESSION['status']) == "Success") {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    } else if (($_SESSION['status']) == "Fail") {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    }

$_SESSION['msg'] = NULL;
$_SESSION['status'] = NULL;
?>