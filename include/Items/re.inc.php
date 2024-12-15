<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     require '../db/db.inc.php';

//     // Retrieve arrays from the POST request
//     $itemIDs = $_POST['itemID']; // Array of item IDs
//     $itemNames = $_POST['itemName']; // Array of item names
//     $itemTypes = $_POST['itemType']; // Array of item types
//     $itemMeasures = $_POST['itemMeasure']; // Array of item measures
//     $orderedQtys = $_POST['orderedQty']; // Array of ordered quantities
//     $currentRemainings = $_POST['currentRemaining']; // Array of current remaining quantities
//     $orderDates = $_POST['orderDate']; // Array of order dates

//     // Loop through the arrays to process each item request
//     for ($i = 0; $i < count($itemIDs); $i++) {
//         $itemID = $itemIDs[$i];
//         $itemName = $itemNames[$i];
//         $itemType = $itemTypes[$i];
//         $itemMeasure = $itemMeasures[$i];
//         $orderedQty = $orderedQtys[$i];
//         $currentRemaining = $currentRemainings[$i];
//         $orderDate = $orderDates[$i];

//         // Prepare and execute the SQL query to insert the item request
//         $sql = "INSERT INTO tbitmrq (DbItmID, DbItmName, DbItmTyp, DbItmMsur, DbItmOrd, DbitmRem, DbItmODate) 
//                 VALUES (?, ?, ?, ?, ?, ?, ?)";

//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ssssiis", $itemID, $itemName, $itemType, $itemMeasure, $orderedQty, $currentRemaining, $orderDate);

//         if (!$stmt->execute()) {
//             echo "Error inserting data: " . $stmt->error;
//         }
//     }

//     // Redirect or show success message
//     header("Location: ../../Pages/Items/Itmrq.page.php?success=requested");
//     exit(); // Ensure that no further code is executed after the redirect
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../db/db.inc.php';

    // Get the form data as arrays
    $item_ID = $_POST['itemID'];
    $item_Name = $_POST['itemName'];
    $item_Type = $_POST['itemType'];
    $item_Mesure = $_POST['itemMeasure'];
    $item_Oqty = $_POST['orderedQty'];
    $item_Rem = $_POST['currentRemaining'];
    $item_Date = $_POST['orderDate'];

    foreach($item_ID as $reqItems => $itemIDs){
        $item_ID_val = trim($itemIDs);
        $item_Name_val = trim($item_Name[$reqItems]);
        $item_Type_val = trim($item_Type[$reqItems]);
        $item_Mesure_val = trim($item_Mesure[$reqItems]);
        $item_Oqty_val = (int) $item_Oqty[$reqItems]; // Ensure this is an integer
        $item_Rem_val = (int) $item_Rem[$reqItems]; // Ensure this is an integer
        $item_Date_val = trim($item_Date[$reqItems]);

        $sql = "INSERT INTO tbitmrq (DbItmID, DbItmName, DbItmTyp, DbItmMsur, DbItmOrd, DbitmRem, DbItmODate) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiis", $item_ID_val, $item_Name_val, $item_Type_val, $item_Mesure_val, $item_Oqty_val, $item_Rem_val, $item_Date_val);
        if (!$stmt->execute()) {
            echo "Error inserting data: " . $stmt->error;
        }
    }
    header("Location: ../../Pages/Items/Itmrq.page.php?success=requested");
    $stmt->close(); // Close the statement
    exit();
    
}
// Close the database connection
$conn->close();
?>