# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v12
**Дата обновления:** 12 октября 2026 г.
**Статус:** главная закрыта, «Проекты» закрыты (30/30), «О компании» закрыта, «Сертификаты» закрыта, «Отзывы» закрыта, «Контакты» закрыта, модалка «Оставить заявку» закрыта, **все 6 услуг закрыты** (`/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`).
**В работе:** нет активных треков — этап разработки закрыт, дальше — SEO/боевой хостинг/оптимизация.

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
- Меню (шапка/подвал/услуги): https://ingigroup.xyz/wp-admin/nav-menus.php

---

## 3. Стек

- WordPress, кастомная тема `ingigroup`
- Шрифт: Inter (Google Fonts), 100–900
- Анимации: AOS + GSAP + ScrollTrigger
- Карта: Яндекс.Карты API (главная, «О компании») + iframe map-widget (`/contacts`)
- Форма: AJAX через `admin-ajax.php` — action `ingi_send`
- Модалка «Оставить заявку» — глобальный компонент

---

## 4. Структура темы

```
functions.php          — загрузчик, подключает inc/*
inc/enqueue.php        — стили/скрипты, версии через filemtime
inc/setup.php          — регистрация меню
inc/customizer.php     — настройки Customizer
inc/cpt.php            — CPT (project, service, opinion, certificate) + таксономия + rewrite-приоритет архивов
inc/meta-boxes.php     — поля проекта
inc/meta-boxes-opinion.php           — поля отзыва (автор, должность)
inc/meta-boxes-production-gallery.php — метабокс «Галерея изображений» для страниц услуг
inc/ajax-form.php      — обработка формы

header.php             — шапка + бургер + мобильное меню
footer.php             — подвал + подключение модалки (template-parts/modal-callback.php)
front-page.php         — главная

page-company.php                    — /company
page-contacts.php                   — /contacts
page-service.php                    — /service («Установка РСП») — ЗАКРЫТА
page-production.php                 — /production («Изготовление РСП») — ЗАКРЫТА
page-rent.php                       — /rent («Аренда РСП») — ЗАКРЫТА
page-installation.php               — /installation («Монтаж инженерных сетей») — ЗАКРЫТА
page-development.php                — /development («Разработка проектов ППР») — ЗАКРЫТА
page-felling.php                    — /felling («Вырубка растительности») — ЗАКРЫТА
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
  ├── cta-form.php     — общий CTA-парт (главная, /service, /production, /rent, /installation, /development, /felling, /contacts)
  ├── map.php
  ├── breadcrumbs.php
  ├── project-card.php
  ├── modal-callback.php   — глобальная модалка «Оставить заявку»
  └── company/         — парты страницы «О компании» (см. §6.3)
      ├── director.php
      ├── stats.php
      ├── projects-preview.php
      ├── certs-preview.php
      └── opinions-preview.php

assets/css/
  ├── main.css         — всё (главная + проекты + услуги + контакты + отзывы + сертификаты + модалка + production + rent + installation + development + felling)
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, AJAX-форма, карта, AOS, GSAP, лайтбокс, спойлеры, модалка
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg + opinion-1..opinion-9.jpg
                       + service-rsr-hero.jpg + production-hero.jpg + production-1.jpg + production-2.jpg
                       + production-spec-*.jpg + rent-hero.jpg
                       + snimok_ekrana_2025_03_05_142107.png + snimok_ekrana_2025_03_05_142426.png + snimok_ekrana_2025_03_05_142632.png
                       + development-intro.jpg
                       + felling-hero.jpg + felling-intro.jpg + felling-services.jpg + felling-gallery-1..8.jpg
assets/images/production/   — gallery-N.jpg (файловый фолбэк для галереи /production; в проде — через метабокс)
```

**Удалены:**
- Все `inc/import-projects*.php` (batch1–batch7) — после закрытия «Проектов».
- `single-service-ustanovka-rsr.php` — отказались от CPT-подхода для 6 основных услуг.

---

## 5. Ключевые параметры

### Цвета (CSS-переменные)

