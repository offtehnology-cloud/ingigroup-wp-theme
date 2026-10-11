# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v5
**Дата обновления:** 11 октября 2026 г.
**Статус:** главная закрыта, «Проекты» закрыты (30/30), «О компании» закрыта, «Сертификаты» закрыта, «Отзывы» закрыта.
**В работе:** «Контакты», «Услуги».

Этот файл — единственный источник контекста. Присылать только его, оба старых файла не нужны.

---

## 1. Цель

Кастомная WordPress-тема — копия сайта https://ingigroup.ru/ один-в-один, с возможностью создавать и редактировать новые страницы в том же стиле.

Компания «ИНЖИГРУПП» — инжиниринговая (не девелопер). Направления:
- Установка рельсовых страховочных пакетов (РСП)
- Вырубка древесно-кустарниковой растительности (ДКР)
- Общестроительные работы (сети, СМР, настилы)

---

## 2. Ссылки

- Донор: https://ingigroup.ru/
- Тест: https://ingigroup.xyz/
- GitHub: https://github.com/offtehnology-cloud/ingigroup-wp-theme (последняя рабочая сохранённая тема)
- Локальная тема: `wp-content/themes/ingigroup/`
- Админка: https://ingigroup.xyz/wp-admin/
- Проекты в админке: https://ingigroup.xyz/wp-admin/edit.php?post_type=project
- Категории проектов: https://ingigroup.xyz/wp-admin/edit-tags.php?taxonomy=project_category&post_type=project
- Сертификаты в админке: https://ingigroup.xyz/wp-admin/edit.php?post_type=certificate
- Отзывы в админке: https://ingigroup.xyz/wp-admin/edit.php?post_type=opinion
- Постоянные ссылки (сброс permalinks): https://ingigroup.xyz/wp-admin/options-permalink.php

---

## 3. Стек

- WordPress, кастомная тема `ingigroup`
- Шрифт: Inter (Google Fonts), 100–900
- Анимации: AOS + GSAP + ScrollTrigger
- Карта: Яндекс.Карты API
- Форма: AJAX через `admin-ajax.php`

---

## 4. Структура темы

```
functions.php          — загрузчик, подключает inc/*
inc/enqueue.php        — стили/скрипты, версии через filemtime
inc/setup.php          — регистрация меню
inc/customizer.php     — настройки Customizer
inc/cpt.php            — CPT (project, service, opinion, certificate) + таксономия + rewrite-приоритет архивов
inc/meta-boxes.php     — поля проекта
inc/meta-boxes-opinion.php  — поля отзыва (автор, должность)
inc/ajax-form.php      — обработка формы

header.php             — шапка + бургер + мобильное меню
footer.php             — подвал
front-page.php         — главная

page-company.php                    — /company
archive-project.php                 — хаб /projects/
single-project.php                  — детальная /project/<slug>/
taxonomy-project_category.php       — /projects/<term>/
archive-certificate.php             — /certificates/ (сетка сканов + лайтбокс)
archive-opinion.php                 — /opinions/ (карточки + сетка сканов + лайтбокс)
single-opinion.php                  — /opinions/<slug>/ → 301 редирект на архив

template-parts/
  ├── hero.php
  ├── services.php
  ├── advantages.php   — 7 SVG-иконок
  ├── certificates.php
  ├── opinions.php
  ├── cta-form.php
  ├── map.php
  ├── breadcrumbs.php
  ├── project-card.php
  └── company/         — парты страницы «О компании» (см. §6.3)
      ├── director.php
      ├── stats.php
      ├── projects-preview.php
      ├── certs-preview.php
      └── opinions-preview.php

assets/css/
  ├── main.css         — десктоп + секция «ПРОЕКТЫ» + dropdown-меню + сетка сертификатов + лайтбокс + сетка отзывов и их сканов
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, форма, карта, AOS, GSAP, универсальный лайтбокс (сертификаты + сканы отзывов)
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg + opinion-1..opinion-9.jpg
```

**Удалены** после закрытия «Проектов»: все `inc/import-projects*.php` (batch1–batch7), соответствующие `require` из `functions.php` убраны.

---

## 5. Ключевые параметры

### Цвета (CSS-переменные)

```
--orange:        rgb(239, 126, 25)
--accent-soft:   rgb(251, 175, 90)
--dark:          rgb(18, 18, 18)
--dark-2:        rgb(30, 30, 30)
--grey-333:      #333
--container:     1140px
```

