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
          <span><?php $this->category(' / '); ?></span>
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
      <section class="post-donation text-center w-100">
        <button type="button" class="btn btn-donation" data-toggle="collapse" data-target="#collapseDonation"
                aria-expanded="false" aria-controls="collapseDonation" title="捐赠">
          <i class="fas fa-coffee"></i>
        </button>
        <div class="collapse collapse-donation" id="collapseDonation">
          <div class="card card-body card-collapse">
            <div class="row">
              <?php if ($this->options->alipay != null): ?>
                <div class="col-sm">
                  <figure class="figure">
                    <img src="<?=$this->options->alipay; ?>" alt="支付宝捐赠" title="请使用支付宝扫一扫进行捐赠">
                    <figcaption class="figure-caption">请使用支付宝扫一扫进行捐赠</figcaption>
                  </figure>
                </div>
              <?php endif ?>
              <?php if ($this->options->wpay != null): ?>
                <div class="col-sm">
                  <figure class="figure">
                    <img src="<?=$this->options->wpay; ?>" alt="微信捐赠" title="请使用微信扫一扫进行赞赏">
                    <figcaption class="figure-caption">请使用微信扫一扫进行赞赏</figcaption>
                  </figure>
                </div>
              <?php endif ?>
            </div>
          </div>
        </div>
      </section>
      <ul class="post-copyright">
        <li class="post-copyright-author">
          <strong>文章作者： </strong><?php $this->author(); ?></li>
        <li class="post-copyright-link">
          <strong>文章链接：</strong>
          <a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->permalink() ?></a>
        </li>
        <li class="post-copyright-license">
          <strong>版权声明： </strong>本博客所有文章除特别声明外，均采用 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/"
                                                      rel="external nofollow" target="_blank">CC BY-NC-SA 4.0</a>
          许可协议。转载请注明出处！
        </li>
      </ul>
      <section class="post-footer d-flex justify-content-between align-items-center">
        <section class="author-card d-flex justify-content-between align-items-center">
          <?php echo $this->author->gravatar(320, 'G', NULL, 'author-profile-image') ?>
          <section class="author-card-content">
            <h4 class="author-card-name">
              <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
            </h4>
            <p><?php echo $this->options->description; ?></p>
          </section>
        </section>
        <div class="post-footer-right">
          <a class="author-card-button" href="<?php $this->author->permalink(); ?>">更多文章</a>
        </div>
      </section>
      <?php if ($this->allow('comment')): ?>
        <div class="post-comments">
          <!-- 这里放置评论框 -->
          <?php if (Utils::isEnabled('enableComments', 'JConfig')): ?>
            <?php $this->need('comments.php'); ?>
          <?php else: ?>
            <div id="vcomments" class="v">
            </div>
          <?php endif ?>
        </div>
      <?php else: ?>
        <span style="font-size: 20px;display: block;user-select: none;"><i class="iconfont icon-aria-close"
                                                                           sytle="font-size:20px"></i> 评论关闭了哟</span>
      <?php endif; ?>
    </div>
  </main>
<?php $this->need('footer.php'); ?>