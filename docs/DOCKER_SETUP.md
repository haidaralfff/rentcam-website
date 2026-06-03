# Docker Setup untuk RentCam

Panduan lengkap untuk menjalankan RentCam menggunakan Docker sebagai pengganti XAMPP.

## Prasyarat

1. **Docker Desktop** - Download dan install dari [docker.com](https://www.docker.com/products/docker-desktop)
2. **Docker Compose** - Biasanya sudah included dengan Docker Desktop

Verifikasi instalasi:
```bash
docker --version
docker-compose --version
```

## Quick Start

### 1. Clone/Setup Project
Pastikan Anda sudah berada di direktori project:
```bash
cd c:\xampp\htdocs\rentcam
```

### 2. Build Docker Image
```bash
docker-compose build
```

### 3. Jalankan Containers
```bash
docker-compose up -d
```

Tunggu beberapa saat hingga semua services berjalan. Cek status:
```bash
docker-compose ps
```

### 4. Akses Aplikasi
- **Web Application**: http://localhost/
- **PHPMyAdmin**: http://localhost:8081/

## Konfigurasi Environment

File `.env` sudah dikonfigurasi untuk Docker dengan setting:

```env
DB_HOST=db              # Nama service Docker untuk MySQL
DB_USER=rentcam         # Username MySQL
DB_PASS=password        # Password MySQL
DB_NAME=rentcam         # Nama database
BASE_URL=http://localhost/
```

Jika ingin mengubah password atau konfigurasi lain, edit `.env` lalu restart:
```bash
docker-compose down
docker-compose up -d
```

## Command Penting

### Start Services
```bash
docker-compose up -d
```

### Stop Services
```bash
docker-compose down
```

### View Logs
```bash
docker-compose logs -f web    # Logs untuk PHP/Apache
docker-compose logs -f db     # Logs untuk MySQL
```

### Access PHP Container
```bash
docker-compose exec web bash
```

### Restart Containers
```bash
docker-compose restart
```

### Rebuild Image
```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

## Database Management

### Import Database Backup
1. Buat folder `sql/` di root project jika belum ada
2. Letakkan file SQL (misal: `rentcam.sql`) di folder `sql/`
3. Restart container: `docker-compose up -d`
   - File `.sql` akan otomatis dijalankan

### Akses MySQL Langsung
```bash
docker-compose exec db mysql -u rentcam -p rentcam
```
(masukkan password: `password`)

### Atau via PHPMyAdmin
- Akses: http://localhost:8081/
- Username: `rentcam`
- Password: `password`
- Database: `rentcam`

## Troubleshooting

### Port sudah digunakan
Jika port 80 atau 3306 sudah digunakan, edit `docker-compose.yml`:
```yaml
services:
  web:
    ports:
      - "8080:80"    # Ubah ke port lain
  db:
    ports:
      - "3307:3306"  # Ubah ke port lain
```

### Container crash/tidak jalan
```bash
# Lihat error logs
docker-compose logs

# Rebuild dari awal
docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
```

### Permissions error di application/logs
```bash
docker-compose exec web chmod -R 777 application/logs
```

### Aplikasi tidak connect ke database
1. Pastikan service `db` sudah running: `docker-compose ps`
2. Verifikasi konfigurasi di `.env`
3. Cek logs: `docker-compose logs db`

## File-file Docker

- **Dockerfile** - Blueprint untuk PHP/Apache container
- **docker-compose.yml** - Orchestration file untuk semua services
- **.dockerignore** - File/folder yang tidak perlu di-copy ke container

## Services yang Tersedia

| Service | Fungsi | Akses |
|---------|--------|-------|
| web | PHP 7.4 + Apache | http://localhost/ |
| db | MySQL 5.7 | localhost:3306 |
| phpmyadmin | Database Management | http://localhost:8081/ |

## Performance Tips

1. **Volume Binding**: Project di-bind langsung, jadi perubahan file langsung terlihat
2. **Named Volumes**: Database disimpan di `db_data` volume untuk persistence
3. **Network**: Services berkomunikasi via internal Docker network

## Development Workflow

1. Edit files secara normal (VSCode, Sublime, dll)
2. Refresh browser untuk melihat perubahan
3. Cek logs jika ada error: `docker-compose logs -f web`
4. Database changes bisa dilakukan via PHPMyAdmin atau terminal

## Clean Up

Hapus semua Docker data (warning: data akan hilang):
```bash
docker-compose down -v
```

Hanya stop tanpa hapus data:
```bash
docker-compose down
```

## Next Steps

Jika ada error atau pertanyaan, gunakan perintah:
- `docker-compose logs` - Untuk melihat semua logs
- `docker-compose exec web bash` - Untuk akses container langsung

Happy coding! 🚀
