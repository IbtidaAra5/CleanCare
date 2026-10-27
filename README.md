<div align="center">

# 🫧 CleanCare

### Laundry Service Management System

**Schedule a pickup, track every wash in real time, and get fresh clothes delivered to your door.**

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-PDO-4479A1?logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-Vanilla-F7DF1E?logo=javascript&logoColor=black)
![Chart.js](https://img.shields.io/badge/Chart.js-4.x-FF6384?logo=chartdotjs&logoColor=white)
![XAMPP](https://img.shields.io/badge/Server-XAMPP-FB7A24?logo=xampp&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green)

</div>

---

## 📖 About the Project

**CleanCare** is a multi-role, web-based laundry management system built as an academic project. It replaces paper slips and phone calls with one centralized platform where **Admins**, **Laundry Staff**, **Delivery Persons** and **Customers** work on the same live order pipeline.

Every order moves through a clear status flow, and every change is logged with a timestamp and pushed to the customer as a notification.

```
Placed → Pickup Scheduled → Picked Up → Received → Washing → Ironing → Ready → Out for Delivery → Delivered
```

---

## ✨ Features

### 🌐 Public
- Landing page with animated floating-bubble hero
- Interactive **price estimator** (service + quantity, instant total)
- FAQ accordion
- Customer registration and login

### 👤 Customer
- Create orders with service, quantity, branch, pickup address, time slot and special instructions
- Dashboard with order stats and recent notifications
- **Animated order timeline** with completed steps and a pulsing current step
- Order list with status badges

### 🧺 Laundry Staff
- Branch-specific queue of orders
- Advance orders step by step: Picked Up → Received → Washing → Ironing → Ready
- Live search across orders

### 🚚 Delivery Person
- Assigned pickups and deliveries
- Mark orders as Picked Up, Out for Delivery and Delivered

### 🛠️ Admin
- Dashboard with KPI cards (total orders, revenue, staff count)
- Orders-by-status doughnut chart (Chart.js)
- All-orders table with live search and status badges

### 🎨 UI / UX
- Light / dark mode, saved in `localStorage` and respecting `prefers-color-scheme`
- Scroll-reveal animations, animated count-up numbers
- Responsive sidebar dashboards with a mobile hamburger menu
- Keyboard focus rings and `prefers-reduced-motion` support

### 🔒 Security
- Passwords hashed with `password_hash()` / `password_verify()`
- PDO **prepared statements** for every query
- Session-based **role access control** on every protected page
- **CSRF tokens** on all forms
- Output escaped with `htmlspecialchars()`
- Session ID regenerated on login

---

## 🧰 Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Backend | PHP 8 (PDO) |
| Database | MySQL / MariaDB |
| Local server | XAMPP (Apache + MySQL) |
| Charts | Chart.js (cdnjs) |
| Fonts | Poppins, Inter (Google Fonts) |

---

## 📁 Project Structure

```
CleanCare/
├── index.php              # Landing page + price estimator
├── login.php              # Login
├── register.php           # Customer registration
├── logout.php             # Logout
├── config.php             # DB credentials and BASE_URL
├── database.sql           # Schema + sample data
├── admin/
│   └── dashboard.php      # KPIs, chart, all orders
├── staff/
│   └── orders.php         # Branch queue and status updates
├── delivery/
│   └── tasks.php          # Pickups and deliveries
├── customer/
│   ├── dashboard.php      # Overview and notifications
│   ├── new_order.php      # Place an order
│   └── track_order.php    # Animated timeline
├── includes/
│   ├── functions.php      # PDO, CSRF, role guard, status engine
│   ├── header.php         # Sidebar and top bar
│   └── footer.php
└── assets/
    ├── css/style.css      # Design system
    └── js/app.js          # Theme, search, animations
```

---

## 🗄️ Database Tables

| Table | Purpose |
|---|---|
| `users` | All accounts, with role `admin`, `staff`, `delivery` or `customer` |
| `branches` | Laundry branches |
| `services` | Services and prices |
| `orders` | Orders with customer, branch, service, quantity, total and status |
| `order_status_history` | Timestamped log of every status change |
| `payments` | Payment records |
| `feedback` | Ratings and comments |
| `chat_messages` | Customer–staff messages |
| `notifications` | Status-change alerts |

Foreign keys, constraints and indexes are defined in [`database.sql`](database.sql).

---

## ⚙️ Installation and Setup

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) with PHP 8+ and MySQL

### Steps

1. **Clone the repository** into XAMPP's web root:
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/IbtidaAra5/CleanCare.git
   ```
2. **Start** Apache and MySQL from the XAMPP Control Panel.
3. **Import the database:** open `http://localhost/phpmyadmin` → **Import** → choose `database.sql` → **Go**.
4. **Check `config.php`** (defaults work for a fresh XAMPP install):
   ```php
   const DB_HOST='localhost', DB_NAME='cleancare', DB_USER='root', DB_PASS='';
   const BASE_URL='/CleanCare';
   ```
5. **Open the app:** [http://localhost/CleanCare/](http://localhost/CleanCare/)

> 💡 If Apache runs on port 8080, use `http://localhost:8080/CleanCare/`.

---

## 🔑 Default Login Credentials

All sample accounts use the password **`password`**.

| Role | Email |
|---|---|
| 🛠️ Admin | `admin@cleancare.test` |
| 🧺 Staff | `staff@cleancare.test` |
| 🚚 Delivery | `delivery@cleancare.test` |
| 👤 Customer | `customer@cleancare.test` |

> ⚠️ Change these credentials before using the project anywhere beyond local testing.

### 🧪 Try the full flow
1. Log in as **Customer** → **New Order** → watch the timeline in **Track Order**.
2. Log in as **Delivery** → move the order to *Picked Up*.
3. Log in as **Staff** → advance through *Received → Washing → Ironing → Ready*.
4. Log in as **Delivery** again → *Out for Delivery → Delivered*.
5. Check the **Admin** dashboard and the customer's notifications.

---

## 🎨 Design System

| Token | Color | Usage |
|---|---|---|
| Primary (Aqua Blue) | `#0EA5E9` → `#2563EB` | Buttons, links, highlights |
| Secondary (Fresh Mint) | `#2DD4BF` | Focus rings, accents |
| Deep Navy | `#0B1F3A` | Sidebar, dark surfaces |
| Accent (Coral) | `#FF7A59` | Primary call-to-action |
| Background (Light) | `#F4FAFF` | Page background |
| Background (Dark) | `#08162B` | Dark mode background |
| Surface (Dark) | `#10233F` | Dark mode cards |
| Text | `#0F172A` / `#E6F0FF` | Light / dark text |

**Typography:** Poppins for headings, Inter for body text.

---

## 🗺️ Roadmap

- [x] Role-based authentication and CSRF protection
- [x] Order creation and animated tracking timeline
- [x] Staff and delivery status workflow with history log
- [x] Admin dashboard with Chart.js
- [ ] Dummy payments (card / wallet / cash on delivery) with success animation
- [ ] PDF invoices with jsPDF
- [ ] Ratings and feedback after delivery
- [ ] Customer–staff chat with AJAX polling
- [ ] Customer profile, saved addresses, order history and reorder
- [ ] Admin: branch, staff and delivery-person management
- [ ] Admin reports and CSV export
- [ ] Item-level order editing for staff
- [ ] Testimonial carousel, skeleton loaders and modals

---

## 📸 Screenshots

| Landing | Customer Dashboard |
|---|---|
| ![Landing](docs/screenshots/landing.png) | ![Customer](docs/screenshots/customer.png) |

| Admin Dashboard | Staff Queue |
|---|---|
| ![Admin](docs/screenshots/admin.png) | ![Staff](docs/screenshots/staff.png) |

| Delivery Tasks | Dark Mode |
|---|---|
| ![Delivery](docs/screenshots/delivery.png) | ![Dark](docs/screenshots/dark.png) |

---

## 🤝 Contributing

Contributions are welcome.

1. Fork the repository
2. Create a branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add your feature"`
4. Push the branch: `git push origin feature/your-feature`
5. Open a Pull Request

Please use prepared statements for all queries and escape all output.

---

## 👩‍💻 Author

**Ibtida Ara**
Final-year CSE student at United International University (UIU)

- GitHub: [@IbtidaAra5](https://github.com/IbtidaAra5)
- LinkedIn: [Ibtida Ara](https://www.linkedin.com/in/ibtida-ara-a505983b4)
- Portfolio: [ibtidaara5.github.io](https://ibtidaara5.github.io/)

---

## 📄 License

This project is licensed under the **MIT License**.

<div align="center">

Made with 💙 and a lot of clean laundry.

</div>
