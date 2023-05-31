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


    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- script csrf -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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


    <!-- open chat room  -->
    <script>
        $('#list-friends-chat').on('click', '.group-list-friend', function() {
            addActiveClass($(this))

            $.ajax({
                type: 'GET',
                url: "{{ route('chatRoom') }}",
                success: function(res) {
                    $('#main-content').addClass('show-app-content');
                    $('#sidebar-content').addClass('hide-app-content');
                    $('#main-content').html(res.html_chat_room)
                }
            })
        })


        let addActiveClass = function(element) {
            $('.group-list-friend').removeClass('active-click')
            element.addClass('active-click')
        }
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
                data: {user:user},
                success: function(res){
                    console.log(res)
                    if(res.status == 'success'){
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