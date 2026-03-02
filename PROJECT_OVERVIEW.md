# **Tài Liệu Giới Thiệu Hệ Thống: Motorbike Service Manager**

## **1. Tổng quan hệ thống**

**Motorbike Service Manager** là giải pháp phần mềm toàn diện được thiết kế chuyên dụng cho việc quản lý và vận hành các cửa hàng, trung tâm dịch vụ bảo dưỡng, sửa chữa và chăm sóc xe máy, xe hơi.

**Phù hợp với các mô hình kinh doanh:**

- Các chuỗi cửa hàng bảo dưỡng, garage sửa chữa.
- Trung tâm rửa xe, làm đẹp xe (detailing) chuyên nghiệp.
- Các mô hình kinh doanh dịch vụ đặt lịch hẹn trước, có đội ngũ kỹ thuật viên cần phân bổ và theo dõi lịch làm việc.

## **2. Các chức năng chính**

Hệ thống được chia thành các phân hệ lõi, bao phủ toàn bộ nhu cầu số hóa của một doanh nghiệp dịch vụ:

### **👤 Nhóm tính năng Người dùng cuối (Khách hàng)**

Hệ thống Moto Service Manager được thiết kế nhằm mang lại sự tiện lợi, minh bạch và an tâm tuyệt đối cho khách hàng khi trải nghiệm các dịch vụ chăm sóc và bảo dưỡng xe:

- **1. Đặt Lịch Dịch Vụ Chủ Động & Nhanh Chóng:** Khách hàng không còn phải mang xe đến cửa hàng và xếp hàng chờ đợi đến lượt. Mọi thao tác đều có thể thực hiện trực tuyến chỉ trong vài phút:
    - **Lựa chọn dịch vụ linh hoạt:** Dễ dàng xem danh sách và chọn chính xác hạng mục sửa chữa, bảo dưỡng đang cần.
    - **Tùy chọn thời gian & Nhân sự:** Chủ động chọn ngày, giờ mang xe đến. Thay vì được phân công ngẫu nhiên, khách có thể chỉ định kỹ thuật viên quen thuộc hoặc người mình tin tưởng để chăm sóc xe.
    - **Ưu đãi tức thì:** Áp dụng mã giảm giá (coupon) để nhận ưu đãi ngay trong lúc đặt lịch.

- **2. Giám Sát Tiến Độ Sửa Chữa Minh Bạch:** Đây là tính năng mang lại sự an tâm vô cùng lớn, giải quyết hoàn toàn nỗi lo "không biết thợ đang làm gì với xe của mình":
    - **Tra cứu bằng mã số (Booking Code):** Điền tay số đặt lịch để tra cứu toàn bộ tình trạng của xe ở thời điểm hiện tại.
    - **Kiểm soát từng hạng mục:** Hệ thống hiển thị chi tiết tiến độ: dịch vụ nào đã xong, đang làm, thời gian bắt đầu và kết thúc thực tế của từng công đoạn.
    - **Rõ ràng về chi phí:** Bảng tổng hợp chi phí của riêng từng dịch vụ và tổng tiền thanh toán, đảm bảo không có chi phí ẩn.

- **3. Hệ Sinh Thái Tài Khoản Cá Nhân:** Không gian riêng tư để khách quản lý "sức khỏe" cho chiếc xe của mình:
    - **Khách hàng thân thiết:** Mở khóa các hạng thẻ thành viên dựa trên tổng chi tiêu tích lũy. Tận hưởng các đặc quyền xếp hạng do phía cửa hàng cài đặt.
    - **Lịch sử bảo dưỡng (Service History):** Lưu trữ toàn bộ các lần sửa chữa trước đây. Khách hàng dễ dàng biết được khi nào là lần thay dầu gần nhất hay lần bảo dưỡng lớn cuối cùng.
    - **Đăng nhập liền mạch:** Đăng kí linh hoạt và hỗ trợ đăng nhập siêu tốc bằng tài khoản Mạng xã hội Google, bỏ qua các bước ghi nhớ thêm mật khẩu phức tạp. Lấy lại mật khẩu nhanh bằng hệ thống mã OTP.

- **4. Thanh Toán Linh Hoạt & An Toàn:**
    - Khách hàng có thể lựa chọn thanh toán mặt-đối-mặt sau khi hoàn tất dịch vụ tại cửa hàng, hoặc thanh toán từ xa qua chuyển khoản ngân hàng (mã VietQR) một cách an toàn và bảo mật cao.

