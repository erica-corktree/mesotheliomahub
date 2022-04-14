<fieldset
  class="fieldset{{ $class ? " {$class}" : '' }}"
  id="BillingAddress"
>
  <legend class="legend">{{ __('Billing Address', 'sage') }}</legend>

  <div class="fieldset__inner">
    <div class="w-full md:w-1/2 md:pr-1">
      <x-field
        label="{{ __('First Name', 'sage') }}"
        name="billingFirstName"
        type="text"
        autocomplete="billing given-name"
        required
        x-ref="billingFirstName"
      />
    </div>

    <div class="w-full md:w-1/2 md:pl-1">
      <x-field
        label="{{ __('Last Name', 'sage') }}"
        name="billingLastName"
        type="text"
        autocomplete="billing family-name"
        required
        x-ref="billingLastName"
      />
    </div>

    <div class="w-full md:w-1/2 md:pr-1">
      <x-field
        label="{{ __('Address', 'sage') }}"
        name="billingAddress1"
        type="text"
        autocomplete="billing address-line1"
        required
        x-ref="billingAddress1"
      />
    </div>

    <div class="w-full md:w-1/2 md:pl-1">
      <x-field
        label="{{ __('Address 2', 'sage') }}"
        name="billingAddress2"
        type="text"
        autocomplete="billing address-line2"
        x-ref="billingAddress2"
      />
    </div>

    <div class="w-full md:w-full">
      <x-field
        label="{{ __('Company (optional)', 'sage') }}"
        name="billingCompany"
        type="text"
        autocomplete="billing organization"
        x-ref="billingCompany"
      />
    </div>

    <div class="w-full md:w-1/3 md:pr-1">
      <x-field
        label="{{ __('City', 'sage') }}"
        name="billingCity"
        type="text"
        autocomplete="billing address-level2"
        required
        x-ref="billingCity"
      />
    </div>

    <div class="w-full md:w-1/3 md:pl-1 md:pr-1">
      <x-field
        label="{{ __('State', 'sage') }}"
        name="billingState"
        type="text"
        autocomplete="billing address-level1"
        required
        x-ref="billingState"
      />
    </div>

    <div class="w-full md:w-1/3 md:pl-1">
      <x-field
        label="{{ __('ZIP or Postal code', 'sage') }}"
        name="billingPostal"
        type="text"
        autocomplete="billing postal-code"
        required
        x-ref="billingPostal"
      />
    </div>

    <div class="w-full md:w-1/2 md:pr-1">
      <x-field
        label="{{ __('Country', 'sage') }}"
        class="select--country"
        name="billingCountry"
        type="select"
        autocomplete="billing country"
        required
        x-ref="billingCountry"
      >
        @include('partials.select-country')
      </x-field>
    </div>

    <div class="w-full md:w-1/2 md:pl-1">
      <x-field
        label="{{ __('Phone', 'sage') }}"
        name="billingPhone"
        type="tel"
        autocomplete="billing tel"
        required
        x-ref="billingPhone"
      />
    </div>

    <div class="w-full md:w-full">
      <x-field
        label="{{ __('Email Address', 'sage') }}"
        name="billingEmail"
        type="email"
        autocomplete="billing email"
        required
        x-ref="billingEmail"
      />
    </div>
  </div>
</fieldset>
