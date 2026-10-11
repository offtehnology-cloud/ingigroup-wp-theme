<?php
/**
 * Template Name: Услуга — Аренда РСП
 *
 * Шаблон страницы «Аренда РСП» (/rent)
 * Подхватывается WP автоматически по слагу + доступен в дропдауне «Шаблон».
 */
get_header();

$theme_uri = get_template_directory_uri();
?>

<!-- HERO -->
<section class="service-hero">
	<div class="service-hero__bg">
		<img src="<?php echo esc_url( $theme_uri . '/assets/images/rent-hero.jpg' ); ?>" alt="">
	</div>
	<div class="service-hero__inner">
		<div class="service-hero__content">
			<h1 class="service-hero__title">Аренда страховочных<br>рельсовых пакетов</h1>
			<button type="button" class="service-hero__btn js-open-callback">Оставить заявку</button>
		</div>
	</div>
</section>

<!-- ХЛЕБНЫЕ КРОШКИ (ниже hero) -->
<div class="container">
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
</div>

<!-- КОМПЛЕКТАЦИЯ -->
<section class="rent-page__section">
	<div class="container">
		<h2 class="rent-page__h2">Комплектация страховочных пакетов</h2>
		<p class="rent-page__lead">Страховочные пакеты выступают в качестве защиты пути в случае разрушения земляного полотна железной дороги.</p>

		<div class="rent-specs__grid">

			<!-- 12,5 м -->
			<div class="rent-specs__col">
				<h3 class="rent-specs__col-title">Страховочный пакет 12,5 метров</h3>
				<p class="rent-specs__weight">Общий вес комплекта — 13 353,80 кг</p>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Рельс Р50</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Рельс Р50</td><td>12</td><td>7650</td><td>637,5</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Полушпала</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Полушпала</td><td>46</td><td>4236,6</td><td>92,1</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Хомут</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Полушпала</td><td>184</td><td>1090,2</td><td>5,925</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Болт клеммный в сборе М22×75</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Болт клеммный</td><td>92</td><td>29,9</td><td>0,325</td></tr>
							<tr><td>Клемма</td><td>92</td><td>56,58</td><td>0,615</td></tr>
							<tr><td>Гровер</td><td>92</td><td>11,04</td><td>0,12</td></tr>
							<tr><td>Болт М24×80</td><td>92</td><td>10,58</td><td>0,115</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Болт М24×160</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Болт М24×160</td><td>368</td><td>241,04</td><td>0,655</td></tr>
							<tr><td>Гайка М22</td><td>368</td><td>42,32</td><td>0,115</td></tr>
							<tr><td>Гровер</td><td>368</td><td>44,16</td><td>0,12</td></tr>
							<tr><td>Шайба</td><td>368</td><td>11,04</td><td>0,03</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Отбойник</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Отбойник</td><td>8</td><td>9</td><td>1,125</td></tr>
						</tbody>
					</table>
				</div>
			</div>

			<!-- 25 м -->
			<div class="rent-specs__col">
				<h3 class="rent-specs__col-title">Страховочный пакет 25 метров</h3>
				<p class="rent-specs__weight">Общий вес комплекта — 26 698,61 кг</p>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Рельс Р50</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Рельс Р50</td><td>24</td><td>15300</td><td>637,5</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Полушпала</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Полушпала</td><td>92</td><td>8473,2</td><td>92,1</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Хомут</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Полушпала</td><td>368</td><td>2180,4</td><td>5,925</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Болт клеммный в сборе М22×75</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Болт клеммный</td><td>184</td><td>59,8</td><td>0,325</td></tr>
							<tr><td>Клемма</td><td>184</td><td>113,16</td><td>0,615</td></tr>
							<tr><td>Гровер</td><td>184</td><td>22,08</td><td>0,12</td></tr>
							<tr><td>Болт М24×80</td><td>184</td><td>21,16</td><td>0,115</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Болт М24×160</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Болт М24×160</td><td>736</td><td>482,08</td><td>0,655</td></tr>
							<tr><td>Гайка М22</td><td>736</td><td>84,64</td><td>0,115</td></tr>
							<tr><td>Гровер</td><td>736</td><td>88,32</td><td>0,12</td></tr>
							<tr><td>Шайба</td><td>736</td><td>22,08</td><td>0,03</td></tr>
						</tbody>
					</table>
				</div>

				<div class="rent-specs__table-block">
					<div class="rent-specs__table-title">Отбойник</div>
					<table class="rent-specs__table">
						<thead>
							<tr><th>Состав</th><th>Количество, шт</th><th>Вес, кг</th><th>Вес за единицу, кг</th></tr>
						</thead>
						<tbody>
							<tr><td>Отбойник</td><td>8</td><td>9</td><td>1,125</td></tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- ДОПОЛНИТЕЛЬНЫЕ УСЛУГИ -->
