<fieldset
  class="fieldset{{ $class ? " {$class}" : '' }}"
  id="ShippingAddress"
>
  <legend class="legend">{{ __('Shipping Address', 'sage') }}</legend>

  <div class="fieldset__inner">
    <div class="w-full md:w-1/2 md:pr-1">
      <x-field
        label="{{ __('First Name', 'sage') }}"
        name="shippingFirstName"
        type="text"
        autocomplete="shipping given-name"
        required
        x-ref="shippingFirstName"
      />
    </div>

    <div class="w-full md:w-1/2 md:pl-1">
      <x-field
        label="{{ __('Last Name', 'sage') }}"
        name="shippingLastName"
        type="text"
        autocomplete="shipping family-name"
        required
        x-ref="shippingLastName"
      />
    </div>

    <div class="w-full md:w-1/2 md:pr-1">
      <x-field
        label="{{ __('Address', 'sage') }}"
        name="shippingAddress1"
        type="text"
        autocomplete="shipping address-line1"
        required
        x-ref="shippingAddress1"
      />
    </div>

    <div class="w-full md:w-1/2 md:pl-1">
      <x-field
        label="{{ __('Address 2', 'sage') }}"
        name="shippingAddress2"
        type="text"
        autocomplete="shipping address-line2"
        x-ref="shippingAddress2"
      />
    </div>

    <div class="w-full md:w-full">
      <x-field
        label="{{ __('Company (optional)', 'sage') }}"
        name="shippingCompany"
        type="text"
        autocomplete="shipping organization"
        x-ref="shippingCompany"
      />
    </div>

    <div class="w-full md:w-1/3 md:pr-1">
      <x-field
        label="{{ __('City', 'sage') }}"
        name="shippingCity"
        type="text"
        autocomplete="shipping address-level2"
        required
        x-ref="shippingCity"
      />
    </div>

    <div class="w-full md:w-1/3 md:pl-1 md:pr-1">
      <x-field
        label="{{ __('State', 'sage') }}"
        name="shippingState"
        type="text"
        autocomplete="shipping address-level1"
        required
        x-ref="shippingState"
      />
    </div>

    <div class="w-full md:w-1/3 md:pl-1">
      <x-field
        label="{{ __('ZIP or Postal code', 'sage') }}"
        name="shippingPostal"
        type="text"
        autocomplete="shipping postal-code"
        required
        x-ref="shippingPostal"
      />
    </div>

    <div class="w-full md:w-1/2 md:pr-1">
      <x-field
        label="{{ __('Country', 'sage') }}" class="select--country"
        name="shippingCountry"
        type="select"
        autocomplete="shipping country"
        required
        x-ref="shippingCountry"
      >
        @include('partials.select-country')
      </x-field>
    </div>

    <div class="w-full md:w-1/2 md:pl-1">
      <x-field
        label="{{ __('Phone', 'sage') }}"
        name="shippingPhone"
        type="tel"
        autocomplete="shipping tel"
        required
        x-ref="shippingPhone"
      />
    </div>

    <div class="w-full md:w-full">
      <x-field
        label="{{ __('Shipping address is the same as billing', 'sage') }}"
        type="checkbox"
        x-on:click="
          $refs.shippingFirstName.value = $refs.billingFirstName.value;
          $refs.shippingLastName.value  = $refs.billingLastName.value;
          $refs.shippingAddress1.value  = $refs.billingAddress1.value;
          $refs.shippingAddress2.value  = $refs.billingAddress2.value;
          $refs.shippingCompany.value   = $refs.billingCompany.value;
          $refs.shippingCity.value      = $refs.billingCity.value;
          $refs.shippingState.value     = $refs.billingState.value;
          $refs.shippingPostal.value    = $refs.billingPostal.value;
          $refs.shippingCountry.value   = $refs.billingCountry.value;
          $refs.shippingPhone.value     = $refs.billingPhone.value;
        "
      />
    </div>
  </div>
</fieldset>
