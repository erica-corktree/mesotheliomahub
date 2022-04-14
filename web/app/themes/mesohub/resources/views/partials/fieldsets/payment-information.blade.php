<fieldset class="fieldset{{ $class ? " {$class}" : '' }}" id="PaymentInformation">
  <legend class="legend">
    <span class="mr-4">{{ __('Payment Information', 'sage') }}</span>
    <span class="mr-2 text-grey-darker fa fa-cc-discover"></span>
    <span class="mr-2 text-grey-darker fa fa-cc-amex"></span>
    <span class="mr-2 text-grey-darker fa fa-cc-mastercard"></span>
    <span class="text-grey-darker fa fa-cc-visa"></span>
  </legend>

  <div class="fieldset__inner">
    <div class="w-full md:w-3/4 md:pr-1">
      <x-field
        label="{{ __('Card Number', 'sage') }}"
        name="cardNumber"
        type="tel"
        maxlength="19"
        autocomplete="off"
        required
      />
    </div>

    <div class="w-full md:w-1/4 md:pl-1">
      <x-field
        label="{{ __('Card Type', 'sage') }}"
        name="cardType"
        type="select"
        required
      >
        <option value="type" disabled selected>{{ __('Type', 'sage') }}</option>
        <option>{{ __('Visa', 'sage') }}</option>
        <option>{{ __('Master', 'sage') }}</option>
        <option>{{ __('Discover', 'sage') }}</option>
        <option>{{ __('American Express', 'sage') }}</option>
      </x-field>
    </div>

    <div class="w-full md:w-1/3 md:pr-1">
      <x-field
        label="{{ __('Expiration Month', 'sage') }}"
        name="cardExpirationMonth"
        type="select"
        required
      >
        <option value="month">{{ __('Month', 'sage') }}</option>
        <option>{{ __('01', 'sage') }}</option>
        <option>{{ __('02', 'sage') }}</option>
        <option>{{ __('03', 'sage') }}</option>
        <option>{{ __('04', 'sage') }}</option>
        <option>{{ __('05', 'sage') }}</option>
        <option>{{ __('06', 'sage') }}</option>
        <option>{{ __('07', 'sage') }}</option>
        <option>{{ __('08', 'sage') }}</option>
        <option>{{ __('09', 'sage') }}</option>
        <option>{{ __('10', 'sage') }}</option>
        <option>{{ __('11', 'sage') }}</option>
        <option>{{ __('12', 'sage') }}</option>
      </x-field>
    </div>

    <div class="w-full md:w-1/3 md:pl-1 md:pr-1">
      <x-field
        label="{{ __('Expiration Year', 'sage') }}"
        name="cardExpirationYear"
        type="select"
        required
      >
        <option value="year">{{ __('Year', 'sage') }}</option>
        <option>{{ __('2020', 'sage') }}</option>
        <option>{{ __('2021', 'sage') }}</option>
        <option>{{ __('2022', 'sage') }}</option>
        <option>{{ __('2023', 'sage') }}</option>
        <option>{{ __('2024', 'sage') }}</option>
        <option>{{ __('2025', 'sage') }}</option>
        <option>{{ __('2026', 'sage') }}</option>
        <option>{{ __('2027', 'sage') }}</option>
        <option>{{ __('2028', 'sage') }}</option>
        <option>{{ __('2029', 'sage') }}</option>
        <option>{{ __('2030', 'sage') }}</option>
        <option>{{ __('2031', 'sage') }}</option>
        <option>{{ __('2032', 'sage') }}</option>
        <option>{{ __('2033', 'sage') }}</option>
        <option>{{ __('2034', 'sage') }}</option>
      </x-field>
    </div>

    <div class="w-full md:w-1/3 md:pl-1">
      <x-field
        label="{{ __('Security Code', 'sage') }}"
        name="cardVerificationCode"
        type="tel"
        autocomplete="off"
        required
      />
    </div>
  </div>
</fieldset>
