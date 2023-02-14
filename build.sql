create table user (
userid INT AUTO_INCREMENT NOT NULL,
Fname VARCHAR(50) NOT NULL,
Lname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
PRIMARY KEY (userid)
) ENGINE=INNODB;

create table profile (
FavSport VARCHAR(50),
FavTeam VARCHAR(50),
GradYear INT(4),
bio VARCHAR(200),
userid INT NOT NULL,
FOREIGN KEY (userid) REFERENCES user(userid)
) ENGINE=INNODB; 

create table room (
id INT NOT NULL AUTO_INCREMENT,
roomName varchar(50),
PRIMARY KEY (id)
)engine = innodb;

create table participants (
id INT NOT NULL AUTO_INCREMENT,
userID INT NOT NULL,
roomID INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (userID) REFERENCES user(userid),
FOREIGN KEY (roomID) REFERENCES room(id)
) ENGINE=INNODB;

create table chatMessage (
id INT AUTO_INCREMENT NOT NULL,
userMessage varchar(250),
userID INT NOT NULL,
roomID INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (userID) REFERENCES user(userid),
FOREIGN KEY (roomID) REFERENCES room(id)
) ENGINE=INNODB;

CREATE TABLE calendar (
  calid INT AUTO_INCREMENT NOT NULL,
  title VARCHAR(255) NOT NULL,
  start DATETIME NOT NULL,
  end DATETIME NOT NULL,
  description TEXT,
  PRIMARY KEY (calid)
)ENGINE=INNODB;

create table privateEvent (
privateEventID INT NOT NULL, 
eventTitle VARCHAR(100),
Year INT(4) NOT NULL,
Month INT(2) NOT NULL,
Day INT(2) NOT NULL,
PRIMARY KEY (privateEventid)
) ENGINE=INNODB; 

CREATE TABLE Intramurals(
Preferred_sport VARCHAR(20),
On_team VARCHAR(1),
user_email VARCHAR(200),
player_id INT  NOT NULL,
FOREIGN KEY (Player_id) REFERENCES user (userid)
) engine = innodb;

create table polls (
pollID INT NOT NULL,
AwayTeam VARCHAR(50),
HomeTeam VARCHAR(50),
Sport VARCHAR(50),
Awayscore INT,
Homescore INT,
AwayVotes INT,
HomeVotes INT,
TotalVotes INT,
PRIMARY KEY (pollID)
) ENGINE=INNODB;

CREATE TABLE team_rosters(
Team_id INT not null,
Player_id INT not null,
FOREIGN KEY (Team_id) REFERENCES Teams(Team_id),
FOREIGN KEY (Player_id) REFERENCES user(userid)
)engine=innodb;
CREATE TABLE Teams(
Team_id INT NOT NULL AUTO_INCREMENT,
team_name VARCHAR(40),
Sport VARCHAR(20),
League VARCHAR(15),
Num_players INT(2),
PRIMARY KEY (Team_id)
)engine=innodb;

CREATE TABLE community (
comm_id INT(2) auto_increment NOT NULL,
comm_name VARCHAR(40),
comm_subject VARCHAR(40),
comm_bio VARCHAR(80),
privacy boolean DEFAULT FALSE,
PRIMARY KEY (comm_id)
) engine=innodb;

CREATE TABLE community_people(
Comm_id INT,
Person_id INT,
FOREIGN KEY (Comm_id) REFERENCES community(comm_id),
FOREIGN KEY (Person_id) REFERENCES user(userid)
)engine=innodb; 

Create table iulive(
GameID INT NOT NULL AUTO_INCREMENT,
GameClock VARCHAR (7) NOT NULL,
Year INT(4) NOT NULL,
Month INT(2) NOT NULL,
Day INT(2) NOT NULL,
GameTime TIME NOT NULL,
GameChannel VARCHAR (10) NOT NULL,
GameScore VARCHAR (7) NOT NULL,
GamePeriod VARCHAR (10) NOT NULL,
PRIMARY KEY (GameID)
) ENGINE = innodb;

Create table team(
Name VARCHAR (50) NOT NULL,
Sport VARCHAR (20) NOT NULL,
Record VARCHAR (7) NOT NULL,
ConferenceRecord VARCHAR (7) NOT NULL,
TeamID INT NOT NULL,
FOREIGN KEY (TeamID) REFERENCES iulive(GameID)
) ENGINE = innodb;


INSERT INTO user VALUES 
(1001, 'Jess', 'Foxworthy', 'jfox12@iu.edu', 'FoxSox12'),
(1002, 'James', 'Messer', 'jmess@iu.edu', 'reasd221'),
(1003, 'Taylor', 'Ham', 'tham@iu.edu', 'Hamm123'),
(1004, 'Isaiah', 'Quinn', 'IsaiahQ@iu.edu', 'OSUrocks2023'),
(1005, 'Hank', 'Lights', 'HankLi33@iu.edu', 'LightsOUT3'),
(1006, 'Zack', 'Klao', 'Klaoz@iu.edu', 'terrrpppps12'),
(1007, 'Luke', 'Fields', 'Lfields@iu.edu', 'FlukeyLukey23'),
(1008, 'Frank', 'Tank', 'frtank@iu.edu', 'tanks2023');

