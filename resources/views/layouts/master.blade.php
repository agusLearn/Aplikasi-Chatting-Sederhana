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
            @include('layouts.sidebarContent')
        </div>

        <div id="main-content">
            <div id="header-main-content">
                @yield('header-main-content')
            </div>

            <div id="content">
                @yield('content')
            </div>
        </div>
    </div>


    <div id="modal-user-profile" class="modal-page">
        <div class="modal-wrapper">
            <div class="modal-close-button">
                <i class="fa-sharp fa-solid fa-circle-xmark"></i>
            </div>
            <div id="modal-title">
                <h2 class="title">Profile User</h2>
            </div>
            <div id="modal-content">
                <div class="profile-user">
                    <div class="img-wrapper">
                        <img src="" alt="default" id="img-profile">
                    </div>
                    <div class="name-user">
                    </div>
                    <div class="describe">
                    </div>
                    <div class="button-edit-profile">
                        Edit Profile
                    </div>
                </div>

                <form action="#" id="edit-user" enctype="multipart/form-data">
                    <div class="row gy-3">
                        <div class="col-md-6 col-12">
                            <div class="img-wrapper">
                                <img src="" alt="" id="img-edit-user">
                            </div>
                        </div>
                        <!-- button add image -->
                        <div class="col-md-6 col-12 center-input">
                            <input type="file" name="new_file_photo">
                        </div>
                    </div>
                    <div class="group-edit-user">
                        <label for="dc">Username :</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="group-edit-user">
                        <label for="dc">Describe :</label>
                        <textarea name="description" id="dc"></textarea>
                    </div>

                    <button type="submit">Save Change Profile</button>
                </form>
            </div>
        </div>
    </div>


    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- script csrf -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <!-- // pusher js -->
    <script>
        $(document).ready(function() {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('17034a2e9c291053cb4e', {
                cluster: 'ap1'
            });



        })
    </script>


    <script>
        // open bars menu
        $('#open-sub-menu-sidebar').click(function() {
            let subMenuSideBar = $(this).parent().find('.sub-menu-sidebar-content');
            // console.log(subMenuSideBar)
            subMenuSideBar.toggleClass('show-sub-menu-sidebar-content');
        })


        // open link remove chat
        $('body').on('click', '#remove-chat', function() {
            let open_link_remove_chat = $(this).find('.link-remove-chat');
            open_link_remove_chat.toggleClass('show-link-remove-chat')
        })

        // enter textarea will otomatis +height until max 159px
        function enter_grow(el) {
            el.style.height = "10px";
            let size_el_textarea = el.scrollHeight;
            if (size_el_textarea >= 159) {
                el.style.height = "159px"
            } else {
                el.style.height = (el.scrollHeight) + "px"
            }
        }
    </script>

    <!-- profile -->
    <script>
        // open profile
        $('#profile').on('click', function(e) {
            e.preventDefault();
            $('.modal-page').toggleClass('show-modal-page')
            $('#open-sub-menu-sidebar').parent().find('.sub-menu-sidebar-content').toggleClass('show-sub-menu-sidebar-content');

            $.ajax({
                type: 'GET',
                url: "{{ route('profile') }}",
                success: function(res) {
                    console.log(res)
                    let photo = "photo-profile/default.png";
                    let des = "writing ur description"
                    if (res.photo_profile !== null) {
                        photo = res.path_photo_profile;
                    }
                    if (res.description !== null) {
                        des = res.description
                    }
                    $('#modal-content').find('#img-profile').attr('src', `{{ asset('${photo}') }}`)
                    $('#modal-content').find('.name-user').html(res.name)
                    $('#modal-content').find('.describe').html(des)
                }
            })
        })

        // go to edit user form
        $('#modal-user-profile .button-edit-profile').click(function() {
            $('#modal-content').find('.profile-user').toggleClass('hide-content-modal')
            $('#modal-content').find('#edit-user').toggleClass('show-content-modal')
            let img = $('#modal-content').find('#img-profile').attr('src');
            let name = $('#modal-content').find('.name-user').text();
            let desc = $('#modal-content').find('.describe').text();


            let nameEdit = $('#edit-user').find('#name').val(name);
            let descEdit = $('#edit-user').find('#dc').val(desc);
            $('#modal-content').find('#img-edit-user').attr('src', `${img}`)

        })

        // save edit user
        $('#edit-user').on('submit', function(e) {
            e.preventDefault();
            let formEditProfile = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ route('saveEditProfile') }}",
                data: formEditProfile,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == 'failed') {
                        alert(res.message)
                    } else {
                        alert(res.message)
                    }
                }
            })

        })

        $('.modal-close-button').click(function() {
            $('.modal-page').toggleClass('show-modal-page')
            $('#modal-content').find('.profile-user').removeClass('hide-content-modal')
            $('#modal-content').find('#edit-user').removeClass('show-content-modal')
        })
    </script>



    <!-- open chat room  -->
    <script>
        $('#list-friends-chat').on('click', '.group-list-friend', function() {
            addActiveClass($(this))

            let room = $(this).data('room')
            let roomChatting = $(this).data('room_chatting')

            $.ajax({
                type: 'POST',
                url: "{{ route('chatRoom') }}",
                data: {
                    room: room
                },
                success: function(res) {
                    console.log(res)
                    $('#main-content').addClass('show-app-content');
                    $('#sidebar-content').addClass('hide-app-content');
                    $('#main-content').html(res.html_chat_room)
                    // make see last content
                    buttomChat();

                    var pusher = new Pusher('17034a2e9c291053cb4e', {
                        cluster: 'ap1'
                    });

                    let channel = pusher.subscribe(`private.chat-${roomChatting}`);
                    channel.bind('chat-request', function(data) {
                        if ("{{ Auth::user()->id }}" == data.id) {
                            $('body').find('#content #content-chat').append(`
                                    <div class="chat right-chat">
                                        <div class="text-chat">
                                        ${data.text}
                                        </div>
                                        <div class="time-chat"> ${data.time}</div>
                                    </div>
                                    `);
                        } else {
                            $('body').find('#content #content-chat').append(`
                                    <div class="chat">
                                        <div class="text-chat">
                                        ${data.text}
                                        </div>
                                        <div class="time-chat"> ${data.time}</div>
                                    </div>
                                    `);
                        }
                        buttomChat();
                    });
                }
            })
        })


        let addActiveClass = function(element) {
            $('.group-list-friend').removeClass('active-click')
            element.addClass('active-click')
        }
    </script>

    <!-- send chatting in room -->
    <script>
        $('body').on('submit', '#form-chat', function(e) {
            e.preventDefault();
            let room = $(this).data('chat_room');
            let textChat = $(this).find('#text-chat').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('sendChatRoom') }}",
                data: {
                    room: room,
                    text: textChat
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('body').find('#form-chat #text-chat').val('');
                        $('body').find('#form-chat #text-chat').css('height', '39px');
                    }
                    if (res.status == 'roomNotFound') {
                        Swal.fire(
                            'Dont Cheating?',
                            res.message,
                            'error'
                        )
                    }
                },
                error: function(err) {
                    if (err.status === 422) {
                        let errors = $.parseJSON(err.responseText);
                        Swal.fire('Chat is still empty, please fill it in with words')
                    }
                }
            })
        })
    </script>

    <!-- search friends -->
    <script>
        $('#form-search').submit(function(e) {
            e.preventDefault();
            let name = $('#find-name').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('searchFriends') }}",
                data: {
                    name: name
                },
                success: function(res) {
                    // console.log(res) 
                    $('#main-content').html(res.html)
                    $('#main-content').addClass('show-app-content');
                    $('#sidebar-content').addClass('hide-app-content');
                }
            })
        })
    </script>

    <!-- add friends -->
    <script>
        $('body').on('click', '#content .add-friends', function(e) {
            e.preventDefault()
            let user = $(this).find('.user').val();
            let x = $(this)
            $.ajax({
                type: "POST",
                url: "{{ route('addFriends') }}",
                data: {
                    user: user
                },
                success: function(res) {
                    console.log(res)
                    if (res.status == 'success') {
                        x.html('')
                    }
                }
            })
        })
    </script>

    <!-- button back size mobile -->
    <script>
        $('body').on('click', '#header-main-content .button-back', function() {
            $('#main-content').removeClass('show-app-content');
            $('#sidebar-content').removeClass('hide-app-content');
            $('.group-list-friend').removeClass('active-click')
            $('#header-main-content').html(''); // remove content in header  content
            $('#content').html(''); // remove content
        })
    </script>


    <!-- make scroll chat always bottom -->
    <script>
        let buttomChat = function() {
            let content = $('body').find('#content-chat');
            content.scrollTop(content[0].scrollHeight)
        }
    </script>


    <!-- jquery windows size check -->
    <script>
        $(window).resize(function() {
            let widthSize = $(window).width();

            if (widthSize <= 1119) {
                // open btn-back header
                $('#header-main-content .button-back').addClass('show-button-back');
            } else {
                $('#header-main-content .button-back').removeClass('show-button-back');
            }
        })
    </script>


    @stack('js')
</body>

</html>