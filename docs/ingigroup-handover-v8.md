# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v8
**Дата обновления:** 11 октября 2026 г.
**Статус:** главная закрыта, «Проекты» закрыты (30/30), «О компании» закрыта, «Сертификаты» закрыта, «Отзывы» закрыта, «Контакты» закрыта, модалка «Оставить заявку» закрыта, **«Установка РСП» (`/service`) закрыта**.
**В работе:** «Услуги» — осталось 5 страниц из 6.

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
inc/meta-boxes-opinion.php  — поля отзыва (автор, должность)
inc/ajax-form.php      — обработка формы

header.php             — шапка + бургер + мобильное меню
footer.php             — подвал + подключение модалки (template-parts/modal-callback.php)
front-page.php         — главная

page-company.php                    — /company
page-contacts.php                   — /contacts
page-service.php                    — /service («Установка РСП») — ЗАКРЫТА
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
  ├── modal-callback.php   — глобальная модалка «Оставить заявку»
  └── company/         — парты страницы «О компании» (см. §6.3)
      ├── director.php
      ├── stats.php
      ├── projects-preview.php
      ├── certs-preview.php
      └── opinions-preview.php

assets/css/
  ├── main.css         — всё (главная + проекты + услуги + контакты + отзывы + сертификаты + модалка)
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, AJAX-форма, карта, AOS, GSAP, лайтбокс, спойлеры, модалка
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg + opinion-1..opinion-9.jpg + service-rsr-hero.jpg
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

**Важно:** CPT `service` **не используется** для 6 основных услуг сайта. Он оставлен как задел на будущее (для «второстепенных» услуг с общим шаблоном). **6 основных услуг — это обычные `page` с `page-{slug}.php` шаблонами.**

**Важно про `certificate`:** поддерживает только `title`, `thumbnail`, `page-attributes` — **без `editor`**. В админке нет основного редактора, только заголовок и миниатюра.

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

Без изменений (см. v7 §6.10).

### 6.11. Страница «Контакты» (`/contacts`) — 100%

Без изменений (см. v7 §6.11).

### 6.12. Главное меню в шапке

Без изменений (см. v7 §6.12).

### 6.13. Модалка «Оставить заявку» — 100%

**Назначение:** глобальная модалка, открывается по клику на **любой** элемент с классом `.js-open-callback`. Работает на всех страницах.

**Файлы:**

| Файл | Что делает |
|---|---|
| `template-parts/modal-callback.php` | HTML модалки |
| `footer.php` | Строка `<?php get_template_part( 'template-parts/modal-callback' ); ?>` **перед** `wp_footer()` |
| `main.css` | Блок `MODAL CALLBACK` + `body.modal-open { overflow: hidden; }` |
| `responsive.css` | `@media (max-width: 480px)` — компактные размеры, top-align |
| `main.js` | IIFE `MODAL CALLBACK` — openModal/closeModal/фокус-трап/ESC/`window.ingiOpenCallback()` |
| `inc/ajax-form.php` | Обработчик (тот же, что у CTA-формы) |

**Ключевое соглашение:** модалка использует **те же классы**, что CTA-форма:
- `.js-ingi-form` — селектор формы, который слушает существующий jQuery-обработчик (`$(document).on('submit', '.js-ingi-form', …)`).
- `.js-ingi-form-msg` — контейнер для сообщений об успехе/ошибке.
- Поля: `name`, `phone`, `agree` + **скрытое** `inn` (`<input type="hidden" name="inn" value="">` — чтобы существующий обработчик, который обращается к `$form.find('[name="inn"]').val()`, не упал).

**Открытие:** добавить класс `.js-open-callback` на любую кнопку/ссылку:
```html
<button type="button" class="js-open-callback">Оставить заявку</button>
```

**JS API:** `window.ingiOpenCallback()` — открыть из консоли/другого скрипта.

**A11y:** `role="dialog"`, `aria-modal="true"`, `aria-hidden` переключается, фокус-трап на `Tab`/`Shift+Tab`, `Esc` закрывает, фокус возвращается на триггер.

**Публичный тест:** открывается в консоли `window.ingiOpenCallback()`. Форма отправляется через `admin-ajax.php` action=`ingi_send`. **End-to-end с приёмом письма — отложен до боевого хостинга.**

