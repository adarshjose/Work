<nav id="sidebar">
    <div class="sidebar-header">
        <h1 class="head-style">
            <a href="index.html">Product Name</a>
        </h1>
        <span>P N</span>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="movie_list.php">
                <i class="fas fa-th-large"></i>
                View Movies
            </a>
        </li>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-th-large"></i>
                Manage Movie
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="add_movies.php">Add Movie</a>
                </li>
                <li>
                    <a href="select_movies.php">Edit Movie</a>
                </li>
                <li>
                    <a href="delete_movies.php">Delete</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>