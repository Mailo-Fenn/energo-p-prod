<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<ul class="main-sect__nav-list">
	<? foreach ($arResult as $arItem): ?>

		<li>
			<a href="<?= $arItem['LINK'] ?>">
				<? if (!empty($arItem['PARAMS']['IMAGE'])): ?>
					<em>
						<img src="<?= $arItem['PARAMS']['IMAGE'] ?>" alt="">
					</em>
				<? endif; ?>

				<span><?= htmlspecialchars_decode($arItem['TEXT']) ?></span>
			</a>
		</li>
	<? endforeach; ?>
</ul>