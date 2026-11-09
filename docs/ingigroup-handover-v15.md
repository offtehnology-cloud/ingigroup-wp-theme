# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v15
**Дата обновления:** 8 ноября 2026 г.
**Статус:** разработка закрыта, перенос на боевой выполнен. Сайт работает на `ingigroup.ru`, префикс БД `wp_58GuD_`. Все 6 услуг, проекты, сертификаты, отзывы, контакты, политика — 100%. Активный трек: SEO-контент → оптимизация.

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

- **Боевой:** https://ingigroup.ru/ (с 8 ноября 2026)
- Донор: https://ingigroup.ru/ (тот же домен — тема копирует структуру)
- Тест: https://ingigroup.xyz/ (архивный, больше не используется)
- GitHub: https://github.com/offtehnology-cloud/ingigroup-wp-theme
- **SSH:** `u3680961@server111`, папка `/var/www/u3680961/data/ingigroup.ru`
- Локальная тема: `wp-content/themes/ingigroup/`
- Админка: https://ingigroup.ru/wp-admin/ (логин `wpadmin`)
- Проекты в админке: https://ingigroup.ru/wp-admin/edit.php?post_type=project
- Категории проектов: https://ingigroup.ru/wp-admin/edit-tags.php?taxonomy=project_category&post_type=project
- Сертификаты: https://ingigroup.ru/wp-admin/edit.php?post_type=certificate
- Отзывы: https://ingigroup.ru/wp-admin/edit.php?post_type=opinion
- Постоянные ссылки: https://ingigroup.ru/wp-admin/options-permalink.php
- Меню: https://ingigroup.ru/wp-admin/nav-menus.php
- Настройки «Контакты» (email формы): Внешний вид → Настроить → ИНЖИГРУПП — Контакты → поле `ingi_email`
- Яндекс.Вебмастер: подтверждён, sitemap отправлен
- Яндекс.Метрика: счётчик установлен и работает
- **Google Analytics — НЕ используется** (решение заказчика, см. §9.61)

---

## 3. Стек

- WordPress, кастомная тема `ingigroup`
- Шрифт: Inter (Google Fonts), 100–900
- Анимации: AOS + GSAP + ScrollTrigger
- Карта: Яндекс.Карты API (главная, «О компании») + iframe map-widget (`/contacts`)
- Форма: AJAX через `admin-ajax.php` — action `ingi_send`
- Модалка «Оставить заявку» — глобальный компонент
- Почта: `wp_mail()` → SMTP (настроен на хостинге, письма уходят на `info@ingigroup.ru`)

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
inc/ajax-form.php      — обработка формы (ключ почты: ingi_email, строка 19)

header.php             — шапка + бургер + мобильное меню
footer.php             — подвал + подключение модалки (template-parts/modal-callback.php)
front-page.php         — главная

page-company.php                    — /company
page-contacts.php                   — /contacts
page-service.php                    — /service («Установка РСП»)
page-production.php                 — /production («Изготовление РСП»)
page-rent.php                       — /rent («Аренда РСП»)
page-installation.php               — /installation («Монтаж инженерных сетей»)
page-development.php                — /development («Разработка проектов ППР»)
page-felling.php                    — /felling («Вырубка растительности»)
page-privacy.php                    — /privacy («Политика конфиденциальности»)
archive-project.php                 — хаб /projects/
single-project.php                  — детальная /project/<slug>/
taxonomy-project_category.php       — /projects/<term>/
archive-certificate.php             — /certificates/ (сетка сканов + лайтбокс)
archive-opinion.php                 — /opinions/ (карточки + сетка сканов + лайтбокс)
single-opinion.php                  — /opinions/<slug>/ → 301 редирект на архив
404.php                             — кастомная 404

