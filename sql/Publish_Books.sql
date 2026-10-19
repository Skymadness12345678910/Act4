-- Publish_Books.sql
-- One-to-Many: Author (parent) -> Books (child)

CREATE DATABASE IF NOT EXISTS Publish_Books;
USE Publish_Books;

DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS authors;

CREATE TABLE authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    author_id INT,
    FOREIGN KEY (author_id) REFERENCES authors(author_id)
);

INSERT INTO authors (name, email) VALUES
('Author One', 'one@email.com'),
('Author Two', 'two@email.com');

INSERT INTO books (title, author_id) VALUES
('Book A', 1),
('Book B', 1),
('Book C', 2);
