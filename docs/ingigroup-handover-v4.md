# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v4
**Дата обновления:** 11 октября 2026 г.
**Статус:** главная закрыта (десктоп + мобилка), раздел «Проекты» закрыт (30/30), страница «О компании» закрыта (десктоп + мобилка), страница «Сертификаты» закрыта (десктоп, лайтбокс на GSAP).
**В работе:** остальные внутренние страницы.

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
inc/ajax-form.php      — обработка формы

header.php             — шапка + бургер + мобильное меню
footer.php             — подвал
front-page.php         — главная

page-company.php                    — /company
archive-project.php                 — хаб /projects/
single-project.php                  — детальная /project/<slug>/
taxonomy-project_category.php       — /projects/<term>/
archive-certificate.php             — /certificates/ (сетка + лайтбокс)

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
  ├── main.css         — десктоп + секция «ПРОЕКТЫ» + dropdown-меню + сетка сертификатов + лайтбокс
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, форма, карта, AOS, GSAP, лайтбокс сертификатов
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg
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
- Заголовки внутренних страниц («О компании», «Сертификаты»): 32px, weight 700, uppercase (компактнее, как у донора)
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
- `certs-preview.php` → `/certificates/` ✓ (CPT `certificate`, `has_archive => true`)
- `opinions-preview.php` → `/opinions/` ✓ (CPT `opinion`, `has_archive => true`)

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

**Важно для `page-company.php` и `archive-certificate.php`:** вызов крошек идёт **до** `<div class="container">`, потому что контейнер уже внутри крошек.

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

- `inc/cpt.php` — зарегистрированы 4 CPT: `project`, `service`, `opinion`, `certificate` + таксономия `project_category`. Наполнен `project`; `certificate` использует файловый фолбэк (см. §6.8); `opinion` и `service` пока пустые.
- `inc/meta-boxes.php` — поля проекта (регион, заказчик, работы, дополнительно, галерея).
- `inc/ajax-form.php` — обработчик формы. **End-to-end тест отложен до переноса на боевой хостинг.**
- `inc/customizer.php` — настройки темы + директор.
- `inc/setup.php` — регистрация меню.

### 6.8. Страница «Сертификаты» (`/certificates`) — 100%

**Шаблон:** `archive-certificate.php` (новый файл, залит 11.10.2026).

**Логика данных — гибрид:**
1. Сначала пробуем CPT `certificate` — запрос `posts_per_page => -1`, сортировка `menu_order ASC, date ASC`. Посты **без `thumbnail` пропускаются** (у CPT нет `editor`, единственный полезный контент — миниатюра).
2. Если CPT пуст — **фолбэк на файлы** `assets/images/cert-1.jpg … cert-10.jpg`. Проверка через `file_exists()` в цикле `1..10`.
3. Если ни то, ни другое — выводится `.certificates-empty` «Сертификаты скоро появятся».

Это позволяет сразу видеть рабочий архив на 10 сканов, а при заведении постов в CPT — переключиться без правок шаблона.

**Структура страницы:**

```
1. Хлебные крошки  (template-parts/breadcrumbs.php, до контейнера)
2. H1 «СЕРТИФИКАТЫ»  (32px, uppercase — класс .page-title)
3. Сетка .certificates-grid  (5 колонок, gap 20px)
4. CTA-форма  (template-parts/cta-form.php)
5. Карта  (locate_template guard)
```

**Разметка карточки:** `<a class="certificate-card" href="{full}">` с `<img loading="lazy" decoding="async">` внутри. Клик перехватывается JS, `href` используется как источник для лайтбокса.

**Лайтбокс (GSAP, ванильный JS в `main.js`):**

- Разметка создаётся динамически в JS: `.lightbox` с `.lightbox__backdrop`, `.lightbox__close`, `.lightbox__nav--prev/next`, `.lightbox__stage > .lightbox__img`.
- Открытие: `gsap.fromTo` на opacity бэкдропа + opacity/scale картинки. Закрытие — обратная анимация с `onComplete`, в конце `display: none` и возврат фокуса на исходную карточку (`lastFocus.focus()`).
- Навигация: кнопки ‹ › и **стрелки клавиатуры** `ArrowLeft` / `ArrowRight`, закрытие — `Escape`.
- **Свайпы** на тач: `touchstart` / `touchend`, порог `Math.abs(dx) > 50`.
- `body.lightbox-open { overflow: hidden; }` — блокировка скролла.
- Guard: `if ( !grid || typeof gsap === 'undefined' ) return;` — если сетки на странице нет, лайтбокс не инициализируется (не мешает на других страницах).
- `aria-hidden`, `role="dialog"`, `aria-modal="true"` на `.lightbox`; `aria-label` на кнопках.

