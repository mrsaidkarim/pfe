CREATE TABLE Patient (
    IdPatient INT AUTO_INCREMENT NOT NULL,
    NomPatient VARCHAR(50) NOT NULL,
    PrenomPatient VARCHAR(50) NOT NULL,
    TelePatient INT NOT NULL,
    EmailPatient VARCHAR(50) NOT NULL,
    AdressePatient VARCHAR(50) NOT NULL,
    GroupeSanguin VARCHAR(50) NOT NULL,
    Sexe VARCHAR(50) NOT NULL,
    AgePatient INT NOT NULL,
    Image BLOB,
    PRIMARY KEY (IdPatient)
);

CREATE TABLE SalleOperation (
    NumSalle INT NOT NULL CHECK(NumSalle > 0),
    SpecialiteSalle VARCHAR(50) NOT NULL,
    Loc VARCHAR(50) NOT NULL,
    Equipement VARCHAR(150) NOT NULL,
    PRIMARY KEY (NumSalle)
);

CREATE TABLE Utilisateur (
    Email VARCHAR(50) NOT NULL,
    MotDePasse VARCHAR(50) NOT NULL,
    Roles VARCHAR(50) NOT NULL, 
    PRIMARY KEY (Email)
);

CREATE TABLE Medecin (
    IdMedecin INT AUTO_INCREMENT NOT NULL,
    NomMedecin VARCHAR(50) NOT NULL,
    PrenomMedecin VARCHAR(50) NOT NULL,
    TeleMedecin INT NOT NULL,
    Specialite VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    PRIMARY KEY (IdMedecin),
    FOREIGN KEY (Email) REFERENCES Utilisateur (Email)
);

CREATE TABLE Admin (
    IdAdmin INT AUTO_INCREMENT NOT NULL,
    NomAdmin VARCHAR(50) NOT NULL,
    PrenomAdmin VARCHAR(50) NOT NULL,
    TeleAdmin INT NOT NULL,
    Email VARCHAR(50) NOT NULL,
    PRIMARY KEY (IdAdmin),
    FOREIGN KEY (Email) REFERENCES Utilisateur (Email)
);

CREATE TABLE Reservation (
    IdReservation INT AUTO_INCREMENT NOT NULL,
    DateDébutDoperation DATETIME NOT NULL,
    DateFinDoperation DATETIME NOT NULL,
    Observation VARCHAR(150) NOT NULL,
    IdMedecin INT NOT NULL,
    NumSalle Int NOT NULL,
    IdPatient INT NOT NULL,
    PRIMARY KEY (IdReservation),
    FOREIGN KEY (IdMedecin) REFERENCES Medecin (IdMedecin),
    FOREIGN KEY (NumSalle) REFERENCES SalleOperation (NumSalle),
    FOREIGN KEY (IdPatient) REFERENCES Patient (IdPatient) 
);
CREATE TABLE Maladie (
    IdMaladie INT AUTO_INCREMENT NOT NULL,
    NomMaladie  VARCHAR(50) NOT NULL,
    DateMaladie DATE NOT NULL,
    IdMedecin INT NOT NULL,
    IdPatient INT NOT NULL,
    PRIMARY KEY (IdMaladie),
    FOREIGN KEY (IdPatient) REFERENCES Patient (IdPatient),
    FOREIGN KEY (IdMedecin) REFERENCES Medecin (IdMedecin)
);
CREATE TABLE Analyse (
    IdAnalyse INT AUTO_INCREMENT NOT NULL,
    NomAnalyse  VARCHAR(50) NOT NULL,
    DateAnalyse DATE NOT NULL,
    Resultat VARCHAR(150) NOT NULL,
    PRIMARY KEY (IdAnalyse)
);
CREATE TABLE Medicament (
    IdMedicament INT AUTO_INCREMENT NOT NULL,
    NomMedicament  VARCHAR(50) NOT NULL,
    Traitement VARCHAR(150) NOT NULL,
    DateMedicament DATE NOT NULL,
    PRIMARY KEY (IdMedicament)
);
CREATE TABLE MaladieMedicament (
    IdMaladie INT NOT NULL,
    IdMedicament INT NOT NULL,
    PRIMARY KEY (IdMaladie, IdMedicament),
    FOREIGN KEY (IdMedicament) REFERENCES Medicament (IdMedicament),
    FOREIGN KEY (IdMaladie) REFERENCES Maladie (IdMaladie)
);
CREATE TABLE MaladieAnalyse (
    IdMaladie INT NOT NULL,
    IdAnalyse INT NOT NULL,
    PRIMARY KEY (IdMaladie, IdAnalyse),
    FOREIGN KEY (IdMaladie) REFERENCES Maladie (IdMaladie),
    FOREIGN KEY (IdAnalyse) REFERENCES Analyse (IdAnalyse)
);