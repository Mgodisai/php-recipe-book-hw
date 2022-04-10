<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark rounded-top rounded-2">
       <div class="container-fluid w-75">
            <a class="navbar-brand" href="#">Kedvenc receptjeim</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active"><a class="nav-link incl-content" aria-current="page" href="?f=welcome">Home</a></li>
                    <li class="nav-item"><a class="nav-link incl-content" href="?f=list">Receptek</a></li>
                    <li class="nav-item"><a class="nav-link incl-content" href="?f=contact" tabindex="-1" aria-disabled="true">Kapcsolat</a></li>
                    <li class="nav-item"><a class="nav-link incl-content" href="/admin" tabindex="-1" aria-disabled="true">Adminisztráció</a></li>
                </ul>
                <form class="d-flex" method="get" action="index.php?f=list">
                    <input class="form-control me-2" type="search" name="q" placeholder="Kereső...">
                    <input type="hidden" name="f" value="list" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
       </div>
    </nav>
</header>
