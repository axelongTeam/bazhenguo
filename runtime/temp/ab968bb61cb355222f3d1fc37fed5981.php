<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"E:\weixin\web/application/wechat\view\fans.back.html";i:1497932035;s:55:"E:\weixin\web/application/extra\view\admin.content.html";i:1497932035;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title">
        <h5><?php echo $title; ?></h5>
        

<div class="nowrap pull-right" style="margin-top:10px">
    <button data-load="<?php echo url('sync'); ?>" class='layui-btn layui-btn-small'>同步粉丝</button>
</div>

<div class="nowrap pull-right" style="margin-top:10px;margin-right:10px">
    <button data-update="" data-action="<?php echo url('backdel'); ?>" class='layui-btn layui-btn-small'>移出黑名单</button>
</div>


    </div>
    <?php endif; ?>
    <div class="ibox-content fadeInUp animated">
        <?php if(isset($alert)): ?>
        <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible" role="alert" style="border-radius:0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php if(isset($alert['title'])): ?><p style="font-size:18px;padding-bottom:10px"><?php echo $alert['title']; ?></p><?php endif; if(isset($alert['content'])): ?><p style="font-size:14px"><?php echo $alert['content']; ?></p><?php endif; ?>
        </div>
        <?php endif; ?>
        

<!-- 表单搜索 开始 -->
<form class="animated form-search" action="__SELF__" onsubmit="return false" method="get">

    <div class="row">

        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="nickname" value="<?php echo (\think\Request::instance()->get('nickname') ?: ''); ?>" placeholder="昵称" class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <select name="sex" class="input-sm form-control">
                    <option value="">- 性别 -</option>
                    <!--<?php if(\think\Request::instance()->get('sex') == 1): ?>-->
                    <option selected value="1">- 男 -</option>
                    <!--<?php else: ?>-->
                    <option value="1">- 男 -</option>
                    <!--<?php endif; ?>-->
                    <!--<?php if(\think\Request::instance()->get('sex') == 2): ?>-->
                    <option selected value="2">- 女 -</option>
                    <!--<?php else: ?>-->
                    <option value="2">- 女 -</option>
                    <!--<?php endif; ?>-->
                </select>
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <select name="tag" class="input-sm form-control">
                    <option value="">- 粉丝标签 -</option>
                    <!--<?php foreach($tags as $key=>$tag): ?>-->
                    <!--<?php if(\think\Request::instance()->get('tag') == $key): ?>-->
                    <option selected value="<?php echo $key; ?>"><?php echo $tag; ?></option>
                    <!--<?php else: ?>-->
                    <option value="<?php echo $key; ?>"><?php echo $tag; ?></option>
                    <!--<?php endif; ?>-->
                    <!--<?php endforeach; ?>-->
                </select>
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="country" value="<?php echo (\think\Request::instance()->get('country') ?: ''); ?>" placeholder="国家" class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="province" value="<?php echo (\think\Request::instance()->get('province') ?: ''); ?>" placeholder="省份" class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="city" value="<?php echo (\think\Request::instance()->get('city') ?: ''); ?>" placeholder="城市" class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-1">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-white"><i class="fa fa-search"></i> 搜索</button>
            </div>
        </div>

    </div>
</form>
<!-- 表单搜索 结束 -->

