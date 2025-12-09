<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="d-flex ms-auto align-items-center">
            @auth
                <span class="me-3"> {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Выйти</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
