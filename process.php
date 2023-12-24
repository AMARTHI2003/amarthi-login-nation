<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $existingAppointments = "SELECT * FROM formdata WHERE date = '$date'";
    $result = $conn->query($existingAppointments);

    if ($result->num_rows > 0) {
        echo "Existing appointments found on $date. You can either cancel or rebook.";

    } else {
        $sql = "INSERT INTO formdata (name, email, date) VALUES ('$name', '$email', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
} else {
    echo "Invalid request.";
}
?>