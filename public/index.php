<?php
// Start the session
session_start();
?>

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
<br><br>

    <table id="leaderboard">
        <tbody>
            <tr>
                
                <td class="name bottom-player-name">LEADERBOARD</td>
            </tr>
            <tr>
                
                <td id="1" data-row="0"></td>
            </tr>
            <tr>
                
                <td id="2" data-row="1"></td>
            </tr>
            <tr>
                
                <td id="3" data-row="2"></td>
            </tr>
            <tr>
                
                <td id="4" data-row="3"></td>
            </tr>
            <tr>
                
                <td id="5" data-row="4"></td>
            </tr>
            <tr>
                <td id="6" data-row="5"></td>
            </tr>
            <tr>
                <td id="7" data-row="6"></td>
            </tr>
            <tr>
                <td id="8" data-row="7"></td>
            </tr>
            <tr>
                <td id="9" data-row="8"></td>
            </tr>
            <tr>
                <td id="10" data-row="9"></td>
            </tr>
            <tr>
                
        </tbody>
    </table>

  

        

    <script type="text/javascript" >
        let rollCount =0;
        let roundCount=0;
        let scoreAvalibility = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        let diceAvalibility = [0,0,0,0,0];
        var dice1 =diceAvalibility[0];
        var dice2 =diceAvalibility[1];
        var dice3 =diceAvalibility[2];
        var dice4 =diceAvalibility[3];
        var dice5 =diceAvalibility[4];

  
        var dices = [0,0,0,0,0]
        var num1=dices[0];
        var num2=dices[1];
        var num3=dices[2];
        var num4=dices[3];
        var num5=dices[4];
        let score = [];
        let result = [];
        const diceElements=document.querySelectorAll(".dice");
        const rollButton= document.getElementById("rollButton");
        const cells=document.querySelectorAll("td");


        diceElements.forEach(function(dice){
        dice.addEventListener("click",onDiceClick);
    });
    


    



    $(document).ready(function(){
    $('#rollButton').click(function(){
      rollCount++;
      $.ajax({
        type:'POST',
        url:'yatzyEngine.php',
        
        data: {status:0,dice1:diceAvalibility[0],dice2:diceAvalibility[1],dice3:diceAvalibility[2],dice4:diceAvalibility[3],dice5:diceAvalibility[4],},
        error: function() {
            alert("Error");
        },
        success: function(data) {
            
            for (let i =0; i <5; i++){
            if(diceAvalibility[i]==0){dices[i] = data[i];}
            $.ajax({
                    type:'GET',
                        url:'yatzyEngine.php',
        
                        data: {status:1,num1:dices[0],num2:dices[1],num3:dices[2],num4:dices[3],num5:dices[4],},
                     error: function() {
                            alert("Error");
                              },
                      success: function(data) {
                           const res = data.split(" ")
                           console.log(diceAvalibility);
                           console.log(scoreAvalibility);
                            // for (let i =5; i <18; i++){
                            //         score[i-5] = data[i];

                            //     }
                                        
                            for (let i =0; i <5; i++){
                          if(diceAvalibility[i]==0){dices[i] = res[i];}
          

    }
    for (let i =5; i <18; i++){
      score[i-5] = res[i];

  }
        console.log(data);
        console.log(score)
        console.log(dices);
        console.log(rollCount);
        changeDiceFaces(dices);
        writeScore(score);
        if(rollCount==3){
        rollButton.disabled=true;
        rollButton.style.opacity=0.5;
        cells.forEach(function(cell){
        if (scoreAvalibility[cell.getAttribute("data-row")] === 0){
          cell.addEventListener("click",onCellClick);}
        
      });
    }

  }
      });
          

    }
  //   for (let i =5; i <18; i++){
  //     score[i-5] = data[i];

  // }
  //       console.log(data);
  //       console.log(score)

  //       console.log(dices);
  //       changeDiceFaces(dices);
  //       writeScore(score);

  }
      });
      

//       $.get("yatzyEngine.php").done(function(data){
//         // console.log("`1212123")
        
//     // What do I do with the data?
//     for (let i =0; i <5; i++){
//         dices[i] = data[i];

//     }
//     console.log(data);

//         console.log(dices);
//         changeDiceFaces(dices);
    
// });
    });
   
  });
  
  


  
  function next(){
  roundCount++;
  diceElements.forEach(function(dice){
    dice.removeEventListener("click",onDiceClick);
  });
  diceAvalibility=[0,0,0,0,0];
  diceElements.forEach(function(dice){
    dice.style.opacity=1;
  })

  updateScoreTable();

  rollCount=0;
  if(roundCount===13)  {
    var res = document.getElementById("total-score").innerHTML;
    res = parseInt(res);
    console.log(res);
    $(document).ready(function(){
      $.ajax({
        method:'GET',
        url: "yatzyEngine.php",
        data: {status:3,variable:res} ,
        success:function (response) {

           console.log(response);
           
           console.log(response[20]+response[21]);
           console.log(response[35]+response[36]);
           let r = [];
           for(let i =0; i <10;i++){
            r[i]=response[15*i+20]+response[15*i+21]
            
           }
           console.log(r);
           document.getElementById("1").innerHTML = r[0];
           document.getElementById("2").innerHTML = r[1];
           document.getElementById("3").innerHTML = r[2];
           document.getElementById("4").innerHTML = r[3];
           document.getElementById("5").innerHTML = r[4];
           document.getElementById("6").innerHTML = r[5];
           document.getElementById("7").innerHTML = r[6];
           document.getElementById("8").innerHTML = r[7];
           document.getElementById("9").innerHTML = r[8];
           document.getElementById("10").innerHTML = r[9];
          
           


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
  
 
});
    alert("FINAL SCORE: "+ res);
    return;
  }
  rollButton.disabled=false;
  rollButton.style.opacity=1;
}



  function onCellClick(){
  let row=this.getAttribute("data-row");

    result[row]=parseInt(this.innerHTML);
    console.log(score[row]);
    scoreAvalibility[row]=1;
    cells.forEach(function(cell){
      cell.removeEventListener("click",onCellClick);
    });
    this.style.background="#7fb5da"; 
    
    next();
    diceElements.forEach(function(dice){
      dice.addEventListener("click",onDiceClick);
    });
 
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
 function updateScoreTable(){
  let res = 0
  for (let i=0;i<13;i++) {
    if (scoreAvalibility[i] !==0){
      res = res + result[i];
    }
  }
  document.getElementById("total-score").innerHTML = res;
}
 function writeScore(dice){
  if (scoreAvalibility[0] === 0) {
    
    document.getElementById("ones").innerHTML = dice[0];
  }
  if (scoreAvalibility[1] === 0) {
    document.getElementById("twos").innerHTML = dice[1];
  }
  if (scoreAvalibility[2] === 0) {
    document.getElementById("threes").innerHTML = dice[2];
  }
  if (scoreAvalibility[3] === 0) {
    document.getElementById("fours").innerHTML = dice[3];
  }
  if (scoreAvalibility[4] === 0) {
    document.getElementById("fives").innerHTML = dice[4];
  }
  if (scoreAvalibility[5] === 0) {
    document.getElementById("sixes").innerHTML = dice[5];
  }
  if (scoreAvalibility[6] === 0) {
    document.getElementById("three-of-a-kind").innerHTML = dice[6];
  }
  if (scoreAvalibility[7] === 0) {
    document.getElementById("four-of-a-kind").innerHTML = dice[7];
  }
  if (scoreAvalibility[8] === 0) {
    document.getElementById("full-house").innerHTML = dice[8];
  }
  if (scoreAvalibility[9] === 0) {
    document.getElementById("small-straight").innerHTML = dice[9];
  }
  if (scoreAvalibility[10] === 0) {
    document.getElementById("large-straight").innerHTML = dice[10];
  }
  if (scoreAvalibility[11] === 0) {
    document.getElementById("chance").innerHTML = dice[11];
  }
  if (scoreAvalibility[12] === 0) {
    document.getElementById("yahtzee").innerHTML = dice[12];
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

