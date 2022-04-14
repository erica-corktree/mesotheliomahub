<div class="w-full">
  <fieldset class="card card--fieldset md:w-1/2" id="Summary">
    <legend class="legend legend--card">{{ __('Order Summary', 'sage') }}</legend>

    <p class="w-full mt-0 mb-4 text-2xl font-medium leading-tight font-heading text-yellow">
      <span class="block font-medium text-yellow" x-text="productName">{{ $title }}</span>
      <span class="block font-semibold text-yellow">{{ $label }}</span>
      <span class="block mt-2 text-base font-medium text-grey-darker" x-text="productDiscount">{{ $subtitle }}</span>
    </p>

    <p class="mb-6 text-sm">
      <span class="block{{ ($note) ? ' mb-1' : '' }}">
        {{ $description }}
      </span>

      @if ($note)
        <em class="block">{{ $note }}</em>
      @endif
    </p>

    <p class="mb-4 leading-none">
      <span class="label__text">{{ __('Subtotal', 'sage') }}</span>
      <strong class="block text-yellow">
        <span>$</span><span x-text="subtotal"></span>
      </strong>
    </p>

    <p class="mb-4 leading-none">
      <span class="label__text">{{ __('Shipping', 'sage') }}</span>
      <strong class="block text-yellow">
        <span>$</span><span x-text="shippingRate"></span>
      </strong>
    </p>

    <p class="mb-4 leading-none">
      <span class="label__text">{{ __('Due Today', 'sage') }}</span>
      <strong class="block text-4xl text-yellow">
        <span>$</span><span x-text="(subtotal + shippingRate)"></span>
      </strong>
    </p>

    <div class="w-full mt-4 mb-6 md:w-full">
      <label class="label label--checkbox">
        <input class="input--checkbox" type="checkbox" name="agreedToTerms" required>
        <span class="flex-1">{{ __('By checking this box you consent to have read and acknowledge our Disclaimer and Terms of Service', 'sage') }}</span>
      </label>
    </div>

    <p class="text-center form__submit">
      <button class="button button--xl button--blue" type="submit">{{ __('Place Order', 'sage') }}</button>
    </p>

    <p class="block w-full mt-4 mb-0 text-sm font-bold tracking-wide text-center uppercase text-green-dark">
      <i class="fa fa-lock"></i>
      <span class="ml-1">{{ __('All payments are secured by 256-bit encryption', 'sage') }}</span>
    </p>
  </fieldset>
</div>
