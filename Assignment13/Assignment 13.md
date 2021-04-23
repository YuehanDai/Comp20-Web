

# Assignment 13: Jade Delight Part 2

<u>Student Name</u>: Yuehan Dai

<u>CS login:</u> 1319141

## url

http://comp20.great-site.net/Assignment13/jade_delight.php

## Question

1. **Do you prefer Javascript or PHP to code display of the order- and why?**

   I prefer PHP. This is because PHP provides a better interaction with the CSS styling, and that is hard to accomplish in the JavaScript. 

2. **How could you have used PHP to enhance your midterm project?**

   We make a travel agency in the midterm project, and one of the pages is a order page which allows the client to select what they are interested, provided the service names, prices, etc, which resembles this assignment a lot. To enhance our midterm project, I am think about adding a receipt page after ordering the services. Further, since we have a text box that asks the client to join our email list, we can send a thanks message to the client when they provide their email address.

## Code

### Jade_delight.php(php & html)

```php+HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jade Delight</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
</head>

<body>
<!-- use the php to get the name and prices in the database-->
<?php
	$items = array();

	//Establish connecction info
	$server = "sql204.epizy.com";
	$userid = "epiz_27905924";
	$pw = "bMoFMy4qPKwwG";
	$db = "epiz_27905924_Jade_delight";

	//Create connection
	$conn = new mysqli($server, $userid, $pw);

	//Check connection
	if ($conn->connect_error){
		die("Connection failed:".$conn->connect_error);
	}

	//Select database
	$conn->select_db($db);

	//run a query
	$sql = "SELECT * FROM `Item&price`";
	$result = $conn->query($sql);

	//get result
	if ($result->num_rows>0){
		while ($row = $result->fetch_assoc()){
			$items[] = $row;
		}
	} else {
		echo "no results";
	}
	
?>
<script language="javascript">
function MenuItem(name, cost)
{
	this.name = name;
	this.cost=cost;
}

menuItems = new Array(
	new MenuItem("<?php echo $items[0]['Name']; ?>", <?php echo $items[0]['Price']; ?>),
	new MenuItem("<?php echo $items[1]['Name']; ?>", <?php echo $items[1]['Price']; ?>),
	new MenuItem("<?php echo $items[2]['Name']; ?>", <?php echo $items[2]['Price']; ?>),
	new MenuItem("<?php echo $items[3]['Name']; ?>", <?php echo $items[3]['Price']; ?>),
	new MenuItem("<?php echo $items[4]['Name']; ?>", <?php echo $items[4]['Price']; ?>),
);

function makeSelect(name, minRange, maxRange)
{
	var t= "";
	t = "<select name='" + name + "' size='1'>";
	for (j=minRange; j<=maxRange; j++)
	   t += "<option>" + j + "</option>";
	t+= "</select>"; 
	return t;
}
</script>
<div class = "block">
<h1>Jade Delight</h1>
<form method='get' onsubmit="return order()" action='http://comp20.great-site.net/Assignment13/process.php'>

<div id = "information">
<p>First Name: <input type="text"  name='fname'/></p>
<p>Last Name*:  <input type="text"  name='lname'/><div id="errName" class="errMsg">Last Name is required</div></p>

<p>Email*: <input type="text"  name='email'/>
	<div id="errEmail" class="errMsg">Email is required</div>
	<div id="invalidEmail" class="errMsg">Email is not valid</div>
</p>

<p>Phone*: <input type="text"  name='phone'/>
	<div id="errPhone" class="errMsg">Phone number is required</div>
	<div id="invalidPhone" class="errMsg">Phone number is not valid</div>
</p>
<p>Please enter the phone number directly. Example: "9999999999"</p>
<p> 
	<input type="radio"  name="p_or_d" value = "pickup" checked="checked"/>Pickup  
	<input type="radio"  name='p_or_d' value = 'delivery'/>
	Delivery
</p>

<div id = "address">
<p>Street: <input type="text"  name='street' /><div id="errStreet" class="errMsg">Street is required</div></p>
<p>City: <input type="text"  name='city' /><div id="errCity" class="errMsg">City is required</div></p>
</div>

</div>

<div id = "order">
<table border="0" cellpadding="3">
  <tr>
    <th>Select Item</th>
    <th>Item Name</th>
    <th>Cost Each</th>
    <th>Total Cost</th>
  </tr>
<script language="javascript">

  var s = "";
  for (i=0; i< menuItems.length; i++)
  {
	  s += "<tr><td>";
	  s += makeSelect("quan" + i, 0, 10);
	  s += "</td><td>" + menuItems[i].name + "</td>";
	  s += "<td> $ " + menuItems[i].cost.toFixed(2) + "</td>";
	  s += "<td>$<input type='text' name='cost'/></td></tr>";
  }
  document.writeln(s);
</script>
</table>
<p>Subtotal: $ <input type="text"  name='subtotal' id="subtotal" />
</p>
<p>Mass tax 6.25%:
  $ <input type="text"  name='tax' id="tax" />
</p>
<p>Total: $ <input type="text"  name='total' id="total" />
</p>

<input type = "submit" value = "Submit Order" />
</div>
</div>

<script language = "javascript">
	//global variables
	var quantity = [0, 0, 0, 0, 0];
	var price = [0, 0, 0, 0, 0];
	var deliverTime = "";
	var orderTime = "";
	
	// set the error messages invisible
	document.getElementById("errName").style.display = "none";
	document.getElementById('invalidPhone').style.display = "none";
	document.getElementById('errPhone').style.display = "none";
	document.getElementById('invalidEmail').style.display = "none";
	document.getElementById('errEmail').style.display = "none";
	document.getElementById('errCity').style.display = "none";
	document.getElementById('errStreet').style.display = "none";

	// automatically update the cost, subtotal, tax, and the total
	// while the user enters the quantity
	for (i = 0; i < menuItems.length; i ++){
		$('select[name = quan' + i + ']')[0].onchange = function(){
			i = this.name.substring(4);
			quantity[i] = this.selectedIndex; //
			price[i] = menuItems[i].cost;
			$('input[name = cost]')[i].value = (price[i] * quantity[i]).toFixed(2);
			calTotal();
		};
	}

	// return true if the user pickup, false otherwise
	function choosePickup(){
		deliveryType = $('input[name = p_or_d]:checked').val();
		if (deliveryType == 'pickup'){
			return true;
		} else {
			return false;
		}
	}

	// if the user choose pickup
	$('input[name = p_or_d]')[0].onchange = function(){
		if (choosePickup()){
			document.getElementById("address").style.display = "none";
		} 
	}
	// if the user choose delivery
	$('input[name = p_or_d]')[1].onchange = function(){
		if (!choosePickup()){
			document.getElementById("address").style.display = "block";
		}
	}

	// calculate the subtotal, tax and the total
	function calTotal(){
		subtotal = calSubtotal();
		$('input[name = subtotal]')[0].value = subtotal.toFixed(2);
		tax = subtotal * 0.0625;
		$('input[name = tax]')[0].value = tax.toFixed(2);
		$('input[name = total]')[0].value = (tax + subtotal).toFixed(2);
	}
		
	// calculate the subtotal
	function calSubtotal(){
		var subtotal = 0;
		for (i = 0; i < menuItems.length; i ++){
			subtotal += price[i] * quantity[i];
		}
		return subtotal;
	}

	// make the order
	function order(){
		informationValid = ensureInformation();
		ordered = orderSomething();
		// if the information is valid and at least order one thing
		if (informationValid && ordered){
			return true;
		} else {
			return false;
		}
	}

	// ensure the last name and the phone number is entered
	function ensureInformation(){
		nameValid = lastName();
		phoneValid = phoneNumber();
		emailValid = emailAddress();
		addressValid = address();
		if(nameValid && phoneValid && addressValid){
			return true;
		}else{
			return false;
		}
	}

	// ensure the last name is entered, if not, send the error messages
	function lastName(){
		document.getElementById('errName').style.display = "none";
		lname = $("input[name = lname]").val();
		if (lname.length == 0){
			document.getElementById('errName').style.display = "inline-block";
			return false;
		} else {
			return true;
		}
	}

	// ensure the phone number is entered and valid, if not, send the error messages
	function phoneNumber(){
		document.getElementById('invalidPhone').style.display = "none";
		document.getElementById('errPhone').style.display = "none";
		phone = $("input[name = phone]").val();
		if (phone.length != 0){
			number = parseInt(phone);
			if(!Number.isInteger(number) || number < 1000000000 || number >= 10000000000){
				document.getElementById('invalidPhone').style.display = "inline-block";
				return false;
			}
			return true;
		} else {
			document.getElementById('errPhone').style.display = "inline-block";
			return false;
		}
	}
	
	function emailAddress(){
		document.getElementById('invalidEmail').style.display = "none";
		document.getElementById('errEmail').style.display = "none";
		email = $("input[name = email]").val();
		if (email.length != 0){
			if(!validateEmail(email)){
				document.getElementById('invalidEmail').style.display = "inline-block";
				return false;
			}
			return true;
		} else {
			document.getElementById('errEmail').style.display = "inline-block";
			return false;
		}
	}
	
	function validateEmail(email) {
	  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}


	// ensure the user at least order one thing
	function orderSomething(){
		amount = 0;
		for (i=0; i< menuItems.length; i++){
			amount += quantity[i];
		}
		if(amount > 0){
			return true;
		} else {
			alert("You have not ordered anything!")
			return false;
		}
	}

	// ensure the address is entered if the user choose deliver
	function address(){
		document.getElementById('errStreet').style.display = "none";
		document.getElementById('errCity').style.display = "none";
		
		if(choosePickup()){
			return true;
		} else {
			streetMissing = false;
			cityMissing = false;
			street = $("input[name = street]").val();
			city = $("input[name = city]").val();

			if (street.length == 0){
				document.getElementById('errStreet').style.display = "inline-block";
				streetMissing = true;
			}

			if (city.length == 0){
				document.getElementById('errCity').style.display = "inline-block";
				cityMissing = true;
			} 

			if(cityMissing || streetMissing){
				return false;
			} else {
				return true;
			}
		}
	}
</script>
</form>
</body>
</html>
```



