PROJECT REPORT
Futsal Court Booking Website
Problem Definition
The project aims to develop an online platform for booking futsal courts, managing coaching sessions, and facilitating user interactions. This platform addresses the need for an organized and efficient way to book futsal courts, enroll in coaching sessions, and manage related activities. The system is designed to simplify the process for users, administrators, and coaches.
Methodology
Approach
1.	Requirements Gathering: Identified the needs of the users, coaches, and administrators.
2.	Design: Created database schema to plan the system structure.
3.	Development:
o	Frontend: Developed using HTML, CSS, and a bit of JavaScript for interactivity.
o	Backend: Implemented using PHP to handle server-side logic.
o	Database: Managed using MySQL to store and retrieve data.
4.	Testing: Conducted various tests to ensure the functionality and robustness of the system.
5.	Deployment: Deployed the website on a web server.
Database Schema
The MySQL database schema includes the following tables:
•	users: Stores user information.
•	bookings: Records court bookings.
•	contact_submissions: Stores contact form submissions.
•	admin_users: Manages administrative users.
•	coaches: Contains coach details.
•	coaching_sessions: Records coaching sessions.
•	trainees: Manages trainee information.
•	enrollments: Tracks enrollments in coaching sessions.
•	packages: Contains information about different packages offered.
•	venue: Stores venue details.
•	reviews: Records user reviews for venues and coaching sessions.
•	transactions: Manages transaction details.
•	wallet: Manages user wallet balances.
•	admin_wallet: Manages admin wallet balances.
Toolkit
The tools and technologies used in the development of this project include:
•	Frontend:
o	HTML
o	CSS
o	JavaScript
•	Backend:
o	PHP
•	Database:
o	MySQL
•	Development Tools:
o	Visual Studio Code
o	phpMyAdmin for database management
Test Cases
Data Validation Tests
1.	Ensure all required fields in forms are validated.
2.	Check for unique constraints on email fields in user and admin tables.
3.	Verify data types and constraints in the database schema.
Model Accuracy Tests
1.	Test booking functionality for various time slots and field numbers.
2.	Verify correct association between users, bookings, and transactions.
3.	Ensure proper enrollment and session management for trainees and coaches.
Edge Cases
1.	Test with invalid data entries (e.g., incorrect email formats, negative numbers).
2.	Test booking conflicts (same time slot and field).
3.	Verify system behavior when database constraints are violated .
Work Distribution
•	Hassan:
o	Data collection and preprocessing
o	Frontend development (HTML, CSS,JS)
o	Database schema design and management (MySQL)

•	Shahzaib:
o	Backend development (PHP)
o	Model evaluation and testing
o	Database schema design and management (MySQL)
•	Mutahir:
o	Model evaluation and testing
o	Database schema design and management (MySQL)
o	Frontend development (HTML, CSS,JS)
o	Documentation
 Usage
Prerequisites
•	Web server (e.g., Xampp)
•	PHP
•	MySQL
Usage
1.	Navigate to the website in your browser.
2.	Register or log in to your account.
3.	Browse available futsal courts and coaching sessions.
4.	Make bookings or enroll in sessions as needed.

