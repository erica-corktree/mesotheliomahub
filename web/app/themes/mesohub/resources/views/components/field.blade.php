@switch ($type)
  @case ('button')
  @case ('submit')
    <button {!! $attributes->merge(['class' => "button", 'type' => $type]) !!}>
      {!! $label !!}
    </button>
  @break

  @case ('checkbox')
  @case ('radio')
    <label class="label label--{{ $type }}">
      <input {!! $attributes->merge(['class' => "input--{$type}", 'type' => $type]) !!}>
      <span>{!! $label !!}</span>
    </label>
  @break

  @case ('hidden')
    <input {!! $attributes->merge(['type' => $type]) !!}>
  @break

  @case ('meter')
    <label class="label label--meter">
      <span class="label__text">{!! $label !!}</span>
      <meter {!! $attributes->merge(['class' => 'meter', 'type' => 'meter']) !!}>
        {!! !empty($slot) ? $slot : '' !!}
      </meter>
    </label>
  @break

  @case ('progress')
    <label class="label label--progress">
      <span class="label__text">{!! $label !!}</span>
      <progress {!! $attributes->merge(['class' => 'progress', 'type' => 'progress']) !!}>
        {!! !empty($slot) ? $slot : '' !!}
      </progress>
    </label>
  @break

  @case ('select')
    <label class="label label--{{ $type }}">
      <span class="label__text">{!! $label !!}</span>
      <select {!! $attributes->merge(['class' => 'select', 'type' => 'select']) !!}>
        {!! !empty($slot) ? $slot : '' !!}
      </select>
    </label>
  @break

  @case ('textarea')
    <label class="label label--{{ $type }}">
      <span class="label__text">{!! $label !!}</span>
      <textarea {!! $attributes->merge(['class' => 'textarea']) !!}></textarea>
    </label>
  @break

  @default
    <label class="label{{ $type ? " label--{$type}" : '' }}">
      <span class="label__text">{!! $label !!}</span>
      <input {!! $attributes->merge(['class' => "input input--{$type}", 'type' => $type]) !!}>
      {!! !empty($slot) ? $slot : '' !!}
    </label>
  @break
@endswitch
