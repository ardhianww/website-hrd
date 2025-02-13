<nav class="navbar navbar-expand-lg {{ request()->cookie('theme') === 'dark' ? 'navbar-dark bg-dark' : 'navbar-light bg-light' }}">
    <div class="container">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <!-- Tambahkan menu lain sesuai kebutuhan -->
            </ul>
            <div class="d-flex align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="darkModeToggle" {{ request()->cookie('theme') === 'dark' ? 'checked' : '' }}>
                    <label class="form-check-label" for="darkModeToggle">Dark Mode</label>
                </div>
            </div>
        </div>
    </div>
</nav> 