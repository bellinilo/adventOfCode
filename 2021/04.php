<?php
$list = file_get_contents("04/input.txt");
$set = prepareSet($list);
foreach ($set["calls"] as $call_key => $call) {
    call($call, $set["sheets"]);
    $check = checkSheets($set["sheets"]);
    if(!empty($check)){
        $first_count=calculateWinner($check[0], $call);
        break;
    }
}

echo $first_count;

function prepareSet($list){
    $blocks = explode("\n\n", $list);
    foreach ($blocks as $block_key => $block) {
        if($block_key==0) {
            $set["calls"] = explode(",", $block);
            continue;
        }
        $set["sheets"][] = sheetify($block);
    }
    return $set;
}

function sheetify($block){
    $lines = explode("\n", $block);
    foreach ($lines as $line_key => $line) {
        $sheet["lines"][] = preg_split('/\s+/', trim($line));
    }
    return $sheet;
}

function call($call, &$sheets){
    foreach ($sheets as $sheet_key => $sheet) {
        foreach ($sheet["lines"] as $sheet_line_key => $sheet_line) {
            foreach ($sheet_line as $sheet_line_number_key => $sheet_line_number) {
                if($sheet_line_number == $call){
                    $sheets[$sheet_key]["line_calls"][$sheet_line_key][$sheet_line_number_key] = $sheet_line_number;
                }
            }
        }
    }
}

function checkSheets(&$sheets){
    foreach ($sheets as $sheet_key => $sheet) {
        if(!array_key_exists("line_calls", $sheet)) continue;
        $sheet_calls= $sheet["line_calls"];
        foreach ($sheet["line_calls"] as $sheet_line_key => $sheet_line) {
            if(count($sheet_line)==5){
                $results[] = $sheet;
            }
        }
    }
    if (!empty($results)) {
        return $results;
    }
    return false;
}

function calculateWinner($sheet, $call){
    $result=0;
    foreach ($sheet["lines"] as $line_key => $line) {
        foreach ($line as $number_key => $number) {
            if(!array_key_exists($line_key, $sheet["line_calls"]) ||
                !array_key_exists($number_key, $sheet["line_calls"][$line_key])){
                $result += $number;
            }
        }
    }
    $result *= $call;
    return $result;
}
