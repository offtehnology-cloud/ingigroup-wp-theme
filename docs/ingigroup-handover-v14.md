# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v14
**Дата обновления:** 12 октября 2026 г.
**Статус:** главная закрыта, «Проекты» закрыты (30/30), «О компании» закрыта, «Сертификаты» закрыта, «Отзывы» закрыта, «Контакты» закрыта, модалка «Оставить заявку» закрыта, «Политика конфиденциальности» (`/privacy`) закрыта, **все 6 услуг закрыты** (`/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`).
**В работе:** нет активных треков — этап разработки закрыт. Дальше — SEO/оптимизация/боевой хостинг.

Этот файл — единственный источник контекста. Присылать только его, все старые версии не нужны.

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
page-privacy.php                    — /privacy («Политика конфиденциальности») — ЗАКРЫТА
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
  ├── main.css         — всё (главная + проекты + услуги + контакты + отзывы + сертификаты + модалка + production + rent + installation + development + felling + privacy)
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
- H2 на страницах услуг (`/production`, `/rent`, `/installation`, `/development`): 32px, weight 700, **не uppercase**; на `/felling` H2 первого блока — 32px weight 600
- Hero `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling` (десктоп): заголовок 56px, подзаголовок 20–29px, кнопка 19px + border 5px
- Основной текст: 16px, line-height 1.43
- Телефон: 26px, weight 700
- «Политика конфиденциальности»: H1 46px/600, H2 16px/700, параграфы 16px/1.6

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

**Уточнение v10:** на страницах услуг (`/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`) хлебные крошки стоят **НИЖЕ hero**.

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
Без изменений (см. v7 §6.10). `GRID_SELECTORS` сейчас:
```
.certificates-grid
.opinions-scans-grid
.production-gallery__grid
.felling-gallery__grid   ← добавлено в v12
```
Класс карточек — `.certificate-card`.

### 6.11. Страница «Контакты» (`/contacts`) — 100%
Без изменений (см. v7 §6.11).

### 6.12. Главное меню в шапке
Без изменений (см. v7 §6.12).

### 6.13. Модалка «Оставить заявку» — 100%
**Переработана в v13 (см. §6.29).** Старое описание (v7) — неактуально.

### 6.14. Страница «Установка РСП» (`/service`) — 100%
Без изменений (см. v8 §6.14).

### 6.15. Адаптив страницы «Услуги» (`/service`)
Без изменений (см. v8 §6.15).

### 6.16. Страница «Изготовление РСП» (`/production`) — 100%
Без изменений (см. v9 §6.16).

### 6.17. Метабокс «Галерея изображений» (`inc/meta-boxes-production-gallery.php`) — 100%
Без изменений (см. v9 §6.17). **Уточнение v12:** слаги страниц с галереей задаются в `ingi_gallery_enabled_slugs()` (или аналогичной функции в этом файле). Сейчас там: `production`, `felling`. Чтобы добавить новую страницу с галереей — дописать слаг в массив, переиспользовать рендер галереи из `page-production.php`/`page-felling.php`.

**Ключ мета-поля** — `_ingi_gallery`. Если в твоей реализации другое — синхронно поправить в `page-felling.php` (там `get_post_meta( $post_id, '_ingi_gallery', true )`).

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

**Архитектура:** обычная страница с `page-development.php`, `Template Name: Услуга — Разработка проектов производства работ (ППР)`.

**Структура:**
```
1. Hero — .service-hero + scoped .development-hero
   ├── фон: rent-hero.jpg (общий с /rent)
   ├── заголовок: «Разработка проектов <br>производства работ (ППР)»
   └── кнопка «Оставить заявку» (.js-open-callback)
2. Хлебные крошки (template-parts/breadcrumbs.php) — НИЖЕ hero
3. H2 32px uppercase + intro:
   ├── .development-intro__grid — 2 колонки 50/50
   ├── фон: development-intro.jpg (жёлтая каска LVI)
   └── 2 карточки в правой колонке
4. Текстовый блок
5. 65/35: текст + 3 спойлера (<details open>)
6. Текстовый блок
7. Большой спойлер «Перечень мероприятий…» — 10 пунктов
8. Текстовый блок (2 абзаца)
9. Большой спойлер «Подробнее здесь» — 8 пунктов
10. Кнопка «Заказать ППР» (.development-order__btn, справа, orange outline 35px)
11. CTA-форма
12. Карта
```

