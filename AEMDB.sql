-- CREATE USER 'test332'@'localhost' IDENTIFIED BY 'user332pwd';
CREATE DATABASE AEM2;
-- DROP DATABASE AEM2;
-- CREATE SCHEMA AEM2; 
-- GRANT ALL ON AEM2.* to 'test332'@'localhost'; 

USE AEM2;
-- entities 
drop table if exists EVENT_DETAILS;
CREATE TABLE EVENT_DETAILS
(Event_ID				INT NOT NULL AUTO_INCREMENT,
Event_name				VARCHAR(75) NOT NULL,
Event_description		VARCHAR(1024),
Event_type				VARCHAR(75) NOT NULL,
Publish_datetime		DATETIME NOT NULL,
Start_datetime			DATETIME NOT NULL,
End_datetime			DATETIME NOT NULL,
Maximum_capacity		INT,
Last_timestamp_event	DATETIME NOT NULL,
PRIMARY KEY (Event_ID));

USE AEM2;
drop table if exists VENUE;
 CREATE TABLE VENUE
(Venue_ID				INT NOT NULL AUTO_INCREMENT,
Event_ID				INT NOT NULL,
Venue_name				VARCHAR(75) NOT NULL,
Address					VARCHAR(75) NOT NULL,
Zip						VARCHAR(20) NOT NULL,
State					VARCHAR(75) NOT NULL,
Last_timestamp_venue	DATETIME NOT NULL,
PRIMARY KEY (Venue_ID),
CONSTRAINT fk_venue		FOREIGN KEY (Event_ID) REFERENCES EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists USER_DETAILS;
CREATE TABLE USER_DETAILS (
User_ID				INT NOT NULL AUTO_INCREMENT,
User_first_name		VARCHAR(50),
User_last_name		VARCHAR(50),
User_password		VARCHAR(50),
Last_timestamp_user	DATETIME NOT NULL,
Email				VARCHAR(255),
Phone				VARCHAR(10),
PRIMARY KEY (User_ID));

use AEM2;
drop table if exists UNIVERSITY;
CREATE TABLE UNIVERSITY (
University_ID				INT NOT NULL AUTO_INCREMENT,
University_name				VARCHAR(70) NOT NULL,
Last_timestamp_university	DATETIME NOT NULL,
PRIMARY KEY (University_ID));


drop table if exists SPONSOR;
CREATE TABLE SPONSOR (
Sponsor_ID			INT NOT NULL AUTO_INCREMENT,
Sponsor_fname		VARCHAR(50),
Sponsor_lname		VARCHAR(50),
Sponsor_timestamp	DATETIME NOT NULL,
PRIMARY KEY (Sponsor_ID));

drop table if exists PRESENTER;
CREATE TABLE PRESENTER (
Presenter_ID		INT NOT NULL AUTO_INCREMENT,
Abstract_deadline	DATETIME,
Presenter_fname		VARCHAR(50),
Presenter_lname		VARCHAR(50),
Presenter_timestamp	DATETIME NOT NULL,
PRIMARY KEY (Presenter_ID));

drop table if exists KEYNOTE_SPEAKER;
CREATE TABLE KEYNOTE_SPEAKER (
Speaker_ID			INT NOT NULL AUTO_INCREMENT,
Speaker_fname		VARCHAR(50),
Speaker_lname		VARCHAR(50),
Speaker_timestamp	DATETIME NOT NULL,
PRIMARY KEY (Speaker_ID));


-- M:N relations
-- use AEM2;
drop table if exists OCCURS_AT;
CREATE TABLE OCCURS_AT (
Location		INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_location_event PRIMARY KEY (Location, Event_ID),
CONSTRAINT fk_occurs_at_location foreign key (Location) references VENUE(Venue_ID),
CONSTRAINT fk_occurs_at_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists ATTENDS;
CREATE TABLE ATTENDS (
User_ID			INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_user_event PRIMARY KEY (User_ID, Event_ID),
CONSTRAINT fk_user_attends foreign key (User_ID) references USER_DETAILS(User_ID),
CONSTRAINT fk_attends_event	foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists EVENT_HOST;
CREATE TABLE EVENT_HOST (
University_ID		INT NOT NULL,
Host_ID				INT NOT NULL,
CONSTRAINT pk_university_host PRIMARY KEY (University_ID, Host_ID),
CONSTRAINT fk_university_event_host foreign key (University_ID) references UNIVERSITY(University_ID),
CONSTRAINT fk_host_event_host foreign key (Host_ID) references EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists SPONSORS_OF;
CREATE TABLE SPONSORS_OF (
Sponsor_ID			INT NOT NULL,
Event_ID			INT NOT NULL,
CONSTRAINT pk_sponsor_event PRIMARY KEY (Sponsor_ID, Event_ID),
CONSTRAINT fk_sponsor_sponsors_of foreign key (Sponsor_ID) references SPONSOR(Sponsor_ID),
CONSTRAINT fk_sponsors_of_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists PRESENTS_AT;
CREATE TABLE PRESENTS_AT (
Presenter_ID		INT NOT NULL,
Event_ID			INT NOT NULL,
CONSTRAINT pk_presenter_event PRIMARY KEY (Presenter_ID, Event_ID),
CONSTRAINT fk_presenter_presents_at foreign key (Presenter_ID) references PRESENTER(Presenter_ID),
CONSTRAINT fk_presents_at_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists SPEAKS_AT;
CREATE TABLE SPEAKS_AT (
Speaker_ID		INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_speaker_event PRIMARY KEY (Speaker_ID, Event_ID),
CONSTRAINT fk_speaker_speaks_at foreign key (Speaker_ID) references KEYNOTE_SPEAKER(Speaker_ID),
CONSTRAINT fk_speaks_at_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM2;
drop table if exists ORGANIZES;
CREATE TABLE ORGANIZES (
User_ID		INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_speaker_event PRIMARY KEY (User_ID, Event_ID),
CONSTRAINT fk_user_organizes foreign key (User_ID) references USER_DETAILS(User_ID),
CONSTRAINT fk_organizes_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

-- Populate EVENT_DETAILS table
INSERT INTO EVENT_DETAILS (Event_name, Event_description, Event_type, Publish_datetime, Start_datetime, End_datetime, Maximum_capacity, Last_timestamp_event)
VALUES 
    ('Conference A', 'Annual conference for professionals', 'Conference', '2024-05-01 10:00:00', '2024-06-01 09:00:00', '2024-06-03 18:00:00', 500, '2024-05-01 10:00:00'),
    ('Seminar X', 'Educational seminar on latest technologies', 'Seminar', '2024-05-05 09:00:00', '2024-06-15 09:00:00', '2024-06-15 17:00:00', 100, '2024-05-05 09:00:00'),
    ('Workshop Z', 'Hands-on workshop for beginners', 'Workshop', '2024-04-20 12:00:00', '2024-06-20 10:00:00', '2024-06-20 16:00:00', 50, '2024-04-20 12:00:00');

-- Populate VENUE table
INSERT INTO VENUE (Event_ID, Venue_name, Address, Zip, State, Last_timestamp_venue)
VALUES
    (1, 'Convention Center', '123 Main St', '12345', 'CA', '2024-05-01 10:00:00'),
    (2, 'Tech Park Auditorium', '456 Elm St', '54321', 'NY', '2024-05-05 09:00:00'),
    (3, 'Community College', '789 Oak St', '67890', 'TX', '2024-04-20 12:00:00');
USE AEM2;
-- Populate USER_DETAILS table
INSERT INTO USER_DETAILS (User_first_name, User_last_name, User_password, Last_timestamp_user, Email, Phone)
VALUES
    ('John', 'Doe', 'password123', '2024-05-06 10:00:00', 'john.doe@example.com', '9493490876'),
    ('Jane', 'Smith', 'abc123', '2024-05-06 11:00:00', 'jane.smith@example.com', '5551234567'),
    ('Michael', 'Johnson', 'qwerty', '2024-05-06 12:00:00', 'michael.johnson@example.com', '7894561230');

-- Populate UNIVERSITY table
INSERT INTO UNIVERSITY (University_name, Last_timestamp_university)
VALUES
    ('University of California', '2024-05-06 10:00:00'),
    ('New York University', '2024-05-06 11:00:00'),
    ('University of Texas', '2024-05-06 12:00:00');

-- Populate SPONSOR table
INSERT INTO SPONSOR (Sponsor_fname, Sponsor_lname, Sponsor_timestamp)
VALUES
    ('Sponsor1', 'Lastname1', '2024-05-06 10:00:00'),
    ('Sponsor2', 'Lastname2', '2024-05-06 11:00:00'),
    ('Sponsor3', 'Lastname3', '2024-05-06 12:00:00');

-- Populate PRESENTER table
INSERT INTO PRESENTER (Abstract_deadline, Presenter_fname, Presenter_lname, Presenter_timestamp)
VALUES
    ('2024-05-15 12:00:00', 'Presenter1', 'Lastname1', '2024-05-06 10:00:00'),
    ('2024-05-20 12:00:00', 'Presenter2', 'Lastname2', '2024-05-06 11:00:00'),
    ('2024-05-25 12:00:00', 'Presenter3', 'Lastname3', '2024-05-06 12:00:00');

-- Populate KEYNOTE_SPEAKER table
INSERT INTO KEYNOTE_SPEAKER (Speaker_fname, Speaker_lname, Speaker_timestamp)
VALUES
    ('Keynote1', 'Speaker1', '2024-05-06 10:00:00'),
    ('Keynote2', 'Speaker2', '2024-05-06 11:00:00'),
    ('Keynote3', 'Speaker3', '2024-05-06 12:00:00');

-- Populate OCCURS_AT table
INSERT INTO OCCURS_AT (Location, Event_ID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- Populate ATTENDS table
INSERT INTO ATTENDS (User_ID, Event_ID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- Populate EVENT_HOST table
INSERT INTO EVENT_HOST (University_ID, Host_ID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- Populate SPONSORS_OF table
INSERT INTO SPONSORS_OF (Sponsor_ID, Event_ID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- Populate PRESENTS_AT table
INSERT INTO PRESENTS_AT (Presenter_ID, Event_ID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- Populate SPEAKS_AT table
INSERT INTO SPEAKS_AT (Speaker_ID, Event_ID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

USE AEM2;
INSERT INTO ORGANIZES (User_ID, Event_ID)
VALUES
    (1, 1), -- User with ID 1 organizes Event with ID 1
    (2, 2), -- User with ID 2 organizes Event with ID 2
    (3, 3); -- User with ID 3 organizes Event with ID 3
    

USE AEM2;
SELECT * FROM USER_DETAILS;

INSERT INTO EVENT_DETAILS (Event_name, Event_description, Event_type, Publish_datetime, Start_datetime, End_datetime, Maximum_capacity, Last_timestamp_event)
VALUES 
    ('Conference Z', 'Poster for conference 2', 'Poster', '2024-05-01 11:00:00', '2024-06-01 04:00:00', '2024-06-03 11:00:00', 500, '2024-05-01 02:00:00');


USE AEM2;
INSERT INTO EVENT_DETAILS (Event_name, Event_description, Event_type, Publish_datetime, Start_datetime, End_datetime, Maximum_capacity, Last_timestamp_event)
VALUES 
    ('Welcome event', '', 'Poster', '2024-04-01 11:30:00', '2024-05-01 07:45:00', '2024-06-03 12:40:00', 500, '2024-05-01 07:30:00'),
	('Safety presentation', '', 'Oral presentation', '2024-04-01 11:30:00', '2024-05-01 07:45:00', '2024-06-03 12:40:00', 500, '2024-05-01 07:30:00');    

INSERT INTO ORGANIZES (User_ID, Event_ID)
VALUES
    (6, 7),
    (6, 8);

USE AEM2;
SELECT DISTINCT ED.*
FROM EVENT_DETAILS ED
LEFT JOIN ORGANIZES O ON ED.Event_ID = O.Event_ID
LEFT JOIN USER_DETAILS UDO ON O.User_ID = UDO.User_ID
LEFT JOIN ATTENDS A ON ED.Event_ID = A.Event_ID
LEFT JOIN USER_DETAILS UDA ON A.User_ID
 = UDA.User_ID
WHERE (UDO.Email = 'bjoe99@gmail.com' OR UDA.Email = 'bjoe99@gmail.com');
USE AEM2;
select user_password, user_first_name,email from user_details;

USE AEM2;
select * FROM event_details;

USE AEM2;
INSERT INTO EVENT_DETAILS (Event_name, Event_description, Event_type, Publish_datetime, Start_datetime, End_datetime, Maximum_capacity, Last_timestamp_event)
VALUES ('Large Event', 'big event with 100+ attendees', 'Conference', '2024-05-15 10:00:00', '2024-06-01 09:00:00', '2024-06-03 18:00:00', 150, '2024-05-15 10:00:00');

use AEM2;
select event_id, event_name from event_details;

INSERT INTO USER_DETAILS (User_first_name, User_last_name, User_password, Last_timestamp_user, Email, Phone)
VALUES
    ('Alice', 'Jones', 'pass123', '2024-05-15 08:00:00', 'alice.jones@example.com', '1234567890'),
    ('Bob', 'Smith', 'bobpass', '2024-05-15 09:00:00', 'bob.smith@example.com', '2345678901'),
    ('Charlie', 'Brown', 'charlie321', '2024-05-15 10:00:00', 'charlie.brown@example.com', '3456789012'),
    ('David', 'Lee', 'davidpwd', '2024-05-15 11:00:00', 'david.lee@example.com', '4567890123'),
    ('Emma', 'Clark', 'emma456', '2024-05-15 12:00:00', 'emma.clark@example.com', '5678901234'),
    ('Frank', 'Taylor', 'frankpass', '2024-05-15 13:00:00', 'frank.taylor@example.com', '6789012345'),
    ('Grace', 'Miller', 'grace123', '2024-05-15 14:00:00', 'grace.miller@example.com', '7890123456'),
    ('Henry', 'Wilson', 'henrypass', '2024-05-15 15:00:00', 'henry.wilson@example.com', '8901234567'),
    ('Isabella', 'Anderson', 'isapwd', '2024-05-15 16:00:00', 'isabella.anderson@example.com', '9012345678'),
    ('Jack', 'Harris', 'jackpass', '2024-05-15 17:00:00', 'jack.harris@example.com', '0123456789'),
    ('Kate', 'Thompson', 'kate456', '2024-05-15 18:00:00', 'kate.thompson@example.com', '1234567890'),
    ('Leo', 'Moore', 'leopwd', '2024-05-15 19:00:00', 'leo.moore@example.com', '2345678901'),
    ('Mia', 'White', 'miapass', '2024-05-15 20:00:00', 'mia.white@example.com', '3456789012'),
    ('Noah', 'Allen', 'noah123', '2024-05-15 21:00:00', 'noah.allen@example.com', '4567890123'),
    ('Olivia', 'Young', 'olivia456', '2024-05-15 22:00:00', 'olivia.young@example.com', '5678901234'),
    ('Peter', 'Scott', 'peterpwd', '2024-05-15 23:00:00', 'peter.scott@example.com', '6789012345'),
    ('Quinn', 'Brown', 'quinnpass', '2024-05-16 00:00:00', 'quinn.brown@example.com', '7890123456'),
    ('Ryan', 'Evans', 'ryan123', '2024-05-16 01:00:00', 'ryan.evans@example.com', '8901234567'),
    ('Samantha', 'King', 'samantha456', '2024-05-16 02:00:00', 'samantha.king@example.com', '9012345678'),
    ('Thomas', 'Turner', 'thomaspwd', '2024-05-16 03:00:00', 'thomas.turner@example.com', '0123456789'),
    ('Uma', 'Morris', 'umapass', '2024-05-16 04:00:00', 'uma.morris@example.com', '1234567890'),
    ('Victor', 'Baker', 'victor123', '2024-05-16 05:00:00', 'victor.baker@example.com', '2345678901'),
    ('Wendy', 'Hall', 'wendypwd', '2024-05-16 06:00:00', 'wendy.hall@example.com', '3456789012'),
    ('Xavier', 'Young', 'xavier456', '2024-05-16 07:00:00', 'xavier.young@example.com', '4567890123'),
    ('Yara', 'Adams', 'yarapass', '2024-05-16 08:00:00', 'yara.adams@example.com', '5678901234'),
    ('Zach', 'Hill', 'zach123', '2024-05-16 09:00:00', 'zach.hill@example.com', '6789012345'),
    ('Alice', 'Rivera', 'alicerivera', '2024-05-16 10:00:00', 'alice.rivera@example.com', '7890123456'),
    ('Bob', 'Garcia', 'bobgarcia', '2024-05-16 11:00:00', 'bob.garcia@example.com', '8901234567'),
    ('Charlie', 'Martinez', 'charliemartinez', '2024-05-16 12:00:00', 'charlie.martinez@example.com', '9012345678'),
    ('David', 'Gonzalez', 'davidgonzalez', '2024-05-16 13:00:00', 'david.gonzalez@example.com', '0123456789'),
    ('Emma', 'Rodriguez', 'emmarodriguez', '2024-05-16 14:00:00', 'emma.rodriguez@example.com', '1234567890'),
    ('Frank', 'Hernandez', 'frankhernandez', '2024-05-16 15:00:00', 'frank.hernandez@example.com', '2345678901'),
    ('Grace', 'Lopez', 'gracelopez', '2024-05-16 16:00:00', 'grace.lopez@example.com', '3456789012'),
    ('Henry', 'Perez', 'henryperez', '2024-05-16 17:00:00', 'henry.perez@example.com', '4567890123'),
    ('Isabella', 'Torres', 'isabellatorres', '2024-05-16 18:00:00', 'isabella.torres@example.com', '5678901234'),
    ('Jack', 'Sanchez', 'jacksanchez', '2024-05-16 19:00:00', 'jack.sanchez@example.com', '6678901234'),
    ('Sophia', 'Williams', 'sophiapass', '2024-05-16 20:00:00', 'sophia.williams@example.com', '7789012345'),
    ('James', 'Johnson', 'jamespass', '2024-05-16 21:00:00', 'james.johnson@example.com', '8890123456'),
    ('Emily', 'Brown', 'emilypass', '2024-05-16 22:00:00', 'emily.brown@example.com', '9901234567'),
    ('Michael', 'Jones', 'michaelpass', '2024-05-16 23:00:00', 'michael.jones@example.com', '0001234567'),
    ('Olivia', 'Davis', 'oliviapass', '2024-05-17 00:00:00', 'olivia.davis@example.com', '1112345678'),
    ('Ethan', 'Miller', 'ethanpass', '2024-05-17 01:00:00', 'ethan.miller@example.com', '2223456789'),
    ('Ava', 'Wilson', 'avapass', '2024-05-17 02:00:00', 'ava.wilson@example.com', '3334567890'),
    ('Noah', 'Taylor', 'noahpass', '2024-05-17 03:00:00', 'noah.taylor@example.com', '4445678901'),
    ('Emma', 'Garcia', 'emmapass', '2024-05-17 04:00:00', 'emma.garcia@example.com', '5556789012'),
    ('Liam', 'Rodriguez', 'liampass', '2024-05-17 05:00:00', 'liam.rodriguez@example.com', '6667890123'),
    ('Ava', 'Martinez', 'avapass', '2024-05-17 06:00:00', 'ava.martinez@example.com', '7778901234'),
    ('William', 'Hernandez', 'williampass', '2024-05-17 07:00:00', 'william.hernandez@example.com', '8889012345'),
    ('Isabella', 'Young', 'isabellapass', '2024-05-17 08:00:00', 'isabella.young@example.com', '9990123456'),
    ('Mason', 'King', 'masonpass', '2024-05-17 09:00:00', 'mason.king@example.com', '0101234567'),
    ('Sophia', 'Allen', 'sophiapass', '2024-05-17 10:00:00', 'sophia.allen@example.com', '1212345678'),
    ('Elijah', 'Turner', 'elijahpass', '2024-05-17 11:00:00', 'elijah.turner@example.com', '2323456789'),
    ('Charlotte', 'Hall', 'charlottepass', '2024-05-17 12:00:00', 'charlotte.hall@example.com', '3434567890'),
    ('Logan', 'Scott', 'loganpass', '2024-05-17 13:00:00', 'logan.scott@example.com', '4545678901'),
    ('Amelia', 'Morris', 'ameliapass', '2024-05-17 14:00:00', 'amelia.morris@example.com', '5656789012'),
    ('Benjamin', 'Baker', 'benjaminpass', '2024-05-17 15:00:00', 'benjamin.baker@example.com', '6767890123'),
    ('Ella', 'Adams', 'ellapass', '2024-05-17 16:00:00', 'ella.adams@example.com', '7878901234'),
    ('Alexander', 'Hill', 'alexanderpass', '2024-05-17 17:00:00', 'alexander.hill@example.com', '8989012345'),
    ('Mia', 'Garcia', 'miapass', '2024-05-17 18:00:00', 'mia.garcia@example.com', '9090123456'),
    ('James', 'Martin', 'jamespass', '2024-05-17 19:00:00', 'james.martin@example.com', '0101234567'),
    ('William', 'Rodriguez', 'williampass', '2024-05-17 20:00:00', 'william.rodriguez@example.com', '1212345678'),
    ('Sophia', 'Martinez', 'sophiapass', '2024-05-17 21:00:00', 'sophia.martinez@example.com', '2323456789'),
    ('Logan', 'Perez', 'loganpass', '2024-05-17 22:00:00', 'logan.perez@example.com', '3434567890'),
    ('Benjamin', 'Turner', 'benjaminpass', '2024-05-17 23:00:00', 'benjamin.turner@example.com', '4545678901'),
    ('Ella', 'Martinez', 'ellapass', '2024-05-18 00:00:00', 'ella.martinez@example.com', '5656789012'),
    ('Alexander', 'Brown', 'alexanderpass', '2024-05-18 01:00:00', 'alexander.brown@example.com', '6767890123');
    INSERT INTO USER_DETAILS (User_first_name, User_last_name, User_password, Last_timestamp_user, Email, Phone)
VALUES
    ('Charlotte', 'Gonzalez', 'charlottepass', '2024-05-18 02:00:00', 'charlotte.gonzalez@example.com', '7778901234'),
    ('Elijah', 'Young', 'elijahpass', '2024-05-18 03:00:00', 'elijah.young@example.com', '8889012345'),
    ('Amelia', 'Perez', 'ameliapass', '2024-05-18 04:00:00', 'amelia.perez@example.com', '9990123456'),
    ('Benjamin', 'Garcia', 'benjaminpass', '2024-05-18 05:00:00', 'benjamin.garcia@example.com', '0101234567'),
    ('Ella', 'Martinez', 'ellapass', '2024-05-18 06:00:00', 'ella.martinez@example.com', '1212345678'),
    ('Alexander', 'Rodriguez', 'alexanderpass', '2024-05-18 07:00:00', 'alexander.rodriguez@example.com', '2323456789'),
    ('Mia', 'Brown', 'miapass', '2024-05-18 08:00:00', 'mia.brown@example.com', '3434567890'),
    ('James', 'Hernandez', 'jamespass', '2024-05-18 09:00:00', 'james.hernandez@example.com', '4545678901'),
    ('William', 'Miller', 'williampass', '2024-05-18 10:00:00', 'william.miller@example.com', '5656789012'),
    ('Sophia', 'Allen', 'sophiapass', '2024-05-18 11:00:00', 'sophia.allen@example.com', '6767890123'),
    ('Logan', 'Harris', 'loganpass', '2024-05-18 12:00:00', 'logan.harris@example.com', '7878901234'),
    ('Amelia', 'Martin', 'ameliapass', '2024-05-18 13:00:00', 'amelia.martin@example.com', '8989012345'),
    ('Benjamin', 'Hernandez', 'benjaminpass', '2024-05-18 14:00:00', 'benjamin.hernandez@example.com', '9090123456'),
    ('Ella', 'Lopez', 'ellapass', '2024-05-18 15:00:00', 'ella.lopez@example.com', '0101234567'),
    ('Alexander', 'Taylor', 'alexanderpass', '2024-05-18 16:00:00', 'alexander.taylor@example.com', '1212345678'),
    ('Mia', 'Adams', 'miapass', '2024-05-18 17:00:00', 'mia.adams@example.com', '2323456789'),
    ('James', 'King', 'jamespass', '2024-05-18 18:00:00', 'james.king@example.com', '3434567890'),
    ('William', 'Hill', 'williampass', '2024-05-18 19:00:00', 'william.hill@example.com', '4545678901'),
    ('Sophia', 'Scott', 'sophiapass', '2024-05-18 20:00:00', 'sophia.scott@example.com', '5656789012'),
    ('Logan', 'Young', 'loganpass', '2024-05-18 21:00:00', 'logan.young@example.com', '6767890123'),
    ('Amelia', 'Clark', 'ameliapass', '2024-05-18 22:00:00', 'amelia.clark@example.com', '7878901234'),
    ('Benjamin', 'Brown', 'benjaminpass', '2024-05-18 23:00:00', 'benjamin.brown@example.com', '8989012345'),
    ('Ella', 'Lewis', 'ellapass', '2024-05-19 00:00:00', 'ella.lewis@example.com', '9090123456'),
    ('Alexander', 'White', 'alexanderpass', '2024-05-19 01:00:00', 'alexander.white@example.com', '0101234567'),
    ('Mia', 'Hall', 'miapass', '2024-05-19 02:00:00', 'mia.hall@example.com', '1212345678'),
    ('James', 'Adams', 'jamespass', '2024-05-19 03:00:00', 'james.adams@example.com', '2323456789'),
    ('William', 'Martinez', 'williampass', '2024-05-19 04:00:00', 'william.martinez@example.com', '3434567890'),
    ('Sophia', 'Perez', 'sophiapass', '2024-05-19 05:00:00', 'sophia.perez@example.com', '4545678901'),
	('Logan', 'Gonzalez', 'loganpass', '2024-05-19 06:00:00', 'logan.gonzalez@example.com', '5656789012'),
    ('Amelia', 'White', 'ameliapass', '2024-05-19 07:00:00', 'amelia.white@example.com', '6767890123'),
    ('Benjamin', 'Harris', 'benjaminpass', '2024-05-19 08:00:00', 'benjamin.harris@example.com', '7878901234'),
    ('Ella', 'King', 'ellapass', '2024-05-19 09:00:00', 'ella.king@example.com', '8989012345'),
    ('Alexander', 'Miller', 'alexanderpass', '2024-05-19 10:00:00', 'alexander.miller@example.com', '9090123456');
	
    INSERT INTO USER_DETAILS (User_first_name, User_last_name, User_password, Last_timestamp_user, Email, Phone)
VALUES
    ('Logan', 'Anderson', 'loganpass', '2024-05-19 12:00:00', 'logan.anderson@example.com', '1212345678'),
    ('Amelia', 'Taylor', 'ameliapass', '2024-05-19 13:00:00', 'amelia.taylor@example.com', '2323456789'),
    ('Benjamin', 'Wilson', 'benjaminpass', '2024-05-19 14:00:00', 'benjamin.wilson@example.com', '3434567890');

use AEM2;
select event_id, event_name from event_Details;

INSERT INTO ATTENDS (User_ID, Event_ID)
VALUES
    (12, 12),
    (13, 12),
    (14, 12),
    (15, 12),
    (16, 12),
    (17, 12),
    (18, 12),
    (19, 12),
    (20, 12),
    (21, 12),
    (22, 12),
    (23, 12),
    (24, 12),
    (25, 12),
    (26, 12),
    (27, 12),
    (28, 12),
    (29, 12),
    (30, 12),
    (31, 12),
    (32, 12),
    (33, 12),
    (34, 12),
    (35, 12),
    (36, 12),
    (37, 12),
    (38, 12),
    (39, 12),
    (40, 12),
    (41, 12),
    (42, 12),
    (43, 12),
    (44, 12),
    (45, 12),
    (46, 12),
    (47, 12),
    (48, 12),
    (49, 12),
    (50, 12),
    (51, 12),
    (52, 12),
    (53, 12),
    (54, 12),
    (55, 12),
    (56, 12),
    (57, 12),
    (58, 12),
    (59, 12),
    (60, 12),
    (61, 12),
    (62, 12),
    (63, 12),
    (64, 12),
    (65, 12),
    (66, 12),
    (67, 12),
    (68, 12),
    (69, 12),
    (70, 12),
    (71, 12),
    (72, 12),
    (73, 12),
    (74, 12),
    (75, 12),
    (76, 12),
    (77, 12),
    (78, 12),
    (79, 12),
    (80, 12),
    (81, 12),
    (82, 12),
    (83, 12),
    (84, 12),
    (85, 12),
    (86, 12),
    (87, 12),
    (88, 12),
    (89, 12),
    (90, 12),
    (91, 12),
    (92, 12),
    (93, 12),
    (94, 12),
    (95, 12),
    (96, 12),
    (97, 12),
    (98, 12),
    (99, 12),
    (100, 12),
    (101, 12),
    (102, 12),
    (103, 12),
    (104, 12),
    (105, 12),
    (106, 12),
    (107, 12),
    (108, 12),
    (109, 12),
    (110, 12),
    (111, 12),
    (112, 12),
    (113, 12);
-- views
CREATE VIEW Events_With_More_Than_100_Attendees AS
SELECT ED.*
FROM EVENT_DETAILS ED
INNER JOIN (
    SELECT Event_ID
    FROM ATTENDS
    GROUP BY Event_ID
    HAVING COUNT(*) > 100
) A ON ED.Event_ID = A.Event_ID;

SELECT * FROM Events_With_More_Than_100_Attendees;
