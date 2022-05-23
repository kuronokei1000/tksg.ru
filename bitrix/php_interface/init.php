<?
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
	function BeforeIndexHandler($arFields) {
	$arrIblock = array(23);
	  $arDelFields = array("DETAIL_TEXT", "PREVIEW_TEXT") ;
	  if (CModule::IncludeModule('iblock') && $arFields["MODULE_ID"] == 'iblock' && in_array($arFields["PARAM2"], $arrIblock) && intval($arFields["ITEM_ID"]) > 0){
	  $dbElement = CIblockElement::GetByID($arFields["ITEM_ID"]) ;
	  if ($arElement = $dbElement->Fetch()){
	    foreach ($arDelFields as $value){
	    if (isset ($arElement[$value]) && strlen($arElement[$value]) > 0){
	      $arFields["BODY"] = str_replace (CSearch::KillTags($arElement[$value]) , "", CSearch::KillTags($arFields["BODY"]) );
	      }
	    }
	  }
	  return $arFields;
	  }
	}
?>