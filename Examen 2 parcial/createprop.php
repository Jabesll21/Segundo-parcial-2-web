<?php
include "Examen 2 parcial/header.php";
require "Examen 2 parcial/conexion.php";
$db = connectDB();

$query = "SELECT id, name FROM seller";
$response = mysqli_query($db, $query);

if (!$response) {
    die("Query Failed: " . mysqli_error($db));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $tittle = $_POST["tittle"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $description = $_POST["description"];
    $rooms = $_POST["rooms"];
    $wc = $_POST["wc"];
    $garage = $_POST["garage"];
    $timestap = $_POST["timestap"];
    $seller = $_POST["seller"];

$checkSeller = "SELECT id FROM seller WHERE id = '$seller'";
$result = mysqli_query($db, $checkSeller);

if (mysqli_num_rows($result) > 0) {

$query = "INSERT INTO propierties (title, price, image, description, rooms, wc, garage, timestap, id_seller) 
VALUES ('$tittle', '$price', '$image', '$description', '$rooms', '$wc', '$garage', '$timestap', '$seller')";
$response = mysqli_query($db, $query);

if ($response) {
    echo "property created";
} else { echo "Error: " . mysqli_error($db);}
} else {
echo "Enter a valid seller ID";
}} else {
echo "Please fill in the form to create a property.";}
?>


<section>
    <h2> propierties form</h2>
    <div>
        <form action="CrearPropiedades.php<" method="post">
            <fieldset>
                <legend> FILL All form fields to create a new propierties</legend>
            </fieldset>
        </form>
        <div>
            <label for="id">ID</label>
            <input type="number" id="id" name="id">
        </div>
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Title of propierty">  
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" id="price" name="price" placeholder="$11111111">
        </div>
        <div>
            <label for="image">Image</label>
            <input type="image" src="" alt="" id="name" name="image">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Description"></textarea>                </div>
         <div>
              <label for="rooms">Rooms</label>
                <input type="number" id="rooms" name="rooms">
        </div>
         <div>
            <label for="wc">Bathrooms</label>
             <input type="number" id="wc" name="wc">
        </div>
          <div>
               <label for="garage">Garage</label>
              <input type="number" id="garage" name="garage">
        </div>
        <div>
                <label for="timestap">Date</label>
                <input type="date" id="timestap" name="timestap">
        </div>
         <div>
               <label for="seller">Seller ID</label>
             <select id="seller" name="seller">
             <?php 
                        while ($seller = mysqli_fetch_assoc($response)) : ?>
                            <option value="<?php echo $seller['id']; ?>"><?php echo $seller['name']; ?></option>    
                       <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <button type="submit">Create property</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>
