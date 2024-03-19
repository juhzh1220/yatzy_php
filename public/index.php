<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div id="gameboard">
        <div class="dice_area" id=dicearea>
            <div class="dice" id="die1" data-row="1"><img src='dice1.png' class='img'></div>
            <div class="dice" id="die2" data-row="2"><img src="dice1.png" class="img"></div>
            <div class="dice" id="die3" data-row="3"><img src="dice1.png" class="img"></div>
            <div class="dice" id="die4" data-row="4"><img src="dice1.png" class="img"></div>
            <div class="dice" id="die5" data-row="5"><img src="dice1.png" class="img"></div>
        </div>
        <button id="rollButton" class="btn">ROLL</button>


    </div>
    <br><br>

    <table id="scoreboard">
        <tbody>
            <tr>
                <th></th>
                <td class="name bottom-player-name">You</td>
            </tr>
            <tr>
                <th>Ones</th>
                <td id="ones" data-row="0"></td>
            </tr>
            <tr>
                <th>Twos</th>
                <td id="twos" data-row="1"></td>
            </tr>
            <tr>
                <th>Threes</th>
                <td id="threes" data-row="2"></td>
            </tr>
            <tr>
                <th>Fours</th>
                <td id="fours" data-row="3"></td>
            </tr>
            <tr>
                <th>Fives</th>
                <td id="fives" data-row="4"></td>
            </tr>
            <tr>
                <th>Sixes</th>
                <td id="sixes" data-row="5"></td>
            </tr>
            <tr>
                <th>Three of a kind</th>
                <td id="three-of-a-kind" data-row="6"></td>
            </tr>
            <tr>
                <th>Four of a kind</th>
                <td id="four-of-a-kind" data-row="7"></td>
            </tr>
            <tr>
                <th>Full House</th>
                <td id="full-house" data-row="8"></td>
            </tr>
            <tr>
                <th>Small straight</th>
                <td id="small-straight" data-row="9"></td>
            </tr>
            <tr>
                <th>Large straight</th>
                <td id="large-straight" data-row="10"></td>
            </tr>
            <tr>
                <th>Chance</th>
                <td id="chance" data-row="11"></td>
            </tr>
            <tr>
                <th>YAHTZEE</th>
                <td id="yahtzee" data-row="12"></td>
            </tr>
            <tr>
                <th>TOTAL SCORE</th>
                <td id="total-score"></td>
            </tr>
        </tbody>
    </table>


    <script type="text/javascript" >
        
        let scoreAvalibility = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        let diceAvalibility = [0,0,0,0,0];
        var dice1 =diceAvalibility[0];
        var dice2 =diceAvalibility[1];
        var dice3 =diceAvalibility[2];
        var dice4 =diceAvalibility[3];
        var dice5 =diceAvalibility[4];
        var dices = [];
        const diceElements=document.querySelectorAll(".dice");  
        const rollButton = document.getElementById("rollButton");
        const cells=document.querySelectorAll("td");


        diceElements.forEach(function(dice){
        dice.addEventListener("click",onDiceClick);
    });


    cells.forEach(function(cell){
        if (scoreAvalibility[cell.getAttribute("data-row")] === 0){
          cell.addEventListener("click",onCellClick);}
        
      });



    $(document).ready(function(){
    $('#rollButton').click(function(){
      $.ajax({
        type:'POST',
        url:'yatzyEngine.php',
        
        data: {status:0,dice1:diceAvalibility[0],dice2:diceAvalibility[1],dice3:diceAvalibility[2],dice4:diceAvalibility[3],dice5:diceAvalibility[4],},
        error: function() {
            alert("Error");
        },
        success: function() {
            console.log(diceAvalibility);
            console.log(scoreAvalibility);

  }
      });

      $.get("yatzyEngine.php").done(function(data){
        // console.log("`1212123")
        
    // What do I do with the data?
    for (let i =0; i <5; i++){
        dices[i] = data[i];

    }
    console.log(data);

        console.log(dices);
        changeDiceFaces(dices);
    
});
    });
   
  });
  function onCellClick(){
  let row=this.getAttribute("data-row");

    score[row]=parseInt(this.innerHTML);
    console.log(score[row]);
    scoreAvalibility[row]=1;
    cells.forEach(function(cell){
      cell.removeEventListener("click",onCellClick);
    });
    this.style.background="#7fb5da"; 
    next();
}

        function onDiceClick(){
        let num = this.getAttribute("data-row");
        diceAvalibility[num-1]++;
        diceAvalibility[num-1]=(diceAvalibility[num-1])%2;
        console.log(diceAvalibility);
        if (diceAvalibility[num-1]===0){
              this.style.opacity=1; 
        }
         else{this.style.opacity=0.5; 

          }

}  
        
function changeDiceFaces(dice){
  for (let i=0; i < diceElements.length;i++) {
    
    let face = document.getElementsByClassName("img")[i];
    face.src="dice"+dice[i]+".png";
    // console.log(face);
  }
  
 }
        
       

//         $(document).ready(function(){
//         $('#rollButton').click(function(){
//         console.log("Response: "+diceAvalibility+scoreAvalibility);
//         $.ajax({
//         type:'POST',
//         url:'app\models\yatzyEngine.php',
//         data:{
//         diceAvalibility:$('#diceAvalibility').val(),
//         scoreAvalibility:$('#scoreAvalibility').val(),
//         },
//         error: function() {
//             alert("Error");
//         },
//         success: function() {
//             alert("OK");
//   }

//       });
//     });
//   })

    </script>
</body>

</html>

<?php
require_once('config.php');

include "yatzyEngine.php";
$d = array();
$d = rollDice();

for ($i=1; $i<=5; $i++) {
  echo "ROLL {$i}: {$d[0]}<br>";
}
