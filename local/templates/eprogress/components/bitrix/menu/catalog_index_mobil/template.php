<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<ul>
    <? foreach ($arResult as $arItem): ?>
        <li>
            <a href="<?= $arItem['LINK'] ?>">
                <? if (!empty($arItem['PARAMS']['IMAGE'])): ?>
                    <figure>
                        <img src="<?= $arItem['PARAMS']['IMAGE'] ?>" alt="">
                    </figure>
                <? endif; ?>
                <div>
                    <span><?= htmlspecialchars_decode($arItem['TEXT']) ?></span>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/nav-arrow.png" alt="">
                </div>
            </a>
        </li>
    <? endforeach; ?>
</ul>