### Шрифты

- Inter (100–900)
- Заголовки секций: 51px, weight 700, uppercase
- Заголовки внутренних страниц («О компании», «Сертификаты», «Отзывы»): 32px, weight 700, uppercase (компактнее, как у донора)
- Основной текст: 16px, line-height 1.43
- Слоган в шапке: 17px, weight 600
- Телефон: 26px, weight 700

### CPT и таксономии (из `inc/cpt.php`)

| CPT | rewrite.slug | has_archive | Архив URL | supports |
|-----|--------------|-------------|-----------|----------|
| `service` | `services` | `true` | `/services/` | title, editor, thumbnail, excerpt, page-attributes |
| `project` | `project` | `projects` | `/projects/` | title, editor, thumbnail, excerpt, page-attributes |
| `opinion` | `opinions` | `true` | `/opinions/` | title, editor, thumbnail |
| `certificate` | `certificates` | `true` | `/certificates/` | title, thumbnail, page-attributes |

Таксономия `project_category` (только для `project`):
- `rewrite.slug => 'projects'` → `/projects/<term>/`
- `hierarchical => true`
- `show_admin_column => true`

**Важно про `certificate`:** поддерживает только `title`, `thumbnail`, `page-attributes` — **без `editor`**. Значит, в админке у сертификата нет основного редактора, только заголовок и миниатюра. Если понадобится описание — добавить `editor` в `supports`.

### Приоритет rewrite для архивов CPT

Фильтр `rewrite_rules_array` в `inc/cpt.php` даёт приоритет архивам CPT над страницами с тем же слагом и над правилами таксономии. **Расширен 11.10.2026** — теперь покрывает все 4 архива:

```php
$prefix = [
    'projects/?$'                   => 'index.php?post_type=project',
    'projects/page/([0-9]+)/?$'     => 'index.php?post_type=project&paged=$matches[1]',

    'certificates/?$'               => 'index.php?post_type=certificate',
    'certificates/page/([0-9]+)/?$' => 'index.php?post_type=certificate&paged=$matches[1]',

    'opinions/?$'                   => 'index.php?post_type=opinion',
    'opinions/page/([0-9]+)/?$'     => 'index.php?post_type=opinion&paged=$matches[1]',

    'services/?$'                   => 'index.php?post_type=service',
    'services/page/([0-9]+)/?$'     => 'index.php?post_type=service&paged=$matches[1]',
];
return $prefix + $rules;
```

**Не трогать** — без этого `/projects/` матчится как термин, а `/certificates/` может перехватиться страницей с тем же слагом и отдать 404 или пустую страницу.

---

## 6. Что сделано

### 6.1. Главная страница — 100%

**Десктоп:**
- Шапка: тёмный блок лого 245px, слоган 17px #333, меню с оранжевым hover, телефон 26px
- Оранжевая полоса услуг: 6 пунктов в одну строку, padding 8–9px
- Hero: min-height 700px, заголовок 64px, кнопка outline-orange
- Наши услуги: 4 карточки, gap 0, чёрный фон, тёмная плашка под текстом
- Преимущества: 2 сетки (3 + 4 колонки), SVG-иконки 75px absolute
- Сертификаты/Отзывы: 5 колонок, box-shadow, hover translateY
- CTA-форма: картинка 586px, align-items:end
- Карта: панель absolute top:30px, width auto, canvas 560px
- Футер: `footer__top` (лого 245px + TG/WA), `footer__cols` (1.6fr 1fr 1.4fr)
- AOS + GSAP работают

**Мобилка:**
- Шапка: лого 88px, фон #121212, слоган 13px
- Оранжевая полоса скрыта
- Бургер: белый справа на оранжевом фоне, открывает оранжевое меню
- Телефон: 24px белый по центру оранжевой полосы
- Услуги: 1 колонка
- Преимущества: 1 колонка, иконки 40px
- Сертификаты/Отзывы: 2 колонки (включая ≤480px)
- CTA: адаптивная картинка, форма по центру
- Карта: панель static над картой, canvas 320px
- Футер: 1 колонка, по центру
- AOS отключён: `[data-aos] { opacity: 1 !important; }`

### 6.2. Раздел «Проекты» — 100%

