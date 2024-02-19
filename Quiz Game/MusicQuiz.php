<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Quiz</title>
    <link rel="stylesheet" href="css/MusicQuiz.css">
</head>

<body>
    <?php
      session_start();
      include 'function/Musicfunction.php'; //Existing MusicFunction file; can be reuse the function if needed. 

      if (isset($_POST['Submit'])) { //Check before submitting answer
        $questionAnswer = $_POST['answer']; //Intitlize the variable for input
        calculateMusicScores($questionAnswer); //Call the function to execute the calculation 
        header("Location: Finish.php"); //Redirect to Finish page after finishing the quiz
      } 
        
       $fileOpen = file("question/music.txt"); //reads the content of the file name and returns an array where each element corresponds to a line in the file.
       shuffle($fileOpen); //Shuffle the array of questions
       $arrayQuestions = array_slice($fileOpen, 0, 3); //It store inside the array and take the first 3 questions

       //open a txt file name leaderboard.txt for writing
       $myfile = fopen("leaderboard.txt", "a");
       $Name = $_SESSION['quiz_name'];
       fwrite($myfile, $Name);
       $space = ",";
       fwrite($myfile, $space);
       $overall = $_SESSION['overall'];
       fwrite($myfile, $overall);
       $space = "\n";
       fwrite($myfile, $space);
       fclose($myfile);
    ?>

    <form action="MusicQuiz.php" method="POST">
        <h1>Music Quiz</h1>
        <p>Please read the description!</p>
        <table>
            <tread>
                <tr>
                    <th>Question
                    <th> </th>
                    <th>Description</th>
                    <th>Enter  Artist or Band Name</th>
                </tr>
            </tread>

            <tbody>
                <?php
                    //Iterate the elements in array and printed as images and description 
                    foreach ($arrayQuestions as $i => $music) {
                        // Extracting question number, artist name, and description
                        $numberQuestions = $i + 1; //Explain this: 
                        list($artist, $description) = explode('|', $music); //Explain this: 

                        echo "<tr>";
                            echo "<td>$numberQuestions</td>"; // Display question number
                            echo "<td> <img src='question/image/$artist.jpg' width='100'></td>"; // Display image
                            echo "<td> <h4> $description </h4> </td>"; // Display description
                            echo "<td> <input type='text' name='answer[$artist]' placeholder='Your Answer'> </td>"; // Display text input for user's answer
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        
        <input type="submit" name="Submit" value="Finish Quiz">
    </form>
</body>
</html>
