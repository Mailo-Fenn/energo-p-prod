<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="revs-sect__items">
    <?foreach($arResult["ITEMS"] as $k => $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        if($k == 0){ $color = '#b37db3';}
        if($k == 1){ $color = '#f285aa';}
        if($k == 2){ $color = '#5798d9';}
        if($k == 3){ $color = '#4aa6f4';}
        ?>

        <div class="revs-sect__item">
            <div class="revs-sect__item-ava" style="background-color: <?=$color?>"><span><?= mb_substr($arItem['NAME'], 0, 1, 'UTF-8');?></span></div>
            <div class="revs-sect__item-content">
                <div class="revs-sect__item-head">
                    <div class="revs-sect__item-title">
                        <div class="revs-sect__item-name"><?=$arItem['NAME']?></div>
                        <ul class="revs-sect__item-rat">
                            <? for($i=1;$i<=$arItem["PROPERTIES"]["EVALUARION"]["VALUE"];$i++){ ?>
                                <li><img src="img/icons/star.png" alt=""></li>
                            <?}?>
                        </ul>
                    </div>
                    <div class="revs-sect__item-date"><?=$arItem["PROPERTIES"]["DATE"]["VALUE"]?></div>
                </div>
                <div class="revs-sect__item-text">
                    <p><?=htmlspecialcharsBack($arItem["PROPERTIES"]["REWIEVS"]["VALUE"]["TEXT"])?></p>
                </div>
            </div>
        </div>
    <?endforeach;?>
</div>
<a class="def-btn def-btn--trsp revs-sect__btn" href="https://yandex.kz/maps/org/energoprogress/24942153683/reviews/?ll=37.482960%2C55.791299&z=17">Другие отзывы</a>
