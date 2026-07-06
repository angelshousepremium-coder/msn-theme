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