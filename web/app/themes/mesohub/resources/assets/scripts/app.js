/**
 * External Dependencies
 */
import 'jquery';
import 'jquery-validation';
import 'foundation-sites';
import 'slick-carousel';

import throttle from 'lodash/throttle';
import algoliasearch from 'algoliasearch';
import autocomplete from 'autocomplete.js';
import {
  disableBodyScroll,
  enableBodyScroll,
  clearAllBodyScrollLocks,
} from 'body-scroll-lock';

/**
 * Ta-da!...
 */
jQuery(function() {
  /** Mesothelioma Hub globals **/
  window.MH = {
    breakpointXs: '(max-width: 40em)',
    breakpointXsSm: '(max-width: 52em)',
    breakpointSm: '(min-width: 40em)',
    breakpointSmMd: '(min-width: 40em) and (max-width: 52em)',
    breakpointMd: '(min-width: 52em)',
    breakpointMdLg: '(min-width: 52em) and (max-width: 64em)',
    breakpointLg: '(min-width: 64em)',
  }

  let iOS    = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
  let ratio  = window.devicePixelRatio || 1;
  let screen = {
    width: window.screen.width * ratio,
    height: window.screen.height * ratio,
  };
  let screenPosition = jQuery(window).scrollTop();
  let client = algoliasearch('95TW9DQNYY', '1f77a83e73f5b62d5d3fed7514a578e3');
  let index  = client.initIndex('mh_searchable_posts');

  // Initialize foundation
  jQuery(document).foundation();

  // Algolia autocomplete
  autocomplete('#SiteSearch', { hint: false }, {
    source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
    displayKey: 'post_title',
    templates: {
      suggestion: (suggestion) => {
        return `<span>${suggestion._highlightResult.post_title.value}</span>`;
      },
    },
  });

  // iPhone X Detection
  if (iOS && screen.width == 1125 && screen.height === 2436) {
    jQuery('body').addClass('iphoneX');
  }

  // Prevent default for modal links
  jQuery('[data-open]').click((event) => {
    event.preventDefault();
  });

  // Header search form
  jQuery('.Masthead__search-button').click(function () {
    jQuery(this).toggleClass('js-active');
    jQuery('.Masthead__search').toggleClass('js-form-visible');
  });

  // Mobile navigation
  jQuery('.Navigation__menu > .Menu__item--has-children > .Menu__link').click(function (event) {
    if (window.matchMedia(window.MH.breakpointXsSm).matches) {
      let submenu = jQuery(this).parent().find('.Navigation__submenu')[0];

      event.preventDefault();

      if (!jQuery(this).parent().hasClass('js-active')) {
        jQuery('.Navigation__menu > .Menu__item.js-active').removeClass('js-active');
        clearAllBodyScrollLocks();
        jQuery(this).parent().addClass('js-active');
        disableBodyScroll(submenu);
      } else {
        jQuery(this).parent().removeClass('js-active');
        enableBodyScroll(submenu);
      }
    }
  });

  // Slider widget
  jQuery('.Widget--slider .WidgetSlider').slick({
    infinite: true,
    arrows: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    prevArrow: '<button class="WidgetSlider__arrow WidgetSlider__arrow--prev"><span class="Icon Icon--angle-left"></span></button>',
    nextArrow: '<button class="WidgetSlider__arrow WidgetSlider__arrow--next"><span class="Icon Icon--angle-right"></span></button>',
  });

  // Steps slider
  jQuery('.StepsList').slick({
    infinite: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 9999,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          dots: true,
          arrows: true,
        },
      },
      {
        breakpoint: 832,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          arrows: false,
        },
      },
    ],
  });

  // State selector
  jQuery('.StateSelector').slick({
    infinite: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 9999,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 5,
          dots: true,
          arrows: true,
        },
      },
      {
        breakpoint: 832,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          dots: true,
          arrows: true,
        },
      },
    ],
  });

  // Dropdowns
  jQuery('.Dropdown').on('click', '.Dropdown__button', function () {
    jQuery(this).parent().toggleClass('js-active');
  });

  // Mobile nav menu
  jQuery('.Menu--mobile-nav .Menu__toggle-btn').each(function () {
    jQuery(this).click(function () {
      let id = `#${jQuery(this).attr('aria-controls')}`;

      if (jQuery(this).attr('aria-expanded') === 'false') {
        jQuery(this).attr('aria-expanded', 'true');
      } else {
        jQuery(this).attr('aria-expanded', 'false');
      }

      jQuery(this).toggleClass('js-active');
      jQuery(this).parent().toggleClass('js-active');
      jQuery(this).parent().find(id).toggleClass('js-expanded');
    });
  });

  // Sidebar page nav
  jQuery('.PageNav__expand').click(function () {
    if (this.getAttribute('aria-expanded') === 'false') {
      this.setAttribute('aria-expanded', 'true');
    } else {
      this.setAttribute('aria-expanded', 'false');
    }

    jQuery(this).parent().children("ul").slideToggle();
  });

  // Landing Page forms
  /* eslint-disable no-alert, no-console */
  jQuery('.LandingPageForm').submit(function (event) {
    event.preventDefault();
  }).validate({
    errorElement: 'span',
    errorClass: 'not-valid',
    errorPlacement: function (error, element) {
      if (element.attr('name') === 'diagnosis') {
        element.parent().parent().find('.Form__label__text').append(error);
      } else {
        element.parent().find('.Form__label__text').append(error);
      }
    },
    highlight: function (element, errorClass) {
      jQuery(element).addClass(errorClass);
    },
    submitHandler: function (form) {
      jQuery(form).find('.Alert').remove();

      jQuery.ajax({
        type:       'POST',
        url:        jQuery(form).attr('action'),
        data:       jQuery(form).serialize(),
        dataType:   "json",
        success: function (data) {
          console.log(data);

          if (data.success) {
            jQuery(form).addClass('js-submit-success');
            jQuery(form).append(`<div id="GuideFormAlert" class="Alert Alert--success">
                <span class="fa fa-check"></span> ${data.message}
              </div>`);
            jQuery('#GuideFormAlert').fadeIn(250);
          } else {
            jQuery(form).addClass('js-submit-error');
            jQuery(form).append(`<div id="GuideFormAlert" class="Alert Alert--error">
                <span class="fa fa-check"></span> ${data.error}
              </div>`);
          }
        },
        error: function (data) {
          console.log(data);

          jQuery(form).addClass('js-submit-error');
          jQuery(form).append(`<div id="GuideFormAlert" class="Alert Alert--error">
              <span class="fa fa-check"></span> ${data.error}
            </div>`);
        },
      });
    },
  });
  /* eslint-enable no-alert, no-console */
  // END - Landing Page forms

  // Landing Page forms
  /* eslint-disable no-alert, no-console */
  jQuery('.Form--modal').each(function () {
    jQuery(this).submit(function (event) {
      event.preventDefault();
    }).validate({
      errorElement: 'span',
      errorClass: 'not-valid',
      errorPlacement: function (error, element) {
        if (element.attr('name') === 'diagnosis') {
          element.parent().parent().find('.Form__label__text').append(error);
        } else {
          element.parent().find('.Form__label__text').append(error);
        }
      },
      highlight: function (element, errorClass) {
        jQuery(element).addClass(errorClass);
      },
      submitHandler: function (form) {
        jQuery(form).find('.Alert').remove();

        jQuery.ajax({
          type:       'POST',
          url:        jQuery(form).attr('action'),
          data:       jQuery(form).serialize(),
          dataType:   "json",
          success: function (data) {
            console.log(data);

            if (data.success) {
              jQuery(form).addClass('js-submit-success');
              jQuery(form).append(`<div id="ModalFormAlert" class="Alert Alert--success">
                  <span class="fa fa-check"></span> ${data.message}
                </div>`);
              jQuery('#ModalFormAlert').fadeIn(250);
            } else {
              jQuery(form).addClass('js-submit-error');
              jQuery(form).append(`<div id="ModalFormAlert" class="Alert Alert--error">
                  <span class="fa fa-check"></span> ${data.error}
                </div>`);
            }
          },
          error: function (data) {
            console.log(data);

            jQuery(form).addClass('js-submit-error');
            jQuery(form).append(`<div id="ModalFormAlert" class="Alert Alert--error">
                <span class="fa fa-check"></span> ${data.error}
              </div>`);
          },
        });
      },
    });
  });
  /* eslint-enable no-alert, no-console */
  // END - Landing Page forms

  // Show bottom CTA on scroll
  jQuery(window).on('scroll', throttle(function () {
    let scroll        = jQuery(window).scrollTop();
    let scrollingDown = scroll > screenPosition;
    let headerHeight  = jQuery('.Masthead').height();

    if (jQuery('body').hasClass('FrontPage')) {
      if (scroll >= (jQuery('.Hero').height() - headerHeight)) {
        jQuery('.BottomCTA').addClass('js-is-visible');
      } else {
        jQuery('.BottomCTA').removeClass('js-is-visible');
      }
    } else {
      if (scroll >= jQuery('.PageHeader').height()) {
        jQuery('.BottomCTA').addClass('js-is-visible');
      } else {
        jQuery('.BottomCTA').removeClass('js-is-visible');
      }
    }

    if (!jQuery('body').hasClass('LandingPage')
        && window.matchMedia(window.MH.breakpointXsSm).matches
        && scroll >= headerHeight
        && scrollingDown) {
      jQuery('.Masthead').addClass('js-hide-header');
    } else if (jQuery('.Masthead').hasClass('js-hide-header')) {
      jQuery('.Masthead').removeClass('js-hide-header');
    }

    if ((jQuery('body').hasClass('SinglePage') && !jQuery('body').hasClass('LandingPage'))
        && window.matchMedia(window.MH.breakpointMd).matches
        && scroll >= jQuery('.PageHeader').height()
        && scrollingDown) {
      jQuery('.Masthead').addClass('js-hide-menu');
    } else if (jQuery('.Masthead').hasClass('js-hide-menu')) {
      jQuery('.Masthead').removeClass('js-hide-menu');
    }

    screenPosition = scroll;
  }, 250));
  // END - Show bottom CTA on scroll

  jQuery('.Glossary__button-wrap').on('click', '.Glossary__letters-wrap.js-active .Glossary__letters__link', function () {
    jQuery('#GlossaryLettersWrap').foundation('toggle');
  });
});
