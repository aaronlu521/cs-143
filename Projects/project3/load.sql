DROP TABLE IF EXISTS Laureates;
DROP TABLE IF EXISTS Prize;
DROP TABLE IF EXISTS Associate;
DROP TABLE IF EXISTS Affiliation;
create table Laureates(id INT, givenName varchar(100), familyName varchar(30), gender varchar(10), birthDate varchar(50), city varchar(50), country varchar(50), primary key(id));
create table Prize(id INT, awardYear INT, category varchar(30), sortOrder INT, primary key(id, awardYear));
create table Associate(idx INT, id INT, awardYear INT, category varchar(30), name varchar(100), city varchar(50), country varchar(50), UNIQUE(idx)); 
create table Affiliation(idx INT, name varchar(100), city varchar(50), country varchar(50), UNIQUE(idx));
LOAD DATA LOCAL INFILE 'laureates.del' into table Laureates
fields terminated by '\t'
lines terminated by '\n';
LOAD DATA LOCAL INFILE 'affiliation.del' INTO TABLE Affiliation
fields terminated by '\t'
lines terminated by '\n';
LOAD DATA LOCAL INFILE 'assoc.del' into table Associate
fields terminated by '\t'
lines terminated by '\n';
LOAD DATA LOCAL INFILE 'prize.del' into table Prize
fields terminated by '\t'
lines terminated by '\n';
