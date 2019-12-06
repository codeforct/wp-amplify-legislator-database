# Amplify Legislators Database

Legislator Database CSV: http://ftp.cga.ct.gov/pub/data/LegislatorDatabase.csv

## How to install

### Development

-  [Running WordPress locally with MAMP in Windows and Mac](https://gist.github.com/jpadilla/5a5eff182c42677a8d8f40f87ffb207d#file-running-wordpress-locally-md)
- Clone repository to `htdocs/wp-content/plugins/`
- Go to http://localhost:8888/wp-admin/plugins.php and activate plugin

### Development with Docker
An alternative to M/W/XAMP is to use [docker](https://www.docker.com/) with or without [docker-compose](https://docs.docker.com/compose/). This project contains a `docker-compose.yml` file to help you begin developing quickly. If you need to install docker and docker-compose, you can use the following links:

- [Docker installation instructions](https://docs.docker.com/v17.09/engine/installation/#supported-platforms)
- [Docker compose installation instructions](https://docs.docker.com/v17.12/compose/install/#install-compose)

The `docker-compose` file included uses docker images for [WordPress 5.3](https://hub.docker.com/_/wordpress) and [mysql 5.7](https://hub.docker.com/_/mysql). To start the project, run `docker-compose up`. This will: 

- fetch the required docker images if you don't currently have them
- create persistent database and server volumes
- mount the current working directory to the appropriate plugins directory within the `wordpress` container

After startup, visit [localhost](http://localhost) to view the wordpress installation. The admin area will be available at [localhost/wp-admin](http://localhost/wp-admin) after the initial configuration. To view the database directly using SequelPro (for example) configure a connection using:

- Host: 127.0.0.1
- Username: `wordpress`
- Password: `wordpress`
- Database: `wordpress`
- Port: `3306`

To stop the containers, you can use the terminal command `docker stop $(docker ps -q)` or (on Mac) `ctrl C`.

To remove the containers without destroying the persistent volumes use `docker-compose down`. To also destroy the volumes, use `docker-compose down -v`.