**Состояние:**
- Все 30 проектов импортированы, счётчики по категориям: **11 / 8 / 11** (ustanovka-rsp / vyrubka-dkr / obshchestroitelnye-raboty).
- Дубли: №15 (дубль №09) удалён; №21 и №23 оставлены — разные объекты, частичное пересечение фото.
- Импортёры удалены с сервера, `require` из `functions.php` убраны.
- Фронт раздела проверен на десктопе и мобилке.

**Архитектура URL:**

| URL | Что отдаёт | Шаблон |
|---|---|---|
| `/projects/` | Хаб с 3 карточками-подразделами | `archive-project.php` |
| `/projects/ustanovka-rsp/` | Список проектов категории + nav 01..N | `taxonomy-project_category.php` |
| `/projects/vyrubka-dkr/` | То же | `taxonomy-project_category.php` |
| `/projects/obshchestroitelnye-raboty/` | То же | `taxonomy-project_category.php` |
| `/project/<slug>/` | Детальная страница проекта | `single-project.php` |

**Метаполя проекта:**

| Ключ | Формат | Где в шаблоне |
|---|---|---|
| `_project_region` | строка | плашка «Регион: …» |
| `_project_customer` | строка | «ЗАКАЗЧИК: …» |
| `_project_works` | многострочный, `\n` между пунктами | список работ |
| `_project_additional` | то же | блок «Дополнительно» |
| `_project_gallery` | CSV ID вложений | сетка галереи |
| `post_content` | `«Объект: …»` | описание над работами |
| `menu_order` | 1..30 | сортировка в листингах |

**Соглашения по разделу:**
- Подзаголовки: строка, начинающаяся с `## `, рендерится как жирный подзаголовок в `single-project.php`. В `project-card.php` такие строки отфильтровываются и не считаются в «…и ещё N».
- Порядок в листингах: `menu_order ASC`, затем `date ASC`.
- Breadcrumbs: `template-parts/breadcrumbs.php`, универсальный — работает на архиве, таксономии и детальной.
- Выпадашка в шапке: `.topbar__menu .sub-menu`, в `wp_nav_menu` для шапки нужен `'depth' => 2` или больше.

**Правила работы с разделом:**
- Любые изменения в `register_post_type` / `register_taxonomy` / `rewrite_rules_array` → сразу `Настройки → Постоянные ссылки → Сохранить`.
- При правках `main.css` помнить про `hotfix.css` — он подключается последним и перебивает.
- Версии в `inc/enqueue.php` через `filemtime` — если правки не видны, проверь его первым.
- `data-aos` на мобилке отключён — если добавляешь новую секцию, не полагайся на AOS в мобильной вёрстке.

### 6.3. Страница «О компании» (`/company`) — 100%

**Структура (сознательно отличается от донора):**

Донор `ingigroup.ru/company` выводит **все** 30 проектов, 10 сертификатов и 4 отзыва на одной странице. У нас — **тизеры** (6 / 4 / 3), потому что:
- у сайта есть отдельные разделы `/projects`, `/certificates`, `/opinions`;
- дублировать контент = каннибализация SEO;
- цель страницы — доверие + переход в разделы, а не каталог.

**Порядок секций:**

```
1. Хлебные крошки
2. H1 «О компании ООО «ИНЖИГРУПП»» (32px, uppercase)
3. Интро: текст слева + фото директора справа (grid 1fr / 320px)
4. Блок «Цифры» — 3 плитки (значение + подпись)
5. Тизер «Сданные объекты» — 6 строк .work-item + кнопка «Все N проектов»
6. Тизер «Сертификаты» — 4 превью + кнопка (флаг $show_certs)
7. Тизер «Отзывы» — 3 превью + кнопка (флаг $show_opinions)
8. CTA-форма (template-parts/cta-form.php)
9. Карта (template-parts/map.php, если существует)
```

**Флаги секций** — в первой строке `page-company.php`:

```php
$show_certs    = true;
$show_opinions = true;
```

Поставить `false` — секция не выводится.

**Парты `template-parts/company/`:**

| Файл | Назначение | Источник данных |
|------|------------|-----------------|
| `director.php` | Фото + имя + должность | Customizer, фолбэк — `assets/images/director.jpg` |
| `stats.php` | 3 плитки «цифры» | Фильтр `ingigroup_company_stats` |
| `projects-preview.php` | 6 строк `.work-item` | CPT `project`, `menu_order ASC` |
| `certs-preview.php` | 4 превью сертификатов + кнопка | CPT `certificate` |
| `opinions-preview.php` | 3 превью отзывов + кнопка | CPT `opinion` |

