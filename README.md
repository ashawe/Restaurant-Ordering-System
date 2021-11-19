# ENPM809WProject-RestaurantOrderingSystem

## Project Setup:

- Install XAMPP / LAMPP on the machine.
- Clone the repository in the ```/opt/lampp/htdocs/``` folder on linux or 
```C:/program files/xampp/htdocs``` or similar on windows
- Create a file called CONFIG.php in the ```/opt/lampp/htdocs``` folder with the following contents:
``
<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ros";

?>
``
- goto ```localhost/phpmyadmin```. It should log you in automatically (default username is root and password is <empty>)
- Create a database named ```ros```
- Adding tables & Data:
    - to simply get the database snapshot I have right now is to "import" using the file ```sql scripts/ros.sql```
    - NOTE: Create.sql might not be updated.

### Sample credentials 
admin@mail.com:admin@1321
chef@mail.com:Hehehe123