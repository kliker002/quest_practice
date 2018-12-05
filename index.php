<?php
require_once("php/connect_db.php");

$data = $_GET;

$errors = array();
//echo $data['bdate'];
//$do  = date("d.m", time()-(7*24*60*60)); // предыдущая неделя

//if (strtotime('28.11') < strtotime('1.03')) {echo 'Они совпадают 1111';}
# Одновременно: от $do до $next;
//echo date("Y.m", strtotime($data['bdate']));
//echo date( "Y", strtotime($data['bdate']));
function compareGender($bd_data, $incoming_data)
{
	if ($bd_data->gender == $incoming_data) {
		return true;
	}
}
function checkForDate($get_bdate, $incoming_bdata){
	$do = date("n.j", time()-(7*24*60*60));
	$bith_date = date("n.j", strtotime($incoming_bdata));
	$next  = date("n.j", time()+(7*24*60*60)); // следующая
	$today =date("n.j");
	switch ($get_bdate) {
		case 0:
			//echo 'sss';
			if (strtotime($do) < strtotime($bith_date) && strtotime($today) > strtotime($bith_date)) {
				return true;
			}
			return false;
		case 1:
			if (strtotime($today) < strtotime($bith_date) && strtotime($next) > strtotime($bith_date)) {
				return true;
			}
			return false;
		case 2:
			if (strtotime($do) < strtotime($bith_date) && strtotime($next) > strtotime($bith_date)) {
				return true;
			}
			return false;
		default:
			return false;
		break;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Practice Quest</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<form onsubmit="check(this)" method="POST">
				<div class="form-group row">
					<strong class="col-md-5">ФИО</strong>
					<input type="text" class="col-md-7" name="fio" class="form-control">
				</div>
				<div class="form-group row">
					<strong class="col-md-5">Услуги</strong>
					<div class="col-md-7">
						<p>
							<?php
							$services = R::findAll( 'services' );;
								//var_dump($services);
							foreach ($services as $key => $value) {
								echo '<input type="checkbox" class="chbox_form" value="'. $value->name .'" ><label >' . $value->name .'</label><Br>';
							}


							?>

						</p>
					</div>
				</div>
				<div class="form-group row">
					<strong class="col-md-5">Дата рождения</strong>
					<div class="col-md-7">
						<input type="date" id="bdate_person" name="bithdate" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<strong class="col-md-5">Телефон</strong>
					<div class="col-md-7">
						<input type="text" class="form-control" name="phone" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<strong class="col-md-5">Пол</strong>
					<label class="form-check-label col-md-3">
						<input class="form-check-input gender" type="radio" name="gender" id="exampleRadios1" value="mail" checked>
						Мужской
					</label>
					<label class="form-check-label col-md-4">
						<input class="form-check-input gender" type="radio" name="gender" id="exampleRadios1" value="femail" checked>
						Женский
					</label>
				</div>
				<input type="submit" class="btn btn-success" value="Рассчитать">						
				<a href="index.php" class="btn btn-danger">Сброс</a>
			</form>
			<div class="col-md-12">
				<?

				$total = 0;
				$exec_arr = array();
				$arr_serv = array(); // Подтверждённые id

				if ($data['start_calc'] == 1) {

					$conditions = R::findAll('conditions');
					$services = R::findAll('services');

					foreach ($services as $key => $value) {

						for ($i=0; $i < count($data['conditions']); $i++) { 
							if ($data['conditions'][$i] == $value->name) {
								$arr_serv[] = $value->id;
							}
						}
					}


					//var_dump($arr_serv);


					foreach ($arr_serv as $skey => $val) {// надо подумать 

						foreach ($conditions as $key => $value) {

							if (strtotime($value->period_active) > strtotime(date("Y-m-d"))) {
								$decode_id = json_decode($value->id_services);


							if (count($arr_serv) >= count($decode_id)) {
								for ($i=0; $i < count($decode_id); $i++) { 

									if ($arr_serv[$i] == $decode_id[$i]) {
										$total += 1;


									}
								}
							}

							if ($total == count($decode_id)) {// продолжаем сравнивать 
								if ($value->phone && !empty($data['phone'])) { // проверка на телефон

									//echo "phone";
									$phone_true = false;
									$phone;
									if (!empty($value->number_phone)) { // проверка на номер телефона
										for ($i=strlen($data['phone'])-3; $i <= strlen($data['phone']); $i++) { 
											$phone = $phone . $data['phone'][$i-1];
										}
										if ($phone == $value->number_phone) {
											$phone_true = true;
										}
										
									}

									if (compareGender($value,$data['gender'])) {
										# пишем внутри
										// bdate 
										// 0 : до
										// 1 : после
										// 2 : одновременно
										if(checkForDate($value->b_date, $data['bdate'])){
//											echo "string";
											$exec_arr[] = $value->discount;
										}

									}

								}else{
									if (compareGender($value,$data['gender'])) {
										# пишем внутри
										// bdate 
										// 0 : до
										// 1 : после
										// 2 : одновременно
										if(checkForDate($value->b_date, $data['bdate'])){
//											echo "string";
												
												$exec_arr[] = $value->discount;
										}
									}
								}
								//echo " privet"; // здесь проверяем дальше!!!!!

							}
							$total = 0;
								
							}
						}
					}
					$max = 0;
					//var_dump($exec_arr);
					for ($i=0; $i < count($exec_arr); $i++) { 
						if ($exec_arr > $max) {
							$max = $exec_arr[$i];
						}
					}
					echo $max . '%';
					
					//echo var_dump($arr_serv);

				}
				?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="node_modules\moment/min/moment.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>

