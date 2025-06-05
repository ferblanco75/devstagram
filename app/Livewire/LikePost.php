<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public function like(){
        return 'desde la fn like';
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
