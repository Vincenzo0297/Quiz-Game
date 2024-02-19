<?php
    function calculateMusicScores($questionAnswer){
        $true = $false = 0; //initilize true and false answer

        //Explain the foreach
        foreach ($questionAnswer as $question => $response){	
            $Ans = trim($question);
            $Clean = $response;
                
            if($Ans == $Clean){
                $true++;
            } else{
                $false++;
            }		
        }

        //Calculate the Total score 
        $TotalScore = (($true * 4) - ($false * 2));
        //Update results of the current and overall scores
        $_SESSION['current'] = $TotalScore;
        $_SESSION['overall'] += $TotalScore;
        //total number of true & false answer
        $_SESSION['true'] = $true;
        $_SESSION['false'] = $false;
    }
?>