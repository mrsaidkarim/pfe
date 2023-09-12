<?php 
    session_start(); // Démarrage de la session
    require_once 'connection.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        // Patch XSS
    
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']);
        $email = strtolower($email); // email transformé en minuscule
        
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $pdo->prepare('SELECT Email, MotDePasse,Roles FROM Utilisateur WHERE Email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                if(password_verify($password, password_hash($data['MotDePasse'],PASSWORD_DEFAULT)))
                {
                    //session_regenerate_id(true); // Generate a secure session ID
                    $_SESSION['user'] = session_id();
                    $_SESSION['email'] = $email;
                    if($data['Roles'] == "User"){
                        $qr = "SELECT IdMedecin from Medecin where Email = :em";
                        $stmt = $pdo->prepare($qr);
                        $stmt->bindParam(':em', $email);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $id = $row['IdMedecin'];
                        $_SESSION['id'] = $id;
                        header('Location: planning/planning.php'); 
                        die();
                    }
                    else{
                        header('Location: dashboard.php');               
                        die();
                    }
                        
                }
                else
                {
                    header('Location: login.php?login_err=password'); die(); 
                }
                
            }else{ header('Location: login.php?login_err=email'); die(); }
        } else {header('Location: login.php');die();}
    }else{ header('Location: login.php'); die();} // si le formulaire est envoyé sans aucune données