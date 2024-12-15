<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['itmst']){
            require "../db/db.inc.php";
            require "../additional/helper.php";
            $st_item_ID = validate_input_text($_POST['stitmid']);
            $st_item_name = validate_input_text($_POST['stitemname']);
            $st_item_type = validate_input_text($_POST['stitemtype']);
            $st_item_mesure = validate_input_text($_POST['stitemmesure']);

            if(empty($st_item_ID) || empty($st_item_name) || empty($st_item_type) || empty($st_item_mesure)){
                header('Location: ../../Pages/Items/Itmst.page.php?er=empty');
                exit();
            }else if(
            !preg_match("/^[A-Z]{2}_[A-Z]{2}_\d{2,3}$/", $st_item_ID) || !preg_match("/^[A-Za-z][A-Za-z0-9]*$/", $st_item_name)
            || !preg_match("/^[A-Za-z][A-Za-z0-9]*$/", $st_item_type) || !preg_match("/^[A-Za-z][A-Za-z0-9]*$/", $st_item_mesure)){
                header('Location: ../../Pages/Items/Itmst.page.php?er=invalid');
                exit();
            }else{
                $sql = "SELECT DbItemCr FROM tbitmcr WHERE DbItemCr=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../../Pages/Items/Itmst.page.php?er=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $create_item_ID);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $checkedResutls = mysqli_stmt_num_rows($stmt);
                    if ($checkedResutls > 0) {
                        header("location: ../../Pages/Items/Itmst.page.php?er=deplicatedItems");
                        exit();
                    } else {
                        $stmt = mysqli_prepare($conn, "INSERT INTO tbitmcr (DbItemCr, DbItmName, DbItmType, DbItmMesure) VALUES (?, ?, ?, ?)");
                        mysqli_stmt_bind_param($stmt, 'ssss', $create_item_ID, $create_item_name, $create_item_type, $create_item_mesure);
                        mysqli_stmt_execute($stmt);
                        header("location: ../../Pages/Items/Itmst.page.php?er=success");
                        exit();
                    }
                }
            }

        }else{
            header("Location: ../../Pages/Items/Itmcr.page.php?er=btner");
            exit();
        }
    }else{
        header("Location: ../../Public/");
        exit();
    }
?>