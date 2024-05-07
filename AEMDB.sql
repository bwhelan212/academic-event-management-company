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

-- USE AEM2;
-- SELECT * FROM USER_DETAILS;