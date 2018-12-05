<?
require_once("php/connect_db.php");

$data = $_POST;

if (isset($data['accept_serv'])) {
	if (!empty($data['serv'])) {
		$service = R::dispense('services');
		$service->name = $data['serv'];
		R::store($service);
	}
}
if (isset($data['accept_cond'])) {
	$tmp = '';
	$cond = R::dispense('conditions');
	switch ($data['b_date']) {
		case 'до':
			$tmp = 0;
			break;
		case 'после':
			$tmp = 1;
			break;
		case 'одновременно':
			$tmp = 2;
			break;
		
		default:
			# code...
			break;
	}
	$cond->id_services = '[' . $data['id_service'] . ']';
	$cond->b_date = $tmp;
	$cond->phone = $data['phone'];
	$cond->gender = $data['gender'];
	$cond->period_active = $data['period_date'];
	$cond->number_phone = $data['num_phone'];
	$cond->discount = $data['discount'];

	R::store($cond);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ADMINKA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<form action="admin.php" method="POST">
		<strong>Создание новой услуги:</strong>
		<input type="text" name="serv" placeholder="Название услуги">

		<input type="submit" name="accept_serv">
	</form>
	<form action="admin.php" method="POST">
		<strong>Создание новых условий:</strong>
		<input type="text" name="id_service" placeholder="Id Services">
		<input type="number" name="phone" placeholder="phone:0/1">
		<input type="number" name="num_phone" placeholder="последние 4 цифры номера">

		<input type="text" name="gender" placeholder="пол: mail/femail">
		<input type="text" name="b_date" placeholder="до\после\одновременно">
		<input type="date" name="period_date">
		<input type="number" name="discount" placeholder="Скидка, число(без процентов)">
		<input type="submit" name="accept_cond">
	</form>
	<hr>
	<table border="1">
		<tr>
			<td>Id</td>
			<td>Название</td>
		</tr>
		<?
		$getServices = R::findAll('services');
		foreach ($getServices as $key => $value) {
			echo '<tr>
			<td>' . $value->id . '</td>
			<td>' . $value->name . '</td>
			</tr>';
		}

		?>
	</table>
	<hr>
	<table border="1">
		<tr>
			<td>Id</td>
			<td>Id_Services[]</td>
			<td>Phone</td>
			<td>Number_phone</td>
			<td>Gender</td>
			<td>B_date</td>
			<td>Discount</td>
			<td>Period_Active</td>
		</tr>
		<?
		$getConditions = R::findAll('conditions');
		foreach ($getConditions as $key => $value) {
			echo '<tr>
			<td>' . $value->id . '</td>
			<td>' . $value->id_services . '</td>
			<td>' . $value->phone . '</td>
			<td>' . $value->number_phone . '</td>
			<td>' . $value->gender . '</td>
			<td>' . $value->b_date . '</td>
			<td>' . $value->discount . '</td>
			<td>' . $value->period_active . '</td>


			</tr>';



		}


		?>
	</table>

</body>
</html>