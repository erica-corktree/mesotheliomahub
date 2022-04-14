<fieldset
  class="fieldset{{ $class ? " {$class}" : '' }}"
  id="Shipping"
>
  <legend class="legend md:pt-1">{{ __('Shipping', 'sage') }}</legend>

  <div class="fieldset__inner">
    <div class="w-full mb-2">
      <label class="label label--radio">
        <input
          class="input--radio"
          name="shippingRate"
          type="radio"
          value="9.97"
          x-model.number="shippingRate"
          x-on:click="shippingDesc = 'Standard Shipping'"
          checked
        >
        <span>$9.97 - <span>{{ __('Standard Shipping', 'sage') }}</span></span>
      </label>
    </div>

    <div class="w-full mb-2">
      <label class="label label--radio">
        <input
          class="input--radio"
          name="shippingRate"
          type="radio"
          value="29.99"
          x-model.number="shippingRate"
          x-on:click="shippingDesc = 'Rush Shipping'"
        >
        <span>$29.99 - <span>{{ __('Rush Shipping', 'sage') }}</span></span>
      </label>
    </div>

    <div class="w-full mb-2">
      <label class="label label--radio">
        <input
          class="input--radio"
          name="shippingRate"
          type="radio"
          value="3.79"
          x-model.number="shippingRate"
          x-on:click="shippingDesc = 'Standard Shipping (4-8 Business Days)'"
        >
        <span>$3.79 - <span>{{ __('Standard Shipping (4-8 Business Days)', 'sage') }}</span></span>
      </label>
    </div>

    <div class="w-full mb-2">
      <label class="label label--radio">
        <input
          class="input--radio"
          name="shippingRate"
          type="radio"
          value="11.65"
          x-model.number="shippingRate"
          x-on:click="shippingDesc = 'Expedited Shipping (1-3 Business Days)'"
        >
        <span>$11.65 - <span>{{ __('Expedited Shipping (1-3 Business Days)', 'sage') }}</span></span>
      </label>
    </div>
  </div>
</fieldset>
