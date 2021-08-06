<style>
    #likeBtn:focus {
        outline: none;
    }
</style>

@extends('layouts.app')

@section('content')
    @auth
        <h1 class="font-semibold text-3xl my-6">Hello {{ auth()->user()->username }}</h1>
        <hr>
    @endauth
    <h2 class="font-semibold text-2xl my-6">Latest uploads</h2>
    <div class="card-grid">
        @foreach ($records as $record)
            <div class="rounded overflow-hidden border w-full bg-white">
                <div class="w-full flex justify-between p-3">
                    <div class="flex">
                        <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                            <img src="{{ Storage::disk('s3')->url('public/avatar/' . $record->user->avatar) }}" alt="profilepic">
                        </div>
                        <span class="pt-1 ml-2 font-bold text-sm"><a
                                href="{{ route('profile', $record->user->username) }}">{{ $record->user->username }}</a></span>
                    </div>
                </div>
                <a href="{{ route('record_detail', $record->id) }}">
                    <img class="w-full bg-cover" src="{{ Storage::disk('s3')->url('public/records/' . $record->image) }}" width="200">
                </a>
                <div class="px-3 pb-2">
                    <div class="pt-2 text-sm flex text-gray-400">
                        @auth
                            <button id="likeBtn">
                                <i id="record_{{ $record->id }}" data-key="{{ $record->id }}" data-liked="{{ $record->likes->contains(auth()->id()) }}" class="likeIcon far fa-heart mr-2 @if($record->likes->contains(auth()->id())) fas text-red-500 @endif"></i>
                            </button>
                        @endauth
                        <span id="likeCount_{{ $record->id }}" data-key="{{ $record->id }}" class="font-medium">{{ $record->likes->count() }} {{ Str::plural('like', $record->likes->count()) }}</span>
                    </div>
                    <div class="pt-1">
                        <div class="mb-2 text-sm">
                            <p class="font-medium mr-2">{{ $record->artist }}</p>
                            <p class="">{{ $record->title }}</p>
                        </div>
                    </div>
                    <a href="{{ route('record_detail', $record->id) }}">
                        <div
                            class="text-sm mb-2 text-gray-400 font-medium">{{ $record->created_at->diffForHumans() }}</div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <hr class="my-8">
    @auth
        <section class="mb-8">
            <h2 class="font-semibold text-2xl my-6">Your Feed</h2>
            <div class="card-grid mb-8">
                @foreach($feed as $feedItem)
                    <div class="rounded overflow-hidden border w-full bg-white">
                        <div class="w-full flex justify-between p-3">
                            <div class="flex">
                                <div
                                    class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                                    <img src="{{ Storage::disk('s3')->url('public/avatar/' . $feedItem->user->avatar) }}"
                                         alt="profilepic">
                                </div>
                                <span class="pt-1 ml-2 font-bold text-sm"><a
                                        href="{{ route('profile', $feedItem->user->username) }}">{{ $feedItem->user->username }}</a></span>
                            </div>
                        </div>
                        <a href="{{ route('record_detail', $feedItem->id) }}">
                            <img class="w-full bg-cover" src="{{ Storage::disk('s3')->url('public/records/' . $feedItem->image) }}"
                                 width="200">
                        </a>
                        <div class="px-3 pb-2">
                            <div class="pt-2 text-sm flex text-gray-400">
                                @auth
                                    <button type="submit">
                                        <i class="far fa-heart mr-2 @if($feedItem->likes->contains(auth()->id())) fas text-red-500 @endif"></i>
                                    </button>
                                @endauth
                                <span class="font-medium">{{ $feedItem->likes->count() }} {{ Str::plural('like', $feedItem->likes->count()) }}</span>
                            </div>
                            <div class="pt-1">
                                <div class="mb-2 text-sm">
                                    <p class="font-medium mr-2">{{ $feedItem->artist }}</p>
                                    <p class="">{{ $feedItem->title }}</p>
                                </div>
                            </div>
                            <a href="{{ route('record_detail', $record->id) }}">
                                <div
                                    class="text-sm mb-2 text-gray-400 font-medium">{{ $feedItem->created_at->diffForHumans() }}</div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $feed->links() }}
        </section>
    @endauth
@endsection

<script type="text/javascript">
    window.onload = () => {
        const likeIcons = document.querySelectorAll('.likeIcon')

        const toggleLike = async (id, key) => {
            let el = document.querySelector(`#${id}`)
            let isLiked = el.getAttribute('data-liked')
            const route = isLiked ? 'unlike' : 'like'
            const url = `/records/${key}/${route}`

            console.log(url)
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

            updateView(isLiked, likeCount, id, key)

            isLiked === '1' ? el.setAttribute('data-liked', '') : el.setAttribute('data-liked', '1')
        }

        const updateView = (likeStatus, likeCount, recordId, key) => {
            const likeIcon = document.querySelector(`#${recordId}`)
            const classes = likeStatus ? 'fas text-red-500' : ''
            const likes = document.querySelector(`span[data-key="${key}"]`)

            likes.innerHTML = `${likeCount} ${likeCount === 1 ? 'like' : 'likes'}`

            if (!likeStatus) {
                likeIcon.classList.add('fas')
                likeIcon.classList.add('text-red-500')
            } else {
                likeIcon.classList.remove('fas')
                likeIcon.classList.remove('text-red-500')
            }
        }

        likeIcons.forEach(i => i.addEventListener('click', e => {
            toggleLike(e.target.id, i.getAttribute('data-key'))
        }))
    }
</script>