**Честная подпись про неполное портфолио:** в `projects-preview.php` заголовок считается через `wp_count_posts('project')->publish`. Если проектов в базе > 6 — подзаголовок «Примеры из N реализованных проектов» + кнопка «Все N проектов». Если ≤ 6 — «Примеры из нашего портфолио» + «Все проекты». Это отражает факт, что на сайте пока не все объекты.

**Кнопки тизеров ведут в архивы CPT (проверено против `inc/cpt.php`):**
- `projects-preview.php` → `get_post_type_archive_link('project')` = `/projects/` ✓
- `certs-preview.php` → `/certificates/` ✓
- `opinions-preview.php` → `/opinions/` ✓

**Заголовок H1** — 32px (не 51px как на других страницах). Обоснование: у донора H1 тоже компактный, плюс так меньше «давит» на интро-абзац.

### 6.4. Хлебные крошки (`template-parts/breadcrumbs.php`) — универсальные

**Поддержка (расширено 11.10.2026):**
- Главной
- Обычных страниц (в т.ч. **вложенных** — через `get_post_ancestors()`)
- Архива и таксономии CPT `project`
- Одиночного `project`
- **Архивов `certificate`, `opinion`, `service`** — через `is_post_type_archive( array(...) )` + `get_post_type_object()->labels->name`
- Записей блога (`post`) и архива блога
- Поиска и 404

**Ключевая ветка (новая, после блока project):**

```php
elseif ( is_post_type_archive( array( 'certificate', 'opinion', 'service' ) ) ) {
    $pt_slug = get_query_var( 'post_type' );
    if ( is_array( $pt_slug ) ) { $pt_slug = reset( $pt_slug ); }
    $pt_obj = $pt_slug ? get_post_type_object( $pt_slug ) : null;
    if ( $pt_obj ) {
        $items[] = array(
            'url'   => '',
            'label' => $pt_obj->labels->name,
        );
    }
}
```

Метка берётся из `labels->name` CPT — при переименовании CPT в `cpt.php` крошки подтянут новое название автоматически. Одна ветка закрывает все три архива и любые будущие.

**Технические детали:**
- Обёрнуты в `<div class="container">` — в шаблонах не оборачивать повторно.
- Последний элемент получает класс `breadcrumbs__current`.
- Разделитель `›` — `aria-hidden="true"`.
- Guard: `if ( ! defined( 'ABSPATH' ) ) return;` (не `exit`, чтобы не обрывать рендер).

**Важно для `page-company.php`, `archive-certificate.php`, `archive-opinion.php`:** вызов крошек идёт **до** `<div class="container">`, потому что контейнер уже внутри крошек.

### 6.5. Customizer — новые настройки

В `inc/customizer.php` добавлена секция **«Внешний вид → Настроить → Страница «О компании»»**:

| `theme_mod` | Тип контрола | Дефолт |
|---|---|---|
| `director_photo` | `WP_Customize_Image_Control` | `''` (фолбэк — файл `director.jpg`) |
| `director_name` | text | `Марат Хуснутдинов` |
| `director_role` | text | `Директор ООО «ИНЖИГРУПП»` |

Заказчик загружает фото через админку — FTP больше не нужен. В `director.php` — `get_theme_mod()` со вторым аргументом-дефолтом.

Если файл не загружен ни через Customizer, ни лежит в `assets/images/director.jpg` — выводится серая заглушка `.company-director__placeholder` (aspect-ratio 4/5). Вёрстка не схлопывается.

### 6.6. Фикс мобильной панели адреса на карте

**Проблема:** `.map-section__panel` имел `position: absolute; min-width: 480px; padding: 25px 60px`. На экране 375px не сжимался, уходил за оба края.

**Решение (в `hotfix.css`, не трогает `main.css`):**
- **≤991px:** `min-width: 0`, `width: calc(100% - 40px)`, `max-width: 480px`, боковые паддинги 30px.
- **≤767px:** панель выходит из absolute (`position: static; transform: none`), встаёт **над картой** как обычный блок, карта снизу. Горизонтальный скролл исчезает физически.

**Не забыть при копировании этого фикса:** `.map-section__panel` использует `transform: translateX(-50%)` для центрирования — на мобилке его **обязательно** сбрасывать вместе с `position: static`, иначе панель уедет влево.

### 6.7. Инфраструктура (готова)

