<?php
include 'array.php';

/*****************************************************************************/
/*принимает как аргумент три строки — фамилию, имя и отчество. 
Возвращает как результат их же, но склеенные через пробел. */
function getFullnameFromParts($surname, $name, $patronomyc){
    $surname = mb_convert_case($surname, MB_CASE_TITLE, "UTF-8");
    $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
    $patronomyc = mb_convert_case($patronomyc, MB_CASE_TITLE, "UTF-8");

    return "$surname $name $patronomyc \r\n"; 
} 

/*****************************************************************************/
/*принимает как аргумент одну строку — склеенное ФИО. Возвращает как результат 
массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’.*/
function getPartsFromFullname($fullName){
    $listArray = explode(" ", $fullName);
    $arrayFiO = array(
         "name"=>$listArray[1],
         "surname"=>$listArray[0],
         "patronomyc"=>$listArray[2],    
    );
    return $arrayFiO;
}

/*****************************************************************************/
/*принимает как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» 
и возвращает строку вида «Иван И.», где сокращается фамилия и отбрасывается 
отчество. */
function getShortName($fullName){
    $arrayFIO = getPartsFromFullname($fullName);
    $shortSurname = substr($arrayFIO['surname'], 
                    0, 
                    2);  

    $shortSurname = mb_convert_case($shortSurname, MB_CASE_TITLE, "UTF-8");
    $name = mb_convert_case($arrayFIO['name'], MB_CASE_TITLE, "UTF-8");
    return $name." ".$shortSurname.".";
}

function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}

/*Функция определения пола по ФИО*/
include 'defGender.php';

/*Определение возрастно-полового состава*/
include 'defCompositionGender.php';

/*Идеальный подбор пары*/
include 'defPerfectPartner.php';

/*Проверка работоспособности функций*/
echo nl2br("getFullnameFromParts():\n");
echo getFullnameFromParts('ИванОВ', 'Иван', 'Иванович');
echo nl2br("\n\ngetPartsFromFullname():\n");
var_dump(getPartsFromFullname('Иванов Иван Иванович'));
echo nl2br("\n\ngetShortName():\n");
echo getShortName('иванОВ сергей Андреевич');
echo nl2br("\n\ngetGenderFromName():\n");
$prName = getGenderFromName('ИванОВ СергеЙ АндреевИЧ');
if ($prName>0)
    echo "мужчина";
elseif ($prName<0)
    echo "женщина";
else     
    echo "что-то непонятное";

echo nl2br("\n\ngetGenderDescription():\n");
if (getGenderDescription($example_persons_array)<0)
    echo "массив не имеет нужных значений";

echo nl2br("\n\ngetPerfectPartner():\n");
if (getPerfectPartner('ИВАНОВ', 'иВАН', 'ИвановИЧ', $example_persons_array))
    echo "массив не имеет нужных значений";

?>
