<!doctype html>
<html lang="en">
<head>
    @include('admin.layouts.partials.head')
</head>

<body>
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        {{-- NAVBAR --}}
        @include('admin.layouts.partials.navbar')

        {{-- SIDEBAR --}}
        @include('admin.layouts.partials.sidebar')

        {{-- MAIN CONTENT --}}
        <main class="app-main">
            @yield('content')
        </main>

    </div>
    <!--end::App Wrapper-->

    {{-- SCRIPT --}}
    @include('admin.layouts.partials.script')
</body>
</html>
