<?php
include "Examen 2 parcial/header.php";
require "Examen 2 parcial/conexion.php";
$conect = connectDB();

$queryl = "SELECT sold.id, s.name AS sellerName, p.title AS propertyTitle, p.image AS image 
           FROM sold_properties sold 
           JOIN seller s ON sold.id_seller = s.id 
           JOIN properties p ON sold.id_prop = p.id";

$result = $conect->query($queryl);
?>

<h1>Sold Properties</h1>
<section class="sold-properties">
    <p>Here are the properties sold:</p>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Seller Name</th>
                    <th>Property Title</th>
                    <th>Image</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["sellerName"] . "</td>
                    <td>" . $row["propertyTitle"] . "</td>
                    <td><img src='" . $row["image"] . "' alt='" . $row["propertyTitle"] . "' style='width: 300px; height:auto;'></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No properties sold were found.</p>";
    }
    $conect->close();
    ?>
</section>