```
--orange:        rgb(239, 126, 25)
--orange-hover:  rgb(242, 152, 71)
--orange-active: rgb(222, 113, 15)
--accent-soft:   rgb(251, 175, 90)
--dark:          rgb(18, 18, 18)
--dark-2:        rgb(30, 30, 30)
--grey-333:      #333
--container:     1140px
```

Иконки / SVG-акценты: `rgb(242, 151, 71)` (близко к `--orange-hover`).

### Шрифты

- Inter (100–900)
- Заголовки секций: 51px, weight 700, uppercase
- Заголовки внутренних страниц («О компании», «Сертификаты», «Отзывы», «Контакты»): 32px, weight 700, uppercase
- H2 на страницах услуг (`/production`, `/rent`, `/installation`, `/development`, `/felling`): 32px, weight 700, **не uppercase** (у `/felling` H2 первого блока — 32px weight 600)
- Hero `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling` (десктоп): заголовок 56px, подзаголовок 20–29px, кнопка 19px + border 5px
- Основной текст: 16px, line-height 1.43
- Телефон: 26px, weight 700

### CPT и таксономии (из `inc/cpt.php`)

| CPT | rewrite.slug | has_archive | Архив URL | supports |
|-----|--------------|-------------|-----------|----------|
| `service` | `services` | `true` | `/services/` (не используем) | title, editor, thumbnail, excerpt, page-attributes |
| `project` | `project` | `projects` | `/projects/` | title, editor, thumbnail, excerpt, page-attributes |
| `opinion` | `opinions` | `true` | `/opinions/` | title, editor, thumbnail |
| `certificate` | `certificates` | `true` | `/certificates/` | title, thumbnail, page-attributes |

Таксономия `project_category` (только для `project`):
- `rewrite.slug => 'projects'` → `/projects/<term>/`
- `hierarchical => true`
- `show_admin_column => true`

**Важно:** CPT `service` не используется для 6 основных услуг сайта. Он оставлен как задел на будущее (для «второстепенных» услуг с общим шаблоном). 6 основных услуг — это обычные `page` с шаблонами `page-{slug}.php` и **`Template Name`** в шапке.

**Важно про `certificate`:** поддерживает только `title`, `thumbnail`, `page-attributes` — без `editor`. В админке нет основного редактора, только заголовок и миниатюра.

### Приоритет rewrite для архивов CPT

Фильтр `rewrite_rules_array` в `inc/cpt.php`:

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

**Не трогать.**

---

## 6. Что сделано

### 6.1. Главная страница — 100%
Десктоп и мобилка — как в v7. Без изменений.

### 6.2. Раздел «Проекты» — 100%
Без изменений (см. v7 §6.2). Все 30 проектов импортированы, счётчики 11/8/11, импортёры удалены.

### 6.3. Страница «О компании» (`/company`) — 100%
Без изменений (см. v7 §6.3).

### 6.4. Хлебные крошки (`template-parts/breadcrumbs.php`) — универсальные
Без изменений (см. v7 §6.4). Первая метка — «Главная» (короткая, не «Главная страница»).

**Уточнение v10:** на страницах услуг (`/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`) хлебные крошки стоят **НИЖЕ hero**. При создании новых страниц услуг — следовать этому же паттерну.

**Уточнение v11:** вторая метка крошек = `get_the_title()` страницы. Чтобы метка совпадала с донором — переименовать страницу в админке.

### 6.5. Customizer — настройки
Без изменений (см. v7 §6.5). Секция `ingi_contacts`, ~20 полей.

### 6.6. Фикс мобильной панели адреса на карте
Без изменений (см. v7 §6.6). Фикс в `hotfix.css`.

### 6.7. Инфраструктура
Без изменений (см. v7 §6.7).

### 6.8. Страница «Сертификаты» (`/certificates`) — 100%
Без изменений (см. v7 §6.8).

### 6.9. Страница «Отзывы» (`/opinions`) — 100%
Без изменений (см. v7 §6.9).

### 6.10. Лайтбокс (`main.js`) — универсальный
Без изменений (см. v7 §6.10). Дополнено в v9: `.production-gallery__grid`. **Дополнено в v12:** `.felling-gallery__grid`.

### 6.11. Страница «Контакты» (`/contacts`) — 100%
Без изменений (см. v7 §6.11).