template-parts/
  ├── hero.php
  ├── services.php
  ├── advantages.php   — 7 SVG-иконок
  ├── certificates.php
  ├── opinions.php
  ├── cta-form.php     — общий CTA-парт
  ├── map.php
  ├── breadcrumbs.php
  ├── project-card.php
  ├── modal-callback.php   — глобальная модалка «Оставить заявку»
  └── company/         — парты страницы «О компании»
      ├── director.php
      ├── stats.php
      ├── projects-preview.php
      ├── certs-preview.php
      └── opinions-preview.php

assets/css/
  ├── main.css         — всё
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, AJAX-форма, карта, AOS, GSAP, лайтбокс, спойлеры, модалка
assets/images/         — картинки + logo-horizontal.png + director.jpg + cert-1..cert-10.jpg + opinion-1..opinion-9.jpg
                       + service-rsr-hero.jpg + production-hero.jpg + production-1.jpg + production-2.jpg
                       + production-spec-*.jpg + rent-hero.jpg
                       + development-intro.jpg
                       + felling-hero.jpg + felling-intro.jpg + felling-services.jpg + felling-gallery-1..8.jpg
assets/images/production/   — gallery-N.jpg (файловый фолбэк для /production)
```

**Удалены:**
- Все `inc/import-projects*.php` (batch1–batch7).
- `single-service-ustanovka-rsr.php`.

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

Иконки / SVG-акценты: `rgb(242, 151, 71)`.

### Шрифты

- Inter (100–900)
- Заголовки секций: 51px, weight 700, uppercase
- Заголовки внутренних страниц: 32px, weight 700, uppercase
- H2 на `/production`, `/rent`, `/installation`, `/development`: 32px, weight 700, не uppercase; на `/felling` — 32px weight 600
- Hero услуг: 56px, подзаголовок 20–29px, кнопка 19px + border 5px
- Основной текст: 16px, line-height 1.43
- Телефон: 26px, weight 700
- «Политика конфиденциальности»: H1 46px/600, H2 16px/700, параграфы 16px/1.6

### База данных (v15)

- **Префикс таблиц: `wp_58GuD_`** — задан в `wp-config.php`: `$table_prefix = 'wp_58GuD_';`
- Старые таблицы `wp_*` удалены после стабилизации (см. §13).
- В примерах ниже используется `wp_` для краткости — при выполнении заменять на `wp_58GuD_`.
- Пользователь-администратор: `wpadmin` (ID 1).
- Почта формы: `wp theme mod get ingi_email` → `info@ingigroup.ru`.
- `admin_email`: см. `wp option get admin_email`.

### CPT и таксономии (из `inc/cpt.php`)

| CPT | rewrite.slug | has_archive | Архив URL | supports |
|-----|--------------|-------------|-----------|----------|
| `service` | `services` | `true` | `/services/` (не используем) | title, editor, thumbnail, excerpt, page-attributes |
| `project` | `project` | `projects` | `/projects/` | title, editor, thumbnail, excerpt, page-attributes |
| `opinion` | `opinions` | `true` | `/opinions/` | title, editor, thumbnail |
| `certificate` | `certificates` | `true` | `/certificates/` | title, thumbnail, page-attributes |

Таксономия `project_category`:
- `rewrite.slug => 'projects'` → `/projects/<term>/`
- `hierarchical => true`, `show_admin_column => true`

**Важно:** CPT `service` для 6 основных услуг НЕ используется — это обычные `page` с шаблонами `page-{slug}.php` и `Template Name`.

**`certificate` без `editor`** — только `title`, `thumbnail`, `page-attributes`.

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

### 6.1. Главная — 100%
Десктоп и мобилка — как в v7. Без изменений.

### 6.2. Раздел «Проекты» — 100%
30 проектов импортированы, счётчики 11/8/11, импортёры удалены.

### 6.3. Страница «О компании» (`/company`) — 100%
Парты в `template-parts/company/`. Без изменений с v7.

### 6.4. Хлебные крошки — универсальные
Первая метка — «Главная». На страницах услуг — **НИЖЕ hero**. Вторая метка = `get_the_title()` страницы.

### 6.5. Customizer — настройки
Секция `ingi_contacts`, ~20 полей. Ключевое: `ingi_email` (почта формы, дефолт `info@ingigroup.ru`).

### 6.6. Фикс мобильной панели адреса на карте
В `hotfix.css`.

### 6.7. Инфраструктура
`inc/enqueue.php` — версии через `filemtime`.

### 6.8. Страница «Сертификаты» (`/certificates`) — 100%
Сетка сканов + лайтбокс.

### 6.9. Страница «Отзывы» (`/opinions`) — 100%
Карточки + сетка сканов. Флаги `$has_posts` / `$has_scans` в `archive-opinion.php`.

### 6.10. Лайтбокс (`main.js`) — универсальный
`GRID_SELECTORS`:
```
.certificates-grid
.opinions-scans-grid
.production-gallery__grid
.felling-gallery__grid
```
Класс карточек — `.certificate-card`.

### 6.11. Страница «Контакты» (`/contacts`) — 100%
Iframe Яндекс.Карт, координаты в URL — `lon,lat`.

### 6.12. Главное меню в шапке
См. v7.

### 6.13. Модалка «Оставить заявку» — 100% (переработана в v13)
Классы `.modal-callback*` (не `.ingi-modal*`). JS: `window.ingiOpenCallback()`, `getElementById('modal-callback')`, `[data-modal-close]`, чекбокс `name="agree"`. Ссылка на политику через `home_url('/privacy/')`.

### 6.14. Страница «Установка РСП» (`/service`) — 100%
См. v8.

### 6.15. Адаптив `/service` — 100%
См. v8.

### 6.16. Страница «Изготовление РСП» (`/production`) — 100%
См. v9.

### 6.17. Метабокс «Галерея изображений» — 100%
Ключ `_ingi_gallery`. Слаги с галереей: `ingi_gallery_enabled_slugs()` → `production`, `felling`.

### 6.18. Адаптив `/production` — 100%
См. v9.

### 6.19. Скрипт выгрузки изображений с донора — 100%
См. v9.

### 6.20. Страница «Аренда РСП» (`/rent`) — 100%
См. v10.

### 6.21. Страница «Монтаж инженерных сетей» (`/installation`) — 100%
См. v11.

### 6.22. Синтаксис вызова карты (актуальный паттерн)

```php
<?php
if ( locate_template( 'template-parts/map.php' ) ) {
    get_template_part( 'template-parts/map' );
}
?>
```

Многострочно, без `.php`. Используется на `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`, `/contacts`. В `template-parts/map.php` есть page-check (whitelist слагов).

### 6.23. Страница «Разработка проектов ППР» (`/development`) — 100%
См. v14 §6.23. Ключевые классы: `.development-hero`, `.development-page`, `.development-intro__grid`, `.development-spoiler`, `.development-order__btn`. Фон hero — `rent-hero.jpg`.

### 6.24. Страница «Вырубка растительности» (`/felling`) — 100%
См. v14 §6.24. Hero — `felling-hero.jpg`, intro — `felling-intro.jpg`, services — `felling-services.jpg`, галерея 4×2 (метабокс + файловый фолбэк `felling-gallery-1..8.jpg`).

### 6.25. Мобильный hero: переносы
Убрать `word-break` / `overflow-wrap: anywhere` на мобилке. Скрыть `<br>` в hero на мобилке. **Пробел — ПЕРЕД `<br>` в HTML.** Ступенчатое уменьшение размера: 56 → 40 (≤991) → 30 (≤767) → 24 (≤480).

### 6.26. Модификатор hero для конкретной услуги
Скоуп через дополнительный класс: `class="service-hero development-hero"`. Если фон тайлится — `.xxx-hero .service-hero__bg { background-size: cover; background-position: center center; background-repeat: no-repeat; }`.

### 6.27. Секция «Преимущества» — паттерн 6-колоночной сетки
```css
.xxx-advantages__grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 30px;
}
.xxx-advantages__item { grid-column: span 2; }
.xxx-advantages__item:nth-child(4) { grid-column: 2 / 4; }
.xxx-advantages__item:nth-child(5) { grid-column: 4 / 6; }
```
На ≤991px — 2 колонки + сброс сдвига. На ≤767px — 1 колонка.

### 6.28. Страница «Политика конфиденциальности» (`/privacy`) — 100%
См. v14 §6.28. Ссылки на `https://ingigroup.ru/` внутри текста оставлены абсолютными (по требованию «сохранить как в оригинале»). Ссылка в модалке — `home_url('/privacy/')`.

