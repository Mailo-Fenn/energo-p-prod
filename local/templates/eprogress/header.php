<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?use \Bitrix\Main\Page\Asset;?>

<?
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;

$hlblockId = 5;
$hlblock = HL\HighloadBlockTable::getById($hlblockId)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entityDataClass = $entity->getDataClass();

$rsData = $entityDataClass::getList([
    'select' => ['*'],
    'order'  => ['ID' => 'ASC'],
]);

$contacts = $rsData->fetch()
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <? $APPLICATION->ShowHead(); ?>
    <? $APPLICATION->SetTitle($APPLICATION->GetProperty("title")) ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/css/manifest.json">

    <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/app.min.css'); ?>
    <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/custom.css'); ?>

    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.min.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scripts.min.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/common.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/imask.js"); ?>
</head>

<body>
    <div class="wrapper">
        <header class="main-header">
            <? $APPLICATION->ShowPanel(); ?>

            <div class="main-header__top">
                <div class="main-header__top-container">
                    <div class="main-header__info">
                        <? if (!empty($contacts['UF_EMAIL'])): ?>
                            <div class="main-header__info-item">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/hicon-1.png" alt="">

                                <span><?= htmlspecialchars_decode($contacts['UF_EMAIL']) ?></span>
                            </div>
                        <? endif; ?>

                        <? if (!empty($contacts['UF_ADRESS'])): ?>
                            <div class="main-header__info-item">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/hicon-2.png" alt="">

                                <span><?= htmlspecialchars_decode($contacts['UF_ADRESS']) ?></span>
                            </div>
                        <? endif; ?>

                        <? if (!empty($contacts['UF_PHONE_NUMBER'])): ?>
                            <div class="main-header__info-item">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/hicon-3.png" alt="">

                                <span><?= htmlspecialchars_decode($contacts['UF_PHONE_NUMBER']) ?></span>
                            </div>
                        <? endif; ?>
                    </div>

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "header_menu",
                        array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "N",
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

            <div class="main-header__bottom">
                <div class="main-header__bottom-container">
                    <? if (!empty($contacts['UF_LOGO'])): ?>
                        <a class="main-header__logo" href="/">
                            <img src="<?= CFile::GetPath($contacts['UF_LOGO']) ?>" alt="">
                        </a>
                    <? endif; ?>

                    <? if (!empty($contacts['UF_PHONE_CALL_BACK_NUMBER']) && !empty($contacts['UF_PHONE_CALL_BACK_HREF'])): ?>
                        <div class="main-header__phone">
                            <a class="main-header__phone-num" href="tel:<?= $contacts['UF_PHONE_CALL_BACK_HREF'] ?>">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/hicon-3.png" alt="">

                                <span><?= htmlspecialchars_decode($contacts['UF_PHONE_CALL_BACK_NUMBER']) ?></span>
                            </a>

                            <a class="main-header__phone-link popup-with-zoom-anim" href="#call-dialog">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . 'include/header/main_header__phone_link.php'
                                    )
                                ); ?>
                            </a>
                        </div>
                    <? endif; ?>

                    <div class="main-header__search">
                        <input type="text" placeholder="Поиск по каталогу...">

                        <button>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/search.png" alt="">
                        </button>
                    </div>

                    <div class="main-header__ctrls">
                        <a class="main-header__mlink" href="#">
                            <div class="main-header__mlink-icon">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/menu-1.png" alt="">
                            </div>

                            <div class="main-header__mlink-text">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . 'include/header/main_header__mlink_text.php'
                                    )
                                ); ?>
                            </div>
                        </a>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            "cart",
                            array(
                                "HIDE_ON_BASKET_PAGES" => "N",    // Не показывать на страницах корзины и оформления заказа
                                "PATH_TO_BASKET" => SITE_DIR . "cart/",    // Страница корзины
                                "PATH_TO_ORDER" => SITE_DIR . "cart/order/",    // Страница оформления заказа
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
                                "PATH_TO_PROFILE" => SITE_DIR . "personal/",    // Страница профиля
                                "PATH_TO_REGISTER" => SITE_DIR . "login/",    // Страница регистрации
                                "POSITION_FIXED" => "Y",    // Отображать корзину поверх шаблона
                                "POSITION_HORIZONTAL" => "right",    // Положение по горизонтали
                                "POSITION_VERTICAL" => "top",    // Положение по вертикали
                                "SHOW_AUTHOR" => "Y",    // Добавить возможность авторизации
                                "SHOW_DELAY" => "N",    // Показывать отложенные товары
                                "SHOW_EMPTY_VALUES" => "Y",    // Выводить нулевые значения в пустой корзине
                                "SHOW_IMAGE" => "Y",    // Выводить картинку товара
                                "SHOW_NOTAVAIL" => "N",    // Показывать товары, недоступные для покупки
                                "SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
                                "SHOW_PERSONAL_LINK" => "N",    // Отображать персональный раздел
                                "SHOW_PRICE" => "Y",    // Выводить цену товара
                                "SHOW_PRODUCTS" => "Y",    // Показывать список товаров
                                "SHOW_SUMMARY" => "Y",    // Выводить подытог по строке
                                "SHOW_TOTAL_PRICE" => "Y",    // Показывать общую сумму по товарам
                            ),
                            false
                        ); ?>

                        <!-- <a class="main-header__cart" href="#">
                            <div class="main-header__cart-icon">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/cart.png" alt="">

                                <span>0</span>
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

                                <strong>0 ₽</strong>
                            </div>
                        </a> -->

                        <a class="main-header__mlink" href="#">
                            <div class="main-header__mlink-icon">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/menu-2.png" alt="">
                            </div>

                            <div class="main-header__mlink-text">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . 'include/header/main_header__mlink_text1.php'
                                    )
                                ); ?>
                            </div>
                        </a>
                    </div>

                    <div class="main-header__btns">
                        <? if (!empty($contacts['UF_PHONE_CALL_BACK_HREF'])): ?>
                            <a class="main-header__btn" href="tel:<?= $contacts['UF_PHONE_CALL_BACK_HREF'] ?>">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/btn-icon-1.png" alt="">
                            </a>
                        <? endif; ?>

                        <button class="main-header__btn" href="#">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/btn-icon-2.png" alt="">
                        </button>
                    </div>

                    <a class="main-header__mbtn" href="#my-menu">
                        <span><span></span></span>
                    </a>
                </div>
            </div>
        </header>

        <div class="call-dialog zoom-anim-dialog mfp-hide" id="call-dialog">
            <div class="call-dialog__container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:form",
                    "contact",
                    array(
                        "AJAX_MODE" => "Y",
                        "SEF_MODE" => "N",
                        "WEB_FORM_ID" => "1",
                        "RESULT_ID" => $_REQUEST["RESULT_ID"],
                        "START_PAGE" => "new",
                        "SHOW_LIST_PAGE" => "N",
                        "SHOW_EDIT_PAGE" => "N",
                        "SHOW_VIEW_PAGE" => "N",
                        "SUCCESS_URL" => "#",
                        "SHOW_ANSWER_VALUE" => "Y",
                        "SHOW_ADDITIONAL" => "Y",
                        "SHOW_STATUS" => "Y",
                        "EDIT_ADDITIONAL" => "Y",
                        "EDIT_STATUS" => "Y",
                        "NOT_SHOW_FILTER" => array(
                            0 => "",
                            1 => "",
                        ),
                        "NOT_SHOW_TABLE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => "",
                        "IGNORE_CUSTOM_TEMPLATE" => "Y",
                        "NAME_TEMPLATE" => "#LAST_NAME# #NAME#",
                        "USE_EXTENDED_ERRORS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "AJAX_OPTION_JUMP" => "Y",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "Y",
                        "SEF_FOLDER" => "#",
                        "COMPONENT_TEMPLATE" => "contact",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "VARIABLE_ALIASES" => array(
                            "action" => "action",
                        )
                    ),
                    false
                ); ?>
            </div>
        </div>