<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Comments.php
 * 评论相关组件
 *
 * @author     Jayden
 * @version    since 1.0.4
 */

class Comments
{

    /**
     * 解析评论user-agent
     *
     * @param string $ua
     *
     * @return string
     */

    public static function parseUseragent($ua)
    {
        // 解析操作系统
        $htmlTag = "";
        $os = null;
        $fontClass = null;
        if (preg_match('/Windows NT 6.0/i', $ua)) {$os = "Windows Vista";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 6.1/i', $ua)) {$os = "Windows 7";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 6.2/i', $ua)) {$os = "Windows 8";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 6.3/i', $ua)) {$os = "Windows 8.1";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 10.0/i', $ua)) {$os = "Windows 10";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 5.1/i', $ua)) {$os = "Windows XP";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 5.2/i', $ua) && preg_match('/Win64/i', $ua)) {$os = "Windows XP 64 bit";
            $fontClass = "windows";} elseif (preg_match('/Android ([0-9.]+)/i', $ua, $matches)) {$os = "Android " . $matches[1];
            $fontClass = "android";} elseif (preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) {$os = 'iPhone ' . $matches[1];
            $fontClass = "iphone";} elseif (preg_match('/iPad/i', $ua)) {$os = "iPad";
            $fontClass = "ipad";} elseif (preg_match('/Mac OS X ([_0-9]+)/i', $ua, $matches)) {$os = 'Mac OS X ' . $matches[1];
            $fontClass = "mac";} elseif (preg_match('/Gentoo/i', $ua)) {$os = 'Gentoo Linux';
            $fontClass = "gentoo";} elseif (preg_match('/Ubuntu/i', $ua)) {$os = 'Ubuntu Linux';
            $fontClass = "ubuntu";} elseif (preg_match('/Debian/i', $ua)) {$os = 'Debian Linux';
            $fontClass = "debian";} elseif (preg_match('/X11; FreeBSD/i', $ua)) {$os = 'FreeBSD';
            $fontClass = "freebsd";} elseif (preg_match('/X11; Linux/i', $ua)) {$os = 'Linux';
            $fontClass = "linux";} else { $os = 'unknown os';
            $fontClass = "os";}

        $htmlTag = $fontClass;

        $browser = null;
        //解析浏览器
        if (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Sogou browser';
            $fontClass = "sogou";} elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = '360 browser ';
            $fontClass = "360";} elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Maxthon ';
            $fontClass = "maxthon";} elseif (preg_match('#Edge( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Edge ';
            $fontClass = "edge";} elseif (preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Wechat ';
            $fontClass = "wechat";} elseif (preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'QQ Mobile ';
            $fontClass = "qq";} elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chrome ';
            $fontClass = "chrome";} elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chrome ';
            $fontClass = "chrome";} elseif (preg_match('#Chromium/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chromium ';
            $fontClass = "chrome";} elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Safari ';
            $fontClass = "safari";} elseif (preg_match('#opera mini#i', $ua)) {
            preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches);
            $browser = 'Opera Mini ';
            $fontClass = "opera";
        } elseif (preg_match('#Opera.([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Opera ';
            $fontClass = "opera";} elseif (preg_match('#QQBrowser ([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'QQ browser ';
            $fontClass = "qqbrowser";} elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'UCWEB ';
            $fontClass = "uc";} elseif (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Internet Explorer ';
            $fontClass = "ie";} elseif (preg_match('#Trident/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Internet Explorer 11';
            $fontClass = "ie";} elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Firefox ';
            $fontClass = "firefox";} else { $browser = 'unknown br';
            $fontClass = 'browser';}

        $htmlTag .= "&nbsp;";
        $htmlTag .= $fontClass;
        return $htmlTag;
    }

}
