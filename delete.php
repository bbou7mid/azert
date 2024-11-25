<?php

require_once('../../control/hotelcontrole.php');


if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = (int) $_POST['id'];

    $hotelcontrol = new HotelController();
    try {
        $hotelcontrol->deleteHotel($id);
        echo "User with ID $id  successfully deleted";
    } catch (Exception $e) {
        echo "Error deleting user: " . $e->getMessage();
    }
} else {
    echo "Invalid or not provided ID";
}
?>