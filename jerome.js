const numbers = [1,2,3,4,5,10];
let sum = 0;

for (let i = 0; i <numbers.length; i++) {
    sum += numbers[i];
}

console.log(sum);

const number = [3,5,7,2,8];
const largestnumber = Math.max(...number);
console.log(largestnumber);

function reverseString(str){
    return str.split('').reverse(). join('');
}

const string = "hello";
const reversedString = reverseString(string);
console.log(reversedString);

function Odd(number){
    return number % 2 !== 0;
}

const inputNumber = 5;
if (Odd (inputNumber)) {
    console.log(`${inputNumber} is Odd.`)
} else{
    console.log(`${inputNumber} is even.`);
}

function arrs() {
    const result = [];
    for(let i = 1; i<= 50; i++){
        if(i % 3 === 0){
            result.push("marc");
        }else if(i % 5 === 0){
            result.push("alds")
        } else {
            result.push(i);
        }
    }
    document.getElementById('multiples').innerText = result.join(", ");
}