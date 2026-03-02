# System Features Documentation

Tài liệu này tổng hợp toàn bộ các tính năng hiện có trong hệ thống **Motorbike Service Manager**, được tổ chức theo luồng vòng đời của Laravel (từ bảo mật đến người dùng và quản trị).

---

## 1. Security & Request Lifecycle (Bảo mật & Luồng yêu cầu)

Mọi yêu cầu đến hệ thống đều đi qua các lớp bảo mật và kiểm soát sau:

*   **Middleware Bảo vệ:**
    *   `Authenticate`: Đảm bảo người dùng đã đăng nhập (Admin/Customer).
    *   `IpManagerMiddleware`: Tự động bắt địa chỉ IP của yêu cầu, tra cứu thông tin địa lý (Quốc gia, Thành phố, ISP) và lưu vào `ip_logs`.
    *   `VerifyWebMiddleware`: Chặn các yêu cầu HTML gửi đến các route API (vòng bảo vệ bổ sung cho API).
    *   `Throttle`: Giới hạn tần suất yêu cầu (ví dụ: login/register) để chống brute-force.
*   **Phân quyền (Authorization):**
    *   Hệ thống sử dụng Guard của Laravel (Web cho Admin, Sanctum cho API Mobile/Frontend).
*   **Logging:** Ghi log hoạt động hệ thống, bao gồm log truy cập và log lỗi API riêng biệt.

---

## 2. User-Facing Features (Dành cho Người dùng - API v1)

Người dùng tương tác qua Mobile App hoặc Frontend thông qua các API:

*   **Xác thực (Authentication):**
    *   Đăng ký / Đăng nhập truyền thống.
    *   Đăng nhập bằng Google (Social Auth).
    *   Quên mật khẩu / Reset mật khẩu qua OTP (One Time Password).
*   **Quản lý Đặt lịch (Booking):**
    *   Tra cứu lịch trống của thợ (Staff availability).
    *   Đặt lịch sửa chữa (chọn dịch vụ, thợ, thời gian).
    *   Xem danh sách lịch đã đặt và chi tiết (Booking code).
    *   Hủy lịch hẹn.
*   **Trung tâm Thành viên (Membership):**
    *   Theo dõi hạng thành viên và tiến trình tích lũy.
*   **Dịch vụ & Thợ (Services & Staff):**
    *   Xem danh sách dịch vụ theo danh mục.
    *   Xem hồ sơ thợ sửa chữa và đánh giá (Staff reviews).
*   **Blog & Tin tức:**
    *   Xem bài viết, danh mục blog.
    *   Bình luận bài viết (yêu cầu đăng nhập).
*   **Khuyến mãi (Coupons):**
    *   Kiểm tra tính hợp lệ của mã giảm giá khi đặt lịch.
*   **Thanh toán (Payment):**
    *   Tích hợp cổng thanh toán: SePay (VietQR).
    *   Xác thực giao dịch tự động qua Webhook.

---

## 3. Quản trị hệ thống (Admin Dashboard)

Dành cho quản trị viên quản lý toàn bộ vận hành:
*   **Bảng điều khiển (Dashboard):**
    *   Thống kê KPI: Doanh thu tuần, số lượng lịch đặt mới, tăng trưởng so với tuần trước.
    *   Biểu đồ: Biến động doanh thu và lịch đặt theo ngày.
    *   Top 5: Dịch vụ phổ biến, Danh mục dịch vụ, Quốc gia truy cập.
    *   Hoạt động gần đây: Danh sách các lịch đặt mới nhất.
*   **Quản lý Vận hành (Core Operations):**
    *   **Bookings:** Quản lý lịch đặt (Xác nhận, in hóa đơn).
    *   **Customers:** Quản lý thông tin khách hàng.
    *   **Staffs:** Quản lý đội ngũ thợ, đánh giá từ khách, cài đặt số lượng thợ hoạt động tối đa.
*   **Quản lý Nội dung (CMS):**
    *   **Services & Categories:** Quản lý menu dịch vụ sửa chữa.
    *   **Blog System:** Quản lý bài viết (Posts), Danh mục blog, Tags, Bình luận.
*   **Marketing & Loyalty:**
    *   **Coupons:** Quản lý mã giảm giá, đối tượng áp dụng và lịch sử sử dụng.
    *   **Membership Settings:** Cấu hình các hạng thành viên.
*   **Cấu hình hệ thống (Settings):**
    *   Cấu hình thông tin cửa hàng, thời gian làm việc.
    *   Cấu hình cổng thanh toán (SePay API).
    *   Cấu hình Telegram Bot (Token, Chat ID) để nhận thông báo tức thời.
*   **Kỹ thuật & Tiện ích:**
    *   **Log Viewer:** Xem file log hệ thống trực tiếp từ giao diện Admin.
    *   **IP Logs:** Theo dõi lưu lượng truy cập từ khắp nơi trên thế giới.
    *   **Bulk Delete:** Công cụ xóa nhanh hàng loạt dữ liệu.
---

## 4. Technical Specifications (Kỹ thuật & Hệ thống)

*   **Telegram Integration:** Gửi thông báo tự động cho Admin/Nhân viên khi có lịch đặt mới.
*   **Queue & Scheduler:**
    *   Xử lý ngầm các tác vụ nặng (gửi email, thông báo).
    *   Tự động cập nhật trạng thái hoặc dọn dẹp dữ liệu qua Scheduler.
*   **GeoIP:** Tự động định vị vị trí người dùng qua địa chỉ IP.
*   **Eloquent Resource:** Chuẩn hóa dữ liệu trả về cho API, đảm bảo hiệu suất và bảo mật field.

