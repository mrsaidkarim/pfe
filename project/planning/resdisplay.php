

<?php
require '../connection.php'; 

$display_query = "SELECT r.IdReservation, r.DateDébutDoperation, r.DateFinDoperation, r.Observation, m.NomMedecin, r.NumSalle, p.NomPatient 
                  FROM Reservation r
                  JOIN Medecin m ON r.IdMedecin = m.IdMedecin
                  JOIN Patient p ON r.IdPatient = p.IdPatient";

$results = $pdo->query($display_query);
$count = $results->rowCount();

if ($count > 0) {
    $data_arr = array();
    $i = 1;

    while ($data_row = $results->fetch(PDO::FETCH_ASSOC)) {
        $data_arr[$i]['IdReservation'] = $data_row['IdReservation'];
        $data_arr[$i]['Debut'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_row['DateDébutDoperation'])->format('Y-m-d\TH:i:s');
        $data_arr[$i]['Fin'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_row['DateFinDoperation'])->format('Y-m-d\TH:i:s');
        $data_arr[$i]['Observation'] = $data_row['Observation'];
        $data_arr[$i]['NomMedecin'] = $data_row['NomMedecin'];
        $data_arr[$i]['NumSalle'] = $data_row['NumSalle'];
        $data_arr[$i]['NomPatient'] = $data_row['NomPatient'];
        $data_arr[$i]['color'] = '#2f787a'; // main-color
        $i++;
    }

    $data = array(
        'status' => true,
        'msg' => 'successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error!'				
    );
}

echo json_encode($data);
?>
