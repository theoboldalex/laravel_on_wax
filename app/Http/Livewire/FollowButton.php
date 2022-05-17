<?php

namespace App\Http\Livewire;

use App\Events\UserFollowed;
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

    public function toggleFollowing()
    {
        if ($this->isFollowing) {
            $this->unfollow();
        }

        if (!$this->isFollowing) {
            $this->follow();
        }

        $this->isFollowing = !$this->isFollowing;
        $this->buttonText = $this->isFollowing ? 'Unfollow' : 'Follow';
    }

    private function follow()
    {
        UserFollowed::dispatch($this->user, auth()->user());

        $this->user->followers()->attach(auth()->id());
    }

    private function unfollow()
    {
        $this->user->followers()->detach(auth()->id());
    }
}
