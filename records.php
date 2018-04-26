<?php 
include_once "sys/inc/start.php";

$js = array();
foreach($db->query('SELECT * FROM `storehouse` ORDER BY `id` DESC') as $row){ 
	$js[] = <<<EOT
	$('#storehouse{$row['id']}').click(function(){
		$.ajax({
			url: "table.php?id={$row['id']}",
			cache: false,
			success: function(html){
				$("#content").html(html);
			}
		});
	});
EOT;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="На этом сайте вы можете вести учет товаров для строительного склада..">
    <title>Просмотр склада.</title>
    <link type="text/css" rel="stylesheet" href="css/main.css" >
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/table.js"></script>
	<link type="text/css" rel="stylesheet" href="css/modal.css" >
	<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" >
	<script type="text/javascript">
		$(document).ready(function(){
			<? foreach ($js as $js_value) {
				print($js_value);
			} ?>
		 });
	</script>
</head>
<body>

<? include_once "sys/tpl/header.php"; ?>

<section class="row">
    <div class="grid" style="width: 90%; margin-top: 20px">
    	<section class="col-1-3" style="width: 20%">
            <? if($_SESSION['admin']){ ?>
            <h2>Действия</h2>
            <ul class="why-attend">
            	<? if ($_SESSION['group'] == 2){ ?>
            	<li><label title="Создать склад" for="modal-create_storehouse" class="sort_key">Cоздать склад</label></li>
            	<li><label title="Удалить склад" for="modal-delete_storehouse" class="sort_key">Удалить склад</label></li>
            	<? } ?>
            	<li><label title="Создать товар" for="modal-create_products" class="sort_key">Создать товар</label></li>
            </ul>
			<?php } ?>

            <h2>Список складов</h2>

            <ul class="why-attend">
            <?php foreach($db->query('SELECT * FROM `storehouse` ORDER BY `id` DESC') as $row){ ?>
                <? if(!($_SESSION['group'] == 2) && ($row['id'] == 1)) { continue;} ?>
				<li><span id="storehouse<? echo $row['id']?>" type="button" class="sort_key"><? echo $row['name']?></span> </li>
			<?php } ?>
			</ul>
        </section><!--
      --><section class="col-2-3" style="width: 80%">
            <div id="content">Вы еще не выбрали склад..</div>
        </section>
    </div>
</section>

<? include_once "sys/tpl/footer.php"; ?>
<? include_once "sys/tpl/records-modal.php"; ?>

</body>
</html>