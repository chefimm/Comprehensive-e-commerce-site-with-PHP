<?php

class Sms  {

public $IM_PUBLIC_KEY,$IM_SECRET_KEY,$IM_SENDER;

		function __construct() {
				$this->db= new Database();
				
	$degerlerial=$this->db->prepare("select apikey,guvkey,smsbaslik from ayarlar");
	$degerlerial->execute();
	$sondegerler=$degerlerial->fetchAll();
	
    if (!empty($sondegerler) && isset($sondegerler[0])) {
        $this->IM_PUBLIC_KEY = $sondegerler[0]["apikey"];
        $this->IM_SECRET_KEY = $sondegerler[0]["guvkey"];
        $this->IM_SENDER = $sondegerler[0]["smsbaslik"];
    } else {
        // Verileri alamadığınızda ne yapmanız gerektiğine dair bir işlem ekleyebilirsiniz.
        // Örneğin hata mesajı gösterebilir veya varsayılan değerler atayabilirsiniz.
    }
    
	

		}



    public function smsgonder($text,$gsm) {

        $p_hash = hash_hmac('sha256', $this->IM_PUBLIC_KEY, $this->IM_SECRET_KEY);

        $xml = '<request>
            <authentication>
                <key>'.$this->IM_PUBLIC_KEY.'</key>
                <hash>'.$p_hash.'</hash>
            </authentication>
            <order>
                <sender>'.$this->IM_SENDER.'</sender>
                <sendDateTime></sendDateTime>
                <message>
                    <text><![CDATA['.$text.']]></text>
                    <receipents>
                        <number>'.$gsm.'</number>
                    </receipents>
                </message>
            </order>
        </request>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://api.iletimerkezi.com/v1/send-sms');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        $result = curl_exec($ch);

        preg_match_all('|\<code\>.*\<\/code\>|U', $result, $matches, PREG_PATTERN_ORDER);
        if(isset($matches[0])&&isset($matches[0][0])) {
            if( $matches[0][0] == '<code>200</code>' ) {
                return true;
            }
			else {
			
			return false;
			}
        }

        
    }
	
	function smsbakiye() {
	
	 

        $xml = '<request>

        <authentication>

                <username>Kullanıcı adı</username>

                <password>Şifre</password>

        </authentication>

</request>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://api.iletimerkezi.com/v1/get-balance');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        $result = curl_exec($ch);

        preg_match_all('|\<sms\>.*\<\/sms\>|U', $result, $bakiye, PREG_PATTERN_ORDER);
		
		echo $bakiye[0][0];
		
       /* if(isset($matches[0])&&isset($matches[0][0])) {
            if( $matches[0][0] == '<code>200</code>' ) {
                return true;
            }
			else {
			
			return false;
			}
        }*/
	
	
	}





	
}




?>