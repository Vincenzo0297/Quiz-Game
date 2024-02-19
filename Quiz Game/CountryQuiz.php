<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Country Quiz</title>
		<link rel="stylesheet" href="css/CountryQuiz.css">
	</head>

<body>
	<?php
		session_start();

		$random_qns = array();

		// When user submits answers
		if (isset($_POST['submit_answers'])) {
			$Answers = $_POST['ans'];
			$qd = $_SESSION['question_data'];

		if (is_array($Answers)) {
		//Variable stores the user's response
			$correctQn = 0;
			$incorrectQn = 0;
		}
		
		foreach ($Answers as $questionIndex => $response) {
			$correctAnswer = $qd[$questionIndex][0];

		// If the user response is the same as the correct answer
		if ($response == $correctAnswer) {
			$correctQn++;
		} else {
			$incorrectQn++;
			}
		}

		// Store total number of true & false answers
		$_SESSION['true'] = $correctQn;
		$_SESSION['false'] = $incorrectQn;
		
		// Calculate the scores of the session and accumulate for the overall session
		$TotalScore = (($correctQn * 4) - ($incorrectQn * 2));
		$_SESSION['current'] = $TotalScore;
		$_SESSION['overall'] += $TotalScore;

		
		// Find user's entry in the leaderboard and update it
		$leaderboardFile = "leaderboard.txt";
		$userFound = false;
		$leaderboardData = file($leaderboardFile);

		foreach ($leaderboardData as &$line) {
			$userData = explode(",", $line);
			$name = trim($userData[0]);

		if ($name === $_SESSION['quiz_name']) {
		// Update the user's entry with the latest overall score
			$line = $_SESSION['quiz_name'] . "," . $_SESSION['overall'] . "\n";
			$userFound = true;
			break;
		}
	}

		// If user's entry not found, append a new line
		if (!$userFound) {
			$leaderboardData[] = $_SESSION['quiz_name'] . "," . $_SESSION['overall'] . "\n";
		}

		// Write the updated leaderboard data back to the file
		file_put_contents($leaderboardFile, implode("", $leaderboardData));


		//When user clicks on the finish quiz button, redirected to the finish.php 
		header("Location: Finish.php");
		exit();
		
} else {

	//Read the questions stored in the country.txt 
	$lines = file("question/country.txt");

	//Remove empty arrays created from the split
	$trimLines = array_map('trim', $lines);
	$LArray = array_filter($trimLines);
	$LArray = array_values($LArray);
	
	//An array to store the questions
	$questionData = array();

	foreach ($LArray as $record) {
		$split = explode("|", $record);
		$currentQuestion = $split[1];
		$correctAnswer = $split[0];
		$questionData[] = array($correctAnswer, $currentQuestion);
	}

	//Store question data in session
	$_SESSION['question_data'] = $questionData;

	//Randomly generate 3 questions per quiz
	$random_qns = array_rand($questionData, 3);
	}

	$myfile = fopen("leaderboard.txt", "a");
	$Name = $_SESSION['quiz_name'];
	fwrite($myfile, $Name);
	$txt = ",";
	fwrite($myfile, $txt);
	$overall = $_SESSION['overall'];
	fwrite($myfile, $overall);
	$txt = "\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	?>

<form action="CountryQuiz.php" method="POST">
	<table>
		<tr><h1>Country Quiz</h1></tr>
		<tr><div class="instructions"> Choose True or False for each of the questions </div></tr>
			<?php
				foreach ($random_qns as $rq) {
					// Print the question
					echo '<tr><td><div class="question">' . $questionData[$rq][1] . '</div></td></tr>';
					echo "<tr><td><input type='radio' name='ans[$rq]' value='True' required /> True</td></tr>";
					echo "<tr><td><input type='radio' name='ans[$rq]' value='False' /> False</td></tr>";
				}
				?>
	</table>
		<input type="submit" name="submit_answers" value="Finish Quiz">
</form>
</body>
</html>
