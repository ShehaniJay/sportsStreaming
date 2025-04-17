This project is a simple yet functional prototype of a sports streaming web platform built using HTML, CSS, PHP, and SQL using wampserver. The platform mimics the structure of a professional sports streaming website, focusing on user authentication, a styled content-rich homepage, and responsive design elements.
The goal of this platform is to provide a foundation for building a more robust and scalable streaming service in the future.

Features:
Users can create an account with a name, email, and password.
Registered users can log in with their credentials.
Passwords are securely stored using password_hash()
Upon successful login, users are redirected to the main home page.

Database Structure:
Database name- sportsstreamingdb

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(191) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP
);

Future Improvements:
Add video stream embedding.
Enable real-time chat.
Add user profile pages with history and favorite teams.
