jQuery(document).ready(function($) {
  let controller;
  let resizeId;
  let lastScrollTop = 0;
  let isTouch = false;
  let $wrapper = $('.page-wrapper');
  let wWidth = $(window).width();
  let isObserver = true;
  let observer;
  const $header = $('.page-header');
  const displacementEls = [];
  let isWork = false;
  /* Mobile viewport units */
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);

  if (
    !('IntersectionObserver' in window) ||
    !('IntersectionObserverEntry' in window) ||
    !('isIntersecting' in window.IntersectionObserverEntry.prototype)
  ) {
    isObserver = false;
    $('html').removeClass('is-observer');
  }

  if (isObserver) {
    observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    });
  }

  /* Disable window scrolling on opened popups */
  function disableScrolling() {
    $wrapper.addClass('disable-scrolling');
  }

  /* Enable window scrolling after closing popups */
  function enableScrolling() {
    $wrapper.removeClass('disable-scrolling');
  }

  function isTouchDevice() {
    const prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
    const mq = query => {
      return window.matchMedia(query).matches;
    };

    if (
      'ontouchstart' in window ||
      // eslint-disable-next-line no-undef
      (window.DocumentTouch && document instanceof DocumentTouch)
    ) {
      return true;
    }

    // include the 'heartz' as a way to have a non matching MQ to help terminate the join
    // https://git.io/vznFH
    const query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join(
      ''
    );
    return mq(query);
  }

  isTouch = isTouchDevice();

  function stickyHeader() {
    const st = $wrapper.scrollTop();

    if (st < lastScrollTop || st < 10) {
      $header.removeClass('is-scrolling');
    } else {
      $header.addClass('is-scrolling');
    }

    lastScrollTop = st <= 0 ? 0 : st;
  }

  function globalEvents() {
    /* Open menu on mobile */
    $('.page-header__menu-btn').on('click', e => {
      if (wWidth < 768) {
        e.stopPropagation();
        $header.addClass('is-opened');
        disableScrolling();
      }
    });

    /* Close header nav */
    $('.page-header__close').on('click', () => {
      $header.removeClass('is-opened');
      if (wWidth < 768) enableScrolling();
    });

    /* On mobile, scrolling nav menu */
    $('.contact__scroll').on('click', () => {
      $('.page-header__nav-wrap').animate(
        { scrollTop: $('.page-header__nav-wrap').get(0).scrollHeight },
        1000
      );
    });

    $wrapper.scroll(stickyHeader);
  }

  /* Class for homepage projects */
  class DisplacementItem {
    constructor(canvas) {
      this.canvas = canvas;
      this.fitToContainer();
      this.bgs = [];
      this.textures = [];
      this.getImages();
      this.curImage = 0;
      this.gradient = theme.home_url + '/img/gradient_large.png';
      this.position = {};
      this.currentMousePos = {};
      this.attributes = {};
      this.listenPointer = true;
      this.displacementSprite;
      this.displacementFilter;
      this.hoverLoopAnimation;
      this.ancient_delta = 0;
      this.ratio = window.devicePixelRatio;
      // console.log(this.ratio);

      this.app = new PIXI.Application({
        view: this.canvas,
        resolution: this.ratio,
        transparent: true
      });
      this.app.stage.interactive = true;
      this.container = new PIXI.Container();
      this.loader = new PIXI.loaders.Loader();
      this.app.stage.addChild(this.container);
      this.loadResources();

      this.displaceTl;

      /* Dragger button properties */
      this.sliderBar = $(canvas)
        .closest('.intro__project')
        .find('.intro__cat');
      this.switchBtn = this.sliderBar.find('.intro__cat-btn');
      this.containerWidth = this.sliderBar.width();
      this.containerWithoutDragger =
        this.containerWidth - this.switchBtn.outerWidth(true);
      this.coords;
      this.shiftX;
      this.left;
      this.dragging;
      this.draggingCurrent;
      this.step =
        (this.containerWithoutDragger * 100) /
          this.containerWidth /
          this.bgs.length +
        '%';
      this.carousel = $(canvas).siblings('.intro__carousel');
    }

    /* Resize canvas to parent size */
    fitToContainer() {
      // Make it visually fill the positioned parent
      this.canvas.style.width = '100%';
      this.canvas.style.height = '100%';
      // ...then set the internal size to match
      this.canvas.width = this.canvas.offsetWidth;
      this.canvas.height = this.canvas.offsetHeight;
    }

    /* Get all siblings */
    getImages() {
      $(this.canvas)
        .siblings()
        .each((i, el) => {
          const src = $(el).data('src');

          if (src) {
            this.bgs.push(src);
          }
        });
    }

    /* Load all resources */
    loadResources() {
      this.loader.add(this.gradient);

      $.each(this.bgs, (i, el) => {
        this.loader.add(el);
      });

      this.loader.load(this.setup.bind(this));
    }

    /* Setup Pixi */
    setup() {
      this.position.x = this.app.renderer.width / 2;
      this.displacementSprite = new PIXI.Sprite(
        this.loader.resources[this.gradient].texture
      );
      this.displacementFilter = new PIXI.filters.DisplacementFilter(
        this.displacementSprite
      );
      this.displacementSprite.anchor.set(0.5);
      this.displacementSprite.x = this.app.renderer.width / 2;
      this.displacementSprite.y = this.app.renderer.height / 2;
      this.app.stage.addChild(this.displacementSprite);
      this.container.filters = [this.displacementFilter];
      this.displacementFilter.scale.x = 0;
      this.displacementFilter.scale.y = 0;
      this.displacementFilter.padding = 0;
      this.displacementFilter.resolution = this.ratio;

      $.each(this.bgs, (i, el) => {
        this.textures[i] = new PIXI.Sprite(this.loader.resources[el].texture);
        this.textures[i].width = this.app.renderer.width;
        this.textures[i].height = this.app.renderer.height;
        this.textures[i].width = this.app.renderer.screen.width;
        this.textures[i].height = this.app.renderer.screen.height;
        this.textures[i].alpha = 0;
        this.container.addChild(this.textures[i]);
      });
      this.textures[this.curImage].alpha = 1;

      this.displacementFilter.enabled = false;

      this.events();
    }

    destroy() {
      this.app.destroy(true);
    }

    /* Setup events */
    events() {
      $(this.canvas).on('click', this.switchImage.bind(this));

      if (this.sliderBar.length) {
        this.switchBtn.on('mousedown', this.sliderControls.bind(this));
        this.hammertime = new Hammer(this.switchBtn[0]); // block where we will listen touch events
        this.hammertime.on('pan', this.touchControls.bind(this));
        this.swipeHammer = new Hammer($(this.canvas).parent()[0]);
        this.swipeHammer.on('swipe', this.switchImage.bind(this));
      }
      this.app.stage.on('mousemove', this.onPointerMove.bind(this));

      this.hoverLoop();

      $(this.canvas).on('mouseenter', () => {
        this.displacementFilter.enabled = true;
      });

      $(this.canvas).on('mouseleave', () => {
        this.displacementFilter.enabled = false;
      });
    }

    /* Save mouse data */
    onPointerMove() {
      this.currentMousePos.x = event.pageX - $(this.canvas).offset().left;
    }

    /* Hover displacement */
    hoverLoop() {
      this.hoverLoopAnimation = requestAnimationFrame(
        this.hoverLoop.bind(this)
      );
      this.position.x = this.displacementSprite.x;
      this.position.intensity = this.displacementFilter.scale.x;
      this.position.width = this.displacementSprite.scale.x;
      if (this.listenPointer) {
        gsap.to(this.position, {
          duration: 0.3,
          x: this.currentMousePos.x / 1.5,
          intensity: (this.currentMousePos.x - this.ancient_delta) * 10,
          width: Math.abs(
            (this.currentMousePos.x - this.ancient_delta) / 80 - 0.2
          ),
          onUpdate: () => {
            this.displacementSprite.x = this.position.x;
            this.displacementFilter.scale.x = this.position.intensity;
            this.displacementSprite.scale.x = this.position.width;
          },
          ease: Linear.easeNone
        });
        this.ancient_delta = this.currentMousePos.x;
      }
    }

    /* Switch images */
    switchImage(e) {
      // gsap.to(this.textures[this.curImage], { duration: 0, alpha: 0 });
      this.textures[this.curImage].alpha = 0;

      if (this.dragging) {
        this.curImage = this.draggingCurrent;

        if (this.curImage >= this.bgs.length) {
          this.curImage = this.bgs.length - 1;
        }
      } else {
        if (e.direction == 4) {
          this.curImage--;

          if (this.curImage < 0) {
            this.curImage = this.bgs.length - 1;
          }
        } else {
          this.curImage++;

          if (this.curImage >= this.bgs.length) {
            this.curImage = 0;
          }
        }
      }

      let left = this.curImage * parseFloat(this.step) + '%';

      if (!this.dragging) {
        this.switchBtn.css('left', left);
      }

      this.textures[this.curImage].alpha = 1;

      if (wWidth < 1280 && this.carousel.length) {
        this.carousel.slick('slickGoTo', this.curImage);
      }
    }

    updateImage() {
      let left = parseFloat(this.left) / 100.0;
      let step = parseFloat(this.step) / 100.0;
      this.draggingCurrent = Math.floor(left / step);

      if (this.draggingCurrent >= this.bgs.length) {
        this.draggingCurrent = this.bgs.length - 1;
      }

      if (this.draggingCurrent !== this.curImage) {
        this.switchImage();
      }
    }

    sliderControls(e) {
      let self = this;
      this.dragging = true;
      this.coords = this.getCoords(this.switchBtn);
      this.shiftX = e.clientX - this.coords.left;
      this.moveAt(e);

      $(document).on('mousemove', function(e) {
        self.moveAt(e);
      });

      $(document).on('mouseup', function(e) {
        $(document).unbind('mousemove');
        $(document).unbind('mouseup');
        self.dragging = false;
      });
    }

    touchControls(e) {
      if (e.pointerType === 'touch') {
        this.dragging = e.isFinal ? false : true;
        this.coords = this.getCoords(this.switchBtn);
        this.shiftX = 0;

        this.moveAt(e);
      }
    }

    moveAt(e) {
      let event = e.pageX || e.center.x;
      this.left = event - this.sliderBar.offset().left - this.shiftX;

      if (this.left < 0) {
        this.left = 0;
      } else if (this.left > this.containerWithoutDragger) {
        this.left = this.containerWithoutDragger;
      } else {
        this.left = this.left;
      }

      this.left = (this.left * 100) / this.containerWidth + '%';

      this.switchBtn.css('left', this.left);
      this.updateImage();
    }

    getCoords(elem) {
      let box = elem[0].getBoundingClientRect();

      return {
        left: box.left
      };
    }
  }

  function initSM() {
    // reinitialize ScrollMagic only if it is not already initialized
    controller = new ScrollMagic.Controller({
      container: $wrapper[0]
    });

    if (wWidth > 767) {
      $('.js-parallax').each((i, el) => {
        const $el = $(el);
        const parallax = $el.data('parallax');

        new ScrollMagic.Scene({
          triggerElement: $el,
          triggerHook: 1,
          duration: '200%'
        })
          .setTween($el.children(), 1, { y: parallax })
          .addTo(controller);
      });
    }

    /* Specialty blocks class changing when in viewport */
    $('.specialty__block').each((i, el) => {
      let specialtyTimeline = gsap.timeline();

      specialtyTimeline
        .fromTo(
          $(el).find('.specialty__logo'),
          {
            opacity: 1
          },
          {
            duration: 1,
            opacity: 0
          }
        )
        .fromTo(
          $(el).find('.specialty__text-wrap'),
          {
            opacity: 0
          },
          {
            duration: 1,
            opacity: 1
          },
          '-=0.5'
        );

      if (wWidth > 767) {
        new ScrollMagic.Scene({
          triggerElement: el,
          duration: '150%',
          triggerHook: 0
        })
          .setPin(el)
          .addTo(controller);

        new ScrollMagic.Scene({
          triggerElement: el,
          offset: '50%',
          duration: '100%',
          triggerHook: 0
        })
          .setTween(specialtyTimeline)
          .addTo(controller);
      } else {
        new ScrollMagic.Scene({
          triggerElement: el
        })
          .setTween(specialtyTimeline)
          .addTo(controller);
      }
    });

    /* Scroll reveal animation */
    // $('.reveal').each((i, el) => {
    //   let reveal = gsap.to(el, {
    //     duration: 1,
    //     y: 0,
    //     opacity: 1
    //   });

    //   new ScrollMagic.Scene({
    //     triggerElement: el,
    //     duration: 1,
    //     triggerHook: 0.9
    //   })
    //     .setTween(reveal)
    //     .addTo(controller);
    // });
  }

  function initForm(){
    console.log('inited');
    const addProjectBtn = $('.add-project')
    const removeProject = $('.remove-project')
    const projectsArr = $('.js-project-added')
    let numProj = 0;

    if(!addProjectBtn.length){
      return;
    }

    console.log('returmn');

    $(addProjectBtn).on('click', function(){
      $(projectsArr[numProj]).addClass('active')
      numProj ++

      if(numProj > 0){
        $(removeProject).show()
      }
      else{
        $(removeProject).hide()
      }

      if (numProj > 9) {
        $(addProjectBtn).text('You can add a maximum of 10 products - please submit another form if you wish to add more')
      }
    })

    $(removeProject).on('click', function(){
      let newI = numProj - 1
      $(projectsArr[newI]).removeClass('active')
      numProj --

      if(numProj <= 0){
        $(removeProject).hide()
      }
    })
  }

  function initFormTransfere(){
    const submitBtn = $('.js-form-submit')
    const wp7GeneralForm = $('#general-form')
    const $exclusiveCheck = $('.exculsive-check')
    let goodToSend = false 

    // takes the acfs content and appends to form elements
    //********OLD FORM REDONE********!!!!
    // afcFields.each(function(){
    //   let newClass = "." + $(this).attr('data-class') + "-wp7";
    //   $(`${newClass}`).empty().append($(this).html())
    // })

    // $('.cutterguides-download').attr('href', $('.cutterguides-download-href').html())
    // $('.cutterguides-download').attr('download', $('.cutterguides-download-filename').html())  

    // $('.samples-download').attr('href', $('.next-steps-download-href').html())
    // $('.samples-download').attr('download', $('.next-steps-download-filename').html())     


    //only allows one select on checkboxes with this class
    $exclusiveCheck.each(function(){
      $(this).on('click', 'input[type="checkbox"]', function() { 
        let selectedInput = this
        $(this).parent().parent().parent().find('input').each(function(){
          if (this != selectedInput) {
            $(this).prop('checked', false)
          }
        }) 
      });
    })    

    //takes in the inputs on the form page, and inputs on the wp7 form and checks id selected
    function checkForSelectsAgainstWp7Form(ourFormInputs, wp7FormInputs){
      ourFormInputs.each(function(){
        if (this.checked) {
          let value = $(this).parent().text().toString()

          wp7FormInputs.each(function(){
            let inputCheck = this
            let wp7Val = $(this).parent().find('span').text().toString()

            if (value.includes(wp7Val)) {  
              $(inputCheck).prop('checked', true);    
            }
          })
        }
      })
    }

    $(submitBtn).on('click', function(e){       
      e.preventDefault()

      //runs through dummy checkboxes and populates real
      checkForSelectsAgainstWp7Form($('#cutterguide-selects input'), $('.cutterguide-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#print-process-selects input'), $('.print-process-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#colured-mediums-selects input'), $('.colured-mediums-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#varnish-type-selects input'), $('.varnish-type-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#white-print-selects input'), $('.white-print-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#spot-varnish-selects input'), $('.spot-varnish-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#emboss-selects input'), $('.emboss-selects-cf input'))
      checkForSelectsAgainstWp7Form($('#hot-foil-selects input'), $('.hot-foil-selects-cf input'))
      $('#general-subject').val($('#project-name-wp').val())

      //loops through all inputs with class and sets them to mandatory
      $('.form-manditory').each(function(){

        if (!$(this).find('input').val()) {
          
          $(this).addClass('form-error')
          let originalPlaceholder = $(this).find('input').attr("placeholder")

          if (!originalPlaceholder.includes("This field is mandatory")) {
            $(this).find('input').attr("placeholder", `${originalPlaceholder} - This field is mandatory`);
          }

          let scrollTo = this.offsetTop

          $wrapper.animate({            
            scrollTop: $($wrapper).offset().top + scrollTo
          }, 500)
          return;                   
        }
        else{
          $(this).removeClass('form-error')
        }
      })
      
      //loops through all checkboxes with class and sets them to mandatory
      $('.checkbox-manditory').each(function(){

        if (!$(this).find('input:checked').length > 0) {
          $(this).addClass('form-error')
          let scrollTo = this.offsetTop

          $wrapper.animate({            
            scrollTop: $($wrapper).offset().top + scrollTo
          }, 500)
          return;  
        }
        else{
          $(this).removeClass('form-error')
        } 
      })

      //loops through all textareas with class and sets them to mandatory
      $('.form-manditory-textarea').each(function(){

        if (!$(this).find('textarea').val()) {
          
          $(this).addClass('form-error')
          let originalPlaceholder = $(this).find('textarea').attr("placeholder")

          if(originalPlaceholder){
            if (!originalPlaceholder.includes("This field is mandatory")) {
              $(this).find('textarea').attr("placeholder", `${originalPlaceholder} - This field is mandatory`);
            }  
          }

          let scrollTo = this.offsetTop

          $wrapper.animate({            
            scrollTop: $($wrapper).offset().top + scrollTo
          }, 500)
          return;                   
        }
        else{
          $(this).removeClass('form-error')
        }
      })
            

      //simple email check
      $('.form-manditory-email').each(function(){
        let emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test( $(this).find('input').val() )) {

          $(this).addClass('form-error')
          $(this).find('label').text("Enter a valid email");
          let scrollTo = this.offsetTop

          $wrapper.animate({            
            scrollTop: $($wrapper).offset().top + scrollTo
          }, 1000)
          return;         
        }
        else{
          console.log('no email error?');
        }
      })

      //slect manditory check

      $('.form-manditory-select').each(function(){

        if( !$(this).find('select').val()  ) {
          $(this).addClass('form-error')
          // let originalPlaceholder = $(this).find('select').attr("placeholder")

          // if(originalPlaceholder){
          //   if (!originalPlaceholder.includes("This field is mandatory")) {
          //     $(this).find('select').attr("placeholder", `${originalPlaceholder} - This field is mandatory`);
          //   }
          // }



          let scrollTo = this.offsetTop

          $wrapper.animate({            
            scrollTop: $($wrapper).offset().top + scrollTo
          }, 500)
          return;                   
        }
        else{
          $(this).removeClass('form-error')
        } 
      })

      //form-manditory-select

      //final check
      if(!$('.form-error').length){
        goodToSend = true
      }

      if (goodToSend) {

        //submits general form
        $(wp7GeneralForm).submit()   
        $('.form-sucsess').addClass('active')
        $('.page-header').removeClass('is-scrolling')        
      }
    })
  }

  // styles drag and drop uploads
  function initDragnDropStyle(){
    const $inner = $('.codedropz-upload-inner')

    $inner.on('dragover', function(){
      $('.codedropz-upload-container').addClass('drag')
    });
    $inner.on('dragleave', function(){
      $('.codedropz-upload-container').removeClass('drag')
    });
    $inner.on('drop', function(){
      $('.codedropz-upload-container').removeClass('drag')
    });

    $inner.each(function(){
      $(this).find('h3').empty().append(`
      <svg class="reveal-form reveal"  xmlns="http://www.w3.org/2000/svg" width="72.539" height="46.274" viewBox="0 0 72.539 46.274">
        <path id="Icon" d="M13.455,46.271A13.168,13.168,0,0,1,5.212,22.613,11.427,11.427,0,0,1,21.415,12.3a20.344,20.344,0,0,1,37.823,1.145,16.577,16.577,0,0,1-3.375,32.828H46.306a1.165,1.165,0,1,1,0-2.331h9.557a14.247,14.247,0,0,0,2.3-28.321l-.71-.116-.219-.683a18,18,0,0,0-34.1-.486l-.482,1.372-1.239-.765A9.083,9.083,0,0,0,7.552,22.636l.057.974-.538.532a10.839,10.839,0,0,0,6.185,19.794l.239,0c.114,0,.234.007.348,0H26.235a1.165,1.165,0,1,1,0,2.331H13.9c-.056,0-.126,0-.206,0ZM35.1,45.1V24.578L24.878,34.758a1.176,1.176,0,0,1-1.654,0,1.163,1.163,0,0,1,0-1.648L35.443,20.94l0,0,.826-.821.826.821,0,0L49.318,33.11a1.163,1.163,0,0,1,0,1.648,1.179,1.179,0,0,1-1.655,0L37.44,24.578V45.1a1.169,1.169,0,0,1-2.338,0Z" fill="#f24f4f"/>
      </svg>
      `)

      $(this).find('span').remove()
      if (isTouch) {
        $(this).find('.cd-upload-btn').text('Upload a file here')
      }
      else{
        $(this).find('.cd-upload-btn').text('Drag and drop files here or click')
      }

      let btn = $(this).find('.cd-upload-btn')

      $(this).find('svg').on('click', function(){
        console.log('svg clickes');
        $(btn).click()
      })
    })
  }

  function initCarousel() {
    const slider = $('.intro__carousel');
    const settings = {
      mobileFirst: true,
      arrows: false,
      infinite: false,
      swipe: false,
      speed: 1000,
      waitForAnimate: false,
      draggable: false,
      responsive: [
        {
          breakpoint: 1279,
          settings: 'unslick'
        }
      ]
    };
    slider.each((i, el) => {
      const $el = $(el);
      if ($(window).width() < 1280 && !$el.hasClass('slick-initialized')) {
        $el.slick(settings);
      }
    });
  }

  /* Function to init whole JS */
  function initJS() {
    /* Init SVg polyfill for older browsers support  */
    if (window.svg4everybody) {
      window.svg4everybody();
    }

    initCarousel();
    initSM();
    initForm()
    initFormTransfere()
    initDragnDropStyle()

    $('.website, .info').on('mousewheel DOMMouseScroll', e => {
      e.stopPropagation();
    });

    /* Open menu/contact */
    $('.btn-contact').on('click', e => {
      $header.addClass('is-opened');
    });

    /* Scroll top */
    $('.js-scroll-top').on('click', () => {
      $wrapper.animate(
        {
          scrollTop: 0
        },
        1000
      );
    });

    $('.scroll-btn').on('click', function(e) {
      e.preventDefault();
      let anchor = $(this).data('anchor');
      if (typeof anchor == 'undefined') {
        anchor = $(this)[0].hash;
      }
      if (!anchor.includes('#')) {
        anchor = '#' + anchor;
      }

      const offset = $(anchor).offset().top + $wrapper.scrollTop();

      $wrapper.animate(
        {
          scrollTop: offset
        },
        1000
      );
    });

    /* Footer projects photo preview */
    $('.page-footer__nav a').hover(
      e => {
        if (!isTouch) {
          let src = e.target.dataset.src;
          const rand = Math.floor(Math.random() * (8 - 1)) + 1;
          if (src) {
            $('.page-footer__preview')
              .addClass('page-footer__preview--' + rand)
              .children('img')
              .attr('src', src);
          }
        }
      },
      () => {
        if (!isTouch) {
          $('.page-footer__preview').removeClass(function(index, css) {
            return (css.match(/\bpage-footer__preview--\S+/g) || []).join(' ');
          });
        }
      }
    );

    /* Project info btn */
    $('.project__info-btn').on('click', () => {
      $('.info').addClass('is-opened');
    });

    /* Close info popup */
    $('.info__close').on('click', () => {
      $('.info').removeClass('is-opened');
    });

    /* Subscribe form */
    $('.page-footer__subscribe').on('click', e => {
      $(e.target).addClass('is-active');
      setTimeout(() => {
        $('.subscribe').addClass('is-opened');
      }, 400);
    });

    /* Close form */
    $('.subscribe').on('click', e => {
      e.stopPropagation();
      $('.subscribe').removeClass('is-opened');
      $('.page-footer__subscribe').removeClass('is-active');
    });

    $(document).on('click', () => {
      $('.subscribe').removeClass('is-opened');
      $('.page-footer__subscribe').removeClass('is-active');
    });

    /* Allow clicks on input and button */
    $('.gform_wrapper').on('click', e => {
      e.stopPropagation();
    });

    /* Carousel */
    if ($('.carousel').length > 0) {
      $('.carousel').each((i, el) => {
        $(el)
          .not('.slick-initialized')
          .slick({
            mobileFirst: true,
            arrows: false,
            responsive: [
              {
                breakpoint: 1023,
                settings: {
                  arrows: true,
                  appendArrows: $(el).siblings('.arrows')
                }
              }
            ]
          });
      });
    }

    /* Filter */
    $('.filter button').on('click', e => {
      let btn = $(e.target);

      if (!btn.hasClass('filter__current')) {
        $('.filter button').removeClass('filter__current');
        btn.addClass('filter__current');
      }

      $('.work__grid').each(function() {
        if ($(this).hasClass('work__grid--current')) {
          $(this).removeClass('work__grid--current');
        }
      });

      let target = btn.data('target');
      target = '#' + target;
      $(target).addClass('work__grid--current');

      for (let i = displacementEls.length - 1; i >= 0; i -= 1) {
        displacementEls[i].destroy(true);
        displacementEls.splice(i, 1);
      }

      setTimeout(() => {
        $('.work__grid--current .displacement').each(function(i, el) {
          displacementEls.push(new DisplacementItem(el));
        });
      }, 50);

      if (isObserver) {
        $('.work__grid--current .work__item').each((i, el) => {
          observer.observe(el);
        });
      }
    });

    /* Work projects reveal */
    if (isObserver) {
      $('.work__grid--current .work__item').each((i, el) => {
        observer.observe(el);
      });

      $('.reveal').each((i, el) => {
        observer.observe(el);
      });

      $('.copy-block>*').each((i, el) => {
        observer.observe(el);
      });
    }

    if (!isTouch) {
      /* Init all projects instances */
      for (let i = displacementEls.length - 1; i >= 0; i -= 1) {
        displacementEls[i].destroy(true);
        displacementEls.splice(i, 1);
      }

      if (isWork) {
        setTimeout(() => {
          $('.work__grid--current .displacement').each(function(i, el) {
            displacementEls.push(new DisplacementItem(el));
          });
        }, 50);
      } else {
        setTimeout(() => {
          $('.displacement').each(function(i, el) {
            displacementEls.push(new DisplacementItem(el));
          });
        }, 50);
      }
    } else {
      setTimeout(() => {
        $('.displacement.intro__canvas').each(function(i, el) {
          displacementEls.push(new DisplacementItem(el));
        });
      }, 50);
    }

    $('.project__embed iframe').each((i, el) => {
      const $iframe = $(el);
      const $play = $iframe.siblings('.project__play');
      const $mute = $iframe.siblings('.project__mute');
      const autoplay = $iframe.hasClass('is-autoplay');
      const player = new Vimeo.Player($iframe[0]);
      let volume = 0;

      player.setVolume(0);
      $iframe.addClass('is-muted');

      $iframe.parent().on('click', () => {
        if ($iframe.hasClass('is-playing')) {
          player
            .pause()
            .then(function() {
              $iframe.removeClass('is-playing');
            })
            .catch(function(error) {
              console.log(error.name);
            });
        } else {
          player
            .play()
            .then(function() {
              $iframe.addClass('is-playing');
            })
            .catch(function(error) {
              console.log(error.name);
            });
        }
      });

      $play.on('click', () => {
        player
          .play()
          .then(function() {
            $iframe.addClass('is-playing');
          })
          .catch(function(error) {
            console.log(error.name);
          });
      });

      $mute.on('click', () => {
        if (volume == 0) {
          volume = 0.5;
          player.setVolume(volume);
          $iframe.removeClass('is-muted');
        } else {
          volume = 0;
          player.setVolume(volume);
          $iframe.addClass('is-muted');
        }
      });

      if (autoplay) {
        new ScrollMagic.Scene({
          triggerHook: 1,
          triggerElement: $iframe,
          duration: $(window).height() + $iframe.height()
        })
          .on('enter', () => {
            player
              .play()
              .then(() => {
                $iframe.addClass('is-playing');
              })
              .catch(function(error) {
                console.log(error.name);
              });
          })
          .on('leave', () => {
            player
              .getPaused()
              .then(function(paused) {
                if (!paused) {
                  player.pause();
                  $iframe.removeClass('is-playing');
                }
              })
              .catch(function(error) {
                console.log(error.name);
              });
          })
          .addTo(controller);
      }
    });

    $('.js-image-loaded').each((i, el) => {
      const $el = $(el);

      $el.addClass('is-loading').imagesLoaded(function() {
        $el.removeClass('is-loading');
      });
    });

    $('.project__scroll').on('click', e => {
      const $header = $(e.currentTarget).closest('.project__header');
      $wrapper.animate(
        {
          scrollTop: $header.offset().top + $header.outerHeight(true)
        },
        500
      );
    });

    initLoadThoughts();
  }

  function initLoadThoughts() {
    const $projectWrapper = $('.project__more');
    if (!$projectWrapper.length) return;

    const $btn = $projectWrapper.children('.project__load');
    const $container = $projectWrapper.children('.project__container');
    let current = 1;
    const total = $btn.data('total');
    const ids = [];

    ids.push($btn.data('id'));

    function checkPermission() {
      // const access = localStorage.getItem('marmaladeThinks');

      // if (!access) {
      //   const $cover = $('.cover-form');
      //   $cover.addClass('is-opened');

      //   $(document).on('gform_confirmation_loaded', () => {
      //     localStorage.setItem('marmaladeThinks', true);
      //     setTimeout(() => {
      //       $cover.removeClass('is-opened');
      //     }, 1500);
      //   });
      // }
    }

    function checkPagination() {
      if (current >= total) {
        $btn.addClass('is-disabled');
      } else {
        $btn.removeClass('is-disabled');
      }
    }

    function initPostJS($newProject) {
      if (isObserver) {
        $newProject.find('.reveal, .copy-block>*').each((i, el) => {
          observer.observe(el);
        });
      }

      if (!isTouch) {
        setTimeout(() => {
          $newProject.find('.displacement').each(function(i, el) {
            displacementEls.push(new DisplacementItem(el));
          });
        }, 50);
      }

      $newProject.find('.project__embed iframe').each((i, el) => {
        const $iframe = $(el);
        const $play = $iframe.siblings('.project__play');
        const $mute = $iframe.siblings('.project__mute');
        const autoplay = $iframe.hasClass('is-autoplay');
        const player = new Vimeo.Player($iframe[0]);
        let volume = 0;

        player.setVolume(0);
        $iframe.addClass('is-muted');

        $iframe.parent().on('click', () => {
          if ($iframe.hasClass('is-playing')) {
            player
              .pause()
              .then(function() {
                $iframe.removeClass('is-playing');
              })
              .catch(function(error) {
                console.log(error.name);
              });
          } else {
            player
              .play()
              .then(function() {
                $iframe.addClass('is-playing');
              })
              .catch(function(error) {
                console.log(error.name);
              });
          }
        });

        $play.on('click', () => {
          player
            .play()
            .then(function() {
              $iframe.addClass('is-playing');
            })
            .catch(function(error) {
              console.log(error.name);
            });
        });

        $mute.on('click', () => {
          if (volume == 0) {
            volume = 0.5;
            player.setVolume(volume);
            $iframe.removeClass('is-muted');
          } else {
            volume = 0;
            player.setVolume(volume);
            $iframe.addClass('is-muted');
          }
        });

        if (autoplay) {
          new ScrollMagic.Scene({
            triggerHook: 1,
            triggerElement: $iframe,
            duration: $(window).height() + $iframe.height()
          })
            .on('enter', () => {
              player
                .play()
                .then(() => {
                  $iframe.addClass('is-playing');
                })
                .catch(function(error) {
                  console.log(error.name);
                });
            })
            .on('leave', () => {
              player
                .getPaused()
                .then(function(paused) {
                  if (!paused) {
                    player.pause();
                    $iframe.removeClass('is-playing');
                  }
                })
                .catch(function(error) {
                  console.log(error.name);
                });
            })
            .addTo(controller);
        }
      });

      $newProject.find('.js-image-loaded').each((i, el) => {
        const $el = $(el);

        $el.addClass('is-loading').imagesLoaded(function() {
          $el.removeClass('is-loading');
        });
      });

      $newProject.find('.project__scroll').on('click', e => {
        const $newHeader = $(e.currentTarget).closest('.project__header');
        $wrapper.animate(
          {
            scrollTop:
              $newHeader.offset().top +
              $newHeader.outerHeight(true) +
              $wrapper.scrollTop()
          },
          500
        );
      });
    }

    $btn.on('click', () => {
      $.ajax({
        method: 'POST',
        dataType: 'json',
        // eslint-disable-next-line no-undef
        url: theme.ajax,
        data: {
          ids,
          action: 'load_post'
        },
        success(response) {
          $container.append(response.post);
          ids.push(response.id);
          current += 1;
          checkPagination();

          const $new = $container.children('.project').last();

          $wrapper.animate(
            {
              scrollTop: $new.offset().top + $wrapper.scrollTop()
            },
            500
          );

          initPostJS($new);
        }
      });
    });

    checkPagination();
    checkPermission();
  }

  function initSmoothScroll() {
    SmoothScroll({
      animationTime: 500 // [ms]
    });
  }

  /* Trigger resize once */
  function doneResizing() {
    const width = $(window).width();

    if (wWidth !== width) {
      wWidth = width;

      if (controller !== null && controller !== undefined) {
        // completely destroy the controller
        controller = controller.destroy(true);
        if (controller === null || controller === undefined) {
          // reinitialize ScrollMagic only if it is not already initialized
          initSM();
        }
      }

      initCarousel();

      let vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', `${vh}px`);

      /* scrollbar */
      if (wWidth > 767) {
        initSmoothScroll();
      } else {
        if (SmoothScroll) SmoothScroll.destroy();
      }
    }
  }

  $(window).resize(function() {
    clearTimeout(resizeId);
    resizeId = setTimeout(doneResizing, 500);
  });

  globalEvents();

  if (wWidth > 767) {
    initSmoothScroll();
  }

  if (isTouch) {
    $('html').addClass('is-touch');
  }

  /* Init barba */
  barba.hooks.enter(data => {
    return new Promise(resolve => {
      $header.removeClass('is-opened');

      disableScrolling();

      $('.loader').addClass('is-active');

      setTimeout(() => {
        if (controller !== null && controller !== undefined) {
          // completely destroy the controller
          controller = controller.destroy(true);
        }

        resolve();
      }, 400);
    });
  });

  barba.hooks.afterEnter(data => {
    enableScrolling();
    $wrapper.scrollTop(0);
    initJS();

    setTimeout(() => {
      $('.loader').addClass('is-hidden');
      setTimeout(() => {
        $('.loader').removeClass('is-active is-hidden');
      }, 400);
    }, 200);
  });

  barba.init({
    prevent: ({ el }) => el.classList && el.classList.contains('ab-item'),
    views: [
      {
        namespace: 'home',

        beforeLeave() {
          $('.page-header__menu-btn').removeClass(
            'page-header__menu-btn--home'
          );
        },
        afterEnter() {
          if ($('.landing').hasClass('is-active')) {
            disableScrolling();

            $('.page-header__menu-btn').addClass('page-header__menu-btn--home');

            $('.hero--home').addClass('is-animated');

            setTimeout(() => {
              enableScrolling();

              $('.landing').removeClass('is-active');
            }, 4500);
          }
        }
      },
      // {
      //   namespace: 'work-category',
      //   afterEnter() {
      //     $header.addClass('page-header--light');
      //     $('.page-wrapper').addClass('page-wrapper--min');
      //   },
      //   beforeLeave() {
      //     $header.removeClass('page-header--light');
      //     $('.page-wrapper').removeClass('page-wrapper--min');
      //   }
      // },
      {
        namespace: 'work',
        beforeEnter() {
          isWork = true;
          $('.page-wrapper').addClass('page-wrapper--min');
          $header.addClass('page-header--light');
        },
        beforeLeave() {
          isWork = false;
          $header.removeClass('page-header--light');
          $('.page-wrapper').removeClass('page-wrapper--min');
        }
      },
      {
        namespace: 'project',
        beforeEnter() {
          if ($('.project--reverse').length) {
            $header.addClass('page-header--light');
          }
        },
        beforeLeave() {
          $header.removeClass('page-header--light');
        }
      }
    ],
    transitions: [
      {
        name: 'to-studio',
        to: {
          namespace: 'studio'
        },
        leave: () => {
          $('.loader').removeClass('is-right');
        }
      },
      {
        name: 'from-studio',
        from: {
          namespace: 'studio'
        },
        leave: () => {
          $('.loader').addClass('is-right');
        }
      },
      {
        name: 'to-project',
        to: {
          namespace: 'project'
        },
        leave: () => {
          $('.loader').addClass('is-right');
        }
      },
      {
        name: 'from-project',
        from: {
          namespace: 'project'
        },
        leave: () => {
          $('.loader').removeClass('is-right');
        }
      },
      {
        name: 'home-work',
        from: {
          namespace: 'home'
        },
        to: {
          namespace: 'work'
        },
        leave: () => {
          $('.loader').addClass('is-right');
        }
      },
      {
        name: 'home-work',
        from: {
          namespace: 'work'
        },
        to: {
          namespace: 'home'
        },
        leave: () => {
          $('.loader').removeClass('is-right');
        }
      }
    ]
  });
});