**Ключевые CSS-классы:** `.development-hero`, `.development-page`, `__h2`, `.development-intro__grid`, `__card`, `.development-text`, `.development-details`, `__grid`, `__spoilers`, `.development-spoiler`, `__summary`, `__title`, `__body`, `.development-spoiler--large`, `.development-list`, `__title`, `__body`, `.development-order__btn`.

**Картинки:**
| Файл | Где |
|---|---|
| `rent-hero.jpg` | Hero, фон |
| `development-intro.jpg` | Intro, фон |

### 6.24. Страница «Вырубка растительности» (`/felling`) — 100%

**Архитектура:** обычная страница с `page-felling.php`, `Template Name: Услуга — Вырубка древесно-кустарниковой растительности`.

**Структура:**
```
1. Hero — .service-hero + scoped .felling-hero
   ├── фон: felling-hero.jpg
   ├── заголовок: «Вырубка древесно-кустарниковой растительности»
   ├── подзаголовок: «на объектах инфраструктуры ОАО «РЖД»» (29px, weight 700)
   └── кнопка «Оставить заявку» (.js-open-callback)
2. Хлебные крошки — НИЖЕ hero
3. H2 (32px weight 600) + intro 34%/66%:
   ├── слева felling-intro.jpg
   └── справа 2 абзаца
4. Спойлер «Список нормативных документов ОАО «РЖД»» — <details open>
   ├── 16 пунктов
   └── фон: linear-gradient(to right, rgba(239,126,25,0.08), rgba(254,247,245,0.2))
5. Текстовые абзацы + объёмы работ:
   ├── .felling-volumes__grid — 1fr | 1fr
   ├── слева: 3 объёма
   └── справа: кнопка «Реализованные проекты» → /projects#13
6. Секция «ПРЕИМУЩЕСТВА» — .felling-advantages
   ├── H2 56px weight 500
   ├── сетка 6 колонок; каждый item span 2; 4-й item = 2/4, 5-й = 4/6
   └── фон плитки — градиент, иконка 50×50 stroke:#000 (без круга)
7. Секция «ВИДЫ УСЛУГ» — .felling-services
   ├── H2 56px weight 500
   ├── сетка 24%/76%: фото + список 8 пунктов
   ├── CTA-пара: текст + кнопка «Заказать услуги по вырубке» (.js-open-callback)
   └── галерея 4×2 (.felling-gallery__grid)
8. CTA-форма
9. Карта
```

**Галерея — гибридный паттерн:**
```php
$gallery_meta = get_post_meta( $post_id, '_ingi_gallery', true );
// если пусто — файловый фолбэк felling-gallery-1..8.jpg через file_exists()
```

**Картинки:**
| Файл | Где |
|---|---|
| `felling-hero.jpg` | Hero, фон |
| `felling-intro.jpg` | Intro, слева |
| `felling-services.jpg` | Виды услуг, слева |
| `felling-gallery-1..8.jpg` | Галерея (фолбэк) |

**Иконки преимуществ** — сейчас SVG-заглушки со `stroke="currentColor"`, цвет задаётся `.felling-advantages__icon svg { stroke: #000; }`. При желании заменить на донорские через Copy element (§9.4, §9.37).

### 6.25. Мобильный hero: переносы (v12)

**Проблема:** на мобилке длинный заголовок в hero переносился **по буквам**.

**Причина:** `word-break: break-word` / `overflow-wrap: anywhere` в мобильных правилах.

**Фикс (общий паттерн для всех услуг):**
1. Убрать `word-break` / `overflow-wrap` из мобильных правил.
2. Скрыть `<br>` на мобилке: `.xxx-hero .service-hero__title br { display: none; }`.
3. **Пробел — ПЕРЕД `<br>` в HTML:** `Разработка проектов <br>производства работ (ППР)`. При скрытии `<br>` пробел остаётся, слова не склеиваются.
4. Ступенчатое уменьшение размера: 56 → 40 (≤991) → 30 (≤767) → 24 (≤480).

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

