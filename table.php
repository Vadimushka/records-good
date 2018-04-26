<?php
include_once "sys/inc/start.php";

$q = $db->prepare("SELECT * FROM `list_products` WHERE `id_storehouse` = ?");
$q->execute(array($_REQUEST['id']));

if($res = $q->fetchAll()) { ?>
<table class="storehouse table-stripeclass:alternate" id="table">
	<thead>
		<tr>
			<th><span>№ записи</span></th>
			<th><span>Наименование</span></th>
			<th><span>Цена товара</span></th>
			<th><span>Количество товара</span></th>
			<th><span>Код товара</span></th>
			<?php if($_SESSION['admin']){ ?>
			<th class="nosort">Действия</th>
			<?php } ?>
		</tr>
	</thead>
	<tfoot style="margin-top: 20px;">
		<tr style="border: none;">
			<th colspan="6" style="height: 25px; border-left: none;"></th>
		</tr>
		<tr>
			<th colspan="6"><h3 style="margin-bottom: 0px">Фильтрация</h3></th>
		</tr>
		<tr>
			<th></th>
			<th><input name="filter" style="width:127px; height: 25px;" onkeyup="Table.filter(this, this);" placeholder="Наименование"></th>
			<th><input name="filter" style="width:108px; height: 25px;" onkeyup="Table.filter(this, this);" placeholder="Цена товара"></th>
			<th></th>
			<th><input name="filter" style="width:108px; height: 25px;" onkeyup="Table.filter(this, this);" placeholder="Код товара"></th>
			<?php if($_SESSION['admin']){ ?>
			<th></th>
			<?php } ?>
		</tr>
	</tfoot>
	<tbody><?php foreach($res as $item){ ?>
		<tr id="record<?echo $item['id']?>">
			<td><?echo $item['id']?></td>
			<td><?echo $item['name']?></td>
			<td><?echo $item['price']?> руб.</td>
			<td><?echo $item['amount']?> шт.</td>
			<td><?echo $item['id_goods']?></td>
			<?php if($_SESSION['admin']){ ?>
			<td>
				<?php if($_REQUEST['id'] == 1 && $_SESSION['group'] == 2) {?>
				<a href="records.operation.php?operation=delete&id=<?echo $item['id']?>"><i title="Удалить" class="fa fa-trash-o"></i></a>
				<?php } else {?>
				<a href="records.operation.php?operation=archive&id=<?echo $item['id']?>"><i title="Архивировать" class="fa fa-archive"></i></a>
				<?php } ?>
				<a href="records.operation.php?operation=update&id=<?echo $item['id']?>"><i title="Редактировать" class="fa fa-pencil"></i></a>
			</td>
			<?php } ?>
		</tr><?php } ?>
	</tbody>
</table>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
	var sorter = new TINY.table.sorter("sorter");
	sorter.head = "fa fa-sort";
	sorter.asc = "fa fa-sort-asc";	
	sorter.desc = "fa fa-sort-desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",0);
</script>
<? } else { ?>
	<div>Товаров на текущем складе нет...</div>
<? } ?>
<style>
	#storehouse<?php echo $_REQUEST['id'] ?> {
		color: red;
	}
</style>