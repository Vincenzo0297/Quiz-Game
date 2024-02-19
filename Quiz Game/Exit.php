<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="css/Exit.css">
</head>
<body>
    <?php
        session_start();
        //$_SESSION: store and retrieve session-specific information that persists across multiple requests.
    ?>

    <div class="result-container">
        <h1>Quiz Result</h1>
        <p>
            <h3>Name: <?php echo $_SESSION['quiz_name'] ?> </h3>  <!-- Retrieve the names when it was Inititialize at home page -->
            <h3>Overall Points: <?php echo $_SESSION['overall']; ?> </h3> <!-- Retreive overall points values from the calculateMusicScores($questionAnswer) function-->
        </p>
        <a href="Home.php">Home</a>
    </div>    
</body>
</html>