<form onsubmit="return false;" data-auto="" method="POST">
    <input type="hidden" value="resort" name="action"/>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class='list-table-check-td'>
                    <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
                </th>
                <th class='text-left'>用户昵称</th>
                <th class='text-left'>性别</th>
                <th class='text-center'>标签</th>
                <th class='text-left'>区域</th>
                <th class='text-center'>关注时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $key=>$vo): ?>
            <tr>
                <td class='list-table-check-td'>
                    <input class="list-check-box" value='<?php echo $vo['id']; ?>' type='checkbox'/>
                </td>
                <td class='text-left'>
                    <img style="width:25px;height:25px;border-radius:50%;margin-right:10px" data-tips-image src="<?php echo $vo['headimgurl']; ?>"/>
                    <?php echo (isset($vo['nickname']) && ($vo['nickname'] !== '')?$vo['nickname']:"<span style='color:#999'>未设置微信昵称</span>"); ?>
                </td>
                <td class='text-left'><?php echo !empty($vo['sex']) && $vo['sex']==1?'男':($vo['sex']==2?'女':'未知'); ?></td>
                <td>
                    <span>
                        <a data-add-tag='<?php echo $vo['id']; ?>' data-used-id='<?php echo join(",",array_keys($vo['tags_list'])); ?>' id="tag-fans-<?php echo $vo['id']; ?>" href='javascript:void(0)'
                           style='font-size:12px;font-weight:400;border-radius:50%;background:#9f9f9f' class='label label-default'>+</a>
                    </span>

                    <?php if(empty($vo['tags_list'])): ?>
                    <span style='color:#999'>尚未设置标签</span>
                    <?php else: foreach($vo['tags_list'] as $k=>$tag): ?>
                    <span>
                        <a href='javascript:void(0)' style='font-size:12px;font-weight:400;background:#9f9f9f' class='label label-default'><?php echo $tag; ?></a>
                    </span>
                    <?php endforeach; endif; ?>

                </td>
                <td class='text-left'><?php echo (isset($vo['country']) && ($vo['country'] !== '')?$vo['country']:'<span style="color:#999">未设置区域信息</span>'); ?><?php echo $vo['province']; ?><?php echo $vo['city']; ?></td>
                <td class='text-center'><?php echo $vo['subscribe_at']; ?></td>
            </tr>
            <?php endforeach; if(empty($list)): ?>
            <tr><td colspan="5" style="text-align:center">没 有 记 录 了 哦 !</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; ?>
</form>

<div id="tags-box" class="hide">
    <form>
        <div class="row">
            <?php foreach($tags as $key=>$tag): ?>
            <div class="col-xs-6">
                <label><input value="<?php echo $key; ?>" type="checkbox" /> <?php echo $tag; ?></label>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <div class="hr-line-dashed"></div>
            <button type="button" data-event="confirm" class="layui-btn layui-btn-small">保存数据</button>
            <button type="button" data-event="cancel" class="layui-btn layui-btn-danger layui-btn-small" type='button'>取消编辑</button>
        </div>
    </form>
</div>

    </div>
    
<?php if(auth("$classuri/tagset")): ?>
<script>
    // 添加标签
    $('body').find('[data-add-tag]').map(function () {
        var self = this;
        var fans_id = this.getAttribute('data-add-tag');
        var used_ids = (this.getAttribute('data-used-id') || '').split(',');
        var $content = $(document.getElementById('tags-box').innerHTML);
        for (var i in used_ids) {
            $content.find('[value="' + used_ids[i] + '"]').attr('checked', 'checked');
        }
        $content.attr('fans_id', fans_id);
        // 标签面板关闭
        $content.on('click', '[data-event="cancel"]', function () {
            $(self).popover('hide');
        });
        // 标签面板确定
        $content.on('click', '[data-event="confirm"]', function () {
            var tags = [];
            $content.find('input:checked').map(function () {
                tags.push(this.value);
            });
            $.form.load('<?php echo url("tagset"); ?>', {fans_id: $content.attr('fans_id'), 'tags': tags.join(',')}, 'post');
        });
        // 限制每个表单最多只能选择三个
        $content.on('click', 'input', function () {
            ($content.find('input:checked').size() > 3) && (this.checked = false);
        });
        // 标签选择面板
        $(this).data('content', $content).on('shown.bs.popover', function () {
            $('[data-add-tag]').not(this).popover('hide');
        }).popover({
            html: true,
            trigger: 'click',
            content: $content,
            title: '标签编辑（最多选择三个标签）',
            template: '<div class="popover" style="max-width:500px" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content" style="width:500px"></div></div>'
        });
    });
</script>
<?php endif; ?>

</div>