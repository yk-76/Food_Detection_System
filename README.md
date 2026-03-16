# 🍔 Food Detection & Health Recommendation System

A web-based food detection and health recommendation platform built using Laravel, Tailwind CSS, Roboflow, and Gemini AI.

Users can upload food images to detect food items and receive health assessments and AI-generated dietary recommendations.

---

# 🚀 Features

* Upload food images for detection
* Food detection using Roboflow computer vision
* AI health recommendations using Gemini
* User authentication system
* Food detection history stored in database
* Responsive UI built with Tailwind CSS

---

# 🧠 AI & Machine Learning

This project integrates two AI services:

### Roboflow

Used for:

* Image dataset management
* Food labeling
* Object detection model training
* Food detection inference

Users can retrain models by:

1. Uploading new food images
2. Labeling food items
3. Training the model
4. Deploying the new model

### Gemini AI

Used for:

* Health analysis of detected foods
* Personalized dietary recommendations

---

# 🛠 Tech Stack

Backend

* PHP
* Laravel

Frontend

* Tailwind CSS
* JavaScript
* HTML
* Blade View

AI Services

* Roboflow (food detection)
* Gemini AI (health recommendation)

Database

* MySQL

Tools

* Node.js
* Composer

---

# 📦 Installation

Clone the repository

```
git clone https://github.com/yk-76/Food_Detection_System.git
```

Enter project folder

```
cd Food_Detection_System
```

Install PHP dependencies

```
composer install
```

Install Node dependencies

```
npm install
```

Copy environment configuration

```
cp .env.example .env
```

Generate Laravel application key

```
php artisan key:generate
```

---

# 🔑 Environment Configuration

Update the following values inside `.env`

```
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

ROBOFLOW_API_KEY=your_roboflow_api_key
GEMINI_API_KEY=your_gemini_api_key
```

Users can modify these values based on their own setup.

---

# 🗄 Database Setup

Create a database in MySQL.

Example:

```
CREATE DATABASE food_detection;
```

Then import the schema file:

```
mysql -u your_username -p food_detection < database/schema.sql
```

Tables included:

* user
* food_result

These tables store user information and food detection results.

---

# ▶️ Running the Project (Development Mode)

Open **two terminals**.

### Terminal 1 – Start Laravel server

```
php artisan serve
```

### Terminal 2 – Tailwind development build

```
npx @tailwindcss/cli -i ./resources/css/app.css -o ./public/css/app.css --watch
```

Open in browser:

```
http://127.0.0.1:8000
```

---

# 🏗 Production Build

To build optimized Tailwind CSS:

```
npx @tailwindcss/cli -i ./resources/css/app.css -o ./public/css/app.css --minify
```

---

# 📁 Project Structure

```
Food_Detection_System
│
├── app
├── public
├── resources
│   ├── css
│   ├── views
├── routes
├── database
│   └── schema.sql
├── README.md
```

---

# 📸 Screenshots

<img src="https://github.com/user-attachments/assets/9c0160b6-4b48-469f-8f77-ef8d468ad30b" width="600" />

Example:

* Upload food page
* Detection result page
* AI recommendation page

---

# 👨‍💻 Author

Yiew Kang

---

# 📄 License

This project is created for educational and hackathon purposes.
