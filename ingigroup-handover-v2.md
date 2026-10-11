# Хендовер проекта: WordPress-тема IngiGroup

**Версия:** v2 (объединённый)
**Дата обновления:** 11 октября 2026 г.
**Статус:** главная закрыта (десктоп + мобилка), раздел «Проекты» закрыт (30/30).
**В работе:** внутренние страницы.

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
inc/cpt.php            — CPT (project, service, opinion, certificate) + таксономия
inc/meta-boxes.php     — поля проекта
inc/ajax-form.php      — обработка формы

header.php             — шапка + бургер + мобильное меню
footer.php             — подвал
front-page.php         — главная

archive-project.php            — хаб /projects/
single-project.php             — детальная /project/<slug>/
taxonomy-project_category.php  — /projects/<term>/

template-parts/
  ├── hero.php
  ├── services.php
  ├── advantages.php   — 7 SVG-иконок
  ├── certificates.php
  ├── opinions.php
  ├── cta-form.php
  ├── map.php
  ├── breadcrumbs.php
  └── project-card.php

assets/css/
  ├── main.css         — десктоп + секция «ПРОЕКТЫ» + dropdown-меню
  ├── responsive.css   — media-запросы
  ├── hotfix.css       — правки последним
  └── style.css        — обязательный
assets/js/main.js      — всё: меню, форма, карта, AOS, GSAP
assets/images/         — картинки + logo-horizontal.png
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
- Основной текст: 16px, line-height 1.43
- Слоган в шапке: 17px, weight 600
- Телефон: 26px, weight 700

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

**CPT и таксономия:**
- CPT `project`:
  - `has_archive => 'projects'`
  - `rewrite.slug => 'project'`
- Taxonomy `project_category`:
  - `rewrite.slug => 'projects'`
  - `hierarchical => true`
- **Критично:** у CPT и таксономии разные слаги (`project` vs `projects`), иначе конфликт rewrite и 404. Фильтр `rewrite_rules_array` в `inc/cpt.php` даёт приоритет архиву над правилами таксономии — **не трогать**.
- 3 термина автосоздаются при активации темы через `after_switch_theme`.

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

### 6.3. Инфраструктура (готова)

- `inc/cpt.php` — зарегистрированы 4 CPT: `project`, `service`, `opinion`, `certificate` + таксономия `project_category`. Только `project` наполнен.
- `inc/meta-boxes.php` — поля проекта (регион, заказчик, работы, дополнительно, галерея).
- `inc/ajax-form.php` — обработчик формы (проверка end-to-end не выполнена).
- `inc/customizer.php` — настройки темы через `get_theme_mod`.
- `inc/setup.php` — регистрация меню.

---

## 7. Что осталось

1. **Внутренние страницы** (основной трек):
   - О компании (`/company`)
   - Сертификаты (`/certificates`) — CPT `certificate` уже есть
   - Отзывы (`/opinions`) — CPT `opinion` уже есть
   - Контакты (`/contacts`)
   - Подстраницы услуг — CPT `service` уже есть (5 штук: Установка РСП, Изготовление РСП, Аренда РСП, Разработка проектов, Вырубка растительности)
2. **Проверка AJAX-формы** end-to-end (приём → почта → ответ → состояние кнопки).
3. **SEO:** title, description, OG через `add_theme_support('title-tag')` + Customizer/ACF.
4. **Оптимизация производительности:** preload шрифтов, lazy для карты, `defer` для `main.js`.
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
- Всё через `get_theme_mod()` с дефолтом.
- При старте нового трека — начать с одной страницы/секции, задать паттерн, потом переиспользовать.

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

---

## 10. Что дальше

Следующий крупный трек — **внутренние страницы**. Порядок:

1. **О компании** (`/company`) — начинаем с неё. Даст общий паттерн заголовка секции (51px), breadcrumbs, CTA-формы и футера, которые переиспользуем на остальных страницах.
2. Сертификаты (`/certificates`) — CPT `certificate` уже есть.
3. Отзывы (`/opinions`) — CPT `opinion` уже есть.
4. Контакты (`/contacts`) — статическая + карта (переиспользовать `template-parts/map.php`).
5. Подстраницы услуг — 5 штук, CPT `service` уже есть.

**Что нужно при старте трека:** 2 скрина по странице «О компании» (донор + текущий тест, если что-то есть).

---

## 11. Открытые вопросы

- AJAX-форма: проверена ли отправка end-to-end (писали ли письмо на почту)?
- Содержимое CPT `service` / `opinion` / `certificate` — будет наполняться вручную или через импорт?
- SEO-плагин (Yoast/RankMath) или кастомные поля в Customizer?

---

## 12. Ключевые URL / команды

| Действие | URL |
|---|---|
| Сброс permalinks | Настройки → Постоянные ссылки → Сохранить |
| Просмотр донора по якорю | https://ingigroup.ru/projects#NN |
| Просмотр проекта | https://ingigroup.xyz/project/<slug>/ |
| Список в админке | https://ingigroup.xyz/wp-admin/edit.php?post_type=project |
