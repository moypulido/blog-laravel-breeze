<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Post extends Component
{
    public $post;
    public $comments;
    public $likesCount;
    public $userHasLiked;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
        $this->comments = $post->comments;
        $this->likesCount = $post->likes->count();
        $this->userHasLiked = Auth::check() 
            ? ($post->likes->where('user_id', Auth::id())->count() > 0
                ? $post->likes->where('user_id', Auth::id())->count() > 0
                : false)
            : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post');
    }
}