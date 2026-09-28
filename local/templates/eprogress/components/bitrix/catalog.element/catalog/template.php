<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers) {
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
	'STICKER_ID' => $mainId . '_sticker',
	'BIG_SLIDER_ID' => $mainId . '_big_slider',
	'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId . '_slider_cont',
	'OLD_PRICE_ID' => $mainId . '_old_price',
	'PRICE_ID' => $mainId . '_price',
	'DESCRIPTION_ID' => $mainId . '_description',
	'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
	'PRICE_TOTAL' => $mainId . '_price_total',
	'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
	'QUANTITY_ID' => $mainId . '_quantity',
	'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
	'QUANTITY_UP_ID' => $mainId . '_quant_up',
	'QUANTITY_MEASURE' => $mainId . '_quant_measure',
	'QUANTITY_LIMIT' => $mainId . '_quant_limit',
	'BUY_LINK' => $mainId . '_buy_link',
	'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
	'COMPARE_LINK' => $mainId . '_compare_link',
	'TREE_ID' => $mainId . '_skudiv',
	'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
	'OFFER_GROUP' => $mainId . '_set_group_',
	'BASKET_PROP_DIV' => $mainId . '_basket_prop',
	'SUBSCRIBE_LINK' => $mainId . '_subscribe',
	'TABS_ID' => $mainId . '_tabs',
	'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
	'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

if ($haveOffers) {
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer) {
		if ($offer['MORE_PHOTO_COUNT'] > 1) {
			$showSliderControls = true;
			break;
		}
	}
} else {
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer) {
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);
$productType = $arResult['PRODUCT']['TYPE'];

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE) {
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
} else {
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
}

