<?php 

/**
 * Logic assumption for employee of the week
 * As there is 3 Parameter find highest score person for individual parameter
 * Then Summarize score for all parameter that person gain as highest
 * finally get highest score from all summarize parameter score
 * person who get highest score considered as Employee of the week
 */
$emp_data_set = array(
    0 => array(
     'name' => 'Peter Parker',
     'parameter' => array(
         'attendance' => array(6,4,7,5,5),
         'productivity' => array(3,4,3,5,5),
         'client_feedback' => array(4,6,5,4,4)
     )
    ),
    1 => array(
        'name' => 'Steve Rogers',
        'parameter' => array(
            'attendance' => array(8,9,7,6,8),
            'productivity' => array(3,4,8,6,5),
            'client_feedback' => array(7,7,5,8,9)
        )
    ),
    2 => array(
            'name' => 'Peter Parker',
            'parameter' => array(
                'attendance' => array(3,4,6,4,5),
                'productivity' => array(9,9,8,7,7),
                'client_feedback' => array(6,7,6,5,6)
            )
    ),
);

$score_data = array();
// iterate dataset to sum parameter wise score
foreach ($emp_data_set as $key => $value) {
    foreach ($value['parameter'] as $par_key => $par_val) {
        foreach ($par_val as $day_key => $day_value) {
            if(isset($score_data[$par_key][$key])){
                $score_data[$par_key][$key] += $day_value;
            }else {
                $score_data[$par_key][$key] = $day_value;
            }
        }
    }
}
$person_param_score = array();
//check higher score for each parameter (person wise and parameter wise)
foreach ($score_data as $key => $value) {
    $max_index = array_keys($value, max($value));
    foreach ($max_index as $mkey => $mvalue) {
        $person_param_score[$mvalue][] = $key;
    }
    
}

//calcualte total score based on higher parameter score
$person_total_score = array();
foreach ($person_param_score as $key => $value) {
    foreach ($value as $pkey => $pvalue) {
        //get parameter score
        $param_score = $score_data[$pvalue][$key];
        if(isset($person_total_score[$key])){
            $person_total_score[$key] += $param_score;
        }else {
            $person_total_score[$key] = $param_score;
        }
    }
}

//find highest score of person
$person_index = array_keys($person_total_score, max($person_total_score));

if(count($person_index>0)){
    foreach ($person_index as $key => $value) {
        if(isset($emp_data_set[$value])){
            echo "<br>Employee Of the Week is <b>".$emp_data_set[$value]['name']."</b>";
        }
    }
}
else {
    echo "No one is applicable for Employee Of the Week";
}
?>
