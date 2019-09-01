<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
define('JaydenForU_VERSION', '1.0.3');
define('__TYPECHO_GRAVATAR_PREFIX__', Helper::options()->Gravatar ? Helper::options()->Gravatar : 'https://cdn.v2ex.com/gravatar/');
require_once 'lib/Utils.php';
if (!empty(Helper::options()->cdn)) {
  define('__TYPECHO_UPLOAD_URL__', $_SERVER['REQUEST_SCHEME'] . '://' . Helper::options()->cdn);
}
function themeConfig($form)
{
  echo '<script>var JaydenForU_VERSION = "' . JaydenForU_VERSION . '";</script>';
  ?>
  <style>form {
      position: relative;
      max-width: 100%
    }

    form input:not([type]), form input[type="date"], form input[type="datetime-local"], form input[type="email"], form input[type="number"], form input[type="password"], form input[type="search"], form input[type="tel"], form input[type="time"], form input[type="text"], form input[type="file"], form input[type="url"] {
      font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
      margin: 0em;
      outline: none;
      -webkit-appearance: none;
      tap-highlight-color: rgba(255, 255, 255, 0);
      line-height: 1.21428571em;
      padding: 0.67857143em 1em;
      font-size: 1em;
      background: #FFFFFF;
      border: 1px solid rgba(34, 36, 38, 0.15);
      color: rgba(0, 0, 0, 0.87);
      border-radius: 0.28571429rem;
      -webkit-box-shadow: 0em 0em 0em 0em transparent inset;
      box-shadow: 0em 0em 0em 0em transparent inset;
      -webkit-transition: color 0.5s ease, border-color 0.5s ease;
      transition: color 0.5s ease, border-color 0.5s ease
    }

    form textarea {
      margin: 0em;
      -webkit-appearance: none;
      tap-highlight-color: rgba(255, 255, 255, 0);
      padding: 0.78571429em 1em;
      background: #FFFFFF;
      border: 1px solid rgba(34, 36, 38, 0.15);
      outline: none;
      color: rgba(0, 0, 0, 0.87);
      border-radius: 0.28571429rem;
      -webkit-box-shadow: 0em 0em 0em 0em transparent inset;
      box-shadow: 0em 0em 0em 0em transparent inset;
      -webkit-transition: color 0.1s ease, border-color 0.5s ease;
      transition: color 0.1s ease, border-color 0.5s ease;
      font-size: 1em;
      line-height: 1.2857;
      resize: vertical
    }

    form textarea:not([rows]) {
      height: 12em;
      min-height: 8em;
      max-height: 24em
    }

    form textarea, form input[type="checkbox"] {
      vertical-align: top
    }

    form textarea:focus, form input:focus {
      color: rgba(0, 0, 0, 0.95);
      border-color: #85B7D9;
      border-radius: 0.28571429rem;
      background: #FFFFFF;
      -webkit-box-shadow: 0px 0em 0em 0em rgba(34, 36, 38, 0.35) inset;
      box-shadow: 0px 0em 0em 0em rgba(34, 36, 38, 0.35) inset;
      -webkit-appearance: none
    }

    .tip {
      max-width: 100%;
      position: relative;
      min-height: 1em;
      margin: 0 10px;
      background: #F8F8F9;
      padding: 1em 1.5em;
      line-height: 1.4285em;
      color: rgba(0, 0, 0, 0.87);
      -webkit-transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, -webkit-box-shadow 0.1s ease;
      transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, -webkit-box-shadow 0.1s ease;
      transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
      transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease, -webkit-box-shadow 0.1s ease;
      border-radius: 0.28571429rem;
      -webkit-box-shadow: 0 0 0 1px rgba(34, 36, 38, .22) inset, 0 2px 4px 0 rgba(34, 36, 38, .12), 0 2px 10px 0 rgba(34, 36, 38, .15);
      box-shadow: 0 0 0 1px rgba(34, 36, 38, .22) inset, 0 2px 4px 0 rgba(34, 36, 38, .12), 0 2px 10px 0 rgba(34, 36, 38, .15)
    }

    .tip-header {
      text-align: center;
      margin: 10px auto 20px auto;
      color: #444;
      text-shadow: 0 0 2px #c2c2c2
    }

    .current-ver {
      position: relative;
      border-color: #b21e1e !important;
      background-color: #DB2828 !important;
      color: #FFF !important;
      left: -37px;
      padding-left: 1rem;
      border-bottom-right-radius: 5px;
      padding-right: 1.2em
    }

    .current-ver:after {
      position: absolute;
      content: '';
      top: 100%;
      left: 0;
      background-color: transparent !important;
      border-style: solid;
      border-width: 0 1.2em 1.2em 0;
      border-color: transparent;
      border-right-color: inherit;
      width: 0;
      height: 0
    }

    .btn.primary {
      cursor: pointer;
      display: inline-block;
      background: #E0E1E2 none;
      color: rgba(0, 0, 0, 0.6);
      padding: 0 1.5em;
      border-radius: 0.28571429rem;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      outline: none;
      -webkit-transition: opacity 0.5s ease, background-color 0.5s ease, color 0.5s ease, background 0.5s ease, -webkit-box-shadow 0.5s ease;
      transition: opacity 0.5s ease, background-color 0.5s ease, color 0.5s ease, background 0.5s ease, -webkit-box-shadow 0.5s ease;
      transition: opacity 0.5s ease, background-color 0.5s ease, color 0.5s ease, box-shadow 0.5s ease, background 0.5s ease;
      transition: opacity 0.5s ease, background-color 0.5s ease, color 0.5s ease, box-shadow 0.5s ease, background 0.5s ease, -webkit-box-shadow 0.5s ease;
      -webkit-tap-highlight-color: transparent
    }

    .btn.primary:hover {
      background-color: #CACBCD;
      color: rgba(0, 0, 0, 0.8)
    }

    .btn.primary[type="submit"] {
      position: fixed;
      right: 100px;
      bottom: 100px
    }

    .btn.confirm {
      background-color: #95f798 !important
    }

    .btn.alert {
      background-color: #fa9492 !important
    }

    i.confirm {
      position: absolute;
      left: .5em
    }

    i.confirm:after, i.confirm:before {
      content: "";
      background: green;
      display: block;
      position: absolute;
      width: 3px;
      border-radius: 3px
    }

    i.confirm:after {
      height: 6px;
      transform: rotate(-45deg);
      top: 9px;
      left: 6px
    }

    i.confirm:before {
      height: 11px;
      transform: rotate(45deg);
      top: 5px;
      left: 10px
    }

    i.alert {
      position: absolute;
      left: .5em
    }

    i.alert:after, i.alert:before {
      content: "";
      background: red;
      display: block;
      position: absolute;
      width: 3px;
      border-radius: 3px;
      left: 9px
    }

    i.alert:after {
      height: 3px;
      top: 14px
    }

    i.alert:before {
      height: 8px;
      top: 4px
    }

    .multiline {
      position: relative;
      display: inline-block;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      outline: none;
      vertical-align: baseline;
      font-style: normal;
      min-height: 17px;
      font-size: 1rem;
      line-height: 17px;
      min-width: 17px
    }

    .multiline input[type="checkbox"], .multiline input[type="radio"] {
      cursor: pointer;
      position: absolute;
      top: 0px;
      left: 0px;
      opacity: 0 !important;
      outline: none;
      z-index: 3;
      width: 17px;
      height: 17px
    }

    .multiline {
      min-height: 1.5rem
    }

    .multiline input {
      width: 3.5rem;
      height: 1.5rem
    }

    .multiline .box, .multiline label {
      min-height: 1.5rem;
      padding-left: 4.5rem;
      color: rgba(0, 0, 0, 0.87)
    }

    .multiline label {
      padding-top: 0.15em
    }

    .multiline .box:before, .multiline label:before {
      cursor: pointer;
      display: block;
      position: absolute;
      content: '';
      z-index: 1;
      -webkit-transform: none;
      transform: none;
      border: none;
      top: 0rem;
      background: rgba(0, 0, 0, 0.05);
      -webkit-box-shadow: none;
      box-shadow: none;
      width: 3.5rem;
      height: 1rem;
      border-radius: 500rem
    }

    .multiline .box:after, .multiline label:after {
      cursor: pointer;
      background: #FFFFFF -webkit-gradient(linear, left top, left bottom, from(transparent), to(rgba(0, 0, 0, 0.05)));
      background: #FFFFFF -webkit-linear-gradient(transparent, rgba(0, 0, 0, 0.05));
      background: #FFFFFF linear-gradient(transparent, rgba(0, 0, 0, 0.05));
      position: absolute;
      content: '' !important;
      opacity: 1;
      z-index: 2;
      border: none;
      -webkit-box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15), 0px 0px 0px 1px rgba(34, 36, 38, 0.15) inset;
      box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15), 0px 0px 0px 1px rgba(34, 36, 38, 0.15) inset;
      width: 1.2rem;
      height: 1.2rem;
      top: -.1rem;
      left: 0em;
      border-radius: 500rem;
      -webkit-transition: background 0.3s ease, left 0.3s ease;
      transition: background 0.3s ease, left 0.3s ease
    }

    .multiline input ~ .box:after, .multiline input ~ label:after {
      left: -0.05rem;
      -webkit-box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15), 0px 0px 0px 1px rgba(34, 36, 38, 0.15) inset;
      box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15), 0px 0px 0px 1px rgba(34, 36, 38, 0.15) inset
    }

    .multiline input:focus ~ .box:before, .multiline input:focus ~ label:before {
      background-color: rgba(0, 0, 0, 0.15);
      border: none
    }

    .multiline .box:hover::before, .multiline label:hover::before {
      background-color: rgba(0, 0, 0, 0.15);
      border: none
    }

    .multiline input:checked ~ .box, .multiline input:checked ~ label {
      color: rgba(0, 0, 0, 0.95) !important
    }

    .multiline input:checked ~ .box:before, .multiline input:checked ~ label:before {
      background-color: #2185D0 !important
    }

    .multiline input:checked ~ .box:after, .multiline input:checked ~ label:after {
      left: 2.3rem;
      -webkit-box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15), 0px 0px 0px 1px rgba(34, 36, 38, 0.15) inset;
      box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15), 0px 0px 0px 1px rgba(34, 36, 38, 0.15) inset
    }

    .multiline input:focus:checked ~ .box, .multiline input:focus:checked ~ label {
      color: rgba(0, 0, 0, 0.95) !important
    }

    .multiline input:focus:checked ~ .box:before, .multiline input:focus:checked ~ label:before {
      background-color: #0d71bb !important
    }

    #typecho-option-item-MathJaxConfig-15 {
      display: none
    }
  </style>
  <?php
  echo '<div class="tip"><span class="current-ver"><strong><code>Ver ' . JaydenForU_VERSION . '</code></strong></span>
    <div class="tip-header"><h1>Theme-JaydenForYou</h1></div>
    <p>感谢选择使用 <code>JaydenForYou</code> </p>
    <p>查看<a href="//iobiji.com/zi-ji-xie-de-di-yi-kuan-typechozhu-ti-jaydenforu/">帮助手册</a> <a href="https://github.com/JaydenForYou/JaydenForU/issues">issue</a></p>
