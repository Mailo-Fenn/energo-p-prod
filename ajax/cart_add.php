<?php

/** @global CMain $APPLICATION */
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);
define('NOT_CHECK_PERMISSIONS', true);

use Bitrix\Main;
use Bitrix\Sale;
use Bitrix\Currency\CurrencyManager;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['AJAX']) && $data['AJAX'] == 'Y') {
    if (Main\Loader::includeModule('sale') && Main\Loader::includeModule('catalog')) {
        $productID = (int)$data['PRODUCT_ID'];
        $quantity = (float)$data['QUANTITY'] > 0 ? (float)$data['QUANTITY'] : 1;

        if ($productID > 0) {
            $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Main\Context::getCurrent()->getSite());

            // Проверяем наличие товара в корзине
            if ($item = $basket->getExistsItem('catalog', $productID)) {
                // Обновляем количество
                $item->setField('QUANTITY', $item->getQuantity() + $quantity);
            } else {
                // Создаем новый элемент корзины
                $item = $basket->createItem('catalog', $productID);
                $item->setFields(array(
                    'QUANTITY' => $quantity,
                    'CURRENCY' => CurrencyManager::getBaseCurrency(),
                    'LID' => Main\Context::getCurrent()->getSite(),
                    'PRODUCT_PROVIDER_CLASS' => '\Bitrix\Catalog\Product\CatalogProvider',
                ));
            }

            // Сохраняем изменения в корзине
            $result = $basket->save();

            if (!$result->isSuccess()) {
                $APPLICATION->RestartBuffer();
                header('Content-Type: application/json');
                echo Main\Web\Json::encode(array("STATUS" => "ERROR", "TEXT" => implode(', ', $result->getErrorMessages())));
                die();
            }

            // Подсчет общей суммы и количества
            $totalCartSum = 0;
            $totalQuantity = 0;

            foreach ($basket as $basketItem) {
                $totalCartSum += $basketItem->getPrice() * $basketItem->getQuantity();
                $totalQuantity += $basketItem->getQuantity();
            }

            // Форматируем сумму
            $formattedPrice = CCurrencyLang::CurrencyFormat($totalCartSum, CurrencyManager::getBaseCurrency());

            // Успешный ответ
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo Main\Web\Json::encode(array(
                "STATUS" => "SUCCESS",
                "ITEM_ID" => $productID,
                "TOTAL_CART_SUM" => $formattedPrice,
                "TOTAL_QUANTITY" => $totalQuantity,
            ));
        } else {
            // Ошибка неверных данных
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo Main\Web\Json::encode(array("STATUS" => "ERROR", "TEXT" => "Неверные данные товара или количества"));
        }
    } else {
        // Ошибка загрузки модулей
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo Main\Web\Json::encode(array("STATUS" => "ERROR", "TEXT" => "Модули не загружены"));
    }

    die();
}
