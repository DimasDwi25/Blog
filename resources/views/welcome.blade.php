{{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
    {{-- navbar --}}
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">BLOG</a>
            <ul class="nav justify-content-end">
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>
            @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">Register</a>
                        </li>        
                    @endif
                @endauth
            @endif
            </ul>
        </div>
    </nav>

        {{-- content --}}
    <div class="container" style="margin-top: 20px">
        <h2>Selamat datang Blog Sederhana</h2>
        <span>Investree Fullstack Developer Virtual Internship Program !</span>

        @foreach ($article as $articles)
            <div class="card" style="margin-top: 20px; margin-bottom:10px">
                <h5 class="card-header">Blog</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $articles->title }}</h5>
                    <p class="card-text">{{ $articles->content }}</p>
                    <p>Post By {{ $articles->user->name }}</p>
                    <a href="{{ route('welcome.article', $articles->id) }}" class="btn btn-primary">Lihat detail</a>
                </div>
            </div>
        @endforeach
            
        @empty($articles)
            <div class="card" style="margin-top: 20px; margin-bottom:10px">
                <h5 class="card-header">Blog</h5>
                <div class="card-body">
                    <h5 class="card-title">Data tidak ada</h5>
                </div>
            </div>    
        @endempty
            

        {{ $article->links() }}
    </div>
    

</body>
</html>