@props(['record' => $record])

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

<script type="text/javascript">
    window.onload = () => {
        const likeIcons = document.querySelectorAll('.likeIcon')

        const toggleLike = async (id, key) => {
            let els = document.querySelectorAll(`#${id}`)
            let isLiked = els[0].getAttribute('data-liked')
            const route = isLiked ? 'unlike' : 'like'
            const url = `/records/${key}/${route}`

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

            els.forEach(el => {
                updateView(isLiked, likeCount, id, key)
                isLiked === '1' ? el.setAttribute('data-liked', '') : el.setAttribute('data-liked', '1')
            })

        }

        const updateView = (likeStatus, likeCount, recordId, key) => {
            const likeIcons = document.querySelectorAll(`#${recordId}`)
            const classes = likeStatus ? 'fas text-red-500' : ''
            const likes = document.querySelectorAll(`span[data-key="${key}"]`)

            likes.forEach(l => {
                l.innerHTML = `${likeCount} ${likeCount === 1 ? 'like' : 'likes'}`
            })

            if (!likeStatus) {
                likeIcons.forEach(i => {
                    i.classList.add('fas')
                    i.classList.add('text-red-500')
                })
            } else {
                likeIcons.forEach(i => {
                    i.classList.remove('fas')
                    i.classList.remove('text-red-500')
                })
            }
        }

        likeIcons.forEach(i => i.addEventListener('click', e => {
            toggleLike(e.target.id, i.getAttribute('data-key'))
        }))
    }
</script>
