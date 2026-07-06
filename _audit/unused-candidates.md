## Итог по search-results-filtered.txt

Дата: 2026-07-06

### Не удалять

- archive-product-base.php

Причина:
Используется файлами:
- archive-product-furgoni.php
- archive-product-sisterni.php
- archive-product-vahti.php

### Главные кандидаты на оптимизацию

#### 1. js/main.js

Содержит аварийную догрузку Owl Carousel с CDN.
Так как Owl уже подключается через functions.php, main.js нужно позже упростить:
- убрать удаление старых owl scripts;
- убрать динамическую вставку CDN;
- оставить только безопасную инициализацию .main-slider.

#### 2. js/common.js

Содержит старые библиотеки и инициализации:
- WOW;
- Owl Carousel;
- Magnific Popup;
- FlexSlider;
- .noloop;
- .info_slider;
- .zoom-gallery;
- .popup-with-form.

Не чистить одним махом.
Сначала проверить реальные DOM-элементы на страницах.

#### 3. css/header.css

Есть хвосты UberMenu.
Плагин UberMenu не активен, header.js сейчас работает без UberMenu.
Удалять только после проверки отсутствия .ubermenu в DOM.

#### 4. style.css

Есть хвосты старых плагинов:
- UberMenu;
- Woo Product Table / wpt-wrap;
- Formidable / frm_;
- Easy Side Tab Pro / estp;
- SearchWP;
- FlexSlider.

Не удалять массово.
Сначала проверить DOM и Network.

## js/common.js — runtime-аудит

Дата: 2026-07-06

Статус: не удалять.

Проверка показала:

- .popup-with-form есть на всех ключевых страницах: 6–8 элементов;
- .zoom-gallery есть на single product: 2 элемента;
- .image-popup-no-margins есть на single product: 2 элемента;
- .zoom-gallery1 на проверенных страницах не найден;
- .noloop на проверенных страницах не найден.

Вывод:
common.js пока нужен для попапов, галерей товара и старой логики вкладок.

Кандидаты на будущую точечную чистку:

- дублирующая инициализация .popup-with-form;
- .zoom-gallery1, если не найдётся на других товарах;
- .noloop, если не найдётся на других страницах;
- .loop / .info_slider после отдельной проверки;
- FlexSlider после подтверждения, что .flexslider отсутствует на фронте.

Удаление всего common.js запрещено.

### 2026-07-06 — common.js / popup init

Удалена дублирующая инициализация .popup-with-form в js/common.js.

Проверка:
- главная: popupLinks 6, magnificPopup true, commonLoaded true;
- single product: popupLinks 8, magnificPopup true, commonLoaded true;
- попапы открываются.

Статус: исправлено.

### 2026-07-06 — common.js / old Owl init

Проверка показала:
- .loop есть на главной: 1;
- .noloop на ключевых страницах не найден;
- .info_slider на ключевых страницах не найден;
- .flexslider на ключевых страницах не найден.

Из common.js удалены пустые инициализации:
- .noloop
- .info_slider

Оставлена рабочая инициализация:
- .loop

Контроль после правки:
- главная: loop 1, loopOwl true, owlLoaded true, wow function, commonLoaded true;
- single product: popupLinks 8, zoomGallery 2, imagePopup 2, magnificPopup true, commonLoaded true;
- попап открывается;
- фото товара открывается;
- вкладки товара работают.

FlexSlider-библиотеку пока не удаляли.

Статус: исправлено.

### 2026-07-06 — FlexSlider audit

Поиск по теме показал:

- js/common.js содержит встроенную библиотеку FlexSlider;
- product.css содержит стили .flex-viewport и .flex-control-thumbs для single product gallery;
- style.css содержит старый блок FlexSlider и font-face flexslider-icon;
- main.css / style_old.css / style.bak.css также содержат старые FlexSlider-блоки, но это кандидаты на backup/legacy.

Runtime-проверка на ключевых страницах:
- .flexslider: 0;
- .flex-viewport: 0 на проверенных страницах;
- flexLoaded: true.

