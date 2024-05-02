CREATE DATABASE AEM;
-- DROP DATABASE AEM;
-- CREATE SCHEMA AEM; 
-- GRANT ALL ON AEM.* to 'userAEM'@'localhost'; <-- what

USE AEM;
-- entities 
drop table if exists EVENT_DETAILS;
CREATE TABLE EVENT_DETAILS
(Event_ID				INT NOT NULL,
Event_name				VARCHAR(75) NOT NULL,
Event_description		VARCHAR(1024),
Event_type				VARCHAR(75) NOT NULL,
Publish_datetime		DATETIME NOT NULL,
Start_datetime			DATETIME NOT NULL,
End_datetime			DATETIME NOT NULL,
Maximum_capacity		INT,
Last_timestamp_event	DATETIME NOT NULL,
PRIMARY KEY (Event_ID));

USE AEM;
drop table if exists VENUE;
 CREATE TABLE VENUE
(Venue_ID				INT NOT NULL,
Event_ID				INT NOT NULL,
Venue_name				VARCHAR(75) NOT NULL,
Address					VARCHAR(75) NOT NULL,
Zip						VARCHAR(20) NOT NULL,
State					VARCHAR(75) NOT NULL,
Last_timestamp_venue	DATETIME NOT NULL,
PRIMARY KEY (Venue_ID),
CONSTRAINT fk_venue		FOREIGN KEY (Event_ID) REFERENCES EVENT(Event_ID));


drop table if exists USER_DETAILS;
CREATE TABLE USER_DETAILS (
User_ID				INT NOT NULL,
User_first_name		VARCHAR(50),
User_last_name		VARCHAR(50),
User_login			VARCHAR(10),
User_password		VARCHAR(50),
Last_timestamp_user	DATETIME NOT NULL,
Email				VARCHAR(50),
PRIMARY KEY (User_ID));

drop table if exists UNIVERSITY;
CREATE TABLE UNIVERSITY (
University_ID				INT NOT NULL,
University_name				VARCHAR(70) NOT NULL,
Last_timestamp_university	DATETIME NOT NULL,
PRIMARY KEY (University_ID));


drop table if exists SPONSOR;
CREATE TABLE SPONSOR (
Sponsor_ID			INT NOT NULL,
Sponsor_fname		VARCHAR(50),
Sponsor_lname		VARCHAR(50),
Sponsor_timestamp	DATETIME NOT NULL,
PRIMARY KEY (Sponsor_ID));

drop table if exists PRESENTER;
CREATE TABLE PRESENTER (
Presenter_ID		INT NOT NULL,
Abstract_deadline	DATETIME,
Presenter_fname		VARCHAR(50),
Presenter_lname		VARCHAR(50),
Presenter_timestamp	DATETIME NOT NULL,
PRIMARY KEY (Presenter_ID));

drop table if exists KEYNOTE_SPEAKER;
CREATE TABLE KEYNOTE_SPEAKER (
Speaker_ID			INT NOT NULL,
Speaker_fname		VARCHAR(50),
Speaker_lname		VARCHAR(50),
Speaker_timestamp	DATETIME NOT NULL,
PRIMARY KEY (Speaker_ID));


-- M:N relations
drop table if exists OCCURS_AT;
CREATE TABLE OCCURS_AT (
Location		INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_location_event PRIMARY KEY (Location, Event_ID),
CONSTRAINT fk_occurs_at_location foreign key (Location) references VENUE(Venue_ID),
CONSTRAINT fk_occurs_at_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM;
drop table if exists ATTENDS;
CREATE TABLE ATTENDS (
User_ID			INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_user_event PRIMARY KEY (User_ID, Event_ID),
CONSTRAINT fk_user_attends foreign key (User_ID) references USER_DETAILS(User_ID),
CONSTRAINT fk_attends_event	foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

drop table if exists EVENT_HOST;
CREATE TABLE EVENT_HOST (
University_ID		INT NOT NULL,
Host_ID				INT NOT NULL,
CONSTRAINT pk_university_host PRIMARY KEY (University_ID, Host_ID),
CONSTRAINT fk_university_event_host foreign key (University_ID) references UNIVERSITY(University_ID),
CONSTRAINT fk_host_event_host foreign key (Host_ID) references EVENT_DETAILS(Event_ID));

drop table if exists SPONSORS_OF;
CREATE TABLE SPONSORS_OF (
Sponsor_ID			INT NOT NULL,
Event_ID			INT NOT NULL,
CONSTRAINT pk_sponsor_event PRIMARY KEY (Sponsor_ID, Event_ID),
CONSTRAINT fk_sponsor_sponsors_of foreign key (Sponsor_ID) references SPONSOR(Sponsor_ID),
CONSTRAINT fk_sponsors_of_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

drop table if exists PRESENTS_AT;
CREATE TABLE PRESENTS_AT (
Presenter_ID		INT NOT NULL,
Event_ID			INT NOT NULL,
CONSTRAINT pk_presenter_event PRIMARY KEY (Presenter_ID, Event_ID),
CONSTRAINT fk_presenter_presents_at foreign key (Presenter_ID) references PRESENTER(Presenter_ID),
CONSTRAINT fk_presents_at_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));

use AEM;
drop table if exists SPEAKS_AT;
CREATE TABLE SPEAKS_AT (
Speaker_ID		INT NOT NULL,
Event_ID		INT NOT NULL,
CONSTRAINT pk_speaker_event PRIMARY KEY (Speaker_ID, Event_ID),
CONSTRAINT fk_speaker_speaks_at foreign key (Speaker_ID) references SPEAKER(Speaker_ID),
CONSTRAINT fk_speaks_at_event foreign key (Event_ID) references EVENT_DETAILS(Event_ID));