<section class="rent-page__section rent-page__section--grey">
	<div class="container">
		<h2 class="rent-page__h2">Дополнительные услуги</h2>
		<p class="rent-page__lead">Перечень дополнительных услуг, которые необходимы для полной реализации задачи.</p>

		<div class="rent-extra__grid">
			<div class="rent-extra__col">
				<h3 class="rent-extra__title">Страховочный пакет 12,5 метров</h3>
				<ul class="rent-extra__list">
					<li class="rent-extra__item">
						<span class="rent-extra__text">Разработка и согласование документации в ОАО «РЖД»</span>
						<span class="rent-extra__mark rent-extra__mark--check" aria-label="включено"></span>
					</li>
					<li class="rent-extra__item">
						<span class="rent-extra__text">Монтаж/демонтаж страховочных пакетов (бригада из 6-10 человек)</span>
						<span class="rent-extra__mark rent-extra__mark--check" aria-label="включено"></span>
					</li>
					<li class="rent-extra__item">
						<span class="rent-extra__text">Алюмотермитная сварка рельс</span>
						<span class="rent-extra__mark rent-extra__mark--na">не требуется</span>
					</li>
				</ul>
			</div>

			<div class="rent-extra__col">
				<h3 class="rent-extra__title">Страховочный пакет 25 метров</h3>
				<ul class="rent-extra__list">
					<li class="rent-extra__item">
						<span class="rent-extra__text">Разработка и согласование документации в ОАО «РЖД»</span>
						<span class="rent-extra__mark rent-extra__mark--check" aria-label="включено"></span>
					</li>
					<li class="rent-extra__item">
						<span class="rent-extra__text">Монтаж/демонтаж страховочных пакетов (бригада из 6-10 человек)</span>
						<span class="rent-extra__mark rent-extra__mark--check" aria-label="включено"></span>
					</li>
					<li class="rent-extra__item">
						<span class="rent-extra__text">Алюмотермитная сварка рельс</span>
						<span class="rent-extra__mark rent-extra__mark--req">требуется</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- УСЛОВИЯ САМОВЫВОЗА -->
