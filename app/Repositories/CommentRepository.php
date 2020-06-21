<?php


namespace App\Repositories;


use App\User;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    /**
     * @param User $user
     * @param string $order_by
     * @param string $direction
     * @param array $relationships
     * @param array|string[] $columns
     * @param int $limit
     * @return Collection
     */
    public static function USER_COMMENTS(User $user,string $order_by = 'created_at', string $direction = 'desc', array $relationships = [], array $columns = ['*'], int $limit = -1)
    {
        //return $user->comments()->latest()->with(['status', 'appointment'])->select('status_id', 'body', 'appointment_id', 'created_at')->take(4)->get();
        return $user->comments()->orderBy($order_by, $direction)->with($relationships)->select($columns)->take($limit)->get();
    }
}
