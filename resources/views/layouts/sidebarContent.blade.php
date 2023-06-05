<div class="header-sidebar-content">
    <div class="group-menu-sidebar-content">
        <div id="open-sub-menu-sidebar" class="dropdown-3-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="sub-menu-sidebar-content">
            <a href="#" id="profile">profile</a>
            <a href="{{ route('logout-account') }}">Logout</a>
        </div>
    </div>

    <form id="form-search" method="post">
        <!-- @csrf -->
        <input type="text" name="name" id="find-name">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>
<div id="list-friends-chat">
    @foreach($friends as $list)

    @php $data_user = Auth::user()->id @endphp
    @if($list->user_1 == $data_user)
        @php $dataUser = $list->user_2 @endphp
    @else
        @php $dataUser = $list->user_1 @endphp
    @endif

    <div class="group-list-friend" data-room="{{ $list->room }}/{{ $dataUser }}" data-room_chatting="{{ $list->room }}">

        <div class="photo-friend">
            @if($list->photo_profile == null)
            <img src="{{ asset('photo-profile/default.png') }}" alt="">
            @else
            <img src="{{ asset($list->path_photo_profile) }}" alt="">
            @endif
        </div>
        <div class="info-friend ">
            <h2 class="name-friend">{{ $list->user_name }}</h2>
            @if($list->text !== null)
            <p class="highlight-chat">{{ Str::limit($list->text, $limit = 20, $end = '...') }}</p>
            @else
            <p class="highlight-chat"></p>
            @endif
        </div>
    </div>
    @endforeach
    <!-- 
        <div class="group-list-friend">
        <div class="photo-friend">
            <img src="{{ asset('photo-profile/default.png') }}" alt="">
        </div>
        <div class="info-friend ">
            <h2 class="name-friend">M Agus Khamsinindo</h2>
            <p class="highlight-chat"></p>
        </div>
    </div>
 -->
</div>