### 6.12. Главное меню в шапке
Без изменений (см. v7 §6.12).

### 6.13. Модалка «Оставить заявку» — 100%
Без изменений (см. v7 §6.13).

### 6.14. Страница «Установка РСП» (`/service`) — 100%
Без изменений (см. v8 §6.14).

### 6.15. Адаптив страницы «Услуги» (`/service`)
Без изменений (см. v8 §6.15).

### 6.16. Страница «Изготовление РСП» (`/production`) — 100%
Без изменений (см. v9 §6.16).

### 6.17. Метабокс «Галерея изображений» (`inc/meta-boxes-production-gallery.php`) — 100%
Без изменений (см. v9 §6.17). **Уточнение v12:** слаги страниц с галереей задаются в `ingi_gallery_enabled_slugs()` (или аналогичной функции в этом файле). Сейчас там: `production`, `felling`. Чтобы добавить новую страницу с галереей — дописать слаг в этот массив, переиспользовать рендер галереи из `page-production.php`/`page-felling.php`.

### 6.18. Адаптив страницы «Изготовление РСП»
Без изменений (см. v9 §6.18).

### 6.19. Скрипт выгрузки изображений с донора
Без изменений (см. v9 §6.19).

### 6.20. Страница «Аренда РСП» (`/rent`) — 100%
Без изменений (см. v10 §6.20).

### 6.21. Страница «Монтаж инженерных сетей» (`/installation`) — 100%
Без изменений (см. v11 §6.21).

### 6.22. Синтаксис вызова карты (актуальный паттерн в проекте)

Во всех шаблонах страниц, где нужна секция «НАШ АДРЕС» с Яндекс-картой:

```php
<?php
if ( locate_template( 'template-parts/map.php' ) ) {
    get_template_part( 'template-parts/map' );
}
?>
```

Многострочно, `get_template_part('template-parts/map')` — **без `.php`**.

Используется на `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`, `/contacts`.

**Профилактика:** в `template-parts/map.php` есть page-check. Если карта не выводится на новой странице — либо добавить слаг в whitelist, либо убрать проверку.

### 6.23. Страница «Разработка проектов ППР» (`/development`) — 100%

**Архитектура:** обычная страница с `page-development.php` на корневом уровне, `Template Name: Услуга — Разработка проектов производства работ (ППР)`. Не CPT.

**Структура:**
```
1. Hero — .service-hero + scoped .development-hero
   ├── фон: rent-hero.jpg (общий с /rent, по решению пользователя)
   ├── заголовок: «Разработка проектов<br>производства работ (ППР)» (2 строки)
   ├── подзаголовка нет
   └── кнопка «Оставить заявку» (.js-open-callback)
2. Хлебные крошки (template-parts/breadcrumbs.php) — НИЖЕ hero
3. H2 32px uppercase + intro:
   ├── .development-intro__grid — 2 колонки 50/50
   ├── фон: development-intro.jpg (жёлтая каска LVI)
   └── в правой колонке 2 карточки (белые с тенью, padding 22×24)
4. Текстовый блок (1 абзац, full width)
5. Секция 65/35: текст слева + 3 спойлера справа
   ├── .development-details__grid — grid 1fr 420px
   ├── спойлеры: <details open> — «Проект производства работ (ППР)», «Акт-допуск», «Акт инструментальной проверки»
   └── фон спойлера: rgba(252, 229, 209, 0.57), padding 10×14
6. Текстовый блок
7. Большой спойлер «Перечень мероприятий, выполняемых при заключении договорных обязательств с ООО «ИНЖИГРУПП»» — <details open>
   ├── нумерованный список 1–10 (.development-list)
   ├── каждый <li>: title 16px/700 + body 16px/400
   └── пункты 5, 7, 8, 9, 10 — без body
8. Текстовый блок (2 абзаца)
9. Большой спойлер «Подробнее здесь» — <details open>
   └── нумерованный список 1–8, тот же паттерн
10. Кнопка «Заказать ППР» — .development-order__btn, справа, orange outline 35px, padding 25px 60px
11. CTA-форма — template-parts/cta-form.php
12. Карта — §6.22
```

