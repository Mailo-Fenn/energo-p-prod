<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $page = $APPLICATION->GetCurPage(); ?>

<? if (!str_contains($page, '/cart/') && !str_contains($page, '/contacts/')): ?>
    <div class="cont-sect">
        <? if (!empty($contacts['UF_MAP'])): ?>
            <div class="cont-sect__map"><?= htmlspecialchars_decode($contacts['UF_MAP']) ?></div>
        <? endif; ?>

        <div class="cont-sect__container">
            <div class="cont-sect__content">
                <div class="def-title cont-sect__title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/footer/cont_sect__title.php'
                        )
                    ); ?>
                </div>

                <div class="cont-sect__info">
                    <? if (!empty($contacts['UF_ADRESS'])): ?>
                        <div class="cont-sect__info-item cont-sect__info-item--row">
                            <span>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . 'include/footer/cont_sect__info_item1.php'
                                    )
                                ); ?>
                            </span>

                            <p><?= htmlspecialchars_decode($contacts['UF_ADRESS']) ?></p>
                        </div>
                    <? endif; ?>

                    <? if (!empty($contacts['UF_WORK_TIME'])): ?>
                        <div class="cont-sect__info-item">
                            <span>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . 'include/footer/cont_sect__info_item2.php'
                                    )
                                ); ?>
                            </span>

                            <p><?= htmlspecialchars_decode($contacts['UF_WORK_TIME']) ?></p>
                        </div>
                    <? endif; ?>

                    <? if (!empty($contacts['UF_EMAIL'])): ?>
                        <div class="cont-sect__info-item">
                            <span>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . 'include/footer/cont_sect__info_item3.php'
                                    )
                                ); ?>
                            </span>

                            <p><?= htmlspecialchars_decode($contacts['UF_EMAIL']) ?></p>
                        </div>
                    <? endif; ?>
                </div>

                <div class="cont-sect__phone">
                    <? if (!empty($contacts['UF_PHONE_NUMBER'])): ?>
                        <div class="cont-sect__phone-num"><?= htmlspecialchars_decode($contacts['UF_PHONE_NUMBER']) ?></div>
                    <? endif; ?>

                    <? if (!empty($contacts['UF_PHONE_CALL_BACK_NUMBER']) && !empty($contacts['UF_PHONE_CALL_BACK_HREF'])): ?>
                        <div class="cont-sect__phone-mob"><?= htmlspecialchars_decode($contacts['UF_PHONE_CALL_BACK_NUMBER']) ?></div>

                        <a class="cont-sect__phone-call" href="tel:<?= $contacts['UF_PHONE_CALL_BACK_HREF'] ?>">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . 'include/footer/cont_sect__phone_call.php'
                                )
                            ); ?>
                        </a>
                    <? endif; ?>
                </div>

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
                        "SUCCESS_URL" => "/thanks/index.php",
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
    </div>
<? endif; ?>

<footer class="main-footer">
    <div class="main-footer__container">
        <? if (!empty($contacts['UF_LOGO_FOOTER'])): ?>
            <a class="main-footer__logo" href="/">
                <img src="<?= CFile::GetPath($contacts['UF_LOGO_FOOTER']) ?>" alt="">
            </a>
        <? endif; ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "footer_menu",
            array(
                "ROOT_MENU_TYPE" => "footer",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "footer",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
            )
        ); ?>

        <div class="main-footer__addu">
            <div class="main-footer__addu-logo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/addu.png" alt="">
            </div>

            <div class="main-footer__addu-text">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . 'include/footer/main_footer__addu_logo.php'
                    )
                ); ?>
            </div>
        </div>
    </div>
</footer>
</div>

<div class="hidden">
    <nav id="my-menu">
        <div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "footer_hidden_menu",
                array(
                    "ROOT_MENU_TYPE" => "footer_hidden",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "footer_hidden",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "Y",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => ""
                )
            ); ?>

            <div class="mob-menu">
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

                <div class="main-header__phone">
                    <? if (!empty($contacts['UF_PHONE_CALL_BACK_NUMBER']) && !empty($contacts['UF_PHONE_CALL_BACK_HREF'])): ?>
                        <a class="main-header__phone-num" href="tel:<?= $contacts['UF_PHONE_CALL_BACK_HREF'] ?>">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/hicon-3.png" alt="">

                            <span><?= htmlspecialchars_decode($contacts['UF_PHONE_CALL_BACK_NUMBER']) ?></span>
                        </a>
                    <? endif; ?>

                    <a class="main-header__phone-link" href="#call-dialog">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . 'include/footer/main_header__phone_link.php'
                            )
                        ); ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
</body>

</html>