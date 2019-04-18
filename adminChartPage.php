
<?php
  require_once("dbconnect.php");
  error_reporting(E_ERROR | E_PARSE);
  session_start();
  include 'languages/lang_'.$_SESSION['lang'].'.php';
?>



<!DOCTYPE html>
<html lang="en" >
  <head>
  </head>

  <body>

    <ul>
      <li><a onclick='loadPage(`adminMainPage.php`,`adminMainPage`)'><?php echo $lang['adminPage']; ?></a></li>
      <li><a onclick='loadPage(`adminChartPage.php`,`adminMainPage`) getWidths()'><?php echo $lang['chart']; ?></a></li>
    </ul>
   
      <figure>
        <figcaption><?php echo $lang['chartTitle'];?></figcaption>
        <svg class="chart" aria-labelledby="title" role="img" width="100vw" height="90vh">
          <!-- <title id="title">A bart chart showing information</title> -->

          <g class="bar">
            <text id="text1"><?php echo $lang['monday'];?></text>
            <text id="text11"> </text>
            <rect id="bar1"></rect>
          </g>
          <g class="bar">
            <text id="text2"><?php echo $lang['tuesday'];?></text>
            <text id="text22"> </text>
            <rect id="bar2"></rect>
          </g>
          <g class="bar">
            <text id="text3" ><?php echo $lang['wednesday'];?></text>
            <text id="text33" > </text>
            <rect id="bar3"></rect>
          </g>
          <g class="bar">
            <text id="text44"> </text>
            <text id="text4"><?php echo $lang['thursday'];?></text>
            <rect id="bar4"></rect>
          </g>
          <g class="bar">
            <text id="text55"> </text>
            <text id="text5"><?php echo $lang['friday'];?></text>
            <rect id="bar5"></rect>
          </g>
          <g class="bar">
            <text id="text66"> </text>
            <text id="text6"><?php echo $lang['saturday'];?></text>
            <rect id="bar6"></rect>
          </g>
          <g class="bar">
            <text id="text77"> </text>
            <text id="text7" ><?php echo $lang['sunday'];?></text>
            <rect id="bar7"></rect>
          </g>


        </svg>
    </figure>

  </body>
</html>
