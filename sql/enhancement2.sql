INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) 
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, 'I am the real Ironman');

UPDATE clients SET clientLevel = 3
WHERE clientId = 2;

UPDATE inventory SET invDescription = (SELECT REPLACE(invDescription, 'small interior', 'spacious interior'))
WHERE invId = 12;