- `inc/cpt.php` — зарегистрированы 4 CPT: `project`, `service`, `opinion`, `certificate` + таксономия `project_category`. Наполнен `project`; `certificate` и `opinion` используют файловые фолбэки (см. §6.8, §6.9); `service` пока пуст.
- `inc/meta-boxes.php` — поля проекта (регион, заказчик, работы, дополнительно, галерея).
- `inc/meta-boxes-opinion.php` — поля отзыва (автор, должность). **Подключён через `require` в `functions.php`.**
- `inc/ajax-form.php` — обработчик формы. **End-to-end тест отложен до переноса на боевой хостинг.**
- `inc/customizer.php` — настройки темы + директор.
- `inc/setup.php` — регистрация меню.

### 6.8. Страница «Сертификаты» (`/certificates`) — 100%

**Шаблон:** `archive-certificate.php`.

**Логика данных — гибрид:**
1. Сначала CPT `certificate` — `posts_per_page => -1`, сортировка `menu_order ASC, date ASC`. Посты **без `thumbnail` пропускаются** (у CPT нет `editor`, единственный полезный контент — миниатюра).
2. Если CPT пуст — **фолбэк на файлы** `assets/images/cert-1.jpg … cert-10.jpg`.
3. Если ни то, ни другое — `.certificates-empty` «Сертификаты скоро появятся».

**Структура страницы:**

```
1. Хлебные крошки
2. H1 «СЕРТИФИКАТЫ»  (32px, uppercase — .page-title)
3. Сетка .certificates-grid  (5 колонок, gap 20px)
4. CTA-форма
5. Карта (locate_template guard)
```

**Разметка карточки:** `<a class="certificate-card" href="{full}">` с `<img loading="lazy" decoding="async">`. Клик перехватывается JS, `href` — источник для лайтбокса.

### 6.9. Страница «Отзывы» (`/opinions`) — 100%

**Шаблоны:** `archive-opinion.php` (архив), `single-opinion.php` (301-редирект на архив), `inc/meta-boxes-opinion.php` (метаполя).

**Структура архива:**

```
1. Хлебные крошки
2. H1 «ОТЗЫВЫ»  (32px, uppercase)
3. Сетка .opinions-grid — текстовые карточки CPT opinion  (3 колонки, gap 24px)
4. Сетка .opinions-scans-grid — сканы-оригиналы из файлов opinion-1..9.jpg
   (только если файлы найдены)
   H2 «Оригиналы отзывов» — только если выше есть карточки CPT
5. CTA-форма
6. Карта (locate_template guard)
```

**Содержимое карточки отзыва:**

| Элемент | Источник |
|---|---|
| Логотип (опционально) | `get_the_post_thumbnail_url()` — миниатюра поста |
| Название компании | `the_title()` |
| Текст отзыва | `the_content()` в `<blockquote class="opinion-card__quote">` |
| Автор | метаполе `_opinion_author` |
| Должность | метаполе `_opinion_role` |

Если логотипа/автора/должности нет — соответствующий блок не выводится, карточка не разваливается.

**Метаполя отзыва (`inc/meta-boxes-opinion.php`):**

| Ключ | Формат | Контрол |
|---|---|---|
| `_opinion_author` | строка | `text` input в metabox «Подпись отзыва» |
| `_opinion_role` | строка | `text` input в metabox «Подпись отзыва» |

Nonce + `current_user_can` + `DOING_AUTOSAVE` проверены. Sanitize через `sanitize_text_field()`.

**Логика сканов — гибрид (аналогично сертификатам):**
1. Если CPT `opinion` **не пуст** → карточки сверху + секция «Оригиналы отзывов» снизу с H2.
2. Если CPT **пуст**, но файлы есть → только сетка сканов, **без H2** (сканы и есть контент страницы).
3. Если ни CPT, ни файлов → `.opinions-empty` «Отзывы скоро появятся».

**Флаги `$has_posts` / `$has_scans`** вычисляются вверху шаблона и управляют всей логикой отображения.

**Редирект одиночного отзыва (`single-opinion.php`):**
- У отзывов нет отдельной страницы — весь контент на `/opinions/`.
- `wp_safe_redirect( get_post_type_archive_link('opinion'), 301 ); exit;`
- Фолбэк: если архив недоступен, редирект на главную.

