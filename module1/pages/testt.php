<?php
/**
* schedule-add.php
*
* Add new a new schedule
* 
* @author Darren Sison
*/
require '../classes/UserAccount.php';
    include("connect.php");
	include("fragments/connection.php");
session_start();
                        //notify users that is registered in the schedule
                        $subject = 'Nokia';
                        $comment = 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.';
                        $query4 = $pdo->prepare("SELECT user_id FROM attend WHERE schedule_id='4' ");
                        $query4->execute();
                        $result4 = $query4->fetchAll();
                        foreach($result4 as $query4){
                        $user_id = $query4['user_id'];
						echo $user_id;
                        $query5 = "INSERT INTO comments(comment_subject, comment_text, user_id) VALUES ('$subject', '$comment', '2')";
                         mysqli_query($con, $query5);
                        }
?>