Применено на `/development`, `/felling` (и ранее на `/installation` как `.installation-hero`).

**Фикс фона hero** — если он тайлится (§9.49):
```css
.felling-hero .service-hero__bg {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}
```

### 6.27. Секция «Преимущества» — паттерн 6-колоночной сетки (v12)

Раскладка **3 + 2 со сдвигом**:

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
.felling-advantages__item:nth-child(4) { grid-column: 2 / 4; }
.felling-advantages__item:nth-child(5) { grid-column: 4 / 6; }
```

**Плитка преимущества:** фон — `linear-gradient(to right, rgba(254,247,245,0.43), rgba(239,126,25,0.2))`, padding 15×20×22.
**Иконка:** 50×50, **без круга**, `stroke: #000`, line-art. В SVG — `stroke="currentColor"`.
**Адаптив:** на ≤991px — 2 колонки + сброс сдвига (`grid-column: auto` для 4 и 5), на ≤767px — 1 колонка с иконкой слева.

### 6.28. Страница «Политика конфиденциальности» (`/privacy`) — 100%

**Архитектура:** обычная страница с `page-privacy.php`, `Template Name: Политика конфиденциальности`.

**Структура:**
```
1. Один блок .privacy-page (без hero/CTA/карты)
   ├── .privacy-page__inner — max-width 800px, центр
   ├── H1 46px/600: «Политика в отношении обработки персональных данных»
   ├── 12 разделов
   │   ├── H2 16px/700 для каждого раздела
   │   ├── параграфы 16px/1.6
   │   └── в разделе 6 — таблица .privacy-table (th 220px + td)
   └── .privacy-page__back — кнопка «На главную» → home_url('/')
```

**Ссылки (сохранены как в оригинале):**
- `https://ingigroup.ru/` — 4 ссылки в тексте (разделы 1.2, 2.3, 2.8, 2.10) — оставлены как абсолютные ссылки на донор (по требованию пользователя «сохранить как в оригинале»)
- `info@ingigroup.ru` — plain text (разделы 8.3, 8.4, 12.1)
- Ссылка на `/privacy` в разделе 12.3 — через `home_url('/privacy')`, чтобы вела на текущий домен

**CSS:** `.privacy-page`, `__inner`, `__title`, `.privacy-table`, `__back` — в `main.css`; адаптив — в `responsive.css`.

### 6.29. Модалка «Оставить заявку» — переработана (v13)

**Классы приведены к CSS:** **`.modal-callback*`** (было `.ingi-modal*`). Все стили модалки в `main.css`:
`.modal-callback`, `__overlay`, `__dialog`, `__head`, `__title`, `__close`, `__form`, `__field`, `__req`, `__consent`, `__submit`, `__status`.

**Разметка ключевых элементов:**
```html
<div class="modal-callback" id="modal-callback" aria-hidden="true">
    <div class="modal-callback__overlay" data-modal-close></div>
    <div class="modal-callback__dialog" role="dialog" aria-modal="true" aria-labelledby="modal-callback-title">
        <button type="button" class="modal-callback__close" data-modal-close aria-label="Закрыть">×</button>
        <div class="modal-callback__head">
            <h3 class="modal-callback__title" id="modal-callback-title">Оставить заявку</h3>
        </div>
        <form class="modal-callback__form js-ingi-form" novalidate>
            <div class="modal-callback__field">
                <label for="modal-callback-name">Имя</label>
                <input type="text" id="modal-callback-name" name="name" autocomplete="name">
            </div>
            <div class="modal-callback__field">
                <label for="modal-callback-phone">Номер телефона <span class="modal-callback__req">*</span></label>
                <input type="tel" id="modal-callback-phone" name="phone" required autocomplete="tel" data-required="1">
            </div>
            <label class="modal-callback__consent">
                <input type="checkbox" name="agree" value="1" required data-required="1" class="js-ingi-privacy">
                <span>Даю согласие на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>" target="_blank" rel="noopener">обработку персональных данных</a></span>
            </label>
            <input type="hidden" name="inn" value="">
            <input type="hidden" name="form_source" value="modal-callback">
            <button type="submit" class="modal-callback__submit">Отправить</button>
            <div class="modal-callback__status js-ingi-form-msg" aria-live="polite"></div>
        </form>
    </div>
</div>
```

