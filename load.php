<?php

date_default_timezone_set("Asia/Tokyo");

$concert_name = "Neverland";
$dai_list = array("14","15","16","17","その他");

$record_dai = array();     // 代を入れる配列
$record_name = array();    // 名前を入れる配列
$record_num = array();     // チケットの枚数を入れる配列
$id = array();             // id = dai + name
$record_guest = array();   // お客さんの種類
$record_time = array();    // フォームを入力した時間
$total_count = array();    // ランキングを入れるための配列

// csvを1行ずつ読む関数
function readCsv($path) {
    try {
        $file = new SplFileObject($path);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );
    } catch (RuntimeException $e) {
        throw $e;
    }
    $res = [];
    if (empty($file) == FALSE)
        foreach ($file as $v)
            $res[] = $v;
    return $res;
}

// csv読み込む(いままでの投稿データ)
$records = readCsv("data/attend_data.csv");

// 編集されているものは編集
$edit_nums = readCsv("data/edit_data.csv");
for ($i = 0; $i < count($edit_nums); $i++) {
	$array = array($dai_list[$edit_nums[$i][1]], $edit_nums[$i][2], $edit_nums[$i][3], $edit_nums[$i][4]);
	$records[$edit_nums[$i][0]] = $array;
}


$count = 0; // 合計人数
// csvから情報を読み込む.
for ($i = 0; $i < count($records); $i++) {
	$count += intval($records[$i][2]);
    $record_dai[] = $records[$i][0];
    $record_name[] = $records[$i][1];
    $id[] = $records[$i][0] . $records[$i][1];
    $record_num[] = $records[$i][2];
    $record_guest[] = $records[$i][3];
    $record_time[] = date("Y/m/d H:i:s", $records[$i][4]);
}

// 削除されたものは削除
$delete_nums = readCsv("data/delete_data.csv");
for ($i=0; $i < count($delete_nums); $i++) {
	unset($records[intval($delete_nums[$i][0])]);
	unset($record_dai[intval($delete_nums[$i][0])]);
	unset($record_name[intval($delete_nums[$i][0])]);
	unset($id[intval($delete_nums[$i][0])]);
	unset($record_num[intval($delete_nums[$i][0])]);
	unset($record_guest[intval($delete_nums[$i][0])]);
	unset($record_time[intval($delete_nums[$i][0])]);
}

// ランキングのカウント
foreach($id as $key=>$val){
	if($id[$key] == "") {
		continue;
	} else {
	    if (isset($total_count[$val])) {
	        $total_count[$val] += $record_num[$key];
	    } else {
	        $total_count[$val] = $record_num[$key];
	    }
	}
}


$text = file_get_contents('data/guest.txt');
$guests = explode(PHP_EOL, trim($text));


// javascript でphpの変数を読み込むための関数
function json_safe_encode($data){
    return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}

?>
