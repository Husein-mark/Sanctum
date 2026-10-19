# Sanctum API - LKPD Laravel Sanctum

Proyek API Laravel menggunakan **Laravel Sanctum** untuk autentikasi berbasis token.

## Instalasi

```bash
# Clone repository
git clone <url-repo>
cd Sanctum

# Install dependensi
composer install

# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Jalankan migration
php artisan migrate

# Jalankan server (port 8000)
php artisan serve
```

## Alamat API

Base URL: `http://localhost:8000`

---

## Endpoint API

> Semua request harus menyertakan header: `Accept: application/json`  
> POST dengan body JSON harus menyertakan: `Content-Type: application/json`

| Method | Endpoint | Keterangan | Auth |
|--------|----------|------------|------|
| POST | `/api/register` | Buat akun baru | ❌ Tidak perlu token |
| POST | `/api/login` | Login dan dapatkan token | ❌ Tidak perlu token |
| GET | `/api/profil` | Identitas akun aktif | ✅ Butuh token Bearer |
| POST | `/api/logout` | Cabut token aktif | ✅ Butuh token Bearer |
| GET | `/api/catatan` | Daftar catatan milik akun | ✅ Butuh token Bearer |
| POST | `/api/catatan` | Simpan catatan baru | ✅ Butuh token Bearer |

---

## Contoh Request

### Register
```http
POST /api/register
Content-Type: application/json
Accept: application/json

{
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Login
```http
POST /api/login
Content-Type: application/json
Accept: application/json

{
  "email": "budi@example.com",
  "password": "password123"
}
```

Response:
```json
{
  "message": "Login berhasil.",
  "token_type": "Bearer",
  "access_token": "1|xxxxxxxxxxxxxxxxxxxx",
  "user": { "id": 1, "name": "Budi Santoso", "email": "budi@example.com" }
}
```

### Profil (butuh token)
```http
GET /api/profil
Accept: application/json
Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxx
```

### Tambah Catatan (butuh token)
```http
POST /api/catatan
Content-Type: application/json
Accept: application/json
Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxx

{
  "judul": "Catatan Pertama",
  "isi": "Ini adalah isi catatan pertama saya."
}
```

### Logout (butuh token)
```http
POST /api/logout
Accept: application/json
Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxx
```

---

## Cara Menjalankan Dua Proyek

1. **API** (project ini): `php artisan serve --port=8000`
2. **Frontend**: `php artisan serve --port=8001` (di folder `SanctumFrontend`)

Buka browser ke `http://localhost:8001` untuk mengakses frontend.

---

## Catatan Penting

- Password disimpan sebagai **bcrypt hash**
- `user_id` catatan ditentukan dari **akun terautentikasi**, bukan dari input client
- Register **tidak** otomatis login — pengguna harus login manual untuk mendapatkan token
- Token disimpan di **session server frontend**, tidak ditampilkan ke pengguna
- Setelah logout, token **langsung dicabut** dan tidak bisa digunakan lagi
