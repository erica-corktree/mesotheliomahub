<input type="hidden" name="infFriendFormAction" value="https://yo774.infusionsoft.com/app/form/process/bc61ba41e168daa672780e94393a03f1">
<input type="hidden" name="infFriendFormId"     value="bc61ba41e168daa672780e94393a03f1">
<input type="hidden" name="infFriendFormName"   value="Double Bundle Friend Info Submitted">

<div class="w-full mx-auto mt-4 md:w-1/2 md:mt-8">
  <label class="label label--checkbox">
    <input
      class="input--checkbox"
      type="checkbox"
      name="isDoubleBundle"
      x-model="isDoubleBundle"
      x-on:click="isDoubleBundle = !isDoubleBundle; subtotal = isDoubleBundle ? 147.00 : 97.00; productId = isDoubleBundle ? 15 : 13; productName = isDoubleBundle ? 'Break Free Double Bundle' : 'Break Free Bundle'; productDiscount = isDoubleBundle ? '(82% off retail price of $794)' : '(75% off of retail cost of $397)';"
    >
    <span>{{ __('I would like to order the Double Bundle for a friend', 'sage') }}</span>
  </label>

  <fieldset
    class="fieldset{{ $class ? " {$class}" : '' }}"
    id="DoubleBundle"
    x-show="isDoubleBundle"
  >
    <legend class="legend">{{ __('Double Bundle', 'sage') }}</legend>

    <div class="fieldset__inner">
      <div class="w-full md:w-1/2 md:pr-1">
        <x-field
          label="{{ __('First Name', 'sage') }}"
          name="friendFirstName"
          type="text"
          x-bind:required="isDoubleBundle"
        />
      </div>

      <div class="w-full md:w-1/2 md:pl-1">
        <x-field
          label="{{ __('Last Name', 'sage') }}"
          name="friendLastName"
          type="text"
          x-bind:required="isDoubleBundle"
        />
      </div>

      <div class="w-full md:w-full">
        <x-field
          label="{{ __('Email Address', 'sage') }}"
          name="friendEmail"
          type="email"
          x-bind:required="isDoubleBundle"
        />
      </div>
    </div>
  </fieldset>
</div>
