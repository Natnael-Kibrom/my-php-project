<?php
$title = "Xept|Stocking";
include_once('../../Assets/header.php');
require '../../include/db/db.inc.php';

$sqllist = "SELECT * FROM tbitmcr ORDER BY DbItmName ASC";
$result = $conn->query($sqllist);
$items = [];

if ($result->num_rows > 0) {
    while ($rowDB = $result->fetch_assoc()) {
        $stockQtyQuery = "SELECT * FROM tbitmst WHERE DbstockID = ?";
        $stmt = $conn->prepare($stockQtyQuery);
        $stmt->bind_param("s", $rowDB['DbItemCr']);
        $stmt->execute();
        $stockResult = $stmt->get_result();
        $stockQtyRemain = 0; // delfualt to be zero if there is no stock
        if ($stockResult->num_rows > 0) {
            $stockData = $stockResult->fetch_assoc();
            $stockQtyRemain = $stockData['DbstockQtyUsed'];
        }
        $rowDB['DbstockQtyUsed'] = $stockQtyRemain;
        $items[] = $rowDB;
    }
}

?>

<div class="container p-md-5">
    <h5 class="text-center">Add to Stock</h5>
</div>

<div class="container-fulid">
    <form action="../../include/st/st.inc.php" method="post">
        <table class="table table-striped table-hover col-10 mx-auto" id="itemTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items ID</th>
                    <th scope="col">Items Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Type</th>
                    <th scope="col">Measurement</th>
                    <th scope="col">Purchased Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Stoked Qty</th>
                    <th scope="col">Itm Exp-Date</th>
                    <th scope="col">Itm Man-Date</th>
                    <th scope="col">Last Restoked Date</th>
                    <th scope="col">Edititng</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><input type="text" class="form-control form-control-sm" name="stitmid[]" id="StID1" required disabled>
                        <input type="hidden" name="stitmid[]" id="HiddenStID1">
                    </td>

                    <td>
                        <select class="form-select-sm" id="StBrand1" name="stitembrand[]" onchange="updateRowDetails(this)" required>
                            <option selected disabled value="">Choose...</option>
                            <?php foreach ($items as $rowDB) : ?>
                                <option value="<?= $rowDB['DbItmBrand'] ?>"
                                    data-id="<?= $rowDB['DbItemCr'] ?>"
                                    data-name="<?= $rowDB['DbItmName'] ?>"
                                    data-typ="<?= $rowDB['DbItmType'] ?>"
                                    data-mes="<?= $rowDB['DbItmMesure'] ?>"
                                    data-stock="<?= $rowDB['DbstockQtyUsed'] ?>">
                                    <?= $rowDB['DbItmBrand'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control form-control-sm" name="stitemname[]" id="StName1" required disabled>
                        <input type="hidden" name="stitemname[]" id="HiddenReqName1">
                    </td>
                    <td><input type="text" class="form-control form-control-sm" name="stitemtype[]" id="StTyp1" required disabled>
                        <input type="hidden" name="stitemtype[]" id="HiddenReqTyp1">
                    </td>
                    <td><input type="text" class="form-control form-control-sm" name="stitemmesure[]" id="StMes1" required disabled>
                        <input type="hidden" name="stitemmesure[]" id="HiddenReqMes1">
                    </td>
                    <td><input type="number" class="form-control form-control-sm" id="StPQty1" name="stock[]" oninput="updateclauculate(1)" required></td>
                    <td><input type="number" class="form-control form-control-sm" id="StPr1" name="stockPrice[]" oninput="updateclauculate(1)" required></td>
                    <td><input type="number" class="form-control form-control-sm" id="StTPr1" name="stockTprice[]" required readonly></td>
                    <td><input type="number" class="form-control form-control-sm" id="StRem1" name="stockRemain[]" required readonly></td>
                    <td><input type="date" class="form-control form-control-sm" id="StExp" name="stockedExp[]" required></td>
                    <td><input type="date" class="form-control form-control-sm" id="StManF" name="stockedManF[]" required></td>
                    <td><input type="date" class="form-control form-control-sm" id="StDt1" name="stokedDate[]" required></td>
                    <td><input type="button" class="btn btn-danger btn-sm" value="Remove" onclick="removeRow(this)"></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success btn-sm" onclick="addRow()">Add Row</button>
        <button type="submit" class="btn btn-primary btn-sm" name="itmst">Insert All</button>
    </form>
</div>

<script>
    let rowCount = 1; // Initialize row count

    function addRow() {
        rowCount++;
        let table = document.getElementById("itemTable").getElementsByTagName('tbody')[0];
        let newRow = table.insertRow(table.rows.length);
        newRow.innerHTML = `
                    <th scope="row" id="rowcouter">${rowCount}</th>
                        <td><input type="text" class="form-control form-control-sm" name="stitmid[]" id="StID${rowCount}" required disabled>
                            <input type="hidden" name="stitmid[]" id="HiddenStID${rowCount}">
                        </td>

                        <td>
                            <select class="form-select-sm" id="StName${rowCount}" name="stitemname[]" onchange="updateRowDetails(this)" required>
                                <option selected disabled value="">Choose...</option>
                                <?php foreach ($items as $rowDB) : ?>
                                    <option value="<?= $rowDB['DbItmName'] ?>"
                                        data-id="<?= $rowDB['DbItemCr'] ?>"
                                        data-typ="<?= $rowDB['DbItmType'] ?>"
                                        data-mes="<?= $rowDB['DbItmMesure'] ?>"><?= $rowDB['DbItmName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" class="form-control form-control-sm" name="stitemtype[]" id="StTyp${rowCount}" required disabled>
                            <input type="hidden" name="stitemtype[]" id="HiddenReqTyp${rowCount}">
                        </td>
                        <td><input type="text" class="form-control form-control-sm" name="stitemmesure[]" id="StMes${rowCount}" required disabled>
                            <input type="hidden" name="stitemmesure[]" id="HiddenReqMes${rowCount}">
                        </td>
                        
                        <td><input type="number" class="form-control form-control-sm" id="StPQty${rowCount}" name="currentRemaining[]" oninput="updateclauculate(${rowCount})" required></td>
                        <td><input type="number" class="form-control form-control-sm" id="StPr${rowCount}" name="stockPrice[]" oninput="updateclauculate(${rowCount})" required></td>
                        <td><input type="number" class="form-control form-control-sm" id="StTPr${rowCount}" name="stockTprice[]" required readonly></td>
                        <td><input type="number" class="form-control form-control-sm" id="Stqty${rowCount}" name="stockUsed[]" required></td>
                        <td><input type="number" class="form-control form-control-sm" id="StRem${rowCount}" name="stockRemain[]" required></td>
                        <td><input type="date" class="form-control form-control-sm" id="StDt${rowCount}" name="stokedDate[]" required></td>
                        <td><input type="button" class="btn btn-danger btn-sm" value="Remove" onclick="removeRow(this)"></td>
            `;
    }

    function removeRow(button) {
        let row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        rowCount--; // Decrease row count
        updateRowNumbers(); // Update row numbers
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
        let name = selectedOpt.getAttribute('data-name');
        let typ = selectedOpt.getAttribute('data-typ');
        let mes = selectedOpt.getAttribute('data-mes');
        let StockQty = selectedOpt.getAttribute('data-stock');

        // Update the values in the corresponding row's fields
        row.querySelector('input[name="stitmid[]"]').value = id;
        row.querySelector('input[name="stitemname[]"]').value = name;
        row.querySelector('input[name="stitemtype[]"]').value = typ;
        row.querySelector('input[name="stitemmesure[]"]').value = mes;
        row.querySelector('input[name="stockRemain[]"]').value =StockQty;

        // Update hidden fields as well
        row.querySelector('input[type="hidden"][name="stitmid[]"]').value = id;
        row.querySelector('input[type="hidden"][name="stitemname[]"]').value = name;
        row.querySelector('input[type="hidden"][name="stitemtype[]"]').value = typ;
        row.querySelector('input[type="hidden"][name="stitemmesure[]"]').value = mes;
    }

    function updateclauculate(rowId) {
        let currentRemaining = document.getElementById(`StPQty${rowId}`).value;
        let stockPrice = document.getElementById(`StPr${rowId}`).value;
        let totalPriceInput = document.getElementById(`StTPr${rowId}`);

        // Calculate the total price and set the value
        let totalPrice = (parseFloat(currentRemaining) || 0) * (parseFloat(stockPrice) || 0);
        totalPriceInput.value = totalPrice;
    }
</script>
</body>

</html>