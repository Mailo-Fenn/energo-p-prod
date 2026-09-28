<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<ul>
	<? foreach ($arResult as $arItem): ?>
		<li>
			<a href="<?= $arItem['LINK'] ?>"><?= htmlspecialchars_decode($arItem['TEXT']) ?></a>
		</li>
	<? endforeach; ?>
</ul>