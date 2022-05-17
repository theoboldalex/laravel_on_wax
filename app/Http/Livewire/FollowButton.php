<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public string $buttonText;
    public bool $isFollowing;
    public User $user;

    public function render()
    {
        return view('livewire.follow-button');
    }

    public function mount()
    {
        $this->buttonText = $this->isFollowing ? 'Unfollow' : 'Follow';
    }
}
