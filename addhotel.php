<?php
// Correctly import the Hotel class from the Model namespace
use Model\Hotel;
error_reporting(E_ALL); 
ini_set('display_errors', 1);

require_once('../../control/hotelcontrole.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['nom'], $_POST['ville'], $_POST['etoile'], $_POST['prix'], $_POST['desc']) &&
        !empty($_POST['nom']) && !empty($_POST['ville']) &&
        !empty($_POST['etoile']) && !empty($_POST['prix']) && !empty($_POST['desc'])
    ) {
        // Create a new Hotel object with the form data
        $hotel = new Hotel(
            null, 
            $_POST['nom'],
            $_POST['ville'],
            $_POST['etoile'],
            $_POST['prix'],
            $_POST['desc']
        );
        
        // Create an instance of the controller and call the addHotel method
        $hotelcontrol = new HotelController();
        $hotelcontrol->addHotel($hotel);

        echo "Hotel added successfully!";
    } else {
        $error = "All fields are required.";
        echo $error;
    }
} else {
    $error = "No data received.";
    echo $error;
}
?>
