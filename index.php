<?php
/**
 * 一款简洁的TYPECHO主题
 *
 * @package JaydenForU
 * @author Jayden
 * @version 1.0.2
 * @link https://iobiji.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
$hiddens = '';
$hidden = '';
$prev = $this->_currentPage - 1;
$next = $this->_currentPage + 1;
if ($this->_currentPage == 0 || $this->_currentPage == 1) {
  $hidden = 'hidden';
  $cpage = 1;
} else {
  $cpage = $this->_currentPage;
}
if ($this->_currentPage == ceil($this->getTotal() / $this->parameter->pageSize)) {
  $hiddens = 'hidden';
}
if (ceil($this->getTotal() / $this->parameter->pageSize) == 1) {
  $hiddens = 'hidden';
  $hidden = 'hidden';
}
if(!empty($this->options->qiniu)){
  $qurl = str_replace($this->options->siteUrl,$this->options->qiniu.'/',$this->options->themeUrl);
}else{
  $qurl = $this->options->themeUrl;
}
?>
<section class="site-hero responsive-title-img" style="background-image: url('<?php $this->options->bgUrl(); ?>');">
  <div class="container">
    <div class="hero-content">
      <h1 class="site-name"><?php $this->options->title(); ?></h1>
      <h2 class="site-description"><?php $this->options->description() ?></h2>
    </div>
  </div>
</section>
<main class="site-main container">
  <div class="inner row">
    <div class="site-post-list">
      <div class="post-list">
        <?php while ($this->next()): ?>
        <?php if ($this->sequence % 2 == 0): ?>
        <article class="post-card align-right">
          <?php else: ?>
          <article class="post-card align-left">
            <?php endif ?>
            <a href="<?php $this->permalink() ?>" class="post-card-image-link">
              <div class="post-card-image" style="background-image: url(<?php
              if ($this->fields->thumbnail) {
                echo $this->fields->thumbnail;
              } else {
                echo $qurl.'/assets/images/4.jpg';
              }
              ?>)"></div>
            </a>
            <div class="post-card-content">
              <header>
                <ul class="post-tags">
                  <li class="post-tag"><?php $this->category('/'); ?></li>
                </ul>
                <h3 class="post-card-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
              </header>
              <section class="post-card-excerpt">
                <p><?php $this->excerpt(70, '- 点击阅读剩余部分 -'); ?></p>
              </section>
              <footer class="post-meta">
                <ul class="author-list">
                  <li class="author-list-item">
                    <a href="#" class="static-avatar">
                      <?php echo $this->author->gravatar(32,'X',NULL,'author-profile-image') ?>
                      <span class="author-profile-name"><?php $this->author(); ?></span>
                    </a>
                  </li>
                </ul>
              </footer>
            </div>
          </article>
          <?php endwhile; ?>
      </div>
    </div>
    <div class="site-pagination">
      <nav aria-label="文章分页">
        <ul class="pagination">
          <li class="page-item" <?php echo $hidden ?>>
            <a class="page-link" href="/page/<?php echo $prev ?>" aria-label="上一页">
                <span aria-hidden="true">
                  <i class="fas fa-angle-left"></i>
                </span>
            </a>
          </li>
          <li class="page-item"><a class="page-link">第<?= $cpage ?>页，共<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?>页</a></li>
          <li class="page-item" <?php echo $hiddens ?>>
            <a class="page-link" href="/page/<?php echo $next ?>" aria-label="下一页">
                <span aria-hidden="true">
                  <i class="fas fa-angle-right"></i>
                </span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</main>
<?php $this->need('footer.php'); ?>