**CSS — где что:**
- `main.css`: `.certificates-archive .page-title`, `.certificates-grid`, `.certificate-card` (hover `translateY(-3px)` + box-shadow), `.certificates-empty`, весь блок `.lightbox*`.
- `responsive.css`: `≤991px` — сетка 3 колонки; `≤767px` — 2 колонки, `.page-title` 26px, уменьшенные кнопки лайтбокса, `.lightbox__img` до 94vw / 86vh.

**Открытый вопрос:** когда сканы переедут в медиатеку, стоит переключить `thumb` на размер `large`, `full` — на `full` (сейчас оба ведут на один и тот же файл). Это уберёт загрузку 2–3 МБ оригиналов в лайтбоксе.

---

## 7. Что осталось

1. **Внутренние страницы** (основной трек):
   - ✅ О компании (`/company`) — закрыта
   - ✅ Сертификаты (`/certificates`) — закрыта (сетка + лайтбокс)
   - Отзывы (`/opinions`) — CPT-архив `opinion` уже есть, нужен `archive-opinion.php` (по аналогии с сертификатами)
   - Контакты (`/contacts`) — статическая + карта
   - Подстраницы услуг (`/services/` — CPT-архив + 5 детальных)
2. **Проверка AJAX-формы** end-to-end — **отложена до боевого хостинга** (по решению от 11.10.2026).
3. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
4. **Оптимизация производительности:** preload шрифтов, lazy для карты, `defer` для `main.js`, перевод сертификатов в медиатеку (см. §6.8).
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
- Хендовер-файл присылать одним markdown-блоком **с четырьмя обратными кавычками** для внешней обёртки (```` ```` ``), иначе вложенные блоки ``` ломают разметку.

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
14. **Страница-двойник перебивает архив CPT.** Если в админке есть `page` со слагом, совпадающим с `rewrite.slug` CPT (`certificates`, `opinions`, `services`, `projects`), WP отдаёт страницу, а не архив. Симптом: H1 = заголовок страницы (а не наши `.page-title`), крошек нет, кастомной разметки нет. **Лечение:** удалить страницу-двойник из админки + Сохранить permalinks. Именно это случилось с `/certificates/` 11.10.2026 — была страница «Сертификаты ИНЖИГРУПП».
15. **Rewrite-приоритет покрывает все 4 архива.** После расширения фильтра (§5) `/certificates/`, `/opinions/`, `/services/`, `/projects/` защищены от перехвата страницами и терминами. При добавлении нового CPT — **дописать пару правил** в `$prefix` в `inc/cpt.php`, иначе новый архив может не открыться.

---

## 10. Что дальше

Продолжаем внутренние страницы в порядке:

1. ✅ **О компании** (`/company`) — закрыта.
2. ✅ **Сертификаты** (`/certificates`) — закрыта: `archive-certificate.php` + сетка 5×2 + лайтбокс на GSAP.
3. **Отзывы** (`/opinions`) — CPT-архив `opinion` уже есть, нужен `archive-opinion.php`. Паттерн может отличаться от сертификатов (отзывы — это текст + подпись, а не сканы), **нужен скрин донора** для определения структуры карточки.
4. **Контакты** (`/contacts`) — статическая + карта (переиспользовать `template-parts/map.php`).
5. **Услуги** — `archive-service.php` (CPT-архив `/services/`) + `single-service.php` (5 детальных).

**Что нужно при старте каждой страницы:** 2 скрина (донор + текущий тест, если что-то есть).

---

## 11. Открытые вопросы

- **AJAX-форма:** тестирование перенесено на боевой хостинг (проверить: приём → почта → ответ → состояние кнопки).
- **Содержимое CPT `service` / `opinion` / `certificate`** — будет наполняться вручную или через импорт?
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — уже загружено через Customizer на тесте? На бою нужно загрузить заново (Customizer хранит ID вложения, при переносе БД подтянется, если переносится медиатека).
- **`archive-service.php`** — будет ли это лендинг-хаб с карточками услуг (как `/projects/`), или просто список? От этого зависит структура шаблона.
- **Наполнение `certificate`** — сейчас работает файловый фолбэк `cert-1..10.jpg`. Когда заводить CPT-посты? Если планируется больше 10 — точно пора в медиатеку. Пока не трогаем: работает.
- **Структура `archive-opinion.php`** — отзывы выводятся карточками с текстом или сканами (как сертификаты)? Зависит от скрина донора.

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
