# 📸 RENTCAM — Camera & Drone Rental System

RENTCAM is a web-based rental system designed for booking cameras and drones. It features manual payment verification, stock control, and multi-level user access (User, Admin, Super Admin).

## 🚀 Tech Stack

- **Backend**: PHP (CodeIgniter 3)
- **Database**: MySQL / MariaDB (via XAMPP)
- **Frontend**: HTML, CSS, JavaScript (Vanilla / Bootstrap)
- **Design Pattern**: MVC (Model-View-Controller)

## 📋 Features

- **User/Member**: Browse products, online booking, upload payment proof, review products.
- **Admin**: Product management (CRUD), payment verification, rental status updates, stock control.
- **Super Admin**: Reporting dashboard, admin management, system configuration.

## ⚙️ Installation & Setup

Follow these steps to get the project running locally:

### 1. Prerequisites
- [XAMPP](https://www.apachefriends.org/index.html) (PHP >= 7.4 & MySQL)
- Web Browser

### 2. Clone the Repository
```bash
git clone <repository-url>
cd rentcam
```

### 3. Configuration
- Copy `.env.example` to `.env`.
- Open `application/config/database.php` and ensure the driver is set to `mysqli`.
- Update your database credentials in the `.env` file (Default XAMPP: root / no password).

### 4. Database Setup
- Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
- Create a new database named `rentcam`.
- Import or execute the SQL schema found in `prompt/project_plan.md` to create the tables.

### 5. Running the Application
- Open XAMPP Control Panel and start **Apache** and **MySQL**.
- Place the project folder in `C:\xampp\htdocs\rentcam`.
- Access the application via:
  ```
  http://localhost/rentcam
  ```

## 📂 Project Structure

```text
rentcam/
├── application/          # Core logic (MVC)
│   ├── config/           # Database & App settings
│   ├── controllers/      # Route handlers
│   ├── models/           # Database interactions
│   └── views/            # UI Templates
├── assets/               # Static files
│   ├── css/              # Stylesheets
│   └── uploads/          # User-uploaded images
├── system/               # CodeIgniter 3 Core
├── .env                  # Environment configuration
├── .gitignore            # Git ignore rules
└── index.php             # Application entry point
```

- `application/`: Contains the main source code of the application following the MVC pattern.
- `assets/`: Stores all frontend assets such as CSS, Javascript, and user uploads.
- `system/`: The core framework files of CodeIgniter 3.
- `.env`: Configuration file for environment-specific variables like database credentials.
## 🔐 Credentials (Default)

- **Super Admin**: admin@rentcam.com / password123
- **User**: member@gmail.com / password123

## 🤝 Contributing

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---


