let rollCount =0;
let roundCount=0;
let score = [];
let scoreAvalibility = [];
let diceAvalibility=[0,0,0,0,0];
let dices = [1,2,3,4,5];
const diceElements=document.querySelectorAll(".dice");  
const rollButton = document.getElementById("rollButton");
const cells=document.querySelectorAll("td");

rollButton.addEventListener("click",rollDice);
function rollDice() {
 
    rollCount++;
    for (let i=0;i<13;i++) {
      scoreAvalibility.push(0);
    }
    for (let i=0;i<dices.length;i++) {
      if (diceAvalibility[i]===0){
      dices[i]=(Math.floor(Math.random()*6)+1);
      }
    }
    diceElements.forEach(function(dice){
      dice.addEventListener("click",onDiceClick);
    });
    changeDiceFaces(dices);
    writeScore(dices);
    console.log(dices);
    if(rollCount==3){
      rollButton.disabled=true;
      rollButton.style.opacity=0.5;
      cells.forEach(function(cell){
        if (scoreAvalibility[cell.getAttribute("data-row")] === 0){
          cell.addEventListener("click",onCellClick);}
        
      });
    }
    
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
    face.src="\\docs\\design_system\\dice"+dice[i]+".png";
    // console.log(face);
  }
  
 }
 
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
    res = document.getElementById("total-score").innerHTML;
    alert("FINAL SCORE: "+ res);
    return;
  }
  rollButton.disabled=false;
  rollButton.style.opacity=1;
}

function updateScoreTable(){
  let res = 0
  for (let i=0;i<13;i++) {
    if (scoreAvalibility[i] !==0){
      res = res + score[i];
    }
  }
  document.getElementById("total-score").innerHTML = res;
}
 function writeScore(dice){
  if (scoreAvalibility[0] === 0) {
    let ones = calculateOnes(dice);
    console.log(ones);
    document.getElementById("ones").innerHTML = ones;
  }
  if (scoreAvalibility[1] === 0) {
    let twos = calculateTwos(dice);
    document.getElementById("twos").innerHTML = twos;
  }
  if (scoreAvalibility[2] === 0) {
    let threes = calculateThrees(dice);
    document.getElementById("threes").innerHTML = threes;
  }
  if (scoreAvalibility[3] === 0) {
    let fours = calculateFours(dice);
    document.getElementById("fours").innerHTML = fours;
  }
  if (scoreAvalibility[4] === 0) {
    let fives = calculateFives(dice);
    document.getElementById("fives").innerHTML = fives;
  }
  if (scoreAvalibility[5] === 0) {
    let sixes = calculateSixes(dice);
    document.getElementById("sixes").innerHTML = sixes;
  }
  if (scoreAvalibility[6] === 0) {
    let res = calculateThreeOfAKind(dice);
    document.getElementById("three-of-a-kind").innerHTML = res;
  }
  if (scoreAvalibility[7] === 0) {
    let res = calculateFourOfAKind(dice);
    document.getElementById("four-of-a-kind").innerHTML = res;
  }
  if (scoreAvalibility[8] === 0) {
    let res = calculateFullHouse(dice);
    document.getElementById("full-house").innerHTML = res;
  }
  if (scoreAvalibility[9] === 0) {
    let res = calculateSmallStraight(dice);
    document.getElementById("small-straight").innerHTML = res;
  }
  if (scoreAvalibility[10] === 0) {
    let res = calculateLargeStraight(dice);
    document.getElementById("large-straight").innerHTML = res;
  }
  if (scoreAvalibility[11] === 0) {
    let res = calculateChance(dice);
    document.getElementById("chance").innerHTML = res;
  }
  if (scoreAvalibility[12] === 0) {
    let res = calculateYahtzee(dice);
    document.getElementById("yahtzee").innerHTML = res;
  }
  


 }

 function calculateOnes(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){
    if(dice[i]===1) {
      score+=1;
    }
  }
  return score;
}
function calculateTwos(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){
    if(dice[i]===2) {
      score+=2;
    }
  }
  return score;
}
function calculateThrees(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){
    if(dice[i]===3) {
      score+=3;
    }
  }
  return score;
}
function calculateFours(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){
    if(dice[i]===4) {
      score+=4;
    }
  }
  return score;
}
function calculateFives(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){
    if(dice[i]===5) {
      score+=5;
    }
  }
  return score;
}
function calculateSixes(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){
    if(dice[i]===6) {
      score+=6;
    }
  }
  return score;
}

function calculateThreeOfAKind(dice) {
  let score=0;
  for(let i=0;i<dice.length;i++){
    let count=1;
    for(let j=0;j<dice.length;j++) {
      if(j!==i && dice[i]===dice[j]){
        count++;
      }
    }
    if(count>=3) {
      score=dice.reduce((acc,val)=>acc+val);
      break;
    }
  }
  return score;
}
function calculateFourOfAKind(dice) {
  let score=0;
  for(let i=0;i<dice.length;i++){
    let count=1;
    for(let j=0;j<dice.length;j++) {
      if(j!==i && dice[i]===dice[j]){
        count++;
      }
    }
    if(count>=4) {
      score=dice.reduce((acc,val)=>acc+val);
      break;
    }
  }
  return score;
}
function calculateFullHouse(dice) {
  let score=0;
  let diceCopy=dice.slice();
  diceCopy.sort();
  if(
    (diceCopy[0]==diceCopy[1] &&
      diceCopy[1]==diceCopy[2] &&
      diceCopy[3]==diceCopy[4]   
      ) ||
        (diceCopy[0]==diceCopy[1] &&
          diceCopy[2]==diceCopy[3] &&
          diceCopy[3]==diceCopy[4]   
          )     
  ) {
    score=25;
    return score;
  }
  return score;
}
function calculateSmallStraight(dice) {
  let score=0;
  let diceCopy=[...new Set(dice)];
  diceCopy.sort();
  if(
    (diceCopy[1]==diceCopy[0]+1 &&
      diceCopy[2]==diceCopy[1]+1 &&
      diceCopy[3]==diceCopy[2] +1  
      ) ||
        (diceCopy[2]==diceCopy[1]+1 &&
          diceCopy[3]==diceCopy[2]+1 &&
          diceCopy[4]==diceCopy[3] +1  
          )     
  ) {
    score=30;
  }
  return score;
}
function calculateLargeStraight(dice) {
  let score=0;
  let diceCopy=[...new Set(dice)];
  diceCopy.sort();
  if(
    (diceCopy[1]==diceCopy[0]+1 &&
      diceCopy[2]==diceCopy[1]+1 &&
      diceCopy[3]==diceCopy[2] +1 &&
      diceCopy[4]==diceCopy[3] +1
      )  
  ) {
    score=40;
  }
  return score;
}
function calculateChance(dice) {
  let score=0;
  for (let i=0;i<dice.length;i++){ 
      score+=dice[i];
  }
  return score;
}
function calculateYahtzee(dice) {
  let firstDie=dice[0];
  let score=50;
  for (let i=0;i<dice.length;i++){
    if(dice[i]!==firstDie) {
      score=0;
    }
  }
  return score;
}

    