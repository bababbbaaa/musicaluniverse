<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
/* Лайки */

CModule::IncludeModule("iblock");

global $APPLICATION;
if($_GET['id'])
{
    if(empty($arElements)) {
        $arElements = unserialize($_COOKIE['likes']);
    }

    if(!in_array($_GET['id'], $arElements))
    {
        $arElements[] = $_GET['id'];
        $count = 1;
    } else {
        $key = array_search($_GET['id'], $arElements);
        unset($arElements[$key]);
        $count = -1;
    }



    $res = CIBlockElement::GetByID($_GET["id"]);
    if($ar_res = $res->GetNextElement()) {
        $arProperties = $ar_res->GetProperties();
        $result = $arProperties["LIKES"]["VALUE"] + $count;
        CIBlockElement::SetPropertyValuesEx($_GET['id'], false, array("LIKES" => $result));
    }


    if(empty($arElements)){
        setcookie("likes", '', time() - 1, "/", $_SERVER['SERVER_NAME'], false);
    } else {
        $arElements = array_unique($arElements);
        setcookie("likes", serialize($arElements), time()+60*60*24*30*12*20, "/", $_SERVER['SERVER_NAME'], false);
    }
}
echo json_encode($result);
die();
?>