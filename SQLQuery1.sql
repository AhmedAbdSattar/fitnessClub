create table person (
	name varchar(20) not null,
	username varchar(50) not null primary key,
	password varchar(47) not null,
	permission TINYINT not null DEFAULT 3,
	phoneNumber varchar(11) unique,
	image VARCHAR(1000) DEFAULT 'PERSON.png'
);

create table shiftWork (
	shiftNum varchar(50) not null primary key,
	day TINYINT not null,
	startTime time not null,
	endTime time,
	MaxMemberNumber int
);

create table trainerShift(
	trainerID varchar(30) not null REFERENCES person (username),
	shiftNum varchar (50) not null REFERENCES shiftWork (shiftNum),
	HoursNum int,
  PRIMARY KEY(shiftNum, trainerID)
);

create table bill(
	bill_ID int primary key AUTO_INCREMENT,
	endOfTheGracePeriod DATE,
	paied boolean
);

create table package(
	packageName Varchar(50) not null primary key,
	discount float,
	shiftCost float
);

create table packageshift(
	shiftNum varchar (50) not null REFERENCES shiftWork (shiftNum),
	packageName Varchar(50) not null REFERENCES package (packageName),
	PRIMARY KEY(shiftNum, packageName)
);

create table billPackage(
	packageName varchar(50) REFERENCES package (packageName),
	bill_ID int not null REFERENCES bill (bill_ID),
  PRIMARY KEY(packageName, bill_ID)
);

create table memberAttendance(
	member varchar(30) REFERENCES person (username),
	attData DATETIME not null,
  PRIMARY KEY(member, attData)
);

create table memberBill(
	member varchar(30)  not null REFERENCES person (username),
	bill_ID int REFERENCES bill (bill_ID),
  PRIMARY KEY (member, bill_ID)
);
