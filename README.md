# CleanCare
Laundry Service Management System with multi-role dashboards, order tracking, and PDF invoices.
# CleanCare - Laundry Service Management System

CleanCare is a modern multi-role laundry management system that simplifies operations for Admins, Laundry Staff, Delivery Persons, and Customers. It allows seamless order tracking, PDF invoice generation, and customer feedback management.

## Features

### Admin
- Add/manage laundry branches, staff, and delivery persons
- View all orders and their status
- Generate reports (daily orders, income, delivery performance)

### Laundry Staff
- View and update orders (Received → Washing → Ironing → Ready)
- Update item details and prices
- Mark orders ready for pickup or delivery

### Delivery Person
- Track assigned pickups and deliveries
- Mark orders as picked up or delivered
- View delivery history

### Customer
- Create orders with pickup address and service type
- Track order status in real-time
- Make payments (dummy simulation)
- Leave ratings and feedback

### Others
- Non-registered users can view service info and price lists
- Generate downloadable PDF invoices
- Chat feature for communication between customers and staff

## Tech Stack
- **Frontend:** HTML, CSS, JavaScript
- **PDF Generation:** jsPDF
- **Optional Backend:** Firebase or Node.js for real data handling
- **Charts & Analytics:** Chart.js (for reports)

## Usage
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/CleanCare.git
