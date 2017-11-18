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
    StartDate dateTime,
    Price INT,
    Ended INT
);

CREATE TABLE Visitors
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    NewsID INT, FOREIGN KEY(NewsID) REFERENCES `News`(`ID`),
    Visited INT,
    Additional INT,
    Apprised INT
);

CREATE TRIGGER `dater` BEFORE INSERT ON `News` FOR EACH ROW
BEGIN
SET NEW.`CreateDate`= NOW();
SET NEW.`Ended`=0;
IF NEW.`Price`<1
THEN
SET NEW.`Price`=1;
END IF;
END;

CREATE TRIGGER `status changer` BEFORE UPDATE ON `Users` FRO EACH ROW
BEGIN
IF NEW.Level<30
THEN
SET NEW.`Status`='Green';
END IF;

IF NEW.Level>=30 AND NEW.Level<90
THEN
SET NEW.`Status`='Orange';
END IF;

IF NEW.Level>=90 AND NEW.Level<=100 AND NEW.Status!='Orange'
THEN
SET NEW.`Status`='Gold';
END IF;

IF NEW.Level>100 AND NEW.Level<=200
THEN
	IF NEW.Status='Gold' OR NEW.Status='Legendary'
    THEN
		SET NEW.`Status`='Diamond';
    END IF;
END IF;

IF NEW.Level>200 AND NEW.Level<=400 AND NEW.Status='Diamond'
THEN
SET NEW.`Status`='Legendary';
END IF;

IF NEW.Level>400 THEN SET NEW.Level=400; END IF;
END

CREATE TRIGGER `new_visitor` BEFORE INSERT ON `Visitors` FOR EACH ROW 
BEGIN
IF NEW.`Additional` IS NULL
THEN
SET NEW.`Additional`=0;
END IF;

SET NEW.`Visited`=0;

END;

CREATE TRIGGER `Visited` BEFORE UPDATE ON `Visitors` FOR EACH ROW
BEGIN
SET @Price=(SELECT `Price` FROM News WHERE `ID`=NEW.`NewsID`);
SET @OldVisit=(SELECT `Visited` FROM Visitors WHERE `ID`=NEW.`ID`);
SET @Creator=(SELECT `Creator_ID` FROM News WHERE ID=NEW.`NewsID` LIMIT 1);
SET @IsEnded=(SELECT Ended FROM News WHERE ID=NEW.`NewsID`);

IF(@IsEnded=0)
THEN
UPDATE Users SET `Level`=`Level`-@Price WHERE `ID` NOT IN 
(SELECT UserID FROM Visitors WHERE `NewsID`=NEW.`NewsID`);

UPDATE News SET Ended=1 WHERE ID=NEW.`NewsID`;
END IF;

IF (NEW.`Apprised`=1)
THEN
	IF (@OldVisit=1 AND NEW.`Visited`!=@OldVisit) 
    THEN UPDATE Users SET `Level`=`Level`-@Price WHERE `ID`=NEW.`UserID`;
	ELSEIF (@OldVisit=0 AND NEW.`Visited`!=@OldVisit) 
    THEN UPDATE Users SET `Level`=`Level`+ROUND(@Price/2,0) WHERE `ID`=NEW.`UserID`;
    END IF;
ELSEIF (NEW.`Apprised`=0 OR NEW.`Apprised` IS NULL)
THEN
	SET NEW.`Apprised`=1;
END IF;

IF(NEW.`Visited`=1 AND NEW.`Visited`!=@OldVisit) 
	THEN UPDATE Users SET `Level`=`Level`+@Price WHERE ID=NEW.`UserID`;
END IF;
IF(NEW.`Visited`=0 AND NEW.`Visited`!=@OldVisit)
	THEN UPDATE Users SET `Level`=`Level`-ROUND(@Price/2,0) WHERE ID=NEW.`UserID`;
END IF;

IF (NEW.`Additional` IS NOT NULL)
THEN
	SET @OldAdd=(SELECT Additional FROM Visitors WHERE ID=NEW.`ID`);
    IF @OldAdd IS NOT NULL THEN
    	UPDATE Users SET Level=Level-@OldAdd WHERE ID=NEW.`UserID`;
    END IF;
    UPDATE Users SET Level=Level+NEW.`Additional` WHERE ID=NEW.`UserID`;
END IF;
END