<?php 
$rating = get_option('themolitor_rating','no');

if( $rating == 'g' ){ ?>
<div id="rating" class="g-rating">
	<div id="rating-letter"><?php _e('G','themolitor');?></div>
	<div id="rating-title"><?php _e('General Audiences','themolitor');?></div>
	<div id="rating-info"><?php _e('All Ages Admitted','themolitor');?></div>
</div>
<?php } elseif( $rating == 'pg' ){ ?>
<div id="rating" class="pg-rating">
	<div id="rating-letter"><?php _e('PG','themolitor');?></div>
	<div id="rating-title"><?php _e('Parental Guidance Suggested','themolitor');?></div>
	<div id="rating-info"><?php _e('Some material may not be suitable for children','themolitor');?></div>
</div>
<?php } elseif( $rating == 'pg13' ){ ?>
<div id="rating" class="pg13-rating">
	<div id="rating-letter"><?php _e('PG-13','themolitor');?></div>
	<div id="rating-title"><?php _e('Parents Strongly Cautioned','themolitor');?></div>
	<div id="rating-info"><?php _e('Some material may be inappropriate for children under 13','themolitor');?></div>
</div>
<?php } elseif( $rating == 'r' ){ ?>
<div id="rating" class="r-rating">
	<div id="rating-letter"><?php _e('R','themolitor');?></div>
	<div id="rating-title"><?php _e('Restricted','themolitor');?></div>
	<div id="rating-info"><?php _e('Under 17 requires accompanying parent or adult guardian','themolitor');?></div>
</div>
<?php } elseif( $rating == 'nc17' ){ ?>
<div id="rating" class="nc17-rating">
	<div id="rating-letter"><?php _e('NC-17','themolitor');?></div>
	<div id="rating-info"><?php _e('No One 17 and Under Admitted','themolitor');?></div>
</div>
<?php } elseif( $rating == 'no' ){ ?>
<div id="rating" class="no-rating">
	<div id="rating-info"><?php _e('This Film is Not Yet Rated','themolitor');?></div>
</div>
<?php } ?>