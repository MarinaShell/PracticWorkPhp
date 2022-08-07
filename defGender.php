<?php

/*****************************************************************************/
/*Функция определения пола по отчеству
принимает как аргумент отчество */
function getGenderFromPatronomyc($patronomyc){
    if (mb_strtolower(mb_substr($patronomyc, mb_strlen($patronomyc)-3, 3)) === 'вна')
        return -1;
    elseif (mb_strtolower(mb_substr($patronomyc, mb_strlen($patronomyc)-2, 2)) === 'ич')
        return 1;
    else
        return 0;
}

/*****************************************************************************/
/*Функция определения пола по имени
принимает как аргумент имя */
function getGenderFromFirstName($name){
    $shortName = mb_strtolower(mb_substr($name, mb_strlen($name)-1, 1));

    if ($shortName === 'а')
        return -1;
    elseif ($shortName === 'н' || $shortName === 'й')
        return 1;
    else
        return 0;
}

/*****************************************************************************/
/*Функция определения пола по фамилии
принимает как аргумент фамилия */
function getGenderFromSurname($surname){
    if (mb_strtolower(mb_substr($surname, mb_strlen($surname)-2, 2)) === 'ва')
        return -1;
    elseif (mb_strtolower(mb_substr($surname, mb_strlen($surname)-1, 1)) === 'в')
        return 1;
    else
        return 0;
}


/*****************************************************************************/
/*Функция определения пола по ФИО
принимает как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович»). */
function getGenderFromName($fullName){

    $arrayFIO = getPartsFromFullname($fullName);

    /*признак пола*/
    $prGender = 0;

    $prGender = $prGender + getGenderFromPatronomyc($arrayFIO['patronomyc']);
    $prGender = $prGender + getGenderFromFirstName($arrayFIO['name']);
    $prGender = $prGender + getGenderFromSurname($arrayFIO['surname']);
    if ($prGender>0)
        return 1;
    elseif ($prGender<0)
        return -1;
    else
        return 0;
}


?>