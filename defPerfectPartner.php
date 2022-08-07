<?php


function getPerfectPartner($surname, 
                           $name,
                           $patronomyc,
                           $arrayList){
                          
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

    $fullName = getFullnameFromParts($surname, $name, $patronomyc);
    $res1 = getGenderFromName($fullName);
   
    $num = 0;
    do{                        
        $num = array_rand($arrayList, 1);
        $res2 = getGenderFromName($arrayList[$num]['fullname']);        
    }
    while ($res2===$res1 || $res2==0) ;

    $unicodeChar = "\u{2661}";
    $percent = randomFloat(50, 100);
    print(getShortName($fullName)." + ". 
    getShortName($arrayList[$num]['fullname']).
    " = $unicodeChar Идеально на ".number_format($percent, 2, '.', '')."% $unicodeChar");

}

?>