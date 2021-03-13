# Assignment 6

Student Name: Yuehan Dai

CS login: ydai05

## URL

http://comp20.great-site.net/Assignment6/amicable.html



## Questions

##### Identify three differences and three similarities between C++ and JavaScript

Differences:

C++ is a compiled language, but JavaScript is an interpreted language, which the programs of C++ must ensure there are no errors and then it is able to be compiled, but javascript does not require. 

C++ has more strict format than JavaScript, including declaration and variable type. 

C++ 



Similarities: 

They have similarity grammar, like the use of loops(while, for, do while) and functions. 

They can both create classes(even if there are some differences).

Their variables are almost the same(int, float, string, etc).



##### What is your opinion of JavaScript as a programming language?

From my perspective, JavaScript is simpler compared with C++, which has strict format requirement. And as an interpreted language, it is interpreted by parts, like each lines, rather than as a whole, which means it is easier to find out where the errors are when there are part of the programs work correctly. 

## HTML Code

```html
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Amicable Number</title>
<link rel="stylesheet" href="style.css">
<script language="javascript">
function Number(n){
	this.value = n;
	this.factors = function(){
		// Reference: https://www.w3resource.com/javascript-exercises/javascript-function-exercise-13.php
		n = this.value;
		alert("Finding the proper divisors of " + n);
		var num_factors = [];
		for (i = 0; i <= Math.floor(Math.sqrt(n)); i++){
			if (isAFactor(n, i)){		
				alert(i + " is a propoer divisor of " + n);
				num_factors.push(i);
				if (n / i != i && n / i != n){
					alert(n/i + " is a proper divisor of " + n);
					num_factors.push(n / i);
				}
			}
		}
		num_factors.sort(function(x, y){return x - y;});  // numeric sort
		return num_factors;
	}
	this.factorsSum = function(){
		sum = 0;
		factorSerie = this.factors();
		for (i = 0; i < factorSerie.length; i ++){
			sum += factorSerie[i];
		}
		return sum;
	}
}

function amicableNumber(){
	var number1 = new Number(parseInt(document.getElementById("first").value));
	var number2 = new Number(parseInt(document.getElementById("second").value));
	printResult(number1, number2);
}

function isAFactor(n, a){
	if (n % a == 0){
		return true;
	} else {
		return false;
	}
}


function isAmicable(number1, number2){
	if(number1.factorsSum() == number2.value && number2.factorsSum() == number1.value){
		return true;
	} else {
		return false;
	}
}

function printResult(number1, number2){
	if (isAmicable(number1, number2)){
		document.getElementById("result").style.display = "block";
		document.getElementById("result").style.backgroundColor = "#d5ffcc";
		document.getElementById("result").innerHTML = "The numbers:  " + number1.value + " and " + number2.value + " are amicable";
	} else {
		document.getElementById("result").style.display = "block";
		document.getElementById("result").innerHTML = "The numbers:  " + number1.value + " and " + number2.value + " are not amicable";
	}
}
</script>
</head>


<body>
	<h1>Amicable Number Tester</h1> 
	<div id = "intro">
		<p><strong>From Wikipedia, </strong>
		Amicable numbers are two different numbers related in such a way that the sum of the proper divisors of each is equal to the other number.</p>
		
		<p>The smallest pair of amicable numbers is (220, 284). They are amicable because the proper divisors of 220 are 1, 2, 4, 5, 10, 11, 20, 22, 44, 55 and 110, of which the sum is 284; and the proper divisors of 284 are 1, 2, 4, 71 and 142, of which the sum is 220. (A proper divisor of a number is a positive factor of that number other than the number itself. For example, the proper divisors of 6 are 1, 2, and 3.)</p>
	</div>
	<form>
		<table id="bordered-form">
			<tr>
				<th class = "block">Number 1</th>
				<td><input type="text" name="number1" id="first" required="1"></td>
			</tr>
			<tr>
				<th class = "block">Number 2</th>
				<td><input type="text" name="number2" id="second" required="1"></td>
			</tr>
		</table>	
		<input type = "button" value = "Press Me" onclick="amicableNumber()">
	</form>

		<div id = "result">"The numbers:  " + number1.value + " and " + number2.value + " are amicable</div>
	
</body>
</html>

```



## CSS Code

```css
@charset "utf-8";
/* CSS Document */

body {
	background-color: #666666;
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
}
h1 {
	font-size: 50px;
	background-color:#DEDEDE;
	border: 5px solid #000000;
	padding: 1%;
	width: 68%;
	margin: auto;
	margin-top:30px;
}

form {
	border: 5px solid #000000;
	background-color:#DEDEDE;
	text-align: center;
	width: 70%;
	margin: auto;
	margin-top: 20px;
}

table {
	width: 98%;
	padding: 1%;
	font-size: 20px;
	margin: 1%;
	margin-top: 20px;
}

input[type=text] {
	min-width: 50vw;
	width: 100%;
	padding: 12px 40px;
	box-sizing: border-box;
	border:  5px solid #000;
}

input[type=button]{
	padding: 5px 30px; 
	box-sizing:border-box;
	border: 5px solid #000; 
	background-color: #FFFFFF; 
	font-weight: bold;
	font-size: 20px;
	margin-bottom: 20px;
	margin-top:10px;
}

input[type=button]:hover {
	border: 5px solid #333; 
	color: #DFDDDD; 
	background-color: #000;
}

.block {
	border: 5px solid #000; 
	background-color: #858585;
}

#intro {
	border: 5px solid #000000;
	background-color:#DEDEDE;
	width: 64%;
	margin: auto;
	margin-top: 20px;
	padding: 10px 3%;
}

#result {
	border: 5px solid #000000;
	background-color:#dedede;
	text-align: center;
	width: 68%;
	margin: auto;
	margin-top: 20px;
	font-size: 20px;
	padding: 20px 1%;
	display: none ;
}
```