**JS (`main.js`):**
- Открытие/закрытие — через `getElementById('modal-callback')`, `closest('[data-modal-close]')`, ESC.
- Фокус-трап — через `.modal-callback__dialog`.
- Публичный API: `window.ingiOpenCallback()`.
- **Проверка согласия** — в начале обработчика `submit`:
  ```js
  var $agree = $form.find('[name="agree"]');
  if ($agree.length && !$agree.is(':checked')) {
      $msg.removeClass('is-ok').addClass('is-error')
          .text('Пожалуйста, подтвердите согласие на обработку персональных данных.');
      return false;
  }
  ```
- Снятие ошибки — обработчик `change` на `[name="agree"]`.

**Ссылка на политику** — через `home_url('/privacy/')`, открывается в новой вкладке.

---

## 7. Что осталось

Разработка всех страниц закрыта. Осталось:

**Ближайшее:**
1. **Пересоздать пункты меню в подвале (и шапке/оранжевой полосе, если битые) как «Произвольные ссылки»** на `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling` (§9.14, §9.22).
2. **Чистка рудимента в `main.css`:** удалить блоки `.ingi-form__msg.is-error/is-success`, `.ingi-form__row--privacy …`, `.ingi-form .req` — они больше не используются (модалка теперь `.modal-callback*`). Оставить `input.is-invalid, textarea.is-invalid, select.is-invalid`.
3. **Замена SVG-заглушек** в секции «Преимущества» `/felling` на донорские (опционально).
4. **Прогон по всем 6 услугам** в мобильном DevTools.

**Перед боевым:**
5. **AJAX-форма** end-to-end на боевом.
6. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
7. **Оптимизация:** preload шрифтов, lazy для карты, `defer` для `main.js`, перевод сертификатов/отзывов/галерей в медиатеку.
8. **Кросс-браузерное тестирование.**
9. **Перенос на боевой хостинг.**

