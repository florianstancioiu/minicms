<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('admin/partials/styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            @include('admin/partials/navbar')

            @include('admin/partials/sidebar')

            <div class="content-wrapper">
                @include('admin/partials/sidebar')

                <section class="content">
                    @yield('content')
                </section>
            </div>

            @include('admin/partials/footer')

            @include('admin/partials/control-sidebar')

        </div>
        <!-- ./wrapper -->

        @include('admin/partials/scripts')
    </body>
</html>