### 6.14. Страница «Установка РСП» (`/service`) — 100%

**Архитектурное решение:**

У донора **нет хаба `/services/`**. Каждая из 6 услуг — самостоятельный лендинг со своим дизайном и своим URL на **корневом уровне**. Поэтому:

| Услуга | URL | Шаблон |
|---|---|---|
| Установка РСП | `/service` | `page-service.php` ✅ |
| Изготовление РСП | `/production` | `page-production.php` (TODO) |
| Аренда РСП | `/rent` | `page-rent.php` (TODO) |
| Монтаж инженерных сетей | `/installation` | `page-installation.php` (TODO) |
| Разработка проектов | `/development` | `page-development.php` (TODO) |
| Вырубка растительности | `/felling` | `page-felling.php` (TODO) |

**Не CPT, а обычные страницы.** WP сам подхватит `page-{slug}.php` по слагу страницы. `Template Name` в шаблоне **не обязателен** — оставлен как подсказка, но в админке при создании страницы нужно выбирать **Default template**.

**Структура `page-service.php`:**

```
1. Хлебные крошки (template-parts/breadcrumbs.php) — ДО hero
2. Hero: фон-картинка на всю ширину + оверлей 45% + текст поверх слева
   (заголовок 56px, подзаголовок 20px, кнопка «Оставить заявку»)
3. H2 «Комплекс работ/услуг по установке рельсовых страховочных пакетов» + лид
4. Аккордеон .service-spoilers — 6 пунктов
   ├── Пункт 1 — раскрыт по умолчанию, 4 подпункта с иконками
   │     └── каждый подпункт может иметь вложенную плашку .spoiler--plaque
   ├── Пункт 2 — раскрывается, 2 подпункта + 1 плашка
   └── Пункты 3–6 — .spoiler--static, НЕ раскрываются, стрелки нет
5. Оранжевый блок .service-info — плашка с текстом слева + прозрачная кнопка с оранжевым бордером справа
6. CTA-форма (template-parts/cta-form.php)
7. Карта (locate_template guard)
```

**Кнопки «Оставить заявку»** — 2 штуки (в hero и в `.service-info`) — обе `.js-open-callback`, открывают модалку.

**Спойлеры (аккордеон) — кастомные, не `<details>`:**

```html
<div class="spoiler is-open">                     <!-- is-open = раскрыт -->
  <div class="spoiler__header">
    <span class="spoiler__toggle"><svg …/></span> <!-- стрелка -->
    <span>Заголовок</span>
  </div>
  <div class="spoiler__body">…</div>
</div>

<!-- Вложенная оранжевая плашка -->
<div class="spoiler spoiler--plaque">…</div>

<!-- Нераскрывающийся пункт -->
<div class="spoiler spoiler--static">
  <div class="spoiler__header">
    <span class="spoiler__toggle"></span>          <!-- пусто -->
    <span>Текст</span>
  </div>
</div>
```

**JS-обработчик спойлеров (в `main.js`):**

```js
document.addEventListener('click', function (e) {
    const header = e.target.closest('.spoiler__header');
    if (!header) return;
    const spoiler = header.closest('.spoiler');
    if (!spoiler) return;
    if (spoiler.classList.contains('spoiler--static')) return;
    e.preventDefault();
    spoiler.classList.toggle('is-open');
});
```

`closest` — для поддержки вложенных `.spoiler`.

**Подпункты `.service-sub`:** иконка folder-check (одна для всех) + заголовок + описание + опционально вложенная плашка `.spoiler--plaque`.

**Ключевые CSS-классы:**

- `.service-hero`, `__bg`, `__inner`, `__content`, `__title`, `__sub`, `__btn` — hero.
- `.service-page`, `__h2`, `__lead` — основной контент.
- `.spoiler`, `__header`, `__toggle`, `__body`, `.spoiler--plaque`, `.spoiler--static` — аккордеон.
- `.service-sub`, `__head`, `__icon`, `__title`, `__desc` — подпункт с иконкой.
- `.service-info`, `__inner`, `__text`, `__btn` — оранжевый блок.

**Кнопка в hero /service (десктоп):** `padding: 22px 58px`, `font-size: 19px`, `border: 5px solid var(--orange)`, прозрачный фон, белый текст; на hover — оранжевый фон.