**Ключевые CSS-классы:** `.development-hero`, `.development-page`, `__h2`, `.development-intro__grid`, `__card`, `.development-text`, `.development-details`, `__grid`, `__spoilers`, `.development-spoiler`, `__summary`, `__title`, `__body`, `.development-spoiler--large`, `.development-list`, `__title`, `__body`, `.development-order__btn`.

**Спойлеры:** на `<details>/<summary>`, изначально все `open` — как на доноре. Маркер убран, иконка «+/-» через `::after` + rotate(45deg / -135deg).

**Картинка:**
| Файл | Где | Как наполняется |
|---|---|---|
| `rent-hero.jpg` | Hero, фон | Файлом (общий с `/rent`) |
| `development-intro.jpg` | Intro, фон | Файлом |

### 6.24. Страница «Вырубка растительности» (`/felling`) — 100%

**Архитектура:** обычная страница с `page-felling.php`, `Template Name: Услуга — Вырубка древесно-кустарниковой растительности`.

**Структура:**
```
1. Hero — .service-hero + scoped .felling-hero
   ├── фон: felling-hero.jpg
   ├── заголовок: «Вырубка древесно-кустарниковой растительности» (1 строка)
   ├── подзаголовок: «на объектах инфраструктуры ОАО «РЖД»» (29px, weight 700)
   └── кнопка «Оставить заявку» (.js-open-callback)
2. Хлебные крошки (template-parts/breadcrumbs.php) — НИЖЕ hero
3. H2 (32px weight 600) + intro 34%/66%:
   ├── слева фото felling-intro.jpg
   └── справа 2 абзаца
4. Спойлер «Список нормативных документов ОАО «РЖД»» — <details open>
   ├── 16 пунктов, обычные <p>
   └── фон: linear-gradient(to right, rgba(239,126,25,0.08), rgba(254,247,245,0.2))
5. Текстовые абзацы + объёмы работ:
   ├── .felling-volumes__grid — 1fr | 1fr
   ├── слева: 3 объёма (валка 10 774 шт / сплошная 315,94 га / уборка 257,45 га)
   └── справа: кнопка «Реализованные проекты» (orange outline 35px) → /projects#13
6. Секция «ПРЕИМУЩЕСТВА» — .felling-advantages
   ├── H2 56px weight 500
   ├── сетка 6 колонок (repeat(6, 1fr))
   ├── каждый item — span 2 колонки (3 в первом ряду)
   ├── 4-й item: grid-column: 2/4 (2-я колонка, 2-й ряд)
   ├── 5-й item: grid-column: 4/6 (3-я колонка, 2-й ряд)
   └── фон item: linear-gradient(to right, rgba(254,247,245,0.43), rgba(239,126,25,0.2)), padding 15×20×22
       иконка 50×50, stroke: #000 (line-art, БЕЗ круга)
7. Секция «ВИДЫ УСЛУГ» — .felling-services
   ├── H2 56px weight 500
   ├── сетка 24%/76%: слева felling-services.jpg, справа список 8 пунктов (оранжевые точки)
   ├── CTA-пара: текст слева + кнопка «Заказать услуги по вырубке» справа (.js-open-callback)
   └── галерея 4×2 (.felling-gallery__grid)
8. CTA-форма — template-parts/cta-form.php
9. Карта — §6.22
```

**Галерея — гибридный паттерн (важно, v12):**
Сначала пробуем метабокс, если пусто — файловый фолбэк:
```php
$gallery_meta = get_post_meta( $post_id, '_ingi_gallery', true );
if ( ! empty( $gallery_meta ) && is_array( $gallery_meta ) ) {
    // читаем ID (или URL) из метабокса
}
if ( empty( $gallery_urls ) ) {
    // читаем felling-gallery-1..8.jpg через file_exists()
}
```
Ключ `_ingi_gallery` — **проверить в `inc/meta-boxes-production-gallery.php`**, если там другое имя, заменить в шаблоне. Слаг `felling` добавлен в `ingi_gallery_enabled_slugs()`.

