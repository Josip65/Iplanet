# IPlanet

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

IPlanet is a web application that displays natural events around the world in real-time using NASA's EONET API. The application shows events such as wildfires, earthquakes, storms, and other natural phenomena on an interactive map.

## 🚀 Features

- Real-time display of natural events
- Interactive map with markers for each event
- Detailed information about each event
- Responsive design that works on all devices
- Automatic data updates

## 🛠️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Josip65/Iplanet.git
   cd Iplanet
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Copy the `.env` file and configure it:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Add your NASA API key to the `.env` file:
   ```
   NASA_API_KEY=your_nasa_api_key_here
   ```

6. Run migrations (if needed):
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

8. In a separate terminal, run Vite for asset compilation:
   ```bash
   npm run dev
   ```

9. Open the application in your browser at [http://localhost:8000](http://localhost:8000)

## 🔧 Configuration

If you want to use a different database, edit the `.env` file with the appropriate settings.

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

Built with ❤️ using [Vue.js](https://vuejs.org/) and [Leaflet](https://leafletjs.com/)
