<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'); ?>

<?
include($_SERVER['DOCUMENT_ROOT'] . $APPLICATION->GetCurDir() . '.section.php');
?>

<div class="order-sect">
    <div class="order-sect__container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrump",
            array(
                "PATH" => "",
                "SITE_ID" => SITE_ID,
                "START_FROM" => "0",
            ),
            false
        ); ?>

        <div class="def-title order-sect__title"><?= $sSectionName ?></div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket",
            "cart",
            array(
                "ACTION_VARIABLE" => "basketAction",
                "ADDITIONAL_PICT_PROP_1" => "-",
                "ADDITIONAL_PICT_PROP_3" => "-",
                "ADDITIONAL_PICT_PROP_4" => "-",
                "ADDITIONAL_PICT_PROP_6" => "-",
                "AUTO_CALCULATION" => "Y",
                "BASKET_IMAGES_SCALING" => "adaptive",
                "BASKET_URL" => "/cart/",
                "COLUMNS_LIST" => array(
                    0 => "NAME",
                    1 => "PRICE",
                    2 => "QUANTITY",
                    3 => "SUM",
                    4 => "DELETE",
                ),
                "COLUMNS_LIST_EXT" => array(
                    0 => "PREVIEW_PICTURE",
                    1 => "DELETE",
                    2 => "SUM",
                ),
                "COLUMNS_LIST_MOBILE" => array(
                    0 => "PREVIEW_PICTURE",
                    1 => "DELETE",
                    2 => "SUM",
                ),
                "COMPATIBLE_MODE" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "CORRECT_RATIO" => "Y",
                "DEFERRED_REFRESH" => "N",
                "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                "DISPLAY_MODE" => "extended",
                "EMPTY_BASKET_HINT_PATH" => "/catalog/",
                "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                "GIFTS_CONVERT_CURRENCY" => "N",
                "GIFTS_HIDE_BLOCK_TITLE" => "N",
                "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                "GIFTS_MESS_BTN_BUY" => "Выбрать",
                "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                "GIFTS_PLACE" => "BOTTOM",
                "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                "GIFTS_SHOW_OLD_PRICE" => "N",
                "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                "HIDE_COUPON" => "Y",
                "LABEL_PROP" => array(),
                "PATH_TO_ORDER" => "/cart/order/",
                "PRICE_DISPLAY_MODE" => "N",
                "PRICE_VAT_SHOW_VALUE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
                "QUANTITY_FLOAT" => "Y",
                "SET_TITLE" => "N",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "SHOW_FILTER" => "N",
                "SHOW_RESTORE" => "Y",
                "SHOW_VAT" => "Y",
                "TEMPLATE_THEME" => "",
                "TOTAL_BLOCK_DISPLAY" => array(
                    0 => "bottom",
                ),
                "USE_DYNAMIC_SCROLL" => "Y",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_GIFTS" => "Y",
                "USE_PREPAYMENT" => "N",
                "USE_PRICE_ANIMATION" => "Y",
                "COMPONENT_TEMPLATE" => "cart"
            ),
            false
        ); ?>
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>