### 6.29. Модалка «Оставить заявку» — переработана (v13)
Классы `.modal-callback*`. Разметка, JS, проверка согласия, ссылка на политику — см. v14 §6.29.

### 6.30. Перенос на боевой — фактические шаги (v15)

Боевой хостинг: `server111`, `/var/www/u3680961/data/ingigroup.ru`, SSH `u3680961@server111`.

Порядок, которым перенос был выполнен:

1. **Бэкап БД и `wp-config.php`** (обязательно, до всего остального).
   ```bash
   mysqldump -u <user> -p <db> > ~/backup_before_prefix_switch.sql
   cp wp-config.php ~/wp-config.php.backup
   ```
2. **Импорт дампа с теста.** Таблицы получили префикс `wp_58GuD_` (из-за уже существовавших `wp_*`).
3. **Смена `$table_prefix`** в `wp-config.php` на `'wp_58GuD_'`.
4. **UPDATE по `option_name` и `meta_key`** — критично, см. §9.56.
   ```sql
   UPDATE wp_58GuD_options SET option_name = REPLACE(option_name, 'wp_', 'wp_58GuD_') WHERE option_name LIKE 'wp\_%' ESCAPE '\\' AND option_name NOT LIKE 'wp\_58GuD\_%' ESCAPE '\\';
   UPDATE wp_58GuD_usermeta SET meta_key = REPLACE(meta_key, 'wp_', 'wp_58GuD_') WHERE meta_key LIKE 'wp\_%' ESCAPE '\\' AND meta_key NOT LIKE 'wp\_58GuD\_%' ESCAPE '\\';
   ```
