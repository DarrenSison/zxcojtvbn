<?php 
//session_start();

    $company_query = "SELECT company_id, company_name FROM company WHERE company_id IN (SELECT company_id FROM schedule) ORDER BY company_name";
    $company = mysqli_query($con, $company_query) or die(mysqli_error($con));
    $company_result = mysqli_fetch_all($company);
/*
    $schedule_query = "SELECT company_id, date, start_time, end_time, room JOIN schedule ON company.company_id = schedule.company_id ";
    $schedule = mysqli_query($con, $schedule_query) or die(mysqli_error($con));
    $schedule_result = mysqli_fetch_all($schedule);
	*/