<?

if($_POST['create_storehouse']){
	$name = $_POST['name'];
		
	$q = $db->prepare("INSERT INTO `storehouse` (`name`) VALUES (?)");
	$q->execute(array($name));
	header("Location: /records.php");
	exit;
}

if($_POST['delete_storehouse']){
	if(isset($_POST['delete_all_storehouse'])){
		$url = "Location: http://{$_SERVER['HTTP_HOST']}/records.operation.php?operation=delete_storehouse";
		header($url);
		exit;
	}
	$id_storehouse = $_POST['id_storehouse'];
		
	$q = $db->prepare("DELETE FROM `storehouse` WHERE `id` = ? ");
	$q->execute(array($id_storehouse));
	header("Location: /records.php");
	exit;
}

if($_POST['create_products']){
	$id_storehouse = $_POST['id_storehouse'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$amount = $_POST['amount'];
	$id_goods = $_POST['id_goods'];
		
	$q = $db->prepare("INSERT INTO `list_products` (`id_storehouse`, `name`, `price`, `amount`, `id_goods`) VALUES (?, ?, ?, ?, ?)");
	$q->execute(array($id_storehouse, $name, $price, $amount, $id_goods));
	header("Location: /records.php");
	exit;
}

if($_POST['create_user']){
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $res = $db->prepare("SELECT * FROM `users` WHERE login = ?");
        $res->execute(array($login));
        if (!$res->fetch()) {
            if($_POST['group']){
                if (empty($_POST['password'])) {
                    echo "<script>alert('Необходимо указать пароль');</script>";
                }
                if (empty($_POST['password_retry'])) {
                    echo "<script>alert('Необходимо подтвердить пароль');</script>";
                }
                if ($_POST['password_retry'] != $_POST['password']) {
                    echo "<script>alert('Введенные пароли не совпадают');</script>";
                }

                $res = $db->prepare("INSERT INTO `users` (`group`, `login`, `password`) VALUES (?, ?, ?)");
                $res->execute(Array($_POST['group'], $login , pass_hash($_POST['password'])));

               header("Location: /");
            }
        } else {
            echo "<script>alert('Логин занят другим модератором');</script>";

        }
    }
    exit;
}

if($_POST['delete_user']){
    $name = $_POST['name'];
        
    $q = $db->prepare("INSERT INTO `storehouse` (`name`) VALUES (?)");
    $q->execute(array($name));
    header("Location: /records.php");
    exit;
}
