<style>
    #likeBtn:focus {
        outline: none;
    }
</style>
@extends('layouts.app')

@section('content')
    <section class="my-6">
        <div class="my-4">
            <a href="{{ url()->previous(route('home')) }}"
               class="text-primary hover:opacity-70 transition duration-300 ease-in-out">Back</a>
        </div>
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-6/12">
                <h1 class="font-semibold text-4xl">
                    {{ $record->title }}
                </h1>
                <h1 class="font-semibold text-2xl text-gray-700">{{ $record->artist }}</h1>
                <img src="{{ Storage::disk('s3')->url('public/records/' . $record->image) }}"
                     alt="album art for {{ $record->title }} by {{ $record->artist }}"
                     class="my-4"
                     width="500">
            </div>
            <div class="lg:w-6/12 flex flex-col justify-center items-center sm:text-2xl">
                <div class="flex flex-col justify-center items-center my-4">
                    <img src="{{ Storage::disk('s3')->url('public/avatar/' . $record->user->avatar) }}" alt=""
                         width="100" class="rounded-full mr-4">
                    <a href="{{ route('profile', $record->user->username) }}">
                        <h4 class="font-semibold pr-4">{{ $record->user->username }}</h4>
                    </a>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Record Label:</h4>
                    <p class="font-light">{{ $record->label }}</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Catalog #:</h4>
                    <p class="font-light">{{ $record->catalog_number }}</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Year of Release:</h4>
                    <p class="font-light">{{ $record->year }}</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Diameter:</h4>
                    <p class="font-light">{{ $record->diameter }}"</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">RPM:</h4>
                    <p class="font-light">{{ $record->rpm }}</p>
                </div>

                <div class="pt-2 text-sm flex text-gray-400 text-2xl my-8">
                    @auth
                        <button id="likeBtn">
                            <i id="likeIcon"
                               class="far fa-heart mr-2 @if($record->likes->contains(auth()->id())) fas text-red-500 @endif"></i>
                        </button>
                    @endauth
                    <span id="likeCount"
                          class="font-medium">{{ $record->likes->count() }} {{ Str::plural('like', $record->likes->count()) }}</span>
                </div>
            </div>
        </div>

        @if ($record->comments->count())
            <hr>
            <div class="flex flex-col my-4">
                <h2 class="font-semibold text-3xl">Comments</h2>
            </div>
        @endif

        @auth
            <div class="flex flex-col my-4">
                <h3 class="font-semibold text-2xl my-4">Add a comment</h3>
                <form action="{{ route('comment', $record->id) }}" method="post">
                    @csrf
                    <textarea name="comment" id="comment" cols="30" rows="5"
                              class="border rounded-lg w-full p-2"></textarea>
                    <button type="submit"
                            class="mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease block float-right">
                        Submit
                    </button>
                </form>
            </div>
        @endauth

        @foreach ($record->comments as $comment)
            <div class="flex flex-col my-4">
                <div class="border rounded-xl p-8">
                    <div class="flex items-center mb-4">
                        <img
                            src="{{ Storage::disk('s3')->url('public/avatar/' . $comment->user->avatar) }}"
                            alt="" width="50" class="rounded-full mr-4">
                        <h4 class="font-semibold mr-4"><a
                                href="{{ route('profile', $comment->user->username) }}">{{ $comment->user->username }}</a>
                        </h4>
                        <h4 class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</h4>
                    </div>
                    <hr>
                    <div class="font-light mt-4">
                        {{ $comment->body }}
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection

<script type="text/javascript">
    window.onload = () => {
        const likeIcon = document.querySelector('#likeIcon')
        let isLiked = '{{ $record->likes->contains(auth()->id()) }}' === '1'

        const toggleLike = async () => {
            const recordId = '{{ $record->id }}'
            const route = isLiked ? 'unlike' : 'like'
            const url = `/records/${recordId}/${route}`

            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': '{{ @csrf_token() }}'
                }
            })

            const likeCount = await res.json()

            updateView(isLiked, likeCount)
            isLiked = !isLiked
        }

        const updateView = (likeStatus, likeCount) => {
            const classes = likeStatus ? 'fas text-red-500' : ''
            const likes = document.querySelector('#likeCount')

            likes.innerHTML = `${likeCount} ${likeCount === 1 ? 'like' : 'likes'}`

            if (!likeStatus) {
                likeIcon.classList.add('fas')
                likeIcon.classList.add('text-red-500')
            } else {
                likeIcon.classList.remove('fas')
                likeIcon.classList.remove('text-red-500')
            }
        }

        if (likeIcon) {
            likeIcon.addEventListener('click', toggleLike)
        }
    }
</script>
