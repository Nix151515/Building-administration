<?php
  require_once("dbconnect.php");
  error_reporting(E_ERROR | E_PARSE);
  session_start();
  include 'languages/lang_'.$_SESSION['lang'].'.php';


  $FirstDay = date("Y-m-d", strtotime(date('l').' last week'));  
  $LastDay = date("Y-m-d", strtotime(date('l').' this week'));  

  // echo $FirstDay."<br>";
  // echo $LastDay."<br>";

  $monday = 0;
  $tuesday = 0;
  $wednesday = 0;
  $thursday = 0;
  $friday = 0;
  $saturday = 0;
  $sunday = 0;

  $query = "SELECT * FROM $table";
  $result = mysqli_query($connect,$query);

  while($out = mysqli_fetch_assoc($result))
  {
    $secs = strtotime($out['login']);
    $date = date('Y-m-d', $secs);
    $day = date('l', $secs);

    
    if($date > $FirstDay && $date <= $LastDay)
    {
      // echo "Date ".$date." ".$day."  =>  ";
      // echo "Yes "."  =>  ";
      if($day === 'Monday')
        $monday++;
      if($day === 'Tuesday')
        $tuesday++;
      if($day === 'Wednesday')
        $wednesday++;
      if($day === 'Thursday')
        $thursday++;
      if($day === 'Friday')
        $friday++;
      if($day === 'Saturday')
        $saturday++;
      if($day === 'Sunday')
        $sunday++;
    } else {
      // echo "No "."<br>";
    }
  }

  $week->monday = $monday;
  $week->tuesday = $tuesday;
  $week->wednesday = $wednesday ;
  $week->thursday= $thursday;
  $week->friday= $friday;
  $week->saturday=$saturday ;
  $week->sunday=$sunday;

  echo json_encode($week);
  // echo $monday."<br>".
  // $tuesday."<br>".
  // $wednesday."<br>".
  // $thursday."<br>".
  // $friday."<br>".
  // $saturday."<br>".
  // $sunday."<br>";
?>