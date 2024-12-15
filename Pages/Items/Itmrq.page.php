<?php
$title = "Xept|Item Request";
include_once('../../Assets/header.php');
require '../../include/db/db.inc.php';

$sqllist = "SELECT * FROM tbitmcr ORDER BY DbItmName ASC";
$result = $conn->query($sqllist);
$items = [];

if ($result->num_rows > 0) {
    while ($rowDB = $result->fetch_assoc()) {
        $items[] = $rowDB;
    }
}
?>

<div class="container p-md-5">
    <h5 class="text-center">Request for Items</h5>
</div>

<div class="container">
    <form action="../../include/Items/re.inc.php" method="post">
        <table class="table table-striped table-hover col-10 mx-auto" id="itemTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items ID</th>
                    <th scope="col">Items Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Measurement</th>
                    <th scope="col">Ordered Qty</th>
                    <th scope="col">Current Remaining</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Que</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><input type="text" class="form-control form-control-sm" name="itemID[]" id="ReqID1" required disabled>
                        <input type="hidden" name="itemID[]" id="HiddenReqID1">
                    </td>

                    <td>
                        <select class="form-select-sm" id="ReqName1" name="itemName[]" onchange="updateRowDetails(this)" required>
                            <option selected disabled value="">Choose...</option>
                            <?php foreach ($items as $rowDB) : ?>
                                <option value="<?= $rowDB['DbItmName'] ?>"
                                    data-id="<?= $rowDB['DbItemCr'] ?>"
                                    data-typ="<?= $rowDB['DbItmType'] ?>"
                                    data-mes="<?= $rowDB['DbItmMesure'] ?>"><?= $rowDB['DbItmName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control form-control-sm" name="itemType[]" id="ReqTyp1" required disabled>
                        <input type="hidden" name="itemType[]" id="HiddenReqTyp1">
                    </td>
                    <td><input type="text" class="form-control form-control-sm" name="itemMeasure[]" id="ReqMes1" required disabled>
                        <input type="hidden" name="itemMeasure[]" id="HiddenReqMes1">
                    </td>
                    <td><input type="number" class="form-control form-control-sm" name="orderedQty[]" required></td>
                    <td><input type="number" class="form-control form-control-sm" name="currentRemaining[]" required></td>
                    <td><input type="date" class="form-control form-control-sm" name="orderDate[]" required></td>
                    <td><input type="button" class="btn btn-danger btn-sm" value="Remove" onclick="removeRow(this)"></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success" onclick="addRow()">Add Row</button>
        <button type="submit" class="btn btn-primary">Request All</button>
    </form>
</div>

<script>
    let rowCount = 1; // Initialize row count

    function addRow() {
        rowCount++;
        let table = document.getElementById("itemTable").getElementsByTagName('tbody')[0];
        let newRow = table.insertRow(table.rows.length);
        newRow.innerHTML = `
                    <th scope="row">${rowCount}</th>
                        <td><input type="text" class="form-control form-control-sm" name="itemID[]" id="ReqID${rowCount}" required disabled>
                            <input type="hidden" name="itemID[]" id="HiddenReqID${rowCount}">
                        </td>

                        <td>
                            <select class="form-select-sm" id="ReqName${rowCount}" name="itemName[]" onchange="updateRowDetails(this)" required>
                                <option selected disabled value="">Choose...</option>
                                <?php foreach ($items as $rowDB) : ?>
                                    <option value="<?= $rowDB['DbItmName'] ?>"
                                        data-id="<?= $rowDB['DbItemCr'] ?>"
                                        data-typ="<?= $rowDB['DbItmType'] ?>"
                                        data-mes="<?= $rowDB['DbItmMesure'] ?>"><?= $rowDB['DbItmName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" class="form-control form-control-sm" name="itemType[]" id="ReqTyp${rowCount}" required disabled>
                            <input type="hidden" name="itemType[]" id="HiddenReqTyp${rowCount}">
                        </td>
                        <td><input type="text" class="form-control form-control-sm" name="itemMeasure[]" id="ReqMes${rowCount}" required disabled>
                            <input type="hidden" name="itemMeasure[]" id="HiddenReqMes${rowCount}">
                        </td>
                        <td><input type="number" class="form-control form-control-sm" name="orderedQty[]" required></td>
                        <td><input type="number" class="form-control form-control-sm" name="currentRemaining[]" required></td>
                        <td><input type="date" class="form-control form-control-sm" name="orderDate[]" required></td>
                        <td><input type="button" class="btn btn-danger btn-sm" value="Remove" onclick="removeRow(this)"></td>
            `;
    }

    function updateRowNumbers() {
        let rows = document.querySelectorAll('#itemTable tbody tr');
        rows.forEach((row, index) => {
            row.querySelector('th').textContent = index + 1; // Update row number
        });
    }

    function updateRowDetails(selectElement) {
        let row = selectElement.closest('tr');
        let selectedOpt = selectElement.options[selectElement.selectedIndex];
        let id = selectedOpt.getAttribute('data-id');
        let typ = selectedOpt.getAttribute('data-typ');
        let mes = selectedOpt.getAttribute('data-mes');

        // Update the values in the corresponding row's fields
        row.querySelector('input[name="itemID[]"]').value = id;
        row.querySelector('input[name="itemType[]"]').value = typ;
        row.querySelector('input[name="itemMeasure[]"]').value = mes;

        // Update hidden fields as well
        row.querySelector('input[type="hidden"][name="itemID[]"]').value = id;
        row.querySelector('input[type="hidden"][name="itemType[]"]').value = typ;
        row.querySelector('input[type="hidden"][name="itemMeasure[]"]').value = mes;
    }
    function removeRow(button) {
        let row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        rowCount--; // Decrease row count
        updateRowNumbers(); // Update row numbers
    }
</script>
</body>

</html>