5. **Починка ролей**, если после п. 4 админ потерял доступ:
   ```bash
   wp role reset --all
   wp user add-role wpadmin administrator
   wp user update wpadmin --user_pass='<новый пароль>'
   ```
6. **Восстановление медиатеки** (файлы были на диске, записей в БД не было):
   ```bash
   find wp-content/uploads -type f \( -iname '*.jpg' -o -iname '*.jpeg' -o -iname '*.png' -o -iname '*.webp' -o -iname '*.gif' \) -print0 | xargs -0 wp media import --skip-copy --porcelain
   wp media regenerate --only-missing --yes
   ```
7. **Удаление старых таблиц `wp_*`** (через 24–48 ч после стабилизации).
8. **Кэш:** `wp cache flush` + purge хостинга + Ctrl+Shift+R.
9. **`robots.txt` / `sitemap.xml`** — проверка `curl` (см. §9.60).
10. **Яндекс.Вебмастер + Метрика** — добавлены, работают.
11. **Форма** — smoke-тест end-to-end (модалка + CTA), письма уходят.

### 6.31. Иконка сайта — 100% (v15)

Настраивается через **Внешний вид → Настроить → Свойства сайта**. Требуется PNG 512×512 минимум. WordPress сам генерирует все размеры (32, 180, 192, 270).

**Перед настройкой** — проверить `header.php` на зашитый `<link rel="icon">`:
```bash
grep -n "rel=\"icon\"\|rel=\"shortcut icon\"\|favicon" wp-content/themes/ingigroup/header.php
```
Если есть — закомментировать/удалить, иначе Customizer не сработает.

Проверка после настройки:
```bash
wp option get site_icon
curl -s https://ingigroup.ru/ | grep -o 'rel="icon"[^>]*'
```

### 6.32. Форма — почта получателя (v15)

