@auth
    @if(auth()->user()->username != request()->route('username'))
        {{--        <form--}}
        {{--            action="{{ $isFollowing ? route('unfollow', $user->username) : route('follow', $user->username) }}"--}}
        {{--            method="post">--}}
        {{--            @csrf--}}
        {{--            <button type="submit"--}}
        {{--                    class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">{{ $buttonText }}--}}
        {{--            </button>--}}
        {{--        </form>--}}

        <button wire:click="toggleFollowing"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">{{ $buttonText }}
        </button>
    @else
        <form action="" method="post">
            @csrf
            <a href="{{ route('edit_profile', auth()->user()->username) }}"
               class="px-4 py-3 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">
                Edit Profile
            </a>
        </form>
    @endif
@endauth
