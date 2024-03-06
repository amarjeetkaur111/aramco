(function(){

    var doc = document.documentElement;
    var w = window;
  
    var prevScroll = w.scrollY || doc.scrollTop;
    var curScroll;
    var direction = 0;
    var prevDirection = 0;
  
    var header = document.getElementById('site-header');
  
    var checkScroll = function() {
  
      /*
      ** Find the direction of scroll
      ** 0 - initial, 1 - up, 2 - down
      */
  
      curScroll = w.scrollY || doc.scrollTop;
      if (curScroll > prevScroll) { 
        //scrolled up
        direction = 2;
      }
      else if (curScroll < prevScroll) { 
        //scrolled down
        direction = 1;
      }
  
      if (direction !== prevDirection) {
        toggleHeader(direction, curScroll);
      }
      
      prevScroll = curScroll;
    };
  
    var toggleHeader = function(direction, curScroll) {
      if (direction === 2 && curScroll > 40) { 
        
        //replace 52 with the height of your header in px
  
        // header.classList.add('header--hidden');
        
        prevDirection = direction;
      }
      else if (direction === 1) {
        // header.classList.remove('header--hidden');
       
        prevDirection = direction;
      }

      header.classList.add('header--scrolled');
      
    };
    
    window.addEventListener('scroll', checkScroll);
  


    // window.addEventListener("scroll", function(){
    //     if ($('.main').hasClass('home-page') ) {
    //         if(window.scrollY <= 40){
    //         //user is at the top of the page; no need to show the back to top button
    //         header.classList.add('header--light');
    //         header.classList.remove('header--dark');
    //         } else {
    //         header.classList.add('header--dark');
    //         header.classList.remove('header--light');
    //         }
    //     }
    //   });


  })();

  
  document.addEventListener("DOMContentLoaded", function() {
    var lazyVideos = [].slice.call(document.querySelectorAll("video.lazy"));
  
    if ("IntersectionObserver" in window) {
      var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(video) {
          if (video.isIntersecting) {
            for (var source in video.target.children) {
              var videoSource = video.target.children[source];
              if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                videoSource.src = videoSource.dataset.src;
              }
            }
  
            video.target.load();
            video.target.classList.remove("lazy");
            lazyVideoObserver.unobserve(video.target);
          }
        });
      });
  
      lazyVideos.forEach(function(lazyVideo) {
        lazyVideoObserver.observe(lazyVideo);
      });
    }
  });

  // $('.header__avatar-button-login').on( "click", function() {
  //   $('.membership').addClass('block');
  //   $('body').addClass('show-membership');
  //   // $(".bg-video").get(0).play();    
  //    $(".bg-video").get(0).currentTime = 0;    
  // });
  // $('body').on( "click", ".membership-close", function() {
  //   $('.membership').removeClass('block');
  //   $('body').removeClass('show-membership');
  //   $('#r1').addClass('show');
  //   $('#r2, #r3, #r4').removeClass('show');
  //   $('#r5').addClass('d-none');
  //   // $(".bg-video").get(0).pause();
  //   $(".bg-video").get(0).currentTime = 0;    
  // });
  // $("body").on("click", ".search__modal-close-button", function () {
  //     $(".bg-video-profile").get(0).currentTime = 0;
  // });
  // $("body").on("click", ".header__avatar-button-profile", function () {
  //     $(".bg-video-profile").get(0).currentTime = 0;
  // });

  // $('body').on( "click", ".continue-google", function() {
  //   $('#r1').removeClass('show');
  //   $('#r3').addClass('show');
  // });

  // $('body').on( "click", ".enterKeyBtn", function() {
  //   $('#r3').removeClass('show');
  //   $('#r4').addClass('show');
  //   $('#r5').removeClass('d-none');
  // });

$("body").on("click", ".sideBar-loginBtn", function (e) {
    $(this).parent().find(".close-button").trigger('click');
    if($(".header__avatar-button-login").is(":visible")){
      $(".header__avatar-button-login").trigger("click");
    }   
});


var readURL = (input) => {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          
            $('.profile-pic').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('body').on( "change", ".profile-file-upload", function() {
    readURL(this);
});

$('body').on( "click", ".upload-button", function() {
   $(".profile-file-upload").click();
});

var renderFILES = (input) => {

  if (input.files && input.files[0]) {
    var files = input.files; 
    var fullFilesNames;
    var picReader = new FileReader();
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      if(files.length < 2)
        fullFilesNames = file.name;
      else
        fullFilesNames += file.name + ", ";    
    }
    picReader.readAsDataURL(file);
    $(input).parent(".fileInput-customIcon").children().find('.form-control').val(fullFilesNames);
    autosize( $(input).parent(".fileInput-customIcon").children().find('.form-control'));
  }

}

$('body').on( "change", ".fileInput-control", function(e) {
  renderFILES(this);
});

$('body').on( "click", ".fileInput-customIcon .form-control", function() {
  $(this).parent().parent(".fileInput-customIcon").find('.fileInput-control').click();
  $(this).val('');
  $(this).css('height', 'auto');
  autosize( $(this) );
});
          
function autosize(el){
  setTimeout(function(){
    el.css('height', 'auto');
    el.css('height', el.prop('scrollHeight') + 'px');
  },0);
}

$(document).ready(function() {



  $('.modal').on('shown.bs.modal', function (e) {
    $(this).find('.form-select2').select2({
        dropdownParent: $(this).find('.modal-content')
    });

});

  window.Parsley.on('field:error', function() {
    var element = $(this.$element);
    if ($(this.$element).hasClass('form-select')) {
      $(this.$element).parent('div').addClass('form-select-error');
    } else if ($(this.$element).hasClass('form-check-input')) {
      $(this.$element).parent('div').parent('div').find('.errorMsg').removeClass('d-none');
    }
    $(this.$element).parent('div').find('.errorMsg').removeClass('d-none');
  });
  window.Parsley.on('field:success', function() {
    var element = $(this.$element);
    if ($(this.$element).hasClass('form-select')) {
      $(this.$element).parent('div').removeClass('form-select-error');
    } else if ($(this.$element).hasClass('form-check-input')) {
      $(this.$element).parent('div').parent('div').find('.errorMsg').addClass('d-none');
    }
    $(this.$element).parent('div').find('.errorMsg').addClass('d-none');
  });

});

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));