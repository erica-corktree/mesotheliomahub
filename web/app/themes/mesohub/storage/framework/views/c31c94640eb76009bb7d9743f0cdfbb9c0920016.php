<div class="Modal Modal--tiny Modal--request-form Modal--guide reveal" id="ModalGuide" data-reveal>
  <div class="Modal__content">
    <?php echo $__env->make('partials.svgs.modal-logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <h5 class="Modal__heading"><?php echo e(__('Let Us Know Where to Send Your Free Guide.', 'sage')); ?></h5>

    <form class="Form Form--modal" action="<?php echo e(get_template_directory_uri()); ?>/forms/mail.php" method="post" data-type="modal-guide">
      <input type="hidden" name="formType" value="ModalGuideForm">

      <label class="Form__label">
        <span class="Form__label__text">First Name</span>
        <input class="Form__input" name="first_name" type="text" required>
      </label>

      <label class="Form__label">
        <span class="Form__label__text">Last Name</span>
        <input class="Form__input" name="last_name" type="text" required>
      </label>

      <label class="Form__label">
        <span class="Form__label__text">Phone Number</span>
        <input class="Form__input" name="phone_number" type="text" required>
      </label>

      <label class="Form__label">
        <span class="Form__label__text">Email</span>
        <input class="Form__input" name="email" type="text" required>
      </label>

      <label class="Form__label">
        <span class="Form__label__text">Diagnosis</span>
        <span class="Form__select-wrap">
          <select class="Form__input" name="diagnosis" required>
            <option value="">Select diagnosis</option>
            <option value="Mesothelioma">Mesothelioma</option>
            <option value="Lung Cancer">Lung Cancer</option>
            <option value="Asbestosis">Asbestosis</option>
            <option value="Undiagnosed">Undiagnosed</option>
            <option value="Other">Other</option>
          </select>
        </span>
      </label>

      <button class="Button Button--primary" type="submit"><?php echo e(__('Request my Free Guide', 'sage')); ?></button>
    </form>
  </div>

  <button class="Modal__close-button" data-close aria-label="Close modal" type="button">
    <span class="Icon Icon--close" aria-hidden="true"></span>
  </button>
</div>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/modal-guide.blade.php ENDPATH**/ ?>