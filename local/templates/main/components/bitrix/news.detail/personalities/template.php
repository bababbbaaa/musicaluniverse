<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

CUtil::InitJSCore(array('fx'));

?>
<div class="news-detail">
	<div class="mb-3" id="<?echo $this->GetEditAreaId($arResult['ID'])?>">


        <div class="row">
            <div class="col-4">

                <div class="mb-5 news-detail-img">
                    <img
                            class="card-img-top"
                            src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                            alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                            title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                    />
                </div>
                <? foreach ($arResult["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"] as $i => $item) {?>
                    <div class="mb-5 news-detail-img">
                        <img
                                class="card-img-top"
                                src="<?=$item["SRC"]?>"
                        />
                    </div>
                <?}?>
            </div>

            <div class="col-8 news-detail-body bg-light position-relative">

                <button class="favor <?=in_array($arResult['ID'], unserialize($_COOKIE['favorites']))?"active":""?>  d-flex position-relative ml-auto" data-item="<?=$arResult['ID']?>"></button>



                <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                    <h3 class="news-detail-title"><?=$arResult["NAME"]?></h3>
                <?endif;?>


                <div><?=$arResult["DISPLAY_PROPERTIES"]["OCCUPATION"]["VALUE"]?></div>





                <div class="news-detail-content">
                    <?if($arResult["NAV_RESULT"]):?>
                        <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
                        <?echo $arResult["NAV_TEXT"];?>
                        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
                    <?elseif($arResult["DETAIL_TEXT"] <> ''):?>
                        <?echo $arResult["DETAIL_TEXT"];?>
                    <?else:?>
                        <?echo $arResult["PREVIEW_TEXT"];?>
                    <?endif?>
                </div>

            </div>
        </div>

		<?if(($arParams["USE_RATING"]=="Y") && ($arParams["USE_SHARE"] == "Y")) {?> <div class="d-flex justify-content-between"> <? } ?>

			<?if($arParams["USE_RATING"]=="Y"):?>
				<div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:iblock.vote",
						"bootstrap_v4",
						Array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"ELEMENT_ID" => $arResult["ID"],
							"MAX_VOTE" => $arParams["MAX_VOTE"],
							"VOTE_NAMES" => $arParams["VOTE_NAMES"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
							"SHOW_RATING" => "Y",
						),
						$component
					);?>
				</div>
			<?endif?>

			<?if ($arParams["USE_SHARE"] == "Y"):?>
				<div>
					<noindex>
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:main.share",
							$arParams["SHARE_TEMPLATE"],
							array(
								"HANDLERS" => $arParams["SHARE_HANDLERS"],
								"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
								"PAGE_TITLE" => $arResult["~NAME"],
								"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
								"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
								"HIDE" => $arParams["SHARE_HIDE"],
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);
						?>
					</noindex>
				</div>
			<?endif?>

		<?if(($arParams["USE_RATING"]=="Y") && ($arParams["USE_SHARE"] == "Y")) {?> </div> <? } ?>

	<?foreach($arResult["FIELDS"] as $code=>$value):?>
		<?if($code == "SHOW_COUNTER"):?>
			<div class="news-detail-view"><?=GetMessage("IBLOCK_FIELD_".$code)?>: <?=intval($value);?></div>
		<?elseif($code == "SHOW_COUNTER_START" && $value):?>
			<? $value = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($value, CSite::GetDateFormat())); ?>
			<div class="news-detail-date"><?=GetMessage("IBLOCK_FIELD_".$code)?>: <?=$value;?> </div>
		<?elseif($code == "TAGS" && $value):?>
			<div class="news-detail-tags"><?=GetMessage("IBLOCK_FIELD_".$code)?>: <?=$value;?> </div>
		<?elseif($code == "CREATED_USER_NAME"):?>
			<div class="news-detail-author"><?=GetMessage("IBLOCK_FIELD_".$code)?>: <?=$value;?> </div>
		<?elseif ($value != ""):?>
			<div class="news-detail-other"><?=GetMessage("IBLOCK_FIELD_".$code)?>: <?=$value;?></div>
		<?endif;?>
	<?endforeach;?>

	<?/*foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<?
		if(is_array($arProperty["DISPLAY_VALUE"]))
			$value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
		else
			$value = $arProperty["DISPLAY_VALUE"];
		?>
		<?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT"):?>
			<div class="news-detail-comments"><?=$arProperty["NAME"]?>: <?=$value;?> </div>
		<?elseif ($value != ""):?>
			<div class="news-detail-other"><?=$arProperty["NAME"]?>: <?=$value;?> </div>
		<?endif;?>
	<?endforeach;*/?>

	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<div class="news-detail-date"><?echo $arResult["DISPLAY_ACTIVE_FROM"]?></div>
	<?endif?>



	</div>
</div>
<script type="text/javascript">
	BX.ready(function() {
		var slider = new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']));?>', {
			imagesContainerClassName: 'news-detail-slider-container',
			leftArrowClassName: 'news-detail-slider-arrow-container-left',
			rightArrowClassName: 'news-detail-slider-arrow-container-right',
			controlContainerClassName: 'news-detail-slider-control'
		});
	});
</script>
