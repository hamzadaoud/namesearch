<?php
// Database credentials
$host = 'host';
$port = '3306';
$dbname = 'dbname';
$username = 'username';
$password = 'password';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}

// Check if a search query is submitted
if (isset($_GET['name'])) {
    // Sanitize the input
    $name = htmlspecialchars($_GET['name']);
    
    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT * FROM names WHERE name LIKE :name");
    $stmt->execute(['name' => "%$name%"]);
    
    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Meaning Search</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        padding-top: 50px;
        font-family: Arial, sans-serif;
        background-size: cover;
        background-position: center;
        transition: background-image 1s ease-in-out;
        background-repeat: no-repeat; /* Prevent background image from repeating */
        height: 100vh; /* Set height to fill the entire viewport height */
        width: 100vw; /* Set width to fill the entire viewport width */
    }
    .container {
        max-width: 600px;
    }
    .input-group {
        border: 2px solid #0078D7;
        border-radius: 5px;
        overflow: hidden;
    }
    .input-group-append button {
        background-color: #0078D7;
        border: none;
        color: white;
        padding: 8px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .text-muted {
        color: #e1e1e1 !important;
    }
    .input-group-append button:hover {
        background-color: #0056B3;
    }
    .list-group-item {
    border: none;
    background-color: transparent;
    padding: 0;
    margin-bottom: 20px;
}

.result-container {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    display: flex;
    flex-direction: column;
}

.name {
    font-weight: bold;
    color: #0078D7;
}

.meaning {
    margin-top: 5px;
    color: #333;
}

    .list-group-item:last-child {
        margin-bottom: 0;
    }
    .list-group-item strong {
        color: #0078D7;
        font-weight: bold;
    }
    input[type="text"] {
        border: none;
        outline: none;
        padding: 10px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        transition: background-color 0.3s;
    }
    input[type="text"]::placeholder {
        color: #333;
    }
    input[type="text"]:focus {
        background-color: rgba(255, 255, 255, 0.7);
    }
</style>

</head>
<body>
    <div class="container">
        <h1 class="text-center text-white mb-5">Name Meaning Search</h1>
        
        <!-- Search form -->
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter a name" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
        
        <!-- Display search results -->
       <!-- Display search results -->
<?php if (isset($results) && count($results) > 0): ?>
    <div class="search-results">
        <h2 class="text-white">Search Results</h2>
        <ul class="list-group">
            <?php foreach ($results as $result): ?>
                <li class="list-group-item">
                    <div class="result-container">
                        <div class="name"><?php echo $result['name']; ?>:</div>
                        <div class="meaning"><?php echo $result['meaning']; ?></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif (isset($results) && count($results) === 0): ?>
    <div class="search-results">
        <h2 class="text-white">No Results Found</h2>
        <p class="text-muted">The name you searched for was not found.</p>
    </div>
<?php endif; ?>

    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Background image script -->
    <script>
        const backgrounds = [
            'img/img1.jpg?text=Background+Image+1',
            'img/img2.jpg?text=Background+Image+2',
            'img/img3.avif?text=Background+Image+3',
            'img/img4.avif?text=Background+Image+4'
        ];

        function changeBackground() {
            const now = new Date();
            const midnight = new Date(now);
            midnight.setHours(24, 0, 0, 0); // Set to next midnight
            const timeRemaining = midnight - now;
            document.body.style.backgroundImage = `url(${backgrounds[Math.floor(Math.random() * backgrounds.length)]})`;
            setTimeout(changeBackground, timeRemaining);
        }
        
        // Initial call to start the background change
        changeBackground();
    </script>
    <script>
    // Remove query string from URL after page loads
    window.onload = function() {
        history.replaceState({}, document.title, window.location.pathname);
    };
</script>

</body>
</html>
