<?php
/**
 * 404 — Страница не найдена
 *
 * @package ingigroup
 */

get_header();
?>

<main class="error-404-page">
    <div class="container">
        <div class="error-404-page__inner">
            <div class="error-404-page__code">404</div>
            <h1 class="error-404-page__title">Страница не найдена</h1>
            <p class="error-404-page__text">
                Возможно, страница была удалена, переименована
                или вы ошиблись в адресе. Вернитесь на главную —
                там всё на месте.
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404-page__btn">
                На главную
            </a>
        </div>
    </div>
</main>

<?php
get_footer();