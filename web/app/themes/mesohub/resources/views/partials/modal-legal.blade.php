<div class="Modal Modal--tiny Modal--request-form Modal--legal reveal" id="ModalLegal" data-reveal>
  <div class="Modal__content">
    @include('partials.svgs.modal-logo')

    <h5 class="Modal__heading">{{ __('Get Your Free Case Evaluation.', 'sage') }}</h5>

    <form class="Form Form--modal" action="{{ get_template_directory_uri() }}/forms/mail.php" method="post" data-type="modal-legal">
      <input type="hidden" name="formType" value="ModalLegalForm">

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

      <button class="Button Button--primary" type="submit">{{ __('Get my Free Case Evaluation', 'sage') }}</button>
    </form>
  </div>

  <button class="Modal__close-button" data-close aria-label="Close modal" type="button">
    <span class="Icon Icon--close" aria-hidden="true"></span>
  </button>
</div>
