<?php

class modSocialPrivacyButtonsHelper {

    public static function getFbLikes() {
        $content = file_get_contents("https://api.facebook.com/restserver.php?method=links.getStats&urls=" . urlencode(JUri::current()));

        $xml = simplexml_load_string($content);
        return $xml->link_stat->total_count;
    }

    public static function getFbLikesForUrl($url) {
        $content = file_get_contents("https://api.facebook.com/restserver.php?method=links.getStats&urls=" . urlencode($url));

        $xml = simplexml_load_string($content);
        return $xml->link_stat->total_count;
    }

    public function getSharesAjax() {
        $url = JFactory::getApplication()->input->getString('url');
        $shares = new stdClass();
        $shares->gp = self::getGpCountForUrl($url);
        $shares->fb = ':' + self::getFbLikesForUrl($url) + ':';
        $shares->pn = self::getPinsForUrl($url);
        $shares->li = self::getLiLikesForUrl($url);
        //$shares->tw = self::getTweetsForUrl($url);
        return json_encode($shares);
    }

    public static function getGpCount() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . JUri::current() . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $curl_results = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($curl_results, true);
        return intval($json[0]['result']['metadata']['globalCounts']['count']);
    }

    public static function getGpCountForUrl($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $curl_results = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($curl_results, true);
        return intval($json[0]['result']['metadata']['globalCounts']['count']);
    }

    public static function getPins() {
        $query = 'https://api.pinterest.com/v1/urls/count.json?callback=x&url=' . urlencode(JUri::current());
        return self::getCount($query, 'pinterest');
    }

    public static function getPinsForUrl($url) {
        $query = 'https://api.pinterest.com/v1/urls/count.json?callback=x&url=' . urlencode($url);
        return self::getCount($query, 'pinterest');
    }

    public static function getLiLikes() {
        $query = 'https://www.linkedin.com/countserv/count/share?url=' . urlencode(JUri::current()) . '&format=json';
        return self::getCount($query, 'linkedin');
    }

    public static function getLiLikesForUrl($url) {
        $query = 'https://www.linkedin.com/countserv/count/share?url=' . urlencode($url) . '&format=json';
        return self::getCount($query, 'linkedin');
    }

    public static function getTweets() {
        $query = 'https://cdn.api.twitter.com/1/urls/count.json?url=' . urlencode(JUri::current());
        return self::getCount($query, 'twitter');
    }

    public static function getTweetsForUrl($url) {
        $query = 'https://cdn.api.twitter.com/1/urls/count.json?url=' . urlencode($url);
        return self::getCount($query, 'twitter');
    }

    private static function getCount($query, $socialSite) {
        $contents = file_get_contents($query);
        if ($socialSite == 'pinterest') {
            $contents = preg_replace('/^x\((.*)\)$/', "\\1", $contents);
        }
        $data = json_decode($contents);

        if (isset($data->count)) {
            return $data->count;
        }
        return 0;
    }

    public static function formatCount($count) {
        if ($count > 999) {
            return round($count / 1000) . "k";
        }
        return $count;
    }

    public static function getImage() {
        $cck = CCK_Rendering::getInstance('seb_one');
        if (!empty($cck->get('images')->value)) {
            return JURI::root() . $cck->get('images')->value[0]->value;
        }
		if (!empty($cck->get('art_image_fulltext')->value)) {
            return JURI::root() . $cck->get('art_image_fulltext')->value;
        }
        return '';
    }
	
	public static function getTitle() {
		$cck = CCK_Rendering::getInstance('seb_one');
        if (!empty($cck->get('art_image_fulltext_caption')->value)) {
            return $cck->get('art_image_fulltext_caption')->value;
        }
		return JFactory::getDocument()->getTitle();
	}

}

?>