**CSS — где что:**
- `main.css`: `.opinions-archive .page-title`, `.opinions-grid`, `.opinion-card` (+ `__logo`, `__company`, `__quote`, `__sign`, `__author`, `__role`), `.opinions-scans`, `.opinions-scans__title`, `.opinions-scans-grid`, `.opinions-empty`.
- `responsive.css`: `≤991px` — opinions-grid 2 колонки, scans-grid 3 колонки; `≤767px` — opinions-grid 1 колонка, scans-grid 2 колонки, H1 26px.

Сканы отзывов используют **тот же класс `.certificate-card`**, что и сертификаты — вся вёрстка (белая рамка, тень, hover) наследуется автоматически.

### 6.10. Лайтбокс (`main.js`) — универсальный

**Что изменилось 11.10.2026:** лайтбокс вынесен в универсальный IIFE, который собирает карточки **со всех поддерживающих сеток** на странице.

```js
const GRID_SELECTORS = [ '.certificates-grid', '.opinions-scans-grid' ];
```

- Если на странице **нет** ни одной из этих сеток → лайтбокс не инициализируется (guard `if ( ! links.length ) return;`).
- Если есть → все `.certificate-card` из обеих сеток объединяются в один список, навигация ходит по всему массиву.
- Всё остальное (открытие/закрытие, клавиатура, свайпы, `aria-*`, `body.lightbox-open`) — как в §6.8, без изменений.

**Использование:** любой шаблон, желающий открывать картинки в лайтбоксе, просто оборачивает их в `<a class="certificate-card" href="{full}">`. Сетку-контейнер нужно добавить в `GRID_SELECTORS`.

---

## 7. Что осталось

1. **Внутренние страницы** (основной трек):
   - ✅ О компании (`/company`) — закрыта
   - ✅ Сертификаты (`/certificates`) — закрыта
   - ✅ Отзывы (`/opinions`) — закрыта (карточки + сканы + лайтбокс)
   - **Контакты** (`/contacts`) — статическая + карта
   - **Услуги** — `archive-service.php` (CPT-архив `/services/`) + `single-service.php` (5 детальных)
2. **Проверка AJAX-формы** end-to-end — **отложена до боевого хостинга**.
3. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
4. **Оптимизация производительности:** preload шрифтов, lazy для карты, `defer` для `main.js`, перевод сертификатов и отзывов в медиатеку.
5. **Кросс-браузерное тестирование.**
6. **Перенос на боевой хостинг.**

---

## 8. Как мы работаем

### Процесс
1. Пользователь присылает 2 скрина: оригинал (донор) + тест секции.
2. Ассистент даёт правки — код целиком или конкретные правила.
3. Пользователь применяет, Ctrl+Shift+R, проверяет.
4. Точные размеры — через DevTools (F12 → Computed) на оригинале.
5. При конфликтах — скриншот из DevTools + код элемента.

