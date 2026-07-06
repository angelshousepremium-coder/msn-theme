<?php
/**
 * Template Name: АГП 52 — V2
 *
 * Файл: /wp-content/themes/your-theme/page-agp52.php
 * Схема: Светлая / Apple-style
 * Навбар: чёрный (всегда читается)
 * Hero: двухколоночный — текст слева, фото справа
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class('agp52-page'); ?>>
<?php wp_body_open(); ?>

<!-- ============================================================
     НАВБАР — чёрный, фиксированный
     Всегда читается поверх любого контента / фото
     ============================================================ -->
<nav class="agp52-nav" id="agp52-nav" role="navigation">
  <div class="agp52-container">
    <div class="agp52-nav__inner">

      <a href="/" class="agp52-nav__logo">
        АГП<span>52</span>
      </a>

      <ul class="agp52-nav__links">
        <li><a href="#overview">Техника</a></li>
        <li><a href="#engine">Двигатель</a></li>
        <li><a href="#boom">Стрела</a></li>
        <li><a href="#specs">Характеристики</a></li>
        <li><a href="#company">О нас</a></li>
      </ul>

      <a href="https://spectechcom.ru/avtogidropodyomniki" class="agp52-nav__cta">
        Каталог
      </a>

    </div>
  </div>
</nav>


<!-- ============================================================
     HERO — FULLSCREEN VIDEO
     🎬 ВИДЕО: замените src на ваш файл.
     poster — первый кадр (WebP/JPG) пока видео грузится.
     Файлы: /wp-content/themes/msn/video/agp52-hero.mp4
            /wp-content/themes/msn/video/agp52-hero.webm
     ============================================================ -->
<section class="agp52-hero agp52-hero--video" id="hero">

  <!-- Видео-фон на всю ширину -->
  <div class="agp52-hero__video-wrap">
    <video class="agp52-hero__bg-video" autoplay muted loop playsinline
           poster="<?php echo get_template_directory_uri(); ?>/img/DSC07749.webp">
      <source src="<?php echo get_template_directory_uri(); ?>/video/agp52-hero.mp4" type="video/mp4">
      <source src="<?php echo get_template_directory_uri(); ?>/video/agp52-hero.webm" type="video/webm">
    </video>
    <!-- тёмный оверлей поверх видео -->
    <div class="agp52-hero__video-overlay"></div>
  </div>

  <!-- Контент поверх видео -->
  <div class="agp52-container agp52-hero__video-content">

    <div class="agp52-hero__eyebrow">Автогидроподъёмник</div>

    <h1 class="agp52-hero__title">
      АГП<br><em>52</em>
    </h1>

    <p class="agp52-hero__subtitle">
      Телескопическая стрела 7 секций &bull; Подъём до 51.7&nbsp;м<br>
      Привод 6×6 &bull; Двигатель ЯМЗ-536, 283&nbsp;л.с.
    </p>

    <div class="agp52-hero__actions">
      <a href="#cta" class="btn-primary btn-primary--accent" data-action="request">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
        Получить КП
      </a>
      <a href="https://rutube.ru/video/4aa2b7ea7b3ad9fed6fae24e1339d9a5/"
   class="agp52-hero__video-link btn-outline btn-outline--light"
   target="_blank"
   rel="noopener">
  <span class="agp52-hero__video-icon">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
      <path d="M8 5v14l11-7z"/>
    </svg>
  </span>
  <span class="agp52-hero__video-text">
    Смотреть<br>полное видео
  </span>
</a>
    </div>

  </div>

  <!-- Статы-полоска -->
  <div class="agp52-hero__specs-strip">
    <div class="agp52-container">
      <div class="agp52-hero__specs-strip-inner">
        <div class="agp52-hero__spec-item">
          <div class="agp52-hero__spec-value">51.7 м</div>
          <div class="agp52-hero__spec-label">Высота подъёма</div>
        </div>
        <div class="agp52-hero__spec-divider"></div>
        <div class="agp52-hero__spec-item">
          <div class="agp52-hero__spec-value">400 кг</div>
          <div class="agp52-hero__spec-label">Грузоподъёмность</div>
        </div>
        <div class="agp52-hero__spec-divider"></div>
        <div class="agp52-hero__spec-item">
          <div class="agp52-hero__spec-value">360°</div>
          <div class="agp52-hero__spec-label">Поворот платформы</div>
        </div>
        <div class="agp52-hero__spec-divider"></div>
        <div class="agp52-hero__spec-item">
          <div class="agp52-hero__spec-value">6×6</div>
          <div class="agp52-hero__spec-label">Колёсная формула</div>
        </div>
        <div class="agp52-hero__spec-divider"></div>
        <div class="agp52-hero__spec-item">
          <div class="agp52-hero__spec-value">283 л.с.</div>
          <div class="agp52-hero__spec-label">Мощность двигателя</div>
        </div>
      </div>
    </div>
  </div>

</section>


<!-- ============================================================
     ИНТЕРАКТИВНЫЙ ОБЗОР — HOVER-ЗОНЫ
     ============================================================
     📸 ФОТО: Строго боковой вид — лучший вариант PNG с
     прозрачным фоном 2000×1100 px. Белый фон секции
     позволяет PNG-вырезку выглядеть идеально.
     Кружки-hotspot: отрегулируйте left/top в CSS под
     реальное расположение узлов на фото.
     ============================================================ -->
<section class="agp52-overview" id="overview">
  <div class="agp52-container">

    <div class="agp52-reveal">
      <div class="agp52-section-tag">Обзор техники</div>
      <h2 class="agp52-section-title">Изучите<br>каждый узел</h2>
    </div>

    <div class="agp52-overview__stage agp52-reveal" style="transition-delay:0.15s;">

      <!--
        📸 ВСТАВЬТЕ ФОТО — раскомментируйте нужный вариант:

        Вариант A: JPG/WebP 1920×1280 — object-fit:contain,
        картинка целиком, белые поля по бокам не видны.
      -->
      <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/agp52-side.jpg"
                class="agp52-overview__img"
                alt="АГП 52 — вид сбоку"
                width="1920" height="1280"> -->

      <!--
        Вариант B: PNG с прозрачным фоном — прозрачность
        сольётся с белым фоном секции, идеально для hotspot.
      -->
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07682.webp"
                class="agp52-overview__img"
                alt="АГП 52 — вид сбоку">



      <!-- HOTSPOT: Кабина -->
      <div class="agp52-hotspot agp52-hotspot--cabin" tabindex="0" aria-label="Кабина NEXT">
        <div class="agp52-hotspot__ring"></div>
        <div class="agp52-hotspot__dot"></div>
        <div class="agp52-tooltip">
          <div class="agp52-tooltip__title">Кабина NEXT</div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Мест</span>
            <span class="agp52-tooltip__val">3</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Тип</span>
            <span class="agp52-tooltip__val">NEXT</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Управление</span>
            <span class="agp52-tooltip__val">Электрогидравлика</span>
          </div>
        </div>
      </div>

      <!-- HOTSPOT: Двигатель -->
      <div class="agp52-hotspot agp52-hotspot--engine" tabindex="0" aria-label="Двигатель">
        <div class="agp52-hotspot__ring"></div>
        <div class="agp52-hotspot__dot"></div>
        <div class="agp52-tooltip">
          <div class="agp52-tooltip__title">Двигатель</div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Модель</span>
            <span class="agp52-tooltip__val">ЯМЗ-536</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Мощность</span>
            <span class="agp52-tooltip__val">283 л.с.</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Топливный бак</span>
            <span class="agp52-tooltip__val">300 + 210 л</span>
          </div>
        </div>
      </div>

      <!-- HOTSPOT: Стрела -->
      <div class="agp52-hotspot agp52-hotspot--boom" tabindex="0" aria-label="Стрела">
        <div class="agp52-hotspot__ring"></div>
        <div class="agp52-hotspot__dot"></div>
        <div class="agp52-tooltip">
          <div class="agp52-tooltip__title">Стрела</div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Тип</span>
            <span class="agp52-tooltip__val">Телескопическая</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Секций</span>
            <span class="agp52-tooltip__val">7</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Высота</span>
            <span class="agp52-tooltip__val">51.7 м</span>
          </div>
        </div>
      </div>

      <!-- HOTSPOT: Люлька -->
      <div class="agp52-hotspot agp52-hotspot--basket" tabindex="0" aria-label="Люлька">
        <div class="agp52-hotspot__ring"></div>
        <div class="agp52-hotspot__dot"></div>
        <div class="agp52-tooltip">
          <div class="agp52-tooltip__title">Люлька</div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Грузоподъёмность</span>
            <span class="agp52-tooltip__val">400 кг</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Изоляция</span>
            <span class="agp52-tooltip__val">до 400 В</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Поворот</span>
            <span class="agp52-tooltip__val">360°</span>
          </div>
        </div>
      </div>

      <!-- HOTSPOT: Трансмиссия -->
      <div class="agp52-hotspot agp52-hotspot--axle" tabindex="0" aria-label="Трансмиссия">
        <div class="agp52-hotspot__ring"></div>
        <div class="agp52-hotspot__dot"></div>
        <div class="agp52-tooltip">
          <div class="agp52-tooltip__title">Трансмиссия</div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">КПП</span>
            <span class="agp52-tooltip__val">Механическая, 5 ст.</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Формула</span>
            <span class="agp52-tooltip__val">6×6</span>
          </div>
          <div class="agp52-tooltip__item">
            <span class="agp52-tooltip__key">Масса</span>
            <span class="agp52-tooltip__val">22 500 кг</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     ЧЕРТЁЖ (Blueprint)
     ============================================================
     📸 СХЕМА: Технический чертёж — чёрные/синие линии на
     БЕЛОМ фоне. Светлая схема сайта идеально принимает
     такой чертёж без дополнительных ухищрений.
     Форматы: SVG (лучший), PNG, JPG.
     Размер: 1800×1100 px.
     ============================================================ -->
<section class="agp52-blueprint" id="blueprint">
  <div class="agp52-container">
    <div class="agp52-blueprint__grid">

      <div class="agp52-reveal agp52-reveal--left">
       <div class="agp52-blueprint__image">

  <div class="agp52-blueprint-slider">

    <!-- КНОПКА НАЗАД -->
    <button class="agp52-blueprint-nav prev">
      ‹
    </button>

    <!-- СЛАЙДЫ -->
    <div class="agp52-blueprint-track">

      <!-- СЛАЙД 1 -->
      <div class="agp52-blueprint-slide active">
        <img
          src="<?php echo get_template_directory_uri(); ?>/img/ttx4.webp"
          alt="Чертёж АГП 52"
          class="agp52-blueprint-img"
        >
      </div>

      <!-- СЛАЙД 2 -->
      <div class="agp52-blueprint-slide">
        <img
          src="<?php echo get_template_directory_uri(); ?>/img/ttx15.webp"
          alt="Чертёж АГП 52"
          class="agp52-blueprint-img"
        >
      </div>

    </div>

    <!-- КНОПКА ВПЕРЕД -->
    <button class="agp52-blueprint-nav next">
      ›
    </button>

  </div>

</div>



      </div>

      <div class="agp52-reveal agp52-reveal--right" style="transition-delay:0.15s;">
        <div class="agp52-section-tag">Инженерные решения</div>
        <h2 class="agp52-section-title" style="margin-bottom:48px;">Точность<br>в каждой детали</h2>

        <div class="agp52-blueprint__specs-list">

          <div class="agp52-blueprint__spec-row">
            <div class="agp52-blueprint__spec-num">51.7<small>м</small></div>
            <div>
              <div class="agp52-blueprint__spec-name">Высота подъёма</div>
              <div class="agp52-blueprint__spec-desc">Телескопическая стрела, 7 секций</div>
            </div>
          </div>

          <div class="agp52-blueprint__spec-row">
            <div class="agp52-blueprint__spec-num">400<small>кг</small></div>
            <div>
              <div class="agp52-blueprint__spec-name">Грузоподъёмность люльки</div>
              <div class="agp52-blueprint__spec-desc">Изоляция до 400 В</div>
            </div>
          </div>

          <div class="agp52-blueprint__spec-row">
            <div class="agp52-blueprint__spec-num">360<small>°</small></div>
            <div>
              <div class="agp52-blueprint__spec-name">Полный поворот</div>
              <div class="agp52-blueprint__spec-desc">Электрогидравлическое управление</div>
            </div>
          </div>

          <div class="agp52-blueprint__spec-row">
            <div class="agp52-blueprint__spec-num">510<small>л</small></div>
            <div>
              <div class="agp52-blueprint__spec-name">Топливный запас</div>
              <div class="agp52-blueprint__spec-desc">300 + 210 л — для дальних объектов</div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     ДВИГАТЕЛЬ И КПП
     ============================================================
     ============================================================ -->
<section class="agp52-engine" id="engine">
  <div class="agp52-container">
    <div class="agp52-engine__grid">

      <div class="agp52-reveal agp52-reveal--left">
        <div class="agp52-engine__media">

          <!-- ВСТАВЬТЕ: -->
          <img src="<?php echo get_template_directory_uri(); ?>/img/engine.webp"
                    style="width:100%;aspect-ratio:4/2;object-fit:cover;object-position: center;border-radius:4px;display:block;"
                    alt="Двигатель ЯМЗ-536">

          

          <div class="agp52-engine__badge">
            <div class="agp52-engine__badge-model">ЯМЗ-536</div>
            <div class="agp52-engine__badge-desc">Дизельный двигатель</div>
          </div>
        </div>

        <div class="agp52-engine__stats">
          <div class="agp52-engine__stat">
            <div class="agp52-engine__stat-val">283<span> л.с.</span></div>
            <div class="agp52-engine__stat-label">Мощность</div>
          </div>
          <div class="agp52-engine__stat">
            <div class="agp52-engine__stat-val">6<span>-цил.</span></div>
            <div class="agp52-engine__stat-label">Конфигурация</div>
          </div>
          <div class="agp52-engine__stat">
            <div class="agp52-engine__stat-val">510<span> л</span></div>
            <div class="agp52-engine__stat-label">Объём баков</div>
          </div>
          <div class="agp52-engine__stat">
            <div class="agp52-engine__stat-val">Euro<span> 4</span></div>
            <div class="agp52-engine__stat-label">Экостандарт</div>
          </div>
        </div>
      </div>

      <div class="agp52-reveal agp52-reveal--right" style="transition-delay:0.15s;">
        <div class="agp52-section-tag">Силовая установка</div>
        <h2 class="agp52-section-title" style="margin-bottom:24px;">Сердце<br>машины</h2>

        <p class="agp52-engine__desc">
          Ярославский моторный завод — проверенная надёжность в любых условиях.
          Двигатель ЯМЗ-536 обеспечивает мощную тягу для работы
          с нагрузкой до 22.5 тонн полной массы на любых дорогах.
        </p>

        <div class="agp52-gearbox">
          <!-- ВСТАВЬТЕ: -->
          <img src="<?php echo get_template_directory_uri(); ?>/img/1105.webp"
                    class="agp52-gearbox__photo" alt="КПП">
          <div>
            <div class="agp52-gearbox__title">Механическая КПП · 5 ступеней</div>
            <div class="agp52-gearbox__desc">
              Синхронизированная трансмиссия с полным приводом 6×6.
              Уверенная работа на бездорожье и строительных площадках.
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     СТРЕЛА — ВЫСОТА 51.7 М
     ============================================================
     <video autoplay muted loop playsinline style="width:100%;height:100%;object-fit:cover;">
       <source src=".../boom-video.mp4" type="video/mp4">
     </video>
     ============================================================ -->
<section class="agp52-boom" id="boom">
  <div class="agp52-container">
    <div class="agp52-boom__grid">

      <div class="agp52-reveal agp52-reveal--left">
        <div class="agp52-section-tag">Рабочий орган</div>
        <h2 class="agp52-section-title" style="margin-bottom:8px;">Телескопическая<br>стрела</h2>

        <div class="agp52-boom__height-number">51<span>.7м</span></div>
        <div class="agp52-boom__height-label">Максимальная высота подъёма</div>

        <div class="agp52-boom__comparisons">
          <div class="agp52-boom__comparison-item">
            <span style="min-width:96px;font-size:12px;">АГП 52</span>
            <div class="agp52-boom__comparison-bar">
              <div class="agp52-boom__comparison-fill" data-width="100%"></div>
            </div>
            <span>51.7 м</span>
          </div>
          <div class="agp52-boom__comparison-item">
            <span style="min-width:96px;font-size:12px;">16-эт. дом</span>
            <div class="agp52-boom__comparison-bar">
              <div class="agp52-boom__comparison-fill" data-width="88%"></div>
            </div>
            <span>~48 м</span>
          </div>
          <div class="agp52-boom__comparison-item">
            <span style="min-width:96px;font-size:12px;">Опора ЛЭП</span>
            <div class="agp52-boom__comparison-bar">
              <div class="agp52-boom__comparison-fill" data-width="58%"></div>
            </div>
            <span>~30 м</span>
          </div>
          <div class="agp52-boom__comparison-item">
            <span style="min-width:96px;font-size:12px;">5-эт. здание</span>
            <div class="agp52-boom__comparison-bar">
              <div class="agp52-boom__comparison-fill" data-width="29%"></div>
            </div>
            <span>~15 м</span>
          </div>
        </div>

        <div style="margin-top:36px;display:flex;gap:24px;flex-wrap:wrap;">
          <div>
            <div style="font-family:var(--font-display);font-size:28px;color:var(--c-black);">7</div>
            <div style="font-size:11px;color:var(--c-muted);letter-spacing:0.1em;text-transform:uppercase;margin-top:2px;">Секций</div>
          </div>
          <div>
            <div style="font-family:var(--font-display);font-size:28px;color:var(--c-black);">400 кг</div>
            <div style="font-size:11px;color:var(--c-muted);letter-spacing:0.1em;text-transform:uppercase;margin-top:2px;">Нагрузка</div>
          </div>
          <div>
            <div style="font-family:var(--font-display);font-size:28px;color:var(--c-black);">400 В</div>
            <div style="font-size:11px;color:var(--c-muted);letter-spacing:0.1em;text-transform:uppercase;margin-top:2px;">Изоляция</div>
          </div>
        </div>
      </div>

      <div class="agp52-reveal agp52-reveal--right" style="transition-delay:0.2s;">
        <div class="agp52-boom__visual">

          <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07671.webp"
               class="agp52-boom__photo" alt="Стрела АГП 52">

          <!-- Кнопка воспроизведения видео -->
          <button class="agp52-boom__play-btn" id="agp52BoomPlayBtn" aria-label="Смотреть видео о стреле">
            <span class="agp52-boom__play-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
            </span>
            <span class="agp52-boom__play-label">Смотреть видео</span>
          </button>

          <div class="agp52-height-scale">
            <div class="agp52-height-scale__line agp52-height-scale__highlight">51.7 м</div>
            <div class="agp52-height-scale__line">40 м</div>
            <div class="agp52-height-scale__line">30 м</div>
            <div class="agp52-height-scale__line">20 м</div>
            <div class="agp52-height-scale__line">10 м</div>
            <div class="agp52-height-scale__line">0 м</div>
          </div>

        </div>
      </div>

    </div>
  </div>


<!-- ============================================================
     ГАЛЕРЕЯ
     Добавьте свои фото: скопируйте блок .agp52-gallery__item
     и замените src на нужное изображение.
     ============================================================ -->
<section class="agp52-gallery" id="gallery">
  <div class="agp52-container">
    <div class="agp52-reveal">
      <div class="agp52-section-tag">Фотогалерея</div>
      <h2 class="agp52-section-title">АГП 52<br>в деталях</h2>
    </div>
  </div>

  <div class="agp52-gallery__grid agp52-reveal" style="transition-delay:0.15s;">

    <!-- ФОТО 1 — большое, занимает 2 строки -->
    <div class="agp52-gallery__item agp52-gallery__item--tall" data-index="0">
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07675.webp" alt="АГП 52" loading="lazy">
      <div class="agp52-gallery__overlay">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </div>
    </div>

    <!-- ФОТО 2 -->
    <div class="agp52-gallery__item" data-index="1">
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07730.webp" alt="АГП 52" loading="lazy">
      <div class="agp52-gallery__overlay">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </div>
    </div>

    <!-- ФОТО 3 -->
    <div class="agp52-gallery__item" data-index="2">
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07741.webp" alt="Стрела АГП 52" loading="lazy">
      <div class="agp52-gallery__overlay">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </div>
    </div>

    <!-- ФОТО 4 -->
    <div class="agp52-gallery__item" data-index="3">
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07744.webp" alt="Двигатель ЯМЗ-536" loading="lazy">
      <div class="agp52-gallery__overlay">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </div>
    </div>

    <!-- ФОТО 5 -->
    <div class="agp52-gallery__item" data-index="4">
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07747.webp" alt="КПП АГП 52" loading="lazy">
      <div class="agp52-gallery__overlay">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </div>
    </div>

    <!-- ФОТО 6 — широкое -->
    <div class="agp52-gallery__item agp52-gallery__item--wide" data-index="5">
      <img src="<?php echo get_template_directory_uri(); ?>/img/DSC07754.webp" alt="Схема АГП 52" loading="lazy">
      <div class="agp52-gallery__overlay">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </div>
    </div>

  </div><!-- /.agp52-gallery__grid -->
</section>

<!-- LIGHTBOX для галереи -->
<div class="agp52-glightbox" id="agp52Glightbox" role="dialog" aria-modal="true" aria-label="Просмотр фото">
  <button class="agp52-glightbox__close" id="agp52GlightboxClose" aria-label="Закрыть">&times;</button>
  <button class="agp52-glightbox__nav agp52-glightbox__prev" id="agp52GlightboxPrev" aria-label="Предыдущее">&#8249;</button>
  <div class="agp52-glightbox__stage">
    <img class="agp52-glightbox__img" id="agp52GlightboxImg" src="" alt="">
  </div>
  <button class="agp52-glightbox__nav agp52-glightbox__next" id="agp52GlightboxNext" aria-label="Следующее">&#8250;</button>
  <div class="agp52-glightbox__counter" id="agp52GlightboxCounter">1 / 6</div>
</div>


<!-- ============================================================
     ПРЕИМУЩЕСТВА
     ============================================================ -->
<section class="agp52-why" id="why">
  <div class="agp52-container">

    <div class="agp52-why__header agp52-reveal">
      <div class="agp52-section-tag">Почему выбирают нас</div>
      <h2 class="agp52-section-title">Полный цикл.<br>Без переплат.</h2>
    </div>

    <div class="agp52-why__grid">

      <div class="agp52-advantage agp52-reveal" data-delay="1">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="8" y="8" width="32" height="32" rx="2"/><path d="M16 24h16M24 16v16"/>
        </svg>
        <div class="agp52-advantage__title">Собственное производство</div>
        <div class="agp52-advantage__desc">Мы — не посредники. Производим сами — контролируем качество на каждом этапе.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="2">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="24" cy="24" r="16"/><path d="M24 14v10l6 4"/>
        </svg>
        <div class="agp52-advantage__title">Гарантия 2 года / 100 000 км</div>
        <div class="agp52-advantage__desc">Лучшая гарантия на рынке спецтехники Урал. Уверены в каждом узле.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="3">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M12 36V20l12-8 12 8v16"/><rect x="18" y="26" width="12" height="10"/>
        </svg>
        <div class="agp52-advantage__title">100+ единиц в наличии</div>
        <div class="agp52-advantage__desc">Техника на складе — не нужно ждать. Поставка от 1 дня.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="4">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="8" y="16" width="32" height="22" rx="2"/><path d="M16 16v-4a8 8 0 0116 0v4"/><path d="M24 26v4"/>
        </svg>
        <div class="agp52-advantage__title">Лизинг от 1% предоплаты</div>
        <div class="agp52-advantage__desc">Лизинг, кредит, рассрочка. Подберём оптимальное финансирование.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="1">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M24 6l4 12h12l-10 7 4 12-10-7-10 7 4-12L8 18h12z"/>
        </svg>
        <div class="agp52-advantage__title">Официальный дилер с 2004 г.</div>
        <div class="agp52-advantage__desc">№1 дилер АЗ «Урал» в России. Более 20 лет на рынке.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="2">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="18" cy="20" r="6"/><circle cx="30" cy="20" r="6"/>
          <path d="M6 38c0-6 5-10 12-10h12c7 0 12 4 12 10"/>
        </svg>
        <div class="agp52-advantage__title">Конструкторское бюро</div>
        <div class="agp52-advantage__desc">Собственный инженерный отдел. Доработаем под ваши задачи.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="3">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M8 8h32v8H8zM8 20h14v20H8zM22 28h18v12H22zM22 20h18v8H22z"/>
        </svg>
        <div class="agp52-advantage__title">5 филиалов и сервис-центр</div>
        <div class="agp52-advantage__desc">Сервисная поддержка в 5 регионах России. Выезд на объект.</div>
      </div>

      <div class="agp52-advantage agp52-reveal" data-delay="4">
        <svg class="agp52-advantage__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="24" cy="24" r="16"/><path d="M16 24l6 6 10-10"/>
        </svg>
        <div class="agp52-advantage__title">Поставка от 1 дня</div>
        <div class="agp52-advantage__desc">Оформляем и отгружаем в кратчайшие сроки прямо со склада.</div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     О КОМПАНИИ — ТЁМНАЯ ВСТАВКА (контраст к светлой странице)
     ============================================================ -->
<section class="agp52-company" id="company">
  <div class="agp52-container">
    <div class="agp52-company__grid">

      <div class="agp52-reveal agp52-reveal--left">
        <div class="agp52-section-tag">О компании</div>
        <h2 class="agp52-section-title">№1 дилер<br>АЗ Урал</h2>
        <p class="agp52-company__desc">
          Более 20 лет поставляем спецтехнику на базе Урал по всей России.
          Собственное производство, конструкторское бюро и сервисный центр —
          полный цикл без посредников.
        </p>

        <div class="agp52-timeline">
          <div class="agp52-timeline__item">
            <div class="agp52-timeline__dot"></div>
            <div class="agp52-timeline__year">2004</div>
            <div class="agp52-timeline__event">Официальный дилер АЗ Урал</div>
          </div>
          <div class="agp52-timeline__item">
            <div class="agp52-timeline__dot"></div>
            <div class="agp52-timeline__year">2010</div>
            <div class="agp52-timeline__event">Открытие КБ и производства</div>
          </div>
          <div class="agp52-timeline__item">
            <div class="agp52-timeline__dot"></div>
            <div class="agp52-timeline__year">2018</div>
            <div class="agp52-timeline__event">5 региональных филиалов</div>
          </div>
          <div class="agp52-timeline__item">
            <div class="agp52-timeline__dot"></div>
            <div class="agp52-timeline__year">Сегодня</div>
            <div class="agp52-timeline__event">№1 в России по объёму поставок</div>
          </div>
        </div>
      </div>

      <div class="agp52-reveal agp52-reveal--right" style="transition-delay:0.15s;">
        <div class="agp52-company__numbers">
          <div class="agp52-company__num">
            <div class="agp52-company__num-val" data-target="20" data-suffix="+">20+</div>
            <div class="agp52-company__num-label">Лет на рынке</div>
          </div>
          <div class="agp52-company__num">
            <div class="agp52-company__num-val" data-target="100" data-suffix="+">100+</div>
            <div class="agp52-company__num-label">Единиц в наличии</div>
          </div>
          <div class="agp52-company__num">
            <div class="agp52-company__num-val" data-target="5">5</div>
            <div class="agp52-company__num-label">Филиалов в РФ</div>
          </div>
          <div class="agp52-company__num">
            <div class="agp52-company__num-val" data-target="2">2</div>
            <div class="agp52-company__num-label">Года гарантии</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     ТАБЛИЦА ХАРАКТЕРИСТИК
     ============================================================ -->
<section class="agp52-specs" id="specs">
  <div class="agp52-container">

    <div class="agp52-reveal">
      <div class="agp52-section-tag">Полные данные</div>
      <h2 class="agp52-section-title">Технические<br>характеристики</h2>
    </div>

    <table class="agp52-specs__table agp52-reveal" style="transition-delay:0.2s;" aria-label="Технические характеристики АГП 52">
      <thead>
        <tr><th>Параметр</th><th>Значение</th></tr>
      </thead>
      <tbody>
        <tr><td>Базовое шасси</td><td><span class="agp52-accent">Урал NEXT</span></td></tr>
        <tr><td>Колёсная формула</td><td>6×6</td></tr>
        <tr><td>Кабина</td><td>NEXT, 3 места</td></tr>
        <tr><td>Двигатель</td><td>ЯМЗ-536</td></tr>
        <tr><td>Мощность двигателя</td><td><span class="agp52-accent">283 л.с.</span></td></tr>
        <tr><td>Коробка передач</td><td>Механическая, 5 ступеней</td></tr>
        <tr><td>Топливный бак</td><td>300 + 210 л</td></tr>
        <tr><td>Грузоподъёмность люльки</td><td><span class="agp52-accent">400 кг</span></td></tr>
        <tr><td>Высота подъёма</td><td><span class="agp52-accent">51.7 м</span></td></tr>
        <tr><td>Тип стрелы</td><td>Телескопическая, 7 секций</td></tr>
        <tr><td>Угол поворота стрелы</td><td>360°</td></tr>
        <tr><td>Управление</td><td>Электрогидравлическое</td></tr>
        <tr><td>Электроизоляция</td><td>До 400 В</td></tr>
        <tr><td>Полная масса</td><td>22 500 кг</td></tr>
        <tr><td>Габариты (Д×Ш×В)</td><td>11 950 × 2 550 × 3 995 мм</td></tr>
      </tbody>
    </table>

  </div>
</section>


<!-- ============================================================
     ФИНАЛЬНЫЙ CTA — тёмный блок (контраст)
     ============================================================
 -->
 
<section class="agp52-cta" id="cta">
  <div class="agp52-container">
    <div class="agp52-cta__content agp52-reveal">

  <div class="agp52-cta__left">
    <h2 class="agp52-cta__title">
      Готовы к<br><em>работе?</em>
    </h2>
  </div>

  <div class="agp52-cta__right">
    <p class="agp52-cta__subtitle">
  Оставьте заявку — перезвоним за&nbsp;15&nbsp;минут.<br>
  <strong>Подберём комплектацию и лизинг под ваш бюджет.</strong>
</p>

    <div class="agp52-cta__actions">
      <a href="tel:+78006004142" class="btn-primary">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 8a16 16 0 006.72 6.72l1.18-1.17a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
        </svg>
        Позвонить сейчас
      </a>
      <a href="#" class="btn-outline" data-action="request">
        Получить КП
      </a>
    </div>

    <div class="agp52-cta__guarantees">
      <div class="agp52-cta__guarantee">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        Ответ в течение 1 часа
      </div>
      <div class="agp52-cta__guarantee">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        Персональный менеджер
      </div>
      <div class="agp52-cta__guarantee">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        Лизинг от 1% предоплаты
      </div>
    </div>
  </div>

</div>
  </div>
</section>


<!-- ============================================================
     МОДАЛЬНОЕ ОКНО — ВИДЕО СТРЕЛЫ
     Замените src на ваш файл видео.
     ============================================================ -->
<div class="agp52-video-modal" id="agp52VideoModal" role="dialog" aria-modal="true" aria-label="Видео о стреле">
  <div class="agp52-video-modal__inner">
    <button class="agp52-video-modal__close" id="agp52VideoModalClose" aria-label="Закрыть">&times;</button>
    <div class="agp52-video-modal__player">
      <video id="agp52BoomVideo" controls preload="none"
             poster="<?php echo get_template_directory_uri(); ?>/img/DSC07671.webp">
        <source src="<?php echo get_template_directory_uri(); ?>/img/a52_Sub_01.mp4" type="video/mp4">
        <source src="<?php echo get_template_directory_uri(); ?>/img/a52_Sub_01.webm" type="video/webm">
        Ваш браузер не поддерживает видео.
      </video>
    </div>
  </div>
</div>

<!-- ============================================================
     МОДАЛЬНАЯ ФОРМА — ПОЛУЧИТЬ КП
     Отправка на i.thor.ii@gmail.com через wp_mail() + SMTP
     ============================================================ -->
<div class="agp52-form-modal" id="agp52FormModal" role="dialog" aria-modal="true" aria-label="Получить коммерческое предложение">
  <div class="agp52-form-modal__inner">
    <button class="agp52-form-modal__close" id="agp52FormModalClose" aria-label="Закрыть">&times;</button>

    <div class="agp52-form-modal__head">
      <div class="agp52-section-tag" style="color:var(--c-accent);">Бесплатно · 1 час</div>
      <h3 class="agp52-form-modal__title">Получить<br><em>КП на АГП&nbsp;52</em></h3>
      <p class="agp52-form-modal__sub">Менеджер перезвонит и подберёт комплектацию под ваши задачи</p>
    </div>

    <form class="agp52-form" id="agp52Form" novalidate>
      <?php wp_nonce_field('agp52_send_kp', 'agp52_nonce'); ?>

      <div class="agp52-form__row">
        <label class="agp52-form__label" for="agp52Name">Имя</label>
        <input class="agp52-form__input" type="text" id="agp52Name" name="name"
               placeholder="Иван Иванов" required autocomplete="name">
      </div>

      <div class="agp52-form__row">
        <label class="agp52-form__label" for="agp52Phone">Телефон <span style="color:var(--c-accent)">*</span></label>
        <input class="agp52-form__input" type="tel" id="agp52Phone" name="phone"
               placeholder="+7 (___) ___-__-__" required autocomplete="tel">
      </div>

      <div class="agp52-form__row">
        <label class="agp52-form__label" for="agp52Email">Email</label>
        <input class="agp52-form__input" type="email" id="agp52Email" name="email"
               placeholder="mail@company.ru" autocomplete="email">
      </div>

      <div class="agp52-form__row">
        <label class="agp52-form__label" for="agp52Comment">Комментарий</label>
        <textarea class="agp52-form__input agp52-form__textarea" id="agp52Comment" name="comment"
                  placeholder="Регион, объём парка, особые требования..." rows="3"></textarea>
      </div>

      <button type="submit" class="btn-primary btn-primary--accent agp52-form__submit">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
        Отправить запрос
      </button>

      <div class="agp52-form__notice">Нажимая кнопку, вы соглашаетесь на обработку персональных данных</div>
      <div class="agp52-form__msg" id="agp52FormMsg"></div>
    </form>

  </div>
</div>

<!-- ============================================================
     FOOTER
     ============================================================ -->
<footer class="agp52-footer">
  <div class="agp52-container">
    <div class="agp52-footer__inner">
      <div class="agp52-footer__logo">АГП<span>52</span> · Урал</div>
      <div class="agp52-footer__copy">© <?php echo date('Y'); ?> — Официальный дилер АЗ «Урал» с 2004 года</div>
      <div class="agp52-footer__contact">
        <a href="tel:+78006004142">8-800-600-41-42</a>
      </div>
    </div>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ══ BLUEPRINT LIGHTBOX ══════════════════════════════════════ */
  var lb    = document.getElementById('agp52Lightbox');
  var lbImg = document.getElementById('agp52LightboxImg');

  if (lb && lbImg) {
    lb.classList.remove('active');
    lb.style.pointerEvents = 'none';

    var lbSlides = [];
    var lbIndex  = 0;
    var lbPrev   = document.getElementById('agp52LbPrev');
    var lbNext   = document.getElementById('agp52LbNext');
    var lbCounter= document.getElementById('agp52LbCounter');

    /* Собираем все картинки слайдера */
    document.querySelectorAll('.agp52-blueprint-slide img').forEach(function (img) {
      lbSlides.push(img.src);
    });

    function lbShow(idx) {
      lbIndex = (idx + lbSlides.length) % lbSlides.length;
      lbImg.style.opacity = '0';
      setTimeout(function () {
        lbImg.src = lbSlides[lbIndex];
        lbImg.style.opacity = '1';
      }, 150);
      if (lbCounter) lbCounter.textContent = (lbIndex + 1) + ' / ' + lbSlides.length;
    }

    function lbOpen(idx) {
      lbShow(idx);
      lb.classList.add('active');
      lb.style.pointerEvents = 'auto';
      document.body.style.overflow = 'hidden';
    }

    function lbClose() {
      lb.classList.remove('active');
      lb.style.pointerEvents = 'none';
      document.body.style.overflow = '';
      setTimeout(function () { lbImg.src = ''; }, 300);
    }

    /* Открыть — клик на картинку в слайдере */
    document.querySelectorAll('.agp52-blueprint-slide img').forEach(function (img, i) {
      img.style.cursor = 'zoom-in';
      img.addEventListener('click', function () { lbOpen(i); });
    });

    /* Стрелки */
    if (lbPrev) lbPrev.addEventListener('click', function (e) { e.stopPropagation(); lbShow(lbIndex - 1); });
    if (lbNext) lbNext.addEventListener('click', function (e) { e.stopPropagation(); lbShow(lbIndex + 1); });

    /* Закрыть — кнопка × или фон */
    lb.addEventListener('click', function (e) {
      if (
        e.target === lb ||
        e.target.classList.contains('agp52-lightbox-close') ||
        (e.target.closest && e.target.closest('.agp52-lightbox-close'))
      ) {
        lbClose();
      }
    });

    /* Клавиатура */
    document.addEventListener('keydown', function (e) {
      if (!lb.classList.contains('active')) return;
      if (e.key === 'Escape')     lbClose();
      if (e.key === 'ArrowLeft')  lbShow(lbIndex - 1);
      if (e.key === 'ArrowRight') lbShow(lbIndex + 1);
    });
  }

  /* ══ GALLERY LIGHTBOX ════════════════════════════════════════ */
  var gl      = document.getElementById('agp52Glightbox');
  var glImg   = document.getElementById('agp52GlightboxImg');
  var glClose = document.getElementById('agp52GlightboxClose');
  var glPrev  = document.getElementById('agp52GlightboxPrev');
  var glNext  = document.getElementById('agp52GlightboxNext');
  var glCnt   = document.getElementById('agp52GlightboxCounter');
  var glItems = document.querySelectorAll('.agp52-gallery__item img');
  var glIndex = 0;

  if (gl && glImg && glItems.length) {
    gl.style.pointerEvents = 'none';

    function glOpen(idx) {
      glIndex = idx;
      glImg.src = glItems[glIndex].src;
      glImg.alt = glItems[glIndex].alt || '';
      if (glCnt) glCnt.textContent = (glIndex + 1) + ' / ' + glItems.length;
      gl.classList.add('open');
      gl.style.pointerEvents = 'auto';
      document.body.style.overflow = 'hidden';
    }

    function glCloseF() {
      gl.classList.remove('open');
      gl.style.pointerEvents = 'none';
      document.body.style.overflow = '';
      setTimeout(function () { glImg.src = ''; }, 300);
    }

    function glStep(dir) {
      glIndex = (glIndex + dir + glItems.length) % glItems.length;
      glImg.src = glItems[glIndex].src;
      if (glCnt) glCnt.textContent = (glIndex + 1) + ' / ' + glItems.length;
    }

    glItems.forEach(function (img, i) {
      img.closest('.agp52-gallery__item').addEventListener('click', function () { glOpen(i); });
    });

    if (glClose) glClose.addEventListener('click', glCloseF);
    if (glPrev)  glPrev.addEventListener('click',  function () { glStep(-1); });
    if (glNext)  glNext.addEventListener('click',  function () { glStep(1); });

    gl.addEventListener('click', function (e) { if (e.target === gl) glCloseF(); });

    document.addEventListener('keydown', function (e) {
      if (!gl.classList.contains('open')) return;
      if (e.key === 'Escape')     glCloseF();
      if (e.key === 'ArrowLeft')  glStep(-1);
      if (e.key === 'ArrowRight') glStep(1);
    });
  }

  /* ══ VIDEO MODAL ═════════════════════════════════════════════ */
  var vm      = document.getElementById('agp52VideoModal');
  var vmClose = document.getElementById('agp52VideoModalClose');
  var vmVideo = document.getElementById('agp52BoomVideo');
  var vmBtn   = document.getElementById('agp52BoomPlayBtn');

  if (vm) {
    function vmOpen()  { vm.classList.add('open');    document.body.style.overflow = 'hidden'; }
    function vmCloseF(){ vm.classList.remove('open'); document.body.style.overflow = ''; if (vmVideo) vmVideo.pause(); }

    if (vmBtn)   vmBtn.addEventListener('click', vmOpen);
    if (vmClose) vmClose.addEventListener('click', vmCloseF);
    vm.addEventListener('click', function (e) { if (e.target === vm) vmCloseF(); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && vm.classList.contains('open')) vmCloseF();
    });
  }

  /* ══ FORM MODAL ══════════════════════════════════════════════ */
  var fm      = document.getElementById('agp52FormModal');
  var fmClose = document.getElementById('agp52FormModalClose');

  if (fm) {
    function fmOpen()  { fm.classList.add('open');    document.body.style.overflow = 'hidden'; }
    function fmCloseF(){ fm.classList.remove('open'); document.body.style.overflow = ''; }

    document.querySelectorAll('[data-action="request"]').forEach(function (btn) {
      btn.addEventListener('click', function (e) { e.preventDefault(); fmOpen(); });
    });
    if (fmClose) fmClose.addEventListener('click', fmCloseF);
    fm.addEventListener('click', function (e) { if (e.target === fm) fmCloseF(); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && fm.classList.contains('open')) fmCloseF();
    });
  }

  /* ══ BLUEPRINT SLIDER ════════════════════════════════════════ */
  var bSlides = document.querySelectorAll('.agp52-blueprint-slide');
  var bIdx    = 0;

  if (bSlides.length) {
    function bShow(idx) {
      bSlides.forEach(function (s) { s.classList.remove('active'); });
      bSlides[idx].classList.add('active');
    }
    document.querySelectorAll('.agp52-blueprint-nav').forEach(function (btn) {
      btn.addEventListener('click', function () {
        bIdx = (bIdx + (btn.classList.contains('next') ? 1 : -1) + bSlides.length) % bSlides.length;
        bShow(bIdx);
      });
    });
  }

  /* ══ SCROLL REVEAL ═══════════════════════════════════════════ */
  var revealEls = document.querySelectorAll('.agp52-reveal');
  if ('IntersectionObserver' in window) {
    var ro = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('visible'); ro.unobserve(en.target); }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(function (el) { ro.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('visible'); });
  }

  /* ══ NAVBAR SCROLL ═══════════════════════════════════════════ */
  var nav = document.getElementById('agp52-nav');
  if (nav) {
    window.addEventListener('scroll', function () {
      nav.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ══ BOOM BAR ANIMATION ══════════════════════════════════════ */
  document.querySelectorAll('.agp52-boom__comparison-fill').forEach(function (bar) {
    var w = bar.getAttribute('data-width') || '0%';
    bar.style.width = '0%';
    setTimeout(function () { bar.style.width = w; }, 400);
  });

});
</script>
<!-- LIGHTBOX — вынесен в конец body чтобы position:fixed работал на весь экран -->
<div class="agp52-lightbox" id="agp52Lightbox">
  <span class="agp52-lightbox-close">&times;</span>
  <button class="agp52-lightbox__nav agp52-lightbox__prev" id="agp52LbPrev">&#8249;</button>
  <div class="agp52-lightbox__frame">
    <img class="agp52-lightbox-img" id="agp52LightboxImg" src="" alt="">
  </div>
  <button class="agp52-lightbox__nav agp52-lightbox__next" id="agp52LbNext">&#8250;</button>
  <div class="agp52-lightbox__counter" id="agp52LbCounter">1 / 2</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
