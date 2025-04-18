<?php

namespace App\Services;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function toggle($likeable): bool
    {
        $user = Auth::user();

        if ($likeable->likes()->where('user_id', $user->id)->exists()) {
            $likeable->likes()->where('user_id', $user->id)->delete();
            return false;
        }
    
        $likeable->likes()->create([
            'user_id' => $user->id,
        ]);
    
        return true;
    }
}
