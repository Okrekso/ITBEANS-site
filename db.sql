
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
    Creator_ID INT, FOREIGN KEY(Creator_ID) REFERENCES Users(ID),
    Head varchar(80) NOT NULL,
    Content text,
    Small_content text
);

INSERT INTO Users (Login,Level,Status,Name)
VALUES ('Admin',100,'Gold','Admin');
INSERT INTO News(Creator_ID,Head,Content)
VALUES (1,'Создание сайта','Сайт был успешно создан!');
