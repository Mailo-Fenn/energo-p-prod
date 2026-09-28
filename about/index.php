<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'); ?>

<? include($_SERVER['DOCUMENT_ROOT'] . $APPLICATION->GetCurDir() . '.section.php'); ?>

<div class="pol-sect">
    <div class="pol-sect__container">
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

        <div class="def-title pol-sect__title"><?= $sSectionName ?></div>

        <div class="pol-sect__text">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . 'include/about/pol_sect__text.php'
                )
            ); ?>
        </div>
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>