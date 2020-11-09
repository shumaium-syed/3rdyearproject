<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Now</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    
</head>
<body>

    <nav id="navigation">
        <div class="container">
            <div class="logo">
                <i class="fas fa-birthday-cake text-white"></i>
                Butter<span>N</span>Cream
            </div>
            <ul>
                <li>
                    <a href="index.php" >
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="about.php">
                        <i class="fas fa-info-circle"></i>
                        About
                    </a>
                </li>
                <li>
                     <a href="cart.php" class="sel">
                         <i class="fas fa-store"></i>
                         Shop
                    </a>
                 </li>
                 <li>
                     <a href="contact.php">
                        <i class="fas fa-phone"></i>
                        Contact
                    </a>
                     
                 </li>
                
            </ul>
        </div>
     </nav>

     <div class="showcase">
        <div class="showcase-content w-75 mx-auto">
            <h1>
                PRODUCT CATALOG
            </h1>
            <div class="bottom-line mx-auto"></div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos porro, dolore sunt magnam impedit ducimus architecto consectetur non inventore dolor, placeat sequi, commodi nam similique reiciendis quaerat error. Dicta, magnam?
            </p>
        </div>
     </div>

     <div id="home-a" class="p-3 my-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h1>
                        WHY SHOP HERE
                    </h1>
                    <div class="bottom-line"></div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque perspiciatis omnis similique expedita ipsa quidem nostrum ratione rerum totam suscipit, sint ullam beatae odit magni velit deleniti, earum dolorem blanditiis.
                        <br><br>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum, omnis!
                    </p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="assets/img/cupcake.jpg" alt="">
                </div>
            </div>
        </div>
    </div>


<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>


<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart table">
<tbody>
<tr>
<th>Name</th>
<th>Code</th>
<th>Quantity</th>
<th>Unit Price</th>
<th>Price</th>
<th >Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /></td>
				<td><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td ><?php echo "PKR ".$item["price"]; ?></td>
				<td ><?php echo "PKR ". number_format($item_price,2); ?></td>
				<td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "PKR ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty, Add Items To Your Cart</div>
<?php 
}
?>
<h2 class="text-center font-weight-bold">Buy Now</h2>
        <div class="bottom-line mx-auto"></div><br>
<div id="product-grid">


	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "PKR ".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>



<footer>
        <div class="container">
            <div class="">
                Copyright &copy; All rights reserved by ButterNCream.
				</div>
            <div class="">
            <a href="http://www.facebook.com"><i class="fab fa-facebook"></i></a>
            <a href="http://www.twitter.com"> <i class="fab fa-twitter"></i></a>
           <a href="http://www.instagram.com"><i class="fab fa-instagram"></i></a> 
            <a href="http://www.linkedin.com"><i class="fab fa-linkedin"></i></a>    
            </div>
        </div>
    </footer>



    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/jquery.superslides.min.js"></script>
	<script src="assets/js/typed.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/isotope-layout@3.0.5/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>