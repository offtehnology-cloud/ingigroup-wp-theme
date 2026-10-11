# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v10
**Дата обновления:** 11 октября 2026 г.
**Статус:** главная закрыта, «Проекты» закрыты (30/30), «О компании» закрыта, «Сертификаты» закрыта, «Отзывы» закрыта, «Контакты» закрыта, модалка «Оставить заявку» закрыта, «Установка РСП» (`/service`) закрыта, «Изготовление РСП» (`/production`) закрыта, «Аренда РСП» (`/rent`) закрыта.
**В работе:** «Услуги» — осталось 3 страницы из 6.

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
  ├── cta-form.php     — общий CTA-парт (главная, /service, /production, /rent, /contacts)
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
  ├── main.css         — всё (главная + проекты + услуги + контакты + отзывы + сертификаты + модалка + production + rent)
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, AJAX-форма, карта, AOS, GSAP, лайтбокс, спойлеры, модалка
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg + opinion-1..opinion-9.jpg + service-rsr-hero.jpg + production-hero.jpg + production-1.jpg + production-2.jpg + production-spec-*.jpg + rent-hero.jpg
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
- H2 на страницах услуг (`/production`, `/rent`): 32px, weight 700, **не uppercase**
- Hero `/service`, `/production`, `/rent` (десктоп): заголовок 56px, подзаголовок 20px, кнопка 19px + border 5px
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

**Уточнение v10:** на страницах услуг (`/service`, `/production`, `/rent`) хлебные крошки стоят **НИЖЕ hero** (а не выше, как было изначально на `/production`). Пользователь поправил везде. При создании новых страниц услуг — следовать этому же паттерну.

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

Без изменений (см. v9 §6.16).

### 6.17. Метабокс «Галерея изображений» (`inc/meta-boxes-production-gallery.php`) — 100%

Без изменений (см. v9 §6.17).

### 6.18. Адаптив страницы «Изготовление РСП»

Без изменений (см. v9 §6.18).

### 6.19. Скрипт выгрузки изображений с донора

Без изменений (см. v9 §6.19).

### 6.20. Страница «Аренда РСП» (`/rent`) — 100%

**Архитектурное решение:** та же логика, что у `/service` и `/production` — обычная страница с `page-rent.php` на корневом уровне. Не CPT, не `/services/rent/`.

**`Template Name`:** в шапке файла обязательно:

```php
<?php
/**
 * Template Name: Услуга — Аренда РСП
 */
get_header();
$theme_uri = get_template_directory_uri();
?>
```

При создании страницы в админке — выбрать шаблон `Услуга — Аренда РСП` в дропдауне «Шаблон», **иначе WP возьмёт «Default template» и страница может «задваиваться»**. То же правило действует для `/service` и `/production` (у них свои `Template Name`).

**Структура `page-rent.php`:**

```
1. Hero — переиспользуем .service-hero
   ├── фон: rent-hero.jpg (своя картинка)
   ├── заголовок: «Аренда страховочных рельсовых пакетов» (в 2 строки, <br>)
   ├── подзаголовка НЕТ (в отличие от /service и /production)
   └── кнопка «Оставить заявку» (.js-open-callback)
2. Хлебные крошки (template-parts/breadcrumbs.php) — НИЖЕ hero
3. H2 «Комплектация страховочных пакетов» + лид
4. Спецификация .rent-specs__grid — 2 колонки:
   ├── 12,5 метров: общий вес 13 353,80 кг
   └── 25 метров: общий вес 26 698,61 кг
   Каждая колонка = 6 вложенных таблиц (.rent-specs__table-block):
   Рельс Р50 / Полушпала / Хомут / Болт клеммный в сборе М22×75 /
   Болт М24×160 / Отбойник
5. Секция «Дополнительные услуги» (--grey) + .rent-extra__grid 2 колонки:
   ├── 12,5 м: 2 галочки + «не требуется»
   └── 25 м: 2 галочки + «требуется»
6. H2 «Условия самовывоза» + лид + .rent-pickup__grid 3 карточки
   ├── 3 SVG-иконки (люди / автокран / фура), цвет rgb(242, 151, 71)
   └── карточки в стиле аккордеона (белые, рамка #eee, radius 6px)
7. H2 «Вопрос-ответ» + лид + .rent-faq__list — аккордеон на <details>/<summary>
   ├── иконка «+/−» через CSS (::before/::after)
   ├── первый пункт открыт (<details open>)
   └── 3 вопроса (см. тексты в §11 «Открытые вопросы»)
8. CTA-форма — template-parts/cta-form.php (общий парт)
9. Карта (locate_template guard)
```

