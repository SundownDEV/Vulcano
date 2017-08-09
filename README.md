# DaimyoCMS
Open-source PHP CMS based on the micro framework [Daimyo](https://github.com/SundownDEV/Daimyo) ```version 0.0.5 dev|non-stable```

## Features
* Administration panel
* Manage content such as users, articles and categories
* Manage image and file upload locally or with APIs like Imgur or AnonUpload
* Form validator
* Powered by MySQL
* Very easy to custom

## Requirement
* PHP 7+
* MySQL 5+
* Composer ~1.0

# Installation (coming soon)

### Step 1
~~~ bash
$ git clone https://github.com/SundownDEV/DaimyoCMS.git
$ composer install
~~~

### Step 2
Open the file ```/web/installation.php``` on your browser and enter database and admin user informations.

### Step 3
Allow DaiymoCMS to write in ```uploads``` folder
~~~ bash
$ chmod -R 777 public/uploads
~~~
