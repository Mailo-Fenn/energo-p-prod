<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');

// Общий подсчет количества товаров
$totalQuantity = 0;

if (!$compositeStub && !empty($arResult['CATEGORIES']['READY'])) {
    foreach ($arResult['CATEGORIES']['READY'] as $item) {
        $totalQuantity += (int)$item['QUANTITY'];
    }
}
?>

<a class="main-header__cart" href="/cart/">
    <div class="main-header__cart-icon">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/cart.png" alt="">

        <span><?= $totalQuantity ?></span>
    </div>

    <div class="main-header__cart-content">
        <span>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . 'include/header/main_header__cart_content.php'
                )
            ); ?>
        </span>

        <strong><?= !empty($arResult['TOTAL_PRICE']) ? $arResult['TOTAL_PRICE'] : ' ' ?></strong>
    </div>
</a>
