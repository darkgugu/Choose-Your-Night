USE `mydb`;

DELETE FROM ecoles;
ALTER TABLE ecoles AUTO_INCREMENT =0;
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable) VALUES ('ESIEA Paris', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '0111111111', 'Sophie Galinat');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable) VALUES ('ESIEA Laval', 'XX Rue des Docteurs Calmette et Guérin, 53XXX Laval', '0222222222', 'Sophie Galinat');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable) VALUES ('Ecole TEST', '86 Rue Olivier de Serres, 75015 Paris', '0333333333', 'Jean Durand');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable) VALUES ('Fac TEST', '28 Rue Rosenwald, 75015 Paris', '0444444444', 'Joris Dupond');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable) VALUES ('Institut TEST', '4 Rue Eugene Gibez, 75015', '0555555555', 'Jahel Dinosaure');

DELETE FROM associations;
ALTER TABLE associations AUTO_INCREMENT =0;
INSERT INTO associations (Nom, Adresse, Note) VALUES ('BDE Madness', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '5');
INSERT INTO associations (Nom, Adresse, Note) VALUES ('BDE Osiris', 'XX Rue des Docteurs Calmette et Guérin', '5');
INSERT INTO associations (Nom, Adresse, Note) VALUES ('Association Internationale ESIEA', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '5');
INSERT INTO associations (Nom, Adresse, Note) VALUES ('LABEL', 'XX Rue des Docteurs Calmette et Guérin', '5');
INSERT INTO associations (Nom, Adresse, Note) VALUES ('BDS Ecole TEST', 'xxxxxxxxxxxxxxxx', '5');
INSERT INTO associations (Nom, Adresse, Note) VALUES ('BDA Fac TEST', 'xxxxxxxxxxxxxxxx', '5');
INSERT INTO associations (Nom, Adresse, Note) VALUES ('Radio Institut TEST', 'xxxxxxxxxxxxxx', '5');

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
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Durée) VALUES ('Soirée N°1', '1 Rue Mozart','2020-06-01 23:00:00', 'Alice In Wonderland', '15', '../Images/Affiches/affiche_soiree1.jpg', '100', 'Billeterie.link.fr', 'Bar', 'DJ 1', 'dj.link.fr', 'A venir', '1');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Durée) VALUES ('Soirée N°2', '2 Rue Mozart','2020-06-02 23:00:00', 'Alice In Wonderland', '25', '../Images/Affiches/affiche_soiree2.jpg', '200', 'Billeterie.link.fr', 'Bar', 'DJ 2', 'dj.link.fr', 'A venir', '2');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Durée) VALUES ('Soirée N°3', '3 Rue Mozart','2020-06-03 23:00:00', 'Alice In Wonderland', '35', '../Images/Affiches/affiche_soiree3.jpg', '300', 'Billeterie.link.fr', 'Salle', 'DJ 3', 'dj.link.fr', 'A venir', '3');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Durée) VALUES ('Soirée N°4', '4 Rue Mozart','2020-06-04 23:00:00', 'Alice In Wonderland', '45', '../Images/Affiches/affiche_soiree4.jpg', '400', 'Billeterie.link.fr', 'Salle', 'DJ 4', 'dj.link.fr', 'A venir', '4');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Durée) VALUES ('Soirée N°5', '5 Rue Mozart','2020-06-05 23:00:00', 'Alice In Wonderland', '55', '../Images/Affiches/affiche_soiree5.jpg', '500', 'Billeterie.link.fr', 'Salle', 'DJ 5', 'dj.link.fr', 'A venir', '5');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Durée) VALUES ('Soirée N°6', '6 Rue Mozart','2020-06-06 23:00:00', 'Alice In Wonderland', '65', '../Images/Affiches/affiche_soiree6.jpg', '600', 'Billeterie.link.fr', 'Salle', 'DJ 6', 'dj.link.fr', 'A venir', '6');

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

