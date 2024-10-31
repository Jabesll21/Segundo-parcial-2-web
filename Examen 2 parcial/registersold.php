<?php
include "Examen 2 parcial/header.php";
require "Examen 2 parcial/conexion.php";
$db = connectDB();

$querySel = "SELECT id, name FROM seller";
$queryProp = "SELECT id, title FROM properties";
$sellersRes = mysqli_query($db, $querySel);
$propRes = mysqli_query($db, $queryProp);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_seller = $_POST["id_seller"];
    $id_prop = $_POST["id_prop"];

    if ($id_seller && $id_prop) {
        $checkSeller = "SELECT id FROM seller WHERE id = ?";
        $checkProperty = "SELECT id FROM properties WHERE id = ?";
        $stmtSeller = mysqli_prepare($db, $checkSeller);
        $stmtProperty = mysqli_prepare($db, $checkProperty);
        mysqli_stmt_bind_param($stmtSeller, "i", $id_seller);
        mysqli_stmt_bind_param($stmtProperty, "i", $id_prop);
        mysqli_stmt_execute($stmtSeller);
        $sellerExists = mysqli_stmt_get_result($stmtSeller);
        mysqli_stmt_close($stmtSeller); 
        mysqli_stmt_execute($stmtProperty);
        $propertyExists = mysqli_stmt_get_result($stmtProperty);
        mysqli_stmt_close($stmtProperty);

        if (mysqli_num_rows($sellerExists) > 0 && mysqli_num_rows($propertyExists) > 0) {
            $insertQuery = "INSERT INTO sold_properties (id_seller, id_prop) VALUES (?, ?)";
            $stmtInsert = mysqli_prepare($db, $insertQuery);
            mysqli_stmt_bind_param($stmtInsert, "ii", $id_seller, $id_prop);
            if (mysqli_stmt_execute($stmtInsert)) {
                $message = "Sale registered successfully.";
            } else {
                $message = "Error registering the sale: " . mysqli_error($db);
            }
            mysqli_stmt_close($stmtInsert);
        } else {
            $message = "Invalid seller or property ID.";
        }
    } else {
        $message = "Please select both a seller and a property.";
    }
}


