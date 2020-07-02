USE `cyn`;

DELETE FROM ecoles;
ALTER TABLE ecoles AUTO_INCREMENT =0;
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien, statut) VALUES ('ESIEA Paris', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '0111111111', 'Sophie Galinat', 'Ingénieur', '15', 'esiea.fr', 'approved');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien, statut) VALUES ('ESIEA Laval', 'XX Rue des Docteurs Calmette et Guérin, 53XXX Laval', '0222222222', 'Sophie Galinat', 'Ingénieur', '15', 'esiea.fr', 'approved');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien, statut) VALUES ('Ecole TEST', '86 Rue Olivier de Serres, 75015 Paris', '0333333333', 'Jean Durand', 'Infirmière', '85', 'infirmiere.fr', 'approved');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien, statut) VALUES ('Fac TEST', '28 Rue Rosenwald, 75015 Paris', '0444444444', 'Joris Dupond', 'Art Plastiques', '75', 'art.fr', 'approved');
INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Ratio, Lien, statut) VALUES ('Institut TEST', '4 Rue Eugene Gibez, 75015', '0555555555', 'Jahel Dinosaure', 'Informatique', '5', 'informatique.fr', 'approved');

DELETE FROM associations;
ALTER TABLE associations AUTO_INCREMENT =0;
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('BDE Madness', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '5', 'bdem.fr', 'approved');
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('BDE Osiris', 'XX Rue des Docteurs Calmette et Guérin', '5', 'bdeo.fr', 'approved');
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('Association Internationale ESIEA', '74B Avenue Maurice Thorez, 94200 Ivry-sur-Seine', '5', 'international.fr', 'approved');
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('LABEL', 'XX Rue des Docteurs Calmette et Guérin', '5', 'label.fr', 'approved');
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('BDS Ecole TEST', 'xxxxxxxxxxxxxxxx', '5', 'bds.fr', 'approved');
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('BDA Fac TEST', 'xxxxxxxxxxxxxxxx', '5', 'bda.fr', 'approved');
INSERT INTO associations (Nom, Adresse, Note, Lien, statut) VALUES ('Radio Institut TEST', 'xxxxxxxxxxxxxx', '5', 'radio.fr', 'approved');

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
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes, statut, longitude, latitude) VALUES ('Soirée N°1', '18 rue du Bourg Tibourg','1 juillet', 'Alice In Wonderland', '15', '../Images/Affiches/affiche_soiree1.jpg', '100', 'Billeterie.link.fr', 'Bar', 'DJ 1', 'dj.link.fr', 'A venir', 'Lizard Lounge', '23h', '05h', '100', 'approved', '2.356341', '48.857439');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes, statut, longitude, latitude) VALUES ('Soirée N°2', '39 Rue de Lappe','2 juillet', 'Alice In Wonderland', '25', '../Images/Affiches/affiche_soiree2.jpg', '200', 'Billeterie.link.fr', 'Bar', 'DJ 2', 'dj.link.fr', 'A venir', 'Shoteria', '23h', '05h', '200', 'approved', '2.3735657', '48.8533762');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes, statut, longitude, latitude) VALUES ('Soirée N°3', '39 Avenue de Wagram','3 juillet', 'Alice In Wonderland', '35', '../Images/Affiches/affiche_soiree3.jpg', '300', 'Billeterie.link.fr', 'Salle', 'DJ 3', 'dj.link.fr', 'A venir', 'Salle Wagram', '23h', '05h', '300', 'approved', '2.2968266', '48.8772093');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes, statut, longitude, latitude) VALUES ('Soirée N°4', '14 rue Saint-Fiacre','4 juillet', 'Alice In Wonderland', '45', '../Images/Affiches/affiche_soiree4.jpg', '400', 'Billeterie.link.fr', 'Salle', 'DJ 4', 'dj.link.fr', 'A venir', 'Le Life Paris', '23h', '05h', '400', 'approved', '2.3456806', '48.87034149999999');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes, statut, longitude, latitude) VALUES ('Soirée N°5', '211 Avenue Jean Jaurès','5 juillet', 'Alice In Wonderland', '55', '../Images/Affiches/affiche_soiree5.jpg', '500', 'Billeterie.link.fr', 'Salle', 'DJ 5', 'dj.link.fr', 'A venir', 'My Boat', '23h', '05h', '500', 'approved', '2.394432', '48.88909229999999');
INSERT INTO soirees (Nom, Adresse, Date, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, Lieu_nom, Heure_début, Heure_fin, Places_restantes, statut, longitude, latitude) VALUES ('Soirée N°6', '34 rue du Départ','6 juillet', 'Alice In Wonderland', '65', '../Images/Affiches/affiche_soiree6.jpg', '600', 'Billeterie.link.fr', 'Salle', 'DJ 6', 'dj.link.fr', 'A venir', 'Le Carré Montparnasse', '23h', '05h', '600', 'approved', '2.3220631', '48.8417039');

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

DELETE FROM Utilisateurs;
ALTER TABLE Utilisateurs AUTO_INCREMENT =0;