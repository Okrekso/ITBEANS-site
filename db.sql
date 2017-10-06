CREATE DATABASE ITB;
USE ITB;
CREATE TABLE Users
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Login varchar(50),
    Pass varchar(50),
    Level INT,
    Status varchar(100)
);
    
CREATE TABLE News
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Creator_ID INT, FOREIGN KEY(Creator_ID) REFERENCES Users(ID),
    Head varchar(80) NOT NULL,
    Content varchar(1000)
);

INSERT INTO Users (Login,Pass,Level,Status)
VALUES ('Admin','admin',100,'Gold');
INSERT INTO News(Creator_ID,Head,Content)
VALUES (1,'Создание сайта','Сайт был успешно создан!');

ALTER TABLE News ADD Small_content varchar(70);
UPDATE News SET Small_content='сайт було створено і це маленьке повідомлення про це!', Content='сайт було створено і це дуже велике! повідомлення про це!' WHERE ID=1;
