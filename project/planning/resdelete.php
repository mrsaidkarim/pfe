<?php
session_start();
require '../connection.php'; 
// Récupérer l'identifiant de la réservation à supprimer depuis la requête POST
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
        // Préparer la requête de suppression
        $deleteqr = "DELETE FROM Reservation WHERE IdReservation = :reservationId";
        $stmt = $pdo->prepare($deleteqr);
        $stmt->bindParam(':reservationId', $reservationId);

        // Exécuter la requête de suppression
        if ($stmt->execute()) {
            // La réservation a été supprimée avec succès
            $data = array('status' => true, 'msg' => 'La réservation a été supprimée avec succès.');
        } else {
            // La suppression de la réservation a échoué
            $errorInfo = $stmt->errorInfo();
            $data = array('status' => false, 'msg' => 'La suppression de la réservation a échoué.'.$errorInfo[2]);
        }
    }
    else{
        $data = array('status' => false, 'msg' => 'vous ne pouvez pas supprimer cette réservation');
    }
} catch (PDOException $e) {
    $errorInfo = $stmt->errorInfo();
    $data = array('status' => false, 'msg' => 'Erreur lors de la suppression de la réservation : '.$e->getMessage(). ' Erreur SQL : '.$errorInfo[2]);
}
echo json_encode($data);
?>