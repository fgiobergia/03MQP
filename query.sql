
CREATE TABLE USERS (
    UId INTEGER PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(32) NOT NULL,
    LastName VARCHAR(32) NOT NULL,
    Email VARCHAR(32) NOT NULL UNIQUE,
    Password VARCHAR(128) NOT NULL
);

CREATE TABLE MACHINES (
    MId INTEGER PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(32) NOT NULL
);

CREATE TABLE RESERVATIONS (
    UId INTEGER NOT NULL,
    MId INTEGER NOT NULL,
    StartTime INTEGER NOT NULL, -- num. of minutes since 00:00
    Duration INTEGER NOT NULL, -- duration, in minutes
    Timestamp INTEGER DEFAULT 0,
    PRIMARY KEY (MId, StartTime),
    FOREIGN KEY (UId) REFERENCES USERS(UId),
    FOREIGN KEY (MId) REFERENCES MACHINES(MId)
); 

CREATE TABLE TOKENS (
    UId INTEGER NOT NULL, 
    Token VARCHAR(32) NOT NULL, 
    Expiration INTEGER NOT NULL,
    PRIMARY KEY (UId, Token)
);

CREATE TABLE CANCELLATIONS (
    LogId INTEGER PRIMARY KEY AUTO_INCREMENT,
    MId INTEGER NOT NULL, 
    StartTime INTEGER,
    Timestamp INTEGER NOT NULL,
    FOREIGN KEY (MId) REFERENCES MACHINES(MId)
);
