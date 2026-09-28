<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$ClientID = 'navigation_' . $arResult['NavNum'];

$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>

<div class="cat-sect__pag">
	<?
	$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
	$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
	if ($arResult["bDescPageNumbering"] === true) {
		// to show always first and last pages
		$arResult["nStartPage"] = $arResult["NavPageCount"];
		$arResult["nEndPage"] = 1;

		$sPrevHref = '';
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
			$bPrevDisabled = false;
			if ($arResult["bSavePage"]) {
				$sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
			} else {
				if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
					$sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
				} else {
					$sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
				}
			}
		} else {
			$bPrevDisabled = true;
		}

		$sNextHref = '';
		if ($arResult["NavPageNomer"] > 1) {
			$bNextDisabled = false;
			$sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
		} else {
			$bNextDisabled = true;
		}
	?>
		<li class="cat-sect__pag-arrow">
			<a href="<?= $sPrevHref; ?>">
				<svg width="7px" height="12px">
					<path fill-rule="evenodd" d="M0.209,5.959 L4.838,10.813 C5.116,11.105 5.539,11.105 5.823,10.813 C6.101,10.521 6.101,10.078 5.823,9.780 L1.755,5.516 L5.823,1.251 C6.101,0.959 6.101,0.516 5.823,0.219 C5.684,0.073 5.545,-0.000 5.331,-0.000 C5.191,-0.000 4.977,0.073 4.769,0.146 L0.209,4.927 C0.069,5.072 -0.000,5.218 -0.000,5.443 C-0.000,5.662 0.069,5.813 0.209,5.959 Z" />
				</svg>
			</a>
		</li>


		<li class="cat-sect__pag-arrow">
			<a href="<?= $sNextHref; ?>">
				<svg width="6px" height="11px">
					<path fill-rule="evenodd" d="M5.792,5.057 L1.187,0.217 C0.910,-0.074 0.489,-0.074 0.207,0.217 C-0.070,0.508 -0.070,0.950 0.207,1.247 L4.253,5.499 L0.207,9.752 C-0.070,10.043 -0.070,10.485 0.207,10.782 C0.345,10.927 0.484,11.000 0.697,11.000 C0.835,11.000 1.048,10.927 1.256,10.854 L5.792,6.087 C5.931,5.941 6.000,5.796 6.000,5.572 C6.000,5.354 5.931,5.203 5.792,5.057 Z" />
				</svg>
			</a>
		</li>

		<div class="navigation-pages">
			<span class="navigation-title"><?= GetMessage("pages") ?></span>
			<?
			$bFirst = true;
			$bPoints = false;
			do {
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
				if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {

					if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
			?>
						<li class="active"><a href="<?= $arResult["sUrlPath"] ?>"><?= $NavRecordGroupPrint ?></a></li>
					<?
					elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
					?>
						<li class="active"><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a></li>
					<?
					else:
					?>
						<a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
						<?
					endif;
					$bFirst = false;
					$bPoints = true;
				} else {
					if ($bPoints) {
						?>...<?
								$bPoints = false;
							}
						}
						$arResult["nStartPage"]--;
					} while ($arResult["nStartPage"] >= $arResult["nEndPage"]);
				} else {
					// to show always first and last pages
					$arResult["nStartPage"] = 1;
					$arResult["nEndPage"] = $arResult["NavPageCount"];

					$sPrevHref = '';
					if ($arResult["NavPageNomer"] > 1) {
						$bPrevDisabled = false;

						if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2) {
							$sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
						} else {
							$sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
						}
					} else {
						$bPrevDisabled = true;
					}

					$sNextHref = '';
					if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
						$bNextDisabled = false;
						$sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
					} else {
						$bNextDisabled = true;
					}
								?>

						<li class="cat-sect__pag-arrow">
							<a href="<?= $sPrevHref; ?>">
								<svg width="7px" height="12px">
									<path fill-rule="evenodd" d="M0.209,5.959 L4.838,10.813 C5.116,11.105 5.539,11.105 5.823,10.813 C6.101,10.521 6.101,10.078 5.823,9.780 L1.755,5.516 L5.823,1.251 C6.101,0.959 6.101,0.516 5.823,0.219 C5.684,0.073 5.545,-0.000 5.331,-0.000 C5.191,-0.000 4.977,0.073 4.769,0.146 L0.209,4.927 C0.069,5.072 -0.000,5.218 -0.000,5.443 C-0.000,5.662 0.069,5.813 0.209,5.959 Z" />
								</svg>
							</a>
						</li>


						<?
						$bFirst = true;
						$bPoints = false;
						do {
							if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {

								if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
						?>
									<li class="active"><a><?= $arResult["nStartPage"] ?></a></li>
								<?
								elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
								?>
									<li><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a></li>
								<?
								else:
								?>
									<a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
									<?
								endif;
								$bFirst = false;
								$bPoints = true;
							} else {
								if ($bPoints) {
									?>...<?
											$bPoints = false;
										}
									}
									$arResult["nStartPage"]++;
								} while ($arResult["nStartPage"] <= $arResult["nEndPage"]);
							}

							if ($arResult["bShowAll"]):
								if ($arResult["NavShowAll"]):
											?>
									<a class="nav-page-pagen" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"><?= GetMessage("nav_paged") ?></a>
								<?
								else:
								?>
									<a class="nav-page-all" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1"><?= GetMessage("nav_all") ?></a>
							<?
								endif;
							endif;
							?>
							<li class="cat-sect__pag-arrow">
								<a href="<?= $sNextHref; ?>">
									<svg width="6px" height="11px">
										<path fill-rule="evenodd" d="M5.792,5.057 L1.187,0.217 C0.910,-0.074 0.489,-0.074 0.207,0.217 C-0.070,0.508 -0.070,0.950 0.207,1.247 L4.253,5.499 L0.207,9.752 C-0.070,10.043 -0.070,10.485 0.207,10.782 C0.345,10.927 0.484,11.000 0.697,11.000 C0.835,11.000 1.048,10.927 1.256,10.854 L5.792,6.087 C5.931,5.941 6.000,5.796 6.000,5.572 C6.000,5.354 5.931,5.203 5.792,5.057 Z" />
									</svg>
								</a>
							</li>
		</div>
		<? CJSCore::Init(); ?>
		<script>
			BX.bind(document, "keydown", function(event) {

				event = event || window.event;
				if (!event.ctrlKey)
					return;

				var target = event.target || event.srcElement;
				if (target && target.nodeName && (target.nodeName.toUpperCase() == "INPUT" || target.nodeName.toUpperCase() == "TEXTAREA"))
					return;

				var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null));
				if (!key)
					return;

				var link = null;
				if (key == 39)
					link = BX('<?= $ClientID ?>_next_page');
				else if (key == 37)
					link = BX('<?= $ClientID ?>_previous_page');

				if (link && link.href)
					document.location = link.href;
			});
		</script>