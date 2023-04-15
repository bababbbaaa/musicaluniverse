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

$arLikedElements = unserialize($_COOKIE['likes']);
?>


<?php
foreach ($arResult["ITEMS"] as $item){
    $arResult["CALENDAR_DATES"][] = implode(".", array_reverse( explode(".", $item["ACTIVE_FROM"])));
}
$arResult["CALENDAR_DATES"] = array_unique($arResult["CALENDAR_DATES"]);
sort($arResult["CALENDAR_DATES"]);
?>

<div class="articles-list mb-4">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
    <?endif;?>

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

            <div class="d-flex mb-4 col-12 col-lg-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-date="<?=$arItem["ACTIVE_FROM"]?>">
                <div class="card d-flex flex-column flex-md-row">

                    <button class="favor <?=in_array($arItem['ID'], unserialize($_COOKIE['favorites']))?"active":""?>" data-item="<?=$arItem['ID']?>"></button>

                    <div class="card-img-container d-flex">
                        <a class="w-100" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <img
                                    class=""
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />
                        </a>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <?$user = $arResult["USERS"][$arItem["CREATED_BY"]]?>
                        <div class="d-flex flex-row align-items-center mb-3">
                            <div class="author-photo">
                                <img src="<?=$user["PERSONAL_PHOTO"]["SRC"]?>" alt="">
                            </div>
                            <div class="author-name ml-3"><?=implode(" ", [$user["NAME"],$user["LAST_NAME"]])?></div>
                        </div>
                        <div class="mb-3 category-type">
                            <?if($arItem["PROPERTIES"]["CATEGORY"]["VALUE"]){?>
                                <span class=""><?=$arItem["PROPERTIES"]["CATEGORY"]["VALUE"]?></span>
                            <?}?>
                        </div>

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

                        <div class="date-published mb-3"><?=$arItem["TIMESTAMP_X"]?></div>

                        <?
                        $liked = "";
                        if (in_array($arItem["ID"], $arLikedElements)) {
                            $liked = "liked";
                        }
                        ?>
                        <div class="mt-auto d-flex">
                            <div class="d-flex align-items-center">
                                <span class="like-btn <?=$liked?>" data-item="<?=$arItem["ID"]?>">
                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.05189 1.29398C8.39189 0.316984 9.68389 -0.133016 10.4819 0.703984C10.6459 0.873984 10.8079 1.05798 10.9179 1.22298C11.2379 1.70298 11.3729 2.33598 11.4219 2.95298C11.4719 3.57998 11.4379 4.25398 11.3739 4.86498C11.3162 5.39585 11.2358 5.924 11.1329 6.44798L11.1229 6.49998H12.0059C12.4454 6.49992 12.8795 6.59641 13.2776 6.78264C13.6757 6.96887 14.028 7.24029 14.3096 7.5777C14.5912 7.91511 14.7952 8.31027 14.9072 8.73524C15.0193 9.16021 15.0366 9.6046 14.9579 10.037L14.2739 13.798C14.1624 14.4117 13.9245 14.9956 13.5754 15.5125C13.2262 16.0294 12.7734 16.468 12.2457 16.8006C11.718 17.1332 11.1269 17.3525 10.51 17.4445C9.89301 17.5365 9.26367 17.4992 8.66189 17.335L3.06189 15.808C2.61404 15.6857 2.20909 15.4411 1.89241 15.1016C1.57573 14.7622 1.35982 14.3412 1.26889 13.886L0.915887 12.121C0.637887 10.732 1.69989 9.56198 2.82889 9.11598C3.13498 9.00216 3.41914 8.8364 3.66889 8.62598C5.37589 7.11198 5.99389 5.90298 7.05389 3.77598C7.40789 3.06598 7.77189 2.09998 8.05189 1.29398ZM10.0169 6.87898V6.87698L10.0189 6.86998L10.0259 6.83898C10.0721 6.64526 10.1141 6.45054 10.1519 6.25498C10.2279 5.86698 10.3189 5.33498 10.3789 4.75998C10.4399 4.18298 10.4689 3.57598 10.4249 3.03198C10.3809 2.47598 10.2649 2.04698 10.0849 1.77698C9.98625 1.64111 9.87726 1.51306 9.75889 1.39398C9.55989 1.18598 9.13089 1.23398 8.99689 1.62198C8.71389 2.43598 8.33289 3.45198 7.94889 4.22198C6.88189 6.36298 6.19289 7.72398 4.33289 9.37398C3.99289 9.67598 3.58889 9.89098 3.19689 10.046C2.31689 10.394 1.74989 11.194 1.89689 11.925L2.24889 13.69C2.30358 13.9632 2.43331 14.2159 2.62355 14.4195C2.81378 14.6232 3.05698 14.7698 3.32589 14.843L8.92589 16.37C9.39381 16.4975 9.88314 16.5265 10.3628 16.4549C10.8425 16.3834 11.3021 16.2129 11.7124 15.9543C12.1228 15.6958 12.4749 15.3547 12.7464 14.9529C13.018 14.551 13.203 14.0971 13.2899 13.62L13.9739 9.85798C14.0263 9.56973 14.0148 9.27347 13.9401 8.99015C13.8654 8.70684 13.7294 8.4434 13.5417 8.21846C13.3539 7.99352 13.1191 7.81258 12.8537 7.68842C12.5883 7.56427 12.2989 7.49994 12.0059 7.49998H10.5009C10.425 7.49981 10.3502 7.48238 10.2821 7.449C10.2139 7.41563 10.1543 7.36719 10.1077 7.30735C10.061 7.24751 10.0286 7.17785 10.0129 7.10363C9.99716 7.02942 9.99853 6.95259 10.0169 6.87898Z" fill="black"/>
                                        <path d="M10.0169 6.87898V6.87698L10.0189 6.86998L10.0259 6.83898C10.0721 6.64526 10.1141 6.45054 10.1519 6.25498C10.2279 5.86698 10.3189 5.33498 10.3789 4.75998C10.4399 4.18298 10.4689 3.57598 10.4249 3.03198C10.3809 2.47598 10.2649 2.04698 10.0849 1.77698C9.98625 1.64111 9.87726 1.51306 9.75889 1.39398C9.55989 1.18598 9.13089 1.23398 8.99689 1.62198C8.71389 2.43598 8.33289 3.45198 7.94889 4.22198C6.88189 6.36298 6.19289 7.72398 4.33289 9.37398C3.99289 9.67598 3.58889 9.89098 3.19689 10.046C2.31689 10.394 1.74989 11.194 1.89689 11.925L2.24889 13.69C2.30358 13.9632 2.43331 14.2159 2.62355 14.4195C2.81378 14.6232 3.05698 14.7698 3.32589 14.843L8.92589 16.37C9.39381 16.4975 9.88314 16.5265 10.3628 16.4549C10.8425 16.3834 11.3021 16.2129 11.7124 15.9543C12.1228 15.6958 12.4749 15.3547 12.7464 14.9529C13.018 14.551 13.203 14.0971 13.2899 13.62L13.9739 9.85798C14.0263 9.56973 14.0148 9.27347 13.9401 8.99015C13.8654 8.70684 13.7294 8.4434 13.5417 8.21846C13.3539 7.99352 13.1191 7.81258 12.8537 7.68842C12.5883 7.56427 12.2989 7.49994 12.0059 7.49998H10.5009C10.425 7.49981 10.3502 7.48238 10.2821 7.449C10.2139 7.41563 10.1543 7.36719 10.1077 7.30735C10.061 7.24751 10.0286 7.17785 10.0129 7.10363C9.99716 7.02942 9.99853 6.95259 10.0169 6.87898Z" fill="white"/>
                                    </svg>
                                </span>
                                <div class="ml-2"><?= $arItem["PROPERTIES"]["LIKES"]["VALUE"] ?: "0"?></div>
                            </div>
                            <a class="btn btn-primary ml-auto" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
                        </div>
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

    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>
