<?php
/**
 * Глобальная модалка «Оставить заявку».
 *
 * @package IngiGroup
 */
?>

<div class="modal-callback" id="modal-callback" aria-hidden="true">
    <div class="modal-callback__overlay" data-modal-close></div>

    <div class="modal-callback__dialog" role="dialog" aria-modal="true" aria-labelledby="modal-callback-title">
        <button type="button" class="modal-callback__close" data-modal-close aria-label="Закрыть">×</button>

        <div class="modal-callback__head">
            <h3 class="modal-callback__title" id="modal-callback-title">Оставить заявку</h3>
        </div>

        <form class="modal-callback__form js-ingi-form" novalidate>
            <div class="modal-callback__field">
                <label for="modal-callback-name">Имя</label>
                <input type="text" id="modal-callback-name" name="name" autocomplete="name">
            </div>

            <div class="modal-callback__field">
                <label for="modal-callback-phone">Номер телефона <span class="modal-callback__req">*</span></label>
                <input type="tel" id="modal-callback-phone" name="phone" required autocomplete="tel" data-required="1">
            </div>

            <label class="modal-callback__consent">
                <input type="checkbox" name="agree" value="1" required data-required="1" class="js-ingi-privacy">
                <span>Даю согласие на <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>" target="_blank" rel="noopener">обработку персональных данных</a></span>
            </label>

            <input type="hidden" name="inn" value="">
            <input type="hidden" name="form_source" value="modal-callback">

            <button type="submit" class="modal-callback__submit">Отправить</button>

            <div class="modal-callback__status js-ingi-form-msg" aria-live="polite"></div>
        </form>
    </div>
</div>