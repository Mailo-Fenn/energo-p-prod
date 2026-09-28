<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


if (empty($arResult)) return "";

$res =
	'
		<ul class="def-bc order-sect__bc">
';

$elCount = count($arResult);

foreach ($arResult as $index => $item) {
	$link = (!empty($item['LINK']) && $index < ($elCount - 1)) ? $item['LINK'] : '#';
	$title = $item['TITLE'] ?? '';
	$res .=
		'<li>
		<a href="' . $link . '">' . $title . '</a>
	</li>';
}

$res .=
	'	
		</ul>
';

return $res;
