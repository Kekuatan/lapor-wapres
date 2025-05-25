# 📢 Lapor Mas Wapress

**Lapor Mas Wapress** adalah aplikasi yang memungkinkan pengguna untuk melaporkan keluhan atau masalah secara langsung dan mudah kepada Mas Wapress.

---

## 🛠️ Instalasi

### 1. Persyaratan Sistem

Pastikan server atau lingkungan pengembangan Anda telah memenuhi persyaratan berikut:

- PHP 8.2
- SQLite
- Ekstensi PHP `intl`
- [Composer](https://getcomposer.org/)
- [Node.js dan NPM](https://nodejs.org/)
- Laravel Livewire
- [Filament](https://filamentphp.com/)
- Bootstrap AdminLTE

> **Catatan**:  
> Untuk mengaktifkan ekstensi `intl` di Ubuntu, jalankan perintah berikut:

```bash
sudo apt-get install php-intl
```
> **Credential**:  
> Untuk mengaktifkan login dapat menggunakan id berikut:
> - Username: `superadmin@test.com  `
> - Password: `admin`

> - Username: `admin@test.com  `
> - Password: `admin`

> - Username: `user@test.com  `
> - Password: `admin`
---

### 2. Instalasi Lokal

Ikuti langkah-langkah berikut untuk menginstal aplikasi di lingkungan lokal:

#### 🔁 Clone Repository
```bash
git clone https://github.com/username/lapor-mas-wapress.git
cd lapor-mas-wapress
```

#### 🔁 Clone .env
```bash
cp .env.example .env
```

#### 📦 Install Dependency Backend
```bash
composer install
```

#### 💻 Install Dependency Frontend
```bash
npm install
```

#### 🏗️ Build Asset Frontend
```bash
npm run build
```
#### 🏗️ Database Migration
```bash
php artisan migrate:fresh --seed
```
#### 🏗️ Run application
```bash
php artisan serve
```
---

## 🌐 Demo Online

Jika mengalami kesulitan saat instalasi lokal, Anda dapat mencoba versi demo secara online di:

🔗 [tempatparkir.com](http://tempatparkir.com)  
🗓️ *Tersedia hingga tanggal 4 Mei 2025*

---