</div>';
  $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
  $bgUrl = new Typecho_Widget_Helper_Form_Element_Text('bgUrl', NULL, NULL, _t('首页背景图片'), _t('在这里填入一个图片 URL 地址'));
  $Gravatar = new Typecho_Widget_Helper_Form_Element_Text('Gravatar', NULL, NULL, _t('自定义 Gravatar 源'), _t('输入Gravatar源，如https://cdn.v2ex.com/gravatar/'));
  $cdn = new Typecho_Widget_Helper_Form_Element_Text('cdn', NULL, NULL, _t('使用自己的静态存储'), _t('输入静态存储链接(不需要带http/https)'));
  $APPID = new Typecho_Widget_Helper_Form_Element_Text('APPID', NULL, NULL, _t('APP ID'), _t('输入在Valine获取的APP ID'));
  $APPKEY = new Typecho_Widget_Helper_Form_Element_Text('APPKEY', NULL, NULL, _t('APP KEY'), _t('输入在Valine获取的APP KEY'));
  $weibo = new Typecho_Widget_Helper_Form_Element_Text('weibo', NULL, NULL, _t('微博地址'), _t('输入微博地址'));
  $twitter = new Typecho_Widget_Helper_Form_Element_Text('twitter', NULL, NULL, _t('推特地址'), _t('输入推特地址'));
  $tongji = new Typecho_Widget_Helper_Form_Element_Text('tongji', NULL, NULL, _t('百度统计URL'), _t('输入百度统计URL'));
  $tips = new Typecho_Widget_Helper_Form_Element_Text('tips', NULL, NULL, _t('前台公告'), _t(''));
  $beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('ICP备案号'), _t(''));
  $Subtitle = new Typecho_Widget_Helper_Form_Element_Text('Subtitle', NULL, NULL, _t('站点副标题'), _t(''));
  $qiniu = new Typecho_Widget_Helper_Form_Element_Text('qiniu', NULL, NULL, _t('七牛云替换全站镜像'), _t('需要带http/https'));
  $form->addInput($logoUrl);
  $form->addInput($bgUrl);
  $form->addInput($tips);
  $form->addInput($Subtitle);
  $form->addInput($beian);
  $form->addInput($qiniu);
  $form->addInput($tongji);
  $form->addInput($weibo);
  $form->addInput($twitter);
  $form->addInput($Gravatar);
  $form->addInput($cdn);
  $form->addInput($APPID);
  $form->addInput($APPKEY);
  $JConfig = new Typecho_Widget_Helper_Form_Element_Checkbox('JConfig',
      array(
          'enableLazyload' => '开启图片懒加载<a href="https://appelsiini.net/projects/lazyload" target="_blank">lazyload</a>'
      ),
      null,
      '开关设置'
  );
  $form->addInput($JConfig->multiMode());
}

