<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<?php
$iblockName = '';

if (CModule::IncludeModule("iblock")) {
    $res = CIBlock::GetByID(6);

    if ($arIBlock = $res->GetNext()) {
        $iblockName = $arIBlock["NAME"];
    }
}
?>

<div class="def-title cat-sect__title"><?=$iblockName?></div>

<svg class="hidden" width="11px" height="10px">
	<g id="cat-arrow">
		<path fill-rule="evenodd" d="M6.372,0.242 C6.066,0.567 6.066,1.093 6.372,1.418 L8.951,4.158 L0.792,4.164 C0.359,4.164 0.008,4.536 0.008,4.996 C0.008,5.455 0.359,5.828 0.792,5.828 L8.952,5.822 L6.372,8.562 C6.060,8.881 6.052,9.407 6.352,9.738 C6.653,10.068 7.149,10.078 7.460,9.759 C7.467,9.751 7.473,9.745 7.480,9.738 L10.290,6.755 C11.208,5.781 11.208,4.200 10.290,3.226 C10.290,3.226 10.290,3.226 10.290,3.225 L7.480,0.242 C7.174,-0.083 6.678,-0.083 6.372,0.242 Z" />
	</g>
</svg>

<div class="cat-sect__items">
	<? foreach ($arResult['SECTIONS'] as &$arSection): ?>
		<?
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>

		<?/* пока оставлю первое решение
		$childSections = array();
		$rsParentSection = CIBlockSection::GetByID($arSection['ID']);
		if ($arParentSection = $rsParentSection->GetNext()) {
			$arFilter = array(
                'IBLOCK_ID' => $arSection['IBLOCK_ID'],
                'GLOBAL_ACTIVE' => 'Y',
                '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
                '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
                '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
			$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
			while ($arSect = $rsSect->GetNext()) {
				array_push($childSections, $arSect);
			}
		}*/
        /**
         * сделано 20,12,2024 выводит подразделы раздела второго уровня 
         */
        // Получаем дочерние разделы (второго уровня)
        $childSections = array();
        $arFilter = array(
            'IBLOCK_ID' => $arSection['IBLOCK_ID'],
            'GLOBAL_ACTIVE' => 'Y',
            '>LEFT_MARGIN' => $arSection['LEFT_MARGIN'],
            '<RIGHT_MARGIN' => $arSection['RIGHT_MARGIN'],
            '>DEPTH_LEVEL' => $arSection['DEPTH_LEVEL'],
            'DEPTH_LEVEL' => 2 // Фильтруем только разделы второго уровня
        );

        // Получаем разделы первого уровня
        if ($arSection['DEPTH_LEVEL'] == 1) {
            $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
            while ($arSect = $rsSect->GetNext()) {
                array_push($childSections, $arSect);
            }
        }
		?>

		<div class="cat-sect__item" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
			<a class="cat-sect__item-title" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
				<? if (!empty($arSection['DETAIL_PICTURE'])): ?>
					<div class="cat-sect__item-icon">
						<img src="<?= CFile::GetPath($arSection['DETAIL_PICTURE']) ?>" alt="">
					</div>
				<? endif; ?>

				<div class="cat-sect__item-text">
					<span><?= htmlspecialchars_decode($arSection['NAME']) ?></span>

					<svg width="11px" height="10px">
						<use xlink:href="#cat-arrow"></use>
					</svg>
				</div>
			</a>
			<div class="cat-sect__item-list">
				<ul>
					<? for ($i = 0; $i < 5; $i++): ?>
						<? if (!empty($childSections[$i])): ?>
							<li><a href="<?= $childSections[$i]['SECTION_PAGE_URL'] ?>"><?= htmlspecialchars_decode($childSections[$i]['NAME']) ?></a></li>
						<? endif; ?>
					<? endfor; ?>
				</ul>
				<ul class="hidden-list">
					<? for ($i = 5; $i < count($childSections); $i++): ?>
						<li><a href="<?= $childSections[$i]['SECTION_PAGE_URL'] ?>"><?= htmlspecialchars_decode($childSections[$i]['NAME']) ?></a></li>
					<? endfor; ?>
				</ul>

				<? if (count($childSections) > 5): ?>
					<button class="cat-sect__item-sw">
						<span>+ <?= count($childSections) - 5 ?> категорий</span>
						<span>Свернуть</span>

						<svg width="11px" height="6px">
							<path fill-rule="evenodd" d="M5.877,5.827 L10.820,0.930 C11.036,0.715 11.036,0.367 10.820,0.151 C10.603,-0.064 10.252,-0.064 10.035,0.151 L5.484,4.660 L0.934,0.152 C0.717,-0.063 0.365,-0.063 0.149,0.152 C-0.068,0.367 -0.068,0.715 0.149,0.930 L5.092,5.827 C5.306,6.039 5.663,6.039 5.877,5.827 Z" />
						</svg>
					</button>
				<? endif; ?>
			</div>
		</div>
	<? endforeach; ?>

	<? unset($arSection); ?>
</div>