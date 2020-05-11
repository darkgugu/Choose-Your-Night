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