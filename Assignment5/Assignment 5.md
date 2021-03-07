# Assignment 5: Lottery Sim

Student Name: Yuehan Dai

CS login: ydai05

## URL

http://comp20.great-site.net/Assignment5/lottery.html

## Layout

When the user won the price, there would be an alert saying "Congratulation!", and then the layout of the page will be changed to

![layout](C:\Users\70908\OneDrive - Tufts\2021 Spring\Comp20 Web\Assignment5\layout.png)

## HTML Code

```html
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lottery Sim</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1>Lottery Sim</h1>
	<div id = "structure">

		<div class="row">
			<div class="column">
				<h3 id = "price">Here are our prices:<br></h3>
			</div>
			<div class="column">
				<ul>
					<li>Enter 5 winning ball numbers from 1 to 48.</li>
					<li>Enter the lucky ball number from 1 to 12.</li>
				</ul>
			</div>
		  </div>
		
		<table id = "rule">
			<tr>
				<th>Match</th>
				<th>Price</th>
			</tr>
			<tr>
				<td class = "block">5 + Lucky Ball</td>
				<td class = "block">$7,000 a WEEK for LIFE</td>
			</tr>
			<tr>
				<td class = "block">5</td>
				<td class = "block">$25,000 a YEAR for LIFE</td>
			</tr>
			<tr>
				<td class = "block">4 + Lucky Ball</td>
				<td class = "block">$5,000</td>
			</tr>
			<tr>
				<td class = "block">4</td>
				<td class = "block" id = "price4">$200</td>
			</tr>
			<tr>
				<td class = "block" id = "3L">3 + Lucky Ball</td>
				<td class = "block" id = "price3L">$150</td>
			</tr>
			<tr>
				<td class = "block" id = "3">3</td>
				<td class = "block" id = "price3">$20</td>
			</tr>
			<tr>
				<td class = "block" id = "2L">2 + Lucky Ball</td>
				<td class = "block" id = "price2L">$25</td>
			</tr>
			<tr>
				<td class = "block" id = "2">2</td>
				<td class = "block" id = "price2L">$3</td>
			</tr>
			<tr>
				<td class = "block" id = "1L">1 + Lucky Ball</td>
				<td class = "block" id = "price1L">$6</td>
			</tr>
			<tr>
				<td class = "block" id = "L">0 + Lucky Ball</td>
				<td class = "block" id = "priceL">$4</th>
			</tr>
		
			<div id = "congrats">
				Congratulations!
			</div>

			<div>
				<table id = "balls">
					<tr>
						<th>Today's Lucky:</th>
						<th id = "number1" class = "ball"></th>
						<th id = "number2" class = "ball"></th>
						<th id = "number3" class = "ball"></th>
						<th id = "number4" class = "ball"></th>
						<th id = "number5" class = "ball"></th>
						<th> &nbsp;&nbsp;&nbsp;</th>
						<th id = "luckyBall" class = "ball"></th>
					</tr>
					<tr>
						<th>Your balls:</th>
						<th id = "Unumber1" class = "ball"></th>
						<th id = "Unumber2" class = "ball"></th>
						<th id = "Unumber3" class = "ball"></th>
						<th id = "Unumber4" class = "ball"></th>
						<th id = "Unumber5" class = "ball"></th>
						<th> &nbsp;&nbsp;&nbsp;</th>
						<th id = "UluckyBall" class = "ball"></th>
					</tr>
				</table>
			</div>

			
		</table>
		
		<button onclick="tryIt()">Try it!</button>

		
		
	</div>
	
	<script language="javascript">
		
		// global variables
		numberCustomer = [];
		numbers = [];
		lucky = {};
		luckyCustomer = {};
		matches = {};
		luckyMatch = false;

		function tryIt(){
			setColor();
			setNumbers();
			setLucky();
			getNumbers();
			getLucky();
			checkNumber();
			checkLucky();
			makeMatch();
			clearUp();
		}
		
		function setColor(){
			for(i = 0; i < 19; i ++ ){
				document.querySelectorAll(".block")[i].style.backgroundColor = "#ffffff";
			}
			
			for(i = 0; i < 11; i ++){
				document.querySelectorAll(".ball")[i].style.backgroundColor = "#ffffff";
			}
			
		}

		// function for set the 5 numbers
		function setNumbers(){
			for (i = 0; i < 5; i++){
				n = Math.random()*47 + 1;
				number = parseInt(n);
				numbers[i] = number;
			}
			numbers.sort(function(a, b) {
  				return a - b;
			});

			console.log(numbers);

			document.querySelector("#number1").innerHTML = numbers[0];
			document.querySelector("#number2").innerHTML = numbers[1];
			document.querySelector("#number3").innerHTML = numbers[2];
			document.querySelector("#number4").innerHTML = numbers[3];
			document.querySelector("#number5").innerHTML = numbers[4];
		}
		
		// fuction for set the lucky ball
		function setLucky(){
			n = Math.random()*17 + 1;
			lucky = parseInt(n);
			document.querySelector("#luckyBall").innerHTML = lucky;
		}

		// get the numbers from the customer and make sure the format of input is correct
		function getNumbers(){
			isAccepted = false;
			while (!isAccepted){
				numbersString = prompt("Enter the first 5 winning numbers(from 1 to 48) – the numbers should be entered separated by a space. ", "");
				var numberSplited = numbersString.split(" ");
				i = 0;
				while (i < 5){
					numberCustomer.push(parseInt(numberSplited[i]));
					
					if (numberCustomer[i] < 1 || numberCustomer[i] > 48 || !Number.isInteger(numberCustomer[i])){
						alert("Please try again. The input should be five integers from 1 to 48.");
						numberCustomer = [];
						break;
					}
					i++;
				}
				if (i == 5){
					isAccepted = true;
				}
			};
		}


		// get the lucky ball number from the user
		function getLucky(){
			isAccepted = false;
			while(!isAccepted){
				luckyCustomer = parseInt(prompt("Enter lucky ball numbers(from 1 to 18): ", ""));
				if (luckyCustomer < 1 || luckyCustomer > 18 || !Number.isInteger(luckyCustomer)){
					alert("Please try again! The input should be an integer from 1 to 18.");
					luckyCustomer = {};
				} else {
					isAccepted = true;
				}
			}
			
		}

		// check how many matches in 5 numbers
		function checkNumber(){
			matches = 0;
			for (i = 0; i < 5; i ++){
				for (j = 0; j < 5; j ++){
					if (numberCustomer[j] == numbers[i]){
						matches++;
						changeBallColor(i);
						changeAnswerColor(j);
						break;
					}
				}				
			}
			document.querySelector("#Unumber1").innerHTML = numberCustomer[0];
			document.querySelector("#Unumber2").innerHTML = numberCustomer[1];
			document.querySelector("#Unumber3").innerHTML = numberCustomer[2];
			document.querySelector("#Unumber4").innerHTML = numberCustomer[3];
			document.querySelector("#Unumber5").innerHTML = numberCustomer[4];
		}

		// check if the lucky ball number is matched
		function checkLucky(){
			if (luckyCustomer == lucky){
				luckyMatch = true;
				changeBallColor(5);
				changeAnswerColor(5);
			} else {
				luckyMatch = false;
			}
			document.querySelector("#UluckyBall").innerHTML = luckyCustomer;
		}

		// change the color of ball if it is matched
		function changeBallColor(ball){
			if (ball == 0){
				document.querySelector("#number1").style.backgroundColor = "#d0ffca";
			}
			if (ball == 1){
				document.querySelector("#number2").style.backgroundColor = "#d0ffca";
			}
			if (ball == 2){
				document.querySelector("#number3").style.backgroundColor = "#d0ffca";
			}
			if (ball == 3){
				document.querySelector("#number4").style.backgroundColor = "#d0ffca";
			}
			if (ball == 4){
				document.querySelector("#number5").style.backgroundColor = "#d0ffca";
			}
			if (ball == 5){
				document.querySelector("#luckyBall").style.backgroundColor = "#d0ffca";
			}
		}

		// change the color of user's ball if it is matched
		function changeAnswerColor(ball){
			if (ball == 0){
				document.querySelector("#Unumber1").style.backgroundColor = "#d0ffca";
			}
			if (ball == 1){
				document.querySelector("#Unumber2").style.backgroundColor = "#d0ffca";
			}
			if (ball == 2){
				document.querySelector("#Unumber3").style.backgroundColor = "#d0ffca";
			}
			if (ball == 3){
				document.querySelector("#Unumber4").style.backgroundColor = "#d0ffca";
			}
			if (ball == 4){
				document.querySelector("#Unumber5").style.backgroundColor = "#d0ffca";
			}
			if (ball == 5){
				document.querySelector("#UluckyBall").style.backgroundColor = "#d0ffca";
			}
		}

		function makeMatch(){
			if (matches > 1 || luckyMatch == true){
				document.querySelector("#congrats").style.display = "block";
				alert("Congratulations!");
				makePrice();
			}
		}

		function makePrice(){
			if (matches == 5 && luckyMatch == true){
				document.querySelectorAll(".block")[0].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[1].style.backgroundColor = "#d0ffca";
			} else if (matches == 5){
				document.querySelectorAll(".block")[2].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[3].style.backgroundColor = "#d0ffca";
			} else if (matches == 4 && luckyMatch == true){
				document.querySelectorAll(".block")[4].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[5].style.backgroundColor = "#d0ffca";
			} else if (matches == 4){
				document.querySelectorAll(".block")[6].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[7].style.backgroundColor = "#d0ffca";
			} else if (matches == 3 && luckyMatch == true){
				document.querySelectorAll(".block")[8].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[9].style.backgroundColor = "#d0ffca";
			} else if (matches == 3){
				document.querySelectorAll(".block")[10].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[11].style.backgroundColor = "#d0ffca";
			} else if (matches == 2 && luckyMatch == true){
				document.querySelectorAll(".block")[12].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[13].style.backgroundColor = "#d0ffca";
			} else if (matches == 2){
				document.querySelectorAll(".block")[14].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[15].style.backgroundColor = "#d0ffca";
			} else if (matches == 1 && luckyMatch == true){
				document.querySelectorAll(".block")[16].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[17].style.backgroundColor = "#d0ffca";
			} else if (matches == 0 && luckyMatch == true){
				document.querySelectorAll(".block")[18].style.backgroundColor = "#d0ffca";
				document.querySelectorAll(".block")[19].style.backgroundColor = "#d0ffca";
			}
		}

		function clearUp(){
			numberCustomer = [];
			numbers = [];
			lucky = {};
			luckyCustomer = {};
			matches = {};
			luckyMatch = false;
		}
	</script>
</body>
</html>

```



