
CREATE TABLE user(  
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    passwd VARCHAR(255) NOT NULL
);

CREATE TABLE admin(  
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    level VARCHAR(255) NOT NULL
);

CREATE TABLE ostoslista(  
    id INTEGER PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    tuote VARCHAR(255),
    FOREIGN KEY (username) REFERENCES user(username)
);

INSERT INTO user (username, passwd) VALUES ("Janne", "Janne1234"), ("Danielle", "Danielle1234");

INSERT INTO ostoslista (username, tuote) VALUES ("Janne","Omenoita"),
("Janne","Maitoa"),("Danielle","Munia"),("Danielle","Kaurapuuroa");

INSERT INTO ADMIN (username, level) VALUES ("Janne",1);