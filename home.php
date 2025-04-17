<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportStream - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">SportStream</div>
        <nav class="nav-links">
             <a href="#"><i class="fas fa-search"></i> Search</a>
             <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="login.php">Sign In</a>
        </nav>
    </header>

    <section class="hero">
        <h1>Welcome to SportStream</h1>
        <p>Watch live sports anytime, anywhere.</p>
        <img src="images/hero.png" alt="Live Sports" class="hero-img">
    </section>

    <section class="featured">
        <h2>Now Streaming</h2>
        <div class="stream-card">
            <img src="images/mthumbnail1" alt="Match Thumbnail">
            <h3>Team A vs Team B</h3>
            <a href="stream.php?id=1" class="btn">Watch Now</a>
        </div>
        <div class="stream-card">
            <img src="images/thumbnail2.jpeg" alt="Match Thumbnail">
            <h3>Team C vs Team D</h3>
            <a href="stream.php?id=2" class="btn">Watch Now</a>
        </div>
    </section>

    <footer>
    <p>&copy; 2025 SportStream</p>
    <div class="social-icons">
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

</body>
</html>