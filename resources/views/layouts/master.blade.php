<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- fontawesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app-chat">
        <div id="sidebar-content">
            <div class="header-sidebar-content">
                <div class="group-menu-sidebar-content">
                    <div id="open-sub-menu-sidebar" class="dropdown-3-icon">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="sub-menu-sidebar-content">
                        <a href="#">profile</a>
                        <a href="#">Setting</a>
                        <a href="#">Logout</a>
                    </div>
                </div>
                <form action="#" id="form-search">
                    <input type="text">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div id="list-friends-chat">
                <div class="group-list-friend active-click">
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
                        <h2 class="name-friend">M Agus Khamsinindo</h2>
                        <p class="highlight-chat">Sticker </p>
                    </div>
                </div>
                <div class="group-list-friend">
                    <div class="photo-friend">
                        <img src="{{ asset('photo-profile/default.png') }}" alt="">
                    </div>
                    <div class="info-friend ">
                        <h2 class="name-friend">M Agus Khamsinindo</h2>
                        <p class="highlight-chat">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea tempora modi, </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-content">
            <div id="header-main-content">
                <div class="button-back">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="information-user-chatting">
                    <h2 class="personal-name">M Agus Khamsinindo</h2>
                    <p class="last-seen">Last Online : 3 Hours Ago</p>
                </div>
                <div id="remove-chat">
                    <div class="btn-remove-chat">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                    <div class="link-remove-chat">
                        <a href="#">Remove Chat</a>
                    </div>
                </div>
            </div>

            <div id="content">
                <div id="content-chat">
                    <!-- left chat -->
                    <div class="left-chat">
                        <p class="text-chat">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Optio cupiditate quidem alias cumque iusto ipsum consectetur assumenda nemo nobis vero. Accusamus expedita fugit dolore officiis doloremque eius laborum dignissimos eos!
                        </p>
                        <p class="time-chat">07:30</p>
                    </div>
                    <div class="left-chat">
                        <p class="text-chat">
                            o   
                        </p>
                        <p class="time-chat">07:30</p>
                    </div>
                    <!-- right chat -->
                    <div class="right-chat">
                        <div class="text-chat">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro libero eligendi natus repudiandae, animi mollitia illo, maiores eius incidunt obcaecati in, ea nostrum soluta atque provident quisquam! Veniam, dolores dolore.
                        </div>
                        <div class="time-chat">21:29</div>
                    </div>
                    <div class="right-chat">
                        <div class="text-chat">
                          oke
                        </div>
                        <div class="time-chat">21:34</div>
                    </div>
                </div>
                <form action="#" id="form-chat">
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
            <!-- @yield('content') -->
        </div>
    </div>


    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    @stack('js')


    <script>
        // open bars menu
        $('#open-sub-menu-sidebar').click(function() {
            let subMenuSideBar = $(this).parent().find('.sub-menu-sidebar-content');
            // console.log(subMenuSideBar)
            subMenuSideBar.toggleClass('show-sub-menu-sidebar-content');
        })


        // open link remove chat
        $('#remove-chat').click(function() {
            let open_link_remove_chat = $(this).find('.link-remove-chat');
            open_link_remove_chat.toggleClass('show-link-remove-chat')
        })


        function enter_grow(el) {
            el.style.height = "10px";
            let size_el_textarea = el.scrollHeight;
            if(size_el_textarea >= 159){
                el.style.height = "159px"
            }else{
                el.style.height = (el.scrollHeight) + "px"
            }

            // $('#content-chat').
        }
    </script>
</body>

</html>