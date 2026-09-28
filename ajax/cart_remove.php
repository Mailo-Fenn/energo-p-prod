<?php

/** @global CMain $APPLICATION */
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);
define('NOT_CHECK_PERMISSIONS', true);

use Bitrix\Main;
use Bitrix\Currency\CurrencyManager;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['AJAX']) && $data['AJAX'] == 'Y') {
    if (CModule::IncludeModule('sale')) {
        $productID = (int)$data['PRODUCT_ID'];

        if ($productID > 0) {
            // Удаление товара из корзины
            $dbBasketItems = CSaleBasket::GetList(
                array(),
                array(
                    'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                    'LID' => SITE_ID,
                    'ORDER_ID' => 'NULL',
                    'PRODUCT_ID' => $productID
                )
            );

            if ($arBasket = $dbBasketItems->Fetch()) {
                CSaleBasket::Delete($arBasket['ID']);
            }

            // Подсчёт общей стоимости и количества товаров в корзине
            $dbBasketItems = CSaleBasket::GetList(
                array(),
                array(
                    'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                    'LID' => SITE_ID,
                    'ORDER_ID' => 'NULL'
                ),
                false,
                false,
                array('PRICE', 'QUANTITY')
            );

            $totalCartSum = 0;
            $totalQuantity = 0;

            while ($arItem = $dbBasketItems->Fetch()) {
                $totalCartSum += $arItem['PRICE'] * $arItem['QUANTITY'];
                $totalQuantity += $arItem['QUANTITY'];
            }

            // Форматирование итоговой суммы
            $formattedPrice = CCurrencyLang::CurrencyFormat($totalCartSum, CurrencyManager::getBaseCurrency());

            // Отправляем успешный ответ
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo Main\Web\Json::encode(array(
                "STATUS" => "SUCCESS",
                "ITEM_ID" => $productID,
                "TOTAL_CART_SUM" => $formattedPrice,
                "TOTAL_QUANTITY" => $totalQuantity,
            ));
        } else {
            // Ошибка с неверными данными
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo Main\Web\Json::encode(array("STATUS" => "ERROR", "TEXT" => "Неверные данные товара или количества"));
        }
    } else {
        // Ошибка, если модули не загружены
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo Main\Web\Json::encode(array("STATUS" => "ERROR", "TEXT" => "Не загружены модули"));
    }

    die();
}
