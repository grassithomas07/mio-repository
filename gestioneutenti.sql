/*mysql -u root
**CREATE DATABASE inserimento
**USE inserimento
*/

CREATE TABLE utente(
    nome VARCHAR(20) NOT NULL,
    cognome VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO utente VALUES ('luigi', 'bianchi', 'luigibianchi@gmail.com');
INSERT INTO utente VALUES ('mario', 'rossi', 'mariorossi@gmail.com');
INSERT INTO utente VALUES ('andrea', 'villa', 'andreavilla@gmail.com');

SELECT * FROM utente; 
