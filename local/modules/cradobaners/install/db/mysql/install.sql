create table if not exists b_cradobaners
(
	ID int(11) not null auto_increment,
	UF_COUNTCLICK int(18) not null,
	UF_DATECLICK datetime,
	UF_COUNTVIEW int(18) not null,
	UF_IDBANERS int(18) not null,
	primary key (ID)
);