<div class="FooterCTA">
  <div class="Container">
    <div class="FooterCTA__col FooterCTA__col--left">
      <h3 class="FooterCTA__heading">{{ $acf_options->site_page_footer_cta->heading }}</h3>
      <p class="FooterCTA__content">{{ $acf_options->site_page_footer_cta->content }}</p>
    </div>

    <div class="FooterCTA__col FooterCTA__col--right">
      @includeIf('partials.svgs.community-members')

      <a class="FooterCTA__phone-number" href="tel:{{ $acf_options->site_phone_number->dial_in }}">
        <span class="Icon Icon--phone"></span> {{ $acf_options->site_phone_number->dial_in }}
      </a>
    </div>
  </div>
</div>
