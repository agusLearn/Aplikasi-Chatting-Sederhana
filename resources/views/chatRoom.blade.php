<div id="header-main-content">
    <div class="button-back">
        <i class="fa-solid fa-arrow-left"></i>
    </div>
    <div class="information-user-chatting">
        <h2 class="personal-name">{{ $user->name }}</h2>
        @if($user->status_active == 1)
        <p class="last-seen">Online</p>
        @else
        <p class="last-seen">{{ $user->updated_at->diffForHumans() }}</p>
        @endif
    </div>
    <div id="remove-chat">
        <div class="btn-remove-chat">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </div>
        <div class="link-remove-chat">
            <a onclick="document.getElementById('removeRoom').submit();">Remove Chat</a>
            <form action="{{ route('removeChat') }}" method="post" id="removeRoom">
                @csrf
                <input type="hidden" name="room_remove" value="{{$chat_room}}">
            </form>
        </div>
    </div>
</div>

<div id="content">
    <div id="content-chat">
        @foreach($chat as $dataChat)
        <div class="chat {{ $dataChat->user_id == Auth::user()->id ? ' right-chat' : '' }}">
            <div class="text-chat">
                {{ $dataChat->text }}
            </div>
            <div class="time-chat">{{ $dataChat->created_at->diffForHumans() }}</div>
        </div>
        @endforeach
    </div>
    <form action="#" id="form-chat" data-chat_room='{{ $chat_room }}'>
        <div class="group-form-chat">
            <textarea name="" id="text-chat" cols="50" rows="1" oninput="enter_grow(this)"></textarea>
            <div class="button-send">
                <button>
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </form>
</div>