`inc/ajax-form.php:19`:
```php
$to = get_theme_mod( 'ingi_email', 'info@ingigroup.ru' );
```

Смена адреса (без правки файлов):
```bash
wp theme mod set ingi_email "<адрес>"
wp theme mod get ingi_email
```
Или через Customizer → ИНЖИГРУПП — Контакты.

Если `ingi_email` пуст — используется дефолт `info@ingigroup.ru`.

---

## 7. Что осталось

Разработка, перенос, базовая SEO-инфраструктура — закрыты. Дальнейшие треки — см. §10.

**Не срочно, но полезно:**
1. Опционально: донорские SVG вместо заглушек в «Преимуществах» на `/felling`.
2. Опционально: чистка мёртвых селекторов в `main.css` — `.ingi-form__*`, `.production-cta*`, `.rent-faq__badge`.
3. Опционально: перевод галерей `/production` и `/felling` в медиатеку (сейчас файловый фолбэк).

---

## 8. Как мы работаем

### Процесс
1. Пользователь присылает 2 скрина: оригинал (донор) + тест секции.
2. Ассистент даёт правки — код целиком или конкретные правила.
3. Пользователь применяет, Ctrl+Shift+R, проверяет.
4. Точные размеры — через DevTools (F12 → Computed) на оригинале.
5. При конфликтах — скриншот из DevTools + код элемента.

### Правила
- Давать полный код файла, если правок много. При правках `main.css`/`responsive.css`/`hotfix.css` — присылать **весь файл целиком**.
- Проверять `hotfix.css` при конфликтах — подключается последним.
- SVG забирать с донора через Copy element, не рисовать.
- Всё через `get_theme_mod()` с дефолтом во втором аргументе.
- При старте нового трека — начать с одной страницы, задать паттерн, потом переиспользовать.
- **Хендовер-файл присылать одним markdown-блоком с четырьмя обратными кавычками** для внешней обёртки.
- **Перед любыми изменениями в БД — бэкап.** После операций с префиксом — проверять `wp user list` и вход в `/wp-admin/`.

---

## 9. Известные грабли

