<?php
namespace common\controllers;
use yii\web\Controller;

class Security extends Controller {

    public static function decrypt($passphrase, $jsonString){
		try{
		$jsondata = json_decode($jsonString, true);
		$salt = hex2bin($jsondata["s"]);
		$ct = base64_decode($jsondata["ct"]);
		$iv  = hex2bin($jsondata["iv"]);
		$concatedPassphrase = $passphrase.$salt;
		$md5 = array();
		$md5[0] = md5($concatedPassphrase, true);
		$result = $md5[0];
		for ($i = 1; $i < 3; $i++) {
			$md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
			$result .= $md5[$i];
		}
		$key = substr($result, 0, 32);
		$data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
		return json_decode($data, true);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	}

/**
* Encrypt value to a cryptojs compatiable json encoding string
*
* @param mixed $passphrase
* @param mixed $value
* @return string
*/
public static function encrypt($passphrase, $value){
	try{
    $salt = openssl_random_pseudo_bytes(8);
    $salted = '';
    $dx = '';
    while (strlen($salted) < 48) {
        $dx = md5($dx.$passphrase.$salt, true);
        $salted .= $dx;
    }
    $key = substr($salted, 0, 32);
    $iv  = substr($salted, 32,16);
    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
    $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
    return json_encode($data);
	} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
}


public static function genRandString($length = 0) {
		try{
        $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        $count = strlen($charset);
        while ($length-- > 0) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
		return $str;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

	
	public function actionEncryptdata(){
		try{
		$string = Yii::$app->request->post('string');
		$seckey = Yii::$app->request->post('seckey');
		$data = \common\controllers\CommonController::encrypt($string, $seckey);
		return $data;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	}
	
	public static function cryptoJsAesDecrypt($passphrase, $jsonString){	
		$jsondata = json_decode($jsonString, true);
		try {
			$salt = hex2bin($jsondata["s"]);
			$iv  = hex2bin($jsondata["iv"]);
		} catch(Exception $e) { return null; }
		$ct = base64_decode($jsondata["ct"]);
		$concatedPassphrase = $passphrase.$salt;
		$md5 = array();
		$md5[0] = md5($concatedPassphrase, true);
		$result = $md5[0];
		for ($i = 1; $i < 3; $i++) {
			$md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
			$result .= $md5[$i];
		}
		$key = substr($result, 0, 32);
		$data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
		return json_decode($data, true);
	}
	/**
	* Encrypt value to a cryptojs compatiable json encoding string
	*
	* @param mixed $passphrase
	* @param mixed $value
	* @return string
	*/
	function cryptoJsAesEncrypt($passphrase, $value){
		$salt = openssl_random_pseudo_bytes(8);
		$salted = '';
		$dx = '';
		while (strlen($salted) < 48) {
			$dx = md5($dx.$passphrase.$salt, true);
			$salted .= $dx;
		}
		$key = substr($salted, 0, 32);
		$iv  = substr($salted, 32,16);
		$encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
		$data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
		return json_encode($data);
	}
}