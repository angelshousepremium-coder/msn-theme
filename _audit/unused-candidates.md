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