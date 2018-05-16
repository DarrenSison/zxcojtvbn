<?php
    $user= $_SESSION['userAccount'];
    $usr = $_SESSION['email'];
    $user_id = $user->getAccountId();
    $query = $pdo->prepare("SELECT company_id, company_name, contact_name, phone, landline FROM company WHERE archive='1'");
    $query->execute();
    $result = $query->fetchAll();

    echo "<tr>";
    echo "<th>Company Name </th>";
    echo "<th>Contact Name </th>";
    echo "<th>Phone Number</th>";
    echo "<th>Landline</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    foreach($result as $query){
        $rid = $query['company_id'];
        echo "<tr>";
        echo "<td>" . $query['company_name'] . "</td>";
        echo "<td>" . $query['contact_name'] . "</td>";
        echo "<td>" . $query['phone'] . "</td>";
        echo "<td>" . $query['landline'] . "</td>";
        echo "</td>";
		echo "<td>";
		echo '<a href="edit-company.php?id='.$query['company_id'].'"><button class="btn">Edit Company</button></a>';
        echo "</td>";
		echo "<td>";
		echo '<a href="fragments/delete-company.php?id='.$query['company_id'].'"><button class="btn btn-danger">Delete</button></a>';
		echo "</td>";
        echo "</tr>";
        
    }
?>