- **5. Tương Tác & Phản Hồi Dịch Vụ:**
    - **Quyền đánh giá (Review/Rating):** Sau mỗi trải nghiệm dịch vụ, khách hàng được trực tiếp chấm điểm và để lại nhận xét cho chất lượng tay nghề cũng như thái độ của vị kỹ thuật viên đó.
    - **Cẩm nang xe máy (Blog & News):** Tra cứu các mẹo vặt bảo dưỡng, hướng dẫn xử lý sự cố cơ bản ngay trên website của cửa hàng.
    - **Hỗ trợ 24/7:** Luôn có sẵn các biểu tượng liên hệ trực tiếp đến đường dây nóng (Hotline) hoặc Zalo của cửa hàng để được giải đáp thắc mắc ngay lập tức.

### **💼 Nhóm tính năng Quản trị (Admin)**

Dưới đây là danh sách phân hệ quản trị chi tiết được xây dựng toàn diện, bao phủ mọi nghiệp vụ vận hành:

- **Bảng Điều Khiển Tổng Quan (Dashboard):** Thống kê trực quan các KPI tăng trưởng (doanh thu, lượt khách), đối soát hoạt động gần nhất (recent activities), biểu đồ lịch đặt theo ngày, thống kê Top Dịch vụ / Danh mục bán chạy / Khu vực truy cập, và tỷ lệ phương thức thanh toán.
- **Quản lý Đặt lịch (Bookings & Calendar):** Quản lý toàn bộ vòng đời của đơn đặt lịch hẹn. Xử lý linh hoạt trạng thái đơn, xem chi tiết đánh giá kỹ thuật. Hỗ trợ xem dưới dạng biểu đồ **Giao diện Lịch (Calendar)** trực quan và tính năng tự động xuất Hóa đơn (Invoice) dạng PDF.
- **Quản lý Khách hàng & Người dùng (Customers & Users):** Quản lý trạng thái và hồ sơ khách hàng. Quản lý phân quyền tài khoản quản trị (Users) kèm cơ chế tự bảo vệ an toàn chặt chẽ (vd: ngăn Admin tự xóa tài khoản đang đăng nhập).
- **Thiết lập Khách hàng thân thiết (Membership Settings):** Quản trị động cấu hình các hạng mức thành viên, định mức tích điểm để kích thích nhu cầu trải nghiệm dịch vụ của khách.
- **Quản lý Dịch vụ & Danh mục (Services & Categories):** Hệ thống hóa các gói dịch vụ bảo dưỡng, rửa xe, phân cấp mạnh mẽ danh mục dịch vụ.
- **Quản lý Nhân sự & Đánh giá (Staff & Reviews):** Quản lý hồ sơ kỹ thuật viên, gắn dịch vụ chuyên môn chuyên biệt cho thợ. Tích hợp cấu hình linh hoạt giới hạn số lượng bộ phận tiếp nhận lịch (Active Staff). Cập nhật và đối soát các đánh giá (Reviews) phân tách từ khách hàng.
- **Quản lý Giao dịch (Payment & Transactions):** Theo dõi trạng thái của tất cả các giao dịch thanh toán trả trước và tại quầy ở mọi phương thức.
- **Quản lý Mã Khuyến mãi (Coupons & Redemptions):** Xây dựng chiến dịch mã giảm (giảm tiền mặt, giảm %). Thiết lập chặt chẽ hệ thống điều kiện áp dụng (Coupon Applicables) và lưu vết chi tiết lịch sử đổi mã thành công (Redemptions).
- **Quản lý Nội dung (Blog / Posts / Tags):** Quản trị CMS bài viết, tin tức hoàn chỉnh, với hệ thống từ khóa (Tags), danh mục bài (Blog Categories), hình ảnh bìa và hộp thư bình luận (Comments). Tự động sinh đường dẫn (Slug) chuẩn mực đảm bảo tính SEO.
- **Cấu hình Hệ thống (System Settings):** Module cấu hình tập trung để thay đổi tham số không cần code lại. Bao gồm thay đổi giờ làm mở/đóng cửa, thông tin liên hệ, tích điểm, liên kết tự động (SePay), mã API tích hợp hệ thống gửi nhắc nhở tức thời (Telegram Bot).
- **Tiện ích Hệ thống (Log Viewer & Bulk Delete):** Khả năng rà soát lịch sử lỗi phần mềm (Log viewer) trực tiếp trên trang admin. Áp dụng cơ chế loại bỏ dữ liệu đa bản ghi (Bulk Delete) hàng loạt dễ dàng, tối ưu tốc độ quản trị.

