<?php
    require '../connection.php'; 
    session_start()  ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning</title>
    <!-- CSS for full calender -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for full calender -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- fontawesome script -->
    <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Dongle:wght@700&family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- main css file -->
    <link rel="stylesheet" href="../css/index.css">
 </head>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#">
                        <i class="fa-sharp fa-solid fa-registered"></i>
                        <span>eserve</span>
                    </a>
                </li>
                <li>
                    <a class = "active" href="planning.php">
                        <i class="fa-regular fa-chart-bar fa-fw"></i>
                        <span>Planning</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="head">
                <div class="menu">
                    <i class="fas fa-bars"></i>
                </div>
                
                <div class="user">
                <div class="user-info "> 
                 <img src="../images/usricon.png" id="usericon" alt="image">
                 <h3 style="color:#ffff; font-size:19px">médecin</h3>
                </div>
                </div>
                <div class="submenu-wrap">
                    <div class="submenu">
                    
                        <a href="../profil.php" class="submenu-link">
                            <p>profil</p>
                           
                        </a>
                        <hr>
                        <a href="../deconnexion.php" class="submenu-link">
                            <p>Se déconnecter</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="infos">
                <div id="calendar" style="margin: 35px;"></div>
                <!-- Start popup dialog box -->
                <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Ajouter une réservation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="start_date">DateDébutDoperation</label>
                                                <input type="datetime-local" name="start_date" id="start_date" class="form-control" placeholder="Enter DateDébutDoperation" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="end_date">DateFinDoperation</label>
                                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" placeholder="Enter DateFinDoperation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="observation">Observation</label>
                                                <textarea name="observation" id="observation" class="form-control" placeholder="Enter Observation" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Patient:</label>
                                                <select id="patientSelect" class="form-select" aria-label="Default select example" style="width: 100%;" value="patient">
                                                <!--<option selected>Patient</option>-->
                                                    <?php 
                                                        $qr = "SELECT * FROM Patient";
                                                        $stmt = $pdo->prepare($qr);
                                                        $stmt->execute();
                                                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($rows as $row) {
                                                            //$selected = ($row['IdPatient'] == $data_row['IdPatient']) ? 'selected' : '';
                                                            echo "<option value='" . $row['IdPatient'] . "'" . ">" . $row['NomPatient'] . "</option>";
                                                            //echo "<option>".$row['NomPatient']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="save_event()" id="save" data-id="">Réserver</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End popup dialog box -->
                <!-- Event Details Modal !-->
                <div class="modal fade" id="event-details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-0">
                            <div class="modal-header rounded-0">
                                <h5 class="modal-title">les détailles de réservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body rounded-0">
                                <div class="container-fluid">
                                    <dl>
                                        <dt class="text-muted">Id de Réservation:</dt>
                                        <dd id="idreservation" class="fw-bold fs-4"></dd>
                                        <dt class="text-muted">Observation:</dt>
                                        <dd id="observation" class=""></dd>
                                        <dt class="text-muted">de: <dd id="debut" class=""></dd></dt>
                                        <dt class="text-muted">à: <dd id="fin" class=""></dd></dt>
                                        <dt class="text-muted">Medecin: <dd id="medecin" class=""></dd></dt>
                                        <dt class="text-muted">NumSalle: <dd id="numsalle" class=""></dd></dt>
                                        <dt class="text-muted">Patient: <dd id="patient" class=""></dd></dt>
                                    </dl>
                                </div>
                            </div>
                            <div class="modal-footer rounded-0">
                                <div class="text-end">
                                    <button type="button" class="btn btn-primary btn-sm rounded-0 mr-1" id="edit" data-id="">Modifier</button>
                                    <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Event Details Modal -->
            </div>
    </div>
    <script src="../js/main.js"></script>
</body>

<script>

$(document).ready(function() {
  // Fermer la modal de détails lorsque le bouton de fermeture est cliqué
  $('#event-details-modal .btn-close').on('click', function() {
    $('#event-details-modal').modal('hide');
  });

  function display_events() {
    $.ajax({
      url: 'resdisplay.php',
      dataType: 'json',
      success: function(response) {
        if (response.status) {
          var reservations = [];
          $.each(response.data, function(key, reservation) {
            reservations.push({
              title: reservation.IdReservation,
              start: reservation.Debut,
              end: reservation.Fin,
              obs: reservation.Observation,
              NomMedecin: reservation.NomMedecin,
              numsalle: reservation.NumSalle,
              NomPatient: reservation.NomPatient,
              color: reservation.color
            });
          });
          var calendar = $('#calendar').fullCalendar({
            defaultView: 'month',
            timeZone: 'local',
            editable: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
              $('#start_date').val(moment(start).format('YYYY-MM-DD H:i:s'));
              $('#end_date').val(moment(end).format('YYYY-MM-DD H:i:s'));
              $('#event_entry_modal').modal('show');
            },
            eventClick: function(reservation, jsEvent, view) {
              $('#event-details-modal #idreservation').text(reservation.title);
              $('#event-details-modal #debut').text(reservation.start.format());
              $('#event-details-modal #fin').text(reservation.end.format());
              $('#event-details-modal #observation').text(reservation.obs);
              $('#event-details-modal #medecin').text(reservation.NomMedecin);
              $('#event-details-modal #numsalle').text(reservation.numsalle);
              $('#event-details-modal #patient').text(reservation.NomPatient);
              $('#event-details-modal #edit').attr('data-id', reservation.title);
              $('#event-details-modal #delete').attr('data-id', reservation.title);
              $('#event-details-modal').modal('show');
            },
            events: reservations
          });
        } else {
          console.error(response.msg);
        }
      },
      error: function(xhr, status) {
        console.error(status);
      }
    });
  }

  // Appel à la fonction pour afficher les événements
  display_events();
});

