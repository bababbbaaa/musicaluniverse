<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));

\Bitrix\Main\UI\Extension::load("ui.bootstrap4");
\Bitrix\Main\UI\Extension::load("jquery");
use \Bitrix\Main\Page\Asset;

$curPage = $APPLICATION->GetCurPage(true);
$curDir = $APPLICATION->GetCurDir();

?><!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<? $APPLICATION->ShowHead(); ?>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH . "/vendors/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css"?>">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH . "/vendors/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css"?>">
    <script src="<?= SITE_TEMPLATE_PATH . "/vendors/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"?>"></script>

    <script src="<?= SITE_TEMPLATE_PATH . "/new_script.js"?>"></script>
</head>
<body class="d-flex flex-column" <?$APPLICATION->ShowProperty("backgroundImage");?>>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>


<div class="wrapper d-flex flex-column" id="bx_eshop_wrap">
	<header class="">
		<div class="container">
			<!--region bx-header-->
			<div class="mt-5 mb-4 d-flex align-items-stretch  flex-column flex-lg-row position-relative">
				<div class="d-flex align-items-center justify-content-center">
					<a class="company-logo" href="<?=SITE_DIR?>">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/company_logo.php"),
							false
						);?>
					</a>
				</div>

                <div class="ml-lg-5 w-100 d-flex align-items-start flex-column">
                    <div class="d-flex w-100 align-items-center justify-content-lg-between flex-column flex-lg-row">
                        <div class="text-golden header-phone mr-3 mb-3 mb-lg-0">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/telephone.php"
                                ),
                                false
                            );?>
                        </div>

                        <div class="mx-3 mb-3 mb-lg-0">
                            <?$APPLICATION->IncludeComponent("bitrix:search.title", "main_search", Array(
                                "NUM_CATEGORIES" => "1",	// Количество категорий поиска
                                "TOP_COUNT" => "5",	// Количество результатов в каждой категории
                                "CHECK_DATES" => "N",	// Искать только в активных по дате документах
                                "SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
                                "PAGE" => SITE_DIR."search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                                "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),	// Название категории
                                "CATEGORY_0" => array(	// Ограничение области поиска
                                    0 => "no",
                                ),
                                "CATEGORY_0_iblock_catalog" => array(
                                    0 => "all",
                                ),
                                "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                                "SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
                                "INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
                                "CONTAINER_ID" => "search",	// ID контейнера, по ширине которого будут выводиться результаты
                                "PRICE_CODE" => array(	// Тип цены
                                    0 => "BASE",
                                ),
                                "SHOW_PREVIEW" => "Y",	// Показать картинку
                                "PREVIEW_WIDTH" => "75",	// Ширина картинки
                                "PREVIEW_HEIGHT" => "75",	// Высота картинки
                                "CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
                                "COMPONENT_TEMPLATE" => "bootstrap_v4",
                                "ORDER" => "date",	// Сортировка результатов
                                "USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
                                "TEMPLATE_THEME" => "blue",	// Цветовая тема
                                "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                                "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода
                                "CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
                            ),
                            false
                        );?>
                        </div>

                        <div class="btn btn-secondary mx-3 mb-3 mb-lg-0">Все страны и города</div>

                        <a href="/login" class="btn btn-primary ml-lg-auto header-btn">Войти</a>
                    </div>
                    <div class="w-100 d-flex align-items-center flex-column flex-lg-row">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
                            "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                "MENU_THEME" => "site",	// Тема меню
                                "CACHE_SELECTED_ITEMS" => "N",
                                "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                "MAX_LEVEL" => "3",	// Уровень вложенности меню
                                "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                "COMPONENT_TEMPLATE" => "bootstrap_v4"
                            ),
                            false
                        );?>
                        <a href="#" class="btn btn-secondary ml-lg-auto header-btn">Язык</a>
                    </div>
                </div>
			</div>
			<!--endregion-->

		</div>
	</header>
	<div class="workarea <?=$curDir=="/"?"main-page":"";?> pt-4 pb-5">
		<div class="container">
                <!--region breadcrumb-->
                <?if ($curPage != SITE_DIR."index.php"):?>
                    <div class="row mb-4">
                        <div class="col" id="navigation">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:breadcrumb",
                                "universal",
                                array(
                                    "START_FROM" => "0",
                                    "PATH" => "",
                                    "SITE_ID" => "-"
                                ),
                                false,
                                Array('HIDE_ICONS' => 'Y')
                            );?>
                        </div>
                    </div>
                <?endif?>
                <!--endregion-->

                <?if($APPLICATION->GetCurDir() != "/"){?>
                    <h1><?$APPLICATION->ShowTitle(false)?></h1>
                <?}?>
        </div>


        <?if($APPLICATION->GetCurDir() != "/"){?>
            <div class="container">
        <?}?>
