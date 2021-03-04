## Assignment 4: Joes Hotdogs

Student Name: Yuehan Dai

CS Login: ydai05

## URL

https://yuehandai.github.io/Comp20-Web/Assignment4/hotDog.html

## HTML Code

```html
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Joes Hotdogs</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class = "block">
		<h1>Joe’s Hotdog Stand</h1>

		<div>
			<div>
				<h2>Welcome, this is <strong>Joe’s Hotdog Stand</strong>. </h2>
				<div  id = "menu">
					<div class = "menuBlock">Menu</div><br>
					<table>
						<tr>
							<th>Hotdogs</th>
							<th class = "right">......................</th>
							<th>$3.25/each</th>
						</tr>
					
						<tr>
							<th>French Fries</th>
							<th class = "right">......................</th>
							<th>$2.00/each</th>
						</tr>
					
						<tr>
							<th>Drinks</th>
							<th class = "right">......................</th>
							<th>$1.50/each</th>
						</tr>
					
					
					</table>
				</div>

				<p id = "special">
					<strong>Joe’s special</strong> - 10% discount if the order (before tax) is at least $20. 
				</p>

			</div>

			<p id = "emph">Your order: </p>
			
			<div id ="orderTable">
				<table  id = "order">
				<tr>
					<th class="left">Item</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Amount</th>
				</tr>
				<tr>
					<th class="left">Hotdogs</th>
					<th id="NumberH">0</th>
					<th>3.25</th>
					<th id="CostH">0.00</th>
					<th><button onclick="setHotdogs()">Set # of Hotdogs</button></th>
				</tr>

				<tr>
					<th class="left">French Fries</th>
					<th id="NumberF">0</th>
					<th>2.00</th>
					<th id="CostF">0.00</th>
					<th><button onclick="setFries()">Set # of Fries</button></th>
				</tr>

				<tr>
					<th class="left">Drinks</th>
					<th id="NumberD">0</th>
					<th>1.50</th>
					<th id="CostD">0.00</th>
					<th><button onclick="setDrinks()">Set # of Drinks</button></th>
				</tr>

				<tr>
					<th>&nbsp;</th>
				</tr>

				<tr>
					<th class = "left">Subtotal</th>
					<th></th>
					<th></th>
					<th id ="subtotal">0.00</th>

				</tr>

				<tr id = "discountRow">
					<th class = "left">Discount</th>
					<th></th>
					<th>-10%</th>
					<th id = "discount">0.00</th>
				</tr>

				<tr>
					<th class="left">Sales Tax</th>
					<th></th>
					<th>6%</th>
					<th id = "tax">0.00</th>
				</tr>

				<tr>
					<th class="left">Total</th>
					<th></th>
					<th></th>
					<th id = "total">0.00</th>
				</tr>
			</table>
			</div>

		</div>

		<button onclick="order()" id = "makeOrder">Make the Order</button>
	</div>
	
	<script language="javascript">
			hotDog = 0;
			fries = 0;
			drink = 0;
			discount = 0;

			function setHotdogs(){
				hotDog = parseInt(prompt ("How many Hotdogs do you want? Press OK to continue", "0"));
				//Set the quantity and the amount of hotdog
				document.querySelector("#NumberH").innerHTML = hotDog;
				priceH = (hotDog * 3.25).toFixed(2);
				document.querySelector("#CostH").innerHTML = priceH;
			}

			function setFries(){
				fries = parseInt(prompt ("How many French Fries do you want? Press OK to continue", "0"));
				//Set the quantity and the amount of French Fries
				document.querySelector("#NumberF").innerHTML = fries;
				priceF = (fries * 2.00).toFixed(2);
				document.querySelector("#CostF").innerHTML = priceF;
			}

			function setDrinks(){
				drink = parseInt(prompt ("How many Drinks do you want? Press OK to continue", "0"));
				//Set the quantity and the amount of drinks
				document.querySelector("#NumberD").innerHTML = drink;
				priceD = (drink * 1.50).toFixed(2);
				document.querySelector("#CostD").innerHTML = priceD;
			}

			function order(){
				sub = hotDog * 3.25 + fries * 2.00 + drink * 1.50;
				subtotal = sub.toFixed(2);
				document.querySelector("#subtotal").innerHTML = subtotal;

				if (sub > 20){
					checkDiscount();
				} 
				checkTax();
				sum();
			}

			function checkDiscount(){
				discountClass = document.querySelector("#discountRow");
				discountClass.style.visibility = "visible";
				discount = sub * 0.1;
				dis = discount.toFixed(2);
				document.querySelector("#discount").innerHTML = dis;
			}

			function checkTax(){
				tax = (sub - discount) * 0.06;
				Tax = tax.toFixed(2);
				document.querySelector("#tax").innerHTML = Tax;
			}

			function sum(){
				total = sub - discount + tax;
				Total = total.toFixed(2);
				document.querySelector("#total").innerHTML = Total;
			}

		</script>
	
</body>
</html>

```



## CSS code

```css
@charset "utf-8";
/* CSS Document */

body {
	width:70%;
	margin:10%;
	background-color: antiquewhite;
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
}

h1 {
	text-decoration: underline overline;
}

table {
	text-align: left;
}

button {
	border:2px solid #000000;
	background-color:antiquewhite;
	padding: 1%;
	font-weight: bold;
	margin-top:1%;
}

button:hover {
	border: 2px solid #FFFFFF;
}

#orderTable {
	margin-bottom:3%;
	
	
}


#makeOrder{
	font-size:1.3em;
}

#discountRow {
	visibility: hidden;
}

.block {
	border: 5px solid #000000;
	padding: 4%;
	background-color:#FFFFFF;
}

#menu {
	background-color:antiquewhite;
	padding: 2%;
}

.menuBlock {
	border: 2px solid #000000;
	display:inline-block;
	padding: 0.5%;
	margin:auto;
	font-weight:bold;
	background-color:
}

#special {
	text-decoration: underline;
}

#menu table {
	width:100%;
}

#order {
	width:100%;
	text-align: right;
}

.left {
	text-align:left;
}

.right {
	text-align: right;
}

#emph {
	text-decoration: underline overline;
	font-weight: bold;
}
```

