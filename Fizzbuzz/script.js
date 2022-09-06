#!/usr/bin/node

const fs = require("fs")
main()

function main(){
//Variable of data to log   
var logData = "";

//Main loop
for(let i = 1 ; i <=500 ; i++) {
    let text = i +' ';
    text += specialOutput(i);
    console.log(text);
    logData += text + '\n';
}

//Creation of log file
fs.appendFile('fizzbuzz.log', logData, function (err) {
    if (err) return console.log(err);
    console.log('log file created under the name fizzbuzz.log');
  });
}

function specialOutput(num) {
    let specialOutputText = ""
    if(num%3 == 0){
        specialOutputText += "FIZZ";
    }
    if(num%5 == 0){
        specialOutputText += "BUZZ";
    }
    if(isPrimeNumber(num)){
        specialOutputText = "FIZZBUZZ++";
    }

    return specialOutputText;

}

function isPrimeNumber(num) {
    if (num==1){
      return false;
    }
    else if(num === 2){
      return true;
    }
    else{
      for(var x = 2; x < num; x++){
        if(num % x === 0){
          return false;
        }
      }
      return true;  
    }
}