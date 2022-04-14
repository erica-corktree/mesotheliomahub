<fieldset {!! $attributes->merge(['class' => 'fieldset']) !!}>
  <legend class="">{{ $legend }}</legend>

  {!! $slot !!}
</fieldset>
