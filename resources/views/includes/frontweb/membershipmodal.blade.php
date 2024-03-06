<div class="membership">
  <video class="lazy-video-landscape lazy bg-video" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" loop="" autoplay="" playsinline="" muted="">
    <source type="video/mp4" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" >
  </video>
  <!-- <video class="lazy-video-portrait lazy" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" loop="" autoplay="" playsinline="" muted="">
    <source type="video/mp4" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}">
  </video> -->
  <form class="membership__content scrollable">
    <div class="membership-header">
      <button type="button" class="membership-close">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L17.7071 16.2929C18.0976 16.6834 18.0976 17.3166 17.7071 17.7071C17.3166 18.0976 16.6834 18.0976 16.2929 17.7071L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#00A3E0"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7071 0.292893C18.0976 0.683417 18.0976 1.31658 17.7071 1.70711L1.70711 17.7071C1.31658 18.0976 0.683417 18.0976 0.292893 17.7071C-0.0976311 17.3166 -0.0976311 16.6834 0.292893 16.2929L16.2929 0.292893C16.6834 -0.0976311 17.3166 -0.0976311 17.7071 0.292893Z" fill="#00A3E0"/>
        </svg>
        <span>close</span></button>
    </div>
    <div class="membership-body flex-grow-1">
      <h2 class="membership-header__title animate-fade">Register</h2>

      <div class="membership_content_container animate-fade show"  id="r1">
        <button type="button" class="btn continue-google">
        <img src="{{asset('assets/web/images/google.svg')}}" class="img-fluid" />
        <span>Continue with Google</span></button>
      </div>

      <div class="membership_whitesmall_container" id="r3">
        <div class="google_authenticator mb-4">
        <img src="{{asset('assets/web/images/google_authenticator_icon.svg')}}" class="img-fluid" />
        </div>
        <p class="mb-4">Please copy this secret code and enter it in Google authenticator app</p>
        <p class="w-100 d-flex align-items-center justify-content-center gap-3 text-grey mb-5 fs-5">
          <img src="{{asset('assets/web/images/warning.svg')}}" />
          <span>Do not share this code and care of loosing it</span>
        </p>
        <form class="m-0">
          <p class="text-grey mb-2">Secret Key</p>
          <p class="secret-key mb-5 text-break">FLFFOSEUXDSFV2HCQW6UHTQ5TBLSJM57</p>        
          <div class="mb-4">
            <input type="text" class="form-control w-100" placeholder="Enter 6-Digit Code">
          </div>
          <button type="button" class="btn btn-primary w-100 enterKeyBtn">Approve</button>
        </form>
      </div>

      <div class="membership_whitesmall_container" id="r4">
        <div class="google_authenticator mb-3">
        <img src="{{asset('assets/web/images/google_authenticator_icon.svg')}}" class="img-fluid" />
        </div>
        <p class="mb-5">Please copy this secret code and enter it in Google authenticator app</p>
        <form class="m-0">
          <p class="mb-4">Secret Key</p>
          <div class="mb-4">
            <input type="text" class="form-control w-100" placeholder="Enter 6-Digit Code">
          </div>
          <button type="button" class="btn btn-primary w-100">Approve</button>
        </form>
      </div>
      <div class="w-100 text-center pt-5 d-none" id="r5">
        <a class="text-white text-decoration-underline" href="#">Secret code missing? Recover it</a>
      </div>

      
    </div>
    
  </form>
</div>