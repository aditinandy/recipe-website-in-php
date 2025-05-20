<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Sharing Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        header {
            background: #50b3a2;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px 0;
        }
        nav a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            margin: 0 5px;
        }
        nav a:hover {
            background-color: #555;
        }
        .active {
            background-color: #444;
        }
        .error {
            color: red;
            background-color: #ffeeee;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            color: green;
            background-color: #eeffee;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Recipe Sharing Website</h1>
    </header>
    <nav>
        <?php 
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>
        <a href="index.php" <?php echo $current_page == 'index.php' ? 'class="active"' : ''; ?>>View Recipes</a>
        <a href="upload.php" <?php echo $current_page == 'upload.php' ? 'class="active"' : ''; ?>>Upload Recipe</a>
    </nav>
    <div class="container">
        <?php 
        // Display success/error messages if they exist in session
        session_start();
        if (isset($_SESSION['message'])) {
            $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
            echo '<div class="' . $message_type . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>