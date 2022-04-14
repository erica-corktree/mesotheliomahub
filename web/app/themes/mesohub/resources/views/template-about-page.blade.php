{{--
  Template Name: About Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section>
      @include('partials.page-header')

      <div class="Segment Segment--normal">
        <div class="Container">
          <div class="Segment__content EditorContent">
            @php the_content() @endphp

            @if ($about_contact_us_card)
              <div class="ContactUsCard">
                <a
                  class="ContactUsCard__email"
                  href="mailto:{{ $about_contact_us_card->email }}"
                ><span class="Icon Icon--email"></span> {{ $about_contact_us_card->email }}</a>

                @if ($about_contact_us_card->offices)
                  @foreach ($about_contact_us_card->offices as $office)
                    <address class="ContactUsCard__office">
                      <p class="ContactUsCard__office__name">{{ $office->name }}</p>
                      <p class="ContactUsCard__office__address">{!! $office->address !!}</p>
                    </address>
                  @endforeach
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>

      @include('partials.segments')

      @if ($about_team_list)
        <div class="TeamListWrap">
          @foreach ($about_team_list as $list)
            <section class="TeamList">
              <div class="Container">
                <h2 class="TeamList__heading">{{ $list->heading }}</h2>
                <p class="TeamList__description">{{ $list->description }}</p>

                @foreach ($list->members as $member)
                  <div class="TeamList__member">
                    <img
                      class="TeamList__member__photo"
                      src="{{ $member->photo->sizes->medium }}"
                      alt="{{ $member->photo->alt }}"
                    >

                    <div class="TeamList__member__content">
                      <h3 class="TeamList__member__heading">{{ $member->name }}</h3>
                      <p class="TeamList__member__description">{{ $member->description }}</p>
                    </div>
                  </div>
                @endforeach

                @if ($loop->last)
                  <p class="TeamList__disclaimer">Note: Members of Mesothelioma Hub content team are not medical professionals.</p>
                @endif
              </div>
            </section>
          @endforeach
        </div>
      @endif

      @include('partials.page-footer')
      @include('partials.footer-cta')
    </section>
  @endwhile
@endsection
