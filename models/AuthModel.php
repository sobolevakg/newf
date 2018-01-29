<?php
namespace Newfinder\Models;
use Phalcon\Http\Client\Adapter\Curl;

class AuthModel extends \Phalcon\Mvc\Model
{

    public function getAuth()
    {
        $ch = curl_init();
        $url = "https://www.newfinder.ru/nf.php?do=ses_in";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_NOBODY, 1); 
        curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  array (
            'login'=> $_POST['login']
        ));
        $result = curl_exec($ch);  
        curl_close($ch);
	    $result = json_decode($result);
        if (isset($result->data)){  
            setcookie("Newfinder", $result->data->first, time()+7*24*60*60, "/", ".newfinder.ru");
	    $pssw =  hash('sha512', $_POST['pass']);     
            $ch = curl_init();
            $url = "https://www.newfinder.ru/nf.php?do=get_in";
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_NOBODY, 1); 
            curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	        curl_setopt($ch, CURLOPT_COOKIE, "Newfinder=".$result->data->first);
            curl_setopt($ch, CURLOPT_POSTFIELDS,  array (
                'key'=> $result->data->sign,
                'pwd'=> hash('sha512',  $result->data->ptim.$pssw),
                'otp' => $result->data->otp
            ));
            $result = curl_exec($ch);  
            curl_close($ch);
            $result = json_decode($result);
		    if(isset($result->nf_user)){
                            setcookie("Newfinder_time", $result->data->second, time()+7*24*60*60, "/", ".newfinder.ru");
			    $res['error'] = 0;
		    }
        }else{
            $res['error'] = 1;            
	    }
            return $res;
    }

    public function getRememberPassword()
    {
        $ch = curl_init();
        $url = "https://www.newfinder.ru/nf.php?do=check_email_pass";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_NOBODY, 1); 
        curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  array (
            'email'=> $_POST['login']
        ));
        $result = curl_exec($ch);  
        curl_close($ch);
	    $result = json_decode($result);
        if (isset($result->type)){  
            if($result->type != 'close'){
                $res['error'] = 0;
            }
        }else{
                $res['error'] = 1;
        }
            return $res;
    }

    public function setSignUp()
    {	 
	$res['error'] = 1;
        $ch = curl_init();
        $url = "https://www.newfinder.ru/nf.php?do=create_user";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_NOBODY, 1); 
        curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  array (
            'email'=> $_POST['login'],
            'fio'=> $_POST['fio'],
            'password'=> $_POST['password'],
        ));
        $result = curl_exec($ch);  
        curl_close($ch);
	$result = json_decode($result);
        if (isset($result->result)){  
                $res['error'] = ($result->result == 'error') ? 1 : 0 ;
        }
	if (isset($result->message)){  
                $res['message'] = $result->message;
        }
        return $res;
    }
}
