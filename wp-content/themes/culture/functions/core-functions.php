<?php
#-----------------------------------------------------------------#
#----------- CULTURE : CORE FUNCTIONS AND DEFINITIONS ------------#
#-----------------------------------------------------------------#

#-----------------------------------------------------------------#
# DISPLAY AN OPTIONAL POST THUMBNAIL
#-----------------------------------------------------------------#

function culture_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() ) :
	?>
	<div class="post-thumbnail">
	<?php
		the_post_thumbnail('full');
	?>
	</div>
	<?php else : ?>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		the_post_thumbnail('full');
	?>
	</a>

	<?php endif; // End is_singular()
}

#-----------------------------------------------------------------#
# POST FOOTER SECTION
#-----------------------------------------------------------------#

function culture_entry_footer() 
{
	if ( post_password_required()) {
		return;
	}
	
	if ( is_singular() ) :

	// pagination
	the_post_navigation( array(
		'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'culture' ) . '</span><span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-left" aria-hidden="true"></i></span>%title</span>',
		'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'culture' ) . '</span><span class="nav-title">%title<span class="nav-title-icon-wrapper">&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></span></span>',
	) );
	
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

	<?php else : ?>
		<div class="post-read-more"><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading','culture');?></a></div>
	<?php endif; // End is_singular()
}

#-----------------------------------------------------------------#
# FUNTION TO FETCH CUSTOM FIELD IMAGE ID FROM THE FILE URL
#-----------------------------------------------------------------#
function culture_attachment_id($image_url) 
{
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
	
	if(!empty($attachment)){
		 return $attachment[0]; 
	}else{
		 return ''; 
	}
}

#-----------------------------------------------------------------#
# THEME CHECK FIX
#-----------------------------------------------------------------#
if ( ! isset( $content_width ) ) $content_width = 1170;

#-----------------------------------------------------------------#
# FUNCTION FOR GET AUTHOR IMAGE
#-----------------------------------------------------------------#
function culture_get_author_avatar($authorid)
{
	$authorID     = get_the_author_meta('ID',$authorid);
	$authImageSrc = get_avatar_url( 'get_culture_up_meta', $authorID );
	
	if(isset($authImageSrc) && $authImageSrc !="") 
	{
		// Get the image URL using the author ID and image size params
		$imgURL = get_avatar_url($authorID, 190);
		?><img src ="<?php echo $imgURL ; ?>"><?php
	}
}