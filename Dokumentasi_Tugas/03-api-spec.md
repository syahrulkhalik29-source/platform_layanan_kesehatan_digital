# API Specification

> Dokumentasikan setiap endpoint yang dikembangkan maupun yang dikonsumsi dari layanan eksternal.
> Salin dan ulangi blok di bawah untuk setiap endpoint tambahan.

\---

## \[User Registration]

**Method:** `POST`

**URL:** `...`

**Deskripsi:** `Digunakan oleh pasien atau tenaga medis untuk mendaftarkan akun baru ke dalam sistem internal.`

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```
Content-Type: application/json
```

**Request Body:**

```json

{

&#x20; "name": "string",

&#x20; "email": "string",

&#x20; "password": "string",

&#x20; "role": "string (pasien / dokter)"

}

```

**Response Sukses (`200 OK`):**

```json
{

&#x20; "status": "success",

&#x20; "message": "User registered successfully",

&#x20; "data": {

&#x20;   "id": 1,

&#x20;   "name": "Budi",

&#x20;   "email": "Budi@example.com",

&#x20;   "role": "pasien"

&#x20; }

}

```

**Response Gagal:**

```json
{

&#x20; "status": "error",

&#x20; "message": "The email has already been taken."

}```

\---

## \[User Login]

**Method:** `POST`

**URL:** `...`

**Deskripsi:** `Digunakan oleh pasien atau tenaga medis untuk mendaftarkan akun baru ke dalam sistem internal.`

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```
Content-Type: application/json
```

**Request Body:**

```json
{

&#x20; "email": "string",

&#x20; "password": "string"

}
```

**Response Sukses (`200 OK`):**

```json
{

&#x20; "status": "success",

&#x20; "message": "Login successful",

&#x20; "token": "1|kB9xXyZ...",

&#x20; "data": {

&#x20;   "name": "Budi",

&#x20;   "role": "pasien"

&#x20; }

}

```

**Response Gagal:**

```json
{

&#x20; "status": "error",

&#x20; "message": "Invalid credentials"

}

```

## \[Get All Doctors]

**Method:** `GET`

**URL:** `...`

**Deskripsi:** `Mengambil semua daftar dokter beserta jadwal praktiknya untuk ditampilkan di halaman pemesanan Frontend.`

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```
Authorization: Bearer <token>

Content-Type: application/json
```

**Request Body:**

```json
-
```

**Response Sukses (`200 OK`):**

```json
{

&#x20; "status": "success",

&#x20; "data": \[

&#x20;   {

&#x20;     "id": 101,

&#x20;     "name": "dr. Andi Wijaya",

&#x20;     "specialist": "Spesialis Anak",

&#x20;     "schedule": "Senin - Rabu, 09:00 - 12:00"

&#x20;   }

&#x20; ]

}
```

**Response Gagal:**

```json
{

&#x20; "status": "error",

&#x20; "message": "Unauthenticated."

}

```

## \[Create Appointment (Booking)]

**Method:** `POST`

**URL:** `...`

**Deskripsi:** `Menyimpan data reservasi janji temu baru antara pasien dengan dokter pilihan ke dalam database internal.`

**Autentikasi Diperlukan:** `ya`

**Sumber:** `Internal System`

**Request Headers:**

```
Authorization: Bearer <token>

Content-Type: application/json
```

**Request Body:**

```json

{

&#x20; "doctor\_id": "integer",

&#x20; "appointment\_date": "string (YYYY-MM-DD)",

&#x20; "complaint": "string"

}
```

**Response Sukses (`200 OK`):**

```json
{

&#x20; "status": "success",

&#x20; "message": "Appointment created successfully",

&#x20; "data": {

&#x20;   "booking\_code": "BK-2026-001",

&#x20;   "doctor\_name": "dr. Andi Wijaya",

&#x20;   "appointment\_date": "2026-06-15",

&#x20;   "status": "pending"

&#x20; }

}
```

**Response Gagal:**

```json


```

## \[Get Nearby Clinics (Third-Party API Integration)]

**Method:** `GET`

**URL:** `...`

**Deskripsi:** `Mengambil data fasilitas kesehatan terdekat berdasarkan parameter kota. Data ini dijembatani oleh Laravel dengan menembak API Publik/Pihak Ketiga (seperti BPJS Kesehatan / Satusehat).`

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Third-Party API — BPJS Kesehatan / Satusehat API`

**Request Headers:**

```
Authorization: Bearer <token>

Content-Type: application/json
```

**Request Body:**

```json

```

**Response Sukses (`200 OK`):**

```json
{

&#x20; "status": "success",

&#x20; "source": "Third-Party API Data",

&#x20; "data": \[

&#x20;   {

&#x20;     "clinic\_name": "Klinik Sehat Banda Aceh",

&#x20;     "address": "Jl. Teuku Umar No. 12",

&#x20;     "type": "Klinik Pratama",

&#x20;     "distance": "1.2 km"

&#x20;   }

&#x20; ]

}
```

**Response Gagal:**

```json
{

&#x20; "status": "error",

&#x20; "message": "Failed to fetch data from external provider API"

}```


\---

*(Salin blok template di atas untuk setiap endpoint selanjutnya)*