1. **Кэш:** Ctrl+Shift+R + `filemtime` в `enqueue.php`.
2. **`hotfix.css` перебивает `main.css`** — проверять первым.
3. **Версии в `inc/enqueue.php`** — если правки не видны, проверь первым.
4. **SVG Creatium подгружаются JS** — брать через Copy element.
5. **Мобильный бургер** — правки в трёх местах: `header.php` + `main.css` + `main.js`.
6. **`data-aos` на мобилке отключать** — `[data-aos] { opacity: 1 !important; }`.
7. **Отрицательные margin** для растягивания блоков на мобилке.
8. **`get_theme_mod` всегда со вторым аргументом-дефолтом.**
9. **Permalinks:** после любых изменений в CPT/таксономии/rewrite — Сохранить permalinks.
10. **Слаги CPT vs taxonomy должны различаться** (`project` vs `projects`).
11. **`var(--grey-333)`** использовать с фолбэком: `var(--grey-333, #333)`.
12. **`locate_template('template-parts/map.php')`** — если файла нет, секция молча пропускается. Актуальный синтаксис — §6.22.
13. **`certificate` CPT — без `editor`.**
14. **Страница-двойник перебивает архив CPT / обычную страницу.** Лечение: удалить страницу-двойник + Сохранить permalinks.
15. **Rewrite-приоритет покрывает все 4 архива CPT.** При добавлении нового CPT — дописать правила в `$prefix`.
16. **Лайтбокс ищет сетки по `GRID_SELECTORS`.** Класс карточек — `.certificate-card`.
17. **`archive-opinion.php` использует флаги `$has_posts` / `$has_scans`.**
18. **Файловые фолбэки регистрозависимы.**
19. **Яндекс-виджет (iframe) на `/contacts`:** координаты в URL — `lon,lat`.
20. **`.cta-form` — общий парт.** Не удалять `padding-bottom` глобально.
21. **Customizer `inc/customizer.php` — одна плоская секция `ingi_contacts`.**
22. **Удалил страницу-двойник → пункт меню «Некорректный» → пропал с фронта.**
23. **НЕ вкладывать CSS-правила друг в друга.**
24. **Не плодить дубли блоков в `main.css`.**
25. **При правках `main.css`/`responsive.css`/`hotfix.css` — присылать файл целиком.**
26. **Модалка использует те же классы, что CTA-форма** (`.js-ingi-form`, `.js-ingi-form-msg`).
27. **В модалке должен быть `<input type="hidden" name="inn" value="">`.**
28. **`page-{slug}.php` у услуг — с `Template Name`.**
29. **Услуги на корневом уровне**, не `/services/…`.
30. **Файловый фолбэк галереи — только через `file_exists()`.**
31. **CTA на страницах услуг — только `template-parts/cta-form.php`.**
32. **Flexbox и две картинки в ряд:** `img { min-width: 0 }` + `img:not(:only-child) { flex: 1 1 0 }`.
33. **`navigator.clipboard.writeText` в консоли не всегда срабатывает.**
34. **`url.match(/\.(jpe?g|png|webp)/i)[1]` падает на URL без расширения.**
35. **Скачивание с донора без Referer даёт 403.**
36. **Хлебные крошки на страницах услуг — НИЖЕ hero.**
37. **SVG-иконки с донора чистятся перед вставкой в шаблон.**
38. **Аккордеон на `<details>/<summary>`:** убрать стандартный маркер, иконку «+/−» через CSS.
39. **Слаг страницы-услуги — латиница, нижний регистр, без пробелов.**
40. **Задваивается контент — проверять `page-{slug}.php` на дублирование секций.**
41. **Не доверять первому впечатлению от верхнего края скрина донора.**
42. **Hero-заголовок разной длины ломает общий `.service-hero`.** Лечение: scoped-модификатор.
43. **Имена файлов-транслитом** — рабочие, но лучше договариваться о читаемых.
44. **Вторая метка хлебных крошек = заголовок страницы в админке.**
45. **Паттерн вызова карты — многострочный** (§6.22).
46. **`template-parts/map.php` содержит page-check** (whitelist слагов).
47. **Длинные транслитерированные имена файлов** — рабочие, но неудобны.
48. **Мобилка: `word-break`/`overflow-wrap: anywhere` рвут слова по буквам.** Скрывать `<br>`, пробел ПЕРЕД `<br>` (§6.25).
49. **Фон hero может тайлиться без `background-size: cover` / `background-repeat: no-repeat`** (§6.26).
50. **SVG-заглушки использовать со `stroke="currentColor"`.**
51. **Секция «Преимущества» 3+2** — 6-колоночная сетка + `nth-child(4/5)` (§6.27).
52. **Классы модалки — `.modal-callback*`, НЕ `.ingi-modal*`.**
53. **Чекбокс согласия `name="agree"`** — ищется в `main.js`.
54. **Ссылки на внутренние страницы — через `home_url()`.**
55. **После смены классов — чистить CSS от мёртвых селекторов.**
56. **При смене префикса БД — ОБЯЗАТЕЛЬНО переименовать `option_name` в `options` и `meta_key` в `usermeta` (`capabilities`, `user_level`).** Иначе админ теряет доступ, пользователи — роли. Лечение: `wp role reset --all` + `wp user add-role <логин> administrator` + сброс пароля. Проверка: `wp user list --fields=ID,user_login,roles`.
57. **Пакет `frozzare/wp-cli-media-restore` НЕ работает с текущим WP-CLI** — падает на `Undefined constant "CONTENT_DIR"` (`class-media-restore-command.php:99`). Для восстановления «осиротевших» файлов:
    ```bash
    find wp-content/uploads -type f \( -iname '*.jpg' -o -iname '*.jpeg' -o -iname '*.png' -o -iname '*.webp' -o -iname '*.gif' \) -print0 | xargs -0 wp media import --skip-copy --porcelain
    wp media regenerate --only-missing --yes
    ```
    Флаг `--skip-copy` критичен: создаёт запись в БД, не копируя файл.