<section class="rent-page__section">
	<div class="container">
		<h2 class="rent-page__h2">Условия самовывоза</h2>
		<p class="rent-page__lead">Для самовывоза необходимо два страховочных пакета, один автокран и фура с верхней загрузкой.</p>

		<div class="rent-pickup__grid">

			<div class="rent-pickup__item">
				<div class="rent-pickup__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
						<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="rgb(242, 151, 71)" fill-rule="nonzero" opacity="0.3"></path>
						<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="rgb(242, 151, 71)" fill-rule="nonzero"></path>
					</svg>
				</div>
				<p class="rent-pickup__text">Два страховочных пакета для погрузки/разгрузки</p>
			</div>

			<div class="rent-pickup__item">
				<div class="rent-pickup__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="rgb(242, 151, 71)" aria-hidden="true">
						<g transform="scale(0.78) translate(4.230769230769229, 4.230769230769229)">
							<g>
								<path d="M26.5,19.5h-1.7l-2.9-5.7c-0.1-0.1-0.2-0.2-0.3-0.3l-4-1c-0.3-0.1-0.5,0.1-0.6,0.3l-1.9,6.6h-2.6c-0.3,0-0.5,0.2-0.5,0.5 s0.2,0.5,0.5,0.5h3c0,0,0,0,0,0c0,0,0,0,0,0h11c0.3,0,0.5-0.2,0.5-0.5S26.8,19.5,26.5,19.5z"></path>
								<path d="M2.1,13.5c0.5,0,1-0.2,1.4-0.7C3.8,12.4,4,11.7,4,11c0-0.3-0.2-0.5-0.5-0.5S3,10.7,3,11c0,0.5-0.1,0.9-0.3,1.2 C2.2,12.8,1,12.4,1,11V4.7l3.9,1.6l1.2-4.9L0.6,0.5c-0.1,0-0.3,0-0.4,0.1S0,0.9,0,1v2.1V4v7C0,12.6,1.1,13.5,2.1,13.5z"></path>
								<polygon points="5.3,18.5 8,18.5 8,15.5 6.8,15.5 "></polygon>
								<path d="M26.5,22.5h-3h-7h-3.4L11,21.7V13c0-0.3-0.2-0.5-0.5-0.5h-5c-0.2,0-0.3,0.1-0.4,0.2l-4,5C1,17.8,1,17.9,1,18v4.5H0.5 C0.2,22.5,0,22.7,0,23v2c0,0.3,0.2,0.5,0.5,0.5h0.6c0.2,0,0.3-0.1,0.4-0.2c0.6-1.1,1.8-1.8,3-1.8s2.4,0.7,3,1.8 c0.1,0.2,0.3,0.2,0.4,0.2h5.1c0.2,0,0.3-0.1,0.4-0.2c0.6-1.1,1.8-1.8,3-1.8s2.4,0.7,3,1.8c0.1,0.2,0.3,0.2,0.4,0.2h0.1 c0.2,0,0.3-0.1,0.4-0.2c0.6-1.1,1.8-1.8,3-1.8c1,0,2,0.4,2.6,1.2c0.1,0.1,0.2,0.2,0.4,0.2c0.1,0,0.1,0,0.2,0 c0.2-0.1,0.3-0.3,0.3-0.5V23C27,22.7,26.8,22.5,26.5,22.5z M9,19c0,0.3-0.2,0.5-0.5,0.5h-4c-0.2,0-0.3-0.1-0.4-0.2 c-0.1-0.1-0.1-0.3,0-0.5l2-4c0.1-0.2,0.3-0.3,0.4-0.3h2C8.8,14.5,9,14.7,9,15C9,15,9,19,9,19z"></path>
								<path d="M29.7,9.5L7.1,1.7L5.9,6.6l22.5,6.8c0,0,0.1,0,0.1,0c0.2,0,0.4-0.1,0.5-0.3l1-3C30.1,9.9,29.9,9.6,29.7,9.5z"></path>
								<circle cx="4.5" cy="27" r="2.5"></circle>
								<circle cx="16.5" cy="27" r="2.5"></circle>
								<circle cx="23.5" cy="27" r="2.5"></circle>
							</g>
						</g>
					</svg>
				</div>
				<p class="rent-pickup__text">Один автокран для погрузки/выгрузки страховочных пакетов</p>
			</div>

			<div class="rent-pickup__item">
				<div class="rent-pickup__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="rgb(242, 151, 71)" aria-hidden="true">
						<g transform="scale(0.78) translate(4.230769230769229, 4.230769230769229)">
							<g>
								<g>
									<path d="M27.92,13.188L26.98,9.9c-0.34-1.663-1.852-3.273-3.518-3.747c-0.253-0.073-0.514,0.062-0.604,0.305l-2.575,6.866 c-0.001,0.002,0,0.004-0.001,0.006c0,0.001-0.001,0.001-0.001,0.002l-1.386,3.695c-0.257,0.683-1.005,1.098-1.727,0.939 L3.472,14.97c-0.116-0.024-0.242-0.007-0.35,0.051l-1.876,1.042c-0.137,0.076-0.23,0.212-0.252,0.368 c-0.022,0.156,0.03,0.312,0.142,0.423l1.853,1.853c-0.616,0.77-1,1.733-1,2.793c0,2.481,2.019,4.5,4.5,4.5 c2.31,0,4.197-1.756,4.449-4h7.101c0.252,2.244,2.139,4,4.449,4s4.197-1.756,4.449-4h2.551c0.275,0,0.499-0.223,0.5-0.498 L30.009,16C30.011,14.683,29.129,13.576,27.92,13.188z M6.49,24c-1.379,0-2.5-1.122-2.5-2.5S5.111,19,6.49,19 c1.379,0,2.5,1.122,2.5,2.5S7.869,24,6.49,24z M22.49,24c-1.379,0-2.5-1.122-2.5-2.5s1.121-2.5,2.5-2.5c1.379,0,2.5,1.122,2.5,2.5 S23.869,24,22.49,24z M21.473,13l2.148-5.728c1.141,0.506,2.144,1.675,2.389,2.865L26.827,13H21.473z M22.49,20 c-0.828,0-1.5,0.672-1.5,1.5s0.672,1.5,1.5,1.5s1.5-0.672,1.5-1.5S23.319,20,22.49,20z M6.49,20c-0.828,0-1.5,0.672-1.5,1.5 S5.662,23,6.49,23s1.5-0.672,1.5-1.5S7.319,20,6.49,20z M1.384,13.488l16,3.5C17.419,16.996,17.455,17,17.49,17 c0.205,0,0.394-0.126,0.468-0.324L22.337,5h3.153c0.276,0,0.5-0.224,0.5-0.5S25.766,4,25.49,4h-25 C0.347,4,0.212,4.061,0.116,4.168c-0.095,0.106-0.14,0.249-0.122,0.391l1,8.5C1.018,13.27,1.175,13.443,1.384,13.488z M14.352,6.019c0.269-0.074,0.543,0.079,0.618,0.344l2,7c0.076,0.265-0.077,0.542-0.343,0.618C16.581,13.994,16.534,14,16.489,14 c-0.218,0-0.418-0.143-0.48-0.363l-2-7C13.933,6.372,14.087,6.095,14.352,6.019z M9.343,6.022c0.27-0.081,0.545,0.067,0.625,0.331 l2,6.5c0.082,0.264-0.066,0.543-0.33,0.625c-0.05,0.015-0.099,0.022-0.147,0.022c-0.214,0-0.412-0.138-0.478-0.353l-2-6.5 C8.93,6.383,9.079,6.104,9.343,6.022z M4.392,6.51C4.65,6.453,4.925,6.63,4.98,6.902l1,5c0.055,0.271-0.121,0.534-0.393,0.588 c-0.032,0.007-0.065,0.01-0.099,0.01c-0.233,0-0.441-0.164-0.489-0.402l-1-5C3.945,6.827,4.121,6.564,4.392,6.51z"></path>
								</g>
							</g>
						</g>
					</svg>
				</div>
				<p class="rent-pickup__text">Фура с верхней загрузкой<br>12,5 метров — 13,4 т<br>25 метров — 26,7 т</p>
			</div>

		</div>
	</div>
