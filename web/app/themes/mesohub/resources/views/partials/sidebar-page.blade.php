<aside class="hidden w-full sidebar sidebar--page md:block md:w-1/4" id="sidebar-page">
  @if (is_page() && isset($child_pages))
    <nav class="p-8 pt-16 bg-grey-lighter">
      <h3 class="mb-4 text-xl font-medium">
        <a class="text-yellow" href="{{ get_the_permalink($top_level_parent->ID) }}">{{ $top_level_parent->post_title }}</a>
      </h3>

      <ul>
        @foreach ($child_pages as $page)

          @if (get_the_ID() === $page['id'])
            <li class="flex flex-wrap items-center justify-between mb-2 last:mb-0">
          @elseif (in_array(get_the_ID(), $page['childIds']))
            <li class="flex flex-wrap items-center justify-between mb-2 last:mb-0" aria-expanded="true">
          @else
            <li class="flex flex-wrap items-center justify-between mb-2 last:mb-0">
          @endif
            <a class="block text-yellow-dark" href="{{ $page['url'] }}">{!! $page['title'] !!}</a>

            @if (in_array(get_the_ID(), $page['childIds']))
              <button class="leading-none" aria-haspopup="true" aria-expanded="false">
                @svg('images.down', 'w-4 h-auto')
              </button>
            @elseif ($page['children'])
              <button class="leading-none" aria-haspopup="true" aria-expanded="true">
                @svg('images.up', 'w-4 h-auto')
              </button>
            @endif

            @if ($page['children'])
              @if (in_array(get_the_ID(), $page['childIds']))
                <ul class="w-full" aria-hidden="false">
              @else
                <ul class="w-full" aria-hidden="true">
              @endif
                @foreach ($page['children'] as $child)
                  @if (get_the_ID() === $child['id'])
                    <li class="flex flex-wrap items-center justify-between">
                  @elseif (in_array(get_the_ID(), $child['childIds']))
                    <li class="flex flex-wrap items-center justify-between" aria-expanded="true">
                  @else
                    <li class="flex flex-wrap items-center justify-between">
                  @endif

                  <a class="block text-yellow-dark" href="{{ $child['url'] }}">{!! $child['title'] !!}</a>

                  @if (in_array(get_the_ID(), $child['childIds']))
                    <button class="leading-none" aria-haspopup="true" aria-expanded="false">
                      @svg('images.down', 'w-4 h-auto')
                    </button>
                  @elseif ($child['children'])
                    <button class="leading-none" aria-haspopup="true" aria-expanded="true">
                      @svg('images.up', 'w-4 h-auto')
                    </button>
                  @endif

                    @if ($child['children'])
                      @if (in_array(get_the_ID(), $child['childIds']))
                        <ul aria-hidden="false">
                      @else
                        <ul class="w-full" aria-hidden="true">
                      @endif
                        @foreach ($child['children'] as $sub_child)
                          @if (get_the_ID() === $sub_child['id'])
                            <li class="flex flex-wrap items-center justify-between">
                          @else
                            <li class="flex flex-wrap items-center justify-between">
                          @endif

                            <a class="block text-yellow-dark" href="{{ $sub_child['url'] }}">{!! $sub_child['title'] !!}</a>
                          </li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
      </ul>
    </nav>
  @endif

  @php(dynamic_sidebar('sidebar-page'))
</aside>
