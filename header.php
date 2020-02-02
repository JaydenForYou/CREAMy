<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!empty($this->options->cdn) && $this->options->cdn) {
  define('__TYPECHO_THEME_URL__', Typecho_Common::url(__TYPECHO_THEME_DIR__ . '/' . basename(dirname(__FILE__)), $this->options->cdn));
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="<?php $this->options->charset(); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="HandheldFriendly" content="True"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="referrer" content="no-referrer-when-downgrade"/>
  <title><?php $this->archiveTitle(array(
      'category' => _t('分类 %s 下的文章'),
      'search' => _t('包含关键字 %s 的文章'),
      'tag' => _t('标签 %s 下的文章'),
      'author' => _t('%s 发布的文章')
    ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')): ?><?php if (!null == $this->options->Subtitle) {
      echo ' - ' . $this->options->Subtitle;
    } ?><?php endif; ?></title>
  <link rel="dns-prefetch" href="<?php $this->options->siteUrl(); ?>">
  <?php if (!empty($this->options->qiniu)): ?>
    <link rel="dns-prefetch" href="<?php echo $this->options->qiniu; ?>">
  <?php endif; ?>
  <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
  <link rel="dns-prefetch" href="//hm.baidu.com">
  <link rel="dns-prefetch" href="//zz.bdstatic.com">
  <link rel="dns-prefetch" href="//sp0.baidu.com">
  <link rel="dns-prefetch" href="//api.share.baidu.com">
  <link rel="dns-prefetch" href="//push.zhanzhang.baidu.com">
  <?php if ($this->options->logoUrl): ?>
    <link rel="shortcut icon" href="<?= $this->options->logoUrl ?>" type="image/png"/>
  <?php endif; ?>
  <?php if (Utils::isEnabled('enablePJAX', 'JConfig')): ?>
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
  <?php endif ?>
  <link type="text/css" rel="stylesheet"
        href="//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css"/>
  <link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/app/css/style.css'); ?>">
  <link type="text/css" rel="stylesheet"
        href="<?php $this->options->themeUrl('assets/app/css/app.min.css'); ?>"/>
  <?php $this->header(); ?>
</head>
<body class="home-template"><!-- 添加 .home-template 以便识别模板为首页 -->
<div class="site-warp">
  <header class="site-header fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a id="home" class="nav-link <?php if ($this->is('index')) {
                echo 'active';
              } ?>" href="<?php $this->options->siteUrl(); ?>">首页</a>
            </li>
            <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
            <?php while ($category->next()): ?>
              <li class="nav-item"><a class="nav-link <?php if ($this->is('category', $category->slug)) {
                  echo 'active';
                } ?>" href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a></li>
            <?php endwhile; ?>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while ($pages->next()): ?>
            <li class="nav-item"><a class="nav-link <?php if ($this->is('page', $pages->slug)) {
                echo 'active';
              } ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
              <?php endwhile; ?>
            <li class="nav-item m-0 d-none d-md-block d-lg-block d-xl-block">
              <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search"
                    class="site-searchbar">
                <label for="nav-top-search"></label>
                <input id="nav-top-search" name="s" class="search-input" type="text" placeholder="Search...">
                <a class="search-icon"><i class="fas fa-search"></i></a>
              </form>
            </li>
            <li class="nav-item d-block d-md-none d-lg-none d-xl-none">
              <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search"
                    class="mobile-search">
                <div class="input-group">
                  <input id="mobile-search" name="s" type="text" class="mobile-search-input form-control"
                         placeholder="Search..." aria-label="Search Input">
                </div>
              </form>
            </li>
            <?php if (!Utils::isEnabled('enablePJAX', 'JConfig')): ?>
              <li class="nav-item">
                <label class="dark-switch-label" for="darkSwitch">
                  <a class="dark-switch-label-span" data-toggle="tooltip" data-placement="bottom" title="日夜模式">
                    <i class="fas fa-sun"></i>
                  </a>
                </label>
                <input type="checkbox" class="custom-control-input" id="darkSwitch">
              </li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div id="pjax"><!-- start #pjax-container -->