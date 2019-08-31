/**
 * 该文件无用，仅限展示
 * 移植主题请不要把该文件写入
 */
(function ($) {
  $(function () {
    $('.post-list').on('click', '.post-card-image-link', function () {
      window.location.href = './post.html';
    }).on('click', '.post-card-title a', function () {
      window.location.href = './post.html';
    });

    $('.navbar-nav').on('click', '.nav-item', function () {
      window.location.href = './page.html';
    })
  })
})(jQuery);
