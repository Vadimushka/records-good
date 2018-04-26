<?php if($_SESSION['group'] == 2): ?>
<div class="modal">
    <input class="modal-open" id="modal-create_user" type="checkbox" hidden>
    <div class="modal-wrap" aria-hidden="true" role="dialog">
        <label class="modal-overlay" for="modal-create_user"></label>
        <div class="modal-dialog">
            <div class="modal-header">
                <h2>Создание модераторов</h2>
                <label class="btnModal-close" for="modal-create_user" aria-hidden="true">×</label>
            </div>
            <div class="modal-body">
                <form method="post">
                    <label>
                        <input type="text" name="login" class="textbox" placeholder="* Логин" required>
                    </label>
                    <label>
                        <input type="password" name="password" class="textbox" placeholder="* Пароль" required>
                    </label>
                    <label>
                        <input type="password" name="password_retry" class="textbox" placeholder="* Повторите пароль" required>
                    </label>
                    <input type="hidden" name="group" value="1">
                    <input name="create_user" class="btnModal btnModal-form" type="submit" value="Отправить" />
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal">
    <input class="modal-open" id="modal-delete_user" type="checkbox" hidden>
    <div class="modal-wrap" aria-hidden="true" role="dialog">
        <label class="modal-overlay" for="modal-delete_user"></label>
        <div class="modal-dialog">
            <div class="modal-header">
                <h2>Удаление модераторов</h2>
                <label class="btnModal-close" for="modal-delete_user" aria-hidden="true">×</label>
            </div>
            <div class="modal-body">
                <table class="storehouse">
                    <thead>
                    <tr>
                    <th>№</th>
                    <th>Логин</th>
                    <th>Действия</th>
                    </tr>
                    </thead>

                    <tbody><?php
                        $q = $db->prepare("SELECT * FROM `users`");
                        $q->execute();
        
                        if($res = $q->fetchAll()){
                            foreach($res as $user) { ?>
                                <tr>
                                <td><?echo $user['id']?></td>
                                <td><?echo $user['login']?></td>
                                <td>
                                    <a href=""><i title="Редактировать" class="fa fa-pencil"></i></a>
                                    <a href=""><i title="Удалить" class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                           <? }

                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<? endif; ?>