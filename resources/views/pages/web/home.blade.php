@extends('layouts.web')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('assets/web/css/flickity.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="content-wrap">

    <section class="top-story-slider">
        <div class="carousel carousel--loaded ">

            @foreach($pages as $page)
                <a href="{{ ($page->page_content_exixts == 1) ? route('about-lab', ['pageid'=>$page->pageid]) : "#" }}" class="carousel-cell top-story-slide restrict-content top-story-slide--full-image is-selected">
                    <div class="top-story-slide__media">
                        <picture>
                            <img alt="" class="lazy-slide entered loaded" src="{{ $page->page_banner ?? "" }}" data-flickity-lazyload="{{ $page->page_banner ?? "" }}">
                        </picture>
                    </div>
                    <div class="top-story-slide__content" style="height: 271px;">
                        <div class="top-story-slide__topics top-story-slide__category">
                            <ul class="article-list inview inview--active">
                                <li class="article-list__item">
                                    {{ $page->page_title ?? "" }}
                                </li>
                            </ul>
                        </div>

                        <div class="teaser-text">
                            <div class="top-story-slide__title">
                                {{ $page->page_heading ?? "" }}
                            </div>
                            <div class="top-story-slide__manchet">
                                <p style="margin-right: 0px; margin-left: 0px;">
                                    {!! nl2br($page->page_desc ?? "") !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="shortcut-navigation shortcut-navigation--initialized">

        <div class="shortcut-navigation__wrapper">
            <div class="shortcut-navigation__list">

                <a href="#" link-type="sc_visit" class="userAccess shortcut-navigation__item" data-href="{{route('services-schedule-visit')}}" title="Request a Service" class="shortcut-navigation__item" style="width: 90px;">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.8563 2.125C10.8186 2.11806 8.82373 2.70915 7.11877 3.825L13.9188 10.625C14.1452 10.8182 14.3307 11.0548 14.4644 11.3208C14.598 11.5869 14.677 11.8769 14.6968 12.174C14.7167 12.471 14.6768 12.769 14.5797 13.0504C14.4825 13.3318 14.3301 13.5909 14.1313 13.8125C13.9097 14.0113 13.6506 14.1638 13.3692 14.2609C13.0878 14.358 12.7898 14.3979 12.4927 14.3781C12.1957 14.3583 11.9056 14.2792 11.6396 14.1456C11.3736 14.012 11.137 13.8265 10.9438 13.6L3.93127 6.8C2.71884 8.58408 2.08793 10.6995 2.12502 12.8562C2.13621 15.6989 3.27042 18.4219 5.2805 20.432C7.29057 22.4421 10.0136 23.5763 12.8563 23.5875C13.7866 23.5926 14.7141 23.4856 15.6188 23.2687L22.7375 30.3875C23.7379 31.3879 25.0947 31.9499 26.5094 31.9499C27.9241 31.9499 29.2809 31.3879 30.2813 30.3875C31.2816 29.3871 31.8436 28.0304 31.8436 26.6156C31.8436 25.2009 31.2816 23.8441 30.2813 22.8438L23.1625 15.725C23.3793 14.8203 23.4864 13.8928 23.4813 12.9625C23.5095 11.5494 23.2556 10.1449 22.7343 8.8312C22.213 7.51749 21.4349 6.32098 20.4454 5.31174C19.456 4.3025 18.2751 3.50081 16.972 2.95362C15.6688 2.40642 14.2696 2.12472 12.8563 2.125ZM21.3563 12.8562C21.3547 13.6112 21.2474 14.3623 21.0375 15.0875L20.7188 16.2563L21.5688 17.1062L28.6875 24.225C28.9907 24.512 29.2319 24.858 29.3964 25.2417C29.5608 25.6255 29.645 26.0388 29.6438 26.4562C29.6557 26.8753 29.5764 27.2919 29.4113 27.6771C29.2462 28.0624 28.9992 28.4072 28.6875 28.6875C28.3997 28.9897 28.0536 29.2302 27.67 29.3946C27.2865 29.559 26.8736 29.6437 26.4563 29.6437C26.039 29.6437 25.626 29.559 25.2425 29.3946C24.859 29.2302 24.5128 28.9897 24.225 28.6875L17.1063 21.5687L16.2563 20.7188L15.0875 21.0375C14.3623 21.2474 13.6113 21.3547 12.8563 21.3563C10.5985 21.35 8.42985 20.4749 6.80002 18.9125C5.97579 18.1369 5.32307 17.1974 4.88388 16.1543C4.4447 15.1113 4.22878 13.9878 4.25002 12.8562C4.25149 12.0664 4.35869 11.2802 4.56877 10.5187L9.24377 15.1938C9.6388 15.6236 10.1155 15.9706 10.6459 16.2143C11.1764 16.4581 11.7501 16.5938 12.3336 16.6136C12.9171 16.6334 13.4987 16.5368 14.0445 16.3295C14.5902 16.1222 15.0893 15.8084 15.5125 15.4062C15.9147 14.983 16.2285 14.484 16.4358 13.9382C16.6431 13.3924 16.7397 12.8108 16.7199 12.2273C16.7001 11.6439 16.5644 11.0702 16.3206 10.5397C16.0768 10.0092 15.7299 9.53253 15.3 9.1375L10.625 4.4625C11.3122 4.24517 12.0293 4.1376 12.75 4.14375C15.0078 4.15002 17.1764 5.0251 18.8063 6.5875C20.4376 8.26697 21.352 10.5149 21.3563 12.8562Z" fill="#00A3E0" />
                    </svg>
                    <span>Request a Service</span>
                </a>

                <a href="#" link-type="calendar" class="userAccess shortcut-navigation__item" data-href="{{route('calender-calendar')}}" title="Calender" class="shortcut-navigation__item" style="width: 90px;">
                    <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32 28.6162C31.9975 29.3803 31.6702 30.1125 31.0893 30.6528C30.5085 31.1931 29.7214 31.4976 28.9 31.4999H4.1C3.27858 31.4976 2.49151 31.1931 1.91068 30.6528C1.32985 30.1125 1.00245 29.3803 1 28.6162V8.43015C1.00245 7.66605 1.32985 6.93388 1.91068 6.39358C2.49151 5.85327 3.27858 5.54871 4.1 5.54643H28.9C29.7214 5.54871 30.5085 5.85327 31.0893 6.39358C31.6702 6.93388 31.9975 7.66605 32 8.43015V28.6162Z" stroke="#00A3E0" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M6.64996 3.10465V1.94186C6.64996 1.84897 6.68897 1.74387 6.78505 1.6545C6.88357 1.56285 7.0317 1.5 7.19996 1.5C7.36823 1.5 7.51636 1.56285 7.61487 1.6545C7.71095 1.74387 7.74996 1.84897 7.74996 1.94186V3.10465H6.64996Z" fill="#DADADA" stroke="#00A3E0" stroke-width="2" />
                        <path d="M25.25 3.10465V1.94186C25.25 1.84897 25.289 1.74387 25.3851 1.6545C25.4836 1.56285 25.6317 1.5 25.8 1.5C25.9683 1.5 26.1164 1.56285 26.2149 1.6545C26.311 1.74387 26.35 1.84897 26.35 1.94186V3.10465H25.25Z" fill="#DADADA" stroke="#00A3E0" stroke-width="2" />
                        <path d="M32 14.1974H1" stroke="#00A3E0" stroke-width="2" stroke-miterlimit="10" />
                        <mask id="path-5-inside-1_4539_2946" fill="white">
                            <rect x="20.5184" y="18.8701" width="6.88889" height="6.88889" rx="1" />
                        </mask>
                        <rect x="20.5184" y="18.8701" width="6.88889" height="6.88889" rx="1" stroke="#00A3E0" stroke-width="4" mask="url(#path-5-inside-1_4539_2946)" />
                    </svg>
                    <span>Calender</span>
                </a>

                <a href="#" link-type="connect" class="userAccess shortcut-navigation__item" data-href="{{route('connect-connect')}}" title="Connect" class="shortcut-navigation__item" style="width: 90px;">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.2883 6.26153C27.3011 7.17826 27.0898 8.04688 26.7047 8.86832C26.5967 9.09773 26.5875 9.29199 26.6635 9.52418C26.8885 10.2133 27.1008 10.9062 27.3112 11.6C27.4777 12.1476 27.3075 12.3955 26.7412 12.3872C26.4951 12.3835 26.25 12.303 26.0057 12.2475C25.7395 12.1865 25.4687 12.1319 25.2107 12.0431C24.4175 11.7702 23.6792 11.7554 22.8513 12.0829C21.7462 12.5204 20.5596 12.3946 19.4133 12.1032C19.1672 12.0403 19.0455 12.1014 18.9165 12.3049C18.4847 12.9839 18.0328 13.649 17.5937 14.3233C17.4473 14.5481 17.2771 14.7192 16.9899 14.7044C16.6998 14.6896 16.6038 14.4713 16.5004 14.2419C16.1994 13.5703 15.8847 12.9052 15.5746 12.2373C15.3998 11.8618 15.1913 11.773 14.8134 11.9015C13.1081 12.4862 11.4331 12.4575 9.78999 11.662C9.65001 11.5944 9.46064 11.575 9.30512 11.6018C8.50737 11.7397 7.71419 11.9006 6.91827 12.0514C6.35838 12.1578 6.06289 11.822 6.2486 11.2697C6.49744 10.5279 6.77189 9.79521 7.01433 9.05148C7.0619 8.90532 7.05641 8.70921 7.00061 8.56675C6.11229 6.32814 6.37576 4.21995 7.84135 2.34211C9.30054 0.474438 11.283 -0.240623 13.6122 0.0701927C14.0248 0.124771 14.4191 0.30978 14.8281 0.41246C14.9717 0.448537 15.1455 0.461488 15.2818 0.41431C16.5965 -0.041738 17.9157 -0.0824401 19.2514 0.312555C19.3749 0.349557 19.5258 0.351407 19.6502 0.31903C23.5246 -0.696671 27.3277 2.30141 27.2874 6.26246L27.2883 6.26153ZM17.1042 13.0449C17.4537 12.5167 17.783 12.0468 18.0813 11.5584C18.2652 11.2568 18.4939 11.0847 18.8397 10.983C20.8478 10.3974 22.2887 8.5908 22.4094 6.552C22.5403 4.33096 21.3738 2.35506 19.4389 1.52067C17.4711 0.671474 15.1931 1.1377 13.7751 2.67883C11.3297 5.33834 12.3964 9.71659 15.7896 10.9312C16.0896 11.0385 16.2937 11.2004 16.4172 11.5075C16.6175 12.0079 16.8554 12.4936 17.1051 13.0449H17.1042ZM7.59983 10.8803C7.75353 10.8553 7.86331 10.8414 7.97035 10.8192C8.48449 10.7156 8.99498 10.5871 9.51279 10.5168C9.73326 10.4872 9.98119 10.5436 10.1962 10.6204C10.5813 10.7563 10.9409 10.9709 11.3297 11.0931C12.1485 11.3502 12.9792 11.3437 13.8647 11.1291C12.2573 9.84147 11.391 8.21986 11.38 6.18476C11.369 4.15798 12.2015 2.52064 13.7595 1.23298C12.9956 0.988765 12.0103 1.00727 11.1641 1.2672C8.2201 2.1719 6.76 5.49374 8.07922 8.31236C8.23291 8.63983 8.26127 8.93215 8.13594 9.27071C7.94565 9.78504 7.78829 10.3114 7.60075 10.8803H7.59983ZM26.0258 11.1634C25.8602 10.6259 25.7331 10.1393 25.5583 9.67218C25.4101 9.27441 25.4504 8.9414 25.6453 8.55935C27.1273 5.64915 25.5776 2.16912 22.4424 1.35138C22.0261 1.24315 21.5879 1.22188 21.1597 1.1599C21.1515 1.19135 21.1433 1.22373 21.135 1.25518C22.7406 2.54839 23.5594 4.23291 23.5265 6.30131C23.4935 8.39099 22.532 10.0071 20.8533 11.2679C21.8047 11.353 22.6262 11.1319 23.4322 10.7758C23.6536 10.6777 23.9445 10.6564 24.1833 10.7027C24.7826 10.8192 25.3699 10.995 26.0258 11.1624V11.1634Z" fill="#00A3E0" />
                        <path d="M6.79101 29.0078C4.51487 29.0032 2.51867 28.7294 0.550823 28.2364C0.135481 28.1318 -0.0072359 27.9616 8.29028e-05 27.5324C0.0074017 27.118 -0.00632105 26.6962 0.0696115 26.2928C0.248007 25.3447 0.78228 24.6333 1.61388 24.1597C2.26983 23.786 2.93309 23.4261 3.58995 23.0561C4.2642 22.6768 4.57891 21.8526 4.32641 21.1218C4.29805 21.0404 4.22303 20.9738 4.16174 20.9072C3.09868 19.7657 2.55617 18.3883 2.79495 16.8574C3.01543 15.4402 3.88545 14.4023 5.30347 13.9795C6.68032 13.5688 7.94098 13.8436 8.97476 14.8667C10.0625 15.9434 10.3086 17.2681 9.90974 18.726C9.67462 19.5862 9.24373 20.3374 8.62072 20.9766C8.52283 21.0774 8.48532 21.2467 8.44323 21.391C8.41853 21.4761 8.44781 21.5751 8.43683 21.6667C8.34443 22.452 8.67835 22.9543 9.3901 23.2716C9.97286 23.5316 10.5209 23.8701 11.0899 24.1625C12.2197 24.7434 12.743 25.7017 12.8016 26.9505C12.8126 27.192 12.8089 27.4353 12.8025 27.6776C12.7924 28.08 12.6689 28.2401 12.2783 28.3252C10.3891 28.7387 8.48166 29.0042 6.79101 29.0069V29.0078ZM5.42148 21.8868C5.4288 22.9432 4.85702 23.6537 3.901 24.1245C3.2972 24.4215 2.7181 24.7702 2.1326 25.1032C1.4364 25.4991 1.03569 26.0856 0.999099 26.9117C0.989036 27.1467 1.04301 27.2697 1.29734 27.303C2.67419 27.4843 4.04464 27.7452 5.42697 27.8534C7.44971 28.0116 9.4578 27.772 11.4458 27.3798C11.5363 27.3622 11.6663 27.2151 11.669 27.1245C11.6992 26.2577 11.3644 25.5768 10.5959 25.1523C10.036 24.8433 9.47519 24.5334 8.90066 24.255C7.92817 23.785 7.3509 23.0663 7.37743 21.9331C7.37743 21.9026 7.35914 21.8711 7.36371 21.8859H5.42148V21.8868ZM8.99123 17.9905C8.84668 17.9702 8.73782 17.9489 8.62712 17.9387C7.55308 17.8407 6.50101 17.6686 5.57243 17.0544C5.52395 17.022 5.4407 17.0054 5.38764 17.0239C4.87898 17.2042 4.37307 17.3939 3.8333 17.5928C3.8333 17.6057 3.82599 17.6742 3.83422 17.7408C3.96596 18.7944 4.35477 19.7 5.21839 20.3716C6.08292 21.0441 6.76631 21.0857 7.62078 20.4105C8.38285 19.8083 8.7799 18.9803 8.99123 17.9905ZM4.18003 16.4337C4.48468 16.2635 4.8003 16.1099 5.09214 15.9194C5.47089 15.6724 5.63464 15.6714 5.96491 15.9767C6.80474 16.7538 7.85956 16.7343 8.90981 16.8398C8.66005 15.7575 7.6775 14.9453 6.5989 14.8833C5.51846 14.8213 4.43162 15.4661 4.18003 16.4328V16.4337Z" fill="#00A3E0" />
                        <path d="M27.8784 28.5232C25.7669 28.5204 23.7012 28.192 21.6656 27.6361C21.4012 27.5639 21.2256 27.4187 21.2046 27.1504C21.125 26.1255 21.2128 25.1301 21.9291 24.3226C22.1908 24.0275 22.511 23.7666 22.8458 23.5594C23.467 23.1746 24.1202 22.8434 24.7588 22.4863C25.4476 22.1006 25.7413 21.4355 25.5455 20.6779C25.5199 20.577 25.4238 20.4892 25.3488 20.4068C24.2693 19.2403 23.8055 17.8463 23.9976 16.2783C24.1787 14.802 25.6544 13.4921 27.163 13.3515C30.1143 13.0768 32.0437 15.715 31.0008 18.6011C30.7428 19.3144 30.3531 19.9434 29.8288 20.491C29.731 20.5928 29.6779 20.763 29.6541 20.9091C29.4949 21.8906 29.8773 22.5354 30.8059 22.9063C31.3749 23.1339 31.9074 23.4604 32.4444 23.7638C33.4196 24.3152 33.91 25.1819 33.9887 26.2948C34.007 26.5584 33.9978 26.8248 33.996 27.0903C33.9932 27.5445 33.8643 27.7156 33.4315 27.8202C31.6064 28.2623 29.7575 28.5176 27.8775 28.5232H27.8784ZM22.2191 26.7564C23.2639 26.9386 24.2903 27.1523 25.326 27.291C27.7933 27.6213 30.2387 27.4557 32.6576 26.8646C32.8369 26.8211 32.8963 26.7453 32.8918 26.5612C32.8707 25.7212 32.5322 25.0709 31.793 24.6639C31.1426 24.3059 30.483 23.9664 29.8288 23.6158C29.1144 23.2329 28.6889 22.6427 28.5938 21.824C28.5755 21.6649 28.5737 21.5049 28.5682 21.4022H26.6186C26.6223 22.4697 26.0057 23.1477 25.0588 23.6121C24.4651 23.9035 23.8942 24.243 23.3206 24.5751C22.5247 25.0367 22.1432 25.7286 22.2191 26.7564ZM30.1527 17.5003C30.0438 17.4837 29.9551 17.4652 29.8654 17.4569C28.7795 17.3597 27.7155 17.1904 26.776 16.5697C26.722 16.5337 26.6223 16.5309 26.5573 16.554C26.0578 16.7288 25.5611 16.9139 24.992 17.122C25.0671 17.4476 25.1201 17.8491 25.2537 18.22C25.4961 18.8962 25.884 19.4503 26.4732 19.9138C26.959 20.2958 27.4136 20.491 27.9964 20.3541C29.0238 20.1145 30.0923 18.7057 30.1518 17.5003H30.1527ZM25.3571 15.9509C25.6782 15.7742 26.0084 15.6142 26.3177 15.4181C26.669 15.1951 26.8455 15.1868 27.1374 15.4643C27.9809 16.2672 29.0485 16.245 30.1088 16.356C29.8975 15.3228 28.9378 14.505 27.8702 14.4023C26.7943 14.2987 25.6946 14.9306 25.3561 15.9509H25.3571Z" fill="#00A3E0" />
                        <path d="M17.6165 34.0001C15.4904 34.0001 13.5774 33.8031 11.6874 33.3757C10.9875 33.2175 10.9591 33.1685 10.9372 32.4266C10.9107 31.5265 11.0964 30.6986 11.7102 30.0252C11.9691 29.7421 12.2839 29.4951 12.6105 29.2944C13.2243 28.9188 13.8611 28.5793 14.496 28.2417C15.0449 27.9503 15.3093 27.5285 15.3047 26.8809C15.301 26.4304 15.1766 26.1011 14.8985 25.7404C13.797 24.3102 13.3561 22.7266 14.1401 20.9939C14.8665 19.389 16.7264 18.6082 18.4765 19.1068C20.1452 19.5832 21.2521 21.2409 21.0719 22.9893C20.9438 24.2288 20.4471 25.2862 19.5798 26.1742C19.4755 26.2806 19.4206 26.4619 19.3959 26.6173C19.2449 27.5646 19.6338 28.1714 20.5175 28.5275C21.0756 28.7523 21.5943 29.0798 22.1267 29.3684C23.0992 29.8957 23.6161 30.7319 23.7213 31.8309C23.7515 32.1519 23.7497 32.4766 23.7433 32.7994C23.735 33.2027 23.5941 33.3618 23.2072 33.4331C21.2951 33.7836 19.3712 34.0094 17.6165 33.9992V34.0001ZM22.5896 32.4488C22.7159 31.5497 22.3371 30.7513 21.5769 30.3304C20.9274 29.9706 20.265 29.6339 19.6109 29.2824C18.8378 28.8679 18.3804 28.2389 18.331 27.3361C18.3246 27.2251 18.3091 27.115 18.3017 27.0391H16.3687C16.3915 28.1279 15.7685 28.8393 14.7796 29.3194C14.195 29.6034 13.6351 29.9401 13.0697 30.2648C12.3872 30.657 11.9938 31.2388 11.9417 32.0464C11.928 32.2564 11.9893 32.3535 12.2024 32.397C15.656 33.1148 19.1123 33.0973 22.5896 32.4479V32.4488ZM14.8573 23.1669C15.087 24.2501 15.5572 25.1039 16.408 25.7126C17.0072 26.1409 17.7711 26.1529 18.3374 25.7755C19.3007 25.1317 19.803 24.1983 19.996 23.0734C20.0134 22.9698 20.0061 22.8311 19.9503 22.7515C19.6063 22.2594 19.0354 22.0707 18.4664 22.2687C18.2212 22.3538 17.9815 22.4722 17.762 22.6109C16.8828 23.1641 15.967 23.5101 14.8582 23.1678L14.8573 23.1669ZM19.5276 21.1938C19.5011 21.1234 19.4956 21.0883 19.4764 21.0633C18.8269 20.2447 17.977 19.907 16.9642 20.0846C15.9908 20.2548 15.3349 20.8543 14.9689 21.7821C14.8957 21.968 14.9589 22.0531 15.1281 22.1197C15.7914 22.3778 16.4144 22.2502 16.9889 21.8866C17.7629 21.3973 18.5433 20.969 19.5276 21.1938Z" fill="#00A3E0" />
                        <path d="M17.3686 8.0994C16.5471 8.0994 15.7256 8.10217 14.904 8.09847C14.4978 8.09662 14.2902 7.91254 14.2902 7.56935C14.2902 7.22615 14.496 7.04207 14.904 7.04114C16.5471 7.03837 18.1902 7.03837 19.8323 7.04114C20.2449 7.04114 20.4425 7.21875 20.4425 7.56935C20.4425 7.91994 20.2449 8.09662 19.8332 8.09847C19.0117 8.10217 18.1902 8.0994 17.3686 8.0994Z" fill="#00A3E0" />
                        <path d="M17.3622 4.34925C17.8059 4.34925 18.2496 4.34463 18.6942 4.35018C19.0766 4.3548 19.2696 4.53704 19.2724 4.8756C19.2751 5.2188 19.094 5.40936 18.7061 5.41398C17.8068 5.42416 16.9075 5.42508 16.0091 5.41213C15.6359 5.40658 15.4492 5.19474 15.4639 4.8534C15.4776 4.53149 15.6679 4.35573 16.0302 4.35018C16.4739 4.3437 16.9176 4.34833 17.3622 4.34833V4.34925Z" fill="#00A3E0" />
                    </svg>
                    <span>Connect</span>
                </a>

                <a href="{{route('my-activity')}}" title="My Activity" class="shortcut-navigation__item" style="width: 90px;">
                    <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2791 2.30166C14.3736 2.19242 14.4455 2.06543 14.4905 1.92814C14.5356 1.79082 14.5527 1.64594 14.5411 1.50193C14.5296 1.35791 14.4895 1.21764 14.4232 1.08926C14.3568 0.960902 14.2656 0.84699 14.1549 0.754219C14.0441 0.661448 13.9161 0.591616 13.778 0.548841C13.64 0.506066 13.4948 0.49116 13.351 0.505022C5.87975 1.10036 0 7.35299 0 14.9793C0 22.9991 6.50125 29.5 14.5215 29.5C22.1438 29.5 28.3938 23.6278 28.995 16.1613C29.0088 16.0175 28.994 15.8723 28.9511 15.7344C28.9084 15.5963 28.8386 15.4682 28.7458 15.3574C28.653 15.2468 28.5392 15.1556 28.4108 15.0892C28.2824 15.0229 28.142 14.9828 27.9981 14.9711C27.8541 14.9597 27.7091 14.9768 27.5719 15.0218C27.4345 15.0668 27.3076 15.1387 27.1983 15.2332C27.0891 15.3278 26.9996 15.4431 26.9354 15.5725C26.8711 15.702 26.8334 15.8428 26.824 15.987C26.6315 18.3349 25.7711 20.5785 24.3444 22.4531C22.9176 24.3276 20.9842 25.7548 18.7725 26.566C16.5607 27.3771 14.1629 27.5384 11.8624 27.0309C9.562 26.5233 7.45483 25.368 5.78982 23.7015C4.12481 22.0349 2.97154 19.9266 2.46619 17.6258C1.96083 15.3249 2.12451 12.9275 2.9379 10.7167C3.7513 8.50586 5.18042 6.57394 7.05645 5.14914C8.93252 3.72431 11.1772 2.86611 13.5253 2.67587C13.6695 2.66662 13.8104 2.62878 13.9399 2.56451C14.0693 2.50028 14.1846 2.4109 14.2791 2.30166ZM23.5502 3.98895C23.6931 3.98275 23.8358 4.00478 23.9703 4.05377C24.1047 4.10275 24.2282 4.17775 24.3336 4.27447C24.6444 4.55908 24.9435 4.8582 25.2281 5.1704C25.4114 5.385 25.5042 5.66235 25.4869 5.94399C25.4696 6.22565 25.3439 6.48962 25.1358 6.68029C24.9278 6.87098 24.6539 6.97348 24.3718 6.96622C24.0896 6.95896 23.8214 6.84249 23.6235 6.64135C23.3806 6.37633 23.1261 6.12197 22.8611 5.87901C22.7557 5.78236 22.6702 5.66586 22.6098 5.53619C22.5494 5.40652 22.5149 5.26619 22.5088 5.12325C22.5026 4.98032 22.5247 4.83756 22.5736 4.70312C22.6225 4.56871 22.6976 4.4467 22.7943 4.34127C22.891 4.23577 23.0075 4.15036 23.1372 4.08991C23.2669 4.02946 23.4071 3.99515 23.5502 3.98895Z" fill="#00A3E0" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9002 5.62317L13.9091 5.79997V14.8998H18.0456C18.2874 14.9 18.5202 15.025 18.697 15.25C18.8737 15.4748 18.9812 15.7826 18.9976 16.1112C19.0142 16.4399 18.9385 16.7647 18.7859 17.0202C18.6332 17.2757 18.4151 17.4428 18.1754 17.4876L18.0456 17.4998H12.9546C12.7237 17.4998 12.5007 17.3857 12.3268 17.1788C12.153 16.972 12.04 16.6863 12.0089 16.3749L12 16.1998V5.79997C12 5.4552 12.1005 5.12456 12.2796 4.88076C12.4586 4.63697 12.7014 4.5 12.9546 4.5C13.1852 4.50001 13.4081 4.61379 13.5819 4.82027C13.7558 5.02673 13.8689 5.31197 13.9002 5.62317Z" fill="#00A3E0" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.3044 0.656057C17.3727 0.57773 17.448 0.527639 17.5259 0.508631C17.6037 0.489626 17.6826 0.502079 17.7581 0.545282C18.0483 0.71186 18.3336 0.912203 18.6125 1.1453C18.6873 1.20237 18.7557 1.28944 18.8136 1.40137C18.8716 1.5133 18.9179 1.6478 18.95 1.79689C18.9819 1.94601 18.9989 2.10668 18.9999 2.26942C19.0009 2.43216 18.9858 2.59364 18.9556 2.7443C18.9255 2.89497 18.8808 3.03174 18.8241 3.14654C18.7675 3.26132 18.7002 3.35179 18.6262 3.41259C18.5521 3.47337 18.4728 3.50324 18.393 3.50044C18.3131 3.49762 18.2344 3.46218 18.1614 3.3962C17.9246 3.1985 17.6823 3.02902 17.4359 2.88861C17.3604 2.84556 17.2898 2.77258 17.2282 2.67388C17.1664 2.57517 17.115 2.45266 17.0765 2.31335C17.0381 2.17403 17.0135 2.02065 17.0042 1.86197C16.9949 1.70329 17.001 1.54242 17.0222 1.38855C17.0434 1.23466 17.0791 1.09075 17.1275 0.965054C17.176 0.839372 17.236 0.734369 17.3044 0.656057Z" fill="#00A3E0" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.6904 10.5465C27.5428 10.5162 27.3844 10.5004 27.2244 10.5C27.0644 10.4996 26.9057 10.5148 26.7575 10.5445C26.6094 10.5742 26.4745 10.6179 26.3608 10.6731C26.2473 10.7284 26.1568 10.7941 26.0949 10.8664C26.033 10.9388 26.0007 11.0165 26 11.095C25.9992 11.1734 26.0301 11.2512 26.0907 11.3239C26.2897 11.5618 26.4606 11.8051 26.6024 12.0527C26.6431 12.1296 26.7146 12.2017 26.8129 12.2648C26.9112 12.328 27.0341 12.3809 27.1745 12.4205C27.315 12.46 27.47 12.4855 27.6308 12.4953C27.7915 12.5051 27.9546 12.4992 28.1105 12.4777C28.2666 12.4562 28.4122 12.4197 28.539 12.3704C28.6659 12.3211 28.7715 12.2597 28.8495 12.1901C28.9275 12.1205 28.9763 12.044 28.9932 11.965C29.0101 11.886 28.9949 11.8061 28.9481 11.7301C28.7814 11.4385 28.5808 11.1518 28.347 10.8714C28.2864 10.7988 28.1973 10.7327 28.0847 10.677C27.9719 10.6212 27.8379 10.5769 27.6904 10.5465Z" fill="#00A3E0" />
                    </svg>
                    <span>My Activity</span>
                </a>

            </div>
        </div>
    </section>


    <section>
        <div class="footer-app-promo container">
            <h2>Download D&IT Lab Excellence app today</h2>
            <a href="#" target="_blank" rel="noreferrer" class="footer-app-promo__link">
                <img src="{{asset('assets/web/images/google-play-badge.svg')}}" alt="google-play">
            </a>
            <a href="#" target="_blank" rel="noreferrer" class="footer-app-promo__link">
                <img src="{{asset('assets/web/images/app-store-badge.svg')}}" alt="app-store">
            </a>
        </div>

    </section>



</div>
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/js/flickity.pkgd.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js"></script> -->

<script>
    // external js: flickity.pkgd.js

    // var carousel = document.querySelector('.carousel');
    // var flkty = new Flickity( carousel, {
    //   imagesLoaded: true,
    //   percentPosition: false,
    //   wrapAround: true,
    //   lazyLoad: 1,
    //   prevNextButtons: false,
    //   pageDots: true
    // });

    // var imgs = carousel.querySelectorAll('.carousel-cell img');
    // // get transform property
    // var docStyle = document.documentElement.style;
    // var transformProp = typeof docStyle.transform == 'string' ?
    //   'transform' : 'WebkitTransform';

    // flkty.on( 'scroll', function() {
    //   flkty.slides.forEach( function( slide, i ) {
    //     var img = imgs[i];
    //     var x = ( slide.target + flkty.x ) * -1/3;
    //     img.style[ transformProp ] = 'translateX(' + x  + 'px)';
    //   });
    // });


    $(document).ready(function() {
        if ($('.carousel-cell').length < 2) {
            $('.carousel-cell').removeClass('cell-33');
            $('.carousel-cell').removeClass('cell-50');
            $('.carousel-cell').addClass('cell-100');
        } else if ($('.carousel-cell').length < 3) {
            $('.carousel-cell').removeClass('cell-33');
            $('.carousel-cell').addClass('cell-50');
            $('.carousel-cell').removeClass('cell-100');
        } else if ($('.carousel-cell').length < 4) {
            $('.carousel-cell').addClass('cell-33');
            $('.carousel-cell').removeClass('cell-50');
            $('.carousel-cell').removeClass('cell-100');
        }
    });



    $('.main').addClass('home-page');


    var optionLess2 = {
        imagesLoaded: false,
        percentPosition: true,
        wrapAround: true,
        lazyLoad: 2,
        prevNextButtons: false,
        pageDots: true,
        groupCells: false,
        freeScroll: false,
        cellAlign: 'left',
        contain: true,
    };
    var optionsMore2 = {
        imagesLoaded: true,
        percentPosition: true,
        wrapAround: true,
        lazyLoad: 2,
        prevNextButtons: false,
        pageDots: true,
        groupCells: false,
        freeScroll: false,
        cellAlign: 'left',
    };

    var $carousel = $('.carousel');
    // var slides = document.getElementsByClassName('carousel-cell');

    $(document).ready(function() {
        if ($('.carousel-cell').length < 3) {
            // var flkty = new Flickity(carousel, optionLess2);
            var flkty = $carousel.flickity(optionLess2);
        } else {
            // var flkty = new Flickity(carousel, optionsMore2);
            var flkty = $carousel.flickity(optionsMore2);
        }

    });

    $carousel.on('dragStart.flickity', function(event, pointer) {
        $('.top-story-slider').addClass('translating');
    });
    $carousel.on('dragEnd.flickity', function(event, pointer) {
        $('.top-story-slider').removeClass('translating');
    });



    $(window).on("resize", function() {
        // $carousel.flickity('resize');
        $('.carousel').flickity('resize')
        $('.carousel').flickity('reloadCells')
    });




    // flkty.on('scroll', function () {
    //   flkty.slides.forEach(function (slide, i) {
    //     var image = slide[i];
    //     var x = (slide.target + flkty.x) * -1/3;
    //     console.log(x)
    //     // image.style.backgroundPosition = x + 'px';
    //     // image.style[ transformProp ] = 'translateX(' + x  + 'px)';
    //   });

    // });
</script>
<script>
    // initialize()

    // function constructor(t) {
    //     this.dom = {
    //         container: void 0
    //     }, this.visibleImagesLoaded = () => {
    //         var t = b.a.timeline({
    //             easing: D.a,
    //             duration: y.c
    //         });
    //         if (this.dom.carousel.classList.add("carousel--loaded"), this.isPresenting && t.add({
    //                 targets: Array.from(this.dom.allSlides).slice(0, this.carouselItemsOnScreen),
    //                 scale: [.98, 1],
    //                 opacity: [0, 1],
    //                 delay: b.a.stagger(y.a)
    //             }, 0), this.sneakPeakAnimation && Object(at.b)("sm")) {
    //             var e = this.dom.allSlides[this.carouselItemsOnScreen],
    //                 s = window.getComputedStyle(e).transform,
    //                 a = new WebKitCSSMatrix(s);
    //             t.add({
    //                 targets: this.dom.allSlides[this.carouselItemsOnScreen],
    //                 opacity: [0, 1],
    //                 translateX: [{
    //                     value: a.m41 - 50,
    //                     duration: y.d
    //                 }, {
    //                     value: a.m41,
    //                     duration: y.d
    //                 }],
    //                 begin: () => {
    //                     Object(Wt.b)(this.dom.allSlides[this.carouselItemsOnScreen], {
    //                         zIndex: 5
    //                     })
    //                 },
    //                 complete: () => {
    //                     Object(Wt.b)(this.dom.allSlides[this.carouselItemsOnScreen], {
    //                         zIndex: 1
    //                     })
    //                 }
    //             })
    //         }
    //         this.carouselItemsOnScreen !== this.carouselSlidesCount ? this.isPresenting && t.add({
    //             targets: this.dom.paginationDots,
    //             translateY: [20, 0],
    //             opacity: [0, 1],
    //             delay: b.a.stagger(y.b / 2)
    //         }, 700) : this.pagination.style.display = "none"
    //     },

    // var loadImages = () => {
    //         carousel.querySelectorAll(".lazy-slide:not(.loaded)").length && lazyLoadInstance.loadAll()
    //     }
    // var activateFlickity = () => {
    //         carouselSlidesCount > carouselItemsOnScreen && (flkty.isActive = !0, flkty.draggable = !0, flkty.isDraggable = !0)
    //     }

    //     container = t;
    //     currentAnimationSlide = 0;
    //     currentOffsideSlideIndex = 0;
    //     previousSlide = 0;
    //     lastOffsideIndex = 0;
    //     flktyXisNegative = !1;
    //     var e = document.documentElement.style;
    //     var transformProp = "string" == typeof e.transform ? "transform" : "WebkitTransform";

    //     var carouselItemsOnScreen = 1;
    //     var lazyLoadInstance = void 0;
    //     var lazyCount = 0;
    //     var isPresenting = !0;
    //     var sneakPeakAnimation = !0;

    // // }
    // // function kill() {
    // //     this.flkty.off("scroll"), this.flkty.off("settle"), this.flkty.off("dragStart"), this.flkty.off("dragEnd"), this.flkty.destroy()
    // // }
    // function animateSlide() {
    //     var t = flkty.x,
    //         e = flkty.slides[currentAnimationSlide];
    //     if (e) {
    //         var s = slideImages[currentAnimationSlide],
    //             a = slideTopics[currentAnimationSlide],
    //             i = slideTeaserTexts[currentAnimationSlide],
    //             n = e.target + t;
    //         if (flktyXisNegative) {
    //             var o = allSlides.length - currentAnimationSlide;
    //             n = t - e.outerWidth * o
    //         }
    //         var r = Math.round(-1 * n / 1.8),
    //             c = Math.round(-1.5 * n / 2),
    //             l = Math.round(-1 * n / 3.5);
    //         s.style[transformProp] = "translateX(".concat(r < 0 ? 0 : r, "px)");
    //         a.style[transformProp] = "translateX(".concat(c < 0 ? 0 : c, "px)");
    //         i.style[transformProp] = "translateX(".concat(l < 0 ? 0 : l, "px)");
    //     }
    //     if (lastOffsideIndex = currentOffsideSlideIndex, this.currentAnimationSlide === this.flkty.slides.length - 1 ? this.currentOffsideSlideIndex = 0 : this.currentOffsideSlideIndex = this.currentAnimationSlide + 1, 1 === this.carouselItemsOnScreen) {
    //         var d = this.flkty.slides[this.currentOffsideSlideIndex];
    //         if (d) {
    //             var h = d.target + t;
    //             if (this.flktyXisNegative) {
    //                 var m = this.dom.allSlides.length - this.currentAnimationSlide;
    //                 h = t - e.outerWidth * m + e.outerWidth
    //             }
    //             var u = Math.round(1 * h / 2),
    //                 p = Math.round(1 * h / 3),
    //                 b = this.dom.slideTopics[this.currentOffsideSlideIndex],
    //                 g = this.dom.slideTeaserTexts[this.currentOffsideSlideIndex];
    //             b.style[this.transformProp] = "translateX(".concat(u, "px)"), g.style[this.transformProp] = "translateX(".concat(p, "px)")
    //         }
    //         this.lastOffsideIndex !== this.currentOffsideSlideIndex && (this.dom.slideTopics[this.lastOffsideIndex].style[this.transformProp] = "translateX(0px)", this.dom.slideTeaserTexts[this.lastOffsideIndex].style[this.transformProp] = "translateX(0px)")
    //     }
    //     this.previousSlide !== this.currentAnimationSlide && (this.dom.slideImages[this.previousSlide] && (this.dom.slideImages[this.previousSlide].style[this.transformProp] = "translateX(0px)"), this.dom.slideTeaserTexts[this.previousSlide] && (this.dom.slideTeaserTexts[this.previousSlide].style[this.transformProp] = "translateX(0px)"), this.dom.slideTopics[this.previousSlide] && (this.dom.slideTopics[this.previousSlide].style[this.transformProp] = "translateX(0px)"))
    // }
    // function initialize() {
    //     var carousel = document.querySelector(".carousel");
    //     var slideImages =  carousel.querySelectorAll(".top-story-slide .top-story-slide__media");
    //     var slideTeaserTexts = carousel.querySelectorAll(".top-story-slide .teaser-text");
    //     var slideTopics =  carousel.querySelectorAll(".top-story-slide .top-story-slide__category");
    //     var allSlides =  carousel.querySelectorAll(".top-story-slide");
    //     var slideContents =  carousel.querySelectorAll(".top-story-slide .top-story-slide__content");
    //     var volunteerVisuals =  carousel.querySelectorAll(".volunteer-card__visual > svg");
    //     var pageHeader = document.querySelector("header.header");

    //     var t = 0;
    //     if (pageHeader) {
    //         var e = window.getComputedStyle(pageHeader),
    //             s = parseFloat(e.paddingBottom);
    //         t = pageHeader.clientHeight - s
    //     }
    //     var i = carousel.clientHeight;
    //     var carouselSlidesCount = allSlides.length;

    //     // Object(at.b)("xl") && this.carouselSlidesCount > 3 ? this.carouselItemsOnScreen = 4 :
    //     // Object(at.b)("md") && this.carouselSlidesCount > 2 ? this.carouselItemsOnScreen = 3 :
    //     // Object(at.b)("sm") && (this.carouselItemsOnScreen = 2);

    //     var n = carousel.clientWidth;
    //     var o = 0;

    //     // Object(a.a)(this.dom.allSlides, t => {
    //     //     1 === this.carouselItemsOnScreen ? t.style.width = "".concat(n, "px") : this.carouselSlidesCount === this.carouselItemsOnScreen ? t.style.width = "".concat(n / this.carouselItemsOnScreen, "px") : this.carouselSlidesCount < this.carouselItemsOnScreen ? t.style.width = "".concat(n / this.carouselSlidesCount, "px") : t.style.width = "".concat(n / this.carouselItemsOnScreen - 10, "px"), t.querySelector(".top-story-slide__content").clientHeight > o && (o = t.querySelector(".top-story-slide__content").clientHeight)
    //     // }),
    //     // Object(a.a)(this.dom.slideContents, t => {
    //     //     t.style.height = "".concat(o, "px")
    //     // }), Object(a.a)(this.dom.volunteerVisuals, e => {
    //     //     e.style.top = t, e.style.height = i - o - t
    //     // }),

    //     // carouselSlidesCount ===  carouselItemsOnScreen && (this.sneakPeakAnimation = !1);
    //     var r = {
    //         contain: !0,
    //         cellAlign: "left",
    //         wrapAround: !0,
    //         prevNextButtons: !1,
    //         lazyLoad: this.carouselItemsOnScreen,
    //         pageDots: !0,
    //         percentPosition: !1,
    //         // on: {
    //         //     ready: () => {
    //         //         var pagination = carousel.querySelector(".flickity-page-dots");
    //         //         this.dom.paginationDots = this.dom.carousel.querySelectorAll(".flickity-page-dots .dot");
    //         //         var t = this;
    //         //         this.lazyLoadInstance = new _.a({
    //         //             elements_selector: ".lazy-slide",
    //         //             callback_loaded: function(e) {
    //         //                 Tt ? t.dom.carousel.classList.add("carousel--loaded") : Array.from(t.dom.allSlides).indexOf(e.closest(".top-story-slide")) + 1 + t.dom.volunteerVisuals.length >= t.carouselItemsOnScreen && t.visibleImagesLoaded()
    //         //             },
    //         //             callback_error: this.visibleImagesLoaded
    //         //         })
    //         //     },
    //         //     dragStart: () => {
    //         //         this.dom.carousel.querySelectorAll(".lazy-slide:not(.loaded)").length && (this.isPresenting = !1, this.lazyLoadInstance.loadAll()), this.dom.container.classList.add("translating")
    //         //     },
    //         //     dragEnd: () => {
    //         //         this.dom.container.classList.remove("translating")
    //         //     },
    //         //     settle: () => {
    //         //         this.dom.container.classList.remove("translating")
    //         //     }
    //         // }
    //     };
    //     // Object(at.b)("lg") && (r.freeScroll = !0),

    //    var flkty = new Flickity(carousel, r);
    //        flkty.isActive = !1;
    //        flkty.draggable = !1;
    //        flkty.isDraggable = !1;
    //     //    carouselItemsOnScreen !== this.carouselSlidesCount && (this.activateFlickity(), this.flkty.once("staticClick", this.loadImages),

    //        flkty.on("scroll", (t, e) => {
    //         previousSlide = currentAnimationSlide;
    //         var s = 1 === carouselItemsOnScreen ? flkty.size.width : flkty.size.width - 10 * carouselItemsOnScreen;
    //         var a = Math.round(e / (s / carouselItemsOnScreen) * 100);
    //         var i = Math.floor(a / 100); - 1 === Math.sign(a) ? (flktyXisNegative = !0, currentAnimationSlide = carouselSlidesCount - Math.abs(i)) : (flktyXisNegative = !1, currentAnimationSlide = i > carouselSlidesCount ? carouselSlidesCount : i);
    //         animateSlide()
    //     });
    // }
</script>
@auth
<script>
    function startFCM() {

        firebase.initializeApp(firebaseConfig);
                                    const messaging = firebase.messaging();
        messaging.requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("fcmToken") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        // alert('Token stored.');
                        console.log('Token stored.');
                    },
                    error: function(error) {
                        alert(error);
                    },
                });
            }).catch(function(error) {
                alert(error);
            });
    }
    // startFCM();
</script>
@endauth
@endpush