### process.php (php)

```php+HTML
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Receipt</title>
<link rel="stylesheet" href="style.css">
<style>
	table {
		text-align: left;
		border: 1px solid #000000;
		margin: 1%;
		width: 97%;
	}
	
	body {
		background-color:#FFFFFF;
	}
	
	h1 {
		font-size: 40px;
		margin-left: 1%;
	}
	
	h2 {
		font-size: 30px;
		margin-left: 1%;
	}
</style>
</head>

<body>	
	<?php
	//declare the items as an array
	$items = array();
	
	//add the message and the title to the string
	$str = "<h1>Thank you for your order!</h1>";
	$str .= "<h2>Order Status:</h2>";
	
	//get client information
	$name = $_GET['fname'];
	$name .= " ".$_GET['lname'];
	$phone = $_GET['phone'];
	$email = $_GET['email'];
	$address = $_GET['street'];
	$address .= ", ".$_GET['city'];
	

	//add client information to the output string
	$str .= "<table cellpadding='4'>
	<tr>
		<th>Name: </th>
		<td>$name</td>
	</tr>
	<tr>
		<th>Email: </th>
		<td>$email</td>
	</tr>
	<tr>
		<th>Phone Number: </th>
		<td>$phone</td>
	</tr>";

	// if the client select the delivery, calcualte delivery time, 
	// else, calculate the pickup time
	$type = $_GET['p_or_d'];
	$time = getTime($type);
	if ($type == "delivery") {
		$str .= "<tr>
					<th>Type: </th>
					<td>Delivery</td>
				</tr>
				<tr>
					<th>Address: </th>
					<td>$address</td>
				</tr>
				<tr>
					<th>Delivery Time: </th>
					<td>$time</td>
				</tr>";
	} else {
		$str .= "<tr>
					<th>Type: </th>
					<td>Pickup</td>
				</tr>
				<tr>
					<th>Pickup Time: </th>
					<td>$time</td>
				</tr>";
	}
	
	$str .= "</table>";
	
	//add the table header
	$str .= "<table border='0' cellpadding='4'>
		<tr>	
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Cost Each</th>			
			<th>Total Cost</th>
		</tr>";
	
	$menuItems = getItems();
	
	// add the name, price, quantity, and the total cost of the items
	for ($i=0; $i< count($menuItems); $i++)
	{
		if (readQuantity($i) > 0){
			$name = $menuItems[$i]["Name"];
			$price = $menuItems[$i]["Price"];
			$pricef = number_format((float)$price, 2, '.', '');
			$quantity = readQuantity($i);
			$cost = $price * $quantity;
			$costf = number_format((float)$cost, 2, '.', '');		
			
			$str .= "<tr><td>$name</td>";
			$str .= "<td>$quantity</td>";		
			$str .= "<td> $ $pricef </td>";
			$str .= "<td>$costf</td></tr>";
		}
		
	}
	
	$str .="</table>";

	// add the subtotal, tax, and the total
	$subtotal .= $_GET['subtotal'];
	$tax .= $_GET['tax'];
	$total .= $_GET['total'];
	
	$str .= "<table><tr><th>Subtotal:</th><td> $ $subtotal</td></tr>
		<tr><th>Mass tax 6.25%:</th><td> $ $tax</td></tr>
		<tr><th>Total:</th><td> $ $total</td></tr></table>";

	//print the string
	echo $str;
	
	//mail to the client
	mail($email, "Receipt", $str);

	//the function that returns a menu of items including the names and the prices
	function getItems(){
		//Establish connecction info
		$server = "sql204.epizy.com";
		$userid = "epiz_27905924";
		$pw = "bMoFMy4qPKwwG";
		$db = "epiz_27905924_Jade_delight";

		//Create connection
		$conn = new mysqli($server, $userid, $pw);

		//Check connection
		if ($conn->connect_error){
			die("Connection failed:".$conn->connect_error);
		}

		//Select database
		$conn->select_db($db);

		//run a query
		$sql = "SELECT * FROM `Item&price`";
		$result = $conn->query($sql);

		//get result
		if ($result->num_rows>0){
			while ($row = $result->fetch_assoc()){
				$items[] = $row;
			}
		} else {
			echo "no results";
		}
		return $items;
	}

	// the function to read the quantity of the selected item
	function readQuantity($i){
		$selectName = "quan".$i;
		$quantity = $_GET[$selectName];
		return $quantity;
	}

	// the function that calculate the delivery/pickup time
	function getTime($type){
		if ($type = 'delivery'){
			$time = "<script language='javascript'>		
						var d = new Date();
						d.setMinutes(d.getMinutes() + 30);
						document.write( d.getDate() + '/'
								+ (d.getMonth()+1)  + '/' 
								+ d.getFullYear() + '@'  
								+ pad2(d.getHours()) + ':'
								+ pad2(d.getMinutes()) + ':'
								+ pad2(d.getSeconds()));
						function pad2(number) {
							return (number < 10 ? '0' : '') + number
						}
				</script>";
			return $time;
		} else {
			$time = "<script language='javascript'>		
						var d = new Date();
						d.setMinutes(d.getMinutes() + 15);
						document.write(d.getDate() + '/'
								+ (d.getMonth()+1)  + '/' 
								+ d.getFullYear() + '@'  
								+ pad2(d.getHours()) + ':'
								+ pad2(d.getMinutes()) + ':'
								+ pad2(d.getSeconds()));
						function pad2(number) {
							return (number < 10 ? '0' : '') + number
						}
				</script>";
			return $time;
		}
	}
    ?>
</body>
</html>
```



