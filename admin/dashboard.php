<?php include('../templates/header.php') ?>

<div class="container mt-5 align-items-center">
    <div class="col text-center">
        <h1>Admin Dashboard</h1>
        <hr>
        <h2>Register</h2>
    </div>

    <div class="row">

        <a class="card btn btn-outline-dark" href="/admin/register/admin.php">
            <i class="bi bi-person-square" style="font-size: 6rem; text-align: center;"></i>
            <h4>Admin</h4>
        </a>
        <a class="card btn btn-outline-dark" href="/admin/register/lecturer.php">
            <i class="bi bi-person-square" style="font-size: 6rem; text-align: center;"></i>
            <h4>Lecturer</h4>
        </a>
        <a class="card btn btn-outline-dark" href="/admin/register/student.php">
            <i class="bi bi-person-square" style="font-size: 6rem; text-align: center;"></i>
            <h4>Student</h4>
        </a>
        <a class="card btn btn-outline-dark" href="/admin/register/subject.php">
            <i class="bi bi-journal" style="font-size: 6rem; text-align: center;"></i>
            <h4>Subject</h4>
        </a>
    </div>
</div>

<?php include('../templates/footer.php') ?>