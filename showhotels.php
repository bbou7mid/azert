<?php
include('../../control/hotelcontrole.php');

$hotelcontrol= new HotelController();
$hotels = $hotelcontrol->listHotels(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>

    
</head>
<body>
<div class="container mt-5">
    <h1>Liste des hotels</h1>
    <table  border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>ville</th>
                <th>etoile</th>
                <th>prix_nuit</th>
                <th>description</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($hotels as $hotel): ?>
    <tr>
        <td><?= htmlspecialchars($hotel['id']); ?></td>
        <td><?= htmlspecialchars($hotel['nom']); ?></td>
        <td><?= htmlspecialchars($hotel['ville']); ?></td>
        <td><?= htmlspecialchars($hotel['etoile']); ?></td>
        <td><?= htmlspecialchars($hotel['prix_nuit']); ?></td>
        <td><?= htmlspecialchars($hotel['description']); ?></td>
    </tr>
<?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>