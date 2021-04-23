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
		if ($type == 'delivery'){
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