**Кнопка в `.service-info` (десктоп):** `padding: 26px 60px`, `font-size: 20px`, `border: 5px solid var(--orange)`, прозрачный фон, **оранжевый текст**; на hover — оранжевый фон + белый текст.

**Оранжевый блок `.service-info`:** фон **только под текстом** (`.service-info__text` — `background: rgb(239, 126, 25)`, `max-width: 680px`, `padding: 32px 44px`, `font-size: 17px`). `.service-info` — без фона, `padding: 0 0 60px`, `margin-top: 0`.

### 6.15. Адаптив страницы «Услуги»

**`responsive.css` — блоки:**

- `SERVICE HERO — адаптив`:
  - `≤991px`: min-height 520, title 44, sub 18, btn `20px 50px` / 18px / border 5
  - `≤767px`: min-height 460, title 28, sub 15, btn `18px 40px` / 16px / border 4
  - `≤480px`: min-height 420, title 24, sub 14, btn `16px 32px` / 15px / border 4
- `SERVICE INFO — адаптив`:
  - `≤991px`: `.service-info__inner` → column, `.service-info__text` на всю ширину, кнопка на всю ширину
  - `≤767px`: уменьшенные размеры

---

## 7. Что осталось

1. **Услуги — 5 из 6 осталось:**
   - ✅ Установка РСП (`/service`) — закрыта
   - ⏳ **Изготовление РСП** (`/production`) — `page-production.php`
   - ⏳ **Аренда РСП** (`/rent`) — `page-rent.php`
   - ⏳ **Монтаж инженерных сетей** (`/installation`) — `page-installation.php`
   - ⏳ **Разработка проектов** (`/development`) — `page-development.php`
   - ⏳ **Вырубка растительности** (`/felling`) — `page-felling.php`
