<?php
    $user= $_SESSION['userAccount'];
    $usr = $_SESSION['email'];
    $user_id = $user->getAccountId();
    $id = $_GET['id'];

    $query = $pdo->prepare("SELECT user.user_id AS 'user_id', user.email AS 'email', user.firstname AS 'first', user.lastname AS 'last' FROM attend INNER JOIN user ON attend.user_id=user.user_id WHERE attend.schedule_id=$id ");
    $query->execute();
    $result = $query->fetchAll();

    echo "<tr>";
    echo "<th>Last Name</th>";
    echo "<th>First Name</th>";
    echo "<th>Email</th>";

    echo "</tr>";

    foreach($result as $query){
        $rid = $query['user_id'];
        echo "<tr>";
        echo "<td>" . $query['last'] . "</td>";
        echo "<td>" . $query['first'] . "</td>";
        echo "<td>" . $query['email'] . "</td>";
        echo "</td>";
        echo "</tr>";
        
    }
?>