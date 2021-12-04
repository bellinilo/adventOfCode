<?php
$list = file_get_contents("04/input.txt");
$set = prepareSet($list);
foreach ($set["calls"] as $call_key => $call) {
    call($call, $set["sheets"]);
    $winner_sheets = checkSheets($set["sheets"]);
    if(!empty($winner_sheets)){
        $winner_sheet_value=calculateWinner($winner_sheets[0]);
        $first_count = $winner_sheet_value * $call;
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
                    $sheets[$sheet_key]["row_calls"][$sheet_line_key][$sheet_line_number_key] = $sheet_line_number;
                    $sheets[$sheet_key]["col_calls"][$sheet_line_number_key][$sheet_line_key] = $sheet_line_number;
                }
            }
        }
    }
}

function checkSheets(&$sheets){
    foreach ($sheets as $sheet_key => $sheet) {
        if(!array_key_exists("row_calls", $sheet)) continue;
        if(!array_key_exists("col_calls", $sheet)) continue;
        if (checkSheet($sheet["row_calls"]) ||
            checkSheet($sheet["col_calls"])){
            $results[] = $sheet;
        }
    }
    if (!empty($results)) {
        return $results;
    }
    return false;
}

function checkSheet($sheet_lines){
    foreach ($sheet_lines as $sheet_line_key => $sheet_line) {
        if(count($sheet_line)==5){
            return true;
        }
    }
    return false;
}

function calculateWinner($sheet){
    $result=0;
    foreach ($sheet["lines"] as $line_key => $line) {
        foreach ($line as $number_key => $number) {
            if(!array_key_exists($line_key, $sheet["row_calls"]) ||
                !array_key_exists($number_key, $sheet["row_calls"][$line_key])){
                $result += $number;
            }
        }
    }
    return $result;
}
