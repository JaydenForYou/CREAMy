<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<style>
  [data-theme=dark] .post-comments .v .vwrap {
    border:1px solid #080808
  }
  [data-theme=dark] .post-comments .v .vwrap .vheader .vinput {
    border-bottom:.0625rem dashed #b7b7b7
  }
  [data-theme=dark] .post-comments .v .vbtn {
    border:1px solid #080808;
    background:#252525;
    color:#b7b7b7
  }
  [data-theme=dark] .post-comments .v .vlist .vcard .vhead .vsys {
    background:#080808;
    color:#b7b7b7
  }
  [data-theme=dark] .post-comments .v .vlist .vcard .vh {
    border-bottom:.0625rem dashed #080808
  }
  [data-theme=dark] .post-comments .v .vlist .vquote {
    border-left:#080808
  }
  [data-theme=dark] .post-comments .v .vcontrol .col {
    color:#252525
  }
  [data-theme=dark] .post-comments .v * {
    color:#b7b7b7
  }
</style>
<?php
function threadedComments($comments, $options)
{
  $commentClass = '';
  if ($comments->authorId) {
    if ($comments->authorId == $comments->ownerId) {
      $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
    } else {
      $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
    }
  }
  $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
  ?>
  <li id="<?php $comments->theId(); ?>" class="comment-body<?php
  if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
  } else {
    echo ' comment-parent';
  }
  $comments->alt(' comment-odd', ' comment-even');
  echo $commentClass;
  ?>">
    <div class="vcard" id="<?php $comments->theId(); ?>">
      <img class="vimg" src="<?php echo Utils::gGravatar($comments->author); ?>">
      <div class="vh" id="<?php $comments->theId(); ?>">
        <div class="vhead">
          <a class="vnick" rel="nofollow" href="<?php echo $comments->url; ?>"
             target="_blank"><?php echo $comments->author; ?></a><?php echo Comments::parseUserAgent($comments->agent); ?>
        </div>
        <div class="vmeta">
          <span class="vtime"><?php $comments->date('Y-m-d H:i'); ?></span>
          <span class="vat"><button onclick="onClick('<?php $comments->theId(); ?>','<?php echo $comments->author; ?>')"
                                    class="vsubmit vbtn">回复</button></span>
        </div>
        <div class="vcontent">
          <p>
            <?php $comments->content(); ?>
          </p>
        </div>
      </div>
    </div>
    <?php if ($comments->children) { ?>
      <div class="vquote">
        <?php $comments->threadedComments($options); ?>
      </div>
    <?php } ?>
  </li>
<?php } ?>
<div class="post-comments">
  <?php if($this->user->hasLogin()): ?>
    <p>
      <?php _e('当前登录身份: '); ?>
      <a href="<?php $this->options->profileUrl(); ?>">
        <?php $this->user->screenName(); ?>
      </a>.
      <a href="<?php $this->options->logoutUrl(); ?>" title="Logout" no-pjax>
        <?php _e('退出'); ?>&raquo;</a>
    </p>
  <?php endif ?>
  <div id="<?php $this->respondId(); ?>" class="v">
    <form method="post" action="comment" id="comment-form" role="form">
      <div class="vwrap">
        <div class="vheader item3">
          <input name="author" id="author" placeholder="昵称" value="<?php $this->remember('author'); ?>" class="vnick vinput" type="text" required><input name="mail"
                                                                                                             id="mail"
                                                                                                             placeholder="邮箱"
                                                                                                             class="vmail vinput"
                                                                                                             type="email" value="<?php $this->remember('mail'); ?>"><input
                  name="url" placeholder="网址(http://)" class="vlink vinput" type="text" value="<?php $this->remember('url'); ?>">
        </div>
        <div class="vedit">
          <textarea id="textarea" name="text" id="mail" class="veditor vinput" placeholder="请您理智发言，共建美好社会！"></textarea>
        </div>
        <div class="vcontrol">
          <div class="col col-100 text-right">
            <button id="reply" type="submit" title="Cmd|Ctrl+Enter" class="vsubmit vbtn">回复</button>
          </div>
        </div>
        <div style="display:none;" class="vmark">
        </div>
      </div>
    </form>
    <div class="vinfo" style="display:none;">
      <div class="vcount col">
      </div>
    </div>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <div class="vlist">
        <?php $comments->listComments(); ?>
    </div>
    <?php else: ?>
    <div class="vempty" style="display:block;">
      快来做第一个评论的人吧~
    </div>
    <?php endif ?>
    <div class="vpage txt-center">
    </div>
    <div class="info">
      <div class="power txt-right">
        Powered By <a href="//iobiji.com" target="_blank">Jayden</a><br>
      </div>
    </div>
  </div>
</div>
