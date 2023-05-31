<div id="header-main-content">
    <div class="button-back">
        <i class="fa-solid fa-arrow-left"></i>
    </div>
</div>


<div id="content">
    <div id="find-friends">
        @foreach($newFriends as $listFriends)
        <div class="group-list-find-friends">
            <div class="foto-find-friends">
                @if($listFriends->personalInfo->photo_profile === null)
                <img src="{{ asset('photo-profile/default.png') }}" alt="">
                @else
                <img src="{{ asset('photo-profile/default.png') }}" alt="">
                @endif
            </div>
            <h2 class="name-find-friends">{{ $listFriends->name }}</h2>
            <form action="#" class="add-friends">
                <input type="hidden" value="{{ $listFriends->id }}" class="user">
                <button type="submit" id="btn-add-friends">Add Friends</button>
            </form>
        </div>
        @endforeach

        <!-- this just example template -->
        <!-- <div class="group-list-find-friends">
            <div class="foto-find-friends">
                <img src="{{ asset('photo-profile/default.png') }}" alt="">
            </div>
            <h2 class="name-find-friends">Kuntomo Argo</h2>
            <form action="#">
                <input type="hidden" value="1">
                <button type="submit" id="btn-add-friends">Add Friends</button>
            </form>
        </div> -->
    </div>
</div>