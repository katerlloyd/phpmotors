INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) 
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

UPDATE clients SET clientLevel = 3
WHERE clientId = 1;

UPDATE inventory SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invId = 12;

SELECT invModel, classificationName FROM inventory i
INNER JOIN carclassification c ON i.classificationId = c.classificationId
WHERE classificationName = "SUV";

DELETE FROM inventory WHERE invId = 1;

UPDATE inventory SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);