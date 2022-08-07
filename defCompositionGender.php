<?php

/*****************************************************************************/
/*фильруем массив по мужскому полу*/
function definitionMan($var){
    $res = getGenderFromName($var['fullname']);
    if ($res>0)
        return true;
    else
        return false;     
}

/*****************************************************************************/
/*фильруем массив по женскому полу*/
function definitionWoman($var){
    return (getGenderFromName($var['fullname'])<0); 
}

/*****************************************************************************/
/*Определение возрастно-полового состава*/
function getGenderDescription($arrayList){

    /*проверяем является ли переменная массивом*/
    if (!is_array($arrayList))
        return -1;
    /*проверяем есть ли такой ключ в массиве*/
    foreach ($arrayList as $arr){
        if (!is_array($arr))
            return -1;
        if (!array_key_exists('fullname', $arr)){   
            return -1;
        }    
    }
    /*всего элементов в массиве*/      
    $all = count($arrayList);
    if ($all === 0)
        return -1;
    /*массив мужчин*/
    /*фильруем массив по мужскому полу*/
    $arrayListMan = array_filter($arrayList, "definitionMan");
    /*массив женщин*/
    /*фильруем массив по женскому полу*/
    $arrayListWoman = array_filter($arrayList, "definitionWoman"); 
    /*элементов в массиве мужчин*/
    $man = count($arrayListMan);
    /*элементов в массиве женщин*/
    $woman = count($arrayListWoman);
    /*проценты мужчин*/
    $percentMan = intval($man/$all*100);
    /*проценты женщин*/
    $percentWoman = intval($woman/$all*100);
    /*проценты всех остальных*/
    $percentRest = 100 - $percentMan - $percentWoman;
    echo nl2br("Гендерный состав аудитории:\n");
    echo nl2br("---------------------------\n");
    echo nl2br("Мужчины - $percentMan%\n");
    echo nl2br("Женщины - $percentWoman%\n");
    echo nl2br("Не удалось определить - $percentRest%");

    return 1;
}


?>