<?php
$list = file_get_contents("04/input.txt");
$set = prepareSet($list);
foreach ($set["calls"] as $call_key => $call) {
    foreach ($set["sheets"] as $sheet_key => &$sheet) {
        call($call, $sheet);
        if (checkSheets($sheet)) {
            $winner_sheets[] = $sheet;
        }
    }
    if(!empty($winner_sheets)){
        $winner_sheet_value=calculateWinner($winner_sheets[0]);
        $first_count = $winner_sheet_value * $call;
        break;
    }
}

echo $first_count."\r\n";

$set2 = prepareSet($list);
foreach ($set2["calls"] as $call_key => $call) {
    foreach ($set2["sheets"] as $sheet_key => &$sheet) {
        call($call, $sheet);
        if(checkSheets($sheet)){
            $loser_sheet = $sheet;
            unset($set2["sheets"][$sheet_key]);
        }
        if(empty($set2["sheets"])){
            $loser_sheet_value=calculateWinner($loser_sheet);
            $second_count = $loser_sheet_value * $call;
            break;
        }
    }
}

echo $second_count;

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

function call($call, &$sheet){
    foreach ($sheet["lines"] as $sheet_line_key => $sheet_line) {
        foreach ($sheet_line as $sheet_line_number_key => $sheet_line_number) {
            if($sheet_line_number == $call){
                $sheet["row_calls"][$sheet_line_key][$sheet_line_number_key] = $sheet_line_number;
                $sheet["col_calls"][$sheet_line_number_key][$sheet_line_key] = $sheet_line_number;
            }
        }
    }
}

function checkSheets(&$sheet){
    if(!array_key_exists("row_calls", $sheet)){
        return false;
    }
    if (!array_key_exists("col_calls", $sheet)) {
        return false;
    }
    if (checkSheet($sheet["row_calls"]) ||
        checkSheet($sheet["col_calls"])) {
        return true;
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