</section>

<!-- ВОПРОС-ОТВЕТ -->
<section class="rent-page__section">
	<div class="container">
		<h2 class="rent-page__h2">Вопрос-ответ</h2>
		<p class="rent-faq__lead">Ответили на самые популярные вопросы по теме страховочных рельсовых пакетов. Не нашли ответа на свой вопрос? Свяжитесь с нами по почте или телефону для консультации.</p>

		<div class="rent-faq__list">

			<details class="rent-faq__item" open>
				<summary class="rent-faq__q">
					<span class="rent-faq__icon" aria-hidden="true"></span>
					<span class="rent-faq__q-text">Как арендовать страховочный рельсовый пакет?</span>
				</summary>
				<div class="rent-faq__a">
					<p>Двадцати пяти метровую конструкцию предоставляем в аренду только с дополнительной услугой по алюминотермитной сварке, или в составе комплексной работы «под ключ». Это обусловлено тем, что рельсы в пакетах 25 метров должны быть цельные, а следовательно их необходимо сварить алюминотермитным способом. Мы не доверяем данную процедуру подрядным организациям, по сколько испортить рельсы при производстве данного вида работ очень просто. Свои рельсы мы свариваем только своей рабочей группой.</p>
				</div>
			</details>

			<details class="rent-faq__item">
				<summary class="rent-faq__q">
					<span class="rent-faq__icon" aria-hidden="true"></span>
					<span class="rent-faq__q-text">Какой стандартный срок аренды страховочного пакета?</span>
				</summary>
				<div class="rent-faq__a">
					<p>Базово, по договору, срок аренды составляет 30 календарных дней. Срок может быть увеличен, если вам нужно больше времени на проведение своих работ под железной дорогой. На этот случай составляется дополнительное соглашение о продлении срока аренды.</p>
				</div>
			</details>

			<details class="rent-faq__item">
				<summary class="rent-faq__q">
					<span class="rent-faq__icon" aria-hidden="true"></span>
					<span class="rent-faq__q-text">Сколько стоит аренда страховочного пакета?</span>
				</summary>
				<div class="rent-faq__a">
					<p>Прайс-лист на аренду страховочного пакета зависит от нескольких факторов и рассчитывается индивидуально для каждого объекта. Факторы, влияющие на стоимость аренды:</p>
					<ol class="rent-faq__ol">
						<li>Дата начала аренды</li>
						<li>Региона использования</li>
						<li>Срок аренды</li>
						<li>Способ получения (самовывоз или наша доставка)</li>
						<li>Аренда с рельсами или без</li>
					</ol>
				</div>
			</details>

		</div>
	</div>
</section>

<!-- CTA -->
<?php get_template_part( 'template-parts/cta-form' ); ?>

<!-- MAP -->
<?php if ( locate_template( 'template-parts/map.php' ) ) { get_template_part( 'template-parts/map' ); } ?>

<?php get_footer(); ?>