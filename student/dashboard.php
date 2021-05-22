<?php include('../templates/header.php'); ?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h1>Student Dashboard</h1>
        <hr>
        <h2>Subject List</h2>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: left; vertical-align: middle;">Lecturer</th>
                        <th rowspan="2" style="text-align: left; vertical-align: middle;">Subject</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Assignment<br>& Tutorial</th>
                        <th colspan="4" style="text-align: center;">Quiz & Marks</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center; font-size:small;">True / False</th>
                        <th colspan="2" style="text-align: center; font-size:small;">Objective</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <th scope="row">1</th>
                        <td>MUNIRAH YUSOF</td>
                        <td>REQUIREMENT ENGINEERING</td>
                        <td style="display:flex; align-items:center; justify-content:center; ">
                            <button class=" btn btn-sm " title="View Assignment & Tutorial"><i class="bi bi-file-earmark-text" style="font-size: 28px;"></i></button>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View True False Quiz"><i class="bi bi-clipboard" style="font-size: 28px; "></i></button>
                            </div>
                        </td>
                        <td> <i style="font-style:normal; ">9/10</i></td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View Objective Quiz"><i class=" bi bi-clipboard" style="font-size: 28px;"></i></button>

                            </div>
                        </td>
                        <td><i style="font-style:normal; ">4/15</i></td>
                    </tr>


                    <tr>
                        <th scope="row">2</th>
                        <td>CHUAH CHAI WEN</td>
                        <td>DATABASE</td>
                        <td style="display:flex; align-items:center; justify-content:center; ">
                            <button class=" btn btn-sm " title="View Assignment & Tutorial"><i class="bi bi-file-earmark-text" style="font-size: 28px;"></i></button>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View True False Quiz"><i class="bi bi-clipboard" style="font-size: 28px; "></i></button>
                            </div>
                        </td>
                        <td> <i style="font-style:normal; ">2/10</i></td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View Objective Quiz"><i class=" bi bi-clipboard" style="font-size: 28px;"></i></button>

                            </div>
                        </td>
                        <td><i style="font-style:normal; ">9/15</i></td>
                    </tr>


                    <tr>
                        <th scope="row">3</th>
                        <td>NURHANIFAH MURLI</td>
                        <td>CRYPTOGRAPHY</td>
                        <td style="display:flex; align-items:center; justify-content:center; ">
                            <button class=" btn btn-sm " title="View Assignment & Tutorial"><i class="bi bi-file-earmark-text" style="font-size: 28px;"></i></button>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View True False Quiz"><i class="bi bi-clipboard" style="font-size: 28px; "></i></button>
                            </div>
                        </td>
                        <td> <i style="font-style:normal; ">3/5</i></td>
                        <td>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <button class="btn btn-sm" title="View Objective Quiz"><i class=" bi bi-clipboard" style="font-size: 28px;"></i></button>

                            </div>
                        </td>
                        <td><i style="font-style:normal; ">13/15</i></td>
                    </tr>


                </tbody>
            </table>
        </div>

    </div>

    <?php include('../templates/footer.php'); ?>