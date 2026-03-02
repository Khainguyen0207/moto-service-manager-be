<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostView;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding blog...');

        $default = asset('assets/img/blog/default.png');

        $faq = asset('assets/img/blog/faq.png');

        $membership = asset('assets/img/blog/membership.png');

        Storage::disk('public')->put('blog/default.png', file_get_contents($default));
        Storage::disk('public')->put('blog/faq.png', file_get_contents($faq));
        Storage::disk('public')->put('blog/membership.png', file_get_contents($membership));

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Comment::truncate();
        DB::table('blog_post_categories')->truncate();
        PostView::truncate();
        Post::truncate();
        BlogCategory::truncate();
        Tag::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::transaction(function () {

            $categoryIds = $this->seedCategories();

            $this->seedTags();

            $this->seedPostsWithRelations($categoryIds);
        });
    }

    private function seedCategories(): array
    {
        $names = [
            'Thông báo',
            'Membership',
            'Bảo dưỡng',
            'Kỹ thuật',
            'Khuyến mãi',
            'Chăm sóc xe',
            'Kinh nghiệm',
            'Hướng dẫn',
        ];

        $now = now();

        foreach ($names as $name) {
            DB::table('blog_categories')->updateOrInsert(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]
            );
        }

        return DB::table('blog_categories')->pluck('category_id')->all();
    }

    function imagePost($name)
    {
        switch ($name) {
            case 'Membership':
                return 'blog/membership.png';
            case 'Hướng dẫn':
                return 'blog/faq.png';
            default:
                return 'blog/default.png';
        }
    }

    private function seedTags(): void
    {
        $tags = [
            'ưu đãi',
            'tích điểm',
            'kim cương',
            'vàng',
            'bạc',
            'dầu nhớt',
            'phanh',
            'lốp',
            'lọc gió',
            'bugi',
            'hao xăng',
            'bảo dưỡng',
            'sửa chữa',
            'an toàn',
            'mẹo hay',
        ];

        foreach ($tags as $t) {
            $slug = Str::slug($t);

            DB::table('tags')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name' => $t,
                    'slug' => $slug,
                ]
            );
        }
    }

    private function seedPostsWithRelations(array $categoryIds): void
    {
        $userIds = DB::table('users')->pluck('id')->all();
        $now = now();

        $titlePool = [
            'Chương trình Khách hàng Thân thiết',
            'Ưu đãi tháng này tại tiệm',
            '5 dấu hiệu xe cần kiểm tra ngay',
            'Checklist bảo dưỡng định kỳ cho xe máy',
            'Vì sao xe hao xăng bất thường?',
            'Hướng dẫn kiểm tra xe trước chuyến đi xa',
            'Bí quyết giữ xe bền máy',
            'Những lỗi xe máy thường gặp và cách xử lý',
            'Tại sao nên thay nhớt đúng lịch?',
            'Phanh kêu, rung: khi nào cần thay bố?',
        ];

        for ($i = 1; $i <= 30; $i++) {
            $baseTitle = $titlePool[array_rand($titlePool)];
            $title = $baseTitle . ' #' . $i;

            $slug = Str::slug($title);
            $slug = $this->uniqueSlug('posts', 'slug', $slug);

            $createdAt = now()->subDays(rand(0, 120))->subMinutes(rand(0, 1440));
            $updatedAt = (clone $createdAt)->addDays(rand(0, 20));

            $postId = DB::table('posts')->insertGetId([
                'user_id' => ! empty($userIds) ? $userIds[array_rand($userIds)] : null,
                'title' => $title,
                'slug' => $slug,
                'image' => $this->imagePost($baseTitle),
                'body' => $this->fakeBodyHtml($baseTitle),
                'status' => (rand(1, 100) <= 85) ? 'published' : 'draft',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ], 'post_id');

            $pickCount = rand(1, 3);
            $picked = collect($categoryIds)->shuffle()->take($pickCount)->values()->all();

            foreach ($picked as $catId) {
                DB::table('blog_post_categories')->updateOrInsert(
                    ['post_id' => $postId, 'category_id' => $catId],
                    ['post_id' => $postId, 'category_id' => $catId]
                );
            }

            DB::table('post_views')->updateOrInsert(
                ['post_id' => $postId],
                [
                    'post_id' => $postId,
                    'view_count' => rand(0, 5000),
                    'like_count' => rand(0, 800),
                ]
            );

            $this->seedCommentsForPost($postId, $userIds, $createdAt);
        }

        // Seed specific Membership Program post
        $membershipTitle = 'CHƯƠNG TRÌNH THÀNH VIÊN – ƯU ĐÃI THEO CẤP BẬC';
        $membershipSlug = Str::slug($membershipTitle);
        $membershipId = DB::table('posts')->insertGetId([
            'user_id' => ! empty($userIds) ? $userIds[array_rand($userIds)] : null,
            'title' => $membershipTitle,
            'slug' => $membershipSlug,
            'image' => $this->imagePost('Membership'),
            'body' => $this->membershipProgramBodyHtml(),
            'status' => 'published',
            'created_at' => now(),
            'updated_at' => now(),
        ], 'post_id');

        // Assign to "Membership" category if exists
        $membershipCat = DB::table('blog_categories')->where('slug', 'membership')->first();
        if ($membershipCat) {
            DB::table('blog_post_categories')->updateOrInsert(
                ['post_id' => $membershipId, 'category_id' => $membershipCat->category_id],
                ['post_id' => $membershipId, 'category_id' => $membershipCat->category_id]
            );
        }
    }

    private function seedCommentsForPost(int $postId, array $userIds, $baseTime): void
    {
        $commentBodies = [
            '<p>Ổn áp.</p>',
            '<p>Bài này hữu ích nè, cảm ơn shop.</p>',
            '<p>Cho hỏi áp dụng membership như nào vậy?</p>',
            '<p>Mình vừa làm theo checklist, xe chạy mượt hơn.</p>',
            '<p>Đúng cái mình cần, đang định đi xa.</p>',
            '<p>Giá thay nhớt bên mình khoảng bao nhiêu?</p>',
        ];

        $count = rand(0, 6);
        if ($count === 0) {
            return;
        }

        $topLevelIds = [];

        for ($i = 0; $i < $count; $i++) {
            $createdAt = (clone $baseTime)->addDays(rand(0, 30))->addMinutes(rand(1, 5000));

            $isApproved = rand(1, 100) <= 70;
            $status = $isApproved ? 'approved' : (rand(0, 1) ? 'pending' : 'spam');

            $parentId = (rand(1, 100) <= 20 && ! empty($topLevelIds))
                ? $topLevelIds[array_rand($topLevelIds)]
                : null;

            $commentId = DB::table('comments')->insertGetId([
                'post_id' => $postId,
                'user_id' => ! empty($userIds) ? $userIds[array_rand($userIds)] : null,
                'parent_comment_id' => $parentId,
                'comment_body' => $commentBodies[array_rand($commentBodies)],
                'status' => $status,
                'created_at' => $createdAt,
            ], 'comment_id');

            if ($parentId === null) {
                $topLevelIds[] = $commentId;
            }
        }
    }

    private function fakeBodyHtml(string $topic): string
    {
        $shop = 'Trung Tâm Chăm Sóc Xe Lí Thú';

        return <<<HTML
<p><span class="ql-size-large">Nhằm tri ân khách hàng đã tin tưởng và đồng hành, </span>
<strong class="ql-size-large">{$shop}</strong>
<span class="ql-size-large"> xin chia sẻ bài viết: </span>
<strong class="ql-size-large">{$topic}</strong>.</p>

<p>Mỗi lần sử dụng dịch vụ sửa chữa hoặc bảo dưỡng, bạn nên kiểm tra các hạng mục cơ bản để tránh phát sinh lỗi lớn.</p>

<h3>📌 GỢI Ý NHANH</h3>
<ol>
  <li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Kiểm tra dầu nhớt và lọc gió</li>
  <li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Kiểm tra phanh, lốp, áp suất</li>
  <li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Nhắc lịch bảo dưỡng định kỳ</li>
</ol>

<h3>🔧 CAM KẾT</h3>
<p>{$shop} luôn ưu tiên chất lượng dịch vụ, minh bạch chi phí và tư vấn rõ ràng trước khi thực hiện.</p>
HTML;
    }

    private function uniqueSlug(string $table, string $column, string $baseSlug): string
    {
        $slug = $baseSlug;
        $i = 2;

        while (DB::table($table)->where($column, $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

    private function membershipProgramBodyHtml(): string
    {
        return <<<HTML
<div class="ql-editor">
    <p>🚗 <strong>CHƯƠNG TRÌNH THÀNH VIÊN – ƯU ĐÃI THEO CẤP BẬC</strong></p>
    <p>Chúng tôi trân trọng sự đồng hành của khách hàng bằng hệ thống thành viên với nhiều đặc quyền thiết thực.</p>
    <p>Tất cả thành viên tích điểm như nhau cho mỗi dịch vụ. Sự khác biệt nằm ở mức ưu đãi và quyền lợi ưu tiên khi sửa xe.</p>
    
    <h2>1. Các Cấp Bậc Thành Viên</h2>

    <h3>🥉 Silver – Thành viên cơ bản</h3>
    <p>Dành cho khách hàng sử dụng dịch vụ định kỳ.</p>
    <ul>
        <li>Giảm giá 2% trên tổng hóa đơn</li>
        <li>Nhắc lịch bảo dưỡng định kỳ</li>
        <li>Kiểm tra tổng quát miễn phí khi đến sửa</li>
        <li>Tham gia các chương trình ưu đãi chung</li>
    </ul>

    <h3>🥈 Gold – Thành viên ưu tiên</h3>
    <p>Dành cho khách hàng có tần suất sử dụng dịch vụ cao.</p>
    <ul>
        <li>Giảm giá 4% trên tổng hóa đơn</li>
        <li>Ưu tiên xếp lịch sửa nhanh hơn</li>
        <li>Miễn phí kiểm tra xe 1 lần/năm</li>
        <li>Giảm giá phụ tùng chính hãng</li>
        <li>Hỗ trợ cứu hộ nội thành với mức phí ưu đãi</li>
    </ul>

    <h3>🥇 Diamond – Thành viên đặc quyền</h3>
    <p>Dành cho khách hàng thân thiết lâu năm.</p>
    <ul>
        <li>Giảm giá 8% trên tổng hóa đơn</li>
        <li>Ưu tiên tiếp nhận ngay khi đến cửa hàng</li>
        <li>Miễn phí kiểm tra xe định kỳ</li>
        <li>Miễn phí công thay thế phụ tùng cơ bản</li>
        <li>Cứu hộ nội thành miễn phí</li>
        <li>Hỗ trợ ngoài giờ khi cần thiết</li>
    </ul>

    <h2>2. Bảng So Sánh Quyền Lợi</h2>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px; border: 1px solid #ddd;">Quyền lợi</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Silver</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Gold</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Diamond</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Giảm giá hóa đơn</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">2%</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">4%</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">8%</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Ưu tiên xếp lịch</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">-</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Có</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Rất ưu tiên</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Kiểm tra xe miễn phí</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Khi sửa</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">1 lần/năm</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Định kỳ</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Cứu hộ nội thành</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">-</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Ưu đãi phí</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Miễn phí</td>
            </tr>
        </tbody>
    </table>

    <h2>3. Cách Tích Điểm</h2>
    <p>Mỗi dịch vụ đều được tích điểm theo cùng một tỷ lệ áp dụng cho tất cả thành viên. Điểm được dùng để nâng hạng và hưởng thêm đặc quyền.</p>
    <ul>
        <li>Hệ thống tự động cập nhật điểm sau mỗi lần thanh toán.</li>
        <li>Hạng thành viên được xét duyệt dựa trên tổng chi tiêu tích lũy.</li>
    </ul>
</div>
HTML;
    }
}
