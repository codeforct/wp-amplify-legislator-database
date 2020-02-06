CREATE TABLE IF NOT EXISTS legislators (
	district char(3),
	office_code char(1),
	district_number varchar(255),
	designator_code char(1),
	first_name varchar(255),
	middle_initial char(2),
	last_name varchar(255),
	suffix varchar(255),
	commonly_used_name varchar(255),
	home_street_address varchar(255),
	home_city varchar(255),
	home_state varchar(255),
	home_zip_code varchar(255),
	home_phone varchar(255),
	capitol_street_address varchar(255),
	capitol_city varchar(255),
	capitol_phone char(12),
	room char(4),
	room_number varchar(255),
	committees_chaired varchar(255),
	committees_vice_chaired varchar(255),
	ranking_member varchar(255),
	senator_representative varchar(255),
	party varchar(255),
	title varchar(255),
	gender varchar(255),
	business_phone varchar(255),
	email varchar(255),
	fax varchar(255),
	prison varchar(255),
	url varchar(255),
	committee_codes varchar(255)
);

TRUNCATE TABLE legislators;

LOAD DATA LOCAL INFILE 'LegislatorDatabase.csv'
INTO TABLE legislators
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
