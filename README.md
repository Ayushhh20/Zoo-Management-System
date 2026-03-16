# Zoo Management System

A web-based **Zoo Management System (ZMS)** designed to manage zoo operations such as animal records, ticket booking, and administration.  
This project digitizes manual zoo management processes and provides a centralized system for managing zoo data.

---

## Project Overview

The Zoo Management System is a web application that allows administrators to manage zoo activities efficiently.

It provides features such as:

- Animal record management  
- Visitor ticket management  
- Admin dashboard  
- Image management  
- Simulated face recognition login  

---

## Features

### Animal Management

- Add, edit, and delete animal records  
- Store animal details (breed, cage number, description)  
- Upload and manage animal images  
- Maintain animal database  

---

### Ticket Management

- Generate visitor tickets  
- Manage Indian and foreign visitor records  
- Store ticket details and pricing  
- Maintain ticket history  

---

### Admin Dashboard

- Secure login authentication  
- Manage animals and ticket records  
- View visitor statistics  
- Update admin profile  

---

### Face Recognition (Simulation)

- Upload user images  
- Match with stored profiles  
- Demonstrates user identification concept  

---

### Content Management

- Dynamic pages (About, Contact)  
- Image gallery  
- Navigation system  

---

## Technologies Used

### Frontend
- HTML5  
- CSS3  
- Bootstrap  
- JavaScript  
- jQuery  

---

### Backend
- PHP  

---

### Database
- MySQL  

---

### Development Environment
- XAMPP / WAMP  
- Apache Server  

---

## System Architecture

```
Client Layer
(Web Browser)

Presentation Layer
HTML, CSS, JavaScript

Application Layer
PHP

Database Layer
MySQL
```

---

## Database Tables

| Table Name | Description |
|------------|-------------|
| tblanimal | Stores animal details |
| tbltickettype | Ticket types and prices |
| tblticindian | Indian visitor ticket records |
| tblticforeigner | Foreigner visitor ticket records |
| tbladmin | Admin login information |
| tblpage | Dynamic page content |

---

## Installation & Setup

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/Zoo-Management-System.git
```

---

### 2. Move Project to XAMPP

Place the project inside:

```
xampp/htdocs/
```

---

### 3. Start XAMPP

Start the following services:

- Apache  
- MySQL  

---

### 4. Create Database

Open **phpMyAdmin**

Create database:

```
zmsdb
```

Import the provided SQL file.

---

### 5. Run the Project

Open in browser:

```
http://localhost/Zoo-Management-System
```

Admin panel:

```
http://localhost/Zoo-Management-System/admin
```

---

## Testing

The system was tested using the following methods.

### Black Box Testing
- UI testing  
- Form validation  
- CRUD operations  

### White Box Testing
- Authentication logic  
- Database queries  
- Security testing  

---

## Limitations

- No mobile application support  
- Basic authentication system  
- Limited reporting functionality  
- No online payment integration  
- Basic face recognition simulation  

---

## Future Enhancements

Possible improvements include:

- Multi-factor authentication  
- Cloud storage for images  
- Mobile application support  
- AI-based face recognition  
- Online payment gateway  
- Advanced analytics dashboard  
