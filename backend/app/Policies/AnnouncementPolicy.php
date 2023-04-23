<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    // 閲覧
    public function view(User $user)
    {
        $user_types = [
            'owner', // オーナー
            'general' // 一般
        ];
        return (in_array($user->role, $user_types));
    }

    // 追加
    public function create(User $user)
    {
        return ($user->role == 'owner'); // オーナーだけOK
    }

    /* 変更 */
    public function update(User $user)
    {
        return ($user->role == 'owner'); // オーナーだけOK
    }

    /* 削除 */
    public function delete(User $user)
    {
        return ($user->role == 'owner'); // オーナーだけOK
    }
}
