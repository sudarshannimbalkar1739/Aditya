<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamMirror - Modern Movie App</title>
    <!-- Importing Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <!-- HEADER -->
    <header id="navbar">
        <div class="logo">MoviesHub</div>
        <div class="navbar">
            <ul class="nav-links">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">TV Shows</a></li>
                <li><a href="#">Movies</a></li>
                <li><a href="#">My List</a></li>
            </ul>
        </div>
        <div class="right-nav">
            <?php if (isset($_SESSION['username'])): ?>
                <div class="avatar">
                    <?php $n = strtoupper($_SESSION['username'][0]);
                    echo $n;
                    echo "<script>showUserAvatar($n);</script>"; ?>
                </div>
                <a class="logoutbtn" href="logout.php">Logout</a>
            <?php else: ?>
                <button id="loginBtn" onclick="showLogin()">Login</button>
            <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- hero section -->

    <div id="overlay" class="overlay hidden">
        <div class="auth-container">
            <span class="close-btn" onclick="closeAuth()">×</span>
            <form action="login.php" method="post">
                <!-- LOGIN -->
                <div id="loginBox">
                    <h2>Login</h2>
                    <input type="email" name="email" placeholder="Enter Email" required>
                    <input type="password" name="password" placeholder="Enter password" required>
                    <button type="submit" name="login">Login</button>
                    <p>Don't have an account?
                        <span class="link" onclick="showRegister()">Register</span>
                    </p>
                    <p>Admin Login.
                        <span class="link" onclick="showadmin()">Admin</span>
                    </p>
                </div>
            </form>

            <!-- admin -->
            <form action="auth.php" method="post">
                <div id="adminBox" class="hidden">
                    <h2>Admin</h2>
                    <input type="email" name="ademail" placeholder="Enter Email" required>
                    <input type="password" name="adpassword" placeholder="Enter password" required>
                    <button type="submit" name="adlogin">authenticate</button>
                    <p>show Login:
                        <span class="link" onclick="showLogin()">Login</span>
                    </p>
                </div>
            </form>
            <!-- REGISTER -->
            <form action="register.php" method="post">
                <div id="registerBox" class="hidden">
                    <h2>Register</h2>
                    <input type="text" name="username" placeholder="Enter name" id="name" required>
                    <input type="tel" name="phone" id="phone" placeholder="Enter Mobile no." pattern="[0-9]{10}"
                        required>
                    <input type="text" name="address" id="address" placeholder="State, District, Village - Pincode"
                        required />
                    <input type="email" name="email" id="email" placeholder="Enter email" required />
                    <input type="password" name="registerPassword" id="registerPassword" placeholder="Password"
                        required />
                    <input type="password" name="reenterregisterPassword" id="reenterregisterPassword"
                        placeholder="Re enter Password" required />
                    <button name="register">Register</button>
                    <p>Already have an account?
                        <span class="link" onclick="showLogin()">Login</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
    </header>

    <!-- HERO SECTION -->
    <div class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Cyber City 2077</h1>
            <p class="hero-desc">In a dystopian future, a mercenary outlaw seeks a one-of-a-kind implant that is the key to immortality. The lines between humanity and technology blur in this high-octane thriller.</p>
            <button class="hero-btn btn-play" onclick="showToast('Playing Cyber City 2077...')">
                <i class="fas fa-play"></i> Play
            </button>
            <button class="hero-btn btn-info" onclick="showToast('Added to your list!')">
                <i class="fas fa-plus"></i> My List
            </button>
        </div>
    </div>

    <!-- CATEGORY BUTTONS SECTION (NEW) -->
    <div class="category-section">
        <div class="category-scroll">
            <!-- Active class is set via JS -->
            <button class="filter-btn active" onclick="filterMovies('All', this)">All Movies</button>
            <button class="filter-btn" onclick="filterMovies('Action', this)">Action</button>
            <button class="filter-btn" onclick="filterMovies('Sci-Fi', this)">Sci-Fi</button>
            <button class="filter-btn" onclick="filterMovies('Drama', this)">Drama</button>
            <button class="filter-btn" onclick="filterMovies('Comedy', this)">Comedy</button>
            <button class="filter-btn" onclick="filterMovies('Horror', this)">Horror</button>
            <button class="filter-btn" onclick="filterMovies('Thriller', this)">Thriller</button>
            <button class="filter-btn" onclick="filterMovies('Documentary', this)">Documentary</button>
        </div>
    </div>

    <!-- MAIN CONTENT GRID -->
    <main class="content-area">
        <div class="section-header">
            <h2 class="section-title" id="gridTitle">Trending Now</h2>
            <span style="font-size: 0.9rem; color: #777; cursor: pointer;">See All <i class="fas fa-chevron-right"></i></span>
        </div>

        <div class="movie-grid" id="movieGrid">
            <!-- Movies injected by JS -->
        </div>
    </main>

    <!-- LOGIN MODAL -->
    <div class="modal-overlay" id="loginModal">
        <button class="close-modal" onclick="toggleLogin()">&times;</button>
        <div class="login-box">
            <h1 style="margin-bottom: 30px;">Sign In</h1>
            <form onsubmit="handleLogin(event)">
                <input type="email" class="login-input" placeholder="Email" required>
                <input type="password" class="login-input" placeholder="Password" required>
                <button type="submit" class="login-submit">Sign In</button>
            </form>
            <p style="margin-top: 15px; color: #b3b3b3; font-size: 0.8rem;">
                New to StreamMirror? <span style="color: white; cursor: pointer;">Sign up now</span>.
            </p>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div class="toast" id="toast">Action Completed</div>

    <script></script>
</body>

</html>