# Foodmate

Foodmate is a multi user recipe management system developed by TeamFoodmate, at Charles Darwin University. Foodmate uses a database backend to store recipe ingredients, steps, quantities on a private or global basis.

You can use Foodmate to export shopping lists from your selected recipes to print out or access on your phone at any time, dynamically adding or removing recipes to the list.

Foodmate is written in PHP using the CodeIgniter framework. It has been designed with Nginx+PHP-FPM and MariaDB in mind, but other databases/webservers should work due to CodeIgniter's database agnostic helper functions.

<img src=https://raw.githubusercontent.com/chrios/foodmate/master/docs/screenshots/login-page.PNG width=300>

## Setup

### Linux

Install the required programs

    sudo apt install nginx php-fpm mysql-server php-mysql

Clone the git repo

    cd /var/www/
    sudo git clone https://github.com/chrios/foodmate.git

### Nginx

Foodmate is tested with [nginx](https://www.nginx.com) and php-fpm.

Configure and test nginx

    sudo rm /etc/nginx/sites-enabled/default
    sudo cp /var/www/foodmate/foodmate.conf /etc/nginx/sites-available
    sudo ln -s /etc/nginx/sites-available/foodmate.conf /etc/nginx/sites-enabled/foodmate.conf
    
Modify foodmate.conf as required

    sudo nano /etc/nginx/sites-available/foodmate.conf
    
Set permissions on the repo folder

    sudo chown -R www-data:www-data /var/www/foodmate/*
    
Test nginx

    sudo nginx -t

### Database

Database schema scripts are provided for Mysql in the application/sql directory. For MySQL,

Start MySQL

    sudo service mysql start

Log into MySQL as root

    sudo mysql -uroot -p

Create a foodmate database and user

    CREATE DATABASE ci;
    GRANT ALL PRIVILEGES ON ci.* TO 'ciadmin'@'localhost' IDENTIFIED BY 'cipassword';

Log out of MySQL and use the SQL schema script to create the database

    exit
    mysql -u ciadmin -p ci < /var/www/foodmate/application/sql/foodmate.sql

### Application Configuration

You need to load some configuration variables into the $db['default'] array in the CodeIgniter database configuration file at application/config/database.php. Edit the following lines:

    'hostname' => 'localhost',
    'username' => 'ciadmin',
    'password' => 'cipassword',
    'database' => 'ci',

Modify the application/config/config.php file, edit the following line:

    $config['base_url'] = 'http://localhost/';

If using a reverse proxy, set the following option in application/config/config.php:

    $config['proxy_ips'] = '';

Lastly, modify the options in the application/config/ion_auth.

    $config['site_title']                 = "Foodmate";       // Site Title, example.com
    $config['admin_email']                = "foodmate@mawson.tech"; // Admin Email, admin@example.com

### Setup

Browse to your site. You will be presented with a login screen. The default credentials are

    username: admin@admin.com
    password: foodmate

## Deployment

Foodmate is tested with nginx and there is a sample configuration file in the base directory, foodmate.conf.

## Screenshots

<img src=https://raw.githubusercontent.com/chrios/foodmate/master/docs/screenshots/recipes.PNG width=300>
<img src=https://raw.githubusercontent.com/chrios/foodmate/master/docs/screenshots/users.PNG width=300>
<img src=https://raw.githubusercontent.com/chrios/foodmate/master/docs/screenshots/lists.PNG width=300>
<img src=https://raw.githubusercontent.com/chrios/foodmate/master/docs/screenshots/creating-recipe.PNG width=300>
<img src=https://raw.githubusercontent.com/chrios/foodmate/master/docs/screenshots/lists.PNG width=300>

## TODO

- Recipe tag support
