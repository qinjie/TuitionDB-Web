<ul>
    <li><?php echo CHtml::link('Update Center Info', array('post/create')); ?></li>
    <li><?php echo CHtml::link('Add Photo', array('post/admin')); ?></li>
    <li><?php echo CHtml::link('Approve Comments', array('comment/index')) . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
    <li><?php echo CHtml::link('Logout', array('site/logout')); ?></li>
</ul>