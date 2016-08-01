<!--
	template name: contact
-->

<?php get_header(); ?>

<!-- <main role="main"> -->
<!-- section -->
<section class="bg-blue-purple">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="container vpadding-md ">

		<div class="row">
			<div class="col-sm-3">
				<div class="phone-illustration gs-svg svg-draw">
					<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_contact.svg'); ?>
					<div class="gs-svg node-line">
						<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-left-up.svg'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="h1"><?php the_title(); ?></div>
				<?php if(get_field('page_intro')): ?>
					<div class="wysiwyg vpadding-sm">
						<?php echo get_field('page_intro'); ?>
					</div>
				<?php endif; ?>
				<?php if(get_field('phone')): ?>
					<div class="phone emphasis mb4">
						<?php echo get_field('phone'); ?>
						<div class="gs-svg"> 
							<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-phone.svg'); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="address">
					<?php if(get_field('address_1')): ?>
						<div class="emphasis mb0">
							<?php echo get_field('address_1'); ?>
						</div>
					<?php endif; ?>
					<?php if(get_field('address_2')): ?>
						<div class="emphasis mb4">
							<?php echo get_field('address_2'); ?>
						</div>
					<?php endif; ?>
					<div class="gs-svg">
						<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-location.svg'); ?>
					</div>
				</div>

			</div>
			<div class="col-sm-11 col-md-8 col-md-offset-1">


				<div class="form-wrap vpadding-sm">

				  <form class="animated-form">
			      <div class="fieldset">
			        <label for="FNAME">What is your first name?<span class="asterisk">*</span></label>
			        <input type="text" value="" name="FNAME" class="form-control" id="FNAME" placeholder="first name*" required>
							<div class="gs-svg node-line">
								<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-right.svg'); ?>
							</div>
			      </div>
			      <div class="fieldset">
			        <label for="LNAME">What is your last name?<span class="asterisk">*</span></label>
			        <input type="text" value="" name="LNAME" class="form-control" id="LNAME" placeholder="last name*" required>
			      </div>
			      <div class="fieldset">
			        <label for="EMAIL">How can we email you?<span class="asterisk">*</span></label>
			        <input type="email" value="" name="EMAIL" class="form-control" id="EMAIL" placeholder="email address*" required>
			      </div>
						<div class="fieldset">
			        <label for="PHONE">How can we call you?</label>
			        <input type="text" value="" name="PHONE" class="form-control" id="PHONE" placeholder="phone number">
			      </div>
			      <div class="fieldset">
		          <label for="COMPANY">What company do you represent?<span class="asterisk">*</span></label>
		          <input type="text" value="" name="COMPANY" class="form-control" id="COMPANY" placeholder="company*" required>
			      </div>
						<div class="fieldset">
		          <label for="MESSAGE">What’s on your mind?<span class="asterisk">*</span></label>
		          <textarea value="" name="MESSAGE" class="form-control" id="MESSAGE" placeholder="message*" required></textarea>
			      </div>
			      <div class="fieldset btn-wrap text-center">
							<div class="row">
								<div class="col-sm-22 vpadding-xs">
			        		<input class="btn" type="submit" value="Send Your Message" name="send">
								</div>
							</div>
			      </div>
				  </form>
				  <p class="hide-on-submit text-small">* indicates required field</p>

				</div>



			</div>
		</div>

	</div><!-- .container -->

	<?php endwhile; endif; ?>

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
