<? if($_SESSION['group'] == 2): ?>
<div class="modal">
	<input class="modal-open" id="modal-create_storehouse" type="checkbox" hidden>
	<div class="modal-wrap" aria-hidden="true" role="dialog">
		<label class="modal-overlay" for="modal-create_storehouse"></label>
		<div class="modal-dialog">
			<div class="modal-header">
				<h2>Создание склада</h2>
				<label class="btnModal-close" for="modal-create_storehouse" aria-hidden="true">×</label>
			</div>
			<div class="modal-body">
				<form method="post">
					<label>
						<input type="text" name="name" class="textbox" placeholder="* Название склада" required>
					</label>

					<input name="create_storehouse" class="btnModal btnModal-form" type="submit" value="Отправить" />
				</form>
				<div>
					<span><i style="color: red">*</i> - Обязательны для заполнения</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal">
	<input class="modal-open" id="modal-delete_storehouse" type="checkbox" hidden>
	<div class="modal-wrap" aria-hidden="true" role="dialog">
		<label class="modal-overlay" for="modal-delete_storehouse"></label>
		<div class="modal-dialog">
			<div class="modal-header">
				<h2>Удаление склада</h2>
				<label class="btnModal-close" for="modal-delete_storehouse" aria-hidden="true">×</label>
			</div>
			<div class="modal-body">
				<form method="post">
					<label>
						<select class="textbox" name="id_storehouse">
							<option disabled selected>Тип склада</option>
							<?php 
							foreach($db->query('SELECT * FROM `storehouse`') as $row){
								if($row['id'] != 1){
									echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
								}
							}
							?>
						</select>
					</label>
					<label>
						<input type="checkbox" name="delete_all_storehouse"> Удалить все склады
					</label>

					<input name="delete_storehouse" class="btnModal btnModal-form" type="submit" value="Отправить" />
				</form>
			</div>
		</div>
	</div>
</div>
<? endif; if($_SESSION['admin']): ?>
<div class="modal">
	<input class="modal-open" id="modal-create_products" type="checkbox" hidden>
	<div class="modal-wrap" aria-hidden="true" role="dialog">
		<label class="modal-overlay" for="modal-create_products"></label>
		<div class="modal-dialog">
			<div class="modal-header">
				<h2>Создание товара</h2>
				<label class="btnModal-close" for="modal-create_products" aria-hidden="true">×</label>
			</div>
			<div class="modal-body">
				<form method="post">
					<label>
						<select class="textbox" name="id_storehouse">
							<option disabled selected>Тип склада</option>
							<?php 
							foreach($db->query('SELECT * FROM `storehouse`') as $row){
								if($row['id'] != 1){
									echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
								}
							}
							?>
						</select>
					</label>
					<label>
						<input type="text" name="name" class="textbox" placeholder="* Название товара" required>
					</label>
					<label>
						<input type="text" name="price" class="textbox" placeholder="** Цена товара" required>
					</label>
					<label>
						<input type="text" name="amount" class="textbox" placeholder="* Количество товара" required>
					</label>
					<label>
						<input type="number" name="id_goods" class="textbox" placeholder="* Номер товара" required>
					</label>
					<input name="create_products" class="btnModal btnModal-form" type="submit" value="Отправить" />
				</form>
				<div>
					<span><i style="color: red">*</i> - Обязательны для заполнения</span><br>
					<span><i style="color: red">**</i> - Цена за одну единицу товара</span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;?>