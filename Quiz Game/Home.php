<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/Home.css">
</head>
<body>
    <?php
        session_start(); //starts a new session or continues an existing one
        $validation = " "; //Initialize the Name error variable

        if(isset($_POST['submit'])) { //Determine if the submit variable has been set/Checks the quiz name and game type after it click submit
           $quiz_Name = trim($_POST['quiz_name']); //Inititialize the quiz name, removes any leading/trailing white space from a string
            
            if(empty($quiz_Name)) {
                $validation = "Name must be entered!"; //If name is empty, display error message
            } else {
                $_SESSION['quiz_name'] = $quiz_Name; //Initialize and store Quiz name
                $_SESSION['overall'] = 0;
                
                //Check selected game type and redirect to selected game
                $selectquiz = $_POST['quiz_type']; 
                //locate either animal or cartoon
                if($selectquiz == 'music'){ 
                    header("location: MusicQuiz.php");
                } else{
                    header("location: CountryQuiz.php");
                }
                exit(); //Prevent further processing
            }
        }
    ?>

    <form action="Home.php" method="POST">
        <table>
            <tr>
                <td>
                    <label for="name" style="font-size: 16px; color: #333;">Please Enter Your Name</label>
                    <br>
                    <input type="text" name="quiz_name" id="quiz_name" placeholder="Joe Biden" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <br>
                    <span style="color: red;"> <?php echo $validation; ?> </span> <!-- Display error message if name is empty -->
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Select Topic:</h3>
                    <label for="music">Music</label>
                    <input type="radio" name="quiz_type" id="music" value="music" checked>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="country">Country</label>
                    <input type="radio" name="quiz_type" id="country" value="country">
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Start Quiz">
    </form>
</body>
</html>
