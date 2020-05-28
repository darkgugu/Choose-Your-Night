USE `mydb`;

DELETE FROM ecoles;
ALTER TABLE ecoles AUTO_INCREMENT =0;
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien) VALUES ('ESIEA Paris', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '0111111111', 'Sophie Galinat', 'Ingénieur', '15', 'esiea.fr');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien) VALUES ('ESIEA Laval', 'XX Rue des Docteurs Calmette et Guérin, 53XXX Laval', '0222222222', 'Sophie Galinat', 'Ingénieur', '15', 'esiea.fr');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien) VALUES ('Ecole TEST', '86 Rue Olivier de Serres, 75015 Paris', '0333333333', 'Jean Durand', 'Infirmière', '85', 'infirmiere.fr');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien) VALUES ('Fac TEST', '28 Rue Rosenwald, 75015 Paris', '0444444444', 'Joris Dupond', 'Art Plastiques', '75', 'art.fr');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien) VALUES ('Institut TEST', '4 Rue Eugene Gibez, 75015', '0555555555', 'Jahel Dinosaure', 'Informatique', '5', 'informatique.fr');

DELETE FROM associations;
ALTER TABLE associations AUTO_INCREMENT =0;
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('BDE Madness', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '5', 'bdem.fr');
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('BDE Osiris', 'XX Rue des Docteurs Calmette et Guérin', '5', 'bdeo.fr');
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('Association Internationale ESIEA', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '5', 'international.fr');
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('LABEL', 'XX Rue des Docteurs Calmette et Guérin', '5', 'label.fr');
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('BDS Ecole TEST', 'xxxxxxxxxxxxxxxx', '5', 'bds.fr');
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('BDA Fac TEST', 'xxxxxxxxxxxxxxxx', '5', 'bda.fr');
INSERT INTO associations (Nom, Adresse, Note, Lien) VALUES ('Radio Institut TEST', 'xxxxxxxxxxxxxx', '5', 'radio.fr');

DELETE FROM ecoles_has_associations;
ALTER TABLE ecoles_has_associations AUTO_INCREMENT =0;
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('1', '1');
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('2', '2');
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('1', '3');
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('2', '4');
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('3', '5');
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('4', '6');
INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ('5', '7');

DELETE FROM soirees;
ALTER TABLE soirees AUTO_INCREMENT =0;
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes) VALUES ('Soirée N°1', '1 Rue Mozart','2020-06-01', 'Alice In Wonderland', '15', '../Images/Affiches/affiche_soiree1.jpg', '100', 'Billeterie.link.fr', 'Bar', 'DJ 1', 'dj.link.fr', 'A venir', 'Lizard Lounge', '23h', '05h', '100');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes) VALUES ('Soirée N°2', '2 Rue Mozart','2020-06-02', 'Alice In Wonderland', '25', '../Images/Affiches/affiche_soiree2.jpg', '200', 'Billeterie.link.fr', 'Bar', 'DJ 2', 'dj.link.fr', 'A venir', 'Shoteria', '23h', '05h', '200');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes) VALUES ('Soirée N°3', '3 Rue Mozart','2020-06-03', 'Alice In Wonderland', '35', '../Images/Affiches/affiche_soiree3.jpg', '300', 'Billeterie.link.fr', 'Salle', 'DJ 3', 'dj.link.fr', 'A venir', 'Salle Wagram', '23h', '05h', '300');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes) VALUES ('Soirée N°4', '4 Rue Mozart','2020-06-04', 'Alice In Wonderland', '45', '../Images/Affiches/affiche_soiree4.jpg', '400', 'Billeterie.link.fr', 'Salle', 'DJ 4', 'dj.link.fr', 'A venir', 'Le Life Paris', '23h', '05h', '400');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes) VALUES ('Soirée N°5', '5 Rue Mozart','2020-06-05', 'Alice In Wonderland', '55', '../Images/Affiches/affiche_soiree5.jpg', '500', 'Billeterie.link.fr', 'Salle', 'DJ 5', 'dj.link.fr', 'A venir', 'My Boat', '23h', '05h', '500');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes) VALUES ('Soirée N°6', '6 Rue Mozart','2020-06-06', 'Alice In Wonderland', '65', '../Images/Affiches/affiche_soiree6.jpg', '600', 'Billeterie.link.fr', 'Salle', 'DJ 6', 'dj.link.fr', 'A venir', 'Le Carré Montparnasse', '23h', '05h', '600');

DELETE FROM Organisateurs;
ALTER TABLE Organisateurs AUTO_INCREMENT =0;
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('1', '1');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('1', '2');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('2', '3');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('2', '4');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('3', '5');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('3', '6');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('3', '7');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('4', '5');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('5', '6');
INSERT INTO Organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ('6', '7');

