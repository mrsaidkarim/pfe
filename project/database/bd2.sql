-- Insert sample data into Patient table
INSERT INTO Patient (IdPatient, NomPatient, PrenomPatient, TelePatient, EmailPatient, AdressePatient, GroupeSanguin, Sexe, AgePatient, Image)
VALUES
    (1, 'Benbrahim', 'Fatima', 0612345678, 'fatima.benbrahim@gmail.com', '10 Rue Mohammed Ali, Casablanca', 'A+', 'Female', 28, NULL),
    (2, 'El Khattabi', 'Ahmed', 0676543210, 'ahmed.elkhattabi@gmail.com', '22 Avenue des FAR, Rabat', 'B-', 'Male', 35, NULL),
    (3, 'Hassani', 'Laila', 0734567890, 'laila.hassani@gmail.com', '5 Rue Ibn Sina, Marrakech', 'O+', 'Female', 42, NULL),
    (4, 'Zouhairi', 'Youssef', 0676543210, 'youssef.zouhairi@gmail.com', '8 Avenue Mohammed VI, Agadir', 'AB-', 'Male', 52, NULL),
    (5, 'Amrani', 'Leila', 0738539817, 'leila.amrani@gmail.com', '15 Rue Omar Ibn Khattab, Fes', 'A-', 'Female', 30, NULL),
    (6, 'Bouhaddou', 'Karim', 0643370414, 'karim.bouhaddou@gmail.com', '12 Avenue Hassan II, Tangier', 'B+', 'Male', 26, NULL),
    (7, 'El Harrak', 'Samira', 0676543370, 'samira.elharrak@gmail.com', '7 Rue Abdelkrim El Khattabi, Casablanca', 'O-', 'Female', 38, NULL);


-- Insert sample data into SalleOperation table
INSERT INTO SalleOperation (NumSalle, SpecialiteSalle, Loc, Equipement)
VALUES
    (1, 'Cardiologie', 'Étage 2, Aile Est', 'ECG, Moniteur cardiaque, Ventilateur'),
    (2, 'Cardiologie', 'Étage 4, Aile Ouest', 'ECG, Moniteur cardiaque, Ventilateur'),
    (3, 'Esthétique', 'Étage 3, Aile Nord', 'Table d''opération esthétique, Matériel de liposuccion'),
    (4, 'Esthétique', 'Étage 1, Aile Sud', 'Table d''opération esthétique, Matériel de chirurgie plastique'),
    (5, 'Gynécologie', 'Bloc opératoire A', 'Colposcope, Échographe'),
    (6, 'Gynécologie', 'Bloc opératoire B', 'Colposcope, Échographe'),
    (7, 'Neurologie', 'Étage 5, Aile Est', 'IRM, Électroencéphalogramme'),
    (8, 'Neurologie', 'Étage 2, Aile Ouest', 'IRM, Électroencéphalogramme'),
    (9, 'Maxillo-Facial', 'Étage 4, Aile Nord', 'Table d''opération maxillo-faciale, Matériel de reconstruction faciale'),
    (10, 'Maxillo-Facial', 'Étage 3, Aile Sud', 'Table d''opération maxillo-faciale, Matériel de chirurgie buccale'),
    (11, 'Néphrologie', 'Bloc opératoire C', 'Équipement d''hémodialyse, Matériel de transplantation rénale'),
    (12, 'Néphrologie', 'Bloc opératoire D', 'Équipement d''hémodialyse, Matériel de biopsie rénale'),
    (13, 'Ophtalmologie', 'Étage 1, Aile Est', 'Lampe à fente, Phacoémulsification'),
    (14, 'Ophtalmologie', 'Étage 2, Aile Ouest', 'Lampe à fente, Phacoémulsification');

-- Insert sample data into Utilisateur table
INSERT INTO Utilisateur (Email, MotDePasse, Roles)
VALUES
    ('admin1@gmail.com', 'admin111', 'Admin'),
    ('admin2@gmail.com', 'admin222', 'Admin'),
    ('Karim@hotmail.com', 'DrKarim', 'User'),
    ('Mohammed@gmail.com', 'DrMohammed', 'User'),
    ('Samira@gmail.com', 'DrSamira', 'User'),
    ('Nadia@gmail.com', 'DrNadia', 'User'),
    ('Rachid@hotmail.com', 'DrRachid', 'User'),
    ('Loubna@hotmail.com', 'DrLoubna', 'User'),
    ('Oussama@gmail.com', 'DrOussama', 'User'),
    ('Khalid@gmail.com', 'DrKhalid', 'User');

-- Insert sample data into Medecin table
INSERT INTO Medecin (IdMedecin, NomMedecin, PrenomMedecin, TeleMedecin, Specialite, Email)
VALUES 
    (1, 'El Mounir', 'Karim', 0689012345, 'Cardiologie', 'Karim@hotmail.com'),
    (2, 'Omri', 'Mohammed', 0645678901, 'Esthétique', 'Mohammed@gmail.com'),
    (3, 'Fassi', 'Samira', 0632109876, 'Ophtalmologie', 'Samira@gmail.com'),
    (4, 'Mansouri', 'Nadia', 0612345678, 'Neurologie', 'Nadia@gmail.com'),
    (5, 'El Haddadi', 'Rachid', 0690123456, 'Gynécologie', 'Rachid@hotmail.com'),
    (6, 'Amiri', 'Loubna', 0678901234, 'Cardiologie', 'Loubna@hotmail.com'),
    (7, 'El Fakir', 'Oussama', 0656789012, 'Néphrologie', 'Oussama@gmail.com'),
    (8, 'El hilali', 'Khalid', 0612345678, 'Neurologie', 'Khalid@gmail.com');