**Отдельным треком:**
10. **Чистка рудимента:** удалить неиспользуемые `.production-cta*` и `.rent-faq__badge` из `main.css`/`responsive.css`.

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
16. **Лайтбокс ищет сетки по `GRID_SELECTORS` в `main.js`.** Сейчас: `.certificates-grid`, `.opinions-scans-grid`, `.production-gallery__grid`, `.felling-gallery__grid`. Класс карточек — `.certificate-card`.
17. **`archive-opinion.php` использует флаги `$has_posts` / `$has_scans`.**
18. **Файловые фолбэки регистрозависимы.** `opinion-1.jpg` подхватится, `Opinion-1.JPG` — нет.
19. **Яндекс-виджет (iframe) на `/contacts`:** координаты в URL — `lon,lat`.
20. **`.cta-form` — общий парт.** Не удалять у него `padding-bottom` глобально.
21. **Customizer `inc/customizer.php` — одна плоская секция `ingi_contacts`.**
22. **Удалил страницу-двойник → пункт меню стал «Некорректным» → пропал с фронта.**
23. **НЕ вкладывать CSS-правила друг в друга.**
24. **Не плодить дубли блоков в `main.css`.**
25. **При правках `main.css`/`responsive.css`/`hotfix.css` — присылать файл целиком.**
26. **Модалка использует те же классы, что CTA-форма** (`.js-ingi-form`, `.js-ingi-form-msg`). Если менять в одном — надо менять и в другом.
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
37. **SVG-иконки с донора чистятся перед вставкой в шаблон.**
38. **Аккордеон на `<details>/<summary>`:** убрать стандартный маркер, иконку «+/−» рисовать через CSS.
39. **При создании страницы-услуги — слаг строго латиницей, нижний регистр, без пробелов.**
40. **Если «задваивается» контент — сначала проверить `page-{slug}.php` на дублирование секций.**
41. **Не доверять первому впечатлению от верхнего края скрина донора.** Запрашивать кроп секции.
42. **Hero-заголовок разной длины ломает общий `.service-hero`.** Лечение: scoped-модификатор.
43. **Имена файлов-транслитом от пользователя** — рабочие, но лучше договариваться о читаемых именах.
44. **Вторая метка хлебных крошек = заголовок страницы в админке (`get_the_title()`).**
45. **Паттерн вызова карты — многострочный** (§6.22).
46. **`template-parts/map.php` содержит page-check** (whitelist страниц).
47. **Длинные транслитерированные имена файлов** — рабочие, но неудобны.
48. **На мобилке `word-break: break-word` и `overflow-wrap: anywhere` рвут слова по буквам.** Убирать их, скрывать `<br>`, пробел ставить ПЕРЕД `<br>` в HTML (§6.25).
49. **Фон hero может тайлиться, если у `.service-hero__bg` нет `background-size: cover` / `background-repeat: no-repeat`.** Фикс — scoped-модификатор (§6.26).
50. **Иконки в SVG-заглушках использовать со `stroke="currentColor"`.** Цвет задавать в CSS.
51. **Секция «Преимущества» с раскладкой 3+2** — 6-колоночная сетка + `nth-child(4) { grid-column: 2/4 }` + `nth-child(5) { grid-column: 4/6 }` (§6.27). На адаптиве сбрасывать сдвиг.
52. **Классы модалки — `.modal-callback*`, НЕ `.ingi-modal*`.** CSS и JS привязаны к `.modal-callback`, `getElementById('modal-callback')`, `[data-modal-close]`. При правке HTML не переименовывать обратно.
53. **Чекбокс согласия в модалке имеет `name="agree"`.** Именно это имя ищет `main.js`. Если переименуешь — синхронно правь JS.
54. **Ссылки в текстах на внутренние страницы — через `home_url()`.** Пример: `/privacy/` в модалке — `home_url('/privacy/')`, чтобы работало и на тесте, и на бою.
55. **После смены классов HTML — чистить CSS от «мёртвых» селекторов.** Пример: после `.ingi-modal*` → `.modal-callback*` в `main.css` остались правила `.ingi-form__row--privacy …`, `.ingi-form .req` — их надо было удалить.

---

## 10. Что дальше

Все страницы разработаны. Дальнейшие шаги:

1. **Пересоздать битые пункты меню в подвале** — см. §7.1.
2. **Почистить «мёртвые» селекторы** в `main.css` — см. §7.2.
3. **AJAX-форма** end-to-end на боевом.
4. **SEO:** title, description, OG.
5. **Оптимизация:** preload шрифтов, lazy для карты, `defer` для `main.js`.
6. **Перевод сертификатов/отзывов/галерей в медиатеку.**
7. **Кросс-браузерное тестирование.**
8. **Перенос на боевой хостинг.**

---

## 11. Открытые вопросы

- **AJAX-форма:** end-to-end тест перенесён на боевой хостинг.
- **Содержимое CPT `service`** — пока пуст, оставлен на будущее.
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — на тесте загружено; на бою загрузить заново.
- **Наполнение `certificate` / `opinion`** — работают файловые фолбэки.
- **Маркер Москвы на `/contacts`:** оставить синюю точку или переключить виджет на `?text={address}`.
- **Медиатека vs файлы:** галерея `/production` и `/felling` — через метабокс; вводные фото — пока файлами.
- **Иконки преимуществ на `/felling`:** заменить SVG-заглушки на донорские?
- **Метабокс галереи:** ключ `_ingi_gallery` — проверить в `inc/meta-boxes-production-gallery.php`, имя совпадает?
- **Унификация каркаса страниц услуг:** у каждой страницы своя «специя», общий каркас не окупается.
- **Ссылки на `https://ingigroup.ru/` внутри `/privacy`:** оставлены абсолютными как в оригинале. При переносе на боевой — решить, не переписать ли их на относительные (но пользователь просил «сохранить как в оригинале»).

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
| Страница «Политика конфиденциальности» | https://ingigroup.xyz/privacy/ |
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
## 13. Перенос на боевой

