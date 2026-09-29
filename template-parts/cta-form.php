<section class="cta-form" id="cta-form">
  <div class="container cta-form__inner">
    <div class="cta-form__image">
    <?php
$cta_img_path = INGI_DIR . '/assets/images/cta-railway.jpg';
$cta_img_url  = INGI_URI . '/assets/images/cta-railway.jpg';
if ( file_exists( $cta_img_path ) ) : ?>
  <img src="<?php echo esc_url( $cta_img_url ); ?>" alt="Железная дорога">
<?php endif; ?>
    </div>
    <div class="cta-form__content">
      <h2 class="cta-form__title">
        Оставьте заявку<br>
        на <span class="accent">индивидуальные</span> условия сотрудничества!
      </h2>

      <form class="cta-form__form js-ingi-form" method="post">
        <p class="cta-form__note">
          Мы предложим самые выгодные цены и надежное, а также оперативное решение самых сложных задач
        </p>

        <label class="field">
          <span class="field__label">ИНН организации</span>
          <input type="text" name="inn" class="field__input">
        </label>

        <label class="field">
          <span class="field__label">Имя</span>
          <input type="text" name="name" class="field__input" autocomplete="name">
        </label>

        <label class="field">
          <span class="field__label">Номер телефона *</span>
          <input type="tel" name="phone" class="field__input" required autocomplete="tel">
        </label>

        <label class="checkbox">
          <input type="checkbox" name="agree" value="1" checked>
          <span class="checkbox__box"></span>
          <span class="checkbox__text">Даю согласие на <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">обработку персональных данных</a></span>
        </label>

        <button type="submit" class="btn btn--orange btn--block">Отправить запрос</button>
        <div class="js-ingi-form-msg form-msg" aria-live="polite"></div>
      </form>
    </div>
  </div>
</section>