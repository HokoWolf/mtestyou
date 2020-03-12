<?php
	require 'db.php';

	//       users

	if(R::count('users') == 0){

		$user1 = R::dispense('users');
		$user1->login = 'admin';
		$user1->email = 'admin@gmail.com';
		$user1->password = password_hash('dog.com1554', PASSWORD_DEFAULT);
		$user1->date = '2020-01-15 23:23:52';
		R::store($user1);

		$user2 = R::dispense('users');
		$user2->login = 'test';
		$user2->email = 'tester@gmail.com';
		$user2->password = password_hash('1234', PASSWORD_DEFAULT);
		$user2->date = '2020-01-17 07:25:14';
		R::store($user2);

		$user2 = R::dispense('users');
		$user2->login = 'tester228';
		$user2->email = 'drugtester@gmail.com';
		$user2->password = password_hash('drugs', PASSWORD_DEFAULT);
		$user2->date = '2020-01-21 03:54:48';
		R::store($user2);

	} # end of if(users)

	//			topics

	if(R::count('topics') == 0){

		$topic1 = R::dispense('topics');
		$topic1->name = 'Географія';
		$topic1->topic_desc = 'Географія  — комп­лекс дійсних и об­ще­ст­вен­ных на­ук, изу­чаю­щих струк­ту­ру, функ­цио­ни­ро­ва­ние и эво­лю­цию гео­гра­фи­че­ской обо­лоч­ки, взаи­мо­дей­ст­вие и рас­пре­де­ле­ние в про­стран­ст­ве при­род­ных и при­род­но-об­ще­ст­вен­ных гео­сис­тем и их ком­по­нен­тов. География изучает поверхность Земли, её природные условия, распределение на ней природных объектов , населения, экономических ресурсов.';
		R::store($topic1);

		$topic2 = R::dispense('topics');
		$topic2->name = 'Історія';
		$topic2->topic_desc = 'История — область знаний, а также гуманитарная наука, занимающаяся изучением человека (его деятельности, состояния, мировоззрения, социальных связей, организаций и так далее) в прошлом. В более узком смысле  история — наука, изучающая всевозможные источники о прошлом для того, чтобы установить последовательность событий, объективность описанных фактов и сделать выводы о причинах событий.';
		R::store($topic2);

		$topic3 = R::dispense('topics');
		$topic3->name = 'Хімія';
		$topic3->topic_desc = 'Химия — одна из важнейших и обширных областей естествознания, наука о веществах, их составе и строении, их свойствах, зависящих от состава и строения, их превращениях, ведущих к изменению состава — химических реакциях, а также о законах и закономерностях, которым эти превращения подчиняются.';
		R::store($topic3);

		$topic4 = R::dispense('topics');
		$topic4->name = 'Математика';
		$topic4->topic_desc = 'Математика - наука об отношениях между объектами, о которых ничего не известно, кроме описывающих их некоторых свойств, — именно тех, которые в качестве аксиом положены в основание той или иной математической теории. Исторически сложилась на основе операций подсчёта, измерения и описания формы объектов.';
		R::store($topic4);
	} # end of if(topics)

	//       tests

	if(R::count('tests') == 0){

		$test1 = R::dispense('tests');
		$test1->name = 'Столиці Австралії і Океанії';
		$test1->test_desc = 'Цей тест зроблено для того, щоб учні могли перевірити свої знання столиць Австралії і Океанії для підготовки до наступної самостійної роботи))';
		$test1->topics = R::load('topics', 1);
		R::store($test1);

		$test2 = R::dispense('tests');
		$test2->name = 'Столиці Північної і Південної Америки';
		$test2->test_desc = 'Всім нам відома Америка. Але при цьому у нас в голові виникають тільки такі країни, як США, Канада, Мексика. А що до інших країн?';
		$test2->topics = R::load('topics', 1);
		R::store($test2);

		$test3 = R::dispense('tests');
		$test3->name = 'Події в Україні після Лютневої революції';
		$test3->test_desc = 'Наша історія - те, що повинен знати кожен громадянин нашої країни. Адже, як говориться, без нашого минулого у нас не буде майбутнього. Давайте ж дамо можливість цьому майбутньому з\'явитися!!!';
		$test3->topics = R::load('topics', 2);
		R::store($test3);

		$test4 = R::dispense('tests');
		$test4->name = 'Повторення матеріалу 10 класу по химії';
		$test4->test_desc = 'Ця самостійна змусить згадати, що Ви проходили по химії в 10 класі, і поверне Вас до дійсності після довгих літніх канікул!';
		$test4->topics = R::load('topics', 3);
		R::store($test4);
	} # end of if (tests)

	//       questions

	if(R::count('questions') == 0){

		$quest1 = array(
			'title' => 'Столиця Самоа?',
			'answers' => array(
				'answer1' => 'Корор',
				'answer2' => 'Апіа',
				'answer3' => 'Нукуалофа',
				'answer4' => 'Доха'
			),
			'right_answ' => 'answer2'
		);

		$test = R::load('tests', 1);
		$question1 = R::dispense('questions');
		$question1->type = 'radio';
		$question1->quest = json_encode($quest1);
		$test->ownTestList[] = $question1;
		R::store($test);

		$quest2 = array(
			'title' => 'Сува - столиця якої країни?',
			'answers' => array(
				'answer1' => 'Нова Зеландія',
				'answer2' => 'Тонга',
				'answer3' => 'Фіджі',
				'answer4' => 'Кірібаті'
			),
			'right_answ' => 'answer3'
		);

		$test = R::load('tests', 1);
		$question2 = R::dispense('questions');
		$question2->type = 'radio';
		$question2->quest = json_encode($quest2);
		$test->ownTestList[] = $question2;
		R::store($test);

		$quest3 = array(
			'title' => 'Столиця Папуа-Нової Гвінеї?',
			'answers' => array(
				'answer1' => 'Порт-Морсбі',
				'answer2' => 'Фунафуті',
				'answer3' => 'Порт-о-Пренс',
				'answer4' => 'Маджуро'
			),
			'right_answ' => 'answer1'
		);

		$test = R::load('tests', 1);
		$question3 = R::dispense('questions');
		$question3->type = 'radio';
		$question3->quest = json_encode($quest3);
		$test->ownTestList[] = $question3;
		R::store($test);

		$quest4 = array(
			'title' => 'Палікір - столиця якої країни?',
			'answers' => array(
				'answer1' => 'Тувалу',
				'answer2' => 'Вануату',
				'answer3' => 'Мікронезія',
				'answer4' => 'Науру'
			),
			'right_answ' => 'answer3'
		);

		$test = R::load('tests', 1);
		$question4 = R::dispense('questions');
		$question4->type = 'radio';
		$question4->quest = json_encode($quest4);
		$test->ownTestList[] = $question4;
		R::store($test);

		$quest5 = array(
			'title' => 'Столиця Австралії?',
			'answers' => array(
				'answer1' => 'Велінгтон',
				'answer2' => 'Оттава',
				'answer3' => 'Сідней',
				'answer4' => 'Канберра'
			),
			'right_answ' => 'answer4'
		);

		$test = R::load('tests', 1);
		$question5 = R::dispense('questions');
		$question5->type = 'radio';
		$question5->quest = json_encode($quest5);
		$test->ownTestList[] = $question5;
		R::store($test);

		$quest6 = array(
			'title' => 'Столиця Гондурасу?',
			'answers' => array(
				'answer1' => 'Розо',
				'answer2' => 'Тегусигальпа',
				'answer3' => 'Нассау',
				'answer4' => 'Гватемала'
			),
			'right_answ' => 'answer2'
		);

		$test = R::load('tests', 2);
		$question6 = R::dispense('questions');
		$question6->type = 'radio';
		$question6->quest = json_encode($quest6);
		$test->ownTestList[] = $question6;
		R::store($test);

		$quest7 = array(
			'title' => 'Порт-оф-Спейн - столица якої країни?',
			'answers' => array(
				'answer1' => 'Багамскі острови',
				'answer2' => 'Гаїті',
				'answer3' => 'Панама',
				'answer4' => 'Тринідад и Тобаго'
			),
			'right_answ' => 'answer4'
		);

		$test = R::load('tests', 2);
		$question7 = R::dispense('questions');
		$question7->type = 'radio';
		$question7->quest = json_encode($quest7);
		$test->ownTestList[] = $question7;
		R::store($test);

		$quest8 = array(
			'title' => 'Столиця Куби?',
			'answers' => array(
				'answer1' => 'Сент-джонс',
				'answer2' => 'Гавана',
				'answer3' => 'Сан-Хосе',
				'answer4' => 'Кастрі'
			),
			'right_answ' => 'answer2'
		);

		$test = R::load('tests', 2);
		$question8 = R::dispense('questions');
		$question8->type = 'radio';
		$question8->quest = json_encode($quest8);
		$test->ownTestList[] = $question8;
		R::store($test);

		$quest9 = array(
			'title' => 'Столиця Коста-Рики?',
			'answers' => array(
				'answer1' => 'Манагуа',
				'answer2' => 'Бельпоман',
				'answer3' => 'Сан-Хосе',
				'answer4' => 'Санто-Домінго'
			),
			'right_answ' => 'answer3'
		);

		$test = R::load('tests', 2);
		$question9 = R::dispense('questions');
		$question9->type = 'radio';
		$question9->quest = json_encode($quest9);
		$test->ownTestList[] = $question9;
		R::store($test);

		$quest10 = array(
			'title' => 'Кінгстон - столиця якої країни?',
			'answers' => array(
				'answer1' => 'Ямайка',
				'answer2' => 'Нікарагуа',
				'answer3' => 'Сент-Вінсент и Гренадина',
				'answer4' => 'Беліз'
			),
			'right_answ' => 'answer1'
		);

		$test = R::load('tests', 2);
		$question10 = R::dispense('questions');
		$question10->type = 'radio';
		$question10->quest = json_encode($quest10);
		$test->ownTestList[] = $question10;
		R::store($test);

		$quest11 = array(
			'title' => 'Дата утворення ЗУНР?',
			'answers' => array(
				'answer1' => '13.11.1917',
				'answer2' => '17.09.1918',
				'answer3' => '13.11.1918',
				'answer4' => '11.02.1919'
			),
			'right_answ' => 'answer3'
		);

		$test = R::load('tests', 3);
		$question11 = R::dispense('questions');
		$question11->type = 'radio';
		$question11->quest = json_encode($quest11);
		$test->ownTestList[] = $question11;
		R::store($test);

		$quest12 = array(
			'title' => 'Дата утворення Директорії?',
			'answers' => array(
				'answer1' => '14.11.1918',
				'answer2' => '10.11.1918',
				'answer3' => '15.12.1917',
				'answer4' => '19.10.1918'
			),
			'right_answ' => 'answer1'
		);

		$test = R::load('tests', 3);
		$question12 = R::dispense('questions');
		$question12->type = 'radio';
		$question12->quest = json_encode($quest12);
		$test->ownTestList[] = $question12;
		R::store($test);

		$quest13 = array(
			'title' => 'Гетьман України при окупації німецько-австрійськими військами 1918 року?',
			'answers' => array(
				'answer1' => 'М.С.Грушевський',
				'answer2' => 'П.П.Скоропадський',
				'answer3' => 'В.К.Винниченко',
				'answer4' => 'Ф.А.Лизогуб'
			),
			'right_answ' => 'answer2'
		);

		$test = R::load('tests', 3);
		$question13 = R::dispense('questions');
		$question13->type = 'radio';
		$question13->quest = json_encode($quest13);
		$test->ownTestList[] = $question13;
		R::store($test);

		$quest14 = array(
			'title' => 'Головний орган правління УНР?',
			'answers' => array(
				'answer1' => 'ТУ',
				'answer2' => 'ГС',
				'answer3' => 'Раднарком',
				'answer4' => 'УЦР'
			),
			'right_answ' => 'answer4'
		);

		$test = R::load('tests', 3);
		$question14 = R::dispense('questions');
		$question14->type = 'radio';
		$question14->quest = json_encode($quest14);
		$test->ownTestList[] = $question14;
		R::store($test);

		$quest15 = array(
			'title' => 'Головний орган правління, установлений після лютневої революції?',
			'answers' => array(
				'answer1' => 'ТУ',
				'answer2' => 'ГС',
				'answer3' => 'Раднарком',
				'answer4' => 'УЦР'
			),
			'right_answ' => 'answer1'
		);

		$test = R::load('tests', 3);
		$question15 = R::dispense('questions');
		$question15->type = 'radio';
		$question15->quest = json_encode($quest15);
		$test->ownTestList[] = $question15;
		R::store($test);

		$quest16 = array(
			'title' => 'Виберіть усі алкани зі списку.',
			'answers' => array(
				'answer1' => 'Метан',
				'answer2' => 'Етин',
				'answer3' => 'Гексін',
				'answer4' => 'Пропан',
				'answer5' => 'Етан',
				'answer6' => 'Бутін',
				'answer7' => 'Пентан'
			),
			'right_answers' => array(
				'answer1',
				'answer4',
				'answer5',
				'answer7'
			)
		);

		$test = R::load('tests', 4);
		$question16 = R::dispense('questions');
		$question16->type = 'check';
		$question16->quest = json_encode($quest16);
		$test->ownTestList[] = $question16;
		R::store($test);


		$quest17 = array(
			'title' => 'Напишіть реакцію повного окиснення (горіння) етанолу (у відповідь напишіть суму всіх коефіцієнтів).',
			'right_answ' => '9'
		);

		$test = R::load('tests', 4);
		$question17 = R::dispense('questions');
		$question17->type = 'text';
		$question17->quest = json_encode($quest17);
		$test->ownTestList[] = $question17;
		R::store($test);

		$quest18 = array(
			'title' => 'Чи вірне твердження, що гомологи мають однакову структуру, але різний склад?',
			'answers' => array(
				'answer1' => 'Так',
				'answer2' => 'Ні'
			),
			'right_answ' => 'answer1'
		);

		$test = R::load('tests', 4);
		$question18 = R::dispense('questions');
		$question18->type = 'radio';
		$question18->quest = json_encode($quest18);
		$test->ownTestList[] = $question18;
		R::store($test);

		$quest19 = array(
			'title' => 'Чи вірне твердження, що ізомери мають різний склад, різну структуру, і належать до одного класу сполук?',
			'answers' => array(
				'answer1' => 'Так',
				'answer2' => 'Ні'
			),
			'right_answ' => 'answer2'
		);

		$test = R::load('tests', 4);
		$question19 = R::dispense('questions');
		$question19->type = 'radio';
		$question19->quest = json_encode($quest19);
		$test->ownTestList[] = $question19;
		R::store($test);

		$quest20 = array(
			'title' => 'Який клас сполук має хімічну групу -COOH?',
			'answers' => array(
				'answer1' => 'Спирти',
				'answer2' => 'Феноли',
				'answer3' => 'Карбонові кислоти',
				'answer4' => 'Циклоалкани'
			),
			'right_answ' => 'answer3'
		);

		$test = R::load('tests', 4);
		$question20 = R::dispense('questions');
		$question20->type = 'radio';
		$question20->quest = json_encode($quest20);
		$test->ownTestList[] = $question20;
		R::store($test);

		$quest21 = array(
			'title' => 'До якого класу сполук відноситься сахароза?',
			'answers' => array(
				'answer1' => 'Дисахариди',
				'answer2' => 'Полісахариди',
				'answer3' => 'Моносахариди',
			),
			'right_answ' => 'answer1'
		);

		$test = R::load('tests', 4);
		$question21 = R::dispense('questions');
		$question21->type = 'radio';
		$question21->quest = json_encode($quest21);
		$test->ownTestList[] = $question21;
		R::store($test);

		$quest22 = array(
			'title' => 'Який з перечислених елементів має найбільшу електронегативність?',
			'answers' => array(
				'answer1' => 'Оксиген',
				'answer2' => 'Хлор',
				'answer3' => 'Сульфур',
				'answer4' => 'Фтор'
			),
			'right_answ' => 'answer4'
		);

		$test = R::load('tests', 4);
		$question22 = R::dispense('questions');
		$question22->type = 'radio';
		$question22->quest = json_encode($quest22);
		$test->ownTestList[] = $question22;
		R::store($test);
	} # end of if(questions)
?>
