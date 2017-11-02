
USE TEST;
CREATE TABLE Users
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Login varchar(50),
    Level INT,
    Status varchar(100),
    Name varchar(100)
);
    
CREATE TABLE News
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Creator_ID INT,
    Head varchar(80) NOT NULL,
    Content text,
    Small_content text,
    Type varchar(100),
    CreateDate date,
    StartDate date;
);

CREATE TABLE Visitors
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    NewsID INT, FOREIGN KEY(NewsID) REFERENCES `News`(`ID`),
    Visited INT,
    Additional INT
);

CREATE TRIGGER `dater` BEFORE INSERT ON `News` FOR EACH ROW BEGIN SET NEW.`CreateDate`= NOW(); END;

CREATE TRIGGER `Updater` BEFORE UPDATE ON `Users` FRO EACH ROW BEGIN
IF NEW.Level<30
THEN
SET NEW.`Status`='Green';
END IF;

IF NEW.Level>=30
THEN
IF NEW.Level<90
THEN
SET NEW.`Status`='Orange';
END IF;
END IF;

IF NEW.Level>90 
THEN
SET NEW.`Status`='Gold';
END IF;
END;