**Ключевые CSS-классы:**

- `.service-hero`, `__bg`, `__inner`, `__content`, `__title`, `__sub`, `__btn` — hero (переиспользован).
- `.rent-page__section`, `--grey`, `.rent-page__h2`, `.rent-page__lead` — общий каркас секций страницы.
- `.rent-specs__grid`, `__col`, `__col-title`, `__weight`, `__table-block`, `__table-title`, `__table` — комплектация.
- `.rent-extra__grid`, `__col`, `__title`, `__list`, `__item`, `__text`, `__mark`, `__mark--check`, `__mark--na`, `__mark--req` — дополнительные услуги.
- `.rent-pickup__grid`, `__item`, `__icon`, `__text` — условия самовывоза (карточки).
- `.rent-faq__list`, `__item`, `__q`, `__icon`, `__q-text`, `__a`, `__ol` — аккордеон FAQ.

**Особенности таблиц:**

- Первая колонка (`td:first-child`) — оранжевый текст (`var(--orange)`), weight 600.
- Заголовок таблицы (`thead th`) — фон `#fbe7cc`, тёмный текст.
- Плашка-заголовок блока (`.rent-specs__table-title`) — фон `var(--orange)`, белый текст.
- `table-layout: fixed`; распределение колонок 40/20/20/20.
- Чётные строки `tbody tr:nth-child(even)` — фон `#fdf8f1`.

**Особенности аккордеона:**

- Нативный `<details class="rent-faq__item">` + `<summary class="rent-faq__q">`.
- Убираем стандартный маркер: `list-style: none` на summary + `.rent-faq__q::marker { content: '' }` + `.rent-faq__q::-webkit-details-marker { display: none }`.
- Иконка «+/−» рисуется через `.rent-faq__icon` (круг с оранжевой рамкой, плюс из двух полосок). При `<details open>` вертикальная полоска (`::after`) сжимается в 0 → остаётся «−».
- Первый пункт `<details open>` — открыт по умолчанию.

**Условия самовывоза — карточки:**

- `.rent-pickup__item` — белая карточка с `border: 1px solid #eee; border-radius: 6px`, `padding: 28px 24px`, текст по центру.
- Визуально в одной системе с `.rent-faq__item`.
- Hover — лёгкая тень (`box-shadow: 0 4px 14px rgba(0,0,0,.04)`).

**Изображения на `/rent`:**

| Файл | Где | Как наполняется |
|---|---|---|
| `assets/images/rent-hero.jpg` | Hero, фон | Файлом (готово) |
| 3 SVG-иконки (инлайн) | «Условия самовывоза» | Вшиты в шаблон |

**3 SVG-иконки для «Условий самовывоза»** (вшиты в `page-rent.php` инлайн):

- Иконка 1 — viewBox `0 0 24 24`, «Group» (Stockholm-icons) — люди. Один path с `opacity="0.3"` (светлый силуэт) + один полный path. Цвет `rgb(242, 151, 71)`.
- Иконка 2 — viewBox `0 0 30 30`, машина с краном-стрелой. Много path. Оборачивать в `<g transform="scale(0.78) translate(4.2307..., 4.2307...)">`. Цвет `rgb(242, 151, 71)` через `fill` на корневом `<svg>`.
- Иконка 3 — viewBox `0 0 30 30`, фура с верхней загрузкой. Тот же трансформ. Цвет также через `fill` на корневом `<svg>`.

**Как чистить SVG с донора:** убрать `class`, `style`, `transform-origin`, скрытые `<rect>`-подложки (`fill: none`), `<title>`/`<desc>` можно оставить или убрать — не критично.

**Адаптив (см. `responsive.css`, блок `RENT PAGE — адаптив`):**

