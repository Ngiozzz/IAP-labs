# 🛠️ Lab 2 — LAMP Stack Installation (5 Marks)

## ✔️ Student: <Your Name>
## ✔️ Course: <Course Name>
## ✔️ Lab: LAMP Stack

---

## 1. Overview
This lab demonstrates the installation and verification of the LAMP stack on my Linux system.

**Components Installed:**
- **Linux:** Ubuntu 22.04 LTS (example)
- **Apache:** Web server
- **MySQL/MariaDB:** Database server
- **PHP:** Server-side scripting language

---

## 2. Installation Commands

### Apache
```bash
sudo apt update
sudo apt install apache2 -y
sudo systemctl enable apache2
sudo systemctl start apache2

### MySQL
```bash
sudo apt install mysql-server -y
sudo systemctl enable mysql
sudo systemctl start mysql
sudo mysql_secure_installation

### php
sudo apt install php libapache2-mod-php php-mysql -y

### Verify LAMP
Apache: Open browser → http://localhost/ → should see Apache2 Ubuntu Default Page

PHP: Create info.php in /var/www/html/ with: 
<?php phpinfo(); ?>
### Apache

## 3. Verification Commands
apache2 -v
mysql --version
php -v

