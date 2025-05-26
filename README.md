# 🌤️ Weather API Backend (Laravel)

This is the backend API for the decoupled Weather App built with **Laravel 11**. It fetches and processes weather data from the OpenWeatherMap API and serves it to the frontend via REST endpoints.

---

## 📦 Tech Stack

* **Framework:** Laravel 11 (API only)
* **HTTP Client:** Laravel HTTP facade
* **API Source:** [OpenWeatherMap](https://openweathermap.org/api)

---

## 🧠 Features

* `GET /api/weather` – Fetches current weather for a given city
* `GET /api/forecast` – Fetches a 3-day forecast
* CORS-enabled for local frontend access
* Clean JSON responses for frontend integration

---

## 🔧 Setup Instructions

### 1. Clone this repository

```bash
git clone https://github.com/brianngumbau/weather_api
cd weather_api
```

### 2. Install dependencies

```bash
composer install
```

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Add your OpenWeatherMap API key to `.env`

```
OPENWEATHER_API_KEY=your_api_key_here
```

### 5. Serve the backend

```bash
php artisan serve
```

Runs at: `http://127.0.0.1:8000`

---

## 🌍 API Endpoints

| Method | Endpoint                                 | Description         |
| ------ | ---------------------------------------- | ------------------- |
| GET    | `/api/weather?city=Nairobi&unit=metric`  | Get current weather |
| GET    | `/api/forecast?city=Nairobi&unit=metric` | Get 3-day forecast  |

---

## 📁 Project Structure

```
weather_api/
├── app/Http/Controllers/WeatherController.php
├── routes/api.php
├── config/cors.php
├── .env
└── ...
```

---

## 📄 License

MIT – free to use, share and remix.