$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}
?>
<div class="card-sect__main bx-<?= $arParams['TEMPLATE_THEME'] ?>" id="<?= $itemIds['ID'] ?>" itemscope itemtype="http://schema.org/Product">
	<div class="card-sect__sliders" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
		<? if ($showSliderControls): ?>
			<? if ($haveOffers): ?>
				<? foreach ($arResult['OFFERS'] as $keyOffer => $offer): ?>
					<? if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0): ?>
						<? continue; ?>
					<? endif; ?>

					<? $strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none'; ?>

					<div class="card-sect__tslider" id="<?= $itemIds['SLIDER_CONT_OF_ID'] . $offer['ID'] ?>" style="display: <?= $strVisible ?>;">
						<div class="swiper">
							<div class="swiper-wrapper">
								<? foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo): ?>
									<div class="swiper-slide">
										<img src="<?= $photo['SRC'] ?>">
									</div>
								<? endforeach; ?>
							</div>
						</div>

						<div class="card-sect__tslider-prev">
							<svg width="10px" height="9px">
								<g id="card-arrow">
									<path fill-rule="evenodd" d="M4.502,6.883 C4.531,6.826 4.521,6.786 4.521,6.748 C4.522,4.679 4.522,2.612 4.521,0.544 C4.521,0.472 4.522,0.401 4.542,0.332 C4.602,0.117 4.811,-0.024 5.049,-0.011 C5.278,0.002 5.467,0.167 5.499,0.387 C5.507,0.442 5.508,0.498 5.508,0.553 C5.509,2.618 5.509,4.683 5.509,6.748 C5.509,6.786 5.500,6.827 5.523,6.872 C5.553,6.845 5.581,6.822 5.607,6.797 C6.597,5.844 7.587,4.892 8.577,3.940 C8.763,3.761 9.013,3.729 9.215,3.857 C9.461,4.012 9.513,4.333 9.327,4.552 C9.313,4.569 9.298,4.585 9.282,4.600 C7.979,5.853 6.677,7.106 5.374,8.359 C5.226,8.501 5.050,8.539 4.852,8.481 C4.774,8.457 4.710,8.411 4.653,8.356 C3.348,7.100 2.043,5.846 0.739,4.589 C0.528,4.386 0.526,4.095 0.727,3.904 C0.927,3.714 1.227,3.722 1.440,3.926 C2.433,4.880 3.425,5.835 4.417,6.790 C4.444,6.816 4.468,6.845 4.502,6.883 Z" />
								</g>
							</svg>
						</div>

						<div class="card-sect__tslider-next">
							<svg width="10px" height="9px">
								<use xlink:href="#card-arrow"></use>
							</svg>
						</div>
					</div>
				<? endforeach; ?>
			<? else: ?>
				<div class="card-sect__tslider" id="<?= $itemIds['SLIDER_CONT_ID'] ?>">
					<div class="swiper">
						<div class="swiper-wrapper">
							<? if (!empty($actualItem['MORE_PHOTO'])): ?>
								<? foreach ($actualItem['MORE_PHOTO'] as $key => $photo): ?>
									<div class="swiper-slide">
										<img src="<?= $photo['SRC'] ?>">
									</div>
								<? endforeach; ?>
							<? endif; ?>
						</div>
					</div>

					<div class="card-sect__tslider-prev">
						<svg width="10px" height="9px">
							<g id="card-arrow">
								<path fill-rule="evenodd" d="M4.502,6.883 C4.531,6.826 4.521,6.786 4.521,6.748 C4.522,4.679 4.522,2.612 4.521,0.544 C4.521,0.472 4.522,0.401 4.542,0.332 C4.602,0.117 4.811,-0.024 5.049,-0.011 C5.278,0.002 5.467,0.167 5.499,0.387 C5.507,0.442 5.508,0.498 5.508,0.553 C5.509,2.618 5.509,4.683 5.509,6.748 C5.509,6.786 5.500,6.827 5.523,6.872 C5.553,6.845 5.581,6.822 5.607,6.797 C6.597,5.844 7.587,4.892 8.577,3.940 C8.763,3.761 9.013,3.729 9.215,3.857 C9.461,4.012 9.513,4.333 9.327,4.552 C9.313,4.569 9.298,4.585 9.282,4.600 C7.979,5.853 6.677,7.106 5.374,8.359 C5.226,8.501 5.050,8.539 4.852,8.481 C4.774,8.457 4.710,8.411 4.653,8.356 C3.348,7.100 2.043,5.846 0.739,4.589 C0.528,4.386 0.526,4.095 0.727,3.904 C0.927,3.714 1.227,3.722 1.440,3.926 C2.433,4.880 3.425,5.835 4.417,6.790 C4.444,6.816 4.468,6.845 4.502,6.883 Z" />
							</g>
						</svg>
					</div>

					<div class="card-sect__tslider-next">
						<svg width="10px" height="9px">
							<use xlink:href="#card-arrow"></use>
						</svg>
					</div>
				</div>
			<? endif; ?>
		<? endif; ?>

		<div class="card-sect__slider" data-entity="images-container">
			<div class="swiper">
				<div class="swiper-wrapper">
					<? if (!empty($actualItem['MORE_PHOTO'])): ?>
						<? foreach ($actualItem['MORE_PHOTO'] as $key => $photo): ?>
							<a class="swiper-slide" href="<?= $photo['SRC'] ?>" data-fancybox="card">
								<img src="<?= $photo['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>">
							</a>
						<? endforeach; ?>
					<? endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="card-sect__content">
		<? if ($arParams['DISPLAY_NAME'] === 'Y'): ?>
			<div class="card-sect__title"><?= $name ?></div>
		<? endif; ?>

		<div class="card-sect__price" id="<?= $itemIds['PRICE_ID'] ?>"><?= $price['PRINT_RATIO_PRICE'] ?></div>

		<? if ($actualItem['CAN_BUY']): ?>
			<div class="card-sect__ctrls">
				<div class="prods-sect__slide-count">
					<button id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>">-</button>

					<input id="<?= $itemIds['QUANTITY_ID'] ?>" type="number" value="<?= $price['MIN_QUANTITY'] ?>">

					<button id="<?= $itemIds['QUANTITY_UP_ID'] ?>">+</button>
				</div>

				<?php
				$APPLICATION->IncludeComponent(
					'bitrix:catalog.product.subscribe',
					'',
					array(
						'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
						'PRODUCT_ID' => $arResult['ID'],
						'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
						'BUTTON_CLASS' => 'def-btn def-btn--trsp card-sect__add',
						'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
						'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>

				<button class="def-btn def-btn--trsp card-sect__add">ДОБАВИТЬ В КОРЗИНУ</button>
			</div>

			<script>
				document.querySelector('.card-sect__add').addEventListener('click', e => {
					e.preventDefault();

					fetch('/ajax/cart_add.php', {
							method: "POST",
							headers: {
								'Content-Type': 'application/json;charset=utf-8'
							},
							body: JSON.stringify({
								AJAX: 'Y',
								PRODUCT_ID: <?=$arResult['ID']?>,
								QUANTITY: document.querySelector('.prods-sect__slide-count input').value,
							})
						})
						.then(response => response.json())
						.then(result => {
							if (result.STATUS == 'SUCCESS') {
								document.querySelector('.main-header__cart-content strong').innerHTML = result.TOTAL_CART_SUM;
								document.querySelector('.main-header__cart-icon span').innerHTML = result.TOTAL_QUANTITY;
							}
						})
				});
			</script>
		<? endif; ?>

		<div data-entity="main-button-container">
			<div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;">
				<? if ($showAddBtn): ?>
					<div class="product-item-detail-info-container">
						<a class="btn <?= $showButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['ADD_BASKET_LINK'] ?>"
							href="javascript:void(0);">
							<span><?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?></span>
						</a>
					</div>
				<? endif; ?>
			</div>

			<? if ($showSubscribe): ?>
				<div class="product-item-detail-info-container">
					<? $APPLICATION->IncludeComponent(
						'bitrix:catalog.product.subscribe',
						'',
						array(
							'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
							'PRODUCT_ID' => $arResult['ID'],
							'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
							'BUTTON_CLASS' => 'btn btn-default product-item-detail-buy-button',
							'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
							'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					); ?>
				</div>
			<? endif; ?>

			<div class="product-item-detail-info-container">
				<a class="btn btn-link product-item-detail-buy-button" id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>"
					href="javascript:void(0)"
					rel="nofollow" style="display: <?= (!$actualItem['CAN_BUY'] ? '' : 'none') ?>;">
					<?= $arParams['MESS_NOT_AVAILABLE'] ?>
				</a>
			</div>
		</div>

		<hr>

		<div class="card-sect__desc">
			<div class="card-sect__desc-title"><?= $arParams['MESS_DESCRIPTION_TAB'] ?></div>

			<p><?= $arResult['DETAIL_TEXT'] ?></p>
		</div>

		<hr>

		<div class="card-sect__desc">
			<div class="card-sect__desc-title"><?= $arParams['MESS_PROPERTIES_TAB'] ?></div>

			<div class="card-sect__table">
				<? foreach ($arResult['DISPLAY_PROPERTIES'] as $property): ?>
					<div class="card-sect__table-row">
						<div><?= $property['NAME'] ?></div>
						<span>
							<?= (
								is_array($property['DISPLAY_VALUE'])
								? implode(' / ', $property['DISPLAY_VALUE'])
								: $property['DISPLAY_VALUE']
							) ?>
						</span>
					</div>
				<? endforeach; ?>

				<? unset($property); ?>
			</div>
		</div>
	</div>


	<meta itemprop="name" content="<?= $name ?>" />
	<meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>" />
	<?php
	if ($haveOffers) {
		foreach ($arResult['JS_OFFERS'] as $offer) {
			$currentOffersList = array();

			if (!empty($offer['TREE']) && is_array($offer['TREE'])) {
				foreach ($offer['TREE'] as $propName => $skuId) {
					$propId = (int)mb_substr($propName, 5);

					foreach ($skuProps as $prop) {
						if ($prop['ID'] == $propId) {
							foreach ($prop['VALUES'] as $propId => $propValue) {
								if ($propId == $skuId) {
									$currentOffersList[] = $propValue['NAME'];
									break;
								}
							}
						}
					}
				}
			}

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
	?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="sku" content="<?= htmlspecialcharsbx(implode('/', $currentOffersList)) ?>" />
				<meta itemprop="price" content="<?= $offerPrice['RATIO_PRICE'] ?>" />
				<meta itemprop="priceCurrency" content="<?= $offerPrice['CURRENCY'] ?>" />
				<link itemprop="availability" href="http://schema.org/<?= ($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>" />
			</span>
		<?php
		}

		unset($offerPrice, $currentOffersList);
	} else {
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?= $price['RATIO_PRICE'] ?>" />
			<meta itemprop="priceCurrency" content="<?= $price['CURRENCY'] ?>" />
			<link itemprop="availability" href="http://schema.org/<?= ($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>" />
		</span>
	<?php
	}
	?>
</div>

<div class="why-sect__disc lazy" data-bg="<?= SITE_TEMPLATE_PATH ?>/img/why-bg-1.jpg">
	<div class="why-sect__disc-icon">
		<img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/proc.png" alt="">
	</div>

	<div class="why-sect__disc-content">
		<div class="why-sect__disc-title">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . 'include/card/why_sect__disc_title.php'
				)
			); ?>
		</div>

		<div class="why-sect__disc-text">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . 'include/card/why_sect__disc_text.php'
				)
			); ?>
		</div>
	</div>

	<a class="def-btn def-btn--white why-sect__disc-btn" href="#">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR . 'include/card/why_sect__disc_btn.php'
			)
		); ?>
	</a>
