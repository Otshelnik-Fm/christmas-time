<?php
add_filter('admin_options_wprecall','chr_options');
function chr_options($content){

        $opt = new Rcl_Options(__FILE__);

        $content .= $opt->options('Настройки Christmas Time',array(
		
			$opt->option_block(
				array(
					$opt->title('Праздничная обложка в ЛК'),
					$opt->label('Подключить обложку в ЛК?'),
						$opt->option('select',array(
							'name'=>'chr_label',
							'options'=>array(0 => 'Нет',1 => 'Да')
						)),
					$opt->notice('Если пользователь загрузил своё фоновое изображение (обложку) в профиль, то праздничная обложка не будет у него показываться'),
				)
			),
			
		$opt->option_block(
            array(
                $opt->title('Гирлянда в личном кабинете'),
                $opt->label('Включить фонарики в личном кабинете?'),
				$opt->option('select',array(
						'name'=>'chr_lght_prf',
						'default'=>'0',
						'parent'=>true, // родительский
						'options'=>array(0 => 'Нет',1 => 'Да')
					)),
					$opt->notice('В профиле пользователя появится гирлянда'),
					
					$opt->child ( // подчиненный
						array(
							'name'=>'chr_lght_prf', // атрибут name родителя
							'value'=>'1' // подчиненный запускается при значении
						),
						array( // содержимое скрытого блока
							$opt->label('Время переключения гирлянды в профиле:'),
							$opt->option('select',array(
									'name'=>'chr_lght_prf_time',
									'default'=>'infinite',
									'options'=>array('infinite' => 'Бесконечно',3 => '3',5 => '5',10 => '10',15 => '15',20 => '20')
								)),
							$opt->notice('По умолчанию время мигания гирлянды - бесконечно'),
						)
					),
            )
        ),
		

		$opt->option_block(
            array(
                $opt->title('Гирлянда вверху сайта'),
                $opt->label('Включить фонарики вверху сайта?'),
				$opt->option('select',array(
					'name'=>'chr_lght_rcl',
					'default'=>'0',
					'parent'=>true,
					'options'=>array(0 => 'Нет',1 => 'Да')
				)),
				$opt->notice('Вверху сайта появится гирлянда'),
				
				$opt->child (
					array(
						'name'=>'chr_lght_rcl',
						'value'=>'1'
					),
					array(
						$opt->label('Время переключения гирлянды на сайте:'),
						$opt->option('select',array(
								'name'=>'chr_lght_rcl_time',
								'default'=>'infinite',
								'options'=>array('infinite' => 'Бесконечно',3 => '3',5 => '5',10 => '10',15 => '15',20 => '20')
							)),
						$opt->notice('По умолчанию время мигания гирлянды - бесконечно'),
						
						$opt->label('Позиция гирлянды'),
						$opt->option('select',array(
								'name'=>'chr_lght_rcl_pos',
								'default'=>'fixed',
								'options'=>array('fixed' => 'Фиксированная','absolute' => 'Скрываемая')
							)),
						$opt->notice('По умолчанию "Фиксированная" - при прокрутке страницы ее будет видно. "Скрываемая" - при вертикальной прокрутке она будет скрываться')
					)
				),
            )
        ),
		
		
		$opt->option_block(
            array(
                $opt->title('На аватарке праздничная шапочка'),
				$opt->label('Включаем?'),
						$opt->option('select',array(
							'name'=>'chr_hat',
							'options'=>array(0 => 'Нет',1 => 'Да')
						)),
					$opt->notice('В профиле пользователя, сверху автарки, увидим новогодний колпак'),
            )
        ),
		
		
		$opt->option_block(
            array(
                $opt->title('Снег на всплывающей форме'),
				$opt->label('Включаем?'),
						$opt->option('select',array(
							'name'=>'chr_snows',
							'options'=>array(0 => 'Нет',1 => 'Да')
						)),
					$opt->notice('На форме входа и регистрации увидим снег'),
            )
        ),
		
		
		$opt->option_block(
            array(
                $opt->title('Санта-Клаус в подвале сайта'),
				$opt->label('Включаем?'),
						$opt->option('select',array(
							'name'=>'chr_santa',
							'options'=>array(0 => 'Нет',1 => 'Да')
						)),
					$opt->notice('Анимированный Санта-Клаус везет подарки, снизу вашего сайта'),
            )
        )
		
		
		
		)
    );

    return $content;
}
