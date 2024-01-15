/*LA table de base avant d'ajouter deux coloumne pour stockee l'image*/
DROP TABLE IF EXISTS `AnimalE`;
CREATE TABLE AnimalE ( idP INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
nom VARCHAR(100) NOT NULL, espece VARCHAR(100) NOT NULL, race VARCHAR(100) NOT NULL, genre VARCHAR(100) NOT NULL, age INT(2) NOT NULL,  dateN date,numeroT VARCHAR(100) NOT NULL,adresse VARCHAR(500) NOT NULL);

INSERT INTO `AnimalE` (`idP`, `nom`, `espece`,`race`, `genre`, `age`,`dateN`,`numeroT`,`adresse`) VALUES
(1, 'Yuki', 'Chat','Europeen','Masculin','6','2017-03-15','10 boulevard maréchal juin'),
(2, 'Yuda', 'Chat','Afrique','Feminin','10','2013-12-02','Ihedaden Bejaia algerie' ),
(3, 'Rekse', 'Chien','Afrique','Masculin','15','2008-09-13','Tizi allouane Bejaia Algerie'),
(4, 'kiki', 'Chien','Russe','Masculin','2','2021-05-04','14 arrondisement cretielle paris');