</div>
<?php
if ($haveOffers) {
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS']) {
			if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
					$current = '<dt>' . $property['NAME'] . '</dt><dd>' . (
						is_array($property['VALUE'])
						? implode(' / ', $property['VALUE'])
						: $property['VALUE']
					) . '</dd>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
			$strPriceRangesRatio = '(' . Loc::getMessage(
				'CT_BCE_CATALOG_RATIO_PRICE',
				array('#RATIO#' => ($useRatio
					? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
					: '1'
				) . ' ' . $measureName)
			) . ')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
				if ($range['HASH'] !== 'ZERO-INF') {
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
							break;
						}
					}

					if ($itemPrice) {
						$strPriceRanges .= '<dt>' . Loc::getMessage(
							'CT_BCE_CATALOG_RANGE_FROM',
							array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
						) . ' ';

						if (is_infinite($range['SORT_TO'])) {
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						} else {
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null,
			'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
			'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
		),
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH'],
			'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
			'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
			'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
			'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
} else {
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
?>
		<div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
			<?php
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
			?>
					<input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
				<?php
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties) {
				?>
				<table>
					<?php
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
					?>
						<tr>
							<td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
							<td>
								<?php
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								) {
									foreach ($propInfo['VALUES'] as $valueId => $value) {
								?>
										<label>
											<input type="radio" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
												value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? 'checked' : '') ?>>
											<?= $value ?>
										</label>
										<br>
									<?php
									}
								} else {
									?>
									<select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
										<?php
										foreach ($propInfo['VALUES'] as $valueId => $value) {
										?>
											<option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? 'selected' : '') ?>>
												<?= $value ?>
											</option>
										<?php
										}
										?>
									</select>
								<?php
								}
								?>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			<?php
			}
			?>
		</div>
<?php
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE']) {
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}

$jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
	$arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"];

?>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?= GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2') ?>',
		TITLE_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
		BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_SEND_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS') ?>',
		BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
		BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
		TITLE_SUCCESSFUL: '<?= GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK') ?>',
		COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
		COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
		COMPARE_TITLE: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
		PRODUCT_GIFT_LABEL: '<?= GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
		PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX') ?>',
		RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
		RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
		SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
	});

	var <?= $obName ?> = new JCCatalogElement(<?= CUtil::PhpToJSObject($jsParams, false, true) ?>);
</script>
<?php
unset($actualItem, $itemIds, $jsParams);
