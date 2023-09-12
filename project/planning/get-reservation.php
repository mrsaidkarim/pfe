<?php

session_start();
require "../connection.php";

// Récupérer l'identifiant de réservation depuis la requête
$reservationId = $_POST['reservation_id'];
// Récupérer l'identifiant du Médecin connecté
$id = $_SESSION['id'];
try {
    $check = "SELECT IdMedecin from Reservation WHERE IdReservation = :IdReservation";
    $stmt = $pdo->prepare($check);
    $stmt->bindParam(':IdReservation', $reservationId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['IdMedecin'] == $id){  
        $stmt = $pdo->prepare("SELECT DateDébutDoperation, DateFinDoperation, Observation ,IdPatient FROM Reservation WHERE IdReservation = :reservationId");
        $stmt->bindParam(':reservationId', $reservationId);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $data_row = $stmt->fetch(PDO::FETCH_ASSOC);
            $data_arr = array();
            $data_arr['DateDébutDoperation'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_row['DateDébutDoperation'])->format('Y-m-d\TH:i:s');
            $data_arr['DateFinDoperation'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_row['DateFinDoperation'])->format('Y-m-d\TH:i:s');
            $data_arr['Observation'] = $data_row['Observation'];
            $data_arr['IdPatient'] = $data_row['IdPatient'];
            $data = array(
                'status' => true,
                'msg' => 'successfully!',
                'data' => $data_arr
            );
        } else {
            $data = array(
                'status' => false,
                'msg' => 'La récupération des détails de la réservation a échoué.'
            );
        }
    }
    else{
        $data = array('status' => false, 'msg' => 'vous ne pouvez pas modifier cette réservation');
    }
} catch (PDOException $e) {
    $errorInfo = $pdo->errorInfo();
    $data = array(
        'status' => false,
        'msg' => 'Erreur lors de la récupération des détails de la réservation : ' . $e->getMessage() . ' Erreur SQL : ' . $errorInfo[2]
    );
}

echo json_encode($data);
?>