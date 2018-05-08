<?php
    $user= $_SESSION['userAccount'];
    $usr = $_SESSION['email'];
    $user_id = $user->getAccountId();
    $query = $pdo->prepare("SELECT user_id, firstname, lastname, email FROM user");
    $query->execute();
    $result = $query->fetchAll();

    echo "<tr>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email Address</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    foreach($result as $query){
        $rid = $query['user_id'];
        echo "<tr>";
        echo "<td>" . $query['firstname'] . "</td>";
        echo "<td>" . $query['lastname'] . "</td>";
        echo "<td>" . $query['email'] . "</td>";
        echo "</td>";
		echo "<td>";
		echo '<a href="fragments/reset-password.php?id='.$query['user_id'].'"><button class="btn btn-danger">Reset Password</button></a>';
		echo "</td>";
        echo "</tr>";
        
    }
?>