<?php
$title = "Xept|Create Item";
include_once('../../Assets/header.php');
?>
<div class="container p-md-5">
    <h5 class="text-center">Create Item</h5>
</div>
<div class="container">
    <form class="row g-3 needs-validation" novalidate action="../../include/Items/cr.inc.php" method="post">
        <div class="col-md-2">
            <label for="vd_1" class="form-label">Item ID</label>
            <input type="text" class="form-control" id="vd_1" name="critmid" placeholder="ID Generate It Self" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="col-md-3">
            <label for="vd_2" class="form-label">Item Brand Name</label>
            <input type="text" class="form-control" id="vd_2" name="critBname" placeholder="Enter Brand" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-3">
            <label for="vd_2" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="vd_3" name="critname" placeholder="Enter Name" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-2">
            <label for="vd_3" class="form-label">ItemType</label>
            <select class="form-select" id="vd_4" name="crittype" required>
                <option selected disabled value="">Choose...</option>
                <option value="Liquid">Liquid</option>
                <option value="Solid">Solid</option>
            </select>
            <div class="invalid-feedback">
                Please select a valid state.
            </div>
        </div>
        <div class="col-md-2">
            <label for="vd_4" class="form-label">Mesurment</label>
            <select class="form-select" id="vd_4" name="critmsur" required>
                <option selected disabled value="">Choose...</option>
                <option value="PICS">Pieces</option>
                <option value="PAK">Packs</option>
                <option value="KG">Kilogram</option>
                <option value="G">Gram</option>
                <option value="CM">Centimeters</option>
                <option value="M">Meter</option>
            </select>
            <div class="invalid-feedback">
                Please select a valid state.
            </div>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-primary" name="itmcr" type="submit">Add Item</button>
        </div>
    </form>
</div>

</body>

</html>