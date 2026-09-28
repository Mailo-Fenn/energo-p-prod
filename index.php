<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'); ?>

<div class="main-sect">
    <div class="main-sect__container">
        <div class="main-sect__aside">
            <div class="main-sect__nav">
                <a class="main-sect__nav-title" href="/catalog/">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/catalog-1.png" alt="">

                    <span>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/main_sect__nav_title.php'
                            )
                        ); ?>
                    </span>
                </a>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "catalog_index",
                    array(
                        "ROOT_MENU_TYPE" => "catalog_index",
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "catalog_index",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                ); ?>
            </div>
        </div>
        <div class="main-sect__content">
            <img class="main-sect__bg" src="<?= SITE_TEMPLATE_PATH ?>/img/main-bg.jpg" alt="">

            <div class="main-sect__title">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/main_sect__title.php'
                    )
                ); ?>
            </div>

            <div class="main-sect__text">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/main_sect__text.php'
                    )
                ); ?>
            </div>

            <div class="main-sect__phones">
                <? if (!empty($contacts['UF_PHONE_NUMBER']) && !empty($contacts['UF_PHONE_HREF'])): ?>
                    <a class="main-sect__phone" href="tel:<?= $contacts['UF_PHONE_HREF'] ?>"><?= htmlspecialchars_decode($contacts['UF_PHONE_NUMBER']) ?></a>
                <? endif; ?>

                <? if (!empty($contacts['UF_PHONE_CALL_BACK_NUMBER']) && !empty($contacts['UF_PHONE_CALL_BACK_HREF'])): ?>
                    <a class="main-sect__phone" href="tel:<?= $contacts['UF_PHONE_CALL_BACK_HREF'] ?>"><?= htmlspecialchars_decode($contacts['UF_PHONE_CALL_BACK_NUMBER']) ?></a>
                <? endif; ?>
            </div>

            <div class="main-sect__text">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/main_sect__text1.php'
                    )
                ); ?>
            </div>
        </div>
    </div>
</div>

<div class="nav-sect">
    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "catalog_index_mobil",
        array(
            "ROOT_MENU_TYPE" => "catalog_index",
            "MAX_LEVEL" => "2",
            "CHILD_MENU_TYPE" => "catalog_index",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => ""
        )
    ); ?>
</div>

<div class="about-sect">
    <div class="about-sect__container">
        <div class="def-title about-sect__title">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . 'include/index/about_sect__title.php'
                )
            ); ?>
        </div>

        <div class="about-sect__content">
            <div class="about-sect__text">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/about_sect__text.php'
                    )
                ); ?>
            </div>

            <div class="about-sect__items">
                <div class="about-sect__item">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/about_sect__item1.php'
                        )
                    ); ?>
                </div>

                <div class="about-sect__item">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/about_sect__item2.php'
                        )
                    ); ?>
                </div>

                <div class="about-sect__item">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/about_sect__item3.php'
                        )
                    ); ?>
                </div>

                <div class="about-sect__item">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/about_sect__item4.php'
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="prods-sect">
    <div class="prods-sect__container">
        <div class="prods-sect__head">
            <div class="def-title prods-sect__title">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/prods_sect__title.php'
                    )
                ); ?>
            </div>

            <a class="prods-sect__all" href="/catalog/">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/prods_sect__all.php'
                    )
                ); ?>
            </a>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.top",
            "catalog",
            array(
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "BASKET_URL" => "/cart/",
                "BRAND_PROPERTY" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                "COMPARE_PATH" => "",
                "COMPATIBLE_MODE" => "N",
                "CONVERT_CURRENCY" => "Y",
                "CURRENCY_ID" => "RUB",
                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":[]}",
                "DATA_LAYER_NAME" => "dataLayer",
                "DETAIL_URL" => "",
                "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                "DISPLAY_COMPARE" => "N",
                "ELEMENT_COUNT" => "9",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "ENLARGE_PRODUCT" => "STRICT",
                "FILTER_NAME" => "",
                "HIDE_NOT_AVAILABLE" => "L",
                "HIDE_NOT_AVAILABLE_OFFERS" => "L",
                "IBLOCK_ID" => "6",
                "IBLOCK_TYPE" => "catalog",
                "LABEL_PROP" => array(),
                "LABEL_PROP_MOBILE" => "",
                "LABEL_PROP_POSITION" => "top-left",
                "LINE_ELEMENT_COUNT" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_COMPARE" => "Сравнить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                "MESS_RELATIVE_QUANTITY_FEW" => "мало",
                "MESS_RELATIVE_QUANTITY_MANY" => "много",
                "MESS_SHOW_MAX_QUANTITY" => "Наличие",
                "OFFERS_CART_PROPERTIES" => array(
                    0 => "COLOR_REF",
                    1 => "SIZES_SHOES",
                    2 => "SIZES_CLOTHES",
                ),
                "OFFERS_FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "OFFERS_LIMIT" => "5",
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "SIZES_SHOES",
                    1 => "SIZES_CLOTHES",
                    2 => "MORE_PHOTO",
                    3 => "",
                ),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_ORDER2" => "desc",
                "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
                "OFFER_TREE_PROPS" => array(
                    0 => "COLOR_REF",
                    1 => "SIZES_SHOES",
                ),
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                "PRODUCT_DISPLAY_MODE" => "Y",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(
                    0 => "NEWPRODUCT",
                ),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "PROPERTY_CODE" => array(
                    0 => "MANUFACTURER",
                    1 => "MATERIAL",
                    2 => "",
                ),
                "PROPERTY_CODE_MOBILE" => "",
                "RELATIVE_QUANTITY_FACTOR" => "5",
                "ROTATE_TIMER" => "30",
                "SECTION_URL" => "",
                "SEF_MODE" => "N",
                "SEF_RULE" => "",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "SHOW_MAX_QUANTITY" => "M",
                "SHOW_OLD_PRICE" => "Y",
                "SHOW_PAGINATION" => "Y",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "Y",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "Y",
                "VIEW_MODE" => "SECTION",
                "COMPONENT_TEMPLATE" => "catalog"
            ),
            false
        ); ?>
    </div>
