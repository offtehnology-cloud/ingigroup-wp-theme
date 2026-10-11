# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v9
**Дата обновления:** 11 октября 2026 г.
**Статус:** главная закрыта, «Проекты» закрыты (30/30), «О компании» закрыта, «Сертификаты» закрыта, «Отзывы» закрыта, «Контакты» закрыта, модалка «Оставить заявку» закрыта, «Установка РСП» (`/service`) закрыта, «Изготовление РСП» (`/production`) закрыта.
**В работе:** «Услуги» — осталось 4 страницы из 6.

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
  ├── cta-form.php     — общий CTA-парт (главная, /service, /production, /contacts)
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
  ├── main.css         — всё (главная + проекты + услуги + контакты + отзывы + сертификаты + модалка + production)
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, AJAX-форма, карта, AOS, GSAP, лайтбокс, спойлеры, модалка
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg + opinion-1..opinion-9.jpg + service-rsr-hero.jpg + production-hero.jpg + production-1.jpg + production-2.jpg + production-spec-*.jpg
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

### Шрифты

- Inter (100–900)
- Заголовки секций: 51px, weight 700, uppercase
- Заголовки внутренних страниц («О компании», «Сертификаты», «Отзывы», «Контакты»): 32px, weight 700, uppercase
- Hero `/service` (десктоп): заголовок 56px, подзаголовок 20px, кнопка 19px + border 5px
- Hero `/production`: тот же `.service-hero`, отличается только фон + подзаголовок («Изготовление и продажа рельсовых страховочных пакетов»)
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

**Важно:** CPT `service` не используется для 6 основных услуг сайта. Он оставлен как задел на будущее (для «второстепенных» услуг с общим шаблоном). 6 основных услуг — это обычные `page` с `page-{slug}.php` шаблонами.

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

Без изменений (см. v7 §6.10). Дополнено в v9: в `GRID_SELECTORS` добавлен `.production-gallery__grid`.

### 6.11. Страница «Контакты» (`/contacts`) — 100%

Без изменений (см. v7 §6.11).

### 6.12. Главное меню в шапке

Без изменений (см. v7 §6.12).

### 6.13. Модалка «Оставить заявку» — 100%

Без изменений (см. v7 §6.13).

### 6.14. Страница «Установка РСП» (`/service`) — 100%

Без изменений (см. v8 §6.14). Архитектура «6 услуг — это page, не CPT» заложена здесь.

### 6.15. Адаптив страницы «Услуги» (`/service`)

Без изменений (см. v8 §6.15).

### 6.16. Страница «Изготовление РСП» (`/production`) — 100%

**Архитектурное решение:** та же логика, что у `/service` — обычная страница с `page-production.php` на корневом уровне. Не CPT, не `/services/production/`.

**Структура `page-production.php`:**

```
1. Хлебные крошки (template-parts/breadcrumbs.php) — ДО hero
2. Hero — переиспользуем .service-hero (тот же класс, что у /service)
   ├── фон: production-hero.jpg (своя картинка)
   ├── заголовок: «Страховочные рельсовые пакеты»
   ├── подзаголовок: «Изготовление и продажа рельсовых страховочных пакетов»
   └── кнопка «Оставить заявку» (.js-open-callback)
3. H2 «Изготовление и продажа рельсовых страховочных пакетов» + лид + 2 фото рядом (.production-page__two-images)
4. Абзац описания (.production-page__text)
5. H2 «Комплектность страховочного рельсового пакета» (--mt)
6. Спецификация .production-specs — 7 пунктов .production-specs__item
   ├── каждый: grid 1fr 380px, слева body (num + desc + list/mark), справа картинки
   ├── пункты 2, 3, 4 — по 2 картинки (flex, делят строку поровну)
   └── пункты 1, 5, 6, 7 — по 1 картинке
7. Галерея .production-gallery — ЧЕРЕЗ МЕТАБОКС (см. §6.17)
8. CTA-форма — template-parts/cta-form.php (общий парт)
9. Карта (locate_template guard)
```

