CREATE TABLE IF NOT EXISTS town_reps (
	town varchar(255),
	cac char(2),
	reptype varchar(255),
	lastname varchar(255),
	district char(3)
);

TRUNCATE TABLE town_reps;

LOAD DATA LOCAL INFILE '{INFILE}' INTO TABLE town_reps IGNORE 1 LINES;
