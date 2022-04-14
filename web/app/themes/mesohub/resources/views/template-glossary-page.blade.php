{{--
  Template Name: Glossary Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <header class="PageHeader">
      <div class="Container">
        <div class="PageHeader__content">
          <h1>
            @if (isset($banner->title))
              {{ $banner->title }}
            @else
              {{ $title }}
            @endif
          </h1>
        </div>

        @include('partials.page-header-illustration')
      </div>
    </header>

    <div class="Container">
      <div class="Glossary">
        <div class="Glossary__button-wrap">
          <button
            class="Glossary__toggle-button Button Button--outline-dark"
            data-toggle="GlossaryLettersWrap"
          >{{ __('Skip to Letter') }} <span class="Icon Icon--angle-down"></span></button>

          <div class="Glossary__letters-wrap" id="GlossaryLettersWrap" data-toggler=".js-active">
            <ul class="Glossary__letters" data-magellan data-offset="150">
              @foreach ($glossary_terms_list as $letter)
                <li class="Glossary__letters__item">
                  <a class="Glossary__letters__link" href="#{{ $letter->letter }}terms">{{ $letter->letter }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        @foreach ($glossary_terms_list as $letter)
          <div
            class="Glossary__term"
            id="{{ $letter->letter }}terms"
            data-magellan-target="{{ $letter->letter }}terms"
          >
            <h2 class="Glossary__term__heading">{{ $letter->letter }}</h2>

            <dl class="Glossary__term-list">
              @foreach ($letter->terms as $term)
                <div class="Glossary__term-list__item">
                  <dt class="Glossary__term-list__name">{{ $term->name }}</dt>
                  <dd class="Glossary__term-list__description">
                    {{ $term->description }}

                    @if ($term->child_terms)
                      <dl class="Glossary__term-list">
                        @foreach ($term->child_terms as $child_term)
                          <div class="Glossary__term-list__item">
                            <dt class="Glossary__term-list__name">{{ $child_term->name }}</dt>
                            <dd class="Glossary__term-list__description">
                              {{ $child_term->description }}
                            </dd>
                          </div>
                        @endforeach
                      </dl>
                    @endif
                  </dd>
                </div>
              @endforeach
            </dl>
          </div>
        @endforeach
      </div>
    </div>

    @include('partials.footer-cta')
  @endwhile
@endsection