**Важно:** CTA на `/production` — это `<?php get_template_part( 'template-parts/cta-form' ); ?>`, а НЕ кастомный `.production-cta`. Кастомный блок не работал (не тот обработчик форм), пользователь заменил на общий парт — заработало. Классы `.production-cta*` в CSS можно удалить (остались как рудимент).

**Ключевые CSS-классы:**

- `.service-hero`, `__bg`, `__inner`, `__content`, `__title`, `__sub`, `__btn` — hero (переиспользован от /service).
- `.production-page`, `__h2`, `__h2--mt`, `__lead`, `__two-images`, `__text` — основной контент.
- `.production-specs`, `__item`, `__num`, `__desc`, `__list`, `__mark`, `__imgs` — спецификация.
- `.production-gallery`, `__grid` — галерея.

**Особенности спецификации:**

- `.production-specs__item` — `display: grid; grid-template-columns: 1fr 380px; gap: 40px`.
- `.production-specs__mark` — «Количество…» — подчёркнут оранжевой линией (`border-bottom: 2px solid var(--orange)`).
- `.production-specs__list li` — маркер `•` оранжевого цвета через `::before`.
- Фикс v9: у `.production-specs__imgs img` добавлен `min-width: 0`, у `img:not(:only-child)` — `flex: 1 1 0`. Иначе две картинки переносились друг под друга из-за `min-width: auto` в flexbox.

**Изображения на `/production`:**

| Файл | Где | Как наполняется |
|---|---|---|
| `assets/images/production-hero.jpg` | Hero, фон | Файлом |
| `assets/images/production-1.jpg` | Два вводных фото под H2 | Файлом |
| `assets/images/production-2.jpg` | Там же | Файлом |
| `assets/images/production-spec-1.jpg`, `-2a.jpg`, `-2b.jpg`, `-3a.jpg`, `-3b.jpg`, `-4a.jpg`, `-4b.jpg`, `-5.jpg`, `-6.jpg`, `-7.jpg` | Спецификация, справа от текста | Файлами |
| Галерея | `.production-gallery__grid` | Метабоксом (см. §6.17); файловый фолбэк — `assets/images/production/gallery-N.jpg` |

### 6.17. Метабокс «Галерея изображений» (`inc/meta-boxes-production-gallery.php`) — 100%

**Назначение:** даёт в админке поле для пачечной загрузки картинок в галерею страницы-услуги. Не надо заливать файлы в тему руками — всё через медиатеку WP.

**Как работает:**

- Метабокс показывается на страницах, чьи слаги перечислены в `ingi_gallery_enabled_slugs()` (по умолчанию — только `production`). Фильтр `ingi_gallery_enabled_slugs` позволяет расширить список.
- Хранит ID вложений в мета-поле `_ingi_gallery` (comma-separated).
- Кнопка «Добавить изображения» → `wp.media` с `multiple: true` → можно перетащить пачку файлов прямо в окно медиатеки или выбрать много кликами с Shift/Ctrl.
- Миниатюры сортируются drag-n-drop (jQuery UI Sortable).
- `×` на миниатюре — убрать одну, «Очистить» — снести все.
- Файловый фолбэк: если метаполе пусто, шаблон рендерит `assets/images/production/gallery-N.jpg`, но только те, что реально существуют на диске (проверка `file_exists()`). Если и файлов нет — секция галереи не выводится вообще (пустых квадратов нет).
- Лайтбокс работает через `.production-gallery__grid` (добавлен в `GRID_SELECTORS` в `main.js`); класс карточек — `.certificate-card` (тот же, что у сертификатов/отзывов).

**Как расширить на другие услуги** (когда возьмёмся за `/rent`, `/installation` и т.д.):

```php
function ingi_gallery_enabled_slugs() {
    return apply_filters( 'ingi_gallery_enabled_slugs',
        [ 'production', 'rent', 'installation', 'development', 'felling' ] );
}
```

И вставить в шаблон тот же блок рендера галереи (универсальный, читает `_ingi_gallery`).

### 6.18. Адаптив страницы «Изготовление РСП»

**`responsive.css` — блок `PRODUCTION PAGE — адаптив`:**

