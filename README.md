# Todo-website-using-PHP

Front end: bootstrap,bulma,html,css
Back-end:PHP
Database connectivity:MySQL

XAMPP is used which creates MySQL done by phpmyadmin.
MySQLi and PDO(PHP Data Objects) used for database connectivity with PHP code

For linux Operating System(Fedora 32):

Command to open Xampp from command line:
 cd /opt/lampp/
 sudo ./manager-linux-x64.run
 
 Command to create and write PHP code:
 cd /opt/lampp/htdocs
 sudo gedit file_name.php
 
 To provide permission to execute PHP code run:
 sudo chmod +x file_name.php
 
 * Then start the MySQL and apache server in Xampp
 * In browser visit localhost/phpmyadmin/ to manage database MySQL
 * To run PHP code in browser visit localhost/file_name.php
 * To connect PHP code with database dbconnect.php file is created
 
 If error or if MySQL or apache server not starts then run this commands
 
 * sudo ./lampp start
 * sudo service mysqld stop
 * sudo service mysqld start
 