</div>

<div class="why-sect">
    <div class="why-sect__container">
        <div class="def-title why-sect__title">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . 'include/index/why_sect__title.php'
                )
            ); ?>
        </div>

        <div class="why-sect__items">
            <div class="why-sect__item">
                <div class="why-sect__item-icon">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__item_icon1.php'
                        )
                    ); ?>
                </div>

                <div class="why-sect__item-content">
                    <div class="why-sect__item-title">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_title1.php'
                            )
                        ); ?>
                    </div>

                    <div class="why-sect__item-text">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_text1.php'
                            )
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="why-sect__item">
                <div class="why-sect__item-icon">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__item_icon2.php'
                        )
                    ); ?>
                </div>

                <div class="why-sect__item-content">
                    <div class="why-sect__item-title">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_title2.php'
                            )
                        ); ?>
                    </div>

                    <div class="why-sect__item-text">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_text2.php'
                            )
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="why-sect__item">
                <div class="why-sect__item-icon">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__item_icon3.php'
                        )
                    ); ?>
                </div>

                <div class="why-sect__item-content">
                    <div class="why-sect__item-title">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_title3.php'
                            )
                        ); ?>
                    </div>

                    <div class="why-sect__item-text">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_text3.php'
                            )
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="why-sect__item">
                <div class="why-sect__item-icon">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__item_icon4.php'
                        )
                    ); ?>
                </div>

                <div class="why-sect__item-content">
                    <div class="why-sect__item-title">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_title4.php'
                            )
                        ); ?>
                    </div>

                    <div class="why-sect__item-text">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/index/why_sect__item_text4.php'
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="why-sect__disc lazy" data-bg="img/why-bg-1.jpg">
            <div class="why-sect__disc-icon">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/why_sect__disc_icon.php'
                    )
                ); ?>
            </div>

            <div class="why-sect__disc-content">
                <div class="why-sect__disc-title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__disc_title.php'
                        )
                    ); ?>
                </div>

                <div class="why-sect__disc-text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__disc_text.php'
                        )
                    ); ?>
                </div>

            </div>

            <a class="def-btn def-btn--white why-sect__disc-btn popup-with-zoom-anim" href="#call-dialog">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/why_sect__disc_btn.php'
                    )
                ); ?>
            </a>
        </div>

        <div class="why-sect__comp lazy" data-bg="img/comp-bg.jpg">
            <div class="why-sect__comp-content">
                <div class="why-sect__comp-title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__comp_title.php'
                        )
                    ); ?>
                </div>

                <div class="why-sect__comp-text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__comp_text.php'
                        )
                    ); ?>
                </div>

                <a class="def-btn why-sect__comp-btn popup-with-zoom-anim" href="#call-dialog">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__comp_btn.php'
                        )
                    ); ?>
                </a>

                <div class="why-sect__comp-img">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/index/why_sect__comp_img.php'
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dist-sect">
    <div class="dist-sect__container">
        <div class="def-title dist-sect__title">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . 'include/index/dist_sect__title.php'
                )
            ); ?>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "distributor",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "Y",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "4",
                "NEWS_COUNT" => "999",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("ID"),
                "PROPERTY_CODE" => array("DESCRIPTION"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "Y",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>
    </div>
</div>

<div class="news-sect">
    <div class="news-sect__container">
        <div class="news-sect__head">
            <div class="def-title news-sect__title">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/news_sect__title.php'
                    )
                ); ?>
            </div>

            <a class="news-sect__all" href="#">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/index/news_sect__all.php'
                    )
                ); ?>
            </a>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "news",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "Y",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "5",
                "NEWS_COUNT" => "999",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("ID"),
                "PROPERTY_CODE" => array("DESCRIPTION"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "Y",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>