### style.css

```css
@charset "utf-8";
/* CSS Document */

*{
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
}

#address{
	display:none;
}

.errMsg {
    color: #D20E11; 
    border: solid 1px #d20e11; 
    padding: 1px 15px;
}

body {
	width: 70%;
	background: #686868;
	border: 5px #000000 solid;
	margin: auto;
	padding: 1%;
}

.block{
	background-color: #FFFFFF;
	padding: 5%;
}

h1{
	padding: 5px;
	text-decoration: underline;
	font-size: 50px;
	margin-top: 50px;
}

#information {
	border: 2px #000000 solid;
	padding: 0 3%;
}

#order {
	border: 2px #000000 solid;
	padding: 1% 3%;
	margin-top: 3%;
}

button {
	border:2px solid #000000;
	padding: 1%;
	font-weight: bold;
	margin-top:1%;
}

button:hover {
	border: 2px solid #FFFFFF;
}

input[type=text]{
	border: 2px #000000 solid;
}

select {
	border: 2px #000000 solid;
}

input[type=button]{
	margin-top: 2%;
	margin-bottom: 3%;
	border: 4px #000000 solid;
	background-color: #C2C2C2;
	padding: 5px;
	font-size: 20px;
}

input[type=button]:hover{
	border: 4px #000000 solid;
	background-color: #000000;
	color: #FFFFFF;
	padding: 5px;
}
```

