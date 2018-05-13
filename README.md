# Foodmate

Foodmate is a multi user recipe management system developed by TeamFoodmate, at Charles Darwin University. Foodmate uses a database backend to store recipe ingredients, steps, quantities on a private or global basis.

You can use Foodmate to export shopping lists from your selected recipes to print out or access on your phone at any time, dynamically adding or removing recipes to the list.

Foodmate is written in PHP using the CodeIgniter framework. It has been designed with Nginx+PHP-FPM and MariaDB in mind, but other databases/webservers should work due to CodeIgniter's database agnostic helper functions.

## Setup

### Database

Database schema scripts are provided for Mysql in the application/sql directory. For MySQL,
- Log into MySQL as root
  ```
  mysql -uroot -p
  ```
- Create a foodmate database and user
  ```
  CREATE DATABASE ci;
  GRANT ALL PRIVILEGES ON ci.* TO 'username'@'localhost' IDENTIFIED BY 'password';
  ```
- Log out of MySQL and use the SQL schema script to create the database
  ```
  mysql -u username -p ca <foodmate.sql
  ```

You need to load some configuration varialbes into the $db['default'] array in the CodeIgniter database configuration file at application/config/database.php:
- hostname
- username
- password
- database

### Application Configuration

Modify the application/config/config.php file, at minimum, setting the following:
```
$config['base_url']
```

If using a reverse proxy, set the following option in application/config/config.php:
```
$config['proxy_ips']
```

Lastly, modify the options in the application/config/ion_auth.
```
$config['site_title']  
$config['admin_email']
```

## Deployment

Foodmate is tested with nginx and there is a sample configuration file in the base directory, foodmate.conf.

## TODO

- Recipe tag support
  - Global recipes listed in home page
- Taste.com import
