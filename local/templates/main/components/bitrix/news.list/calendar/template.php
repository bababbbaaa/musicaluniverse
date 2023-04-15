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

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';


?>


<?php
foreach ($arResult["ITEMS"] as $item){
    $arResult["CALENDAR_DATES"][] = implode(".", array_reverse( explode(".", $item["ACTIVE_FROM"])));
}
$arResult["CALENDAR_DATES"] = array_unique($arResult["CALENDAR_DATES"]);
sort($arResult["CALENDAR_DATES"]);
?>

<div>
    <div id="calendar_dates" class="owl-carousel my-4"></div>

    <script>
      let calendarDates = <?=CUtil::PhpToJSObject($arResult["CALENDAR_DATES"])?>;
      let firstDate = new Date(...calendarDates[0].split('.'));
      firstDate.setMonth(firstDate.getMonth() - 1);
      firstDate.setDate(1);

      let lastDate = new Date(...calendarDates[calendarDates.length-1].split('.'));
      lastDate.setMonth(lastDate.getMonth() - 1);
      lastDate = new Date(lastDate.getFullYear(), lastDate.getMonth() + 1, 0);

      let days = ['вс','пн','вт','ср','чт','пт','сб'];
      let months = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];

      let monthContainer, monthInnerContainer;
      let calendarContainer = document.getElementById("calendar_dates");
      let currentDate = new Date();
      let currentDateString = [
        currentDate.getFullYear(),
        (currentDate.getMonth() + 1).toString().length<2 ? "0"+(currentDate.getMonth()+1) : currentDate.getMonth()+1,
        currentDate.getDate().toString().length<2 ? "0"+currentDate.getDate() : currentDate.getDate()
      ].join(".");


      for(let curDate = firstDate; curDate <= lastDate; curDate.setDate(curDate.getDate() + 1)){
        let curDateString = [
          curDate.getFullYear(),
          (curDate.getMonth() + 1).toString().length<2 ? "0"+(curDate.getMonth()+1) : curDate.getMonth()+1,
          curDate.getDate().toString().length<2 ? "0"+curDate.getDate() : curDate.getDate()
        ].join(".");

        if(curDate.getDate() == 1){
          monthContainer = document.createElement("div");
          monthContainer.classList.add("calendar_dates_month","mx-5");

          let monthName = document.createElement("div");
          monthName.innerHTML =  months[curDate.getMonth()] + " " + curDate.getFullYear();
          monthContainer.append(monthName);

          monthInnerContainer = document.createElement("div");
          monthInnerContainer.classList.add("d-flex","justify-content-between");
          monthContainer.append(monthInnerContainer);
        }

        let dayContainer = document.createElement("div");

        dayContainer.classList.add("calendar_dates_date","d-flex","flex-column","align-items-center","p-1","element-bg");

        if(currentDateString == curDateString) {
          dayContainer.classList.remove("element-bg");
          dayContainer.classList.remove("bg-light");
          dayContainer.classList.add("bg-golden");
        }

        if(calendarDates.includes(curDateString)) {
          dayContainer.classList.remove("bg-light");
          dayContainer.classList.remove("element-bg");
          dayContainer.classList.add("bg-golden");
          dayContainer.setAttribute("role", "button");
          dayContainer.onclick = function(){
            let elements = document.getElementsByClassName('calendar-item');
            for (let el of elements){
              el.setAttribute("style","display:none");
            }
            let visElements = document.querySelectorAll('[data-date="' + curDateString.split(".").reverse().join(".") + '"]');
            for (let el of visElements){
              el.removeAttribute("style");
            }
          }
        }

        let dateRow = document.createElement("span");
        let dayRow = document.createElement("span");
        dateRow.innerHTML = curDate.getDate();
        dayRow.innerHTML = days[curDate.getDay()];

        dayContainer.append(dateRow);
        dayContainer.append(dayRow);

        monthInnerContainer.append(dayContainer);

        if(curDate.getDate() == new Date(curDate.getFullYear(), curDate.getMonth() + 1, 0).getDate()){
          calendarContainer.append(monthContainer);
        }
      }
    </script>

    <script>
          $(document).ready(function(){
            $("#calendar_dates").owlCarousel({
              center: true,
              items:1,
              nav:true,
              navText: "",
              dots: false,
              startPosition: 7
            });
          });
    </script>

    <div class="row">
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

            <div class="calendar-item d-flex mb-4 col-12 col-md-6 col-lg-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-date="<?=$arItem["ACTIVE_FROM"]?>">
                <div class="card">

                    <button class="favor <?=in_array($arItem['ID'], unserialize($_COOKIE['favorites']))?"active":""?>" data-item="<?=$arItem['ID']?>"></button>

                    <?php
                    $type = $arItem["PROPERTIES"]["TYPE"]["VALUE_XML_ID"];
                    ?>
                    <span class="event_type <?=$type?>"></span>

                    <div class="card-img-container">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <img
                                    class=""
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />
                        </a>
                        <a class="btn btn-primary" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Купить
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/ticket.svg" alt=""></a>
                    </div>


                    <div class="card-body d-flex flex-column">
                        <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                            <div class="card-title">
                                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
                                <?else:?>
                                    <?echo $arItem["NAME"]?>
                                <?endif;?>
                            </div>
                        <?endif;?>

                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                            <p class="card-text"><?echo $arItem["PREVIEW_TEXT"];?></p>
                        <?endif;?>

                        <div class="date-published mt-auto"><?=$arItem["TIMESTAMP_X"]?></div>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>

    <?if(count(explode("/",$APPLICATION->GetCurDir())) <= 3 && $APPLICATION->GetCurDir() != $arResult["LIST_PAGE_URL"]){?>
        <div class="text-center mt-4">
            <a href="<?=$arResult["LIST_PAGE_URL"]?>" class="btn btn-secondary py-2 px-4">Показать больше</a>
        </div>
    <?}?>
</div>
