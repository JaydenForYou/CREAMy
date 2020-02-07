<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
if ($this->fields->thumbnail != null) {
  $class = 'responsive-title-img';
} else {
  $class = 'responsive-title-no-img';
}
?>
<?php if (!Utils::isEnabled('enableComments', 'JConfig')): ?>
  <script src='//unpkg.com/valine/dist/Valine.min.js'></script>
<?php endif ?>
<section class="site-hero <?= $class ?>"
         <?php if ($class != 'responsive-title-no-img'): ?>style="background-image: url('<?php echo $this->fields->thumbnail ?>')"<?php endif ?> >
  <!-- 没有图片 添加 .responsive-title-no-img -->
  <div class="container">
    <div class="hero-content">
      <h1 class="post-full-title"><?php $this->title() ?></h1>
      <section class="post-full-meta">
        <time class="post-full-meta-date"
              datetime="<?= date('Y-m-d', $this->created) ?>"><?= date('Y年m月d日', $this->created) ?></time>
        <span class="date-divider"> / </span>
        <span class="post-full-meta-visitors">
            <i class="post-meta-item-text"> 阅读量 </i>
            <i class="leancloud-visitors-count"><?php get_post_view($this) ?></i>
          </span>
      </section>
    </div>
  </div>
</section>
<main class="site-main container">
  <div class="inner row">
    <article>
      <section class="post-content">
        <?php if (Utils::isEnabled('enableLazyload', 'JConfig')): ?>
          <?php echo preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i', "<img\$1data-src=\"\$2\" src=\"/usr/themes/JaydenForU/assets/images/loading.svg\" class=\"lazyload\"\$3>\n<noscript>\$0</noscript>", Utils::getContent($this->content)); ?>
        <?php else: ?>
          <?php echo Utils::getContent($this->content); ?>
        <?php endif ?>
      </section>
    </article>
  </div>
</main>
<?php $this->need('footer.php'); ?>
