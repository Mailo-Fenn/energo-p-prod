<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'); ?>

<? include($_SERVER['DOCUMENT_ROOT'] . $APPLICATION->GetCurDir() . '.section.php'); ?>

<div class="cont-sect cont-sect--page">
    <div class="cont-sect__container">
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

        <div class="def-title cont-sect__title"><?= $sSectionName ?></div>

        <div class="cont-sect__main">
            <? if (!empty($contacts['UF_MAP'])): ?>
                <div class="cont-sect__map"><?= htmlspecialchars_decode($contacts['UF_MAP']) ?></div>
            <? endif; ?>

            <div class="cont-sect__content">
                <div class="def-title cont-sect__title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . 'include/contacts/cont_sect__title.php'
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
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>