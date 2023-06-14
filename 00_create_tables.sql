DROP database IF EXISTS Bookstore;
CREATE database Bookstore;
USE Bookstore;

CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50),
  password VARCHAR(255),
  email VARCHAR(100),
  name VARCHAR(100),
  phone_number VARCHAR(20)
);

INSERT INTO users (username, password, email, name, phone_number) VALUES 
('andy', 'andy', 'andy@gmail.com', 'Andy', '0912345678'),
('bill', 'bill', 'bill@gmail.com', 'Bill', '0943435678'),
('candy', 'candy', 'candy@gmail.com', 'Candy', '0912345178'),
('david', 'david', 'david@gmail.com', 'David', '0943425678'),
('ellen', 'ellen', 'ellen@gmail.com', 'Ellen', '0913545678'),
('feler', 'feler', 'feler@gmail.com', 'Feler', '0943432678'),
('catherine', 'catherine', 'catherine@gmail.com', 'Catherine', '0912376548');


CREATE TABLE managers (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50),
  password VARCHAR(255)
);
INSERT INTO managers (username, password) VALUES ('boss', 'boss');


CREATE TABLE books (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100),
  author VARCHAR(100),
  publication_year INT,
  price DECIMAL(10, 2),
  edition VARCHAR(50),
  discount DECIMAL(5, 3)
);

INSERT INTO `books` (`title`, `author`, `publication_year`, `price`, `edition`, `discount`) VALUES
              ('Example_Title', 'Example_Author', 2000, 200.00, 'hardcover', 0.900),
              ('The Great Gatsby', 'F. Scott Fitzgerald', 1925, 256.00, 'hardcover', 0.950),
              ('To Kill a Mockingbird', 'Harper Lee', 1960, 522.00, 'paperback', 0.850),
              ('1984', 'George Orwell', 1949, 420.00, 'boardbook', 0.750),
              ('Pride and Prejudice', 'Jane Austen', 1813, 125.00, 'boardbook', 0.880),
              ('The Catcher in the Rye', 'J.D. Salinger', 1951, 842.00, 'hardcover', 0.850),
              ('The Hobbit', 'J.R.R. Tolkien', 1937, 565.00, 'paperbook', 0.950),
              ('To the Lighthouse', 'Virginia Woolf', 1927, 182.00, 'boardbook', 0.500),
              ('Moby-Dick', 'Herman Melville', 1851, 575.00, 'paperbook', 0.750),
              ('The Lord of the Rings', 'J.R.R. Tolkien', 1954, 442.00, 'paperbook', 0.850),
              ('Harry Potter and the Sorcerer Stone', 'J.K. Rowling', 1997, 513.00, 'paperbook', 0.750),
              ('The Chronicles of Narnia', 'C.S. Lewis', 1950, 123.00, 'paperbook', 0.950),
              ('The Alchemist', 'Paulo Coelho', 1988, 236.00, 'paperbook', 0.850),
              ('Brave New World', 'Aldous Huxley', 1932, 478.00, 'paperbook', 0.850),
              ('The Great Gatsby: Special Edition', 'F. Scott Fitzgerald', 1925, 456.00, 'paperbook', 0.750),
              ('The Hunger Games', 'Suzanne Collins', 2008, 985.00, 'paperbook', 0.850),
              ('To Kill a Mockingbird: 50th Anniversary Edition', 'Harper Lee', 1960, 756.00, 'boardbook', 0.950),
              ('The Chronicles of Narnia: Complete Collection', 'C.S. Lewis', 1950, 745.00, 'boardbook', 0.850),
              ('Pride and Prejudice: Deluxe Edition', 'Jane Austen', 1813, 465.00, 'boardbook', 0.500),
              ('The Catcher in the Rye: Anniversary Edition', 'J.D. Salinger', 1951, 495.00, 'boardbook', 0.850),
              ('Hamlet', 'William Shakespeare', 1603, 945.00, 'boardbook', 0.750),
              ('To the Lighthouse: Modern Classics Edition', 'Virginia Woolf', 1927, 543.00, 'boardbook', 0.880);

CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  book_id INT,
  shipping_method VARCHAR(50),
  payment_method VARCHAR(50),
  invoice_method VARCHAR(50),
  price DECIMAL(10),
  discount DECIMAL(10,3),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (book_id) REFERENCES books(id)
);


INSERT INTO orders (user_id, book_id, shipping_method, payment_method, invoice_method, price, discount) VALUES
              ('1', '1', 'cargo', 'creditcard', 'invoice1', 200, 0.9),
              ('3', '2', 'logistic', 'creditcard', 'invoice2', 256, 0.95),
              ('4', '3', 'cargo', 'creditcard', 'invoice1', 522, 0.85),
              ('6', '4', 'logistic', 'creditcard', 'invoice2', 420, 0.75),
              ('7', '5', 'cargo', 'creditcard', 'invoice1', 125, 0.88),
              ('1', '6', 'logistic', 'creditcard', 'invoice2', 842, 0.85),
              ('1', '8', 'cargo', 'creditcard', 'invoice1',182,0.5),
              ('5', '9', 'logistic', 'creditcard', 'invoice2', 575, 0.75),
              ('2', '10', 'cargo', 'debit_card', 'invoice1',442,0.85);



-- CREATE TABLE coupons (
--   id INT PRIMARY KEY AUTO_INCREMENT,
--   coupon_code VARCHAR(50),
--   discount_percentage DECIMAL(5, 2)
-- );
