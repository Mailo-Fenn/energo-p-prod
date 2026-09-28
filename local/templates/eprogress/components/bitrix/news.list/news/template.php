<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if (!empty($arResult['ITEMS'])): ?>
    <div class="news-sect__slider">
        <div class="swiper">
            <div class="swiper-wrapper">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                    <?
                    $date = $arItem['ACTIVE_FROM_X'];
                    $formattedDate = date("d.m", strtotime($date));
                    ?>

                    <div class="swiper-slide news-sect__slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <? if (!empty($arItem['PREVIEW_PICTURE'])): ?>
                            <a class="news-sect__slide-img" href="#">
                                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
                            </a>
                        <? endif; ?>

                        <div class="news-sect__slide-content">
                            <div class="news-sect__slide-title"><?= htmlspecialchars_decode($arItem['NAME']) ?></div>

                            <? if (!empty($arItem['PREVIEW_TEXT'])): ?>
                                <div class="news-sect__slide-text"><?= htmlspecialchars_decode($arItem['PREVIEW_TEXT']) ?></div>
                            <? endif; ?>

                            <div class="news-sect__slide-footer">
                                <? if (!empty($formattedDate)): ?>
                                    <div class="news-sect__slide-date"><?= $formattedDate ?></div>
                                <? endif; ?>

                                <a class="news-sect__slide-link" href="#">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . 'include/index/news_sect__slide_link.php'
                                        )
                                    ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="news-sect__slider-prev"><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/slider-arrow.png" alt=""></div>
            <div class="news-sect__slider-next"><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/slider-arrow.png" alt=""></div>
        </div>
    <? endif; ?>