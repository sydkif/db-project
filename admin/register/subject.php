<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Register Subject</h3>
            <hr>
        </div>

        <div class="col-12">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">Subject ID</th>
                        <th style="width: auto;">Subject Name</th>
                        <th style="width: 20%;">Modified By</th>
                        <th style="width: 20%;">Modified On</th>
                        <th style="width: 5%;">Update</th>
                        <th style="width: 5%;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th>BIC20404</th>
                        <td>OBJECT ORIENTED PROGRAMMING</td>
                        <td>FARIDAH SUPANJI</td>
                        <td>09/05/2021 13:10:42</td>
                        <td><button class="btn btn-sm btn-primary">Update</button></td>
                        <td><button class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>

                    <tr>
                        <th>BIS20404</th>
                        <td>CRYPTOGRAPHY</td>
                        <td>SAMSUDIN ABDULLAH</td>
                        <td>09/05/2021 13:11:22</td>
                        <td><button class="btn btn-sm btn-primary">Update</button></td>
                        <td><button class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>

                    <tr>
                        <th>BIC10303</th>
                        <td>ALGEBRA</td>
                        <td>FARIDAH SUPANJI</td>
                        <td>09/05/2021 13:10:42</td>
                        <td><button class="btn btn-sm btn-primary">Update</button></td>
                        <td><button class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>

                    <tr>
                        <th>BIC11111</th>
                        <td>MATH</td>
                        <td>SAMSUDIN ABDULLAH</td>
                        <td>09/05/2021 13:11:22</td>
                        <td><button class="btn btn-sm btn-primary">Update</button></td>
                        <td><button class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>

                    <tr>
                        <th>BIT20803</th>
                        <td>DATABASE</td>
                        <td>FARIDAH SUPANJI</td>
                        <td>09/05/2021 13:10:42</td>
                        <td><button class="btn btn-sm btn-primary">Update</button></td>
                        <td><button class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>

                    <tr>
                        <td><input style="width: 85px;" value="BIC21404" type="text"></td>
                        <td><input style="width: 330px;" value="DATABASE" type="text"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn btn-sm btn-success">Add</button></td>
                    </tr>

                </tbody>
            </table>


            <!-- page navigation start -->

            <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav> -->

            <!-- page navigation end -->

        </div>
    </div>
</div>

<?php include('../../templates/footer.php') ?>