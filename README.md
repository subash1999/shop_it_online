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
_Note: The mysql must running be at port 3306 in xampp, otherwise please change the database_port in .env file if you know laravel_

- Open xampp control panel
- Start the apache and MySQL
- To create a database in xampp follow the steps in the given in site https://complete-concrete-concise.com/web-tools/creating-a-mysql-database-using-xampp/

### 4. Now Open the Terminal (Command prompt or powershell for the windows)
- Go to the location where the project's folder is located for e.g. going to the htdocs in xampp is cd c:\xampp\htdocs\shop_it_online
- Run the commad "php artisan migrate --seed"
- Run commad "php artisan serve"
5. Open your browser and go to http://127.0.0.1:8000
6. The project is now running

## Website Walkthrough
_Registration is Required before continuing to the website_
### Customer Register and seller Register
**1. Seller register**
- Go to the seller navigation item and click the seller register that appears in the dropdown

**2. Customer Registration**
- Click the reigster nav item in the rightmost of the navigation bar of the website

### Single Login for customer,seller and admin
**You will be given the view according to your user type**
- Click the login in the right side for the logging in into the website

## Features
1. Multiple sellers can sell their products
2. Discount Coupons can be issued for the customers by admins
3. Wallet is also available for the customers
4. You can get the bill of your order on the email
5. Password required for the customers to verify the purchase of products
6. Not registerd users have to verify their purchase through their email
7. Not registered users cannot use discount coupons 
8. Not registered users can get the bill of the purchase to their email after the verification of the purchase
9. Sellers can view the number of product clicks in the product in bar chart form
10. Admin can generate Wallet Recharge number
11. **Currency can be changed**, we can change currency from navigation bar
12. Admin can send the email to any of the user in the site form the admin panel




