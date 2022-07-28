# Peek-A-Book

During these tough times, its best to avoid any possible way of going out and getting in physical contact with anyone or anything, but that is no good reason to waste the plethora of time we have got due to the pandemic. Thanks to the advanced technology that we can get what we want online. Thus we came up with the idea of making our favourite books just a click away from us.

# Introduction
Peek-A-Book is an online e-commerce based bookstore which allows users to pick their favourite books. 


* To buy a book the user must register to the web app and create their profile. 
* The user can filter the list of available books on the homepage, based on parameters like genre and price of the book.
* The user can add a book to their wishlist if they do not wish to buy the book right away.
* Even if the user logs out the items in the wishlist and the cart are still saved.
* The user may change the quantity of the book from the cart and proceed to checkout.
* The user may check their order history at ay time
* Any user (not necessarily registered user) can contact the admin using contact us forms. To avoid spam entries, the contact us form is provided with a captcha.
* When a book is bought the count of total book is reduced. If no more copies are left, the user is notified that the book is out of stock on the home page.
* Incase only a few copies of a book are available the user is notified on the homepage.
* An admin login is provided for the admin to manage the inventory and check the orders. The admin dashboard can be accessed using the following credentials.
  | Admin Name | Admin Password |
  |------------|----------------|
  | admin@1    | Aa@12345       |

# Tools and Databases
* [XAMPP](https://www.apachefriends.org/download.html): Cross-platform web server solution stack package 
* [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/)

# Languages Used:
* [PHP](https://www.php.net/): Backend
* HTML, CSS, JS, AJAX, Jquery: Frontend

# Getting Started
Step 1: Install XAMPP using the link provided above or alternatively follow this [video](https://www.youtube.com/watch?v=O6T8YPUmyj8)

Step 2: Clone the repository in the htdocs folder. For eg if your XAMPP has been installed in C:\Program Files\xampp then navigate to the htdocs folder present in the above path and run the following command:
$ git clone https://github.com/Bhavik-20/Peek-A-Book.git

Step 3: Enable XAMPP enviroment
Run the Apache and MySql Module in XAMPP as shown below
image.png

Step 4: Run Application
Open any browser and enter the following URL:
$ localhost/Peek-A-Book/index.php