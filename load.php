<?php
date_default_timezone_set("Asia/Tokyo"); // タイムゾーン

$concert_name = "Neverland";　// コンサート名
$dai_list = array("14","15","16","17","その他");　// 代情報

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
// attend_date.csvの情報を取り入れる
for ($i = 0; $i < count($records); $i++) {
    $record_dai[] = $records[$i][0];
    $record_name[] = $records[$i][1];
    $id[] = $records[$i][0] . $records[$i][1];
    $record_num[] = $records[$i][2];
    $record_guest[] = $records[$i][3];
    $record_time[] = date("Y/m/d H:i:s", $records[$i][4]);
}

// 編集されているものは編集
$edit_nums = readCsv("data/edit_data.csv");
for ($i = 0; $i < count($edit_nums); $i++) {
    $index = intval($edit_nums[$i][0]);
    // 台の情報の変種
    $replace_dai = array($index => $dai_list[intval($edit_nums[$i][1])]);
    $record_dai = array_replace($record_dai, $replace_dai);
    // 名前の情報の編集
    $replace_name = array($index => $edit_nums[$i][2]);
    $record_name = array_replace($record_name, $replace_name);
    // 枚数の情報の編集
    $replace_num = array($index => $edit_nums[$i][3]);
    $record_num = array_replace($record_num, $replace_num);
    // お客さんの情報の編集
    $replace_guest = array($index => $edit_nums[$i][4]);
    $record_guest = array_replace($record_guest, $replace_guest);
}

$count = 0; // 合計人数
for ($i = 0; $i < count($record_num); $i++)
{
    $count += $record_num[$i];
}

// 削除されたものは削除
$delete_nums = readCsv("data/delete_data.csv");
for ($i=0; $i < count($delete_nums); $i++) {
    $index = intval($delete_nums[$i][0]);
	unset($record_dai[$index]);
	unset($record_name[$index]);
    $count -= $record_num[$index];
	unset($record_num[$index]);
	unset($record_guest[$index]);
	unset($record_time[$index]);
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
