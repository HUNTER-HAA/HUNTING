<?php
// 𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐓𝐇𝐄 𝐅𝐈𝐒𝐇𝐈𝐍𝐆 𝐓𝐎𝐎𝐋 𝐀𝐂𝐂𝐎𝐔𝐍𝐓𝐒 𝐏𝐑𝐎𝐆𝐑𝐀𝐌𝐌𝐄𝐃 𝐁𝐘 @E_5_O @IIQQTQ كسم يلي بغير حرف واحد كسخت يلعب بالملف أو ياخد اتصالات أو يسحب اي شي اذا ما بيك شرف غير ✌️😂//
date_default_timezone_set('Asia/Baghdad');
if(!file_exists('config.json')){
	$token = readline('Enter Token: ');
	$id = readline('Enter Id: ');
	file_put_contents('config.json', json_encode(['id'=>$id,'token'=>$token]));
	
} else {
		  $config = json_decode(file_get_contents('config.json'),1);
	$token = $config['token'];
	$id = $config['id'];
}

if(!file_exists('accounts.json')){
    file_put_contents('accounts.json',json_encode([]));
}
include 'index.php';
try {
	$callback = function ($update, $bot) {
		global $id;
		if($update != null){
		  $config = json_decode(file_get_contents('config.json'),1);
		  $config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
      $accounts = json_decode(file_get_contents('accounts.json'),1);
			if(isset($update->message)){
				$message = $update->message;
				$chatId = $message->chat->id;
				$text = $message->text;
				if($chatId == $id){
					if($text == '/haa'){
              $bot->sendMessage([
                  'chat_id'=>$chatId,
                  'text'=>"- - HELLO ACTIVATION BY HAA🍯
 ↯Tele↯.                     ↯CH↯
 :-  @E_5_O              :-  @IIQQTQ  .",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'- Add Account .','callback_data'=>'login']],
                          [['text'=>'- Grab Settings .','callback_data'=>'grabber']],
                          [['text'=>'- Start Check .','callback_data'=>'run'],['text'=>'- Stop Check .','callback_data'=>'stop']],
						  [['text'=>'- Tool Status .','callback_data'=>'status']],
						  [['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/E_5_O']],
                      ]
                  ])
              ]);   
          } elseif($text != null){
          	if($config['mode'] != null){
          		$mode = $config['mode'];
          		if($mode == 'addL'){
          			$ig = new ig(['file'=>'','account'=>['useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)']]);
          			list($user,$pass) = explode(':',$text);
          			list($headers,$body) = $ig->login($user,$pass);
          			// echo $body;
          			$body = json_decode($body);
          			if(isset($body->message)){
          				if($body->message == 'challenge_required'){
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"- Error . \n- Challenge Required ."
          					]);
          				} else {
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"- Error .\n- Incorrect Username Or Password ."
          					]);
          				}
          			} elseif(isset($body->logged_in_user)) {
          				$body = $body->logged_in_user;
          				preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
								  $CookieStr = "";
								  foreach($matches[1] as $item) {
								      $CookieStr .= $item."; ";
								  }
          				$account = ['cookies'=>$CookieStr,'useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)'];
          				
          				$accounts[$text] = $account;
          				file_put_contents('accounts.json', json_encode($accounts));
          				$mid = $config['mid'];
          				$bot->sendMessage([
          				      'parse_mode'=>'markdown',
          							'chat_id'=>$chatId,
          							'text'=>"- Done Login With @$user .\n- Send /start To Start Check .",
												'reply_to_message_id'=>$mid		
          					]);
          				$keyboard = ['inline_keyboard'=>[
										[['text'=>"- Add New Account .",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"- LogOut .",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'- Back','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"- Control The Accounts .",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
		              $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          			}
          		}  elseif($mode == 'selectFollowers'){
          		  if(is_numeric($text)){
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>"- Edit Done .",
          		        'reply_to_message_id'=>$config['mid']
          		    ]);
          		    $config['filter'] = $text;
          		    $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=>"- 𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐓𝐇𝐄 𝐅𝐈𝐒𝐇𝐈𝐍𝐆 𝐓𝐎𝐎𝐋 𝐀𝐂𝐂𝐎𝐔𝐍𝐓𝐒
𝐏𝐑𝐎𝐆𝐑𝐀𝐌𝐌𝐄𝐃 𝐁𝐘 @E_5_O .",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'- Add Account .','callback_data'=>'login']],
                          [['text'=>'- Grab Settings .','callback_data'=>'grabber']],
                          [['text'=>'- Start Check .','callback_data'=>'run'],['text'=>'- Stop Check .','callback_data'=>'stop']],
						  [['text'=>'- Tool Status .','callback_data'=>'status']],
						  [['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                      ]
                  ])
                  ]);
          		    $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          		  } else {
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>'- Send Number Plz..'
          		    ]);
          		  }
          		} else {
          		  switch($config['mode']){
          		    case 'search': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php search.php');
          		      break;
          		      case 'followers': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php followers.php');
          		      break;
          		      case 'following': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php following.php');
          		      break;
          		      case 'hashtag': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php hashtag.php');
          		      break;
          		  }
          		}
          	}
          }
				} else {
					$bot->sendMessage([
							'chat_id'=>$chatId,
							'text'=>"- Paid robot 💲 Not free Please contact the developer for additional information .",
							'reply_markup'=>json_encode([
                  'inline_keyboard'=>[
                      [['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']]
                  ]
							])
					]);
				}
			} elseif(isset($update->callback_query)) {
          $chatId = $update->callback_query->message->chat->id;
          $mid = $update->callback_query->message->message_id;
          $data = $update->callback_query->data;
          echo $data;
          if($data == 'login'){
              
        		$keyboard = ['inline_keyboard'=>[
										[['text'=>"- Add New Account .",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"- LogOut .",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'- Back .','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"- Control The Accounts .",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          } elseif($data == 'addL'){
          	
          	$config['mode'] = 'addL';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          	$bot->sendMessage([
          			'chat_id'=>$chatId,
          			'text'=>"- OK , Now Send Me The Account .\n- Ex => User:Pass .",
          			'parse_mode'=>'markdown'
          	]);
          } elseif($data == 'grabber'){
            
            $for = $config['for'] != null ? $config['for'] : ' - NoT Found';
            $count = count(explode("\n", file_get_contents($for)));
            $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"- Users List .\n- Users Count => $count .\n- Account in Use => $for .",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'- From Search .','callback_data'=>'search']],
                        [['text'=>'- From Hashtag (#) .','callback_data'=>'hashtag'],['text'=>'- From Explore .','callback_data'=>'explore']],
                        [['text'=>'- From Followers .','callback_data'=>'followers'],['text'=>"- From Following .",'callback_data'=>'following']],
                        [['text'=>"- Account in Use : $for .",'callback_data'=>'for']],
                        [['text'=>'- Remove All Users .','callback_data'=>'newList'],['text'=>'- Up To Old List .','callback_data'=>'append']],
						[['text'=>'- Back .','callback_data'=>'back']],
						[['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                    ]
                ])
            ]);
          } elseif($data == 'search'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"- Send Me The Words Now ."
            ]);
            $config['mode'] = 'search';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'followers'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"- Send Me The User Now ."
            ]);
            $config['mode'] = 'followers';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'following'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"- Send Me The User Now ."
            ]);
            $config['mode'] = 'following';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'hashtag'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"- Send Me The Hashtag Now ( WithOut # ) ."
            ]);
            $config['mode'] = 'hashtag';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'newList'){
            file_put_contents('a','new');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"- Done .",
							'show_alert'=>1
						]);
          } elseif($data == 'append'){ 
            file_put_contents('a', 'ap');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"- Done .",
							'show_alert'=>1
						]);
						
          } elseif($data == 'for'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'forg&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"- Select Account .",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"- You Do Not Add Any Account .",
							'show_alert'=>1
						]);
            }
          } elseif($data == 'selectFollowers'){
            bot('sendMessage',[
                'chat_id'=>$chatId,
                'text'=>'- Send Followers Count .'  
            ]);
            $config['mode'] = 'selectFollowers';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          } elseif($data == 'run'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'start&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"- Select Account .",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"- You Do Not Add Any Account .",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stop'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'stop&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"- Select Account .",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"- You Do Not Add Any Account .",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stopgr'){
            shell_exec('screen -S gr -X quit');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"- Done Stop .",
						// 	'show_alert'=>1
						]);
						$for = $config['for'] != null ? $config['for'] : 'Select Account';
            $count = count(explode("\n", file_get_contents($for)));
						$bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                 'text'=>"- Users List .\n- Users Count => $count .\n- Account in Use => $for .",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'- From Search .','callback_data'=>'search']],
                        [['text'=>'- From Hashtag (#) .','callback_data'=>'hashtag'],['text'=>'- From Explore .','callback_data'=>'explore']],
                        [['text'=>'- From Followers .','callback_data'=>'followers'],['text'=>"- From Following .",'callback_data'=>'following']],
                        [['text'=>"- Account in Use : $for .",'callback_data'=>'for']],
                        [['text'=>'- Remove All Users .','callback_data'=>'newList'],['text'=>'- Up To Old List .','callback_data'=>'append']],
						[['text'=>'- Back .','callback_data'=>'back']],
						[['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                    ]
                ])
            ]);
          } elseif($data == 'explore'){
            exec('screen -dmS gr php explore.php');
          } elseif($data == 'status'){
					$status = '';
					foreach($accounts as $account => $ac){
						$c = explode(':', $account)[0];
						$x = exec('screen -S '.$c.' -Q select . ; echo $?');
						if($x == '0'){
				        $status .= "- $account => Working .\n";
				    } else {
				        $status .= "- $account => Sleeping .\n";
				    }
					}
					$bot->sendMessage([
							'chat_id'=>$chatId,
							'text'=>"- Check Status =>\n$status .",
							'parse_mode'=>'markdown'
						]);
				} elseif($data == 'back'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                   'text'=>"- 𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐓𝐇𝐄 𝐅𝐈𝐒𝐇𝐈𝐍𝐆 𝐓𝐎𝐎𝐋 𝐀𝐂𝐂𝐎𝐔𝐍𝐓𝐒
𝐏𝐑𝐎𝐆𝐑𝐀𝐌𝐌𝐄𝐃 𝐁𝐘 @E_5_O .",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'- Add Account .','callback_data'=>'login']],
                          [['text'=>'- Grab Settings .','callback_data'=>'grabber']],
                          [['text'=>'- Start Check .','callback_data'=>'run'],['text'=>'- Stop Check .','callback_data'=>'stop']],
						  [['text'=>'- Tool Status .','callback_data'=>'status']],
						  [['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                      ]
                  ])
                  ]);
          } else {
          	$data = explode('&',$data);
          	if($data[0] == 'del'){
          		
          		unset($accounts[$data[1]]);
          		file_put_contents('accounts.json', json_encode($accounts));
              $keyboard = ['inline_keyboard'=>[
							[['text'=>"- Add New Account .",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"- LogOut",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'- Back .','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"- Control The Accounts .",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          	} elseif($data[0] == 'forg'){
          	  $config['for'] = $data[1];
          	  file_put_contents('config.json',json_encode($config));
              $for = $config['for'] != null ? $config['for'] : 'Select';
              $count = count(file_get_contents($for));
              $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"- Users List .\n- Users Count => $count .\n- Account in Use => $for .",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'- From Search .','callback_data'=>'search']],
                        [['text'=>'- From Hashtag (#) .','callback_data'=>'hashtag'],['text'=>'- From Explore .','callback_data'=>'explore']],
                        [['text'=>'- From Followers .','callback_data'=>'followers'],['text'=>"- From Following .",'callback_data'=>'following']],
                        [['text'=>"- Account in Use : $for .",'callback_data'=>'for']],
                        [['text'=>'- Remove All Users .','callback_data'=>'newList'],['text'=>'- Up To Old List .','callback_data'=>'append']],
						[['text'=>'- Back .','callback_data'=>'back']],
						[['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                    ]
                ])
            ]);
          	} elseif($data[0] == 'start'){
          	  file_put_contents('screen', $data[1]);
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"- 𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐓𝐇𝐄 𝐅𝐈𝐒𝐇𝐈𝐍𝐆 𝐓𝐎𝐎𝐋 𝐀𝐂𝐂𝐎𝐔𝐍𝐓𝐒
𝐏𝐑𝐎𝐆𝐑𝐀𝐌𝐌𝐄𝐃 𝐁𝐘 @E_5_O .",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'- Add Account .','callback_data'=>'login']],
                          [['text'=>'- Grab Settings .','callback_data'=>'grabber']],
                          [['text'=>'- Start Check .','callback_data'=>'run'],['text'=>'- Stop Check .','callback_data'=>'stop']],
						  [['text'=>'- Tool Status .','callback_data'=>'status']],
						  [['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                      ]
                  ])
                  ]);
              exec('screen -dmS '.explode(':',$data[1])[0].' php start.php');
              $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"- Start Check .\n- Account : ".explode(':',$data[1])[0].' .',
                'parse_mode'=>'markdown'
              ]);
          	} elseif($data[0] == 'stop'){
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"- 𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐓𝐇𝐄 𝐅𝐈𝐒𝐇𝐈𝐍𝐆 𝐓𝐎𝐎𝐋 𝐀𝐂𝐂𝐎𝐔𝐍𝐓𝐒
𝐏𝐑𝐎𝐆𝐑𝐀𝐌𝐌𝐄𝐃 𝐁𝐘 @E_5_O .",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'- Add Account .','callback_data'=>'login']],
                          [['text'=>'- Grab Settings .','callback_data'=>'grabber']],
                          [['text'=>'- Start Check .','callback_data'=>'run'],['text'=>'- Stop Check .','callback_data'=>'stop']],
						  [['text'=>'- Tool Status .','callback_data'=>'status']],
						  [['text'=>'- 𝙳𝚎𝚟𝚎𝚕𝚘𝚙𝚎𝚛 𝚌𝚑𝚊𝚗𝚗𝚎𝚕 𝄋 .','url'=>'T.me/IIQQTQ']],
                      ]
                    ])
                  ]);
              exec('screen -S '.explode(':',$data[1])[0].' -X quit');
          	}
          }
			}
		}
	};
	$bot = new EzTG(array('throw_telegram_errors'=>false,'token' => $token, 'callback' => $callback));
} catch(Exception $e){
	echo $e->getMessage().PHP_EOL;
	sleep(1);
}
