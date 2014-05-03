<div class="item">
    <ul class="person_nav">
        <li><a href="/settings"><i class="icon-cog"></i> 帐号设置</a></li>
        <li><a href="<?php echo user_space($user['uid'], 'articles');?>"><i class="icon-list"></i> 我的文字</a></li>
        <li><a href="<?php echo user_space($user['uid'], 'questions');?>"><i class="icon-question-sign"></i> 我的问答</a></li>
        <li><a href="<?php echo user_space($user['uid'], 'music');?>"><i class="icon-music"></i> 我的音乐</a></li>
        <li><a href="<?php echo user_space($user['uid'], 'like');?>"><i class="icon-heart"></i> 我喜欢的</a></li>

        <li><a href="/message"><i class="icon-envelope"></i> 我的消息</a></li>
    </ul>
</div>