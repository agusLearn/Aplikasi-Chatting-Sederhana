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

        @include('layouts.sidebarContent')
        <div id="main-content">
            <div id="header-main-content">
                @yield('header-content')
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
            if (size_el_textarea >= 159) {
                el.style.height = "159px"
            } else {
                el.style.height = (el.scrollHeight) + "px"
            }

            // $('#content-chat').
        }
    </script>
</body>

</html>