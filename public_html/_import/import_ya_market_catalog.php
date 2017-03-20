<?php
/**
 * Created by PhpStorm.
 * User: Zakusilo
 * Date: 20.03.2017
 * Time: 9:58
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$USER->Authorize(1);
CModule::includeModule('iblock');
$ibs = new CIBlockSection();
$arFields = Array(
    "ACTIVE" => "Y",
    "IBLOCK_SECTION_ID" => "", // Родительстакая категория
    "IBLOCK_ID" => 2, // Родительстакая категория
    "NAME" => "",
    "CODE" => "",
    "SORT" => 500,
    "PICTURE" => NULL,          // \CFile - массив файла картинки
    "DESCRIPTION" => "",
    "DESCRIPTION_Section" => "", // Описание секции

);

ini_set('auto_detect_line_endings',TRUE);
$handle = fopen('market_categories.csv','r');
$arCatIDs = array();
$iCatIDs = 0;
while ( ($data = fgetcsv($handle) ) !== FALSE ) {
$arCategory = explode('/', $data[0]);
    for ($key = 0; $key < count($arCategory); $key++){
        if(empty($arCatIDs[$arCategory[$key]])){
            $arFields['NAME'] = $arCategory[$key];
            $arFields['CODE'] = CUtil::translit($arCategory[$key], 'ru');
            $arCatIDs[$arCategory[$key]]['id'] = $ibs->Add($arFields);
        }
    }
    for ($key = 0; $key < count($arCategory); $key++){
        $ibs->Update($arCatIDs[$arCategory[$key]]['id'], array('IBLOCK_SECTION_ID' => $arCatIDs[$arCategory[$key-1]]['id']));
        $arCatIDs[$arCategory[$key]]['parent_id'] = $arCatIDs[$arCategory[$key-1]]['id'];
    }
}
krumo::dump($arCatIDs);

