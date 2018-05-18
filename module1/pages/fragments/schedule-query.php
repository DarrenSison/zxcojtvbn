<?php
    $user= $_SESSION['userAccount'];
    $usr = $_SESSION['email'];
    $user_id = $user->getAccountId();
 //   $query = $pdo->prepare("SELECT company.company_name AS "company", schedule.date AS "date", schedule.start_time AS "start", schedule.end_time AS "end", schedule.room AS "room" FROM company INNER JOIN schedule ON company.company_id=schedule.company_id");
    $query = $pdo->prepare("SELECT schedule.schedule_id, company.company_id, company.company_name AS 'company', schedule.date AS 'date', schedule.start_time AS 'start', schedule.end_time AS 'end', schedule.room AS 'room' FROM company INNER JOIN schedule ON company.company_id=schedule.company_id WHERE schedule.archive='1' ORDER BY date, start_time");
    $query->execute();
    $result = $query->fetchAll();

    echo "<tr>";
    echo "<th>Company</th>";
    echo "<th>Date</th>";
    echo "<th>Start Time</th>";
    echo "<th>End Time</th>";
    echo "<th>Room</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    foreach($result as $query){
        $rid = $query['schedule_id'];
        $rid = $query['company_id'];
        echo "<tr>";
        echo "<td>" . $query['company'] . "</td>";
        echo "<td>" . $query['date'] . "</td>";
        echo "<td>" . $query['start'] . "</td>";
        echo "<td>" . $query['end'] . "</td>";
        echo "<td>" . $query['room'] . "</td>";
        echo "</td>";
        echo "<td>";
        echo '<a href="sched-list.php?id='.$query['schedule_id'].'"><button class="btn btn-primary">View List</button></a> ';
//        echo "</td>";
//		echo "<td>";
		echo '<a href="fragments/delete-schedule.php?id='.$query['schedule_id'].'"><button class="btn btn-danger">Delete</button></a>';
		echo "</td>";
        echo "</tr>";
        
    }
?>