58. **`wp media import` создаёт ДУБЛИ** для уже загруженных вручную файлов. Проверка:
    ```bash
    wp db query "SELECT guid, COUNT(*) c FROM wp_58GuD_posts WHERE post_type='attachment' GROUP BY guid HAVING c > 1;"
    ```
59. **Стандартная иконка WordPress перебивает Customizer**, если в `header.php` зашит `<link rel="icon">` или `<link rel="shortcut icon">`. Проверять grep'ом.
60. **При добавлении в поисковики — проверить `sitemap.xml` на остатки тестового домена:**
    ```bash
    curl -s https://ingigroup.ru/sitemap.xml | grep -o 'https://[^<]*' | head -20
    ```
    Также `curl -s https://ingigroup.ru/robots.txt | grep -i "disallow: /$"` — не должно быть пусто.
61. **Google Analytics в проект НЕ входит** (решение заказчика). События форм отслеживаются только через Яндекс.Метрику.
62. **Плагин безопасности может резать `admin-ajax.php` action `ingi_send`.** Симптом: `wp_mail` возвращает `true`, а форма «молчит». Смотреть логи и whitelist плагина.

---

## 10. Что дальше

Приоритетные треки (в порядке):

1. **SEO-контент:**
   - Плагин Yoast или RankMath.
   - Title / description / OG для всех страниц (`/`, `/service`, `/production`, `/rent`, `/installation`, `/development`, `/felling`, `/company`, `/contacts`, `/projects/`, `/certificates/`, `/opinions/`, `/privacy`).
   - Шаблоны title/description для проектов и отзывов.
   - Canonical, если нужно.
   - Проверка переиндексации в Яндекс.Вебмастере.

2. **Оптимизация скорости:**
   - `<link rel="preload">` для Inter (woff2) в `header.php`.
   - `defer` для `main.js` в `inc/enqueue.php`.
   - Lazy-загрузка Яндекс.Карт.
   - Прогон PageSpeed Insights.

3. **Опционально (не срочно):**
   - Донорские SVG на `/felling`.
   - Чистка мёртвых селекторов в `main.css`.
   - Перевод галерей в медиатеку.

---

## 11. Открытые вопросы

- **SEO-плагин:** Yoast или RankMath? (Решение влияет на структуру шаблонов title/description.)
- **Содержимое CPT `service`** — пуст, оставлен на будущее.
- **Наполнение `certificate` / `opinion`** — работают файловые фолбэки; по мере наполнения — перевести в медиатеку.
- **Маркер Москвы на `/contacts`** — оставить синюю точку или переключить на `?text={address}`.
- **Иконки преимуществ на `/felling`** — оставить SVG-заглушки или заменить на донорские.
- **Ссылки на `https://ingigroup.ru/` в `/privacy`** — оставлены абсолютными (решение принято, при будущих правках политики — не переписывать).
- **Медиатека vs файловый фолбэк** — работает гибрид; при наполнении через админку фолбэк перестаёт срабатывать автоматически.

---

## 12. Ключевые URL / команды

