# NameSearch

NameSearch is a simple web application that allows users to search for the meanings of names. It provides a user-friendly interface for searching and displaying name meanings.

## Description

NameSearch uses PHP and MySQL to store and retrieve name-meaning data. It utilizes Bootstrap for styling and responsiveness, providing a modern and sleek user interface. The background image changes dynamically every day, adding visual interest to the application.

## How to Use

1. Clone or download the repository to your local machine.
2. Create an sql table called 'names' here is the table: `CREATE TABLE names (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    meaning TEXT NOT NULL
);`
3. Configure the database credentials in `index.php` to match your MySQL setup.
4. Serve the project files using a local server environment such as XAMPP or WAMP.
5. Access the application in your web browser by navigating to the project directory.
6. Enter a name in the search bar and click the "Search" button to view its meaning.
7. The search results will be displayed below the search bar.

## Features

- Search for the meanings of names.
- Responsive design for optimal viewing on various devices.
- Background image changes daily for visual appeal.
- Sleek and modern user interface.

## Technologies Used

- HTML
- CSS (Bootstrap)
- JavaScript
- PHP
- MySQL

## Credits

This project was created by [Hamza Daoud] as a demonstration of web development skills.

