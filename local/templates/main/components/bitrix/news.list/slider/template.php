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
?>

<div class="slider-container">
    <?if($arResult["ID"] == 6){?>
        <div class="top-line"><img src="<?=SITE_TEMPLATE_PATH?>/images/Vector_16.svg" alt=""></div>
        <div class="bottom-line"><img src="<?=SITE_TEMPLATE_PATH?>/images/Vector_15.svg" alt=""></div>
    <?}?>
    <div class="container">
        <div id="slider_<?=$arResult["ID"]?>" class="owl-carousel">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
					$this->AddEditAction(
						$arItem['ID'],
						$arItem['EDIT_LINK'],
						CIBlock::GetArrayByID(
							$arItem["IBLOCK_ID"],
							"ELEMENT_EDIT"
						)
					);
					$this->AddDeleteAction(
						$arItem['ID'],
						$arItem['DELETE_LINK'],
						CIBlock::GetArrayByID(
							$arItem["IBLOCK_ID"],
							"ELEMENT_DELETE"),
						array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
					);
				?>
				<div class="mb-2 col-sm" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="card">

                        <button class="favor <?=in_array($arItem['ID'], unserialize($_COOKIE['favorites']))?"active":""?>" data-item="<?=$arItem['ID']?>"></button>


                        <div class="card-img-container" style="background-image: url('<?=$arItem["DETAIL_PICTURE"]["SRC"]?>')">
                            <a class="btn btn-primary" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Купить &nbsp;&nbsp;<img src="<?=SITE_TEMPLATE_PATH?>/images/ticket.svg" alt=""></a>
                        </div>

						<div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="afisha-date">
                                    30 сентября
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <h4 class="card-title">
                                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
                                        <?else:?>
                                            <?echo $arItem["NAME"]?>
                                        <?endif;?>
                                    </h4>

                                    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                                        <p class="card-text"><?echo $arItem["PREVIEW_TEXT"];?></p>
                                    <?endif;?>
                                </div>
                            </div>
						</div>
					</div>
                </div>
            <?endforeach;?>
    </div>
    </div>
    <script>
      $(document).ready(function(){
        $("#slider_<?=$arResult["ID"]?>").owlCarousel({
          center: true,
          items: 1,
          loop:true,
          nav: true,
          navText: "",
          dots: false,
          margin: 20,
          responsive:{
            1280:{
              items: 1.3
            },
            1440:{
              items: 1.45
            },
            1600:{
              items: 1.4
            },
            1920:{
              items: 1.64
            }
          }
        });
      });
    </script>
</div>