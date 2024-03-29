== Установка/Обновление ==

<h3 style="text-align: center;">Установка:</h3>
Т.к. это дополнение для WordPress плагина <a href="https://codeseller.ru/groups/plagin-wp-recall-lichnyj-kabinet-na-wordpress/" target="_blank">WP-Recall</a>, то оно устанавливается через <a href="https://codeseller.ru/obshhie-svedeniya-o-dopolneniyax-wp-recall/" target="_blank"><strong>менеджер дополнений WP-Recall</strong></a>.

1. В админке вашего сайта перейдите на страницу "WP-Recall" -> "Дополнения" и в самом верху нажмите на кнопку "Обзор", выберите .zip архив дополнения на вашем пк и нажмите кнопку "Установить".
2. В списке загруженных дополнений, на этой странице, найдите это дополнение, наведите на него курсор мыши и нажмите кнопку "Активировать". Или выберите чекбокс и в выпадающем списке действия выберите "Активировать". Нажмите применить.


<h3 style="text-align: center;">Обновление:</h3>
Дополнение поддерживает <a href="https://codeseller.ru/avtomaticheskie-obnovleniya-dopolnenij-plagina-wp-recall/" target="_blank">автоматическое обновление</a> - два раза в день отправляются вашим сервером запросы на обновление.
Если в течение суток вы не видите обновления (а на странице дополнения вы видите что версия вышла новая), советую ознакомиться с этой <a href="https://codeseller.ru/post-group/rabota-wordpress-krona-cron-prinuditelnoe-vypolnenie-kron-zadach-dlya-wp-recall/" target="_blank">статьёй</a>




== Настройки ==
В админке: WP-Recall -> Настройки -> Настройки Christmas Time
Выбирайте из кучи настроек и активируйте нужные.
Некоторые настройки не работают в других шаблонах личного кабинета. Подробности в FAQ

<h3>Шорткоды:</h3>

1. Есть шорткод выводящий счетчик обратного отсчёта до нового года. <code>[chr_counter]</code>
- разместите его в html-виджете или на нужной странице/записи и вы увидите счетчик дней, минут до нового года.
По наступлению часа "Х" ваши пользователи увидят небольшое пожелание: С новым годом!!! Пусть исполняются мечты!!!

Если вывести так: <code>[chr_counter width=200]</code> - то в атрибуте width передается ширина ячейки.
По умолчанию 102.


2. Есть шорткод выводящий ёлку с огнями и кошкой в ней. Украшения для сайдбара например. <code>[chr_tree]</code>
- разместите его в html-виджете или на нужной странице/записи и вы увидите ёлку, огни на ней и кошку.

Если вывести так: <code>[chr_tree color="#c4d8ff"]</code> - то в атрибуте color передавайте цвет заднего фона. Например, #e1e3f2
по умолчанию - белый.


3. Есть шорткод выводящий город. Дома в параллаксе (движение, ёлочка). Под этой анимацией текст и пожелание. <code>[chr_town]</code>
- его лучше размещать там где достаточно ширины. Например, виджет под личным кабинетом.  Разместите его в html-виджете или на нужной странице/записи и вы увидите праздничный город.

Можно передавать заголовок и текст: <code>[chr_town title="Скоро Новый Год!" text="Успей дела завершить и дальше жить!"]</code>

4. Радио Christmas (Heart Xmas). Используй шорткод <code>[chr_radio]</code> и радио с новогодними песнями будет играть без перерыва!




== FAQ ==
<h3>Шапка на аватарке не во всех шаблонах ЛК отображается. Почему?</h3>
- отображение шапки на аватарке в личном кабинете возможно только на этих шаблонах: theme-sunshine, theme-line, theme-grace, theme-clear-sky
В остальных шаблонах особенности верстки не позволили отобразить ее корректно.


<h3>Работает со всеми шаблонам WordPress?</h3>
- должно. Но у разных шаблонов свои особенности - поэтому если один из эффектов некорректно работает - отключайте его в админке.
Перед новым годом дел много других - проще так, чем ждать помощи. Предновогодняя суета и т.д.


<h3>Есть счетчик обратного отсчета до НГ?</h3>
- да. Смотри во вкладке Настройки