- `≤991px`: H2 26px, спецификация 1 колонка, доп. услуги 1 колонка, pickup 1 колонка (карточки компактнее — padding 22/20, gap 14).
- `≤767px`: H2 22px, шрифт таблиц 11.5px, FAQ-иконка 22px, отступы уменьшены.
- `≤480px`: H2 19px, таблицы 11px.

**Особенности:**

- Кнопка в hero — `js-open-callback` (глобальная модалка).
- CTA — общий `template-parts/cta-form.php` (не изобретать кастомный).
- Галереи на `/rent` нет — метабокс не подключаем, `ingi_gallery_enabled_slugs()` не расширяем.
- Хлебные крошки — **ниже hero**.

---

## 7. Что осталось

1. **Услуги — 3 из 6 осталось:**
   - ✅ Установка РСП (`/service`) — закрыта
   - ✅ Изготовление РСП (`/production`) — закрыта
   - ✅ Аренда РСП (`/rent`) — закрыта
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
28. **`page-{slug}.php` у страниц услуг — с `Template Name`.** Несмотря на то, что WP подхватывает файл по слагу автоматически, **обязательно** прописываем `Template Name: Услуга — <Название>` в шапке и **выбираем этот шаблон в админке** при создании страницы. Иначе в дропдауне будет `Default template`, и при пересохранении/клонировании страница может «потерять» шаблон и «задваиваться». У `/service` и `/production` — так же.
29. **Услуги на корневом уровне** (`/service`, `/production`, `/rent`, …), НЕ `/services/…`. CPT `service` зарегистрирован с `rewrite.slug = 'services'`, но мы этот URL не используем.
30. **Файловый фолбэк галереи — только через `file_exists()`.** Без проверки шаблон рендерит 28 битых `<img>` на несуществующие `gallery-N.jpg` → пустые квадраты в вёрстке. Лечение: `file_exists()` перед выводом + если ни одного файла нет — секцию не рендерить.
31. **CTA на страницах услуг — только `template-parts/cta-form.php`.** Не изобретать кастомный `.production-cta` с собственной формой — там не тот обработчик, форма не отправляется. Классы `.js-ingi-form`, `.js-ingi-form-msg`, `name="inn"` уже расшарены и завязаны на jQuery-обработчик в `main.js`.
32. **Flexbox и две картинки в ряд:** `img { min-width: auto }` по умолчанию не даёт сжиматься ниже натуральной ширины → вторая картинка переносится. Фикс: `img { min-width: 0 }` + `img:not(:only-child) { flex: 1 1 0 }`. В адаптиве — `max-width: calc(50% - Npx)`.
33. **`navigator.clipboard.writeText` в консоли не всегда срабатывает** (нет user-gesture, http, политика браузера). Резерв: `copy(JSON.stringify(window.__ingiImages, null, 2))` вручную, либо blob-скачивание в `~/Downloads`. На Kubuntu под Wayland — `wl-paste > file.json` (не `xclip`).
34. **`url.match(/\.(jpe?g|png|webp)/i)[1]` падает на URL без расширения.** Всегда безопасный `extFrom()` с проверкой на `null` и фолбэком `'jpg'`.
35. **Скачивание с донора без Referer даёт 403.** В `curl` обязателен `-e "https://ingigroup.ru/"` и User-Agent.
36. **Хлебные крошки на страницах услуг — НИЖЕ hero.** У `/service`, `/production`, `/rent` — так. Не путать с внутренними страницами (`/company`, `/contacts`), где крошки над H1.
37. **SVG-иконки для «Условий самовывоза» (`/rent`)** забираются через Copy element и **чистятся** перед вставкой в шаблон: убрать `class`, `style`, `transform-origin`, скрытую `<rect>`-подложку (`fill: none`). Цвет — `fill="rgb(242, 151, 71)"` на корневом `<svg>`.
38. **Аккордеон на `<details>/<summary>`:** убрать стандартный маркер (`list-style: none` + `::marker { content: '' }` + `::-webkit-details-marker { display: none }`). Иконку «+/−» рисовать через CSS `::before`/`::after`, а не вставлять `<span>`.
39. **При создании страницы-услуги — слаг строго латиницей, нижний регистр, без пробелов.** `rent`, `installation`, `development`, `felling`. Иначе WP-сгенерирует `аренда-рсп` и `page-rent.php` не подхватится.
40. **Если «задваивается» контент — сначала проверить `page-{slug}.php` на дублирование секций.** Лёгко случайно вставить hero дважды при копипасте.