function themeFields($layout)
{
  //$showTOC = new Typecho_Widget_Helper_Form_Element_Radio('showTOC', array(true => _t('开启'), false => _t('关闭')), false, _t('文章目录'), _t('仅会解析h2和h3标题，最多解析两层'));
  $previewContent = new Typecho_Widget_Helper_Form_Element_Text('previewContent', NULL, NULL, _t('文章摘要'), _t('设置文章的预览内容，留空自动截取文章前55个字。'));
  $thumbnail = new Typecho_Widget_Helper_Form_Element_Text('thumbnail', NULL, NULL, _t('文章/页面缩略图Url'), _t('需要带上http(s)://'));
  $layout->addItem($thumbnail);
  $layout->addItem($previewContent);
  //$layout->addItem($showTOC);
}

function get_post_view($archive)
{
  $cid = $archive->cid;
  $db = Typecho_Db::get();
  $prefix = $db->getPrefix();
  if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
    $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
    echo 0;
    return;
  }
  $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
  if ($archive->is('single')) {
    $views = Typecho_Cookie::get('extend_contents_views');
    if (empty($views)) {
      $views = array();
    } else {
      $views = explode(',', $views);
    }
    if (!in_array($cid, $views)) {
      $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
      array_push($views, $cid);
      $views = implode(',', $views);
      Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
    }
  }
  echo $row['views'];
}
