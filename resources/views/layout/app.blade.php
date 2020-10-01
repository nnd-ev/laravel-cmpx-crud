<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>{{config('app.name', 'blog')}}</title>
{{-- <link rel="stylesheet" href="/css/main.css"> --}}
 </head>
<body>
    @include('inc.navbar')

    <div class="container mt-3">
    @include('inc/messages')

    @yield('content')
    </div>


    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

     <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
