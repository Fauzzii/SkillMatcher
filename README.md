# 🚀 Skill Matcher

## 📖 Deskripsi Singkat Proyek
**Skill Matcher** adalah platform portal karir cerdas yang dirancang untuk menjembatani kesenjangan antara pencari kerja dan perusahaan.

Fitur unggulan kami adalah **"Career Buddy AI Assistant"**, sebuah chatbot cerdas yang tidak hanya menjawab pertanyaan umum, tetapi juga mampu melakukan **Skill Matching Otomatis**. AI akan menganalisis keahlian (skills) yang dimiliki pengguna dan mencocokkannya secara *real-time* dengan database lowongan pekerjaan, memberikan rekomendasi yang sangat personal dan akurat.

---

## 🛠️ Teknologi yang Digunakan
Proyek ini dibangun menggunakan teknologi modern untuk memastikan performa, keamanan, dan skalabilitas:

* **Backend** : Laravel 10 (PHP 8.1+) (Framework utama aplikasi )
* **Frontend** : Blade, Tailwind CSS, JS (Antarmuka pengguna responsif)
* **Database** : PostgreSQL (Via **Supabase Transaction Pooler**)
* **AI Model** : Google Gemini 2.5 Flash (Cloud-based LLM via API)
* **HTTP Client** : Guzzle (Untuk komunikasi dengan API Google)

> **Catatan :** Wajib terhubung ke **internet** untuk mengakses **AI Model** dan juga **Tailwind CSS**

---

## 🤖 Implementasi AI / Machine Learning
Sesuai ketentuan kompetisi, proyek ini mengimplementasikan kecerdasan buatan dengan pendekatan **Cloud-based LLM (Large Language Model)**.

* **Model:** Google Gemini 2.5 Flash (`gemini-2.5-flash`)
* **Metode:** *Few-Shot Prompting* & *Context Injection*.
* **Alur Logika AI:**
  1. Sistem mengambil data *User Skills* dari database (Relasi Many-to-Many).
  2. Sistem mengambil data *Job Requirements* dari lowongan aktif.
  3. Controller merakit *System Prompt* dinamis yang berisi konteks kedua data tersebut.
  4. AI melakukan penalaran (*reasoning*) untuk menentukan kecocokan dan memberikan saran karir.

> **Catatan :** Repository ini **tidak menyertakan file model fisik** (seperti `.pkl`, `.h5`, atau `.tf`) karena kami menggunakan metode *Inference API* langsung ke Google Cloud AI. Logika *Prompt Engineering* dapat dilihat pada file `app/Http/Controllers/ChatbotController.php`.

---

## ⚙️ Prasyarat Sistem (Requirements)
Sebelum menjalankan aplikasi, pastikan komputer Anda telah terinstal:
1. **PHP** >= 8.1
2. **Composer**
4. **Git**

---

## 🚀 Petunjuk Setup Environment (Instalasi)

Ikuti langkah-langkah berikut secara berurutan untuk menjalankan proyek di komputer lokal:

### 1. Clone Repository
```bash
git clone https://github.com/Fauzzii/SkillMatcher.git
cd SkillMatcher

```

### 2. Install Dependensi
Install semua library backend yang dibutuhkan:

```bash
# Install Dependencies
composer install
```

### 3. Konfigurasi Environment (.env)
Duplikat file template environment menjadi file konfigurasi aktif:

```bash
cp .env.example .env

```

Selanjutnya, buka file `.env` di text editor Anda dan sesuaikan konfigurasi berikut agar aplikasi dapat berjalan:

**A. Konfigurasi Database (Supabase Pooler)**
Pastikan Anda menggunakan kredensial **Connection Pooling** (Port 6543) agar koneksi stabil.

```ini
DB_CONNECTION=pgsql
DB_HOST=[host_supabase_anda].pooler.supabase.com
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=[username_database_anda]
DB_PASSWORD=[password_database_anda]

```

**B. Konfigurasi Google Gemini AI**
Masukkan API Key yang didapat dari [Google AI Studio](https://www.google.com/search?q=https://aistudio.google.com/):

```ini
GEMINI_API_KEY=AIzaSyBxxxxxxxxxxxxxxxxx

```

### 4. Generate Key & Link Storage

Generate key enkripsi aplikasi dan buat shortcut folder publik:

```bash
php artisan key:generate
php artisan storage:link

```

### 5. Migrasi Database
Jalankan perintah migrasi untuk membuat tabel (Jobs, Users, Skills, dll) di database Supabase Anda:

```bash
php artisan migrate

```

*(Opsional) Jika ingin mengisi data dummy untuk keperluan demo:*
```bash
php artisan db:seed

```

---

## ▶️ Cara Menjalankan Aplikasi
**Jalankan server lokal Laravel:**

```bash
php artisan serve

```