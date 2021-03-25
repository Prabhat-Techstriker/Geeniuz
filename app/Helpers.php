 <?php
use App\User;
use App\Feeds_likes;
use App\Contact_list;
use App\Pushnotification as pushdb;
use Edujugon\PushNotification\PushNotification;
use App\Models\Pushnotification as Push_notification;

    function checkLikedByMe($feeds_id, $user_id) {
        $res = Feeds_likes::where(['feeds_id' => $feeds_id, 'user_id' => $user_id])->first();
        if($res){
            if($res['likes'] == 1){
                return true;
            }else{
                return false;
            }
        }
    }


    function followByMe($login_uid,$user_id) {
        if ($user_id == $login_uid) {
            $res1 = Contact_list::where(['contact_id' => $user_id])->with('user')->get();
            $ids1 = $res1->pluck('user_id')->toArray(); // followers
            $res2 = Contact_list::where(['user_id' => $user_id])->get();
            $ids2 = $res2->pluck('contact_id')->toArray(); // following
            $data = array();
            $i = 0;
        } else {
            $res1 = Contact_list::where(['contact_id' => $user_id])->with('user')->get();
            $ids1 = $res1->pluck('user_id')->toArray(); // followers
            $res2 = Contact_list::where(['user_id' => $login_uid])->get();
            $ids2 = $res2->pluck('contact_id')->toArray(); // following
            $data = array();
            $i = 0;
        }
       
        foreach ($res1 as $key => $value) {
            if (in_array($value->user_id, $ids2)) {
                $value['followByMe'] = true;
            }else{
                $value['followByMe'] = false;
            }   
            $data[] = $value;
        }
        return $data;
    }

    function followByMeProfile($user_id,$loginuser) {
        
        $res1 = Contact_list::where(['contact_id' => $user_id,'user_id' => $loginuser])->first();
        /*print_r($res1);die("--");
        if ($res1) {
            $ids1 = $res1->pluck('user_id');
        }else{
            $ids1 = '';
        }

        print_r($ids1);echo "<br>";
        
        $res2 = Contact_list::where(['user_id' => $loginuser])->get();
        if ($res2) {
            $ids2 = $res2->pluck('contact_id')->toArray();
        }else{
            $ids2 = '';
        }
        
        print_r($ids2);echo "<br>";
        $data = '';
        $i = 0;*/
        if ($res1['contact_id'] == $user_id) {
                $data = true;
           }else{
                $data = false;
           }
        return $data;
    }


    function sendPushnotification($device_token, $title, $message)
    {
        /*notification type  1=admin approve 2=service request send 3=request accept/reject*/
        $push = new PushNotification('fcm');
        $push->setConfig([
            'priority' => 'high',
            'time_to_live' => 5,
            'dry_run' => false
        ]);
        
        try {

            $extraNotificationData = [
                'title'                 => $title,
                'body'                  => $message,
                'sound'                 => 'default',
                'badge'                 => 1,
                'notificationType'      => 0,
            ];

            $push->setMessage([
                'notification' => [
                    'title' => $title,
                    'body'  => $message,
                    'sound' => 'default'
                ]
                //'data' =>  $extraNotificationData
            ])
            ->setApiKey(env('FCM_KEY'))
            ->setDevicesToken($device_token)
            ->send();

            //print_r($push->getFeedback());
        
        } catch (Exception $e) {
            
        }
    }


    function Pushcreate($userId,$msg){
        /*$data = $request->all();
        $userId = $request->user()->id;*/
        $request = array('user_id' => $userId,'message' => $msg);
        pushdb::create($request);
    }