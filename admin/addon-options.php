<?php /** @noinspection PhpUnused */

add_filter( 'rcl_options', 'chrst_addon_options' );
function chrst_addon_options( $options ) {
	// создаем блок
	$options->add_box( 'chrst_box_id', [
		'title' => 'Настройки Christmas Time',
		'icon'  => 'fa-tree',
	] );

	// ЛК не поддерживает загрузку обложки
	if ( function_exists( 'rcl_cover_upload' ) ) {
		// создаем группу 1
		$options->box( 'chrst_box_id' )->add_group( 'chrst_group_1', [
			'title' => 'Праздничная обложка в ЛК:',
		] )->add_options( [
			[
				'title'   => 'Подключить обложку в ЛК?',
				'slug'    => 'chr_label',
				'type'    => 'radio',
				'values'  => [ 0 => 'Нет', 1 => 'Да' ],
				'default' => 0,
				'notice'  => 'Дефолтная праздничная обложка',
				'help'    => 'Показывается если он еще не загрузил обложку.<br>
				Если пользователь загрузил своё фоновое изображение (обложку) в профиль, то праздничная обложка не будет у него показываться.',
			],
		] );
	}

	// создаем группу 2
	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_2', [
		'title' => 'Гирлянда в личном кабинете:',
	] )->add_options( [
		[
			'title'     => 'Включить фонарики в личном кабинете?',
			'type'      => 'radio',
			'slug'      => 'chr_lk_light',
			'values'    => [ 0 => 'Нет', 1 => 'Да' ],
			'default'   => 0,
			'notice'    => 'В профиле пользователя появится гирлянда',
			'childrens' => [
				1 => [
					[
						'title'   => 'Время переключения гирлянды в профиле:',
						'type'    => 'radio',
						'values'  => [ 'infinite' => 'Бесконечно', 3 => '3', 5 => '5', 10 => '10', 15 => '15', 20 => '20' ],
						'default' => 'infinite',
						'slug'    => 'chr_lk_light_time',
						'notice'  => 'По умолчанию: Бесконечно',
					],
				],
			],
		],
	] );

	// создаем группу 3
	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_3', [
		'title' => 'Гирлянда вверху сайта:',
	] )->add_options( [
		[
			'title'     => 'Включить фонарики вверху сайта?',
			'type'      => 'radio',
			'slug'      => 'chr_top_light',
			'values'    => [ 0 => 'Нет', 1 => 'Да' ],
			'default'   => 0,
			'notice'    => 'Вверху сайта появится гирлянда',
			'childrens' => [
				1 => [
					[
						'title'   => 'Время переключения гирлянды на сайте:',
						'type'    => 'radio',
						'values'  => [ 'infinite' => 'Бесконечно', 3 => '3', 5 => '5', 10 => '10', 15 => '15', 20 => '20' ],
						'default' => 'infinite',
						'slug'    => 'chr_top_light_time',
						'notice'  => 'По умолчанию время мигания гирлянды - бесконечно',
					],
					[
						'title'   => 'Позиция гирлянды:',
						'type'    => 'radio',
						'values'  => [ 'fixed' => 'Фиксированная', 'absolute' => 'Скрываемая' ],
						'default' => 'fixed',
						'slug'    => 'chr_top_light_pos',
						'notice'  => 'По умолчанию: "Фиксированная"',
						'help'    => '"Фиксированная" - при прокрутке страницы её будет видно.<br>'
						             . '"Скрываемая" - при вертикальной прокрутке она будет скрываться.',
					],
				],
			],
		],
	] );

	$chr_warn = '';
	if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-line' ) && ! rcl_exist_addon( 'theme-grace' ) && ! rcl_exist_addon( 'theme-clear-sky' ) && ! rcl_exist_addon( 'theme-control' ) ) {
		$args     = [
			'type'  => 'warning', // info,success,warning,error,simple
			'icon'  => 'fa-exclamation-triangle',
			'title' => 'Данная настройка не будет работать.',
			'text'  => 'Опция работает только с шаблонами личного кабинета Sunshine, Grace, Line, Clear Sky, Theme Control + User Info Tab',
		];
		$chr_warn .= rcl_get_notice( $args );
	}

	if ( ! empty( $chr_warn ) ) {
		$options->box( 'chrst_box_id' )->add_group( 'chrst_group_4', [
			'title' => 'На аватарке праздничная шапочка',
		] )->add_options( [
			[
				'type'    => 'custom',
				'content' => $chr_warn,
			],
		] );
	} else {
		$options->box( 'chrst_box_id' )->add_group( 'chrst_group_4', [
			'title' => 'На аватарке праздничная шапочка:',
		] )->add_options( [
			[
				'title'   => 'Включаем?',
				'type'    => 'radio',
				'slug'    => 'chr_hat',
				'values'  => [ 0 => 'Нет', 1 => 'Да' ],
				'default' => 0,
				'notice'  => 'В профиле пользователя, сверху аватарки, увидим новогодний колпак',
			],
		] );
	}

	$chr_no_square = '';
	if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-grace' ) ) {
		$args          = [
			'type'  => 'warning', // info,success,warning,error,simple
			'icon'  => 'fa-exclamation-triangle',
			'title' => 'Данная настройка не будет работать.',
			'text'  => 'Опция работает только с шаблонами личного кабинета Sunshine, Grace',
		];
		$chr_no_square .= rcl_get_notice( $args );
	}
	if ( ! empty( $chr_no_square ) ) {
		$options->box( 'chrst_box_id' )->add_group( 'chrst_square', [
			'title' => 'Рамка с снежинками на аватарке:',
		] )->add_options( [
			[
				'type'    => 'custom',
				'content' => $chr_no_square,
			],
		] );
	} else {
		$options->box( 'chrst_box_id' )->add_group( 'chrst_square', [
			'title' => 'Рамка с снежинками на аватарке:',
		] )->add_options( [
			[
				'title'   => 'Включаем?',
				'type'    => 'radio',
				'slug'    => 'chr_square',
				'values'  => [ 0 => 'Нет', 1 => 'Да' ],
				'default' => 0,
				'notice'  => 'В профиле пользователя, аватарка будет в рамке из снежинок',
			],
		] );
	}

	$options->box( 'chrst_box_id' )->add_group( 'chrst_avas', [
		'title' => 'Праздничная дефолтная аватарка:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'type'    => 'radio',
			'slug'    => 'chr_avas',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'notice'  => 'Кто не загрузил себе аватарку - тому праздничную поставим',
			'help'    => 'У кого стоит дополнение <a href="https://codeseller.ru/products/woman-man/" title="" target="_blank">Woman/man</a> - 
							тому будет в зависимости от указанного пола. Девчатам - девчонку, парням - пацана. А кто застеснялся указать свой пол - тому снеговика',
		],
	] );

	// создаем группу 5
	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_5', [
		'title' => 'Снег на всплывающей форме:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'slug'    => 'chr_snows',
			'type'    => 'radio',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'notice'  => 'На форме входа и регистрации увидим снег',
		],
	] );

	// создаем группу 6
	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_6', [
		'title' => 'Фон под всплывающей формой:',
	] )->add_options( [
		[
			'title'     => 'Включаем?',
			'type'      => 'radio',
			'slug'      => 'chr_bck',
			'values'    => [ 0 => 'Нет', 1 => 'Да' ],
			'default'   => 0,
			'notice'    => 'Гость при вызове формы входа увидит фоновую анимацию',
			'childrens' => [
				1 => [
					[
						'title'  => 'Выберите фоновую анимацию:',
						'type'   => 'select',
						'values' => [
							1  => 'Звезды (частицы)',
							2  => 'Звёзды 2 (частицы)',
							3  => 'Снег (частицы)',
							4  => 'Снег 2 (частицы)',
							6  => 'Снег 3 (частицы)',
							10 => 'Снег 4 (частицы)',
							12 => 'Снегопад (частицы)',
							5  => 'Камин (фон)',
							7  => 'Вокзал (фон)',
							8  => 'Снегопад (фон)',
							9  => 'Снег в городке (фон)',
							11 => 'Снегопад в лесу (фон)',
						],
						'slug'   => 'chr_bck_gif',
						'help'   => 'Сверху вниз идут изображения от самого легкого - в 1 килобайт, '
						            . 'до самого тяжелого в 2.6 мегабайта. Учитывайте это - не у всех быстрый интернет. '
						            . 'Хотя я проблем не заметил. <br/><br/>'
						            . 'Подпись к картинкам - "частицы" или "фон" позволят вам правильно выбрать прозрачность. '
						            . 'Для частиц нужно выбирать значение прозрачности обложки, а для "фона" выбирать "непрозрачный"',
					],
					[
						'title'   => 'Позиция обложки:',
						'slug'    => 'chr_bck_position',
						'type'    => 'radio',
						'values'  => [ 'cover' => 'Растянуть', 'contain' => 'Замостить', 'auto' => 'Как есть' ],
						'default' => 'cover',
					],
					[
						'title'   => 'Прозрачность обложки:',
						'slug'    => 'chr_bck_opacity',
						'type'    => 'radio',
						'values'  => [ '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => 'Непрозрачная' ],
						'default' => '0.7',
					],
				],
			],
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_tree_balls', [
		'title' => 'Внизу ёлочные шары:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'slug'    => 'chr_tree_balls',
			'type'    => 'radio',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'help'    => 'Шары будут полезными ссылками в ЛК, на вход/выход и главную страницу сайта. Шары скрываются на мобильных - т.е. это для планшетов или ПК',
		],
	] );

	// создаем группу 7
	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_7', [
		'title' => 'Санта-Клаус в подвале сайта:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'slug'    => 'chr_santa',
			'type'    => 'radio',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'notice'  => 'Анимированный Санта-Клаус везет подарки, снизу вашего сайта',
		],
	] );

	$counter = chr_counter_load( [ 'width' => 80 ] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_8', [
		'title' => 'Шорткод:',
	] )->add_options( [
		[
			'title'   => 'Обратный отсчёт до Нового Года',
			'type'    => 'custom',
			'content' => $counter,
			'help'    => 'Это работа шорткода <code>[chr_counter]</code><br>'
			             . 'Разместите его в html-виджете или на нужной странице/записи и у вас на сайте появится отличный счетчик обратного отсчёта до нового года.'
			             . '<br>По наступлению часа "Х" ваши пользователи увидят небольшое пожелание: С новым годом!!! Пусть исполняются мечты!!!',
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_tree', [
		'title' => 'Шорткод 2:',
	] )->add_options( [
		[
			'title'   => 'Ёлка с огнями и кошка в ней',
			'type'    => 'custom',
			'content' => '',
			'help'    => 'Шорткод <code>[chr_tree]</code><br>'
			             . 'Разместите его в html-виджете или на нужной странице/записи и у вас на сайте появится она! новогодняя! в огнях!',
		],
	] );


	$options->box( 'chrst_box_id' )->add_group( 'chrst_town', [
		'title' => 'Шорткод 3:',
	] )->add_options( [
		[
			'title'   => 'Праздничный город',
			'type'    => 'custom',
			'content' => '',
			'help'    => 'Шорткод <code>[chr_town]</code><br>'
			             . 'Разместите его в html-виджете или на нужной странице/записи и у вас на сайте появится город. 
			             Дома в параллаксе (движение, ёлочка). Под этой анимацией текст и пожелание.',
		],
	] );


	$options->box( 'chrst_box_id' )->add_group( 'chrst_radio', [
		'title' => 'Шорткод 4:',
	] )->add_options( [
		[
			'title'   => 'Радио Christmas',
			'type'    => 'custom',
			'content' => '',
			'help'    => 'Шорткод <code>[chr_radio]</code><br>'
			             . 'Разместите его в html-виджете или на нужной странице/записи и радио с новогодними песнями будет играть без перерыва!',
		],
	] );


	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_9', [
		'title' => 'Стилизованный рейтинг:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'slug'    => 'chr_rat',
			'type'    => 'radio',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'notice'  => 'Иконки новогодние на рейтинг типов: "звёзды" и "мне нравится"',
			'help'    => 'Заменит иконки этих 2х типов рейтинга.<br>'
			             . '"Звёзды" - на коробки с подарками, а "Мне нравится" - на сердце в новогоднем шаре',
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_10', [
		'title' => 'Ёлка на открытие смайлов в ЛС:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'slug'    => 'chr_chat',
			'type'    => 'radio',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'notice'  => 'Иконка открытия смайлов в чате (и личных сообщениях) превратится из смайла в ёлку',
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_ho_ho', [
		'title' => 'Звук входящего сообщения: хо-хо-хо:',
	] )->add_options( [
		[
			'title'   => 'Включаем?',
			'slug'    => 'chr_hoho',
			'type'    => 'radio',
			'values'  => [ 0 => 'Нет', 1 => 'Да' ],
			'default' => 0,
			'notice'  => 'Звук входящего сообщения в чате (и личных сообщениях) поменяем на возглас Санты: "Хо-Хо-Хо"',
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_11', [
		'title' => 'Над формой входа текст:',
	] )->add_options( [
		[
			'title'     => 'Включаем?',
			'slug'      => 'chr_hello',
			'type'      => 'radio',
			'values'    => [ 0 => 'Нет', 1 => 'Да' ],
			'default'   => 0,
			'notice'    => 'Над формой входа и регистрации увидим поздравительный текст',
			'help'      => 'Вы сможете указать свой текст который пользователи увидят при открытии формы входа и регистрации.<br>'
			               . 'Хотите текст разместить над личным кабинетом? Перейдите в админке: Внешний вид -> Виджеты '
			               . 'и добавьте виджет Текст в нужную область личного кабинета',
			'childrens' => [
				1 => [
					[
						'title'  => 'Впишите свой короткий поздравительный текст',
						'type'   => 'textarea',
						'slug'   => 'chr_hello_txt',
						'notice' => 'По умолчанию:  🎄 ☃ 🎅 Желаем счастья и здоровья в Новом Году!',
					],
				],
			],
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_12', [
		'title' => 'Справа - в реколлбаре, в меню автора: поздравление:',
	] )->add_options( [
		[
			'title'     => 'Включаем?',
			'slug'      => 'chr_rclb',
			'type'      => 'radio',
			'values'    => [ 0 => 'Нет', 1 => 'Да' ],
			'default'   => 0,
			'notice'    => 'Поздравительный текст в меню автора в реколлбаре справа',
			'help'      => 'Залогиненный в реколлбаре (в меню автора) щелкнет по меню и там в списке будет короткий текст поздравление',
			'childrens' => [
				1 => [
					[
						'title'  => 'Впишите свой короткий поздравительный текст',
						'type'   => 'textarea',
						'slug'   => 'chr_rclb_txt',
						'notice' => 'По умолчанию:  В Новом Году удачи 💰, любви 🥰 и здоровья 💪 желаем Вам!',
					],
				],
			],
		],
	] );

	$options->box( 'chrst_box_id' )->add_group( 'chrst_group_off', [
		'title' => 'Отключить все эффекты в январе?',
	] )->add_options( [
		[
			'title'     => 'Отключим?',
			'slug'      => 'chr_off',
			'type'      => 'radio',
			'values'    => [ 0 => 'Нет', 1 => 'Да' ],
			'default'   => 0,
			'help'      => 'Вы выставляете число (по умолчанию 14 января) и после этого числа все настройки и шорткоды выключаются. Сай перейдёт в обычный режим.
			Внимание! Включив этот режим он действует до 1-го декабря. т.е. с момента отключения эффектов, до 1-го декабря.',
			'childrens' => [
				1 => [
					[
						'title'  => 'С какого января отключить? число (без ноля).',
						'type'   => 'number',
						'slug'   => 'chr_off_date',
						'notice' => 'По умолчанию: 14',
						'help'   => 'В январе (если не указано) - отключит эффекты и шорткоды с 14-го числа. Указывайте число, например 8 - если хотите с 8-го января отключить все эффекты.
						<br><br>Вы можете и просто отключить дополнение Christmas Time в списке дополнений и эффекты будут все убраны. 
						Но в таком случае вам придется убирать все вписанные от дополнения шорткоды - т.к. вы отключаете их обработку и вордпресс выведет их как текст. Так работает вордпресс.',
					],
				],
			],
		],
	] );


	return $options;
}
