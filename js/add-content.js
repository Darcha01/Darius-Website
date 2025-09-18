// JavaScript Document
var today = new Date();
var hourNow = today.getHours();
var greeting = document.getElementById('greeting');

if (hourNow > 12){
	greeting.innerHTML = 'Good afternoon!';
}
else if (hourNow > 0){
	greeting.innerHTML = 'Good evening!';
}
else if (hourNow > 18){
	greeting.innerHTML = 'Good morning!';
}
else{
	greeting.innerHTML = 'Welcome!';
}

console.log('Var greeting value: ' + greeting.innerHTML);
