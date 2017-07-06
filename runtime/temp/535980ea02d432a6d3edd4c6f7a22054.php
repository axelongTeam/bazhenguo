<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"E:\weixin/application/wechat\view\review.index.html";i:1497932035;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="initial-scale=1,maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="stylesheet" href="__PUBLIC__/static/plugs/aui/aui.css">
    </head>
    <body class='aui-scroll-x'>
        <style>
            * {font-family: "Microsoft YaHei" !important;letter-spacing: .01rem}
            html,body{display:block;height:100%;overflow:auto!important}
            .aui-chat .aui-chat-media img {border-radius:0}
            .aui-chat .aui-chat-inner {max-width:80%!important;}
            .aui-chat .bg-white {background: #f5f5f5!important;border:1px solid #ccc;}
            .aui-chat .time {color: #f5f5f5;background:rgba(0,0,0,.3);padding:.1rem .3rem;border-radius:.2rem;font-size:.5rem;}
            .aui-chat .aui-chat-content .aui-chat-arrow.two {top:.7rem!important;background:#f5f5f5!important;left:-0.25rem!important;}
            .aui-chat .aui-chat-content .aui-chat-arrow.one {top:.7rem!important;background:#f5f5f5!important;border:1px solid #ccc!important;left:-0.28rem!important;}
            .aui-card-list-content-padded img {max-width: 100% !important;}
        </style>
        <script src="__PUBLIC__/static/plugs/jquery/jquery.min.js" type="text/javascript"></script>
        <?php if(($type == 'text') or ($type == 'image') or ($type == 'music')): ?>
        <section class="aui-chat">
            <div class="aui-chat-header"><span class="time"><?php echo date('H:i'); ?></span></div>
            <div class="aui-chat-item aui-chat-left">
                <div class="aui-chat-media">
                    <img src="__PUBLIC__/static/theme/default/img/head.gif"/>
                </div>
                <div class="aui-chat-inner">
                    <?php if($type == 'text'): ?>
                    <div class="aui-chat-content bg-white">
                        <div class="aui-chat-arrow one"></div>
                        <div class="aui-chat-arrow two"></div>
                        <?php echo (isset($content) && ($content !== '')?$content:''); ?>
                    </div>
                    <?php elseif($type == 'image'): ?>
                    <div class="aui-chat-content bg-white">
                        <div class="aui-chat-arrow one"></div>
                        <div class="aui-chat-arrow two"></div>
                        <img src='<?php echo (isset($content) && ($content !== '')?$content:"__PUBLIC__/static/theme/default/img/image.png"); ?>'/>
                    </div>
                    <?php elseif($type == 'music'): ?>
                    <div class="aui-chat-content" style='background:#080'>
                        <div class="aui-chat-arrow one" style="background:#080!important;"></div>
                        <div class="aui-chat-arrow two" style="background:#080!important;"></div>
                        <table>
                            <tr>
                                <td style='overflow:hidden;white-space:nowrap;color:#f5f5f5;min-width:100%'>
                                    <?php echo (isset($title) && ($title !== '')?$title:''); ?>
                                </td>
                                <td style='overflow:hidden;white-space:nowrap;color:#f5f5f5;max-width:100%;' rowspan="2">
                                    <div style='position:absolute;right:0;top:0;bottom:0;width:2.5rem;background:#080;border-radius:5px'></div>
                                    <div style='width:1.5rem;height:1.5rem;background:#0a0;padding:.1rem;text-align:center;position:absolute;right:.5rem;top:1rem'>
                                        <i style='font-size:1rem' class='aui-iconfont aui-icon-video'></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style='overflow:hidden;white-space:nowrap;color:#f5f5f5;font-size:.3rem;'>
                                    <?php echo (isset($desc) && ($desc !== '')?$desc:''); ?>　　　　　　　　　　
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php elseif($type == 'article'): ?>
        <section class="aui-content">
            <div class="aui-card-list" style='margin-bottom:0'>
                <div class="aui-card-list-header" style='font-size:1rem'><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></div>
                <div class="aui-info" style='padding:0 15px'>
                    <div class="aui-info-item" style='font-size:0.8rem;color:#666'>
                        <span class="aui-margin-l-5"><?php echo date('Y-m-d',strtotime($vo['create_at'])); ?></span>
                        <span class="aui-margin-l-5" style='color:#0099CC'><?php echo (isset($vo['author']) && ($vo['author'] !== '')?$vo['author']:''); ?></span>
                    </div>
                </div>
                <?php if($vo['show_cover_pic'] == 1): ?>
                <div class="aui-card-list-content-padded"><img src="<?php echo $vo['local_url']; ?>"/></div>
                <?php endif; ?>
                <div class="aui-card-list-content-padded" style="color:#333;font-size:0.8rem"><?php echo (isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:''); ?></div>
                <?php if($vo['content_source_url']): ?>
                <div class="aui-card-list-footer" style="color:#999;">
                    <div>
                        <a style='color:#0099CC' target='_blank' href='__SELF__'>阅读原文</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php elseif($type == 'video'): ?>
        <section class="aui-chat">
            <div class="aui-chat-header"><span class="time"><?php echo date('H:i'); ?></span></div>
            <div class="aui-chat-item">
                <div class="aui-chat-content"
                     style='background: #fff;border:1px solid #ccc;width:100%;max-width:100%;padding:0'>
                    <section class="aui-content">
                        <div class="aui-card-list" style='margin-bottom:0;background: none'>
                            <div class="aui-card-list-header"
                                 style='padding:0 .3rem 0 .3rem;min-height:1.5rem;white-space:nowrap;overflow: hidden;text-overflow:ellipsis'>
                                <?php echo (isset($title) && ($title !== '')?$title:''); ?>
                            </div>
                            <div style='font-size:.5rem;padding:0 .3rem .3rem .3rem;color:#999'><?php echo date('m月d日'); ?></div>
                            <div class="aui-card-list-content-padded aui-border-b" style='padding:0 .3rem'>
                                <video src="<?php echo (isset($url) && ($url !== '')?$url:''); ?>" width="100%" controls preload></video>
                            </div>
                            <div class="aui-card-list-footer" style='min-height:.8rem;padding:.2rem .3rem'>
                                <div style='font-size:.55rem;white-space:nowrap;overflow: hidden;text-overflow:ellipsis '>
                                    <?php echo (isset($desc) && ($desc !== '')?$desc:''); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>

        <?php elseif($type == 'news'): ?>
        <section class="aui-chat">
            <div class="aui-chat-header"><span class="time"><?php echo date('H:i'); ?></span></div>
            <div class="aui-chat-item">
                <div class="aui-chat-content" style='background: #fff;border:1px solid #ccc;width:100%;max-width:100%;padding:0'>
                    <section class="aui-content">
                        <?php if(!empty($articles)): foreach($articles as $key=>$vo): if(count($articles) > 1): if($key < 1): ?>
                        <div data-href="<?php echo url('wechat/review/index'); ?>?content=<?php echo $vo['id']; ?>&type=article" class="aui-card-list" style="cursor:pointer;margin:0;padding:.5rem .5rem .3rem .5rem;display:block;background:none">
                            <div class="aui-card-list-content" style='width:100%;height:10rem;background-repeat:no-repeat;background-image:url("<?php echo $vo['local_url']; ?>");background-position:center;background-size:cover'></div>
                            <div class="aui-card-list-header" style='left:.5rem;right:.5rem;position:absolute;bottom:0.2rem;display:block;max-height:6em;overflow:hidden;text-overflow:ellipsis;background:rgba(0,0,0,.8);color:#fff'>
                                <?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?>
                            </div>
                        </div>
                        <?php else: ?>
                        <table data-href="<?php echo url('wechat/review/index'); ?>?content=<?php echo $vo['id']; ?>&type=article" class="aui-border-t" style='cursor:pointer;width:100%;padding:0;margin:0;margin:0;padding:.3rem .5rem .5rem .5rem;'>
                            <tr style='width:100%;padding:0;margin:0;'>
                                <td style="text-overflow:ellipsis;overflow:hidden;display:inline-block;"><?php echo $vo['title']; ?></td>
                                <td style='width:3rem;height:3rem;background-repeat:no-repeat;background-image:url("<?php echo $vo['local_url']; ?>");background-position:center;background-size:cover'></td>
                            </tr>
                        </table>
                        <?php endif; else: ?>
                        <div class="aui-card-list" style="margin:0;padding:.5rem .5rem .3rem .5rem;display:block;background:none">
                            <div class="aui-card-list-header" style='padding:0;margin:0;min-height:1.2rem;display:block;overflow:hidden;text-overflow:ellipsis;'>
                                <?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?>
                            </div>
                            <div  style="padding:5px 0;color:#999;min-height:1rem;display:block;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:12px">
                                <?php echo date('m月d日'); ?>
                            </div>
                            <div class="aui-card-list-content" style='width:100%;height:10rem;background-repeat:no-repeat;background-image:url("<?php echo $vo['local_url']; ?>");background-position:center;background-size:cover'></div>
                            <div class="aui-card-list-content-padded" style="color:#7b7b7b;padding:0;display:block;overflow:hidden;text-overflow:ellipsis">
                                <?php echo str_replace(['　',"n"],'',strip_tags($vo['digest'])); ?> ...
                            </div>
                        </div>
                        <div class="aui-card-list-content-padded aui-border-t" style="padding-top:.3rem">
                            <a class="aui-list-item-arrow" style="color:#333;font-size:.6rem;display:block" href="<?php echo url('wechat/review/index'); ?>?content=<?php echo $vo['id']; ?>&type=article">阅读全文</a>
                        </div>
                        <?php endif; endforeach; endif; ?>
                    </section>
                </div>
            </div>
        </section>
        <script>
            $(function () {
                $('[data-href]').on('click', function () {
                    window.location.href = this.getAttribute('data-href');
                });
            });
        </script>
        <?php endif; ?>
    </body>
</html>