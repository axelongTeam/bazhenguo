<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"E:\weixin/application/wechat\view\news.select.html";i:1497932035;s:48:"E:\weixin/application/extra\view\admin.main.html";i:1497932035;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="<?php echo sysconf('browser_icon'); ?>" />
        <title><?php echo (isset($title) && ($title !== '')?$title:''); ?>&nbsp;<?php if(!empty($title)): ?>-<?php endif; ?>&nbsp;<?php echo sysconf('site_name'); ?></title>
        <link rel="stylesheet" href="__PUBLIC__/static/plugs/bootstrap/css/bootstrap.min.css?ver=<?php echo date('ymd'); ?>"/>
        <link rel="stylesheet" href="__PUBLIC__/static/plugs/layui/css/layui.css?ver=<?php echo date('ymd'); ?>"/>
        <link rel="stylesheet" href="__PUBLIC__/static/theme/default/css/console.css?ver=<?php echo date('ymd'); ?>">
        <link rel="stylesheet" href="__PUBLIC__/static/theme/default/css/animate.css?ver=<?php echo date('ymd'); ?>">
<style>
    body { min-width: 500px }
    .news-container { margin: 20px 0; width: 100%; position: relative;padding:0 20px}
    .news-container .news-box { border: 1px solid #eee; padding: 8px; width: 250px; border-radius: 5px; position: absolute; margin-bottom: 20px; cursor: pointer }
    .news-container .news-box:hover, .news-container .news-box.active { box-shadow: 1px 0px 10px #0099CC; border-color: #0099CC }
    .news-container .news-box hr { margin: 4px }
    .news-container .news-box .table-hover { margin-bottom: 0; margin-top: 10px; border-top: none }
    .news-container .news-box .news-item { position: relative; border-radius: 2px; overflow: hidden; }
    .news-container .news-box .news-image { text-align: center }
    .news-container .news-box .news-image img { height: 159px; width: 100%; border-radius: 2px }
    .news-container .news-box .news-btn a { padding: 15px 5px; color: #666 }
    .news-container .news-box .news-btn .fa, .news-container .news-box .news-btn .glyphicon { font-size: 1.2em; }
    .news-container .news-box .news-btn { display: block; text-align: center; font-size: 1em; color: #cecece; padding: 3px; position: relative; cursor: pointer }
    .news-container .news-box .news-title { position: absolute; background: rgba(0, 0, 0, 0.5); color: #fff; padding: 5px; margin: 0; bottom: 0; left: 0; right: 0; text-align: right; white-space: nowrap; text-overflow: ellipsis; overflow: hidden }
</style>

        <script>window.ROOT_URL = '__PUBLIC__';</script>
        <script src="__PUBLIC__/static/plugs/require/require.js?ver=<?php echo date('ymd'); ?>"></script>
        <script src="__PUBLIC__/static/admin/app.js?ver=<?php echo date('ymd'); ?>"></script>
    </head>
    
    <body>
        
<div class="news-container" id='news_box'>
    <?php foreach($list as $key=>$vo): ?>
    <div class="news-box item transition" data-news-id='<?php echo $vo['id']; ?>'>
        <?php foreach($vo['articles'] as $key=>$value): ?>
        <div class="news-item transition" data-id="<?php echo $value['id']; ?>">
            <div class="news-image">
                <img alt="image" class="img-responsive" src="<?php echo $value['local_url']; ?>"/>
            </div>
            <span class="news-title"> <?php echo $value['title']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; ?>


        
<script>
    require(['jquery.masonry'], function (Masonry) {
        var container = document.querySelector('#news_box');
        var msnry = new Masonry(container, {itemSelector: '.news-box', columnWidth: 0});
        msnry.layout();
        /* 事件处理 */
        $('.news-container').on('mouseenter', '.news-box', function () {
            $(this).addClass('active');
        }).on('mouseleave', '.news-box', function () {
            $(this).removeClass('active');
        });
        var seletor = '[name="<?php echo (decode(\think\Request::instance()->get('field')) ?: 0); ?>"]';
        if (seletor) {
            $('[data-news-id]').on('click', function () {
                window.top.$(seletor).val($(this).attr('data-news-id')).trigger('change');
                parent.layer.close(parent.layer.getFrameIndex(window.name))
            });
        }
    });
</script>

    </body>
    
</html>