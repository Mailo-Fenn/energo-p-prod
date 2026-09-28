<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

if (CModule::IncludeModule("iblock")) { 
    $arSelect = array("ID", "NAME", "SECTION_PAGE_URL", "PICTURE"); // Добавляем PICTURE
    $arFilter = array(
        "IBLOCK_ID" => 6, 
        "ACTIVE" => "Y", 
        "DEPTH_LEVEL" => 1 // Только корневые разделы
    );

    $res = CIBlockSection::GetList(
        array("SORT" => "ASC", "NAME" => "ASC"), // Сортировка
        $arFilter,
        false,
        $arSelect
    );

    $aMenuLinksExt1 = [];
    while ($arSection = $res->GetNext()) { 
        $picturePath = $arSection['PICTURE'] ? CFile::GetPath($arSection['PICTURE']) : ''; // Получаем путь к изображению

        $aMenuLinksExt1[] = array(
            $arSection['NAME'], // Название раздела
            $arSection['SECTION_PAGE_URL'], // URL раздела
            array(), // Дополнительные ссылки
            array(
                "IMAGE" => $picturePath // Добавляем путь изображения в параметры
            ),
            "" // Условие отображения
        );
    }

    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt1);
}
?>
