# Motorbike Service Manager (Backend)

Hệ thống đặt lịch sửa chữa xe máy (Backend API & Admin Panel). <br>
Xem chi tiết về hệ thống: [Document](https://github.com/Khainguyen0207/moto-service-manager-be/blob/main/PROJECT_OVERVIEW.md)

## Yêu cầu

### Docker Mode
- Docker & Docker Compose

### Manual Mode
- PHP >= 8.2
- Composer
- Node.js >= 20
- MySQL 8.0

---

## 1. Cài đặt & Chạy (Docker)

### Cấu hình môi trường

```bash
cp .env.example .env
```

Chỉnh sửa `.env` (quan trọng):

```env
APP_ENV=production
APP_DEBUG=false

# Kết nối database container
DB_HOST=mysql
DB_DATABASE=moto_service
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Build & Khởi động

```bash
docker compose up --build -d
```

### Setup lần đầu

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link
```

### Các lệnh Docker thường dùng

```bash
# Xem logs
docker compose logs -f app

# Truy cập container
docker compose exec app bash

# Restart services
docker compose restart
```

---

## 2. Cài đặt & Chạy (Thủ công)

### Cài đặt dependencies

```bash
composer install
npm install
```

### Cấu hình môi trường

```bash
cp .env.example .env
php artisan key:generate
```

Chỉnh sửa `.env`:
```env
DB_HOST=127.0.0.1
DB_DATABASE=moto_service
DB_USERNAME=root
DB_PASSWORD=your_local_password
```

### Setup Database & Storage

```bash
# Đảm bảo MySQL đang chạy và database đã được tạo
php artisan migrate --seed
php artisan storage:link
```

### Build Frontend

```bash
npm run build
```

### Chạy Server

```bash
# Terminal 1: Web Server
php artisan serve

# Terminal 2: Background Jobs (bắt buộc)
php artisan queue:work

# Terminal 3: Scheduler (tùy chọn)
php artisan schedule:work
```

---

## 3. Cài đặt nhận thông báo Telegram

Hệ thống hỗ trợ gửi thông báo qua Telegram khi có khách đặt lịch. Có 2 cách để setup:

### Cách 1: Setup nhanh (Khuyên dùng)
Bạn chỉ cần tham gia vào group Telegram mặc định của hệ thống:
- Nhấn vào link: [Join group telegram notification here](https://t.me/+UkakVQvNAaI4YzM1) để tham gia group.
- Group ID và Bot Token mặc định đã được cấu hình sẵn trong mã nguồn.

### Cách 2: Setup riêng (Custom Bot & Group)
Nếu bạn muốn sử dụng Bot và Group Telegram của riêng mình:
1. Tham khảo hướng dẫn tạo Bot và lấy Chat ID tại: [Hướng dẫn tạo Bot Token và Group ID Telegram](https://wiki.shost.vn/thu-thuat-wordpress/huong-dan-tao-bot-token-group-id-telegram-2025.html).
2. Khi đã có thông tin, truy cập vào **Admin Panel** -> menu **Settings** -> tab **Telegram**.
3. Cập nhật thông tin `Bot Token` và `Chat ID` của bạn vào form và lưu lại.

---

## Thông tin chung

### Truy cập

| URL                          | Mô tả        |
|------------------------------|--------------|
| http://localhost:8080/admin  | Admin Panel  |
| http://localhost:8080/api/v1 | API          |
| http://localhost:8000        | Thủ công     |

### Tài khoản mặc định

| Email                  | Password |
|------------------------|----------|
| admin@admin.vn    | 123456   |
