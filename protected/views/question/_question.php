<?php

?>

<div class="faq-item">
    <div class="faq-question"><?php echo TbHtml::icon(TbHtml::ICON_QUESTION_SIGN) . ' ' . $question->question?></div>
    <div class="faq-answer"><?=$question->answer?></div>
</div>