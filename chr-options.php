<?php

add_filter( 'rcl_options', 'chrst_addon_options' );
function chrst_addon_options( $options ) {
    // создаем блок
    $options->add_box( 'chrst_box_id', array(
        'title' => 'Настройки Christmas Time',
        'icon'  => 'fa-tree'
    ) );

    // ЛК не поддерживает загрузку обложки
    if ( function_exists( 'rcl_cover_upload' ) ) {
        // создаем группу 1
        $options->box( 'chrst_box_id' )->add_group( 'chrst_group_1', array(
            'title' => 'Праздничная обложка в ЛК:'
        ) )->add_options( array(
            [
                'title'   => 'Подключить обложку в ЛК?',
                'slug'    => 'chr_label',
                'type'    => 'radio',
                'values'  => [ 0 => 'Нет', 1 => 'Да' ],
                'default' => 0,
                'notice'  => 'Праздничная обложка по умолчанию',
                'help'    => 'Если пользователь загрузил своё фоновое изображение (обложку) в профиль, то праздничная обложка не будет у него показываться.',
            ]
        ) );
    }

    // создаем группу 2
    $options->box( 'chrst_box_id' )->add_group( 'chrst_group_2', array(
        'title' => 'Гирлянда в личном кабинете:'
    ) )->add_options( array(
        [
            'title'     => 'Включить фонарики в личном кабинете?',
            'type'      => 'radio',
            'slug'      => 'chr_lght_prf',
            'values'    => [ 0 => 'Нет', 1 => 'Да' ],
            'default'   => 0,
            'notice'    => 'В профиле пользователя появится гирлянда',
            'childrens' => array(
                1 => array(
                    [
                        'title'   => 'Время переключения гирлянды в профиле:',
                        'type'    => 'radio',
                        'values'  => [ 'infinite' => 'Бесконечно', 3 => '3', 5 => '5', 10 => '10', 15 => '15', 20 => '20' ],
                        'default' => 'infinite',
                        'slug'    => 'chr_lght_prf_time',
                        'notice'  => 'По умолчанию: Бесконечно',
                    ],
                ),
            )
        ]
    ) );

    // создаем группу 3
    $options->box( 'chrst_box_id' )->add_group( 'chrst_group_3', array(
        'title' => 'Гирлянда вверху сайта:'
    ) )->add_options( array(
        [
            'title'     => 'Включить фонарики вверху сайта?',
            'type'      => 'radio',
            'slug'      => 'chr_lght_rcl',
            'values'    => [ 0 => 'Нет', 1 => 'Да' ],
            'default'   => 0,
            'notice'    => 'Вверху сайта появится гирлянда',
            'childrens' => array(
                1 => array(
                    [
                        'title'   => 'Время переключения гирлянды на сайте:',
                        'type'    => 'radio',
                        'values'  => [ 'infinite' => 'Бесконечно', 3 => '3', 5 => '5', 10 => '10', 15 => '15', 20 => '20' ],
                        'default' => 'infinite',
                        'slug'    => 'chr_lght_rcl_time',
                        'notice'  => 'По умолчанию время мигания гирлянды - бесконечно',
                    ],
                    [
                        'title'   => 'Позиция гирлянды:',
                        'type'    => 'radio',
                        'values'  => [ 'fixed' => 'Фиксированная', 'absolute' => 'Скрываемая' ],
                        'default' => 'fixed',
                        'slug'    => 'chr_lght_rcl_pos',
                        'notice'  => 'По умолчанию: "Фиксированная"',
                        'help'    => '"Фиксированная" - при прокрутке страницы её будет видно.<br>'
                        . '"Скрываемая" - при вертикальной прокрутке она будет скрываться.'
                    ],
                ),
            )
        ]
    ) );

    $chr_warn = '';
    if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-line' ) && ! rcl_exist_addon( 'theme-grace' ) && ! rcl_exist_addon( 'theme-clear-sky' ) ) {
        $args     = [
            'type'  => 'warning', // info,success,warning,error,simple
            'icon'  => 'fa-exclamation-triangle',
            'title' => 'Данная настройка не будет работать.',
            'text'  => 'Опция работает только с шаблонами личного кабинета Sunshine, Grace, Line, Clear Sky',
        ];
        $chr_warn .= rcl_get_notice( $args );
    }

    if ( ! empty( $chr_warn ) ) {
        $options->box( 'chrst_box_id' )->add_group( 'chrst_group_4', array(
            'title' => 'На аватарке праздничная шапочка'
        ) )->add_options( array(
            [
                'type'    => 'custom',
                'content' => $chr_warn
            ],
        ) );
    } else {
        $options->box( 'chrst_box_id' )->add_group( 'chrst_group_4', array(
            'title' => 'На аватарке праздничная шапочка:'
        ) )->add_options( array(
            [
                'title'   => 'Включаем?',
                'type'    => 'radio',
                'slug'    => 'chr_hat',
                'values'  => [ 0 => 'Нет', 1 => 'Да' ],
                'default' => 0,
                'notice'  => 'В профиле пользователя, сверху автарки, увидим новогодний колпак',
            ],
        ) );
    }

    // создаем группу 5
    $options->box( 'chrst_box_id' )->add_group( 'chrst_group_5', array(
        'title' => 'Снег на всплывающей форме:'
    ) )->add_options( array(
        [
            'title'   => 'Включаем?',
            'slug'    => 'chr_snows',
            'type'    => 'radio',
            'values'  => [ 0 => 'Нет', 1 => 'Да' ],
            'default' => 0,
            'notice'  => 'На форме входа и регистрации увидим снег'
        ]
    ) );

    // создаем группу 6
    $options->box( 'chrst_box_id' )->add_group( 'chrst_group_6', array(
        'title' => 'Фон под всплывающей формой:'
    ) )->add_options( array(
        [
            'title'     => 'Включаем?',
            'type'      => 'radio',
            'slug'      => 'chr_bck',
            'values'    => [ 0 => 'Нет', 1 => 'Да' ],
            'default'   => 0,
            'notice'    => 'Гость при вызове формы входа увидит фоновую анимацию',
            'childrens' => array(
                1 => array(
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
                            11 => 'Снегопад в лесу (фон)'
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
                    ]
                ),
            )
        ]
    ) );

    // создаем группу 7
    $options->box( 'chrst_box_id' )->add_group( 'chrst_group_7', array(
        'title' => 'Санта-Клаус в подвале сайта:'
    ) )->add_options( array(
        [
            'title'   => 'Включаем?',
            'slug'    => 'chr_santa',
            'type'    => 'radio',
            'values'  => [ 0 => 'Нет', 1 => 'Да' ],
            'default' => 0,
            'notice'  => 'Анимированный Санта-Клаус везет подарки, снизу вашего сайта',
        ]
    ) );

    $counter = chr_counter_load( $width   = 75 );

    $options->box( 'chrst_box_id' )->add_group( 'chrst_group_8', array(
        'title' => 'Шорткод:'
    ) )->add_options( array(
        [
            'type'    => 'custom',
            'content' => $counter,
            'help'    => 'Это работа шорткода [chr_counter]<br>'
            . 'Разместите его в виджете или на странице и у вас на сайте появится отличный счетчик обратного отсчёта до нового года.'
            . '<br>По наступлению часа "Х" ваши пользователи увидят небольшое пожелание: С новым годом!!! Пусть исполняются мечты!!!',
        ],
    ) );

    return $options;
}
