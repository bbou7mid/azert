<?php

require_once('../../control/hotelcontrole.php');
require_once('../../model/hotel.php');
use Model\Hotel;


$hotelcontrol = new HotelController();

if (isset($_POST['id'], $_POST['nom'], $_POST['ville'], $_POST['etoile'], $_POST['prix'], $_POST['desc']) && is_numeric($_POST['id'])) {
    $id = (int) $_POST['id'];

   
    $hotel= new Hotel(
        $id,
        $_POST['nom'],
        $_POST['ville'],
        $_POST['etoile'],
        $_POST['prix'],
        $_POST['desc']
    );

    $hotelcontrol->updateHotel($hotel, $id);

    echo "User updated successfully";
} else {
    echo "Invalid data. Please check the fields";
}
?>