**Контекст:**
- Тема заменяет существующий сайт на **том же домене** `ingigroup.ru` (не переезд на новый домен).
- **URL-структура старого и нового сайта совпадает** — `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`, `/projects/`, `/certificates/`, `/opinions/`, `/contacts/`, `/company/`, `/privacy` — один-в-один. **301-карта не требуется.**
- `/project/<slug>/` — новые URL, на доноре их не было. Редиректов не требуют, но проверить старый sitemap на «предшественников» (см. §13.1, п. 3).
- Домен в БД менять **не нужно**. Если разворачивалось с теста — проверить `wp_options` (`home`, `siteurl`).

---

### 13.1. До переноса

- [ ] **`404.php`** добавлен в корень темы + CSS в `main.css` / `responsive.css` (см. §6.30).
- [ ] **Проверить старый sitemap** донора (`https://ingigroup.ru/sitemap.xml`) на страницы-предшественники проектов (`/portfolio/...`, `/objects/...`, `/gallery/...`). Если такие были — составить точечные 301 на новые `/project/<slug>/`.
- [ ] **Бэкап старого сайта целиком:**
  - [ ] дамп БД (`wp db export` или phpMyAdmin);
  - [ ] `wp-content/uploads/` (там могут быть файлы, не учтённые в теме);
  - [ ] файлы сайта (`wp-content/themes/`, `wp-content/plugins/`, `wp-config.php`, `.htaccess`);
  - [ ] хранить минимум **30 дней** после переноса.
- [ ] **`.htaccess` старого сайта** — сохранить. Если были кастомные правила (редиректы, безопасность, кэш) — перенести вручную.
- [ ] **`robots.txt`** — убедиться, что не приехал `Disallow: /` с теста. Если сайт закрывался на `.xyz` — снять запрет на боевом.
- [ ] **`wp_options`** — `home` и `siteurl` = `https://ingigroup.ru`, **не** `ingigroup.xyz`:
  ```bash
  wp option get home
  wp option get siteurl
  ```
  Если стоят тестовые — править:
  ```bash
  wp option update home 'https://ingigroup.ru'
  wp option update siteurl 'https://ingigroup.ru'
  ```
- [ ] **Ключ Яндекс.Карт** — перевыпустить в консоли разработчика с ограничением по Referer на `ingigroup.ru`. Обновить в Customizer.
- [ ] **Фото директора** — загрузить заново (на тесте было загружено, на боевом — нет).
- [ ] **Медиатека:** сертификаты / отзывы / галереи `/production` и `/felling` — залить через админку, иначе сработает файловый фолбэк (`file_exists()`). Файлы из `assets/images/` пока **не удалять**.
- [ ] **Выбрать окно выкатки** — ночь/выходной. Предупредить заказчика.
- [ ] **Согласовать точку невозврата** — момент, после которого откат = разворачивание бэкапа.

---

### 13.2. Перенос

Порядок действий (адаптировать под хостинг — SSH/FTP/панель):

1. Поставить сайт в режим обслуживания (или просто выбрать окно минимального трафика).
2. Залить тему `wp-content/themes/ingigroup/` — целиком, поверх старой (если была с тем же именем — удалить старую папку).
3. Залить `wp-content/uploads/` (если не переехали раньше).
4. Залить `wp-config.php` (или поправить существующий — БД, префикс, соли).
5. Развернуть БД с теста (или использовать существующую боевую — в зависимости от того, где наполнялся контент).
6. Проверить `wp_options` (`home`, `siteurl`, `template`, `stylesheet`):
   ```bash
   wp option get template
   wp option get stylesheet
   ```
   Оба должны вернуть `ingigroup`.
7. Сохранить permalinks:
   ```bash
   wp rewrite flush
   ```
   Или через админку: **Настройки → Постоянные ссылки → Сохранить**.
8. Сбросить кэши:
   - кэш хостинга (LiteSpeed / NGINX FastCGI / Varnish);
   - кэш плагина, если стоит;
   - `wp cache flush`;
   - Cloudflare purge, если используется.
9. Снять режим обслуживания.
10. **Ctrl+Shift+R** на всех ключевых страницах.

---

### 13.3. Первые 24 часа после переноса