- `≤991px`: H2 26px, спец-пункты в одну колонку, картинки влево.
- `≤767px`: H2 22px, два вводных фото в столбик, галерея 2 колонки, `.production-specs__imgs img:not(:only-child)` — пополам.
- `≤480px`: H2 18px, размеры шрифтов уменьшены.

**Высоты `.production-page__two-images img` (после правки v9):**

| Брейкпоинт | Было | Стало |
|---|---|---|
| Десктоп | 260px | 330px |
| ≤991px | 200px | 255px |
| ≤767px | 180px | 230px |
| ≤480px | 150px | 190px |

### 6.19. Скрипт выгрузки изображений с донора

Для наполнения страниц использовался двухэтапный подход: консольный скрипт в браузере донора + bash-скрипт на Kubuntu.

**Шаг 1 — консоль донора (F12 → Console, ПОСЛЕ прокрутки страницы до низа):**

Скрипт собирает `<img>` (включая `currentSrc` и `data-src`) + CSS `background-image`, отсекает логотипы/иконки/`.svg` и мелочь < 120×120, дедуплицирует по URL без query, формирует массив с предложенными именами `<PAGE_PREFIX>-NN.<ext>`. Кладёт в `window.__ingiImages` и в буфер (`navigator.clipboard.writeText`). Если буфер не сработал — `copy(JSON.stringify(window.__ingiImages, null, 2))` вручную или через blob-скачивание в `~/Downloads/images.json`.

**Ключевые настройки в скрипте:**
- `const PAGE_PREFIX = 'production';` — меняется под каждую страницу (`service`, `rent`, …).
- `const SKIP_URL = /logo|icon|sprite|flag|arrow|btn|button|play|search|close|menu|burger|placeholder|\.svg/i`.
- `const MIN_W = 120, MIN_H = 120`.

**Обработка расширений:** `extFrom(url)` — срезает `?` и `#`, ищет `.[a-z0-9]+$`, маппит `jpeg/jfif → jpg`, `avif/gif/webp/png/jpg` оставляет, иначе — `jpg`. НЕ использовать `url.match(/\.(jpe?g|png|webp)/i)[1]` — падает с `TypeError` на URL без расширения.

**Шаг 2 — Kubuntu (Linux):** `download.sh` в `~/ingigroup-download/`:

- Требует `jq` и `curl` (`sudo apt install jq curl`).
- Читает `images.json` (массив `{n, url, size}`), качает через `curl -fsSL -A "$UA" -e "https://ingigroup.ru/" --retry 3`.
- Referer обязателен — донор отдаёт 403 без него.
- Файлы кладёт в `~/ingigroup-download/downloads/`.
- Проверяет размер (< 500 байт — считает заглушкой, удаляет).

**Быстрая выгрузка на Kubuntu Wayland:** `wl-paste > images.json` (вместо `xclip -selection clipboard -o`). На X11 — `xclip`.

---

## 7. Что осталось

1. **Услуги — 4 из 6 осталось:**
   - ✅ Установка РСП (`/service`) — закрыта
   - ✅ Изготовление РСП (`/production`) — закрыта
   - ⏳ Аренда РСП (`/rent`) — `page-rent.php`
   - ⏳ Монтаж инженерных сетей (`/installation`) — `page-installation.php`
   - ⏳ Разработка проектов (`/development`) — `page-development.php`
   - ⏳ Вырубка растительности (`/felling`) — `page-felling.php`