### **💳 Nhóm tính năng Thanh toán & Khuyến mãi (Payment & Marketing)**

- **Thanh toán (Payment):** Tích hợp luồng thanh toán chuyển khoản qua mã quét (VietQR), tối ưu trải nghiệm không tiền mặt, hệ thống sẽ tự động xác nhận giao dịch khi đã nhận được thông báo thành công từ ngân hàng.
- **Mã Khuyến mãi (Coupons):** Chủ động tạo, cấp phát các mã giảm giá cho hệ thống. Kiểm soát thời hạn, đối tượng áp dụng và chi phí để chạy các chiến dịch Marketing hiệu quả.

### **⚙️ Nhóm tính năng Hệ thống**

- **Cấu hình chung (Settings):** Cho phép admin thiết lập, tùy chỉnh linh hoạt thời gian mở/đóng cửa, thông tin thương hiệu tổng thể, thông tin ngân hàng, tối đa số lượng nhân viên có thể làm trong một khung giờ, liên kết tự động (SePay), mã API tích hợp hệ thống gửi nhắc nhở tức thời (Telegram Bot).
- **System & Security:** Lưu trữ cẩn thận mọi nhật ký hoạt động hệ thống (System logs), giám sát lưu lượng và nguồn khách truy cập minh bạch.

## **3. Điểm mạnh của hệ thống**

Hệ thống không chỉ dừng lại ở mặt giao diện mà còn chứa đựng kiến trúc bền vững bên trong mô hình doanh nghiệp:

- **All-in-One liền mạch:** Đã tích hợp sẵn mọi nghiệp vụ thiết yếu của hệ thống Booking khó nhằn như: Quản lý chi tiết lịch hẹn, Quản lý chiết khấu (Coupon), Chuẩn hóa Phân quyền. Chủ dự án mua về không cần tốn nhiều chi phí đập đi xây lại từng tính năng rời rạc.
- **Kiến trúc hệ thống Rõ ràng, Minh bạch:** Giao diện tối ưu trải nghiệm nhanh gọn; trong khi đó lõi hệ thống được xây dựng khắt khe và chặt chẽ, đảm nhận chịu tải toàn bộ các nghiệp vụ phức tạp về dữ liệu một cách an toàn.
- **Sẵn sàng Bảng quản trị (Admin Dashboard) cao cấp:** Tích hợp giao diện vận hành hoàn chỉnh, hiện đại dành riêng cho người chủ kinh doanh sử dụng được ngay với mọi số liệu tập trung về một màn hình trung tâm.
- **Dễ mở rộng:** Mã nguồn tuân thủ triệt để những tiêu chuẩn lập trình quốc tế (clean code), giúp các nhóm kỹ thuật tiếp quản về sau dễ dàng tiếp tục nâng cấp, tùy biến mà không làm hỏng tính năng hiện tại.
- **Thuật toán Đặt lịch Thông minh — Tối ưu từng phút nhàn rỗi:** Đây là điểm khác biệt cốt lõi so với các hệ thống đặt lịch lớn trên thị trường (ví dụ: 30Shine). Các hệ thống truyền thống thường chia thời gian theo "lát cắt" cố định (ví dụ: cứ 20 phút = 1 slot). Cách làm này dẫn đến **lãng phí nghiêm trọng**: nếu một dịch vụ thực tế chỉ tốn 25 phút, hệ thống sẽ chiếm trọn 2 slot (40 phút), 15 phút còn lại kỹ thuật viên phải ngồi chờ mà không được nhận khách mới. Moto Service Manager giải quyết triệt để vấn đề này bằng cơ chế **Lịch liên tục theo phút chính xác (Continuous Scheduling)**:
    - Thời lượng mỗi dịch vụ được tính toán động dựa trên thời gian thực tế (phút) của từng dịch vụ, không bị gò ép vào khuôn slot.
    - Khi khách đặt nhiều dịch vụ, hệ thống tự động **xếp chuỗi (chain)** các dịch vụ nối đuôi nhau, khớp từng phút mà không tạo ra khoảng trống lãng phí.
    - Kiểm tra trùng lịch nhân viên chính xác đến từng phút, đảm bảo kỹ thuật viên luôn được tận dụng tối đa năng suất mà không bao giờ bị gán chồng lịch.
    - Kết quả: **Năng suất tiếp nhận khách tăng đáng kể**, cửa hàng phục vụ được nhiều khách hơn trong cùng một ngày làm việc so với mô hình slot cố định.

