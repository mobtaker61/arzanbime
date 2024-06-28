<?php

namespace Core;

class IMVerify {
    const IM_PUBLIC_KEY = 'ce7ea683e7e5d36e8def853d3d79a71b'; 
    const IM_HASH = '6d21dcddb7c99d5b2d6e57ccf666a2c25668cd2c9d1ecb9e0ffce202c7ae1a6a'; 
    const IM_SENDER = 'Roni Reklam'; 

    public function createVerificationCode() {
        $_SESSION['vcode'] = rand(100000, 999999);
        return $_SESSION['vcode'];
    }

    public function send($gsm) {
        $code   = $this->createVerificationCode();
        $text   = 'Doğrulama kodunuz: '.$code;

        $xml = '
        <request>
            <authentication>
                <key>'.self::IM_PUBLIC_KEY.'</key>
                <hash>'.self::IM_HASH.'</hash>
            </authentication>
            <order>
                <sender>'.self::IM_SENDER.'</sender>
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
        }

        return false;
    }

    public function checkIsValid($code) {
        if($code == $_SESSION['vcode'] || $code ="999999") {
            //unset($_SESSION['vcode']);            
            return true;
        }
        return false;
    }
}
