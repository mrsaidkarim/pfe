<?php

require '../connection.php'; 

$DateDébutDoperation = $_POST['DateDébutDoperation'];
$DateFinDoperation = $_POST['DateFinDoperation'];
$IdReservation = $_POST['IdReservation'];

$startDate = date('Y-m-d H:i:s', strtotime($DateDébutDoperation));
$endDate = date('Y-m-d H:i:s', strtotime($DateFinDoperation));

$equipments = $_POST['Observation']; // Chaîne d'équipements séparés par des virgules ou des espaces
$equipmentsArray = preg_split("/[\s,]+/", $equipments); // Diviser la chaîne en un tableau d'équipements
$roomAvailable = false;
$availableRoomNum = "";
try {

    $query = "SELECT NumSalle FROM SalleOperation WHERE ";
    $conditions = array();

    foreach ($equipmentsArray as $index => $equipment) {
        $paramName = ':equipment' . $index;
        $conditions[] = "Equipement LIKE " . $paramName;
    }
    $query .= implode(" AND ", $conditions);
    if(empty($IdReservation)){
        $query .= " AND NumSalle NOT IN (
            SELECT NumSalle FROM Reservation 
            WHERE DateDébutDoperation < :endDate AND DateFinDoperation > :startDate) LIMIT 1";
    }
    else{
        $query .= " AND NumSalle NOT IN (
            SELECT NumSalle FROM Reservation 
            WHERE DateDébutDoperation < :endDate AND DateFinDoperation > :startDate AND IdReservation != :ID) LIMIT 1";
    }
    
    $stmt = $pdo->prepare($query);

    foreach ($equipmentsArray as $index => $equipment) {
        $paramName = ':equipment' . $index;
        $stmt->bindValue($paramName, '%' . $equipment . '%');
    }
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    if(!empty($IdReservation))
        $stmt->bindParam(':ID', $IdReservation);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if ($row) {
        $roomAvailable = true;
        $availableRoomNum = $row['NumSalle'];
    }
} catch (PDOException $e) {
    // Handle any database errors
    echo "Error: " . $e->getMessage();
}
// Prepare the response as JSON
$response = array('available' => $roomAvailable, 'roomNum' => $availableRoomNum);
echo json_encode($response);

?>
