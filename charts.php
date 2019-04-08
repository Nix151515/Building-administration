
<?php

  require_once("dbconnect.php");
  error_reporting(E_ERROR | E_PARSE);
  session_start();
  include 'languages/lang_'.$_SESSION['lang'].'.php';
?>

<!DOCTYPE html>
<html lang="en" >
  <head>
    <style>

    figcaption {
      font-weight: bold;
      margin-bottom: 20px;
    }

    body {
      font-family: 'Open Sans', sans-serif;
    }

    h1 {
      font: 24px sans-serif;
    }
    .bar {
      fill: rgb(15, 82, 186);
    }

    .axis {
      font: 10px sans-serif;
    }

    .axis path,
    .axis line {
      fill: none;
      stroke: #000;
      shape-rendering: crispEdges;
    }

    .x.axis path {
      display: none;
    }

    </style>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    function getWidths() {
      let mondayUsers = 4;
      let tuesdayUsers = 5;
      let wednesdayUsers = 2;
      let thursdayUsers = 3;
      let fridayUsers = 5;
      let saturdayUsers = 1;
      let sundayUsers = 2;

// 40 width, 20 height
// 5 spacing, 8 height difference

      let blockWidth = 5;
      let blockHeight = 10;
      /*  Space between name and svg */
      // let spacing  = blockHeight/8;
      let spacing = 1;
      let heightDifference = blockHeight/3;

      document.getElementById("bar1").style.width = blockWidth * mondayUsers + "vw";
      document.getElementById("bar2").style.width = blockWidth * tuesdayUsers + "vw";
      document.getElementById("bar3").style.width = blockWidth * wednesdayUsers + "vw";
      document.getElementById("bar4").style.width = blockWidth * thursdayUsers+ "vw";
      document.getElementById("bar5").style.width = blockWidth * fridayUsers+ "vw";
      document.getElementById("bar6").style.width = blockWidth * saturdayUsers+ "vw";
      document.getElementById("bar7").style.width = blockWidth * sundayUsers+ "vw";

      document.getElementById("text1").setAttribute("x", spacing + blockWidth * mondayUsers + "vw");
      document.getElementById("text2").setAttribute("x", spacing + blockWidth * tuesdayUsers+ "vw");
      document.getElementById("text3").setAttribute("x", spacing + blockWidth * wednesdayUsers+ "vw");
      document.getElementById("text4").setAttribute("x", spacing + blockWidth * thursdayUsers+ "vw");
      document.getElementById("text5").setAttribute("x", spacing + blockWidth * fridayUsers+ "vw");
      document.getElementById("text6").setAttribute("x", spacing + blockWidth * saturdayUsers+ "vw");
      document.getElementById("text7").setAttribute("x", spacing + blockWidth * sundayUsers+ "vw");

      document.getElementById("text1").setAttribute("y", heightDifference + blockHeight * 0 + "vh");
      document.getElementById("text2").setAttribute("y", heightDifference + blockHeight * 1+ "vh");
      document.getElementById("text3").setAttribute("y", heightDifference + blockHeight * 2+ "vh");
      document.getElementById("text4").setAttribute("y", heightDifference + blockHeight * 3+ "vh");
      document.getElementById("text5").setAttribute("y", heightDifference + blockHeight * 4+ "vh");
      document.getElementById("text6").setAttribute("y", heightDifference + blockHeight * 5+ "vh");
      document.getElementById("text7").setAttribute("y", heightDifference + blockHeight * 6+ "vh");
      document.getElementById("text11").setAttribute("y", heightDifference + blockHeight * 0+ "vh");
      document.getElementById("text22").setAttribute("y", heightDifference + blockHeight * 1+ "vh");
      document.getElementById("text33").setAttribute("y", heightDifference + blockHeight * 2+ "vh");
      document.getElementById("text44").setAttribute("y", heightDifference + blockHeight * 3+ "vh");
      document.getElementById("text55").setAttribute("y", heightDifference + blockHeight * 4+ "vh");
      document.getElementById("text66").setAttribute("y", heightDifference + blockHeight * 5+ "vh");
      document.getElementById("text77").setAttribute("y", heightDifference + blockHeight * 6+ "vh");

      document.getElementById("bar1").setAttribute("y", blockHeight * 0 + "vh");
      document.getElementById("bar2").setAttribute("y", blockHeight * 1 + "vh");
      document.getElementById("bar3").setAttribute("y", blockHeight * 2 + "vh");
      document.getElementById("bar4").setAttribute("y", blockHeight * 3 + "vh");
      document.getElementById("bar5").setAttribute("y", blockHeight * 4 + "vh");
      document.getElementById("bar6").setAttribute("y", blockHeight * 5 + "vh");
      document.getElementById("bar7").setAttribute("y", blockHeight * 6 + "vh");


      document.getElementById("text11").setAttribute("x", blockWidth * mondayUsers/2 + "vw");
      document.getElementById("text22").setAttribute("x", blockWidth * tuesdayUsers/2 + "vw");
      document.getElementById("text33").setAttribute("x", blockWidth * wednesdayUsers/2 + "vw");
      document.getElementById("text44").setAttribute("x", blockWidth * thursdayUsers/2 + "vw");
      document.getElementById("text55").setAttribute("x", blockWidth * fridayUsers/2 + "vw");
      document.getElementById("text66").setAttribute("x", blockWidth * saturdayUsers/2 + "vw");
      document.getElementById("text77").setAttribute("x", blockWidth * sundayUsers/2+ "vw");

      console.log("transformed");

    $("rect").hover(
      function(){
        $(this).css("opacity", ".3");
      },
      function(){
        $(this).css("opacity", "1");
      });

    $("rect").height("10vh")

    $("#text11").text(mondayUsers);
    $("#text22").text(tuesdayUsers);
    $("#text33").text(wednesdayUsers);
    $("#text44").text(thursdayUsers);
    $("#text55").text(fridayUsers);
    $("#text66").text(saturdayUsers);
    $("#text77").text(sundayUsers);

    }  
  </script>

  </head>

  <body onload="getWidths()" onresize="getWidths()">

      <figure>
        <figcaption>A graph that shows the number of users connected</figcaption>
        <svg class="chart" aria-labelledby="title" role="img" width="100vw" height="90vh">
          <title id="title">A bart chart showing information</title>

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
