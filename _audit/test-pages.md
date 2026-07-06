# Test pages before cleanup

Дата: 2026-07-06

## Главная

- [ ] http://localhost/

Проверить:
- главный слайдер;
- шапка desktop/mobile;
- меню;
- поиск;
- попап обратного звонка;
- блоки главной;
- Owl Carousel.

---

## Кастомные страницы каталога catalog-v2

Файлы:
- template-furgoni.php
- template-cisterni.php
- template-product-v2.php
- css/catalog-v2.css

Страницы:

- [ ] http://localhost/avtofurgony
- [ ] http://localhost/transportno-bytovye-mashiny-ural-tbm
- [ ] http://localhost/peredvizhnye-masterskie-ural-parm-mp
- [ ] http://localhost/avtomobili-dlya-perevozki-vzryvchatyh-veshhestv
- [ ] http://localhost/vahtovye-avtobusy-ural
- [ ] http://localhost/avtotsisterny-ural
- [ ] http://localhost/lesovozy-sortimentovozy-trubopletevozy

Проверить:
- hero-блок;
- мобильную верстку;
- карточки товаров;
- SEO-текст;
- stc-hero__benefits;
- правое изображение в hero;
- блоки после каталога;
- отсутствие поломок desktop-версии.

---

## Taxonomy zh

Файлы:
- taxonomy-zh.php
- css/catalog.css

Страницы:

- [ ] http://localhost/zh/tahografy
- [ ] http://localhost/zh/severnyj-variant-dorabotka

Проверить:
- навигацию категорий;
- мобильный аккордеон;
- карточки;
- активный пункт;
- отсутствие горизонтальной прокрутки на мобильной версии.

---

## Лизинг

Файлы:
- page.css
- Contact Form 7

Страница:

- [ ] http://localhost/kupit-ural-v-lizing

Проверить:
- форму .stc-modern-form-panel;
- поля input;
- телефон;
- кнопку submit;
- мобильную верстку;
- отправку формы;
- попапы, если есть.

---

## Контакты

Файлы:
- page.css
- template-contacts.php, если используется

Страница:

- [ ] http://localhost/contact

Проверить:
- контактные панели;
- читаемость основной информации;
- карту/изображения;
- форму;
- мобильную верстку;
- отступы;
- шапку и футер.

---

## WooCommerce категория

Добавить вручную после проверки реальной ссылки из админки:

- [ ] WooCommerce категория:

Как взять:
Товары → Категории → открыть любую основную категорию товаров.

Проверить:
- archive-product.php;
- css/catalog.css;
- woocommerce/content-product.php;
- карточки товаров;
- меню категорий;
- сортировку;
- SEO-текст.

---

## Single product

Реальные карточки товара для проверки:

- [ ] Single product фургон: http://localhost/masterskaya-asv7722g4-10-ural-4320-6952-72
- [ ] Single product цистерна: http://localhost/avtoczistern-vakuumnaya-4h4-na-shassi-43206-6151-71
- [ ] Single product вахтовка / прочие: http://localhost/vahtovyj-avtobus-ural-4320-6951-72-2

Проверить:
- woocommerce/single-product.php;
- woocommerce/content-single-product-sisterni.php;
- woocommerce/content-single-product-furgoni.php;
- css/product.css;
- галерею;
- CTA-кнопки;
- формы;
- WooCommerce tabs;
- вложенные табы;
- Двигатель;
- Коробка;
- Кабина;
- Подвеска;
- Характеристики;
- Установки.

---

## Общая проверка на каждой странице

В Console:

```js
[...document.styleSheets]
  .map(s => s.href)
  .filter(Boolean)
  .filter(h => h.includes('/wp-content/themes/msn/') || h.includes('cdnjs'));