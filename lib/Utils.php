<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
  exit;
}

/**
 * Utils.php
 * 部分工具
 *
 * @author     Jayden
 * @version    since 1.0.2
 */
class Utils
{
  /**
   * 输出博客以及主题部分配置信息为前端提供接口
   *
   * @return void
   */
  public static function JConfig()
  {
    $JConfig = Helper::options()->JConfig;
    $options = Helper::options();
    $enableLazyload = self::isEnabled('enableLazyload', 'JConfig');

    $THEME_CONFIG = json_encode((object)array(
        "THEME_VERSION" => JaydenForU_VERSION,
        "SITE_URL" => rtrim($options->siteUrl, "/"),
        "THEME_URL" => $options->themeUrl,
        "ENABLE_LAZYLOAD" => $enableLazyload
    ));

    echo "<script>window.THEME_CONFIG = $THEME_CONFIG</script>\n";
  }

  /**
   * 返回主题设置中某项开关的开启/关闭状态
   *
   * @param string $item 项目名
   * @param string $config 设置名
   *
   * @return bool
   */
  public static function isEnabled($item, $config)
  {
    $config = Helper::options()->$config;
    $status = !empty($config) && in_array($item, $config) ? true : false;
    return $status;
  }

  /**
   * 将部分主题配置中的string数据转换为array或键值对
   *
   * @param string $item 设置名
   * @param bool $mode 转换类型
   *
   * @return array|bool
   */
  public static function convertConfigData($item, $mode)
  {
    $options = Helper::options();
    //根据$item获取对应的设置中的string数据
    $data = $options->$item ? $options->$item : false;
    $content = null;
    if (!$data) {
      //不存在对应的设置名或内容为空
      $content = false;
    } else {
      if ($mode) {
        //转换为数组
        $content = json_decode("[" . $data . "]", true);
      } else {
        //转换为键值对
        $content = json_decode(trim("{" . $data . "}"), true);
      }
    }
    return $content;
  }

  /**
   * 获取背景图片
   *
   * @return void
   */
  public static function getBackground()
  {
    $options = Helper::options();
    if(!null==$options->qiniu){
      $qurl = str_replace($options->siteUrl,$options->qiniu.'/',$options->themeUrl);
    }else{
      $qurl = $options->themeUrl;
    }
    if ($options->bgUrl) {
      return $options->bgUrl;
    } else {
      return $qurl.'/assets/images/hero-background.jpg';
    }
  }

  /**
   * 获取默认缩略图
   */
  public static function getThumbnail()
  {
    $options = Helper::options();
    if(!null==$options->qiniu){
      $qurl = str_replace($options->siteUrl,$options->qiniu.'/',$options->themeUrl);
    }else{
      $qurl = $options->themeUrl;
    }
    return $qurl . '/assets/images/4.jpg';
  }

  /**
   * 获取分类文章数量
   */
  public static function getCnums($name){
    $db = Typecho_Db::get();
    $cx = $db->fetchRow($db->select()->from('table.metas')->where('table.metas.type = ?', 'category')->where('table.metas.slug = ?', $name))['count'];
    return $cx;
  }
}