---

## 5. Giá trị kinh doanh (Business Value)

**Motorbike Service Manager** là giải pháp phần mềm toàn diện được thiết kế chuyên dụng cho việc quản lý và vận hành các cửa hàng, trung tâm dịch vụ bảo dưỡng, sửa chữa và chăm sóc xe máy, xe hơi.

**Phù hợp với các mô hình kinh doanh:**
* Các chuỗi cửa hàng bảo dưỡng, garage sửa chữa.
* Trung tâm rửa xe, làm đẹp xe (detailing) chuyên nghiệp.
* Các mô hình kinh doanh dịch vụ đặt lịch hẹn trước, có đội ngũ kỹ thuật viên cần phân bổ và theo dõi lịch làm việc.

### Điểm mạnh cốt lõi
* **All-in-One liền mạch:** Đã tích hợp sẵn mọi nghiệp vụ thiết yếu của hệ thống Booking khó nhằn như: Quản lý chi tiết lịch hẹn, Quản lý chiết khấu (Coupon), Chuẩn hóa Phân quyền. Chủ dự án mua về không cần tốn nhiều chi phí đập đi xây lại từng tính năng rời rạc.
* **Kiến trúc hệ thống Rõ ràng, Minh bạch:** Giao diện tối ưu trải nghiệm nhanh gọn; trong khi đó lõi hệ thống được xây dựng khắt khe và chặt chẽ, đảm nhận chịu tải toàn bộ các nghiệp vụ phức tạp về dữ liệu một cách an toàn.
* **Sẵn sàng Bảng quản trị (Admin Dashboard) cao cấp:** Tích hợp giao diện vận hành hoàn chỉnh, hiện đại dành riêng cho người chủ kinh doanh sử dụng được ngay với mọi số liệu tập trung về một màn hình trung tâm.
* **Dễ mở rộng:** Mã nguồn tuân thủ triệt để những tiêu chuẩn lập trình quốc tế (clean code), giúp các nhóm kỹ thuật tiếp quản về sau dễ dàng tiếp tục nâng cấp, tùy biến mà không làm hỏng tính năng hiện tại.

### Tính năng Nâng cao (Dòng cao cấp)
*   **Tích hợp Notification tức thì (Telegram Bot):** Đẩy thẳng thông báo về thiết bị điện thoại của chủ cửa hàng hoặc người quản lý mỗi khi có lịch đặt mới. Nhờ đó, việc điều hành nhanh hơn rất nhiều lần mà không cần ngồi trực tại máy tính.
*   **Tác vụ ngầm tối ưu hóa tốc độ (Queue / Scheduler):** Các công việc mất tính toán nhiều (như thống kê tự động, báo cáo) được đẩy chạy ngầm. Hệ quả giúp cho website không bị lag/treo ngay cả vào dịp đông khách khánh thành. 
*   **Webhook & Thanh toán tự động:** Webhook bắt kết quả giao dịch thanh toán hoàn toàn tự động, đối soát tức thời nhằm bỏ qua khâu xác nhận bằng tay.
*   **API chuyên biệt cho tính năng bảo mật:** Tự động giám sát vị trí truy cập (GeoIP) các vị khách truy cập vào trong hệ thống. Hệ thống còn biết tự giới hạn luồng kết nối dồn dập, phòng thủ chống tân công/spam (Rate Limit & Throttle).

### Tình trạng hệ thống
*   **Production-ready (Độ hoàn thiện):** Dự án được thiết kế chuyên nghiệp tới từng tiểu tiết. Đã sẵn sàng phục vụ triển khai cho môi trường sản xuất của mô hình kinh doanh thực tế.
*   **Thời gian Deploy ngay lập tức:** Có thể cấu hình và đóng gói đưa lên mạng hoạt động ngay tức thì trong thời gian ngắn mà không đòi hỏi chỉnh sửa logic.
*   **Kiến trúc Docker tiên tiến:** Cả phân hệ người dùng và bên quản trị đều đã được trang bị **Docker/Docker Compose** hoàn chỉnh, mang lại sự thuận tiện khi triển khai trên bất kì hệ thống máy chủ nào và dễ dàng áp dụng luồng chạy tự động hóa phân phối (CI/CD). 

### Tiềm năng Mở rộng trong tương lai
Nhờ có cốt lõi định hình rất sẵn sàng, đội ngũ sở hữu hoàn toàn có thế mạnh để phát triển tiếp cho tương lai:
*   **Cơ hội ra mắt Mobile App tức thì:** Việc mã nguồn đã trang bị sẵn nền tảng API riêng biệt giúp khả năng đập bản Front-end phát triển thành một hệ sinh thái App trên di động (iOS / Android) cho khách mua thành chuẩn hóa - mà không phải xây lại khối xử lý trung tâm. 
*   **Đa dạng cổng Thanh toán:** Cấu trúc module thanh toán hiện được lập trình mềm dẻo, dễ dàng kết nối chéo thêm các cổng thanh toán mới (như Momo, VNPay, ZaloPay, Stripe hay PayPal) tùy theo mục tiêu tiếp cận nhóm người dùng của nhãn hàng.
*   **Scale up tới đa chi nhánh (Multi-branch / Multi-tenant):** Nền tảng luồng hệ thống sơ khởi tách biệt rõ các đối tượng sở hữu, tạo bước đà hoàn hảo cho việc chuyển đổi hệ thống thành một nền tảng dạng chuỗi có nhiều cơ sở bảo hành trên nhiều vị trí địa lý khác nhau.
