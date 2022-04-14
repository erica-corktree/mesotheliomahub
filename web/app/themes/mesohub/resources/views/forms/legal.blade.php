<x-html-forms :form="$form" class="float-right w-full p-8 pr-24 mx-auto mb-8 ml-8 overflow-hidden text-black border rounded shadow-lg form form--register md:w-1/2 bg-grey-lighter" style="margin-top: -24rem;">
  <input type="hidden" name="formType" value="GuideForm">

  <fieldset class="Form__fieldset">
    <legend class="Form__legend">Where should we send the guide overnight?</legend>

    <label class="Form__label">
      <span class="Form__label__text">Address</span>
      <input class="Form__input" name="address" type="text" required>
    </label>

    <div class="Form__input-row Form__input-row--3">
      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">City</span>
        <input class="Form__input" name="city" type="text" required>
      </label>

      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">State</span>
        <input class="Form__input" name="state" type="text" required>
      </label>

      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">ZIP</span>
        <input class="Form__input" name="zip" type="text" required>
      </label>
    </div>
  </fieldset>

  <fieldset class="Form__fieldset">
    <legend class="Form__legend">Who is the recipient?</legend>

    <div class="Form__input-row Form__input-row--2">
      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">First Name</span>
        <input class="Form__input" name="first_name" type="text" required>
      </label>

      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">Last Name</span>
        <input class="Form__input" name="last_name" type="text" required>
      </label>
    </div>

    <div class="Form__input-row Form__input-row--2">
      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">Phone Number</span>
        <input class="Form__input" name="phone_number" type="text" required>
      </label>

      <label class="Form__input-row__col Form__label">
        <span class="Form__label__text">Email</span>
        <input class="Form__input" name="email" type="text" required>
      </label>
    </div>

    <label class="Form__label">
      <span class="Form__label__text">Have you or your family members ever been diagnosed with the following?</span>
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

    <label class="Form__label">
      <span class="Form__label__text">Questions or comments?</span>
      <textarea class="Form__input" name="comment"></textarea>
    </label>
  </fieldset>

  <button class="Button Button--primary" type="submit">{{ __('Get the Guide', 'sage') }}</button>

  @if (get_field('site_guide_form', 'option')['disclaimer'])
    <p class="LandingPageForm__disclaimer">{!! get_field('site_guide_form', 'option')['disclaimer'] !!}</p>
  @endif
</x-html-forms>
