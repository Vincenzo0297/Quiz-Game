<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="css/Leaderboard.css">
</head>
<body>
    <?php
        $fileOpen = file("leaderboard.txt"); // Read date from the leaderboard text file
        $leaderboard = array(); // Base array to work with
        
        //explain the foreach: 
        foreach ($fileOpen as $row) {
            $data = explode(",", $row);
        
            // Check if $data has at least two elements
            if (count($data) >= 2) {
                list($name, $TotalScore) = array_map('trim', $data);
                $leaderboard[$name] = (int)$TotalScore;
            }
        }
        
        // Sort the leaderboard based on form submissions
        if (isset($_POST['sortName'])) {
            ksort($leaderboard); // Sort by names (smallest to largest )
        } 
        if (isset($_POST['sortValue'])) {
            arsort($leaderboard); // Sort by points (largest to smallest)
        }
    ?>
    
    <form action="Leaderboard.php" method="POST">
        <div class="leaderboard">
            <table>
                <h1>Leaderboard</h1>
                <tr>
                    <td> <h3>Names</h3> </td>
                    <td> <h3>Overall Points</h3> </td>
                </tr>

                <?php
                    // Display sorted names and scores
                    foreach ($leaderboard as $player => $TotalScore) {
                        echo "<tr>
                                <td>$player</td>
                                <td>$TotalScore</td>
                            </tr>";
                    }
                ?>
            </table>

            <div class="actions">
                <input type="submit" name="sortName" value="Sort Names">
                <input type="submit" name="sortValue" value="Sort Points">
                <a href="Finish.php">Back</a>
                <a href="Exit.php">Exit</a>
            </div>
        </div>
    </form>
</body>
</html>
