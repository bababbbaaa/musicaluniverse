<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['funcGetInputHtml'] = function($question, $arrVALUES) {
    $id = $question['STRUCTURE'][0]['ID'];
    $caption = $question['CAPTION'];
    $type = $question['STRUCTURE'][0]['FIELD_TYPE'];
    $name = "form_{$type}_{$id}";
    $value = isset($arrVALUES[$name]) ? htmlentities($arrVALUES[$name]) : '';
    $required = $question['REQUIRED'] === 'Y' ? 'required' : '';
    $class = ' ' . $question['STRUCTURE'][0]['FIELD_PARAM'];

    switch ($type)
    {
        case 'checkbox':
            $name = "form_{$type}_APPROVAL[]";
            $input = "<input id=\"question-form-approval\" type=\"checkbox\" name=\"{$name}\" {$required} value=\"5\">";
            break;

        case 'textarea':
            $input = "<textarea class=\"form-control {$class}\" name=\"{$name}\" placeholder=\"{$caption}\" {$required}>{$value}</textarea>";
            break;

        // case 'text':
        default:
            $input = "<input class=\"form-control {$class}\" type=\"text\" name=\"{$name}\" placeholder=\"{$caption}\" value=\"{$value}\" {$required}>";
            break;
    }

    return $input;
};