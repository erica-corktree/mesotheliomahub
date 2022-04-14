@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section>
      <header class="PageHeader">
        <div class="Container">
          <div class="PageHeader__content">
            <h1 class="PageHeader__heading">{{ get_the_title() }}</h1>
          </div>
        </div>
      </header>
        
      <div class="Container Container--page-wrap">
        <div class="PageWrap">
          <div class="PageContent">
          <div class="reviewer_image" style="width:25%;margin-bottom:20px;">
        @if (get_the_post_thumbnail_url())
              <picture class="Photo Photo--reviewer">
                <source srcset="{{ get_the_post_thumbnail_url($id, 'full') }}" media="(min-width: 64em)">
                <source srcset="{{ get_the_post_thumbnail_url($id, 'large') }}" media="(min-width: 52em)">
                <source srcset="{{ get_the_post_thumbnail_url($id, 'medium_large') }}" media="(min-width: 40em)">
                <img class="Photo__img" srcset="{{ get_the_post_thumbnail_url($id, 'medium') }}" alt="" style="width: 100%;" loading="lazy">
              </picture>
            @endif
  </div>
            <div class="EditorContent">
              @php the_content() @endphp
            </div>
          </div>
        </div>
      </div>

      @include('partials.footer-cta')
    </section>
  @endwhile
@endsection

