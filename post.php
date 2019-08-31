<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
if (!null==$this->fields->thumbnail) {
  $class = 'responsive-title-img';
} else {
  $class = 'responsive-title-no-img';
}
?>
<script src='//unpkg.com/valine/dist/Valine.min.js'></script>
<section class="site-hero <?=$class?>" <?php if(!empty($this->fields->thumbnail)): ?>style="background-image: url(<?php echo $this->fields->thumbnail ?>)"><?php endif ?> <!-- 没有图片 添加 .responsive-title-no-img -->
  <div class="container">
    <div class="hero-content">
      <h1 class="post-full-title"><?php $this->title() ?></h1>
      <section class="post-full-meta">
        <time class="post-full-meta-date" datetime="<?= date('Y-m-d', $this->created) ?> / "><?= date('Y年m月d日', $this->created) ?></time>
        <span class="date-divider"> / </span>
        <span><?php $this->category(' / '); ?> / </span>
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
        <?php $this->content(); ?>
      </section>
    </article>
    <ul class="post-copyright">
      <li class="post-copyright-author">
        <strong>文章作者： </strong><?php $this->author(); ?></li>
      <li class="post-copyright-link">
        <strong>文章链接：</strong>
        <a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->permalink() ?></a>
      </li>
      <li class="post-copyright-license">
        <strong>版权声明： </strong>本博客所有文章除特别声明外，均采用 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" rel="external nofollow" target="_blank">CC BY-NC-SA 4.0</a> 许可协议。转载请注明出处！
      </li>
    </ul>
    <?php if ($this->allow('comment')): ?>
      <div class="post-comments">
        <!-- 这里放置评论框 -->
        <div id="vcomments" class="v"></div>
      </div>
    <?php endif; ?>
  </div>
</main>
<?php $this->need('footer.php'); ?>

