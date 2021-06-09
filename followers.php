<?php 
// 𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐓𝐇𝐄 𝐅𝐈𝐒𝐇𝐈𝐍𝐆 𝐓𝐎𝐎𝐋 𝐀𝐂𝐂𝐎𝐔𝐍𝐓𝐒 𝐏𝐑𝐎𝐆𝐑𝐀𝐌𝐌𝐄𝐃 𝐁𝐘 @E_5_O @IIQQTQ كسم يلي بغير حرف واحد كسخت يلعب بالملف أو ياخد اتصالات أو يسحب اي شي اذا ما بيك شرف غير ✌️😂//
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json'),1);
$id = $config['words'];
$file = $config['for'];
$a = file_exists('a') ? file_get_contents('a') : 'ap';
if($a == 'new'){
	file_put_contents($file, '');
}
$from = 'Followers';
$mid = bot('sendMessage',[
	'chat_id'=>$config['id'],
	'message_id'=>$mid,
	'text'=>"*Collection From* ~ [ _ $from _ ]\n\n*Status* ~> _ Working _\n*Users* ~> _ ".count(explode("\n", file_get_contents($file)))."_",
	'parse_mode'=>'markdown',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
			[['text'=>'Stop.','callback_data'=>'stopgr']]
		]])
])->result->message_id;
$ids = explode(' ', $config['words']);
foreach($ids as $user){
	echo $user."\n";
	sleep(5);
	$cookies = $accounts[$file];
	$ig = new ig(['account'=>$accounts[$file],'file'=>$file]);
	$info = $ig->getInfo($user);
	$id = $info->pk;
	$ig->getFollowers($id,$mid,$user);
}
