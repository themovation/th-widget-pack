<div class="th-faq">
    <dl class="th-faq-list">

		<?php foreach( $instance['faqs'] as $faq ) { ?>

			<dt class="th-faq-dt"><?php echo $faq['title']; ?></dt>
			<dd class="th-faq-dd"><?php echo $faq['content']; ?></dd>

		<?php } ?>

    </dl>
</div>
