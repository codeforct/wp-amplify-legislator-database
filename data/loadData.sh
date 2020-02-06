#!/bin/bash
#Author: Adam Vincent
#Author URI: https://www.codeforconnecticut.org
#License: GPL-2.0+
#License URI: https://www.gnu.org/licenses/gpl-2.0.txt

function _usage
{
	echo >&2 "Usage: $(basename $0) [-h hostname] -u username -p password -d database [-r RepresentativesDataSourceURI]"
	echo >&2 "This script downloads the most recent parsed CAC Representative data from the given "
        echo >&2 " (or default) data source and loads it into the database using the provided credentials."
	echo >&2 "Use -h to specify the MySQL hostname. Defaults to localhost."
	echo >&2 "Use -u to specify the MySQL username."
	echo >&2 "Use -p to specify the password for the MySQL username provided with -u."
	echo >&2 "Use -d to specify the MySQL database name."
	exit 3
}

host=localhost
while getopts ":d:h:p:r:u:" opt
do
	case "$opt" in
	   d) database="$OPTARG";;
	   h) host="$OPTARG";;
	   p) password="$OPTARG";;
           r) datasource_townreps="$OPTARG";;
           u) user="$OPTARG";;
	  \?) _usage;;
	esac
done
shift $(( $OPTIND - 1 ))

if [[ -z $user || -z $password || -z $database ]]; then
	_usage
fi

if [[ -z $datasource_townreps ]]; then
	datafile="data.csv"
	datasource_townreps="https://interesting-moss.glitch.me/${datafile}"
else
	#bash parameter expansion to remove everything up to and including the final '/'
	datafile="${datasource_townreps##*/}"
fi

#Get town representative info.
wget $datasource_townreps
mysql --host=$host --user=$user --password=$password "$database" < <(sed 's/{INFILE}/'${datafile}'/' load_town_reps.sql)
