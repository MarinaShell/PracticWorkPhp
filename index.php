<?php
include 'array.php';

/*****************************************************************************/
/*принимает как аргумент три строки — фамилию, имя и отчество. 
Возвращает как результат их же, но склеенные через пробел. */
function getFullnameFromParts($surname, $name, $patronomyc){
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

    return $arrayFIO['name']." ".$shortSurname.".";
}

/*Функция определения пола по ФИО*/
include 'defGender.php';

/*Определение возрастно-полового состава*/
include 'defCompositionGender.php';

/*Проверка работоспособности функций*/
//echo getFullnameFromParts('Иванов', 'Иван', 'Иванович');
//var_dump(getPartsFromFullname('Иванов Иван Иванович'));
//echo getShortName('Иванов Сергей Андреевич');
// $prName = getGenderFromName('ИванОВ СергеЙ АндреевИЧ');
// if ($prName>0)
//     echo "мужчина";
// elseif ($prName<0)
//     echo "женщина";
// else     
//     echo "что-то непонятное";

getGenderDescription();
?>