**Иконки преимуществ:** в шаблоне сейчас стоят SVG-заглушки со `stroke="currentColor"`, цвет задаётся в CSS через `.felling-advantages__icon svg { stroke: #000; }`. Если захочешь заменить на донорские через Copy element (§9.4, §9.37) — просто чистим классы/стили и оставляем `stroke="currentColor"`.

**Картинки:**
| Файл | Где | Как наполняется |
|---|---|---|
| `felling-hero.jpg` | Hero, фон | Файлом |
| `felling-intro.jpg` | Intro, слева | Файлом |
| `felling-services.jpg` | Виды услуг, слева | Файлом |
| `felling-gallery-1..8.jpg` | Галерея | Файловый фолбэк, если метабокс пуст |

**Особенности:**
- Заголовок hero — 1 строка, на мобилке переносится сам.
- Подзаголовок hero — отдельный `<p class="service-hero__sub">`, стилизован 29px/700.
- Спойлер — большой, с фоном-градиентом и 16 пунктами.
- Плитки преимуществ: 6-колоночная сетка со сдвигом 4-й и 5-й (3+2 layout).
- Галерея — 8 картинок в сетке 4×2, лайтбокс подключён через `GRID_SELECTORS`.

### 6.25. Мобильный hero: переносы (v12)

**Проблема:** на мобилке длинный заголовок в hero переносился **по буквам** вместо переноса по словам.

**Причина:** в мобильных правилах были `word-break: break-word` и `overflow-wrap: anywhere` — они разрешают рвать внутри слова.

**Фикс (общий паттерн для всех услуг с длинными hero):**
1. Убрать `word-break` / `overflow-wrap` из мобильных правил.
2. Скрыть `<br>` на мобилке: `.xxx-hero .service-hero__title br { display: none; }`.
3. **Пробел поставить ПЕРЕД `<br>` в HTML**, а не после: `Разработка проектов <br>производства работ (ППР)`. При скрытии `<br>` пробел остаётся и слова не склеиваются.
4. Ступенчатое уменьшение размера: 56 → 40 (≤991) → 30 (≤767) → 24 (≤480).

**Пример — `/development`:**
```css
@media (max-width: 767px) {
    .development-hero .service-hero__title {
        font-size: 30px;
        line-height: 1.2;
    }
    .development-hero .service-hero__title br { display: none; }
}
```

**HTML:**
```html
<h1 class="service-hero__title">Разработка проектов <br>производства работ (ППР)</h1>
```

**Не использовать** `content: ' '` на `<br>` — менее надёжно, чем правка в HTML.

### 6.26. Модификатор hero для конкретной услуги (паттерн)

Когда заголовок hero на новой странице длиннее/короче, чем на `/service` — **не трогаем базовый `.service-hero`**, добавляем scoped-модификатор:

```php
<section class="service-hero development-hero">
```

```css
.development-hero .service-hero__content,
.development-hero .service-hero__title {
    max-width: 1000px;
}
.development-hero .service-hero__title {
    font-size: 56px;
    line-height: 1.1;
}
```

Применено на `/development`, `/felling` (и ранее на `/installation` как `.installation-hero`). Базовые стили `.service-hero` не трогаются — иначе сломаются остальные услуги (§9.42).

**Также в scoped-модификатор добавлять фикс фона hero**, если он тайлится (§9.45):
```css
.felling-hero .service-hero__bg {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}
```

### 6.27. Секция «Преимущества» — паттерн 6-колоночной сетки (v12)

Для секции «Преимущества» на `/felling` использован паттерн **3 + 2 со сдвигом**:

```css
.felling-advantages__grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 30px;
}
.felling-advantages__item {
    grid-column: span 2;
    /* ... */
}
/* сдвиг 4-й и 5-й плиток во 2-м ряду */
.felling-advantages__item:nth-child(4) { grid-column: 2 / 4; }
.felling-advantages__item:nth-child(5) { grid-column: 4 / 6; }
```

**Плитка преимущества:** фон — `linear-gradient(to right, rgba(254,247,245,0.43), rgba(239,126,25,0.2))`, padding 15×20×22.
**Иконка:** 50×50, **без круга**, `stroke: #000`, line-art. В SVG использовать `stroke="currentColor"`, чтобы цвет рулился из CSS.
**Адаптив:** на ≤991px — 2 колонки + сброс сдвига (`grid-column: auto` для 4 и 5), на ≤767px — 1 колонка с иконкой слева.