---

## 10. Что дальше

Продолжаем «Услуги» в порядке:

1. ✅ Установка РСП (`/service`) — закрыта.
2. ✅ Изготовление РСП (`/production`) — закрыта.
3. ✅ Аренда РСП (`/rent`) — закрыта.
4. ⏳ Монтаж инженерных сетей (`/installation`) — `page-installation.php`.
5. ⏳ Разработка проектов (`/development`) — `page-development.php`.
6. ⏳ Вырубка растительности (`/felling`) — `page-felling.php`.

**Что нужно при старте каждой услуги:**
- Скрины донора (`ingigroup.ru/installation` и т.д.) — десктоп + мобилка.
- Прогнать консольный скрипт выгрузки картинок (§6.19) — `PAGE_PREFIX` менять под страницу.
- Скачать через `download.sh` → разложить по `assets/images/`.
- Создать страницу в админке: слаг (`installation`), **выбрать шаблон `Услуга — <Название>`**, Сохранить permalinks.
- Добавить слаг в `ingi_gallery_enabled_slugs()` (§6.17), если у услуги есть галерея.

**Общий каркас для услуг** (переиспользуем из `/service`, `/production`, `/rent`):

- `Template Name: Услуга — <Название>`
- `<section class="service-hero">` — своя картинка + свой заголовок + своя кнопка `.js-open-callback`. Подзаголовок опционально (у `/rent` его нет).
- Хлебные крошки **ниже hero**.
- Дальше секции с `.rent-page__section`-подобным каркасом (можно переименовывать под каждую страницу или обобщать).
- CTA — `template-parts/cta-form.php`.
- Карта — `locate_template('template-parts/map.php')`.

**Что проверить у каждой услуги:** своя структура блоков (аккордеон? таблицы? галерея? карточки?). Не копировать вслепую — оценивать по скринам донора.

---

## 11. Открытые вопросы

- **AJAX-форма:** end-to-end тест перенесён на боевой хостинг.
- **Услуги — специфика:** у каждой из 3 оставшихся услуг уточнять структуру (аккордеон? галерея? таблицы?).
- **Содержимое CPT `service`** — пока пуст, оставлен на будущее.
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — на тесте загружено; на бою загрузить заново.
- **Наполнение `certificate` / `opinion`** — работают файловые фолбэки.
- **Маркер Москвы на `/contacts`:** оставить синюю точку или переключить виджет на `?text={address}`.
- **Медиатека vs файлы:** галерея `/production` — через метабокс; фото спецификации — пока файлами. Решить: переводить ли спецификацию и вводные фото в медиатеку (расширить метабокс) или оставить файловый подход.
- **Чистка рудимента:** удалить неиспользуемые `.production-cta*` и `.rent-faq__badge` правила из `main.css`/`responsive.css`.
- **Унификация каркаса страниц услуг:** сейчас у каждой страницы свои префиксы классов (`production-*`, `rent-*`). Возможно, стоит вынести общий каркас (`.service-page__section`, `.service-page__h2`, `.service-page__lead`) и оставить только специифичные блоки. Отложено до 4-й услуги — на `/installation` посмотрим, окупается ли рефакторинг.

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
| Открыть модалку (консоль) | `window.ingiOpenCallback()` |
| Inspect сетки лайтбокса | `.certificates-grid`, `.opinions-scans-grid`, `.production-gallery__grid` |

**Скрипты наполнения (на Kubuntu):**

```bash
# 1) на доноре в консоли: прогнать скрипт (§6.19), PAGE_PREFIX = 'installation' / 'development' / 'felling'
# 2) забрать JSON
mkdir -p ~/ingigroup-download && cd ~/ingigroup-download
wl-paste > images.json        # Wayland
# xclip -selection clipboard -o > images.json   # X11
jq 'length' images.json       # проверить число картинок
# 3) скачать
./download.sh
# 4) разложить по assets/images/ темы
```