## CSS Code

```css
@charset "utf-8";
/* CSS Document */

*{
    text-align: center;
    font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
    box-sizing: border-box;
}

body{
    background-color: #a3a3a3 ;
}

#structure {
    border: 8px solid;
    width:60%;
    margin:auto;
    background-color: #ffffff;
}

h1 {
    font-size: 50px;
}

#congrats {
    font-size: 30px;
    margin-left:auto;
    margin-right:auto;
    margin-bottom:20px;
    margin-top:20px;
    border: 8px solid;
    padding: 10px;
    background-color: #d0ffca;
    width:80%;
    font-weight: bold;
    display: none;
}

li {
    margin: auto;
    text-align: left;
    margin-left: 5%;
}


#rule {
    width:90%;
    margin:auto;
    border: 5px solid;
    padding: 1%;
    background-color: #d6d6d6;
}

.ball {
    border-radius: 50%;
    display: inline-block;
    border: 5px solid;
    height: 40px;
    width: 40px;
    margin: 10px;
    background-color: #ffffff;
}

#balls {
    margin:auto;
}

#rule th {
	border: 4px solid #000; 
	background-color: #a3a3a3;
    padding:0.5% 1%;
}

.block{
    border: 4px solid #000; 
    padding:0.5% 1%;
    background-color: #ffffff;
}

button{
	padding: 5px 30px; 
	margin-top:10px;
	box-sizing:border-box;
	border: 5px solid #000; 
	background-color: #ffffff; 
	font-weight: bold;
	font-size: 30px;
}

button:hover {
	border: 5px solid #333; 
	color: #DFDDDD; 
	background-color: #000;
}
  
/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 44%;
    height:auto;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

#price {
    text-align: left;
    margin-left: 12%;
    font-size: larger;
    text-decoration: underline;
}
```