2. **Проверка AJAX-формы** end-to-end — отложена до боевого хостинга.
3. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
4. **Оптимизация:** preload шрифтов, lazy для карты, `defer` для `main.js`, перевод сертификатов/отзывов в медиатеку.
5. **Кросс-браузерное тестирование.**
6. **Перенос на боевой хостинг.**
7. **Чистка рудимента:** удалить из `main.css` и `responsive.css` неиспользуемые `.production-cta*` (заменены на `cta-form.php`).

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
12. **`locate_template('template-parts/map.php')`** — если файла нет, секция молча пропускается.
13. **`certificate` CPT — без `editor`.** Если понадобится описание — расширить `supports`.
14. **Страница-двойник перебивает архив CPT / обычную страницу.** Если в админке есть `page` со слагом, совпадающим с rewrite.slug CPT (`certificates`, `opinions`, `services`, `projects`) или с корневым URL услуги (`service`, `production`, `rent`, …) — WP отдаёт старую страницу. Лечение: удалить страницу-двойник из админки + Сохранить permalinks.
15. **Rewrite-приоритет покрывает все 4 архива CPT.** При добавлении нового CPT — дописать правила в `$prefix` в `inc/cpt.php`.
16. **Лайтбокс ищет сетки по `GRID_SELECTORS` в `main.js`.** Новую сетку с лайтбоксом — добавить в массив (сейчас: `.certificates-grid`, `.opinions-scans-grid`, `.production-gallery__grid`). Класс карточек — `.certificate-card`.
17. **`archive-opinion.php` использует флаги `$has_posts` / `$has_scans`.** Если CPT пуст, но файлы есть — H2 «Оригиналы отзывов» не выводится.
18. **Файловые фолбэки регистрозависимы.** `opinion-1.jpg` подхватится, `Opinion-1.JPG` — нет. Проверить на боевом (Linux).
19. **Яндекс-виджет (iframe) на `/contacts`:** координаты в URL — `lon,lat` (долгота сначала). Родное `aspect-ratio` — 16:10. Маркер захардкодить нельзя.
20. **`.cta-form` — общий парт.** Не удалять у него `padding-bottom` глобально. Убирать только через scoped-селектор.
21. **Customizer `inc/customizer.php` — одна плоская секция `ingi_contacts`.** Не смешивать контакты с другими полями.
22. **Удалил страницу-двойник → пункт меню стал «Некорректным» → пропал с фронта.** Лечение: удалить битый пункт из меню, завести заново как Произвольную ссылку. Профилактика: пункты меню, ведущие в CPT-архивы (`/services/`, `/certificates/`, `/opinions/`), сразу заводить как «Произвольные ссылки».
23. **НЕ вкладывать CSS-правила друг в друга.** В `main.css` был баг: `.spoiler--static` был вложен внутрь `.service-sub__desc { … }` (SCSS-синтаксис). Браузер выбросил вложенный блок, `.spoiler--static` не работал. Все правила — плоско.
24. **Не плодить дубли блоков в `main.css`.** При правке `SERVICE HERO` остался старый блок в середине файла + новый в конце. Старый `display: grid` перебивал новый `display: flex`. Симптом: hero вёл себя не по правилам нового блока. Лечение: удалить старый блок.
25. **При правках `main.css`/`responsive.css`/`hotfix.css` — присылать файл целиком.** Легко наплодить дублей и вложенных правил.
26. **Модалка использует те же классы, что CTA-форма.** Если менять `.js-ingi-form` или `.js-ingi-form-msg` в CTA — надо менять и в модалке (или наоборот). Существующий jQuery-обработчик `$(document).on('submit', '.js-ingi-form', …)` — общий.
27. **В модалке должен быть `<input type="hidden" name="inn" value="">`.** Существующий AJAX-обработчик обращается к `$form.find('[name="inn"]').val()` — если поля нет, вернёт `undefined`, но лучше подстраховаться пустым hidden.
28. **`page-service.php` / `page-production.php` в админке — «Default template».** Не выбирать `Template Name: Услуга — …` — WP сам подхватит `page-{slug}.php` по слагу страницы.
29. **Услуги на корневом уровне** (`/service`, `/production`, …), НЕ `/services/…`. CPT `service` зарегистрирован с `rewrite.slug = 'services'`, но мы этот URL не используем.
30. **Файловый фолбэк галереи — только через `file_exists()`.** Без проверки шаблон рендерит 28 битых `<img>` на несуществующие `gallery-N.jpg` → пустые квадраты в вёрстке. Лечение: `file_exists()` перед выводом + если ни одного файла нет — секцию не рендерить.
31. **CTA на страницах услуг — только `template-parts/cta-form.php`.** Не изобретать кастомный `.production-cta` с собственной формой — там не тот обработчик, форма не отправляется. Классы `.js-ingi-form`, `.js-ingi-form-msg`, `name="inn"` уже расшарены и завязаны на jQuery-обработчик в `main.js`.
32. **Flexbox и две картинки в ряд:** `img { min-width: auto }` по умолчанию не даёт сжиматься ниже натуральной ширины → вторая картинка переносится. Фикс: `img { min-width: 0 }` + `img:not(:only-child) { flex: 1 1 0 }`. В адаптиве — `max-width: calc(50% - Npx)`.
33. **`navigator.clipboard.writeText` в консоли не всегда срабатывает** (нет user-gesture, http, политика браузера). Резерв: `copy(JSON.stringify(window.__ingiImages, null, 2))` вручную, либо blob-скачивание в `~/Downloads`. На Kubuntu под Wayland — `wl-paste > file.json` (не `xclip`).
34. **`url.match(/\.(jpe?g|png|webp)/i)[1]` падает на URL без расширения.** Всегда безопасный `extFrom()` с проверкой на `null` и фолбэком `'jpg'`.
35. **Скачивание с донора без Referer даёт 403.** В `curl` обязателен `-e "https://ingigroup.ru/"` и User-Agent.