function save_event() {
    var DateDébutDoperation = $("#start_date").val();
    var DateFinDoperation = $("#end_date").val();
    var Observation = $("#observation").val();
    var ReservationId = $('#save').attr("data-id");
    //var NomPatient = $("#patientSelect").val();
    var patientSelect = document.getElementById("patientSelect");
    var NomPatient = patientSelect.options[patientSelect.selectedIndex].text;
    if (DateDébutDoperation == "" || DateFinDoperation == "" || Observation == "" || NomPatient === "") { 
        alert("Veuillez entrer tous les détails requis.");
        return false;
    }
    var startDate = new Date(document.getElementById('start_date').value);
    var endDate = new Date(document.getElementById('end_date').value);
    var currentDate = new Date();
    if (startDate < currentDate) {
        alert('La date de début ne peut pas être antérieure à la date actuelle.');
        return false;
    }
    if (endDate < startDate) {
        alert('La date de fin ne peut pas être antérieure à la date de début.');
        return false;
    }
    $.ajax({
    url: "check_availability.php",
    type: "POST",
    dataType: "json",
    data: {
      Observation: Observation,
      DateDébutDoperation: DateDébutDoperation,
      DateFinDoperation: DateFinDoperation,
      IdReservation: ReservationId
    },
    success: function (response) {
      if (response.available) {
        // Room is available, proceed with saving the reservation
        saveReservation(response.roomNum);
      } else {
        // Room is already booked during the selected time period
        alert("Il n'y a pas de salle disponible.");
      }
    },
    error: function (xhr, status) {
      console.error("Erreur lors de la vérification de la disponibilité de la salle:", status);
      alert("Une erreur s'est produite lors de la vérification de la disponibilité de la salle.");
    }
  });

  return false;
}

function saveReservation(num_salle) {
  var DateDébutDoperation = $("#start_date").val();
  var DateFinDoperation = $("#end_date").val();
  var Observation = $("#observation").val();
  var ReservationId = $('#save').attr("data-id");
  //var NomPatient = $("#patientSelect").val();
  var patientSelect = document.getElementById("patientSelect");
  var NomPatient = patientSelect.options[patientSelect.selectedIndex].text;

  if (DateDébutDoperation == "" || DateFinDoperation == "" || Observation == "" || NomPatient == "") {
    alert("Veuillez entrer tous les détails requis.");
    return false;
  }

  $.ajax({
    url: "ressave.php",
    type: "POST",
    dataType: "json",
    data: {
      DateDébutDoperation: DateDébutDoperation,
      DateFinDoperation: DateFinDoperation,
      Observation: Observation,
      NomPatient: NomPatient,
      num_salle: num_salle,
      IdReservation: ReservationId
    },
    success: function (response) {
      $('#event_entry_modal').modal('hide');
      if (response.status == true) {
        alert(response.msg);
        location.reload();
      } else {
        alert(response.msg);
      }
    },
    error: function (xhr, status) {
      console.log('Erreur Ajax : ' + xhr.statusText);
      alert("Une erreur s'est produite lors de la sauvegarde de la réservation.");
    }
  });

  return false;
}

var editButton = document.getElementById("edit");
// Edit Reservation Button Clicked
editButton.addEventListener("click", function() {
    // Récupérer l'identifiant de la réservation à éditer
    var reservationId = editButton.getAttribute("data-id");
    //populateEditReservationModal(reservationId);
    // Envoyer une requête AJAX pour récupérer les données de la réservation à éditer
    $.ajax({
        url: 'get-reservation.php',
        type: 'POST',
        data: {
            reservation_id: reservationId
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $('#event-details-modal').modal('hide');
                $('#event_entry_modal #start_date').val(moment(response.data.DateDébutDoperation).format('YYYY-MM-DDTHH:mm:ss'));
                $('#event_entry_modal #end_date').val(moment(response.data.DateFinDoperation).format('YYYY-MM-DDTHH:mm:ss'));
                $('#event_entry_modal #observation').val(response.data.Observation);
                // Set the selected patient in the dropdown
                var patientSelect = document.getElementById("patientSelect");
                for (var i = 0; i < patientSelect.options.length; i++) {
                    var option = patientSelect.options[i];
                    if (option.value == response.data.IdPatient) {
                        option.selected = true;
                    }
                }

                // Afficher la fenêtre modale d'édition
                $('#event_entry_modal').modal('show');
                $('#event_entry_modal #save').attr('data-id', reservationId);
            } else {
                console.error(response.msg);
                alert(response.msg);
            }
        },
        error: function(xhr, status) {
            console.error(status);
            alert(response.msg);
        }
    })
});
// Delete Reservation Button Clicked
var deleteButton = document.getElementById("delete");
deleteButton.addEventListener("click", function() {
    var reservationId = deleteButton.getAttribute("data-id");
    // Demander confirmation à l'utilisateur avant de supprimer la réservation
    if(confirm("Êtes-vous sûr de vouloir supprimer cette réservation?")) {
        // Envoyer une requête AJAX pour supprimer la réservation
        $.ajax({
            url: 'resdelete.php',
            type: 'POST',
            data: {
                reservation_id: reservationId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    // Actualiser la liste des événements après suppression
                    //display_events();
                    alert(response.msg);
                    location.reload();
                } else {
                    alert(response.msg);
                    console.error(response.msg);
                }
            },
            error: function(xhr, status) {
                alert(response.msg);
                console.error(status);
            }
        });
    }
});

</script>
</html>
