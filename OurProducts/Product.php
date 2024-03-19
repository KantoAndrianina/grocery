<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con, "SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
$categorie = $_GET['categorie']; 
function getCategorieColor($categorie, $currentCategorie) {
    if ($categorie === $currentCategorie) {
        return '#24bfae'; 
    } else {
        return '#e6b7b8'; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $categorie ?></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="Product.php?categorie=noodles" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'noodles'); ?>;border-radius: 12px;">Noodles&Canned</a>
				</th>
				<th><a href="Product.php?categorie=seasoning" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'seasoning'); ?>;border-radius: 12px;">Seasonings</a></th>
				<th><a href="Product.php?categorie=drink" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'drink'); ?>;border-radius: 12px;">Drinks</a></th>
				<th><a href="Product.php?categorie=snack" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'snack'); ?>;border-radius: 12px;">Snacks</a></th>
				<th><a href="Product.php?categorie=sweet" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'sweet'); ?>;border-radius: 12px;">Sweets</a></th>
				<th><a href="Product.php?categorie=soap" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'soap'); ?>;border-radius: 12px;">Soap&Detergent</a></th>
				<th><a href="Product.php?categorie=shampoo" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'shampoo'); ?>;border-radius: 12px;">Shampoo</a></th>
				<th><a href="Product.php?categorie=hygiene" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: <?php echo getCategorieColor($categorie, 'hygiene'); ?>;border-radius: 12px;">Hygiene</a></th>
			</tr>
		</table>
	</div>
	<div style="padding: 15px 0px; font-size: 15px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
            $sql = "SELECT * FROM products WHERE available >='1' AND item ='" . $categorie . "'  ORDER BY id DESC LIMIT 10";
            // echo $sql;
			$getposts = mysqli_query($con, $sql) or die(mysqlI_error($con));
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="../image/product/'.$categorie.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Php</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
		?>
			
		</div>
	</div>
</body>
</html>