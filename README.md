# @Planet

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

@Planet je web aplikacija koja prikazuje prirodne događaje širom svijeta u stvarnom vremenu koristeći NASA-in EONET API. Aplikacija prikazuje događaje kao što su požari, potresi, oluje i druge prirodne pojave na interaktivnoj karti.

## 📸 Slike

![Screenshot aplikacije](public/images/screenshot.png)

## 🚀 Značajke

- Pregled prirodnih događaja u stvarnom vremenu
- Interaktivna karta s markerima za svaki događaj
- Detaljne informacije o svakom događaju
- Responzivan dizajn koji radi na svim uređajima
- Automatsko ažuriranje podataka

## 🛠️ Instalacija

1. Klonirajte repozitorij:
   ```bash
   git clone https://github.com/vas-username/my-planet.git
   cd my-planet
   ```

2. Instalirajte PHP ovisnosti:
   ```bash
   composer install
   ```

3. Instalirajte JavaScript ovisnosti:
   ```bash
   npm install
   ```

4. Kopirajte `.env` datoteku i konfigurirajte je:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Dodajte svoj NASA API ključ u `.env` datoteku:
   ```
   NASA_API_KEY=vas_nasa_api_kljuc_ovdje
   ```

6. Pokrenite migracije (ako su potrebne):
   ```bash
   php artisan migrate
   ```

7. Pokrenite razvojni server:
   ```bash
   php artisan serve
   ```

8. U drugom terminalu pokrenite Vite za kompajliranje aseta:
   ```bash
   npm run dev
   ```

9. Otvorite aplikaciju u pregledniku na adresi [http://localhost:8000](http://localhost:8000)

## 🔧 Konfiguracija

Ako želite koristiti drugu bazu podataka, uredite `.env` datoteku s odgovarajućim postavkama.

## 📄 Licenca

Ovaj projekt je otvorenog koda i dostupan je pod [MIT licencom](LICENSE).

---

Razvijeno s ❤️ koristeći [Laravel](https://laravel.com/), [Vue.js](https://vuejs.org/) i [Leaflet](https://leafletjs.com/)

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
