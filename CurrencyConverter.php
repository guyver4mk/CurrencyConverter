<?php

class CurrencyConverter
{
	private function getConversion($from, $to)
	{
		$body = $this->getBody($from,$to);

		$html_dom = new DOMDocument();
		@$html_dom->loadHTML($body);
		$x_path = new DOMXPath($html_dom);

		$cur = $x_path->query('//a[@class="fl"]/../div');

        if($cur->length)
        {
        	preg_match("/= (.*?) \w/", $cur->item(0)->nodeValue, $out);
            $rate = floatval($out[1]);
            return $rate;
        }
	}

	private function getBody($from,$to)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.google.co.uk/search?q=currency+convert+".$from."+to+".$to."&rlz=1C5CHFA_enGB760GB760&oq=currency+convert+".$from."+to+".$to,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Cache-Control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  $body =  "cURL Error #:" . $err;
		} else {
		  $body =  $response;
		}

		return $body;
	}

	public function convert($price, $from, $to)
	{
		$rate = $this->getConversion($from, $to);

		$converted_price = round(($price * $rate),2, PHP_ROUND_HALF_UP);

		return $converted_price;
	}

}