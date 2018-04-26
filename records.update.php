<?php
include_once "sys/inc/start.php";

if(!$_SESSION['admin']){
	header("Location: records.php");
	exit;
}
$id = $_GET['id'];

$q = $db->prepare("SELECT `id_storehouse`, `name`, `price`, `amount`, `id_goods` FROM `list_products` WHERE `id` = ?");
$q->execute(array($id));

if($_POST['update']){
	if(!empty($_POST['name'])){
		$id_storehouse = $_POST['id_storehouse'];
		$name = $_POST['name'];
		$price = $_POST['price'];
		$amount = $_POST['amount'];
		$id_goods = $_POST['id_goods'];
		
		$q = $db->prepare("UPDATE `list_products`  SET `id_storehouse` = ?, `name` = ?, `price` = ?, `amount` = ?, `id_goods` = ? WHERE `id` = ?");
		$q->execute(array($id_storehouse, $name, $price, $amount, $id_goods, $id));
	}
	header("Location: records.php");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="На этом сайте вы можете вести учет товаров для строительного склада.." />
    <title>Изменение товара</title>
    <link type="text/css" rel="stylesheet" href="css/main.css" />
</head>
<body>

<? include_once "sys/tpl/header.php"; ?>

<section class="row">
    <div class="grid">
	<?php foreach($q->fetchAll() as $qRecord) { ?>
	<form style="width: 460px; margin: 0 auto;" method="post">
		<fieldset class="register-group">
			<label>
				<select name="id_storehouse" style="width:100%">
						<option disabled>Тип склада</option>
					<?php 
					foreach($db->query("SELECT * FROM `storehouse`") as $row){
						if($row['id'] == $qRecord['id_storehouse']){
							echo '<option value="' . $row['id'] . '" selected>' . $row['name'] . '</option>';
						} else {
							echo '<option value="' . $row['id'] . '" >' . $row['name'] . '</option>';
						}
					}?>
				</select>
			</label>
			<label>
				<input type="text" name="name" value="<?php echo $qRecord['name']?>" placeholder="* Название товара" required>
			</label>
			<label>
				<input type="text" name="price" value="<?php echo $qRecord['price']?>" placeholder="** Цена товара" required>
			</label>
			<label>
				<input type="text" name="amount" value="<?php echo $qRecord['amount']?>" placeholder="* Количество товара" required>
			</label>
			<label>
				<input type="number" name="nomer" value="<?php echo $qRecord['id_goods']?>" placeholder="* Номер товара" required>
			</label>
		</fieldset>
		<input name="update" class="btn btn-default" type="submit" value="Изменить" />
	</form>
	<?php } ?>
	
	</div>
</section>

<? include_once "sys/tpl/footer.php"; ?>

</body>
</html>