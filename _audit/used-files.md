# Used files — MSN theme

Дата ревизии: 2026-07-06

## Основные файлы темы

- functions.php
- header.php
- footer.php
- style.css

## CSS

- css/header.css
- css/footer.css
- css/home.css
- css/catalog.css
- css/catalog-v2.css
- css/product.css
- css/page.css
- css/sticky-cta.css
- css/magnific-popup.css

## JS

- js/main.js
- js/common.js
- js/header.js
- js/ajax-search.js
- js/tabs-fix.js

## WooCommerce templates

- woocommerce/content-product.php
- woocommerce/single-product.php
- woocommerce/content-single-product-sisterni.php
- woocommerce/content-single-product-furgoni.php
- woocommerce/content-single-product.php
- woocommerce/single-product/tabs/tabs.php

## Page templates

- archive-product.php
- template-product-v2.php
- template-cisterni.php
- template-furgoni.php
- template-product.php

## Пока не удаляем

- archive-product-base.php
- archive-product-sisterni.php
- archive-product-furgoni.php
- archive-product-vahti.php
- woocommerce/content-single-product-vahti.php

Причина: сначала проверяем подключения, URL и зависимости.

### 2026-07-06 — AGP 52 production pages

В БД найдены опубликованные страницы:

- ID 16852 — АГП 52 — page_template: page-agp52.php
- ID 16869 — АГП 52 — page_template: page-agpauto52.php

Файлы в локальной теме не найдены:

- page-agp52.php
- page-agpauto52.php
- css/agp52.css
- css/agpauto52.css
- js/agp52.js
- js/agpauto52.js

Вывод:
AGP 52 — не legacy и не кандидат на удаление. Это рабочий боевой функционал, который отсутствует в локальной копии темы.

Статус:
- восстановить файлы с боевого сайта;
- добавить в Git;
- после восстановления проверить страницы АГП 52 локально и на боевом сайте.