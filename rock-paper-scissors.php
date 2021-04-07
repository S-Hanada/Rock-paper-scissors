<?php 

//定数で手を定義
const STONE = 1;
const SCISSORS = 2;
const PAPER = 3;

const HAND_TYPE = array(
	STONE => 'グー',
	SCISSORS => 'チョキ',
	PAPER => 'パー'
);

//ランダム用の定数を定義
const HAND_JUDGE = array(0,1,2);

//入力のバリデーション
function check_input($num) {
	if(empty($num)) {
		echo '入力が空です'.PHP_EOL;
		return false;
	}
	if(!is_numeric($num)) {
		echo '数字以外が入力されています'.PHP_EOL;
		return false;
	}
	if($num > 3) {
		echo 'グー、チョキ、パー以外は使用しないでください'.PHP_EOL;
		return false;
	}
	return true;
}

//自分の手の入力
function input_my_hand() {
	echo 'じゃんけん'.PHP_EOL;
	echo '1:グー 2:チョキ 3:パー'.PHP_EOL;
	$input = trim(fgets(STDIN));
	if (!check_input($input)) {
		return input_my_hand();
	}
	$input = (int)$input;
	return $input;
}

//COMの手の数値を生成
function get_com_hand() {
	$rand_num = array_rand(HAND_TYPE,1);
	return $rand_num;
}

//勝敗反映
function judge($hand1, $hand2) {
	echo sprintf('あなたの手は%sです。', HAND_TYPE[$hand1]).PHP_EOL;
	echo sprintf('相手の手は%sです', HAND_TYPE[$hand2]).PHP_EOL;
	return ($hand1 - $hand2) % 3;
}

//結果の表示
function show($num) {
	if ($num === HAND_JUDGE[0]) {
		echo 'あいこです'.PHP_EOL;
		return false;
	} elseif ($num === HAND_JUDGE[1]) {
		echo 'あなたの負けです'.PHP_EOL;
		return true;
	}
	echo 'あなたの勝ちです'.PHP_EOL;
	return true;
}

//コンティニュー洗濯用の文字のバリデーション
function check_continue($ask) {
	if(empty($ask)) {
		echo '入力が空です'.PHP_EOL;
		return false;
	}。
	if($ask !== 'y' && $ask !== 'n') {
		echo 'yかnで答えてください'.PHP_EOL;
		return false;
	}
	return true;
}

//コンティニュー機能
function ask_game_continue() {
	echo 'ゲームを続けますか? y:n'.PHP_EOL;
	$input = trim(fgets(STDIN));
	if (!check_continue($input)) {
		return ask_game_continue();
	}
	if ($input === 'n') {
		echo 'ゲームを終了します';
		exit();
	}
	return false;
}

//じゃんけんゲーム本体
function rock_paper_scissors() {
	$my_hand = input_my_hand();
	$your_hand = get_com_hand();
	$result = judge($my_hand, $your_hand);
	if (!show($result)) {
		return rock_paper_scissors();
	}
	if (!ask_game_continue()) {
		return rock_paper_scissors();
	}
}

//じゃんけんゲームスタート
rock_paper_scissors();

?>