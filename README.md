# Shop It Online (SIO)
Small online shopping site using Laravel a PHP framework

## About Project
1. A small online shopping site
2. Three types of users admin,seller and customer
3. Even the public can buy the product without registering
4. Can add Options to the product
5. Uses the 3 themes available on the internet i.e. OneTech, Dashio and AdminLTE

## Steps to launch the project
1. Install PHP 7 or higher. You can install xampp to install the PHP https://www.apachefriends.org/download.html
2. Install composer from the site https://getcomposer.org/download/ It is a PHP dependency manager
### 3. Create a new database of name "sio" in xampp 
- Open xampp control panel
- Start the apache and MySQL
- To create a database in xampp follow the steps in the given in site https://complete-concrete-concise.com/web-tools/creating-a-mysql-database-using-xampp/
### 4. Now Open the Terminal (Command prompt or powershell for the windows)
- Go to the location where the project's folder is located for e.g. going to the htdocs in xampp is cd c:\xampp\htdocs\shop_it_online
- Run the commad "php artisan migrate"
- Run command "php artisan db:seed"
- Run commad "php artisan serve"
5. Open your browser and go to http://127.0.0.1:8000
6. The project is now running