2. **Проверка AJAX-формы** end-to-end — отложена до боевого хостинга.
3. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
4. **Оптимизация:** preload шрифтов, lazy для карты, `defer` для `main.js`, перевод сертификатов/отзывов в медиатеку.
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
- Давать полный код файла, если правок много. **При правках `main.css`/`responsive.css`/`hotfix.css` — присылать весь файл целиком**, потому что легко наплодить дублей.
- Проверять `hotfix.css` при конфликтах — подключается последним.
- Точные пиксели подбирает пользователь.
- SVG забирать с донора через Copy element, не рисовать.
- Всё через `get_theme_mod()` с дефолтом во втором аргументе.
- При старте нового трека — начать с одной страницы, задать паттерн, потом переиспользовать.
- Не копировать донора буквально, если структура нашего сайта отличается — оценивать по цели страницы.
- Хендовер-файл присылать одним markdown-блоком **с четырьмя обратными кавычками** для внешней обёртки, иначе вложенные блоки ``` ломают разметку.

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
14. **Страница-двойник перебивает архив CPT / обычную страницу.** Если в админке есть `page` со слагом, совпадающим с rewrite.slug CPT (`certificates`, `opinions`, `services`, `projects`) или с корневым URL услуги (`service`, `production`, `rent`, …) — WP отдаёт старую страницу. **Лечение:** удалить страницу-двойник из админки + Сохранить permalinks.
15. **Rewrite-приоритет покрывает все 4 архива CPT.** При добавлении нового CPT — дописать правила в `$prefix` в `inc/cpt.php`.
16. **Лайтбокс ищет сетки по `GRID_SELECTORS` в `main.js`.** Новую сетку с лайтбоксом — добавить в массив (сейчас: `.certificates-grid`, `.opinions-scans-grid`). Класс карточек — `.certificate-card`.
17. **`archive-opinion.php` использует флаги `$has_posts` / `$has_scans`.** Если CPT пуст, но файлы есть — H2 «Оригиналы отзывов» не выводится.
18. **Файловые фолбэки регистрозависимы.** `opinion-1.jpg` подхватится, `Opinion-1.JPG` — нет. Проверить на боевом (Linux).
19. **Яндекс-виджет (iframe) на `/contacts`:** координаты в URL — **`lon,lat`** (долгота сначала). Родное `aspect-ratio` — **16:10**. Маркер захардкодить нельзя.
20. **`.cta-form` — общий парт.** Не удалять у него `padding-bottom` глобально. Убирать только через scoped-селектор.
21. **Customizer `inc/customizer.php` — одна плоская секция `ingi_contacts`.** Не смешивать контакты с другими полями.
22. **Удалил страницу-двойник → пункт меню стал «Некорректным» → пропал с фронта.** Лечение: удалить битый пункт из меню, завести заново как **Произвольную ссылку**. Профилактика: пункты меню, ведущие в CPT-архивы (`/services/`, `/certificates/`, `/opinions/`), сразу заводить как «Произвольные ссылки».
23. **НЕ вкладывать CSS-правила друг в друга.** В `main.css` был баг: `.spoiler--static` был вложен внутрь `.service-sub__desc { … }` (SCSS-синтаксис). Браузер выбросил вложенный блок, `.spoiler--static` не работал. **Все правила — плоско.**
24. **Не плодить дубли блоков в `main.css`.** При правке `SERVICE HERO` остался **старый** блок в середине файла + **новый** в конце. Старый `display: grid` перебивал новый `display: flex`. **Симптом:** hero вёл себя не по правилам нового блока. **Лечение:** удалить старый блок.
25. **При правках `main.css`/`responsive.css`/`hotfix.css` — присылать файл целиком.** Легко наплодить дублей и вложенных правил.
26. **Модалка использует те же классы, что CTA-форма.** Если менять `.js-ingi-form` или `.js-ingi-form-msg` в CTA — надо менять и в модалке (или наоборот). Существующий jQuery-обработчик `$(document).on('submit', '.js-ingi-form', …)` — общий.
27. **В модалке должен быть `<input type="hidden" name="inn" value="">`.** Существующий AJAX-обработчик обращается к `$form.find('[name="inn"]').val()` — если поля нет, вернёт `undefined`, но лучше подстраховаться пустым hidden.
28. **`page-service.php` в админке — «Default template».** Не выбирать `Template Name: Услуга — Установка РСП` — WP сам подхватит `page-service.php` по слагу `service`.
29. **Услуги на корневом уровне** (`/service`, `/production`, …), НЕ `/services/…`. CPT `service` зарегистрирован с `rewrite.slug = 'services'`, но мы этот URL не используем.

---

## 10. Что дальше

Продолжаем «Услуги» в порядке:

1. ✅ **Установка РСП** (`/service`) — закрыта.
2. ⏳ **Изготовление РСП** (`/production`) — `page-production.php`.
3. ⏳ **Аренда РСП** (`/rent`) — `page-rent.php`.
4. ⏳ **Монтаж инженерных сетей** (`/installation`) — `page-installation.php`.
5. ⏳ **Разработка проектов** (`/development`) — `page-development.php`.
6. ⏳ **Вырубка растительности** (`/felling`) — `page-felling.php`.

**Что нужно при старте каждой услуги:** скрины донора (`ingigroup.ru/production` и т.д.) — десктоп + мобилка, если вёрстка отличается. Паттерн отработан на `/service`: hero + блоки + аккордеон + оранжевый блок + CTA + карта.

**Что нужно обязательно проверить:** у каждой услуги свой hero (своя картинка + свой заголовок), свои блоки (могут отличаться), но общий каркас из `page-service.php` переиспользуется.

---

## 11. Открытые вопросы

- **AJAX-форма:** end-to-end тест перенесён на боевой хостинг.
- **Услуги — специфика:** у каждой из 5 оставшихся услуг уточнять структуру (аккордеон? галерея? цены?).
- **Содержимое CPT `service`** — пока пуст, оставлен на будущее.
- **SEO-плагин** (Yoast/RankMath) или кастомные поля в Customizer?
- **Фото директора** — на тесте загружено; на бою загрузить заново.
- **Наполнение `certificate` / `opinion`** — работают файловые фолбэки.
- **Маркер Москвы на `/contacts`:** оставить синюю точку или переключить виджет на `?text={address}`.

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
| **Страница «Установка РСП»** | **https://ingigroup.xyz/service/** |
| Открыть модалку (консоль) | `window.ingiOpenCallback()` |
| Inspect сетки лайтбокса | `.certificates-grid`, `.opinions-scans-grid` |