---

## 10. Что дальше

Продолжаем «Услуги» в порядке:

1. ✅ Установка РСП (`/service`) — закрыта.
2. ✅ Изготовление РСП (`/production`) — закрыта.
3. ⏳ Аренда РСП (`/rent`) — `page-rent.php`.
4. ⏳ Монтаж инженерных сетей (`/installation`) — `page-installation.php`.
5. ⏳ Разработка проектов (`/development`) — `page-development.php`.
6. ⏳ Вырубка растительности (`/felling`) — `page-felling.php`.

**Что нужно при старте каждой услуги:**
- Скрины донора (`ingigroup.ru/rent` и т.д.) — десктоп + мобилка.
- Прогнать консольный скрипт выгрузки картинок (§6.19) — `PAGE_PREFIX` менять под страницу.
- Скачать через `download.sh` → разложить по `assets/images/`.
- Создать страницу в админке со слагом (`rent`, `installation`, …) → шаблон Default template → Сохранить permalinks.
- Добавить слаг в `ingi_gallery_enabled_slugs()` (§6.17), если у услуги есть галерея.

**Что нужно обязательно проверить у каждой услуги:** свой hero (своя картинка + свой подзаголовок), свои блоки (могут отличаться), но общий каркас из `page-service.php` / `page-production.php` переиспользуется. Если у донора структура принципиально другая (галерея вместо аккордеона, блок с ценами и т.д.) — подстраивать каркас, не копировать вслепую.

---

## 11. Открытые вопросы

- **AJAX-форма:** end-to-end тест перенесён на боевой хостинг.
- **Услуги — специфика:** у каждой из 4 оставшихся услуг уточнять структуру (аккордеон? галерея? цены?).
- **Содержимое CPT `service`** — пока пуст, оставлен на будущее.
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — на тесте загружено; на бою загрузить заново.
- **Наполнение `certificate` / `opinion`** — работают файловые фолбэки.
- **Маркер Москвы на `/contacts`:** оставить синюю точку или переключить виджет на `?text={address}`.
- **Медиатека vs файлы:** галерея `/production` — через метабокс; фото спецификации — пока файлами. Решить: переводить ли спецификацию и вводные фото в медиатеку (расширить метабокс) или оставить файловый подход.
- **Чистка рудимента:** удалить неиспользуемые `.production-cta*` правила из `main.css`/`responsive.css`.

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
| Открыть модалку (консоль) | `window.ingiOpenCallback()` |
| Inspect сетки лайтбокса | `.certificates-grid`, `.opinions-scans-grid`, `.production-gallery__grid` |

**Скрипты наполнения (на Kubuntu):**

```bash
# 1) на доноре в консоли: прогнать скрипт (§6.19), PAGE_PREFIX = 'rent' / 'installation' / ...
# 2) забрать JSON
mkdir -p ~/ingigroup-download && cd ~/ingigroup-download
wl-paste > images.json        # Wayland
# xclip -selection clipboard -o > images.json   # X11
jq 'length' images.json       # проверить число картинок
# 3) скачать
./download.sh
# 4) разложить по assets/images/ темы
```
