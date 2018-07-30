
<div class="email_field close_email">

    <div id="close_email" class="email_toggle">x</div>

</div>
<div class="email_field">

    <p><?php echo $lang->naslov_poruke; ?></p>
    <input type="text" id="subject">

</div>

<div class="email_field">

  <p><?php echo $lang->vase_ime; ?></p>
  <input type="text" id="your_name">

</div>


<div class="email_field">

  <p><?php echo $lang->vas_email; ?></p>
  <input type="email" id="your_email" value="">

</div>

<div class="email_field">
   <p><?php echo $lang->poruka; ?></p>
   <textarea id="your_message"><?php echo $lang->default_poruka; ?></textarea>

</div>

<div class="email_field">

   <div class="send_the_email"><?php echo $lang->posaljite; ?></div>

</div>
<div class="email_field">

   <div class="email_status"></div>

</div>
