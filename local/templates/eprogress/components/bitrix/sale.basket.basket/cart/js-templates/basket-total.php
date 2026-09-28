<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<?
	if ($arParams['HIDE_COUPON'] !== 'Y') {
	?>
		<div class="basket-coupon-section">
			<div class="basket-coupon-block-field">
				<div class="basket-coupon-block-field-description">
					<?= Loc::getMessage('SBB_COUPON_ENTER') ?>:
				</div>
				<div class="form">
					<div class="form-group" style="position: relative;">
						<input type="text" class="form-control" id="" placeholder="" data-entity="basket-coupon-input">
						<span class="basket-coupon-block-coupon-btn"></span>
					</div>
				</div>
			</div>
		</div>
	<?
	}
	?>

	<div class="order-sect__prices">
		<div class="order-sect__price"><span>Общая стоимость</span>
			<div class="basket-coupon-block-total-price-current" data-entity="basket-total-price">
				<strong>{{{PRICE_FORMATED}}}</strong>
			</div>
		</div>
	</div>

	<button class="def-btn order-sect__submit" data-entity="basket-checkout-button">ПЕРЕЙТИ К ОФОРМЛЕНИЮ</button>

	<div class="order-sect__desc">
		<div class="order-sect__desc-icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/info.png" alt=""></div>
		<div class="order-sect__desc-text">Перейдите к оформлению заказа, чтобы выбрать способ оплаты и доставки</div>
	</div>

	<?
	if ($arParams['HIDE_COUPON'] !== 'Y') {
	?>
		<div class="basket-coupon-alert-section">
			<div class="basket-coupon-alert-inner">
				{{#COUPON_LIST}}
					<div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?= Loc::getMessage('SBB_COUPON') ?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
						</span>
						<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?= Loc::getMessage('SBB_DELETE') ?>
						</span>
					</div>
				{{/COUPON_LIST}}
			</div>
		</div>
	<?
	}
	?>
</script>