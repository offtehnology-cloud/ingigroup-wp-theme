# IngiGroup WordPress Theme

Классическая многостраничная тема WordPress, разработанная для проекта IngiGroup.

Цель: копия сайта https://ingigroup.ru/ один-в-один, с возможностью создавать и редактировать новые страницы в том же стиле.

Донор: https://ingigroup.ru/
Тест: https://ingigroup.xyz/
AI Context & Architecture Reference

Этот раздел предназначен для ИИ-ассистентов (Cursor, Copilot, ChatGPT) для быстрого понимания контекста проекта.

    Тип темы: Классическая тема WordPress (PHP / Хуки / Шаблоны)

    Текстовый домен (Text Domain): ingigroup (используй этот слаг во всех функциях локализации _e(), __())

    Сборщик скриптов: Отсутствует. Подключение статики — через wp_enqueue_script() / wp_enqueue_style() в inc/enqueue.php, версии через filemtime.

    Стек: AOS + GSAP + ScrollTrigger, Яндекс.Карты API, AJAX-форма через admin-ajax.php.

    Шрифт: Inter (Google Fonts), 100–900.

Ключевая структура файлов для ИИ:

    functions.php — точка входа, только подключает файлы из inc/* через require.

    inc/enqueue.php — регистрация стилей и скриптов, версии через filemtime.

    inc/setup.php — регистрация меню.

    inc/customizer.php — настройки Customizer, всё через get_theme_mod() с дефолтом.

    inc/cpt.php — кастомные типы записей (project, service, opinion, certificate) + таксономия project_category.

    inc/meta-boxes.php — метаполя проекта (регион, заказчик, работы, дополнительно, галерея).

    inc/ajax-form.php — обработка AJAX-формы.

    style.css — обязательный файл мета-данных WordPress темы.

    assets/css/main.css — глобальные стили (десктоп) + секция «Проекты» + dropdown-меню.

    assets/css/responsive.css — media-запросы.

    assets/css/hotfix.css — правки последним (перебивает main.css).

    assets/css/style.css — обязательный.

    assets/js/main.js — всё: меню, форма, карта, AOS, GSAP.

    assets/images/ — картинки + logo-horizontal.png.

    inc/ — директория для модульного PHP-кода (кастомные функции, обработчики форм, хуки, настройки кастомайзера).

    template-parts/ — изолированные и переиспользуемые фрагменты разметки.

    header.php & footer.php — семантический верх и низ сайта, вызываются через get_header() и get_footer().

Шаблоны страниц:

    front-page.php — главная.

    page.php — внутренние страницы.

    index.php — резервный шаблон.

    archive-project.php — хаб /projects/.

    taxonomy-project_category.php — /projects/<term>/.

    single-project.php — детальная /project/<slug>/.

Ключевые параметры:

Цвета (CSS-переменные):
css

--orange:        rgb(239, 126, 25)
--accent-soft:   rgb(251, 175, 90)
--dark:          rgb(18, 18, 18)
--dark-2:        rgb(30, 30, 30)
--grey-333:      #333
--container:     1140px

Шрифты:

    Заголовки секций: 51px, weight 700, uppercase

    Основной текст: 16px, line-height 1.43

    Слоган в шапке: 17px, weight 600

    Телефон: 26px, weight 700

Начало работы и Установка
Локальное окружение

Для работы темы требуется установленный локальный сервер с WordPress (например, Local WP, OpenServer, Docker или Laragon).
Шаги по установке:

    Перейдите в директорию с темами вашего WordPress-сайта:
    bash

    cd wp-content/themes/

    Склонируйте данный репозиторий:
    bash

    git clone https://github.com/offtehnology-cloud/ingigroup-wp-theme.git ingigroup

    Перейдите в административную панель WordPress: Внешний вид → Темы.

    Найдите тему IngiGroup и нажмите Активировать.

    После активации зайдите в Настройки → Постоянные ссылки и нажмите Сохранить (сброс permalinks).

Правила расширения проекта (Гайдлайн для ИИ)

При генерации нового кода для этой темы строго следуй правилам архитектуры:

    Логика отдельно от разметки: не пиши массивные функции внутри шаблонов страниц. Выноси логику в виде функций или классов в папку inc/, а затем подключай файлы через require в functions.php.

    Переиспользуемый HTML: если элемент структуры повторяется (карточка проекта, кастомный баннер), изолируй его в template-parts/ и вызывай через get_template_part('template-parts/имя-файла').

    Статика: скрипты и кастомные стили распределяй строго по соответствующим папкам внутри assets/. Подключение новых скриптов делай исключительно через wp_enqueue_script() в inc/enqueue.php.

    Правки стилей: при конфликтах проверяй hotfix.css первым — он подключается последним и перебивает main.css.

    Версии: если правки не применяются, проверь версию в inc/enqueue.php через filemtime.

    SVG: иконки забирать с донора через Copy element в DevTools, не рисовать. SVG Creatium подгружаются JS, в исходнике их нет.

    Мобильная вёрстка: data-aos на мобилке отключён ([data-aos] { opacity: 1 !important; }). Если добавляешь новую секцию, не полагайся на AOS в мобильной вёрстке.

    CPT и permalinks: после любых изменений в register_post_type / register_taxonomy / rewrite_rules_array → сразу Настройки → Постоянные ссылки → Сохранить, иначе 404.

    Слаги CPT vs taxonomy: у CPT project и таксономии project_category слаги должны различаться (project vs projects), иначе rewrite-конфликт.

    get_theme_mod: всегда со вторым аргументом-дефолтом.

Что сделано
Главная страница — 100%

Десктоп:

    Шапка: тёмный блок лого 245px, слоган 17px #333, меню с оранжевым hover, телефон 26px

    Оранжевая полоса услуг: 6 пунктов в одну строку, padding 8–9px

    Hero: min-height 700px, заголовок 64px, кнопка outline-orange

    Наши услуги: 4 карточки, gap 0, чёрный фон, тёмная плашка под текстом

    Преимущества: 2 сетки (3 + 4 колонки), SVG-иконки 75px absolute

    Сертификаты/Отзывы: 5 колонок, box-shadow, hover translateY

    CTA-форма: картинка 586px, align-items:end

    Карта: панель absolute top:30px, width auto, canvas 560px

    Футер: footer__top (лого 245px + TG/WA), footer__cols (1.6fr 1fr 1.4fr)

    AOS + GSAP работают

Мобилка:

    Шапка: лого 88px, фон #121212, слоган 13px

    Оранжевая полоса скрыта

    Бургер: белый справа на оранжевом фоне, открывает оранжевое меню

    Телефон: 24px белый по центру оранжевой полосы

    Услуги: 1 колонка

    Преимущества: 1 колонка, иконки 40px

    Сертификаты/Отзывы: 2 колонки (включая ≤480px)

    CTA: адаптивная картинка, форма по центру

    Карта: панель static над картой, canvas 320px

    Футер: 1 колонка, по центру

    AOS отключён: [data-aos] { opacity: 1 !important; }

Раздел «Проекты» — 100%

    Все 30 проектов импортированы, счётчики: 11 / 8 / 11 (ustanovka-rsp / vyrubka-dkr / obshchestroitelnye-raboty).

    Дубли: №15 (дубль №09) удалён; №21 и №23 оставлены.

    Импортёры удалены с сервера.

Архитектура URL:
URL	Шаблон
/projects/	archive-project.php
/projects/<term>/	taxonomy-project_category.php
/project/<slug>/	single-project.php

CPT и таксономия:

    CPT project: has_archive => 'projects', rewrite.slug => 'project'

    Taxonomy project_category: rewrite.slug => 'projects', hierarchical => true

    3 термина автосоздаются при активации темы через after_switch_theme.

Метаполя проекта:
Ключ	Формат	Где в шаблоне
_project_region	строка	плашка «Регион: …»
_project_customer	строка	«ЗАКАЗЧИК: …»
_project_works	многострочный, \n между пунктами	список работ
_project_additional	то же	блок «Дополнительно»
_project_gallery	CSV ID вложений	сетка галереи
post_content	«Объект: …»	описание над работами
menu_order	1..30	сортировка в листингах

Соглашения по разделу:

    Строка, начинающаяся с ## , рендерится как жирный подзаголовок в single-project.php. В project-card.php такие строки отфильтровываются.

    Порядок в листингах: menu_order ASC, затем date ASC.

    Breadcrumbs: template-parts/breadcrumbs.php, универсальный.

    Выпадашка в шапке: .topbar__menu .sub-menu, в wp_nav_menu нужен 'depth' => 2 или больше.

Инфраструктура (готова)

    inc/cpt.php — зарегистрированы 4 CPT: project, service, opinion, certificate + таксономия project_category. Наполнен только project.

    inc/meta-boxes.php — поля проекта.

    inc/ajax-form.php — обработчик формы (проверка end-to-end не выполнена).

    inc/customizer.php — настройки темы через get_theme_mod.

    inc/setup.php — регистрация меню.

Что осталось

    Внутренние страницы:

        О компании (/company)

        Сертификаты (/certificates) — CPT certificate уже есть

        Отзывы (/opinions) — CPT opinion уже есть

        Контакты (/contacts)

        Подстраницы услуг — CPT service уже есть (5 штук)

    Проверка AJAX-формы end-to-end.

    SEO: title, description, OG.

    Оптимизация производительности: preload шрифтов, lazy для карты, defer для main.js.

    Кросс-браузерное тестирование.

    Перенос на боевой хостинг.

Как мы работаем
Процесс

    Пользователь присылает 2 скрина: оригинал (донор) + тест секции.

    Ассистент даёт правки — код целиком или конкретные правила.

    Пользователь применяет, Ctrl+Shift+R, проверяет.

    Точные размеры — через DevTools (F12 → Computed) на оригинале.

    При конфликтах — скриншот из DevTools + код элемента.

Правила

    Давать полный код файла, если правок много.

    Проверять hotfix.css при конфликтах — подключается последним.

    Точные пиксели подбирает пользователь.

    SVG забирать с донора через Copy element, не рисовать.

    Всё через get_theme_mod() с дефолтом.

    При старте нового трека — начать с одной страницы/секции, задать паттерн, потом переиспользовать.

Известные грабли

    Кэш: Ctrl+Shift+R + filemtime в enqueue.php.

    hotfix.css перебивает main.css — проверять первым при конфликтах.

    Если правки не применяются — версия в inc/enqueue.php через filemtime.

    SVG Creatium подгружаются JS, в исходнике их нет — брать через Copy element в DevTools.

    Мобильный бургер требует правок в header.php + main.css + main.js — три места.

    data-aos отключать на мобилке — [data-aos] { opacity: 1 !important; }.

    Отрицательные margin для растягивания блоков на мобилке.

    get_theme_mod всегда со вторым аргументом-дефолтом.

    Permalinks: после любых изменений в CPT/таксономии/rewrite — Сохранить permalinks, иначе 404.

    Слаги CPT vs taxonomy должны различаться (project vs projects), иначе rewrite-конфликт.

Лицензия

Собственная разработка / Свободное использование для проекта IngiGroup.