### Правила
- Давать полный код файла, если правок много.
- Проверять `hotfix.css` при конфликтах — подключается последним.
- Точные пиксели подбирает пользователь.
- SVG забирать с донора через Copy element, не рисовать.
- Всё через `get_theme_mod()` с дефолтом во втором аргументе.
- При старте нового трека — начать с одной страницы/секции, задать паттерн, потом переиспользовать.
- Не копировать донора буквально, если структура нашего сайта отличается (например, наличие отдельных разделов) — оценивать по цели страницы.
- Хендовер-файл присылать одним markdown-блоком **с четырьмя обратными кавычками** для внешней обёртки, иначе вложенные блоки ``` ломают разметку.

---

## 9. Известные грабли

1. **Кэш:** Ctrl+Shift+R + `filemtime` в `enqueue.php`.
2. **`hotfix.css` перебивает `main.css`** — проверять первым при конфликтах.
3. **Если правки не применяются** — версия в `inc/enqueue.php` через `filemtime`.
4. **SVG Creatium подгружаются JS**, в исходнике их нет — брать через Copy element в DevTools.
5. **Мобильный бургер** требует правок в `header.php` + `main.css` + `main.js` — три места.
6. **`data-aos` отключать на мобилке** — `[data-aos] { opacity: 1 !important; }`.
7. **Отрицательные margin** для растягивания блоков на мобилке.
8. **`get_theme_mod` всегда со вторым аргументом-дефолтом.**
9. **Permalinks:** после любых изменений в CPT/таксономии/rewrite — Сохранить permalinks, иначе 404.
10. **Слаги CPT vs taxonomy должны различаться** (`project` vs `projects`), иначе rewrite-конфликт.
11. **`var(--grey-333)` может быть не определена** в `main.css` в каком-то контексте — использовать с фолбэком: `var(--grey-333, #333)`.
12. **`locate_template('template-parts/map.php')`** — если файла нет, секция молча пропускается. Не фатальная ошибка, но карта не выведется — проверять при переносе.
13. **`certificate` CPT — без `editor`.** В `supports` только `title`, `thumbnail`, `page-attributes`. Если понадобится описание сертификата — расширить `supports` в `inc/cpt.php`.
14. **Страница-двойник перебивает архив CPT.** Если в админке есть `page` со слагом, совпадающим с `rewrite.slug` CPT (`certificates`, `opinions`, `services`, `projects`), WP отдаёт страницу, а не архив. Симптом: H1 = заголовок страницы (а не наши `.page-title`), крошек нет, кастомной разметки нет. **Лечение:** удалить страницу-двойник из админки + Сохранить permalinks.
15. **Rewrite-приоритет покрывает все 4 архива.** При добавлении нового CPT — **дописать пару правил** в `$prefix` в `inc/cpt.php`, иначе новый архив может не открыться.
16. **Лайтбокс ищет сетки по `GRID_SELECTORS` в `main.js`.** Если новая страница хочет открывать картинки в лайтбоксе — её контейнер нужно добавить в массив (сейчас: `.certificates-grid`, `.opinions-scans-grid`). Класс карточек всегда `.certificate-card`.
17. **`archive-opinion.php` использует флаги `$has_posts` / `$has_scans`.** Если CPT `opinion` пуст, но есть файлы `opinion-N.jpg` — H2 «Оригиналы отзывов» **не выводится** (нечего разделять). Не возвращать безусловный H2, иначе на пустой CPT страница выглядит сломанной.
18. **Файловые фолбэки регистрозависимы.** `opinion-1.jpg` подхватится, `Opinion-1.JPG` — нет. При переносе на боевой хостинг (Linux) проверить регистр всех файлов в `assets/images/`.

---

## 10. Что дальше

Продолжаем внутренние страницы в порядке:

1. ✅ **О компании** (`/company`) — закрыта.
2. ✅ **Сертификаты** (`/certificates`) — закрыта.
3. ✅ **Отзывы** (`/opinions`) — закрыта.
4. **Контакты** (`/contacts`) — статическая + карта (переиспользовать `template-parts/map.php`).
5. **Услуги** — `archive-service.php` (CPT-архив `/services/`) + `single-service.php` (5 детальных).

**Что нужно при старте каждой страницы:** 2 скрина (донор + текущий тест, если что-то есть).

---

## 11. Открытые вопросы

- **AJAX-форма:** тестирование перенесено на боевой хостинг (приём → почта → ответ → состояние кнопки).
- **Контакты:** один офис (Казань) или оба (Казань + Москва)? От этого зависит верстка блока адресов и количество карт.
- **Содержимое CPT `service` / `opinion` / `certificate`** — вручную или через импорт? `opinion` частично наполнен (тестовые посты), остальные — в работе.
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — на тесте загружено? На бою загрузить заново (Customizer хранит ID вложения, при переносе БД подтянется, если переносится медиатека).
- **`archive-service.php`** — лендинг-хаб с карточками услуг (как `/projects/`) или просто список? От этого зависит структура шаблона.
- **Наполнение `certificate` / `opinion`** — сейчас работают файловые фолбэки (`cert-1..10.jpg`, `opinion-1..9.jpg`). Когда заводить CPT-посты? Если планируется больше — пора в медиатеку.

---

## 12. Ключевые URL / команды

| Действие | URL |
|---|---|
| Сброс permalinks | Настройки → Постоянные ссылки → Сохранить |
| Просмотр донора по якорю | https://ingigroup.ru/projects#NN |
| Просмотр проекта | https://ingigroup.xyz/project/<slug>/ |
| Список проектов в админке | https://ingigroup.xyz/wp-admin/edit.php?post_type=project |
| Список сертификатов | https://ingigroup.xyz/wp-admin/edit.php?post_type=certificate |
| Список отзывов | https://ingigroup.xyz/wp-admin/edit.php?post_type=opinion |
| Список услуг | https://ingigroup.xyz/wp-admin/edit.php?post_type=service |
| Список страниц (искать двойники!) | https://ingigroup.xyz/wp-admin/edit.php?post_type=page |
| Настройки «О компании» | Внешний вид → Настроить → Страница «О компании» |
