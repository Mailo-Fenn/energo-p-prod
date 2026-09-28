<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if (!empty($arResult['ITEMS'])): ?>
    <div class="dist-sect__slider">
        <div class="swiper">
            <div class="swiper-wrapper">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                    <? if (!empty($arItem['PREVIEW_PICTURE'])): ?>
                        <a class="swiper-slide dist-sect__slide" href="#" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
                        </a>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>