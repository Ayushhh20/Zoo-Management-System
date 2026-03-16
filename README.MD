Zoo Management System
A web-based Zoo Management System (ZMS) designed to manage zoo operations such as animal records, ticket booking, and administration.
This project digitizes manual zoo management processes and provides a centralized system for managing zoo data.
________________________________________
 Project Overview
The Zoo Management System is a web application that allows administrators to manage zoo activities efficiently.
It provides features such as:
•	Animal record management
•	Visitor ticket management
•	Admin dashboard
•	Image management
•	Simulated face recognition login
This project was developed as part of the Master of Computer Applications (MCA) program.
________________________________________
Features
 Animal Management
•	Add, edit, and delete animal records
•	Store animal details (breed, cage number, description)
•	Upload and manage animal images
•	Maintain animal database
________________________________________
 Ticket Management
•	Generate visitor tickets
•	Manage Indian and foreign visitor records
•	Store ticket details and pricing
•	Maintain ticket history
________________________________________
Admin Dashboard
•	Secure login authentication
•	Manage animals and ticket records
•	View visitor statistics
•	Update admin profile
________________________________________
 Face Recognition (Simulation)
•	Upload user images
•	Match with stored profiles
•	Demonstrates user identification concept
________________________________________
 Content Management
•	Dynamic pages (About, Contact)
•	Image gallery
•	Navigation system
________________________________________
Technologies Used
Frontend
•	HTML5
•	CSS3
•	Bootstrap
•	JavaScript
•	jQuery
________________________________________
Backend
•	PHP
________________________________________
Database
•	MySQL
________________________________________
Development Environment
•	XAMPP / WAMP
•	Apache Server
________________________________________
System Architecture
Client Layer
(Web Browser)

Presentation Layer
HTML, CSS, JavaScript

Application Layer
PHP

Database Layer
MySQL
________________________________________
Database Tables
Table Name	Description
tblanimal	Stores animal details
tbltickettype	Ticket types and prices
tblticindian	Indian visitor ticket records
tblticforeigner	Foreigner visitor ticket records
tbladmin	Admin login information
tblpage	Dynamic page content
________________________________________
⚙Installation & Setup
1 Clone Repository
git clone https://github.com/yourusername/Zoo-Management-System.git
________________________________________
2 Move Project to XAMPP
Place the project inside:
xampp/htdocs/
________________________________________
3 Start XAMPP
Start the following services:
•	Apache
•	MySQL
________________________________________
4 Create Database
Open phpMyAdmin
Create database:
zmsdb
Import the provided SQL file.
________________________________________
5 Run the Project
Open in browser:
http://localhost/Zoo-Management-System
Admin panel:
http://localhost/Zoo-Management-System/admin
________________________________________
Testing
The system was tested using the following methods.
Black Box Testing
•	UI testing
•	Form validation
•	CRUD operations
White Box Testing
•	Authentication logic
•	Database queries
•	Security testing
________________________________________
Limitations
•	No mobile application support
•	Basic authentication system
•	Limited reporting functionality
•	No online payment integration
•	Basic face recognition simulation
________________________________________
Future Enhancements
Possible improvements include:
•	Multi-factor authentication
•	Cloud storage for images
•	Mobile application support
•	AI-based face recognition
•	Online payment gateway
•	Advanced analytics dashboard

