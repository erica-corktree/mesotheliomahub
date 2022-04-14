<aside
  class="Sidebar"
  itemscope
  itemtype="http://schema.org/WPSideBar"
>
  @if (is_page() && isset($child_pages))
    <nav class="PageNav">
      <h3 class="PageNav__heading">
        <a href="{{ get_the_permalink($top_level_parent->ID) }}">{{ $top_level_parent->post_title }}</a>
      </h3>

      <ul class="PageNav__menu">
        @foreach ($child_pages as $page)

          @if ($id === $page['id'])
            <li class="PageNav__menu-item PageNav__menu-item--active">
          @elseif (in_array($id, $page['childIds']))
            <li class="PageNav__menu-item" aria-expanded="true">
          @else
            <li class="PageNav__menu-item">
          @endif
            <a class="PageNav__link" href="{{ $page['url'] }}">{!! $page['title'] !!}</a>

            @if (in_array($id, $page['childIds']))
              <button
                class="PageNav__expand"
                aria-haspopup="true"
                aria-expanded="false"
              ><span class="Icon"></span></button>
            @elseif ($page['children'])
                <button
                  class="PageNav__expand"
                  aria-haspopup="true"
                  aria-expanded="true"
                ><span class="Icon"></span></button>
            @endif

            @if ($page['children'])
              @if (in_array($id, $page['childIds']))
                <ul class="PageNav__sub-menu js-expanded" aria-hidden="false">
              @else
                <ul class="PageNav__sub-menu" aria-hidden="true">
              @endif
                @foreach ($page['children'] as $child)
                  @if ($id === $child['id'])
                    <li class="PageNav__menu-item PageNav__menu-item--active">
                  @elseif (in_array($id, $child['childIds']))
                    <li class="PageNav__menu-item" aria-expanded="true">
                  @else
                    <li class="PageNav__menu-item">
                  @endif

                  <a class="PageNav__link" href="{{ $child['url'] }}">{!! $child['title'] !!}</a>

                  @if (in_array($id, $child['childIds']))
                    <button
                    class="PageNav__expand"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><span class="Icon"></span></button>
                  @elseif ($child['children'])
                    <button
                      class="PageNav__expand"
                      aria-haspopup="true"
                      aria-expanded="true"
                    ><span class="Icon"></span></button>
                  @endif

                    @if ($child['children'])
                      @if (in_array($id, $child['childIds']))
                        <ul class="PageNav__sub-menu js-expanded" aria-hidden="false">
                      @else
                        <ul class="PageNav__sub-menu" aria-hidden="true">
                      @endif
                        @foreach ($child['children'] as $sub_child)
                          @if ($id === $sub_child['id'])
                            <li class="PageNav__menu-item PageNav__menu-item--active">
                          @else
                            <li class="PageNav__menu-item">
                          @endif

                            <a class="PageNav__link" href="{{ $sub_child['url'] }}">{!! $sub_child['title'] !!}</a>
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
  @elseif (is_singular('post') || is_home() || is_category() || is_author())
    <nav class="PageNav">
      <h3 class="PageNav__heading"><a href="#">Popular Articles</a></h3>

      @if ($popular_articles)
        <ul class="PageNav__menu" role="tree">
          @foreach ($popular_articles as $article)
            <li class="PageNav__menu-item" role="treeitem">
              <a href="{{ get_the_permalink($article->ID) }}">{{ get_the_title($article->ID) }}</a>
            </li>
          @endforeach
        </ul>
      @endif
    </nav>
  @endif

  <a class="Widget Widget--cta" id="PageGuideCTAWidget" href="https://www.mesotheliomahub.com/legal-help/receive-a-case-evaluation/">
    <div class="Widget__content" style="text-align:center">
        <img src="https://www.mesotheliomahub.com/app/uploads/2022/02/case-eval.png" width="100px" style="margin:0 auto">
        <h4 class="Widget__title">Fill out a Free Mesothelioma Case Evaluation Form Here</h2>
      <span class="Button Button--primary" href="https://www.mesotheliomahub.com/legal-help/receive-a-case-evaluation/">Free Case Evaluation</span>
    </div>
  </a>
</aside>
