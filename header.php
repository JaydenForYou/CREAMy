<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
if(!empty($this->options->qiniu)){
  $qurl = str_replace($this->options->siteUrl,$this->options->qiniu.'/',$this->options->themeUrl);
}else{
  $qurl = $this->options->themeUrl;
}
$awesome = $qurl.'/assets/fonts/css/font-awesome.css';
$bootstrap = $qurl.'/assets/bootstrap/bootstrap.css';
$appmin = $qurl.'/assets/app/css/app.min.css?ver=1153';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="<?php $this->options->charset(); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="HandheldFriendly" content="True"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php $this->archiveTitle(array(
        'category' => _t('分类 %s 下的文章'),
        'search' => _t('包含关键字 %s 的文章'),
        'tag' => _t('标签 %s 下的文章'),
        'author' => _t('%s 发布的文章')
    ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')): ?> - <?php $this->options->description(); ?><?php endif; ?></title>
  <link rel="dns-prefetch" href="<?php $this->options->siteUrl(); ?>">
  <?php if(!empty($this->options->qiniu)):?>
  <link rel="dns-prefetch" href="<?php echo $this->options->qiniu; ?>">
  <?php endif;?>
  <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
  <link rel="dns-prefetch" href="//hm.baidu.com">
  <link rel="dns-prefetch" href="//zz.bdstatic.com">
  <link rel="dns-prefetch" href="//sp0.baidu.com">
  <link rel="dns-prefetch" href="//api.share.baidu.com">
  <link rel="dns-prefetch" href="//push.zhanzhang.baidu.com">
  <?php if ($this->options->logoUrl): ?>
    <link rel="shortcut icon" href="<?= $this->options->logoUrl ?>" type="image/png"/>
  <?php endif; ?>
  <link type="text/css" rel="stylesheet"
        href="<?=$awesome?>"/>
  <link type="text/css" rel="stylesheet" href="<?=$bootstrap?>"/>
  <link type="text/css" rel="stylesheet"
        href="<?=$appmin?>"/>
  <?php $this->header(); ?>
  <script>
    var APPID = '<?php $this->options->APPID()?>';
    var APPKEY = '<?php $this->options->APPKEY()?>';
    var tongji = '<?php $this->options->tongji()?>';
  </script>
</head>
<body class="home-template"><!-- 添加 .home-template 以便识别模板为首页 -->
<div class="site-warp">
  <header class="site-header fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link <?php if($this->is('index')){echo 'active';}?>" href="<?php $this->options->siteUrl(); ?>">首页</a>
            </li>
            <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
            <?php while ($category->next()): ?>
              <li class="nav-item"><a <?php if ($this->is('category', $category->slug)): ?>class="nav-link active"<?php else: ?>class="nav-link"<?php endif; ?> href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a></li>
            <?php endwhile; ?>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <li class="nav-item"><a <?php if($this->is('page', $pages->slug)): ?>class="nav-link active"<?php else: ?>class="nav-link"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
              <?php endwhile; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