- [ ] **Smoke-тест 8 ключевых URL:** `/`, `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`, `/contacts`, `/privacy`. Визуальная проверка + 200-статус.
- [ ] **Форма в модалке «Оставить заявку»** — тест end-to-end с боевого домена. Проверить, что письмо приходит (SMTP или `wp_mail` — смотреть лог хостинга).
- [ ] **Форма CTA** (`template-parts/cta-form.php`) — тест end-to-end. Проверить, что `form_source` в письме = `cta` (или как у тебя), а не `modal-callback`.
- [ ] **AJAX через `admin-ajax.php`** — проверить, что плагины безопасности (если есть) не рубят action `ingi_send`.
- [ ] **Карты** — грузятся ли на главной, `/company`, `/contacts`. Проверить консоль браузера на ошибки ключа.
- [ ] **`wp-admin`** — доступ, меню (шапка/подвал/услуги), сохранение страниц, редактирование проектов/сертификатов/отзывов.
- [ ] **`sitemap.xml`** — все URL боевые (`ingigroup.ru`), не тестовые.
- [ ] **`robots.txt`** — сайт не закрыт от индексации.
- [ ] **404-страница** — открыть `/qwerty`, убедиться, что отдаёт 404-статус и кастомный шаблон.
- [ ] **Яндекс.Вебмастер** — добавить боевой, отправить sitemap.
- [ ] **Google Search Console** — добавить боевой, отправить sitemap.
- [ ] **Метрика / GA** — проверить, что счётчики стоят и события форм улетают.
- [ ] **Открыть site health** (`/wp-admin/site-health.php`) — глянуть критичные предупреждения.

---

### 13.4. Откат (если что-то сломалось критично)

1. Вернуть старые файлы сайта из бэкапа.
2. Импортировать дамп БД старого сайта.
3. Сохранить permalinks.
4. Сбросить кэши.
5. Проверить smoke-тест.

Бэкап **не удалять 30 дней**. Даже если всё работает — внезапно всплывают неочевидные проблемы (например, чужой плагин, который не был учтён, или забытая интеграция).

---

### 13.5. Известные грабли переноса

- **Кэш хостинга** — самая частая причина «правки не видны». Сбрасывать перед каждой проверкой.
- **`filemtime` в `inc/enqueue.php`** — при переносе файлы получают новые mtime, версии в HTML обновятся автоматически. Но если хостинг кэширует статику по URL — Ctrl+Shift+R.
- **Медиатека vs файлы** — галереи `/production` и `/felling` ищут `_ingi_gallery`, если пусто — файловый фолбэк. Не удалять `assets/images/` до полной проверки.
- **Файловые фолбэки регистрозависимы.** `opinion-1.jpg` — ок, `Opinion-1.JPG` — нет (§9.18).
- **Кастомные правила `.htaccess`** — если на старом сайте были (редиректы, заголовки безопасности) — они пропадут при замене файлов. Копировать заранее.
- **Ключ Яндекс.Карт** — без ограничения по Referer есть риск утечки. Через 2 недели после боя проверить консоль разработчика Яндекса.
- **Хлебные крошки на страницах услуг** — вторая метка = `get_the_title()` страницы (§9.44). Если заголовки в админке случайно переименовались при переносе — крошки поедут.
- **`/privacy` — ссылки на `https://ingigroup.ru/`** в тексте оставлены абсолютными по требованию «сохранить как в оригинале» (§11). После переноса они работают, но при будущих правках политики — решить, не переписать ли на `home_url()`.

---

### 13.6. Что осталось за рамками этой темы

- **SEO:** title, description, OG — через `add_theme_support('title-tag')` + Customizer/ACF (или плагин Yoast/RankMath).
- **Оптимизация:** preload шрифтов Inter, `defer` на `main.js`, lazy для карты Яндекса.
- **Кросс-браузерное тестирование.**
- **Прогон всех 6 услуг в мобильном DevTools.**
- **Чистка «мёртвых» селекторов** в `main.css` / `responsive.css`: `.production-cta*`, `.rent-faq__badge`, `.ingi-form__*`.

Делать после стабилизации боевого — не в день переноса.
