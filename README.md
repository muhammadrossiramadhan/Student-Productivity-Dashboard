# 📚 Student.io — PHP MVC Native

Aplikasi manajemen tugas mahasiswa dengan arsitektur MVC murni (tanpa framework).

---

## 🗂️ Struktur Folder

```
student-mvc/
├── app/
│   ├── core/
│   │   ├── Database.php     ← Singleton PDO connection
│   │   ├── Model.php        ← Base model (parent class)
│   │   ├── Controller.php   ← Base controller (parent class)
│   │   └── Router.php       ← URL dispatcher
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── TaskController.php
│   ├── models/
│   │   ├── UserModel.php
│   │   └── TaskModel.php
│   └── views/
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       └── tasks/
│           ├── dashboard.php
│           └── edit.php
├── index.php     ← ENTRY POINT (semua request masuk sini)
└── style.css
```

---

## ⚡ Cara Setup di FlyEnv (Virtual Host)

### 1. Taruh folder project
Taruh folder `student-mvc/` di dalam folder project kamu yang sudah
terdaftar sebagai Virtual Host di FlyEnv.

Contoh jika kamu pakai `http://ujicoba.test`:
```
/home/valenchill/Documents/4.Web & Basis Data/ujicoba.test/
└── student-mvc/   ← taruh di sini
    ├── index.php
    ├── style.css
    └── app/
```

Akses di browser:
```
http://ujicoba.test/student-mvc/index.php
```

### 2. Import database
Database kamu sudah ada (`app_tugas_db`). Jika belum, import dulu:
- Buka phpMyAdmin dari FlyEnv panel
- Import file `app_tugas_db.sql`

### 3. Cek koneksi di `app/core/Database.php`
```php
$host   = 'localhost';
$dbname = 'app_tugas_db';
$user   = 'root';
$pass   = 'root';
```

---

## 🔄 Alur URL (Routing)

```
?url=auth/login          → AuthController::login()
?url=auth/doLogin        → AuthController::doLogin()     [POST]
?url=auth/register       → AuthController::register()
?url=auth/doRegister     → AuthController::doRegister()  [POST]
?url=auth/logout         → AuthController::logout()

?url=task/index          → TaskController::index()
?url=task/store          → TaskController::store()        [POST]
?url=task/edit/5         → TaskController::edit("5")
?url=task/update/5       → TaskController::update("5")   [POST]
?url=task/delete/5       → TaskController::delete("5")
?url=task/done/5         → TaskController::done("5")
?url=task/undone/5       → TaskController::undone("5")
```

---

## 🧠 Konsep OOP yang Dipakai

| Konsep | Dimana |
|--------|--------|
| **Inheritance** | `UserModel extends Model`, `TaskController extends Controller` |
| **Encapsulation** | properti `private` di `Database`, method `private __construct()` |
| **Abstraction** | `abstract class Model`, `abstract class Controller` |
| **Singleton** | `Database::getInstance()` — koneksi DB hanya dibuat sekali |

---

## ✅ Fitur

- Login & Register dengan password hashing (bcrypt)
- Dashboard CRUD Tugas
- Filter berdasarkan prioritas & status
- Search tugas
- Tandai tugas selesai/belum selesai
- Sistem poin konsistensi (selesai tepat waktu = +10 poin)
- Responsive mobile-friendly