Использовать этот паттерн при создании аналогичных секций на других страницах.

---

## 7. Что осталось

Все 6 услуг закрыты. Дальнейшие шаги (перенесены из v11):

1. **Проверка AJAX-формы** end-to-end — отложена до боевого хостинга.
2. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
3. **Оптимизация:** preload шрифтов, lazy для карты, `defer` для `main.js`, перевод сертификатов/отзывов в медиатеку.
4. **Кросс-браузерное тестирование.**
5. **Перенос на боевой хостинг.**
6. **Чистка рудимента:** удалить из `main.css` и `responsive.css` неиспользуемые `.production-cta*`.
7. **Иконки преимуществ на `/felling`** — сейчас SVG-заглушки. Заменить на донорские через Copy element (§9.4, §9.37), при желании.

---

## 8. Как мы работаем

### Процесс
1. Пользователь присылает 2 скрина: оригинал (донор) + тест секции.
2. Ассистент даёт правки — код целиком или конкретные правила.
3. Пользователь применяет, Ctrl+Shift+R, проверяет.
4. Точные размеры — через DevTools (F12 → Computed) на оригинале.
5. При конфликтах — скриншот из DevTools + код элемента.

### Правила
- Давать полный код файла, если правок много. При правках `main.css`/`responsive.css`/`hotfix.css` — присылать весь файл целиком, потому что легко наплодить дублей.
- Проверять `hotfix.css` при конфликтах — подключается последним.
- Точные пиксели подбирает пользователь.
- SVG забирать с донора через Copy element, не рисовать.
- Всё через `get_theme_mod()` с дефолтом во втором аргументе.
- При старте нового трека — начать с одной страницы, задать паттерн, потом переиспользовать.
- Не копировать донора буквально, если структура нашего сайта отличается — оценивать по цели страницы.
- Хендовер-файл присылать одним markdown-блоком с четырьмя обратными кавычками для внешней обёртки, иначе вложенные блоки ``` ломают разметку.

---

## 9. Известные грабли

1. **Кэш:** Ctrl+Shift+R + `filemtime` в `enqueue.php`.
2. **`hotfix.css` перебивает `main.css`** — проверять первым при конфликтах.
3. **Версии в `inc/enqueue.php`** через `filemtime` — если правки не видны, проверь первым.
4. **SVG Creatium подгружаются JS**, в исходнике их нет — брать через Copy element в DevTools.
5. **Мобильный бургер** — правки в `header.php` + `main.css` + `main.js` (три места).
6. **`data-aos` на мобилке отключать** — `[data-aos] { opacity: 1 !important; }`.
7. **Отрицательные margin** для растягивания блоков на мобилке.
8. **`get_theme_mod` всегда со вторым аргументом-дефолтом.**
9. **Permalinks:** после любых изменений в CPT/таксономии/rewrite — Сохранить permalinks, иначе 404.
10. **Слаги CPT vs taxonomy должны различаться** (`project` vs `projects`), иначе rewrite-конфликт.
11. **`var(--grey-333)`** использовать с фолбэком: `var(--grey-333, #333)`.
12. **`locate_template('template-parts/map.php')`** — если файла нет, секция молча пропускается. **Актуальный синтаксис вызова — см. §6.22**.
13. **`certificate` CPT — без `editor`.** Если понадобится описание — расширить `supports`.
14. **Страница-двойник перебивает архив CPT / обычную страницу.** Лечение: удалить страницу-двойник + Сохранить permalinks.
15. **Rewrite-приоритет покрывает все 4 архива CPT.** При добавлении нового CPT — дописать правила в `$prefix` в `inc/cpt.php`.
16. **Лайтбокс ищет сетки по `GRID_SELECTORS` в `main.js`.** Сейчас: `.certificates-grid`, `.opinions-scans-grid`, `.production-gallery__grid`, `.felling-gallery__grid`.
17. **`archive-opinion.php` использует флаги `$has_posts` / `$has_scans`.**
18. **Файловые фолбэки регистрозависимы.** `opinion-1.jpg` подхватится, `Opinion-1.JPG` — нет.
19. **Яндекс-виджет (iframe) на `/contacts`:** координаты в URL — `lon,lat`.
20. **`.cta-form` — общий парт.** Не удалять у него `padding-bottom` глобально.
21. **Customizer `inc/customizer.php` — одна плоская секция `ingi_contacts`.**
22. **Удалил страницу-двойник → пункт меню стал «Некорректным» → пропал с фронта.**
23. **НЕ вкладывать CSS-правила друг в друга.**
24. **Не плодить дубли блоков в `main.css`.**
25. **При правках `main.css`/`responsive.css`/`hotfix.css` — присылать файл целиком.**
26. **Модалка использует те же классы, что CTA-форма.**
27. **В модалке должен быть `<input type="hidden" name="inn" value="">`.**
28. **`page-{slug}.php` у страниц услуг — с `Template Name`.**
29. **Услуги на корневом уровне** (`/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`), НЕ `/services/…`.
30. **Файловый фолбэк галереи — только через `file_exists()`.**
31. **CTA на страницах услуг — только `template-parts/cta-form.php`.**
32. **Flexbox и две картинки в ряд:** `img { min-width: 0 }` + `img:not(:only-child) { flex: 1 1 0 }`.
33. **`navigator.clipboard.writeText` в консоли не всегда срабатывает.**
34. **`url.match(/\.(jpe?g|png|webp)/i)[1]` падает на URL без расширения.**
35. **Скачивание с донора без Referer даёт 403.**
36. **Хлебные крошки на страницах услуг — НИЖЕ hero.**
37. **SVG-иконки с донора чистятся перед вставкой в шаблон** (убрать `class`, `style`, `transform-origin`, скрытую `<rect>`-подложку).
38. **Аккордеон на `<details>/<summary>`:** убрать стандартный маркер, иконку «+/−» рисовать через CSS `::before`/`::after`.
39. **При создании страницы-услуги — слаг строго латиницей, нижний регистр, без пробелов.**
40. **Если «задваивается» контент — сначала проверить `page-{slug}.php` на дублирование секций.**
41. **Не доверять первому впечатлению от верхнего края скрина донора.** Запрашивать кроп секции.
42. **Hero-заголовок разной длины ломает общий `.service-hero`.** Лечение: scoped-модификатор.
43. **Имена файлов-транслитом от пользователя** — рабочие, но лучше договариваться о читаемых именах.
44. **Вторая метка хлебных крошек = заголовок страницы в админке (`get_the_title()`).**
45. **Паттерн вызова карты — многострочный** (§6.22).
46. **`template-parts/map.php` содержит page-check** (whitelist страниц).
47. **Длинные транслитерированные имена файлов** — рабочие, но неудобны.
48. **На мобилке `word-break: break-word` и `overflow-wrap: anywhere` рвут слова по буквам.** Убирать их, скрывать `<br>`, пробел ставить ПЕРЕД `<br>` в HTML. См. §6.25.
49. **Фон hero может тайлиться, если у `.service-hero__bg` нет `background-size: cover` / `background-repeat: no-repeat`.** Проверять первым делом на новой странице услуги, фикс — scoped-модификатор (§6.26).
50. **Иконки в SVG-заглушках использовать со `stroke="currentColor"`.** Цвет задавать в CSS через `.xxx__icon svg { stroke: #000; }`. Иначе при замене донорских иконок придётся править каждую в PHP.
51. **Секция «Преимущества» с раскладкой 3+2** — использовать 6-колоночную сетку + `nth-child(4) { grid-column: 2/4 }` + `nth-child(5) { grid-column: 4/6 }` (§6.27). На адаптиве сбрасывать сдвиг `grid-column: auto`.

---

## 10. Что дальше

Разработка всех 6 услуг завершена. Осталось:

**Ближайшее:**
1. **Чистка рудимента:** удалить `.production-cta*` и `.rent-faq__badge` из `main.css`/`responsive.css`.
2. **Замена SVG-заглушек** в секции «Преимущества» `/felling` на донорские (Copy element, §9.4, §9.37). Опционально.
3. **Проверка карты** на всех 6 страницах услуг — в whitelist или без page-check.
4. **Прогон по всем 6 услугам** в мобильном DevTools — проверить hero, переносы, отступы, галереи.

**Перед боевым:**
5. **AJAX-форма** end-to-end на боевом.
6. **SEO:** title, description, OG.
7. **Оптимизация:** preload шрифтов, lazy для карты, `defer` для `main.js`.
8. **Перевод сертификатов/отзывов/галерей в медиатеку** (расширить метабокс).
9. **Кросс-браузерное тестирование.**
10. **Перенос на боевой хостинг.**

---

## 11. Открытые вопросы

- **AJAX-форма:** end-to-end тест перенесён на боевой хостинг.
- **Содержимое CPT `service`** — пока пуст, оставлен на будущее.
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — на тесте загружено; на бою загрузить заново.
- **Наполнение `certificate` / `opinion`** — работают файловые фолбэки.
- **Маркер Москвы на `/contacts`:** оставить синюю точку или переключить виджет на `?text={address}`.
- **Медиатека vs файлы:** галерея `/production` и `/felling` — через метабокс; вводные фото — пока файлами. Решить: переводить ли вводные фото в медиатеку.
- **Чистка рудимента:** удалить неиспользуемые `.production-cta*` и `.rent-faq__badge` правила.
- **Иконки преимуществ на `/felling`:** заменить SVG-заглушки на донорские?
- **Метабокс галереи:** ключ `_ingi_gallery` — проверить в `inc/meta-boxes-production-gallery.php`, имя совпадает?
- **Унификация каркаса страниц услуг:** после 6 услуг стало ясно — у каждой страницы своя «специя». Общий каркас не окупается, оставляем как есть.

---

## 12. Ключевые URL / команды

| Действие | URL |
|---|---|
| Сброс permalinks | Настройки → Постоянные ссылки → Сохранить |
| Просмотр донора по якорю | https://ingigroup.ru/projects#NN |
| Просмотр проекта | https://ingigroup.xyz/project/<slug>/ |
| Список проектов | https://ingigroup.xyz/wp-admin/edit.php?post_type=project |
| Список сертификатов | https://ingigroup.xyz/wp-admin/edit.php?post_type=certificate |
| Список отзывов | https://ingigroup.xyz/wp-admin/edit.php?post_type=opinion |
| Список услуг | https://ingigroup.xyz/wp-admin/edit.php?post_type=service |
| Список страниц (искать двойники!) | https://ingigroup.xyz/wp-admin/edit.php?post_type=page |
| Меню | https://ingigroup.xyz/wp-admin/nav-menus.php |
| Настройки «Контакты» | Внешний вид → Настроить → ИНЖИГРУПП — Контакты |
| Страница «Контакты» | https://ingigroup.xyz/contacts/ |
| Страница «Установка РСП» | https://ingigroup.xyz/service/ |
| Страница «Изготовление РСП» | https://ingigroup.xyz/production/ |
| Страница «Аренда РСП» | https://ingigroup.xyz/rent/ |
| Страница «Монтаж инженерных сетей» | https://ingigroup.xyz/installation/ |
| Страница «Разработка ППР» | https://ingigroup.xyz/development/ |
| Страница «Вырубка растительности» | https://ingigroup.xyz/felling/ |
| Открыть модалку (консоль) | `window.ingiOpenCallback()` |
| Inspect сетки лайтбокса | `.certificates-grid`, `.opinions-scans-grid`, `.production-gallery__grid`, `.felling-gallery__grid` |

**Скрипты наполнения (на Kubuntu):**

```bash
# 1) на доноре в консоли: прогнать скрипт (§6.19), PAGE_PREFIX = 'development' / 'felling' / ...
# 2) забрать JSON
mkdir -p ~/ingigroup-download && cd ~/ingigroup-download
wl-paste > images.json        # Wayland
# xclip -selection clipboard -o > images.json   # X11
jq 'length' images.json       # проверить число картинок
# 3) скачать
./download.sh
# 4) разложить по assets/images/ темы
```