-- Insert sample data into Admin table
INSERT INTO Admin (IdAdmin, NomAdmin, PrenomAdmin, TeleAdmin, Email)
VALUES
    (1, 'Rafiki', 'Mohammed', 0652311559, 'admin1@gmail.com'),
    (2, 'El amri', 'Youssef', 0763124561, 'admin2@gmail.com');

-- Insert sample data into Reservation table
INSERT INTO Reservation (IdReservation, DateDébutDoperation, DateFinDoperation, Observation, IdMedecin, NumSalle, IdPatient)
VALUES 
    (1, '2023-06-2 10:15:00', '2023-06-2 11:45:00', 'ECG, Moniteur cardiaque, Ventilateur', 6, 2, 5),
    (2, '2023-06-6 14:30:00', '2023-06-6 17:15:00', 'IRM, Électroencéphalogramme', 4, 8, 4),
    (3, '2023-06-10 08:00:00', '2023-06-10 10:45:00', 'Matériel de transplantation rénale', 7, 11, 2),
    (4, '2023-06-25 10:00:00', '2023-06-25 12:00:00', 'Moniteur cardiaque, Ventilateur', 1, 2, 1),
    (5, '2023-06-25 14:00:00', '2023-06-25 16:00:00', 'Lampe à fente, Phacoémulsification', 3, 14, 3);

-- Inserting data into the Maladie table
INSERT INTO Maladie (IdMaladie, NomMaladie, DateMaladie, IdMedecin, IdPatient)
VALUES 
    (1, 'Hypertension artérielle', '2023-06-01', 6, 1),
    (2, 'Angine de poitrine', '2023-06-03', 1, 5),
    (3, 'Rhinoplastie', '2023-01-10', 2, 6),
    (4, 'Liposuccion', '2022-07-21', 2, 5),
    (5, 'Cataracte', '2023-05-18', 3, 3),
    (6, 'Migraine', '2023-04-07', 4, 4),
    (7, 'Sclérose en plaques', '2023-05-30', 8, 1),
    (8, 'Endométriose', '2022-09-15', 5, 7);

-- Inserting data into the Analyse table
INSERT INTO Analyse (IdAnalyse, NomAnalyse, DateAnalyse, Resultat)
VALUES
    (1, 'Tension artérielle', '2022-03-15', '140/90 mmHg'),
    (2, 'Bilan lipidique', '2022-03-18', 'Cholestérol total : 220 mg/dL, LDL : 150 mg/dL'),
    (3, 'Electrocardiogramme (ECG)', '2021-09-02', 'Anomalies détectées'),
    (4, 'Dosage des marqueurs cardiaques', '2021-09-05', 'Niveaux élevés de troponine'),
    (5, 'Radiographie du nez', '2023-01-10', 'Déviation de la cloison nasale'),
    (6, 'Analyse des lipides', '2022-07-21', 'Niveaux élevés de graisses dans certaines zones'),
    (7, 'Examen de la vue', '2023-05-18', 'Présence de cataracte dans l''œil droit'),
    (8, 'IRM cérébrale', '2023-04-07', 'Anomalies détectées dans certaines zones cérébrales'),
    (9, 'Potentiels évoqués', '2023-05-30', 'Signes de dysfonctionnement du système nerveux'),
    (10, 'Échographie pelvienne', '2022-09-15', 'Présence de tissu endométrial en dehors de l''utérus');


-- Inserting data into the Medicament table
INSERT INTO Medicament (IdMedicament, NomMedicament, Traitement, DateMedicament)
VALUES 
    (1, 'Amlodipine', '1cp/j pendant 1 mois', '2022-03-15'),
    (2, 'Lisinopril', '1cp/j pendant 1 mois', '2022-03-18'),
    (3, 'Nitroglycérine', 'Utiliser selon les besoins', '2021-09-02'),
    (4, 'Aspirine', '1cp/j pour réduire le risque de caillot sanguin', '2021-09-05'),
    (5, 'Paracétamol', '1cp toutes les 6 heures pendant 5 jours', '2023-01-10'),
    (6, 'Ibuprofène', '1cp toutes les 8 heures pendant 7 jours', '2022-07-21'),
    (7, 'Collyre', '1 goutte dans l''œil affecté 3 fois par jour pendant 2 semaines', '2023-05-18'),
    (8, 'Sumatriptan', '1cp au début de la migraine, répéter après 2 heures si nécessaire', '2023-04-07'),
    (9, 'Interféron bêta', '1 injection tous les 2 jours pendant 1 mois', '2023-05-30'),
    (10, 'Levonorgestrel', '1cp/j pendant 3 mois', '2022-09-15');


-- Inserting data into the MaladieMedicament table
INSERT INTO MaladieMedicament (IdMaladie, IdMedicament)
VALUES 
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4),
    (3, 5),
    (4, 6),
    (5, 7),
    (6, 8),
    (7, 9),
    (8, 10);

-- Inserting data into the MaladieAnalyse table
INSERT INTO MaladieAnalyse (IdMaladie, IdAnalyse)
VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4),
    (3, 5),
    (4, 6),
    (5, 7),
    (6, 8),
    (7, 9),
    (8, 10);

