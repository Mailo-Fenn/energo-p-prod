<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult["isFormErrors"] == "Y"): ?>
	<?= $arResult["FORM_ERRORS_TEXT"]; ?>
<? endif; ?>

<?= $arResult["FORM_NOTE"] ?>

<? if ($arResult["isFormNote"] != "Y"): ?>
	<?= $arResult["FORM_HEADER"] ?>

	<div class="cont-sect__form">
		<div class="cont-sect__form-title"><?= $arResult["FORM_TITLE"] ?></div>

		<div class="cont-sect__form-text"><?= $arResult["FORM_DESCRIPTION"] ?></div>

		<div class="cont-sect__form-inputs">
			<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>

				<? if (isset($arResult['FORM_ERRORS'][$FIELD_SID])): ?>
					<span class="error-fld" title="<?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>"></span>
				<? endif; ?>

				<div class="cont-sect__form-input" data-placeholder="-<?= $arQuestion["CAPTION"] ?>">
                    <?
                    if($arQuestion["STRUCTURE"][0]["ID"]==3){
                        echo '<p>'. $arQuestion["CAPTION"].'</p>';
                    }
                    ?>
                    <?= $arQuestion["HTML_CODE"] ?>
                </div>
			<? endforeach; ?>
		</div>

		<div class="cont-sect__form-footer">
			<div class="cont-sect__form-desc">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR . 'include/footer/cont_sect__form_desc.php'
					)
				); ?>
			</div>

			<input class="def-btn cont-sect__form-submit" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
		</div>
	</div>

	<?= $arResult["FORM_FOOTER"] ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', e => {
			Array.from(document.querySelectorAll('.cont-sect__form-input')).forEach(item => {
				item.querySelector('input').setAttribute('placeholder', item.getAttribute('data-placeholder'));
			});

			IMask(document.querySelector('input[name="form_text_2"]'), {
				mask: '+{7} (000) 000-00-00'
			})
		});
	</script>
    <script type="text/javascript">jQuery(function($){$('input[name="form_text_2"]').mask("+7(999) 999-99-99");});</script>
<? endif; ?>