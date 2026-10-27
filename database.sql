CREATE DATABASE IF NOT EXISTS cleancare CHARACTER SET utf8mb4; USE cleancare;
CREATE TABLE branches(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(80) NOT NULL,address VARCHAR(160));
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(80) NOT NULL,email VARCHAR(120) NOT NULL UNIQUE,phone VARCHAR(20),password VARCHAR(255) NOT NULL,
 role ENUM('admin','staff','delivery','customer') NOT NULL,branch_id INT NULL,INDEX(role),FOREIGN KEY(branch_id) REFERENCES branches(id) ON DELETE SET NULL);
CREATE TABLE services(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(60) NOT NULL,price DECIMAL(8,2) NOT NULL,unit VARCHAR(10) DEFAULT 'item');
CREATE TABLE orders(id INT AUTO_INCREMENT PRIMARY KEY,customer_id INT NOT NULL,branch_id INT NOT NULL,service_id INT NOT NULL,qty INT NOT NULL,total DECIMAL(10,2) NOT NULL,
 address VARCHAR(200) NOT NULL,slot VARCHAR(40),notes VARCHAR(255),status VARCHAR(30) NOT NULL DEFAULT 'Placed',paid TINYINT DEFAULT 0,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 INDEX(status),INDEX(customer_id),FOREIGN KEY(customer_id) REFERENCES users(id),FOREIGN KEY(branch_id) REFERENCES branches(id),FOREIGN KEY(service_id) REFERENCES services(id));
CREATE TABLE order_status_history(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,status VARCHAR(30) NOT NULL,changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE);
CREATE TABLE payments(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,method ENUM('card','wallet','cod'),amount DECIMAL(10,2),paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(order_id) REFERENCES orders(id));
CREATE TABLE feedback(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,rating TINYINT NOT NULL,comment VARCHAR(255),FOREIGN KEY(order_id) REFERENCES orders(id));
CREATE TABLE chat_messages(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,sender_id INT NOT NULL,body VARCHAR(500),sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(order_id) REFERENCES orders(id),FOREIGN KEY(sender_id) REFERENCES users(id));
CREATE TABLE notifications(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,message VARCHAR(200),is_read TINYINT DEFAULT 0,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id));
INSERT INTO branches(name,address) VALUES('Dhanmondi','Road 27, Dhanmondi'),('Gulshan','Gulshan 1'),('Uttara','Sector 7, Uttara');
-- every sample account uses password: password
INSERT INTO users(name,email,phone,password,role,branch_id) VALUES
('Admin','admin@cleancare.test','01700000001','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin',NULL),
('Rina Staff','staff@cleancare.test','01700000002','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','staff',1),
('Mitu Delivery','delivery@cleancare.test','01700000003','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','delivery',1),
('Ayesha Customer','customer@cleancare.test','01700000004','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','customer',NULL);
INSERT INTO services(name,price,unit) VALUES('Wash & Fold',60,'kg'),('Dry Clean',250,'item'),('Iron Only',20,'item'),('Wash + Iron',90,'kg'),('Express',80,'order');
INSERT INTO orders(customer_id,branch_id,service_id,qty,total,address,slot,status) VALUES
(4,1,4,8,720,'Dhanmondi 27, House 12','Morning','Washing'),(4,1,2,2,500,'Gulshan 1, Road 4','Evening','Out for Delivery'),(4,1,1,5,300,'Uttara Sector 7','Morning','Pickup Scheduled');
INSERT INTO order_status_history(order_id,status) VALUES(1,'Placed'),(1,'Pickup Scheduled'),(1,'Picked Up'),(1,'Received'),(1,'Washing'),(2,'Placed'),(3,'Placed'),(3,'Pickup Scheduled');