## **4. Tính năng Nâng cao (Dòng cao cấp)**

Bên cạnh cốt lõi quy chuẩn, hệ thống tích hợp sẵn các công nghệ nâng chuẩn thiết kế cho ứng dụng doanh nghiệp:

- **Thông báo tức thì qua Telegram:** Mọi biến động đơn đặt lịch (có lịch hẹn mới, đổi lịch, v.v.) đều được đẩy thẳng vào điện thoại của chủ cửa hàng hoặc người quản lý thông qua ứng dụng **Telegram**. Chủ doanh nghiệp không cần ngồi trước máy tính mà vẫn nắm bắt và chốt lịch nhanh chóng mọi lúc, mọi nơi.
- **Gửi Email xác nhận tự động:** Ngay khi khách đặt lịch thành công, hệ thống tự động gửi email xác nhận với giao diện chuyên nghiệp đến hộp thư của khách hàng. Toàn bộ quá trình diễn ra âm thầm phía sau, không làm chậm trải nghiệm sử dụng website của khách.
- **Vận hành tự động, giảm thiểu nhân sự giám sát:** Hệ thống tự động xử lý các nghiệp vụ lặp đi lặp lại mà không cần con người can thiệp. Ví dụ: tự động hủy các đơn hàng chưa thanh toán quá 24 giờ, tự động đối soát trạng thái chuyển khoản theo chu kỳ — giúp chủ cửa hàng yên tâm vận hành mà không phải theo dõi từng giao dịch.
- **Thanh toán tự động qua QR Code:** Tích hợp sẵn cổng thanh toán chuyển khoản bằng mã QR (thông qua đối tác như SePay). Hệ thống tự động nhận biết khi khách chuyển khoản thành công và cập nhật trạng thái đơn hàng ngay lập tức — loại bỏ hoàn toàn thao tác xác nhận thủ công.
- **Bảo vệ an toàn trước tấn công mạng:** Hệ thống được trang bị lớp bảo vệ chống lại các hành vi spam và tấn công tự động (ví dụ: gửi OTP liên tục, đặt hẹn ồ ạt), giúp website luôn hoạt động ổn định và an toàn cho mọi người dùng.


## **5. Tình trạng hệ thống**

- **Production-ready (Độ hoàn thiện):** Dự án được thiết kế chuyên nghiệp tới từng tiểu tiết. Đã sẵn sàng phục vụ triển khai cho môi trường sản xuất của mô hình kinh doanh thực tế.
- **Thời gian Deploy ngay lập tức:** Có thể cấu hình và đóng gói đưa lên mạng hoạt động ngay tức thì trong thời gian ngắn mà không đòi hỏi chỉnh sửa logic.
- **Kiến trúc Docker tiên tiến:** Cả phân hệ người dùng và bên quản trị đều đã được trang bị **Docker/Docker Compose** hoàn chỉnh, mang lại sự thuận tiện khi triển khai trên bất kì hệ thống máy chủ nào và dễ dàng áp dụng luồng chạy tự động hóa phân phối (CI/CD).

## **6. Tiềm năng Mở rộng trong tương lai**

Nhờ có cốt lõi định hình rất sẵn sàng, đội ngũ sở hữu hoàn toàn có thế mạnh để phát triển tiếp cho tương lai:

- **Cơ hội ra mắt Mobile App tức thì:** Việc mã nguồn đã trang bị sẵn nền tảng API riêng biệt giúp khả năng đập bản Front-end phát triển thành một hệ sinh thái App trên di động (iOS / Android) cho khách mua thành chuẩn hóa - mà không phải xây lại khối xử lý trung tâm.
- **Đa dạng cổng Thanh toán:** Cấu trúc module thanh toán hiện được lập trình mềm dẻo, dễ dàng kết nối chéo thêm các cổng thanh toán mới (như Momo, VNPay, ZaloPay, Stripe hay PayPal) tùy theo mục tiêu tiếp cận nhóm người dùng của nhãn hàng.
- **Scale up tới đa chi nhánh (Multi-branch / Multi-tenant):** Nền tảng luồng hệ thống sơ khởi tách biệt rõ các đối tượng sở hữu, tạo bước đà hoàn hảo cho việc chuyển đổi hệ thống thành một nền tảng dạng chuỗi có nhiều cơ sở bảo hành trên nhiều vị trí địa lý khác nhau.