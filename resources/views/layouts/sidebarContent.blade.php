<div class="header-sidebar-content">
    <div class="group-menu-sidebar-content">
        <div id="open-sub-menu-sidebar" class="dropdown-3-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="sub-menu-sidebar-content">
            <a href="#">profile</a>
            <a href="{{ route('logout-account') }}">Logout</a>
        </div>
    </div>
    <form id="form-search" method="post">
        <input type="text" id="find-name">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>
<div id="list-friends-chat">
    <div class="group-list-friend">
        <div class="photo-friend">
            <img src="{{ asset('photo-profile/default.png') }}" alt="">
        </div>
        <div class="info-friend ">
            <h2 class="name-friend">M Agus Khamsinindo</h2>
            <p class="highlight-chat">Lorem ipsum dolor sit.... </p>
        </div>
    </div>
    <div class="group-list-friend">
        <div class="photo-friend">
            <img src="{{ asset('photo-profile/default.png') }}" alt="">
        </div>
        <div class="info-friend ">
            <h2 class="name-friend">Jamaluddin</h2>
            <p class="highlight-chat">Sticker </p>
        </div>
    </div>
    <div class="group-list-friend">
        <div class="photo-friend">
            <img src="{{ asset('photo-profile/default.png') }}" alt="">
        </div>
        <div class="info-friend ">
            <h2 class="name-friend">Raden Ricky</h2>
            <p class="highlight-chat">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea tempora modi, </p>
        </div>
    </div>
</div>