== Changelog ==
= 2021-12-25 =
v4.0
* Поддержка WP-Recall v16.25.14
* Добавлен новый шорткод - выведет новогоднюю елку с огнями и кошкой. Как украшение для сайдбара например.
* Добавлен новый шорткод - выводящий город. Дома в параллаксе (движение, ёлочка). Под этой анимацией текст и пожелание.
* Добавлен новый шорткод - Радио Christmas (Heart Xmas). Новогоднее радио.
- по шорткодам читай во вкладке "Настройки"
* Добавлено новое украшение - рамка аватарки в личном кабинете, словно замёрзшее окно, украшена снежинками. Из-за особенностей ЛК работает только в шаблонах Sunshine и Grace. Включается в настройках.
* Добавлено новое украшение (включается в настройках) - праздничная аватарка, для тех кто еще не загрузил себе аватарку. Высветится праздничный снеговик ⛄
А у кого стоит дополнение <a href="https://codeseller.ru/products/woman-man/" title="" target="_blank">Woman/man</a>
- тому будет аватарка по умолчанию - в зависимости от указанного пола. Девчатам - девчонку, парням - пацана. А кто застеснялся указать свой пол - тому снеговика.
* Добавлено новое украшение (включается в настройках) - 3 новогодних шара слева внизу сайта. Они появляются только если ширина сайта > 720px. Т.е. не для мобильников.
Первый шар - ведёт на главную страницу сайта. Второй - вход на сайт или переход в свой ЛК. Третий - выход с сайта.
* Новая опция в настройках "Отключить все эффекты в январе" - включив, В январе (если не указано) - отключит эффекты и шорткоды с 14-го числа. Указывайте число, например 8 - если хотите с 8-го января отключить все эффекты.
* В админке кнопка "Настройки Christmas Time" теперь празднично стилизована 🎄
* Шорткод chr_counter получил атрибут ширины ячейки.
* Избавился от старых css префиксов. Уже не актуальны
* Все стили раскидал по своим css файлам. Не грузится ничего лишнего. А только то что нужно.
* Уменьшен размер изображений.
* Новогодние сани укомплектованы по полной. Проверена работоспособность и подправлено то, что подкосилось, и мы готовы к длительному путешествию!



= 2020-12-14 =
v3.1
* поддержка новогодней шапки для связки: шаблон ЛК Theme Control + <a href="https://codeseller.ru/products/user-info-tab/" target="_blank">User Info Tab</a>
* исправил в админке неверный порядок изображений-примеров


= 2020-12-13 =
v3.0
* Добавлены новые праздничные украшения:
+ Стилизованный рейтинг (Иконки новогодние на рейтинг типов: "звёзды" и "мне нравится". "Звёзды" - на коробки с подарками, а "Мне нравится" - на сердце в новогоднем шаре)
+ Ёлка на открытие смайлов в ЛС (Иконка открытия смайлов в чате (и личных сообщениях) превратится из смайла в ёлку)
+ Звук входящего сообщения: хо-хо-хо (Звук входящего сообщения в чате (и личных сообщениях) поменяем на возглас Санты: "Хо-Хо-Хо")
+ Над формой входа текст (Над формой входа и регистрации увидим поздравительный текст)
+ Справа в реколлбаре в меню автора поздравление (Поздравительный текст в меню автора в реколлбаре справа)

- это всё включается через новогодние настройки!

Всех с 2021! Дело - это всегда громче всяких слов


= 2020-09-22 =
v2.4
* Работа с WP-Recall 16.24.0
* Дед Мороз пакует подарки, зайцы готовят сани


= 2019-12-18 =
v2.3
* Проведена инспекция работы эльфов и наличие всех оленей в упряжке. Состояние повозки оценивается как отличное. Новому году - БЫТЬ!  🎄 🎅 ☃ ❄


= 2018-12-12 =
v2.2
* Работа с WP-Recall 16.17
* Оптимизация всей графики
* В настройки добавлен счетчик обратного отсчета до нового года.
* появился шорткод выводящий счетчик обратного отсчёта до нового года. [chr_counter]
- разместите его в html-виджете или на нужной странице/записи и вы увидите счетчик дней, минут до нового года.
По наступлению часа "Х" ваши пользователи увидят небольшое пожелание: С новым годом!!! Пусть исполняются мечты!!!



= 2017-12-18 =
v2.1
* Работа с 16-й версией WP-Recall
* Коррекция под новые шаблоны ЛК
* Добавлена иконка дополнения


= 2016-12-02 =
v2.0
* Работа с 15-й версией WP-Recall.


= 2015-12-14 =
v1.0
* Release





== Прочее ==

* Поддержка осуществляется в рамках текущего функционала дополнения
* При возникновении проблемы, создайте соответствующую тему на форуме поддержки товара
* Если вам нужна доработка под ваши нужды - вы можете обратиться ко мне в <a href="https://codeseller.ru/author/otshelnik-fm/?tab=chat" target="_blank">ЛС</a> с техзаданием на платную доработку.

Все мои работы опубликованы <a href="https://otshelnik-fm.ru/?p=2562&utm_source=free-addons&utm_medium=addon-description&utm_campaign=christmas-time&utm_content=codeseller.ru&utm_term=all-my-addons" target="_blank">на моём сайте</a> и в каталоге магазина <a href="https://codeseller.ru/author/otshelnik-fm/?tab=publics&subtab=type-products" target="_blank">CodeSeller.ru</a>
