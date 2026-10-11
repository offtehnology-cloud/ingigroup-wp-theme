# Хендовер: раздел «Проекты» — WP-тема IngiGroup

**Дата закрытия:** [воскресенье, 11 октября 2026 г. 04:42]
**Статус:** ✅ ЗАКРЫТО. Все 30 проектов импортированы, импортёры удалены, фронт проверен.
**Предыдущий хендовер:** ingigroup-handover.md (главная + инфраструктура)

---

## 1. Что сделано в этом этапе

- Импортированы проекты 24–28 (batch6) и 29–30 (batch7).
- Все 30 проектов на месте: 11 / 8 / 11 по категориям (ustanovka-rsp / vyrubka-dkr / obshchestroitelnye-raboty).
- Проверены и удалены дубли: [№15 (дубль 09) удалён; №21 и №23 оставлены — разные объекты, частичное пересечение фото].
- Импортёры `inc/import-projects*.php` удалены с сервера, `require` из `functions.php` убраны.
- Фронт раздела проверен на десктопе и мобилке.

---

## 2. Архитектура (без изменений с прошлого хендовера, для полноты)

| URL | Шаблон |
|---|---|
| `/projects/` | `archive-project.php` |
| `/projects/<term>/` | `taxonomy-project_category.php` |
| `/project/<slug>/` | `single-project.php` |

CPT: `project` (archive slug `projects`, single slug `project`).
Taxonomy: `project_category` (rewrite slug `projects`).

Фильтр `rewrite_rules_array` в `inc/cpt.php` даёт приоритет архиву над правилами таксономии — **не трогать**, иначе `/projects/` уедет в 404.

---

## 3. Термины и счётчики

| Slug | Название | Описание |
|---|---|---|
| `ustanovka-rsp` | Установка рельсовых страховочных пакетов | Реализованные проекты по установке рельсовых страховочных пакетов |
| `vyrubka-dkr` | Вырубка древесно-кустарниковой растительности | Реализованные проекты по вырубке древесно-кустарниковой растительности |
| `obshchestroitelnye-raboty` | Общестроительные работы | Реализованные проекты общестроительных работ |

---

## 4. Файлы темы, относящиеся к разделу

```
archive-project.php
single-project.php
taxonomy-project_category.php
template-parts/breadcrumbs.php
template-parts/project-card.php
inc/cpt.php              # CPT + таксономия + flush при активации
inc/meta-boxes.php       # поля проекта
assets/css/main.css      # секция «ПРОЕКТЫ» + dropdown-меню
```

**Удалено:** `inc/import-projects.php`, `inc/import-projects-batch2.php` … `batch7.php`.

---

## 5. Метаполя проекта (без изменений)

| Ключ | Формат | Где в шаблоне |
|---|---|---|
| `_project_region` | строка | плашка «Регион: …» |
| `_project_customer` | строка | «ЗАКАЗЧИК: …» |
| `_project_works` | многострочный, `\n` между пунктами | список работ |
| `_project_additional` | то же | блок «Дополнительно» |
| `_project_gallery` | CSV ID вложений | сетка галереи |
| `post_content` | `«Объект: …»` | описание над работами |
| `menu_order` | 1..30 | сортировка в листингах |

---

## 6. Соглашения

**Подзаголовки в списках:** строка, начинающаяся с `## `, рендерится как жирный подзаголовок в `single-project.php`. В `project-card.php` такие строки отфильтровываются и не считаются в «…и ещё N».

**Порядок в листингах:** `menu_order ASC`, затем `date ASC`.

**Breadcrumbs:** `template-parts/breadcrumbs.php`, универсальный — работает на архиве, таксономии и детальной.

---

## 7. Правила работы с разделом

- Любые изменения в `register_post_type` / `register_taxonomy` / `rewrite_rules_array` → **сразу** `Настройки → Постоянные ссылки → Сохранить`.
- При правках `main.css` помнить про `hotfix.css` (подключается последним, перебивает).
- Версии в `inc/enqueue.php` через `filemtime` — если правки не видны, проверь его первым.
- `data-aos` на мобилке отключён — если добавляешь новую секцию, не полагайся на AOS в мобильной вёрстке.

---

## 8. Открытые вопросы / TODO на будущее

-

---

## 9. Ссылки

- Продакшн на локальном тестовом сервере: https://ingigroup.xyz
- Донор: https://ingigroup.ru/projects
- Админка проектов: https://ingigroup.xyz/wp-admin/edit.php?post_type=project
- Категории: https://ingigroup.xyz/wp-admin/edit-tags.php?taxonomy=project_category&post_type=project
- Сброс permalinks: https://ingigroup.xyz/wp-admin/options-permalink.php

---

## 10. Что дальше

Следующий крупный трек — **внутренние страницы**:
1. О компании (`/company`)
2. Сертификаты (`/certificates`) — CPT `certificate` уже есть
3. Отзывы (`/opinions`) — CPT `opinion` уже есть
4. Контакты (`/contacts`)
5. Подстраницы услуг — CPT `service` уже есть

Начинаем с «О компании» — даст общий паттерн заголовка/крошек/CTA для всех остальных.
