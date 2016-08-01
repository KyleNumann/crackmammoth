<div class="ajax-form__wrap">

  <form class="minimal-form ajax-form hide-on-submit">
    <?php if(get_field('mailchimp_list_id')): ?>
      <input type="hidden" class="form-interests" value="<?php echo get_field('mailchimp_list_id'); ?>" name="interests[]">
    <?php endif; ?>
    <?php if(get_field('is_gated_resource') && get_field('document_upload')): ?>
      <input type="hidden" id="download-item" value="<?php echo get_field('document_upload'); ?>" name="download-item">
    <?php endif; ?>
    <div class="row">
      <div class="col-sm-24 fieldset">
        <label for="mce-FNAME">First Name<span class="asterisk">*</span></label>
        <input type="text" value="" name="FNAME" class="" id="FNAME" placeholder="first name*" required>
      </div>
      <div class="col-sm-24 fieldset">
        <label for="mce-LNAME">Last Name<span class="asterisk">*</span></label>
        <input type="text" value="" name="LNAME" class="" id="LNAME" placeholder="last name*" required>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-24 fieldset">
        <label for="mce-EMAIL">Email Address<span class="asterisk">*</span></label>
        <input type="email" value="" name="EMAIL" class="required email" id="EMAIL" placeholder="email address*" required>
      </div>
      <div class="col-sm-24 fieldset">
        <div class="company-field">
          <label for="mce-COMPANY">Company<span class="asterisk">*</span></label>
          <input type="text" value="" name="COMPANY" class="" id="COMPANY" placeholder="company*" required>
        </div>
      </div>
      <div class="col-sm-24 fieldset btn-wrap">
        <input class="btn" type="submit" value="<?php echo get_field('dl_button_text') ? get_field('dl_button_text') : 'Download'; ?>" name="subscribe" id="shape-of-b2b-subscribe">
      </div>
    </div>
  </form>
  <p class="hide-on-submit text-small">* indicates required field</p>


  <div class="ajax-form__processing">
    <h3>We are processing your request</h3>
    <div class="processing-animation">
      <div class="circle-node circle-node--yellow">
        <div class="circle-lg"></div>
        <div class="circle-md"></div>
        <div class="circle-sm"></div>
      </div>
      <div class="circle-node circle-node--green">
        <div class="circle-lg"></div>
        <div class="circle-md"></div>
        <div class="circle-sm"></div>
      </div>
      <div class="circle-node circle-node--blue">
        <div class="circle-lg"></div>
        <div class="circle-md"></div>
        <div class="circle-sm"></div>
      </div>
    </div>
  </div>

  <div class="ajax-form__complete">
    <h2 class="complete--success emphasis text-green">Nice! We’re delighted to help you with your B2B marketing strategy. Check your inbox shortly for your  first email.</h2>
    <h2 class="complete--error emphasis text-red">Something went wrong, please try again.</h2>
  </div>

</div>
