<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
?>

<div class="empty-sect">
	<div class="empty-sect__container">
		<div class="empty-sect__img">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . 'include/404/img.php'
				)
			); ?>
		</div>

		<div class="def-title empty-sect__title">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . 'include/404/title.php'
				)
			); ?>
		</div>

		<div class="empty-sect__subtitle">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . 'include/404/subtitle.php'
				)
			); ?>
		</div>

		<div class="empty-sect__text">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . 'include/404/text.php'
				)
			); ?>
		</div>

		<div class="empty-sect__btns">
			<a class="def-btn empty-sect__btn" href="<?= SITE_DIR ?>catalog/">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR . 'include/404/btn1.php'
					)
				); ?>
			</a>

			<a class="def-btn def-btn--trsp empty-sect__btn" href="<?= SITE_DIR ?>">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR . 'include/404/btn2.php'
					)
				); ?>
			</a>
		</div>
	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>