| Действие | URL / команда |
|---|---|
| Боевой сайт | https://ingigroup.ru/ |
| Админка | https://ingigroup.ru/wp-admin/ |
| Сброс permalinks | `wp rewrite flush` (или Настройки → Постоянные ссылки → Сохранить) |
| Список пользователей и ролей | `wp user list --fields=ID,user_login,user_email,roles` |
| Сброс ролей + выдать админа | `wp role reset --all` + `wp user add-role <логин> administrator` |
| Смена пароля | `wp user update <логин> --user_pass='<пароль>'` |
| Почта формы (просмотр) | `wp theme mod get ingi_email` |
| Почта формы (смена) | `wp theme mod set ingi_email "<адрес>"` |
| Проверка SMTP | `wp eval 'var_dump( wp_mail( "<адрес>", "Тест", "Проверка" ) );'` |
| Восстановить медиатеку | см. §9.57 |
| Пересоздать миниатюры | `wp media regenerate --only-missing --yes` |
| Поиск дублей вложений | см. §9.58 |
| Сброс кэша | `wp cache flush` + purge хостинга |
| Проверка `siteurl`/`home` | `wp option get siteurl` / `wp option get home` |
| Проверка `blog_public` | `wp option get blog_public` (должен быть `1`) |
| Проверка `robots.txt` | `curl -s https://ingigroup.ru/robots.txt` |
| Проверка `sitemap.xml` | `curl -s https://ingigroup.ru/sitemap.xml \| grep -o 'https://[^<]*'` |
| Список проектов | https://ingigroup.ru/wp-admin/edit.php?post_type=project |
| Список сертификатов | https://ingigroup.ru/wp-admin/edit.php?post_type=certificate |
| Список отзывов | https://ingigroup.ru/wp-admin/edit.php?post_type=opinion |
| Список страниц | https://ingigroup.ru/wp-admin/edit.php?post_type=page |
| Меню | https://ingigroup.ru/wp-admin/nav-menus.php |
| Настройки контактов | Внешний вид → Настроить → ИНЖИГРУПП — Контакты |
| Страница «Установка РСП» | https://ingigroup.ru/service/ |
| Страница «Изготовление РСП» | https://ingigroup.ru/production/ |
| Страница «Аренда РСП» | https://ingigroup.ru/rent/ |
| Страница «Монтаж инженерных сетей» | https://ingigroup.ru/installation/ |
| Страница «Разработка ППР» | https://ingigroup.ru/development/ |
| Страница «Вырубка растительности» | https://ingigroup.ru/felling/ |
| Страница «Политика конфиденциальности» | https://ingigroup.ru/privacy/ |
| Открыть модалку (консоль) | `window.ingiOpenCallback()` |

**Скрипты наполнения (на Kubuntu):** см. §6.19.

---

## 13. Перенос на боевой — ВЫПОЛНЕНО 8 ноября 2026

**Статус:** перенос завершён, сайт работает на `ingigroup.ru` с префиксом `wp_58GuD_`.

Оставить как референс для будущих миграций и откатов.

**Итоги переноса:**
- Бэкап старого сайта — сделан.
- Префикс БД — `wp_58GuD_`, старые таблицы `wp_*` удалены.
- Медиатека — восстановлена (`wp media import --skip-copy`), миниатюры пересозданы.
- Пользователи — роли восстановлены.
- Иконка — настроена через Customizer.
- `robots.txt` / `sitemap.xml` — в норме, без `.xyz`.
- Яндекс.Вебмастер — подтверждён, sitemap отправлен.
- Яндекс.Метрика — установлена, работает.
- Google Analytics — не используется (решение заказчика).
- Форма — smoke-тест пройден (модалка + CTA), письма уходят на `info@ingigroup.ru`.
- Меню — все пункты рабочие, включая подвал.
- CSS-рудимент — вычищен.
- SVG на `/felling` — заменены (если не заменены, отметить в §7).
- Мобильный прогон 6 услуг — пройден.

**Если когда-либо понадобится откат:**
1. Восстановить `wp-config.php` из бэкапа (`$table_prefix = 'wp_'`).
2. Импортировать дамп БД, снятый до смены префикса.
3. `wp cache flush` + purge хостинга.
4. Smoke-тест ключевых страниц.

Полная процедура переноса — в §6.30. Бэкапы хранить минимум 30 дней после переноса.

---

## 14. Что осталось за рамками этой темы

- **SEO-плагин (Yoast / RankMath)** — не установлен, это следующий трек (§10.1).
- **Оптимизация скорости** — preload шрифтов, defer скриптов, lazy карт (§10.2).
- **Кросс-браузерное тестирование** — не проводилось системно.
- **Чистка `main.css`** — опционально (§7.2).
- **Перевод галерей в медиатеку** — опционально (§7.3).