INSERT INTO profile VALUES 
('Basketball', 'Indiana Pacers', 2023, 'A basketball fanatic that is looking for teammates to play.', 1001),
( 'Baseball', 'Chicago Cubs', 2025, 'I love the cubs and also sometimes watch the bears.', 1002),
('Lacrosse', 'Duke University', 2025, 'Looking for people to throw the lax ball with.', 1003),
('Football', 'Chicago Bears', 2024, 'Want to watch the bears win the superbowl with  some other bears fans this year.', 1004),
('Soccer', 'USA Soccer', 2026, 'Trying to find players for a soccer team.', 1005),
('Basketball', 'Lakers', 2024, 'Informatics major who wants to become more active.', 1006),
('Softball', 'Sparks', 2023, 'I love playing softball, but cannot find people to play with.', 1007),
('Baseball', 'Chicago Cubs', 2024, 'Cubs fan, from Chicago, looking for people to come to a few games this spring..', 1008);

INSERT INTO room VALUES 
(601,'workout partner'),
(602,'');

INSERT INTO participants VALUES 
(901, 1001, 601),
(902, 1002, 601),
(903,1001, 602),
(904, 1003, 602);

INSERT INTO chatMessage VALUES
(2001,'lets go workout',1001, 601),
(2002,'bet leaving in 5',1002, 601),
(2003,'bett',1001, 601);

INSERT INTO calendar VALUES
(701, 'Baseball game', 2023, 02, 21),
(702, 'Men Basketball game', 2023, 02, 27),
(703, 'Women Basketball game', 2023, 03, 16),
(704, 'Men Baseball game', 2023, 04, 03),
(705, 'Softball game', 2023, 04, 05),
(706, 'Men Baseball game', 2023, 04, 30),
(707, 'Softball game', 2023, 05, 31);

INSERT INTO calendar VALUES 
(701,"IU men's Basketball", '2023-02-15 20:00:00', '2023-02-15 23:00:00', 'Indiana takes on NorthWestern'),
(702,"IU Women's Basletball", '2023-02-17 21:00:00', '2023-02-17 23:00:00', 'Indiana women takes on NorthWestern'),
(703,'IU Gymnastics', '2023-02-18 19:00:00', '2023-02-18 21:00:00', 'Indiana gymnastic meet at Assembly Hall'),
(704,"IU Women's Basketball", '2023-02-19 20:00:00', '2023-02-19 22:00:00', 'Indiana takes on Purdue'),
(705,"IU men's Basketball", '2023-02-19 22:00:00', '2023-02-19 23:00:00', 'Indiana takes on Iowa'),
(706,"IU Women's Basketball", '2023-02-20 19:00:00', '2023-02-20 21:00:00', 'Indiana starts the Big Ten Tourney'),
(707,'IU Baseball', '2023-02-26 12:00:00', '2023-02-26 3:00:00', 'Indiana takes on Wisconsin'),
(708,"IU men's Basketball", '2023-02-28 20:00:00', '2023-02-28 22:00:00', 'Indiana starts big ten toruney');

INSERT INTO privateEvent VALUES
(801, 'Watch Party', 2023, 02, 21),
(802, '5v5 pickup', 2023, 02, 27),
(803, 'Catch with baseball', 2023, 03, 16),
(804, 'Soccer Tournament', 2023, 04, 03),
(805, '5v5 pickup', 2023, 04, 05),
(806, 'Watch Party at DJs', 2023, 04, 30),
(807, 'Catch with football', 2023, 05, 31);

INSERT INTO Intramurals VALUES
( 'Basketball', 'N', 'jsmith@iu.edu',1001), 
( 'Football', 'Y', 'hjohns@iu.edu', 1002), 
( 'Volleyball', 'N', 'rands@iu.edu',1003),
( 'Basketball','N', 'norths@iu.edu',1004),
( 'Badminton', 'N', 'pharold@iu.edu', 1005);

INSERT INTO polls VALUES  
(501, 'Indiana Hoosiers', 'Illinois Orangmen', 'Basketball', 68, 57, 102, 103, 205),
(502, 'Indiana Hoosiers', 'Kentucky Wildcats', 'Basketball', 63, 57, 104, 104, 208),
(503, 'Chicago Cubs', 'Cincinnati Reds', 'Baseball', 8, 9, 156, 103, 259),
(504, 'Notre Dame', 'Clemson', 'Football', 21, 43, 109, 104, 213),
(505, 'Indiana Hoosiers', 'West Virginia', 'Basketball', 69, 47, 102, 103, 205),
(506, 'Dayton Flyers', 'Kent State Goldenhawks', 'Softball', 3, 7, 106, 104, 210);