Вывод:
FlexSlider из common.js пока не удалять. Сначала отдельно проверить все варианты single product gallery и WooCommerce gallery.

Статус: кандидат на будущую чистку, сейчас оставить.

### 2026-07-06 — backup / legacy files PHP reference check

Проверка PHP-подключений не нашла ссылок на следующие файлы:

- functions1.php
- functions2.php
- functions3.php
- functions4.php
- header1.php
- template-home_old.php
- style_old.css
- style.bak.css
- home_old.css
- main.css
- includeCss.css
- sel.css
- common.orig.js
- common1.js
- main.orig.js

Команда проверки:

Get-ChildItem -Recurse -File -Include *.php |
Where-Object { $_.FullName -notmatch "\\_audit\\" } |
Select-String -Pattern "functions1.php","functions2.php","functions3.php","functions4.php","header1.php","template-home_old.php","style_old.css","style.bak.css","home_old.css","main.css","includeCss.css","sel.css","common.orig.js","common1.js","main.orig.js"

Результат:
- совпадений не найдено.

Вывод:
Файлы не подключаются напрямую из PHP темы. Пока не удалять, оставить кандидатами на архивирование/удаление после финальной проверки фронта.

Статус: кандидаты.


### 2026-07-06 — backup / legacy files physical check

Физически найдены в теме:

- functions1.php — 76 KB
- functions2.php — 76.4 KB
- functions3.php — 76.4 KB
- functions4.php — 76.9 KB
- header1.php — 7.9 KB
- template-home_old.php — 26.1 KB
- style_old.css — 122.9 KB
- style.bak.css — 312 KB
- css/home_old.css — 20 KB
- main.css — 207.8 KB
- includeCss.css — 2.7 KB
- js/common.orig.js — 161.7 KB
- js/common1.js — 161.8 KB
- assets/js/main.orig.js — 3.2 KB
- js/main.orig.js — 5.7 KB

Не найден:

- sel.css

Предыдущая PHP-проверка не нашла подключений этих файлов из файлов темы.

Статус:
- не удалять сразу;
- оставить кандидатами на архивирование/удаление после проверки frontend resources.

### 2026-07-06 — backup / legacy files frontend resource check

Проверка frontend resources на ключевых страницах показала, что backup/legacy-файлы не загружаются:

Проверены страницы:
- /
- /avtofurgony
- /avtotsisterny-ural
- /kupit-ural-v-lizing
- /contact
- /masterskaya-asv7722g4-10-ural-4320-6952-72

Файлы не найдены в resource list:
- functions1.php
- functions2.php
- functions3.php
- functions4.php
- header1.php
- template-home_old.php
- style_old.css
- style.bak.css
- home_old.css
- common.orig.js
- common1.js
- main.orig.js

Активно загружаются рабочие файлы:
- style.css
- css/header.css
- css/footer.css
- css/home.css / css/catalog.css / css/catalog-v2.css / css/product.css
- css/popup.css
- css/magnific-popup.css
- woocommerce.css
- js/main.js
- js/common.js
- js/ajax-search.js
- js/tabs-fix.js
- js/header.js
- js/script.js

Решение:
очевидные backup/legacy-файлы переместить в _legacy-unused/2026-07-06/.

main.css и includeCss.css пока оставить на отдельную проверку.

Статус: архивирование очевидных backup-файлов разрешено.

### 2026-07-06 — main-rabochi.js

Найден untracked-файл:

- js/main-rabochi.js — 6.3 KB

Сравнение с рабочим js/main.js показало, что main-rabochi.js содержит старую аварийную логику:

- loadAndInitOwlCarousel()
- удаление script[src*="owl.carousel"]
- ручную догрузку Owl Carousel с CDN
- старые битые комментарии в кодировке

Решение:
файл не использовать как рабочий main.js и не оставлять в js/.

Перемещён в:

- _legacy-unused/2026-07-06/js/main-rabochi.js

Статус: архивирован как legacy backup.