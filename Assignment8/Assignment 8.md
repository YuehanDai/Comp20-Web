# Assignment 8: Jade Delight

Student Name: Yuehan Dai

CS login: ydai05

## URL



## Code

### HTML

```html
<p>First Name: <input type="text"  name='fname'/></p>
<p>Last Name*:  <input type="text"  name='lname'/><div id="errName" class="errMsg">Last Name is required</div></p>


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

<p>Street: <input type="text"  name='street' /><div id="errStreet" class="errMsg">Street is required</div></p>
<p>City: <input type="text"  name='city' /><div id="errCity" class="errMsg">City is required</div></p>
```

```html
<input type = "button" onclick = "order()" value = "Submit Order" />
```

```html
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
			print();
		}
	}

	// ensure the last name and the phone number is entered
	function ensureInformation(){
		nameValid = lastName();
		phoneValid = phoneNumber();
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

	// calculate the deliver time
	function calcDeliverTime(){
		var d = new Date();
		if ($('input[name = p_or_d]:checked').val() == 'pickup'){
			d.setMinutes(d.getMinutes() + 15);
		} else {
			d.setMinutes(d.getMinutes() + 30);
		}
		deliverTime = "<strong>Expected Deliver Time</strong>: " + d.getDate() + "/"
                + (d.getMonth()+1)  + "/" 
                + d.getFullYear() + " @ "  
                + pad2(d.getHours()) + ":"  
                + pad2(d.getMinutes()) + ":" 
                + pad2(d.getSeconds());
	}
	
	// calculate the order time: adding a preceding 0 to 1 digit number
	function calcOrderTime(){
		var d = new Date();
		orderTime = "<strong>Order Time</strong>: " + d.getDate() + "/"
                + (d.getMonth()+1)  + "/" 
                + d.getFullYear() + " @ "  
                + pad2(d.getHours()) + ":"  
                + pad2(d.getMinutes()) + ":" 
                + pad2(d.getSeconds());
	}

	// helper function for time display
	function pad2(number) {
   		return (number < 10 ? '0' : '') + number
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

	function print(){
		var myWindow = window.open("", "order", "width=400, height=300");
		myWindow.document.write(thanksMessage());
		myWindow.document.write(titleMessage());
		printInformation();
		printOrder();
		printTotal();
		printTime();
	}

	function thanksMessage(){
		var message = "<h1>";
		message += "Thank you for your order!"
		message += "</h1>";
		return message;
		
	}

	function titleMessage(){
		var message = "<h2>";
		message += "Order Status:"
		message += "</h2>";
		return message;
	}

	function printInformation(){
		var myWindow = window.open("", "order", "width=400, height=300");
		message = "";
		message += nameInformation();
		message += deliveryInformation();
		myWindow.document.write(message);
	}

	function nameInformation(){
		var message = "";
		if ($('input[name = fname]').val().length != 0){
			message += "<strong>Customer Name</strong>: ";
			message += $('input[name = fname]').val() + " ";
			message += $('input[name = lname]').val();
			message += "<br>";
		} else {
			message += "<strong>Customer Name</strong>: ";
			message += $('input[name = lname]').val();
			message += "<br>";
		}
		return message;
	}

	function deliveryInformation(){
		var message = "<strong>Delivery Type</strong>: ";
		if (choosePickup()){
			message += "Pickup";
			message += "<br>";
		} else {
			street = $("input[name = street]").val();
			city = $("input[name = city]").val();
			message += "Delivery";
			message += "<br>";
			message += "<strong>Delivery Address</strong>: ";
			message += street + ", ";
			message += city + "<br>";
		}
		return message + "<br>";
	}

	function printOrder(){
		var myWindow = window.open("", "order", "width=400, height=300");
		message = "<table border='0' cellpadding='3'>";
		message += headers();
		message += items();
		message += "</table>";
		myWindow.document.write(message + "<br>");
	}

	function headers(){
		message = " <tr><th>Select Item</th><th>Item Name</th><th>Cost Each</th><th>Total Cost</th></tr>"
		return message;
	}

	function items(){
		var s = "";
		for (i=0; i< menuItems.length; i++)
		{
			if(quantity[i] != 0){
				s += "<tr><td>";
				s += quantity[i];
				s += "</td><td>" + menuItems[i].name + "</td>";
				s += "<td> $ " + menuItems[i].cost.toFixed(2) + "</td>";
				s += "<td>" + (quantity[i] * price[i]).toFixed(2) + "</td></tr>";
			}
		}
		return s;
	}

	function printTotal(){
		var myWindow = window.open("", "order", "width=400, height=300");
		subtotal = calSubtotal();
		tax = subtotal * 0.0625;
		total = subtotal + tax;
		message = "";
		message += "<strong>Subtotal</strong>: ";
		message += subtotal.toFixed(2) + "<br>";
		message += "<strong>Tax</strong>: ";
		message += tax.toFixed(2) + "<br>";
		message += "<strong>Total</strong>: ";
		message += total.toFixed(2) + "<br>";

		myWindow.document.write(message);
	}

	// print the time
	function printTime(){
		calcDeliverTime();
		calcOrderTime();
		var myWindow = window.open("", "order", "width=400, height=600");
		myWindow.document.write(deliverTime + "<br>");
		myWindow.document.write(orderTime + "<br>");
	}

	function calTotal(){
		subtotal = calSubtotal();
		$('input[name = subtotal]')[0].value = subtotal.toFixed(2);
		tax = subtotal * 0.0625;
		$('input[name = tax]')[0].value = tax.toFixed(2);
		$('input[name = total]')[0].value = (tax + subtotal).toFixed(2);
	}

</script>

```



### CSS

```css
@charset "utf-8";
/* CSS Document */

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
	margin-top: 50px;
}

.block{
	background-color: #FFFFFF;
	padding: 5%;
}

h1{
	padding: 5px;
	text-decoration: underline;
	font-size: 50px;
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