INSERT INTO Teams VALUES
(101, 'VolleyBallers', 'Volleyball', 'Competitive', 7),
(102, 'Dream Team', 'Basketball', 'Casual', 6),
(103, 'Flint Tropics', 'Basketball', 'Competitive', 7),
(104, 'Real Madrid', 'Soccer', 'Competitive', 13),
(105, 'Barcelona', 'Soccer', 'Casual', 12),
(106, 'Netters', 'Volleyball', 'Casual', 6),
(107, 'Magic', 'Badminton', 'Competitive', 2),
(108, 'Servers', 'Badminton', 'Casual', 2),
(109, 'Raiders', 'Football', 'Competitive', 8);

INSERT INTO team_rosters VALUES 
(101, 1002),
(101,1004),
(102, 1001),
(102,1007);


INSERT INTO community VALUES 
(301, 'NFL Fans', 'Football', 'A group of people who love to watch the nfl.',TRUE),
(302, 'NBA Fans', 'Basketball', 'Nba enthusiasts!',FALSE),
(303, 'Hoosiers BBall', 'Basketball', 'Huge Hoosiers fans.', TRUE),
(304, 'Futbol (soccer) group', 'Soccer', 'International futbol fans', TRUE),
(305, 'Sports betting', 'Sports', 'For people who love to sports wager', TRUE),
(306, 'Pickup games','Sports', 'A community to communicate pickup games', FALSE),
(307, 'Sports watching', 'Sports', 'Set up watch parties for big games!', TRUE);

INSERT INTO community_people VALUES 
(301, 1001),
(302, 1002),
(303, 1003);




INSERT INTO iulive VALUES
(2002, '5:07', 2021, 10, 22, '12:00:00', 'BTN', '7-14', '2nd'),
(2003, '1:11', 2021, 10, 29, '7:00:00', 'ABC', '21-21', '4th'),
(2004, '11:59', 2021, 09, 11, '3:00:00', 'FOX', '0-0', '1st'),
(2005, '18:12', 2021, 12, 14, '9:00:00', 'CBS', '4-12', '1st'),
(2006, '3:32', 2021, 12, 23, '12:00:00', 'ESPN', '89-82', '2nd');


INSERT INTO team VALUES
('Indiana Hoosiers', 'Football', '5-4', '1-2', 2002),
('Rutgers Scarlet Knights', 'Football', '4-5', '0-3', 2003),
('Michigan State Spartans', 'Football', '7-2', '2-1', 2004),
('Indiana Hoosiers', 'Basketball', '10-2', '1-1', 2005),
('Rutgers Scarlet Knights', 'Basketball', '9-3', '1-1', 2006);

create table polls (
id INT NOT NULL AUTO_INCREMENT,
title VARCHAR(255) NOT NULL,
pollID int NOT NULL,
userID INT NOT NULL,
FOREIGN KEY (userID) REFERENCES user(userid),
PRIMARY KEY (id)
) ENGINE=INNODB;

create table questions (
id INT NOT NULL AUTO_INCREMENT,
question VARCHAR (50) NOT NULL,
votes INT NOT NULL,
pollID INT NOT NULL,
FOREIGN KEY (pollID) REFERENCES polls(id),
PRIMARY KEY (id)
) ENGINE=INNODB;

INSERT INTO polls VALUES  
(1, 'Test Poll', 1, 1001),
(2, 'Test Poll', 2, 1002),
(3, 'Test Poll', 3, 1003);


INSERT INTO questions VALUES  
(1, 'Indiana Hoosiers', 1, 1),
(2, 'Rutgers Scarlett Knights', 0, 1),
(3, 'Michigan Wolverines', 2, 2),
(4, 'Michigan State Spartans', 0, 2),
(5, 'Wisconsin Badgers', 0, 3),
(6, 'Iowa Hawkeyes', 3, 3);

CREATE TABLE polls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer_1 VARCHAR(255) NOT NULL,
    answer_2 VARCHAR(255) NOT NULL
);

CREATE TABLE poll_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    answer VARCHAR(255) NOT NULL,
    FOREIGN KEY (poll_id) REFERENCES polls(id)
);

INSERT INTO polls VALUES  
('Poll 1', 'Rutgers Scarlett Knights', 'Indiana Hoosiers'),
('Poll 2', 'Michigan Wolverines', 'Michigan State Spartans'),
('Poll 3', 'Wisconsin Badgers', 'Iowa Hawkeyes'),
('Poll 4', 'Purdue Boilermakers', 'Nebraska Cornhuskers'),
('Poll 5', 'Kansas Jayhawks', 'Oklahoma Sooners'),
('Poll 6', 'Auburn Tigers', 'LSU Tigers');

INSERT INTO poll_responses VALUES
(1, '')
(2, '')
(3, '')
(4, '')
(5, '')
(6, '')
