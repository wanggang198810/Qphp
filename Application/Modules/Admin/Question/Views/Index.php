<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>问答标签 - <?php echo APP_NAME;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
    ?>
<style>
    tr .id{ width: 50px;}
    tr .title{ width: 250px;}
    tr .time{ width: 100px;}
</style>
</head>
<body>

<table>
    <tr>
        <td class="id">ID</td>
        <td class="title">标题</td>
        <td class="id">uid</td>
        <td class="time">发布时间</td>
        <td class="id">状态</td>
        <td class="time">操作</td>
    </tr>

    <?php
        if(!empty($topics)){
            foreach($topics as $k => $v){
    ?>
        <tr>
            <td><?php echo $v['id'];?></td>
            <td><?php echo $v['title'];?></td>
            <td><?php echo $v['uid'];?></td>
            <td><?php echo $v['time'];?></td>
            <td><?php echo $v['status'];?></td>
            <td>
                <a href="/admin/question/edit/<?php echo $v['id'];?>" target="_self">编辑</a>
                <a href="/admin/question/delete/<?php echo $v['id'];?>">删除</a>
            </td>
        </tr>
    <?php
            }
        }
    ?>

</table>
    
    
</body>
</html>
