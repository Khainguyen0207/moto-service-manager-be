<?php

namespace App\Http\Controllers\API;

use App\Enums\BasicStatusEnum;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController
{
    public function getPost(string $slug)
    {
        $post = Post::query()
            ->with(['user.staff', 'user.customer', 'postView', 'comments', 'blogCategories'])
            ->where('status', BasicStatusEnum::PUBLISHED)
            ->where('slug', $slug)->firstOrFail();

        return [
            'error' => false,
            'data' => PostResource::make($post),
            'message' => 'Lấy bài viết thành công.',
        ];
    }

    public function getPosts()
    {
        $posts = Post::query()
            ->where('status', BasicStatusEnum::PUBLISHED)
            ->orderByDesc('created_at')
            ->paginate(20);

        return [
            'error' => false,
            'data' => PostResource::collection($posts),
            'message' => 'Lấy danh sách bài viết thành công.',
        ];
    }

    public function comment(Request $request)
    {
        $status = 'approved';

        $request->validate([
            'post_id' => 'required|string|exists:posts,post_id',
            'comment_body' => 'required|string',
            'parent_comment_id' => 'nullable|string|exists:comments,comment_id',
        ]);

        $user = $request->user();

        $cmt = Comment::query()->create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'comment_body' => $request->comment_body,
            'parent_comment_id' => $request->parent_comment_id,
            'status' => $status,
        ])->load('user');

        return response()->json([
            'error' => false,
            'data' => CommentResource::make($cmt),
            'message' => 'Bình luận thành công.',
        ]);
    }
}
