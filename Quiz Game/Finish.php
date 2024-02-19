<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finish Quiz</title>
    <link rel="stylesheet" href="css/Finish.css">
</head>
<body>
    <?php 
        //Using super global allow to retrieve information from the current files 
        session_start(); 
        
        //$_SESSION: store and retrieve session-specific information that persists across multiple requests.
        //$_POST: retrieve form data sent with the HTTP POST method.
        //$_GET: retrieve data from the URL query string.
        //$_COOKIE: retrieve values from cookies.
        //$_FILES: retrieve file upload information.
    ?>
    
	<form action="Finish.php" method="POST">
        <div class="quiz-score">
            <h1>Quiz Finished</h1>
          
		    <h3>Correct Answers: <?php echo $_SESSION['true'] ?></h3> <!-- Retreive correct answer information from the calculateMusicScores($questionAnswer) function-->
            <h3>Incorrect Answers: <?php echo $_SESSION['false'] ?></h3> <!-- Retreive false answer information from the calculateMusicScores($questionAnswer) function-->
            <h3>Current Points: <?php echo $_SESSION['current'] ?></h3> <!-- Retreive current points values from the calculateMusicScores($questionAnswer) function-->
            <h3>Overall Points: <?php echo $_SESSION['overall'] ?></h3> <!-- Retreive overall points values from the calculateMusicScores($questionAnswer) function-->

            <h2>Start Another Quiz</h2> 
            <a href="MusicQuiz.php">Music</a>
            <a href="CountryQuiz.php">Country</a>
	    </div>

        <div class="quiz-score">
            <h3>Leaderboard or Exit</h3>
            <a href="Leaderboard.php">Leaderboard</a>
            <a href="Exit.php">Exit</a>
        </div>
    </form>
        
</body>
</html>