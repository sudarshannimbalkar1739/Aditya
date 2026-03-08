
// --- 1. DATA GENERATION ---
const genres = ["Action", "Sci-Fi", "Drama", "Comedy", "Horror", "Thriller", "Documentary"];
const movies = [];

// Generate 24 mock movies
for (let i = 1; i <= 24; i++) {
    const genre = genres[Math.floor(Math.random() * genres.length)];
    const match = Math.floor(Math.random() * (99 - 70) + 70); // 70% to 99% match

    movies.push({
        id: i,
        title: `Movie Title ${i}`,
        genre: genre,
        match: `${match}% Match`,
        year: 2020 + Math.floor(Math.random() * 4),
        image: `https://picsum.photos/seed/${genre}${i}/300/450`, // Uses genre in seed for consistency
        isHD: Math.random() > 0.3
    });
}

// --- 2. DOM ELEMENTS ---
const grid = document.getElementById('movieGrid');
const gridTitle = document.getElementById('gridTitle');
const navbar = document.getElementById('navbar');
const loginModal = document.getElementById('loginModal');
const toast = document.getElementById('toast');

// --- 3. RENDER FUNCTIONS ---

function renderMovies(movieList, title) {
    grid.innerHTML = ''; // Clear current grid
    gridTitle.innerText = title;

    if (movieList.length === 0) {
        grid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 40px; color: #777;">No movies found in this category.</p>';
        return;
    }

    movieList.forEach(movie => {
        const card = document.createElement('div');
        card.className = 'movie-card';
        card.onclick = () => showToast(`Now Playing: ${movie.title}`);

        card.innerHTML = `
                    <img src="${movie.image}" alt="${movie.title}" loading="lazy">
                    <div class="card-overlay">
                        <h3>${movie.title}</h3>
                        <div class="meta-info">
                            <span class="match-score">${movie.match}</span>
                            <span>${movie.year}</span>
                            <span class="hd-badge">${movie.isHD ? 'HD' : 'SD'}</span>
                        </div>
                        <div style="font-size: 0.8rem; color: #aaa; margin-top: 5px;">${movie.genre}</div>
                    </div>
                `;
        grid.appendChild(card);
    });
}

// --- 4. FILTER LOGIC (THE MODERN BUTTONS) ---

function filterMovies(category, btnElement) {
    // Update Active Button Styling
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    btnElement.classList.add('active');

    // Filter Data
    if (category === 'All') {
        renderMovies(movies, 'All Movies');
    } else {
        const filtered = movies.filter(m => m.genre === category);
        renderMovies(filtered, `${category} Movies`);
    }
}

// --- 5. GENERAL INTERACTION ---

// Scroll effect for navbar
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Login Modal
function toggleLogin() {
    const isVisible = loginModal.style.display === 'flex';
    loginModal.style.display = isVisible ? 'none' : 'flex';
}

function handleLogin(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    const originalText = btn.innerText;

    btn.innerText = "Signing In...";
    btn.style.opacity = "0.7";

    setTimeout(() => {
        toggleLogin();
        showToast("Welcome back, User!");
        btn.innerText = originalText;
        btn.style.opacity = "1";

        // Hide login button and show avatar
        document.querySelector('.login-btn').style.display = 'none';
        const avatar = document.createElement('div');
        avatar.innerHTML = '<i class="fas fa-user"></i>';
        avatar.style.color = 'white';
        avatar.style.fontSize = '1.2rem';
        avatar.style.cursor = 'pointer';
        document.querySelector('.right-nav').appendChild(avatar);

    }, 1500);
}

// Toast Notification
function showToast(message) {
    toast.innerText = message;
    toast.style.display = 'block';
    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

// Initialize with 'All' movies
renderMovies(movies, 'Trending Now');
