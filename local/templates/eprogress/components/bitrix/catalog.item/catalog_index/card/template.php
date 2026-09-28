<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Sale;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<?
if (Loader::includeModule('sale')) {
	// Принудительно создаем FUser, если его нет
	$fUserId = Sale\Fuser::getId(true);
	$basket = Sale\Basket::loadItemsForFUser($fUserId, SITE_ID);

	$isInBasket = false;

	// Проверяем, находится ли текущий товар в корзине
	foreach ($basket as $basketItem) {
		if ($basketItem->getProductId() == $item['ID']) {
			$isInBasket = true;
			break;
		}
	}
}
?>

<a class="prods-sect__slide-img" href="<?= $item['DETAIL_PAGE_URL'] ?>">
	<img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="">
</a>

<a class="product-item-image-wrapper" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>" data-entity="image-wrapper" style="display: none;">
	<span class="product-item-image-slider-slide-container slide" id="<?= $itemIds['PICT_SLIDER'] ?>" <?= ($showSlider ? '' : 'style="display: none;"') ?> data-slider-interval="<?= $arParams['SLIDER_INTERVAL'] ?>" data-slider-wrap="true">
		<? if ($showSlider): ?>
			<? foreach ($morePhoto as $key => $photo): ?>
				<span class="product-item-image-slide item <?= ($key == 0 ? 'active' : '') ?>" style="background-image: url('<?= $photo['SRC'] ?>');"></span>
			<? endforeach; ?>
		<? endif; ?>
	</span>


	<? if ($item['SECOND_PICT']): ?>
		<? $bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC']; ?>

		<span class="product-item-image-alternative 1" id="<?= $itemIds['SECOND_PICT'] ?>" style="background-image: url('<?= $bgImage ?>'); <?= ($showSlider ? 'display: none;' : '') ?>"></span>
	<? endif; ?>
</a>

<div class="prods-sect__slide-content">
	<a class="prods-sect__slide-title" href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $productTitle ?></a>

	<div class="prods-sect__slide-ctrls">
		<div class="prods-sect__slide-price" data-entity="price-block" id="<?= $itemIds['PRICE'] ?>">
			<?
			if (!empty($price)) {
				if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
					echo Loc::getMessage(
						'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
						array(
							'#PRICE#' => $price['PRINT_RATIO_PRICE'],
							'#VALUE#' => $measureRatio,
							'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
						)
					);
				} else {
					echo $price['PRINT_RATIO_PRICE'];
				}
			}
			?>
		</div>

		<? if (!$haveOffers): ?>
			<? if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY']): ?>
				<div class="prods-sect__slide-count" data-entity="quantity-block">
					<span class="product-item-amount-field-btn-minus no-select" id="<?= $itemIds['QUANTITY_DOWN'] ?>"></span>

					<input id="<?= $itemIds['QUANTITY'] ?>" type="number" name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>" value="<?= $measureRatio ?>">

					<span class="product-item-amount-field-btn-plus no-select" id="<?= $itemIds['QUANTITY_UP'] ?>"></span>
				</div>
			<? endif; ?>
		<? endif; ?>
	</div>

	<div class="prods-sect__slide-footer">
		<? if ($actualItem['CAN_BUY']): ?>
			<div class="prods-sect__slide-cart" data-item-id="<?= $item['ID'] ?>" <?= $isInBasket ? '' : 'style="display: none"' ?>>
				<button class="prods-sect__slide-del" onclick="deleteCartProduct(<?= $item['ID'] ?>)">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/del.png" alt="">
				</button>

				<a class="prods-sect__slide-link" href="<?= SITE_DIR ?>cart/">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR . 'include/index/prods_sect__slide_link.php'
						)
					); ?>
				</a>
			</div>

			<div class="product-item-button-container" data-item-id="<?= $item['ID'] ?>" id="<?= $itemIds['BASKET_ACTIONS'] ?>" <?= $isInBasket ? 'style="display: none"' : '' ?>>
				<a class="def-btn def-btn--trsp prods-sect__slide-add" onclick="addCartProduct(<?= $item['ID'] ?>)" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0)" rel="nofollow">
					<?include $_SERVER['DOCUMENT_ROOT'].'/include/index/prods_sect__slide_add.php';?>
				</a>
			</div>
		<? else: ?>
			<div class="product-item-button-container">
				<? if ($showSubscribe): ?>
					<? $APPLICATION->IncludeComponent(
						'bitrix:catalog.product.subscribe',
						'',
						array(
							'PRODUCT_ID' => $actualItem['ID'],
							'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
							'BUTTON_CLASS' => 'btn btn-default ' . $buttonSizeClass,
							'DEFAULT_DISPLAY' => true,
							'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					); ?>
				<? endif; ?>

				<a class="btn btn-link <?= $buttonSizeClass ?>" id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" href="javascript:void(0)" rel="nofollow">
					<?= $arParams['MESS_NOT_AVAILABLE'] ?>
				</a>
			</div>
		<? endif; ?>
	</div>
</div>

<script>
	function deleteCartProduct(itemId) {
		fetch('/ajax/cart_remove.php', {
				method: "POST",
				headers: {
					'Content-Type': 'application/json;charset=utf-8'
				},
				body: JSON.stringify({
					AJAX: 'Y',
					PRODUCT_ID: itemId,
				})
			})
			.then(response => response.json())
			.then(result => {
				if (result.STATUS == 'SUCCESS') {
					Array.from(document.querySelectorAll(`.prods-sect__slide-cart[data-item-id="${result.ITEM_ID}"]`)).forEach(item => {
						item.style.display = "none";
					})

					Array.from(document.querySelectorAll(`.product-item-button-container[data-item-id="${result.ITEM_ID}"]`)).forEach(item => {
						item.style.display = "block";
					})

					document.querySelector('.main-header__cart-content strong').innerHTML = result.TOTAL_CART_SUM;
					document.querySelector('.main-header__cart-icon span').innerHTML = result.TOTAL_QUANTITY;
				}
			})
	}

	function addCartProduct(itemId) {
		Array.from(document.querySelectorAll(`.prods-sect__slide-cart[data-item-id="${itemId}"]`)).forEach(item => {
			item.style.display = "flex";
		})

		Array.from(document.querySelectorAll(`.product-item-button-container[data-item-id="${itemId}"]`)).forEach(item => {
			item.style.display = "none";
		})
	}
</script>