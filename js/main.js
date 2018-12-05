function check(obj){
	var gender, phone, bdate; // переменные, передаём в reloadSite
	// arr_chbox - активные Чекбоксы, передаём в reloadSite 

	d=new Date(document.getElementById("bdate_person").value);
	day=d.getDate();
	month=d.getMonth();
	year = d.getFullYear();

	if (obj.fio.value != '') { //проверка фио
		var todaysDate = new Date();
		if(new Date(year,month,day,0,0,0,0).getTime() > todaysDate.getTime()) { //проверка дат
			alert('Неверная дата');
		}else{
			bdate = obj.bithdate.value;
		}
		gender = document.getElementsByClassName('gender'); // Пол
		var i = 0;
		for(i = 0; i < gender.length; i++){
			if(gender[i].checked){ //определение гендера
				gender = gender[i].value;
				//alert(gender);

				break;
			}
		}
		// Чекбоксы. Услуги
		var checkboxes = document.getElementsByClassName('chbox_form');
		var arr_chbox = [];// выбранные услуги
		for(var i = 0; i < checkboxes.length; i++){
			if (checkboxes[i].checked){
				arr_chbox.push(checkboxes[i].value);
			}
		}
		//конец чекбоксов
		if (obj.phone.value != '') { // проверка телефона
			phone = obj.phone.value;
		};
		reloadSite(gender, phone, bdate, arr_chbox);

	}else{
		alert ('Поле ФИО пустое');
	}

};
function reloadSite(gender, phone, bdate, conditions){
	document.write(document.location.href);
	//document.location.href = '/?gender=' + gender + '&phone=' + phone + '&bdate=' + bdate;

	var temp = '';
	for(var i = 0; i < conditions.length; i++){
		temp += '&conditions[]=' + conditions[i];
	}
	document.location.href = '/?start_calc=1&gender=' + gender + '&phone=' + phone + '&bdate=' + bdate + temp;

}