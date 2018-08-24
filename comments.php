<?php 
$default_avatar = 'https://secure.gravatar.com/avatar/8bcf51832d41c30f9e939e3f38bc08ce?s=32&d=mm&r=g';
?>
<a id="comments"></a>
<h2>Comments</h2>
<?php if($comments) : ?>  
	<ol class="comments">  
		<?php foreach($comments as $comment) : ?>  
			<li id="comment-<?php comment_ID(); ?>" class="<?php if ($comment->user_id == 1) echo "authcomment";?>">  
				<?php if ($comment->comment_approved == '0') : ?>  
					<p>Your comment is awaiting approval</p>  
				<?php endif; ?>  
				<?php echo get_avatar(get_comment_author_email(), 48, $default_avatar); ?>
				<cite><h3><?php comment_author_link(); ?></h3> on <small><?php comment_date(); ?></small></cite><br />
				<?php comment_text(); ?>  
			</li>  
		<?php endforeach; ?>  
	</ol>  
<?php endif; ?> 

<?php if(comments_open()) : ?>
	<h2>Add Your Comment</h2>
	<?php if(get_option('comment_registration') && !$user_ID) : ?>  
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>  
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">  
			<?php if($user_ID) : ?>  
				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>  
				<?php else : ?>  
					<div class="row comments-input">
						<div class="col-md-6"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" placeholder="Name <?php if($req) echo "(*)"; ?>" size="22" tabindex="1" /> </div>  
						<div class="col-md-6"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" placeholder="Email <?php if($req) echo "(*)"; ?>" size="22" tabindex="2" /></div> 
					</div>
				<?php endif; ?>  
				<p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>  
				<?php //show_subscription_checkbox(); ?>
				<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />  
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>  
					<?php do_action('comment_form', $post->ID); ?>  
				</form>  
			<?php endif; ?>  
			<?php else : ?>  
				<p>The comments are closed.</p>  
				<?php endif; ?>