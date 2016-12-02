<?php

function chr_options($content){

    global $active_addons;

    $chr_warn = '';
    if (!$active_addons['theme-sunshine'] && !$active_addons['theme-line']){
        $chr_warn = '<span class="adm_warn adm_b18">Данная настройка не будет работать. Смотрите help</span>';
    }

    $opt = new Rcl_Options(__FILE__);

    $content .= $opt->options('Настройки Christmas Time', array(
        $opt->option_block(
            array(
                $opt->title('Праздничная обложка в ЛК'),
                $opt->label('Подключить обложку в ЛК?'),
                $opt->option('select', array(
                    'name' => 'chr_label',
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->notice('Если пользователь загрузил своё фоновое изображение (обложку) в профиль, то праздничная обложка не будет у него показываться'),
            )
        ),
        $opt->option_block(
            array(
                $opt->title('Гирлянда в личном кабинете'),
                $opt->label('Включить фонарики в личном кабинете?'),
                $opt->option('select', array(
                    'name' => 'chr_lght_prf',
                    'default' => '0',
                    'parent' => true,               // родительский
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->notice('В профиле пользователя появится гирлянда'),
                $opt->child(                        // подчиненный
                    array(
                        'name' => 'chr_lght_prf',   // атрибут name родителя
                        'value' => '1'              // подчиненный запускается при значении
                    ),
                    array(                          // содержимое скрытого блока
                        $opt->label('Время переключения гирлянды в профиле:'),
                        $opt->option('select', array(
                            'name' => 'chr_lght_prf_time',
                            'default' => 'infinite',
                            'options' => array('infinite' => 'Бесконечно', 3 => '3', 5 => '5', 10 => '10', 15 => '15', 20 => '20')
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
                $opt->option('select', array(
                    'name' => 'chr_lght_rcl',
                    'default' => '0',
                    'parent' => true,
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->notice('Вверху сайта появится гирлянда'),
                $opt->child(
                    array(
                        'name' => 'chr_lght_rcl',
                        'value' => '1'
                    ),
                    array(
                        $opt->label('Время переключения гирлянды на сайте:'),
                        $opt->option('select', array(
                            'name' => 'chr_lght_rcl_time',
                            'default' => 'infinite',
                            'options' => array('infinite' => 'Бесконечно', 3 => '3', 5 => '5', 10 => '10', 15 => '15', 20 => '20')
                        )),
                        $opt->notice('По умолчанию время мигания гирлянды - бесконечно'),
                        $opt->label('Позиция гирлянды'),
                        $opt->option('select', array(
                            'name' => 'chr_lght_rcl_pos',
                            'default' => 'fixed',
                            'options' => array('fixed' => 'Фиксированная', 'absolute' => 'Скрываемая')
                        )),
                        $opt->notice('По умолчанию "Фиксированная" - при прокрутке страницы ее будет видно. "Скрываемая" - при вертикальной прокрутке она будет скрываться')
                    )
                ),
            )
        ),
        $opt->option_block(
            array(
                $opt->title('На аватарке праздничная шапочка'),
                '<div>' . $chr_warn . '</div>',
                $opt->label('Включаем?'),
                $opt->option('select', array(
                    'name' => 'chr_hat',
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->help('Опция работает только с шаблонами личного кабинета Sunshine и Line'),
                $opt->notice('В профиле пользователя, сверху автарки, увидим новогодний колпак'),
            )
        ),
        $opt->option_block(
            array(
                $opt->title('Снег на всплывающей форме'),
                $opt->label('Включаем?'),
                $opt->option('select', array(
                    'name' => 'chr_snows',
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->notice('На форме входа и регистрации увидим снег'),
            )
        ),
        $opt->option_block(
            array(
                $opt->title('Фон под всплывающей формой'),
                $opt->label('Включаем?'),
                $opt->option('select', array(
                    'name' => 'chr_bck',
                    'parent' => true, // родительский
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->notice('Гость при вызове формы входа увидит фоновую анимацию'),
                $opt->child(// подчиненный
                        array(
                            'name' => 'chr_bck', // атрибут name родителя
                            'value' => '1'        // подчиненный запускается при значении
                        ),
                        array(// содержимое скрытого блока
                            $opt->label('Выберите фоновую анимацию:'),
                            $opt->option('select', array(
                                'name' => 'chr_bck_gif',
                                'options' => array(1 => 'Звезды (частицы)', 2 => 'Звёзды 2 (частицы)', 3 => 'Снег (частицы)', 4 => 'Снег 2 (частицы)', 5 => 'Камин (фон)', 6 => 'Снег 3 (частицы)', 7 => 'Вокзал (фон)', 8 => 'Снегопад (фон)', 9 => 'Снег в городке (фон)', 10 => 'Снег 4 (частицы)', 11 => 'Снегопад в лесу (фон)', 12 => 'Снегопад (частицы)')
                            )),
                            $opt->help('Сверху вниз идут изображения от самого легкого - в 1 килобайт, до самого тяжелого в 2.6 мегабайта. Учитывайте это - не у всех быстрый интернет. Хотя я проблем не заметил. <br/><br/>Подпись к картинкам - "частицы" или "фон" позволят вам правильно выбрать прозрачность. Для частиц нужно выбирать значение прозрачности обложки, а для "фона" выбирать "непрозрачный"'),
                            $opt->label('Позиция обложки:'),
                            $opt->option('select', array(
                                'name' => 'chr_bck_position',
                                'options' => array('cover' => 'Растянуть', 'contain' => 'Замостить', 'auto' => 'Как есть')
                            )),
                            $opt->label('Прозрачность обложки:'),
                            $opt->option('select', array(
                                'name' => 'chr_bck_opacity',
                                'options' => array('0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => 'Непрозрачная')
                            )),
                        )
                ),
            )
        ),
        $opt->option_block(
            array(
                $opt->title('Санта-Клаус в подвале сайта'),
                $opt->label('Включаем?'),
                $opt->option('select', array(
                    'name' => 'chr_santa',
                    'options' => array(0 => 'Нет', 1 => 'Да')
                )),
                $opt->notice('Анимированный Санта-Клаус везет подарки, снизу вашего сайта'),
            )
        ),
    ));

    return $content;
}

add_filter('admin_options_wprecall', 'chr_options');
