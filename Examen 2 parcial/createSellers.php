<?php 
    include "include/header.php";
    require "Examen 2 parcial/conexion.php";
    $db = connectDB();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        $query = "INSERT INTO sellers (id, name, email, phone) VALUES ('$name', '$email', '$phone')";
        $response = mysqli_query($db, $query);

        if ($response) {
            echo "¡Seller creado exitosamente!";
        } else {
            echo "Error al crear el Seller: ";
        }
}
?>

<section>
    <h2>Seller form</h2>
    <div>
        <form action="crearSeller.php" method="POST">
        <fieldset>
            <legend>
                <div>
                    <label for="id">ID</label>
                    <input type="number" id="id" name="id" >
                </div>
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Your@Name.com">
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="555 5 5555 55">
                </div>
                <div>
                    <button type="submit">Create a new Seller</button>
                </div>
            </legend>

        </fieldset>
        </form>
    </div>
</section>

