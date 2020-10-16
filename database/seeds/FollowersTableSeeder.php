<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // 获取去除掉 ID 为 1 的所有用戶 ID 数组
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // 关注除了 1 号用戶以外的所有用戶
        $user->follow($follower_ids);

        // 除了 1 号用戶以外的所有用戶都来关注 1 号用戶
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}