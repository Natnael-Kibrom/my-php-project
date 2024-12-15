<?php
    $title = "Xept|Approval";
    include_once('../../Assets/header.php')
?>

    <div class="container p-md-5">
        <h5 class="text-center">Items Approval</h5>
    </div>
    <div class="container">
        <table class="table table-striped table-hover col-10 mx-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items ID</th>
                    <th scope="col">Items Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Mesurment</th>
                    <th scope="col">Ordered Qty</th>
                    <th scope="col">Current Remaining</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Que</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <div class="">
                            <select class="form-select-sm" id="" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Pis">Pis</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <select class="form-select-sm" id="" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Pis">Pis</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>
                        <div><input type="button" class="btn btn-outline-success btn-sm" value="Request"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>