<?php                
session_start();

require '../connection.php'; 

$DateDébutDoperation = date('Y-m-d H:i:s', strtotime($_POST['DateDébutDoperation']));
$DateFinDoperation = date('Y-m-d H:i:s', strtotime($_POST['DateFinDoperation']));
$Observation = $_POST['Observation'];
$num_salle = $_POST['num_salle'];
$ReservationId = $_POST['IdReservation'];
$IdMedecin = $_SESSION['id'];//$_POST['IdMedecin'];


$NomPatient = $_POST['NomPatient'];
$qrp = "SELECT IdPatient from Patient where NomPatient = :nom";
$stmt = $pdo->prepare($qrp);
$stmt->bindParam(':nom', $NomPatient);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$IdPatient = $row['IdPatient'];
try {
    if(empty($ReservationId)){
        $qr = "INSERT INTO Reservation (DateDébutDoperation, DateFinDoperation, Observation, IdMedecin, IdPatient, NumSalle) VALUES ('$DateDébutDoperation', '$DateFinDoperation', :Observation, :IdMedecin, :IdPatient, :NumSalle)";
    
        $stmt = $pdo->prepare($qr);
        $stmt->bindParam(':Observation', $Observation);
        $stmt->bindParam(':IdMedecin', $IdMedecin);
        $stmt->bindParam(':IdPatient', $IdPatient);
        $stmt->bindParam(':NumSalle', $num_salle);

        if ($stmt->execute()) {
            $data = array('status' => true, 'msg' => 'Réservation ajoutée avec succès. (salle '.$num_salle.')');
        } else {
            $errorInfo = $stmt->errorInfo();
            $data = array('status' => false, 'msg' => 'Réservation non ajoutée. Erreur SQL : '.$errorInfo[2]);
        }
    } else {
        $sql = "UPDATE Reservation SET DateDébutDoperation = '$DateDébutDoperation', DateFinDoperation = '$DateFinDoperation', Observation = :Observation, IdPatient = :IdPatient, NumSalle = :NumSalle WHERE IdReservation = :ReservationId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Observation', $Observation);
        $stmt->bindParam(':IdPatient', $IdPatient);
        $stmt->bindParam(':ReservationId', $ReservationId);
        $stmt->bindParam(':NumSalle', $num_salle);

        if ($stmt->execute()) {
            $data = array('status' => true, 'msg' => 'Réservation mise à jour avec succès.');
        } else {
            $errorInfo = $stmt->errorInfo();
            $data = array('status' => false, 'msg' => 'Réservation non mise à jour. Erreur SQL : '.$ReservationId.'------'.$errorInfo[2]);
        }
    }
    
} catch (PDOException $e) {
    $errorInfo = $stmt->errorInfo();
    $data = array('status' => false, 'msg' => 'Erreur lors de l\'insertion ou de la mise à jour de la réservation :'.$ReservationId.'------'.$e->getMessage(). ' Erreur SQL : '.$errorInfo[2]);
}
echo json_encode($data);
?>
