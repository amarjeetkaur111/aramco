@extends('layouts.web')
@section('content')
<link rel="stylesheet" href="{{asset('assets/web/plugins/slick-1.8.1/slick/slick.css')}}" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />

<nav class="breadcrumb mb-0">
    <ol class="container">
        <li><span aria-current="page">Terms and conditions</span></li>
    </ol>
</nav>
<div class="header-slim header-slim--gradient">
    <div class="background-images">
    </div>
    <div class="container container--anniversary container--anniversary-offset parallax"
        style="will-change: transform, opacity; transform: translateY(0px); opacity: 1;"><svg
            id="uuid-854f63e2-25fd-4153-a2b8-1548872d53b4" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 103.67 101.53">
            <path
                d="m52.21,2.09l.19,3.58-1.31.07-.18-3.47c-.04-.78-.65-1-1.18-.97-.24.01-.53.08-.8.19.05.19.09.42.1.77l.19,3.58-1.31.07-.18-3.47c-.04-.79-.51-1-1.15-.97-.3.02-.67.09-.96.2l.23,4.34-1.31.07-.29-5.44c.86-.26,1.59-.43,2.44-.47.6-.03,1.03.04,1.48.29.51-.28,1.13-.43,1.76-.46.86-.04,1.37.15,1.75.55.35.37.49.8.53,1.54Z"
                fill="#FFFFFF"></path>
            <path
                d="m40.09,1.13c-1.76.36-2.58,1.6-2.21,3.42h0c.38,1.82,1.62,2.62,3.35,2.26l2.77-.57-.59-2.86c-.38-1.83-1.59-2.61-3.33-2.25Zm2.03,2.52l.33,1.57h0l-1.48.3c-.91.19-1.57-.24-1.77-1.24-.21-1.02.23-1.66,1.16-1.86.93-.19,1.55.2,1.76,1.22Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m33.84,5.91c-.59-1.81.16-3.15,1.88-3.7.24-.08.5-.14.86-.19l.11,1.32c-.25.05-.56.12-.72.17-.94.3-1.15,1.13-.86,2.01l.87,2.69-1.25.4-.88-2.71h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m29.2,4.64c-1.64.73-2.18,2.11-1.41,3.81h0c.76,1.7,2.14,2.21,3.76,1.49l2.59-1.15-1.2-2.66c-.77-1.7-2.12-2.21-3.74-1.49Zm3.18,3.49l-.66-1.46c-.43-.95-1.11-1.21-1.98-.82-.87.39-1.16,1.11-.73,2.06.42.93,1.15,1.21,2,.83l1.38-.61Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m21.5,7.47c-.27-.42-.16-.87.25-1.13.41-.26.86-.15,1.12.27.27.42.17.88-.24,1.13-.41.26-.87.15-1.14-.28Z"
                fill="#FFFFFF"></path>
            <path d="m22.34,8.51l1.11-.7,3,4.78-1.11.7-3-4.78Z" fill="#FFFFFF"></path>
            <path
                d="m24.57,13.71l-5.06-6.66h0s0,0,0,0c-.45.38-.99.83-.84,1.08l1.53,2.01c-.43.06-.89.26-1.36.61-1.41,1.06-1.57,2.47-.44,3.95,1.15,1.51,2.53,1.75,3.93.7l2.25-1.7Zm-1.86-.24l-1.19.9c-.72.54-1.39.42-2.06-.46-.63-.83-.57-1.53.18-2.09.86-.65,1.61-.28,2.24.55l.84,1.11Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m45.25,41.18l-4.09-9.76c-2.77-6.59-1.46-13.86,2.78-19.04-2.74.51-5.46,1.3-8.13,2.41-12.42,5.17-20.84,15.85-23.6,28.01,2.26-2.65,5.42-4.86,9.45-6.54,9.75-4.06,18.03-2.38,23.6,4.92Z"
                fill="#FFFFFF"></path>
            <path
                d="m38.62,51.71c-2.55-6.09-7.39-7.95-13.33-5.48-6.01,2.5-8.14,7.38-5.59,13.48,2.54,6.06,7.48,7.96,13.42,5.49l9.5-3.96-4-9.53h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m80.78,63.46l-4.95,2.06c-8.56,3.56-18.26.34-23.08-7.21.19,1.43.24,2.87.12,4.32l-1.93,23.98c.09,1.74-.38,3.41-1.27,4.82,5.65.23,11.44-.74,17-3.05,15.09-6.28,24.27-20.69,24.59-35.99-1.7,4.83-5.37,8.95-10.48,11.08h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m18.19,74.1c5.24,3.58,11.93,3.88,19.4.77h0s3.76-1.56,3.76-1.56l-1.5,16.5c-8.66-2.56-16.39-8-21.67-15.71Z"
                fill="#FFFFFF"></path>
            <path
                d="m56.84,16.1l1.96-.82h0c4.99-2.07,10.73.27,12.81,5.24l8.81,21c2.08,4.97-.27,10.68-5.26,12.76l-1.96.81c-4.99,2.07-10.72-.27-12.81-5.24l-8.81-21c-2.09-4.97.27-10.68,5.26-12.76Zm9.27,24.57l-.46-1.1-.27.11c-.83.31-1.43,0-1.84-.98l-1.61-3.84.96-.4-.46-1.08-.96.4-.69-1.63-.05.03c-.48.24-1.05.51-.98.76l.56,1.33-.64.26.46,1.08.64-.26,1.62,3.87c.75,1.77,1.78,2.26,3.51,1.54l.22-.09Zm6.51-2.71l1.16-.48h0s-2-4.77-2-4.77c-.84-1.99-2.19-2.54-4.24-1.7-.68.28-1.36.68-2.04,1.22l-1.56-3.73-.06.03c-.48.23-1.04.51-.97.76l4.54,10.81,1.16-.48-2.61-6.22c.55-.51,1.23-.93,1.81-1.17,1.31-.54,2.29-.29,2.89,1.12l1.93,4.61Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m9.54,29.39l-1.14-.72s.09-.05.13-.08c.39-.24.84-.51,1.31-1.25.42-.67.53-1.18.17-1.4-.26-.16-.53.11-.91.49-.14.14-.29.3-.47.45-.52.46-1.32,1.02-2.16.49-.95-.59-1.07-1.65-.31-2.86.27-.42.76-.87,1.32-1.22l.89.92c-.37.12-.78.5-1.11,1.02-.3.47-.29.88-.08,1.01.3.19.78-.29,1.19-.71.08-.08.16-.16.23-.23.6-.57,1.24-1.05,2.11-.51,1,.62,1,2,.22,3.24-.43.68-.9,1.04-1.4,1.34h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m9.69,19.62c-1.13,1.39-.98,2.87.48,4.04,1.45,1.16,2.92,1,4.03-.38l1.78-2.2-2.28-1.83c-1.46-1.17-2.89-1.01-4,.37Zm4.43,1.67l-1.25-1.01c-.81-.65-1.54-.57-2.14.17-.6.74-.53,1.52.29,2.17.8.64,1.58.56,2.16-.17l.94-1.17Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m14.84,19.28l-2.5-2.57.95-.92,2.43,2.5c.42.43.99.39,1.51-.11.52-.5.57-1.05.15-1.49l-2.43-2.5.95-.92,2.5,2.57c.96.98.86,2.2-.25,3.28-1.13,1.09-2.36,1.15-3.31.16h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m56.22.28c-1.83-.16-3.01.85-3.18,2.75h0c-.16,1.86.81,2.96,2.58,3.12.85.07,1.54-.12,2-.51l-.64-1.04c-.35.19-.67.29-1.09.25-.96-.08-1.47-.73-1.38-1.76.09-1.04.71-1.58,1.67-1.5.46.04.82.21,1.07.46l.72-1.05c-.44-.4-.95-.66-1.75-.73Z"
                fill="#FFFFFF"></path>
            <path
                d="m58.44,3.42c.36-1.73,1.75-2.64,3.45-2.29,1.7.35,2.59,1.73,2.23,3.47-.36,1.74-1.74,2.67-3.44,2.32-1.71-.35-2.6-1.76-2.24-3.5Zm4.37.9c.2-.96-.28-1.72-1.19-1.91-.92-.19-1.67.32-1.87,1.27-.2.98.27,1.75,1.2,1.94.91.19,1.66-.33,1.86-1.31Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m70.75,3.82c-1.63-.65-2.92-.07-3.63,1.7-.69,1.72-.16,3.01,1.46,3.65l2.52,1.01,1.07-2.66c.71-1.77.2-3.06-1.41-3.71Zm.61,3.39l-.75,1.86h0l-1.72-.69c-1.11-.44-1.47-1.32-.98-2.54.51-1.27,1.4-1.68,2.52-1.23,1.11.45,1.44,1.33.93,2.6Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m74.29,5.81c.8.11,1.69.42,2.35.78,1.32.72,1.58,1.68.86,2.99l-1.73,3.14-.75-.41,1.67-3.03c.51-.93.26-1.59-.58-2.07-.36-.2-.89-.38-1.39-.44l-2.28,4.14-.75-.41,2.58-4.69h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m81.72,9.76c-.62-.43-1.48-.84-2.25-1.04h0s-3.1,4.37-3.1,4.37l.69.49,2.73-3.86c.49.12.99.36,1.33.59.77.57.95,1.26.34,2.13l-2,2.83.69.49,2.07-2.92c.87-1.22.72-2.2-.51-3.07Z"
                fill="#FFFFFF"></path>
            <path d="m84.45,12.04l.65.54-3.61,4.33-.65-.54,3.61-4.33Z" fill="#FFFFFF"></path>
            <path d="m85.22,10.93c.21-.26.52-.28.77-.07.25.21.29.5.07.76-.22.27-.53.31-.79.1-.25-.21-.28-.53-.06-.79Z"
                fill="#FFFFFF"></path>
            <path d="m84.21,19.39l5.5-2.54-.69-.67-4.27,2,1.88-4.31-.7-.68-2.4,5.54.69.66Z" fill="#FFFFFF"></path>
            <path
                d="m91.32,23.73l-2.9-3.57c-.81.79-.86,1.73-.16,2.6.58.71,1.34,1.02,2.06.83v.84c-.98.21-2-.23-2.75-1.17-1.09-1.34-.89-2.82.54-3.97,1.46-1.18,2.97-1.08,4.06.26,1.2,1.48.75,3.09-.86,4.17Zm-2.33-4.01l2.36,2.9c.77-.79.84-1.71.17-2.53-.68-.83-1.59-.95-2.53-.37h0Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m96.12,25.1c-1.04-1.61-2.5-1.81-4.05-.82h0l-2.4,1.54.46.71,2.46-1.57c1-.64,2.06-.55,2.73.48.11.18.27.45.39.7l.81-.28c-.12-.29-.23-.53-.38-.76Z"
                fill="#FFFFFF"></path>
            <path
                d="m92.2,28.93l.82-.41c-.08.66-.03,1.24.34,1.96.45.87,1.01,1.25,1.56.98.51-.26.32-.96.16-1.54-.04-.13-.07-.26-.1-.37,0-.04-.02-.08-.03-.12h0c-.13-.56-.38-1.56.6-2.06,1.03-.53,1.87-.06,2.48,1.12.23.44.36.97.39,1.63l-.83.13c.05-.43-.11-.95-.35-1.4-.35-.69-.77-.98-1.3-.72-.53.27-.3,1.03-.14,1.57.03.08.05.16.07.24.17.64.46,1.75-.56,2.27-1,.51-2.06-.06-2.73-1.35-.33-.64-.46-1.26-.39-1.94h0Z"
                fill="#FFFFFF"></path>
            <path
                d="m100.41,33.91c-.61-1.64-1.92-2.2-3.71-1.53h0c-1.75.65-2.34,1.91-1.73,3.54l.95,2.53,2.69-1c1.8-.67,2.41-1.91,1.81-3.54Zm-2.1,2.74l-1.89.7h0s-.65-1.73-.65-1.73c-.42-1.12,0-1.97,1.23-2.43,1.29-.48,2.18-.1,2.61,1.03.42,1.12-.01,1.96-1.3,2.43Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m98.83,38.44c1.79-.45,3.11.22,3.57,2.07.07.26.1.53.12.84h-.85c-.04-.27-.09-.58-.14-.79-.3-1.19-1.28-1.61-2.43-1.32l-2.83.71-.21-.82,2.77-.69Z"
                fill="#FFFFFF"></path>
            <path
                d="m94.95,44.48c.06.4.11.83.38.86h0s8.03,1.83,8.03,1.83l-.14-.94-4.63-1.01,4.17-2.26-.14-.96-5.3,2.94-2.38-.53v.08Z"
                fill="#FFFFFF"></path>
            <path
                d="m98.63,54.97l-.85-.02.1-3.89.66.02c.22.28.41.54.6.79,1.11,1.47,1.69,2.25,2.54,2.27.66.02,1.11-.45,1.13-1.17.02-.61-.29-1.11-.75-1.37l.4-.59c.73.31,1.23,1.04,1.21,2.01-.03,1.17-.81,1.99-1.94,1.96-1.15-.03-1.86-.9-2.95-2.24l-.09-.11-.06,2.35Z"
                fill="#FFFFFF"></path>
            <path
                d="m103.2,58.76c.21-1.55-.82-2.73-2.59-2.98-1.76-.24-3.08.63-3.29,2.18-.21,1.55.82,2.75,2.58,2.98,1.77.24,3.09-.64,3.3-2.19Zm-.85-.11c-.15,1.05-1.07,1.62-2.33,1.45-1.25-.17-1.99-.97-1.84-2.02.14-1.04,1.06-1.62,2.32-1.45,1.26.17,2,.98,1.86,2.01Z"
                fill="#FFFFFF" fill-rule="evenodd"></path>
            <path
                d="m96.79,65.1l.58-2.28.07.13c.76,1.55,1.26,2.55,2.37,2.83,1.1.28,2.04-.35,2.33-1.49.23-.93-.08-1.75-.73-2.22l-.53.49c.39.36.58.91.43,1.5-.18.7-.72,1.05-1.36.89-.82-.21-1.22-1.09-1.97-2.77-.13-.28-.26-.58-.41-.9l-.64-.16-.95,3.77.82.2Z"
                fill="#FFFFFF"></path>
            <path
                d="m93.66,66.54c-.53,1.43.23,2.89,1.65,3.41h0c1.04.38,2.03.11,2.73-.57l1.73,1.7,1.27-3.43-.81-.3-.83,2.25-1.49-1.48c-.57.87-1.33,1.38-2.34,1.01-1.01-.37-1.46-1.29-1.09-2.3.21-.57.56-.87,1.02-1.06l-.4-.73c-.64.28-1.15.77-1.42,1.5Z"
                fill="#FFFFFF"></path>
            <path
                d="m6.36,31.17c-2.64,5.98-4.11,12.59-4.11,19.55,0,26.82,21.83,48.56,48.76,48.56,18.97,0,35.4-10.78,43.47-26.53l2,1.03c-8.44,16.47-25.63,27.75-45.47,27.75C22.85,101.53,0,78.79,0,50.72c0-7.28,1.54-14.2,4.31-20.46l2.06.91Z"
                fill="#FFFFFF" fill-rule="evenodd" isolation="isolate" opacity=".25"></path>
        </svg></div>
    <div class="container header-slim__content">
        <div class="row col-lg-10">
            <div class="header-slim__page-title">Terms and conditions</div>
            <div class="header-slim__sub-title">Website information</div>
        </div>
    </div>
</div>
<div class="container min-vh-70">
    <!-- <p class="pagesubheading mt-4 mb-2  justify-content-center">Website information</p> -->
    <div class="row">
        <!-- <div class="col-12">
            <p class="aboutHeading justify-content-center my-4 mt-2">Terms and conditions</p>
        </div> -->

        <div class="col-12 py-3 mt-1">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="privacyTerm-text">
                        <h4>Legal notice</h4>
                        <p>Saudi Arabian Oil Company (“Saudi Aramco”), is a Saudi joint stock company established in the
                            Kingdom of Saudi Arabia by virtue of Royal Decree No. M/8, dated 4/4/1409H (corresponding
                            13/11/1988G) with fully paid capital of SAR 60,000,000,000 and registered in the city of
                            Dhahran under commercial registration no 2052101150.&nbsp;</p>
                        <p>Saudi Aramco owns and operates this website (saudiaramco.com) (“Site”) and related mobile
                            applications. Before using our Site, please read these terms carefully.&nbsp;&nbsp;<br>
                            By using this Site, you signify your agreement to these terms of use. If you do not agree to
                            these terms of use, please do not use this Site or any of the affiliated mobile
                            applications. This includes downloading and installing on your device. Saudi Aramco may
                            modify these terms of use, as it deems necessary, at any time and without notice.</p>
                        <h4>About saudiaramco.com</h4>
                        <p>Saudiaramco.com gives you information about us and about the other companies in our group
                            together with the services they offer. The Site is an information source. You cannot
                            purchase products or services from our Site directly.&nbsp;<br>
                            All products and services provided by members of the Saudi Aramco Group of companies are
                            subject to the terms and conditions and disclaimers of the applicable agreement governing
                            their supply and use.</p>
                        <h4>Local websites</h4>
                        <p>Your use of any website of another Saudi Aramco Group member (“Local Website”) shall be
                            governed by both these terms and the terms and conditions of the Local Website. However,
                            where these terms conflict with those of the Local Website, the terms and conditions of the
                            Local Website shall prevail. Please read carefully any Local Website terms and conditions
                            before using the Local Website.</p>
                        <h4>Links to other websites</h4>
                        <p>For your convenience, this Site may contain links to other websites, including some sites
                            administered by Saudi Aramco, or administered by other companies on behalf of Saudi Aramco,
                            as well as to sites unrelated to Saudi Aramco. Each website should be checked for its own
                            terms and conditions of use and privacy statement advising you it uses your personal
                            information. Saudi Aramco is not responsible for the privacy practices or the content of
                            linked websites that are not administered by or on behalf of Saudi Aramco.<br>
                            A link on this Site to any other website not administered by or on behalf of Saudi Aramco
                            does not imply (1) that Saudi Aramco agrees with or endorses the information, data or
                            representations contained therein; (2) that Saudi Aramco sponsors, endorses, or is
                            affiliated with or otherwise connected with such site, or with the company(ies) that operate
                            it; or (3) that Saudi Aramco has authorized the linked site to use any names, logos and
                            trademarks or copyrighted material of Saudi Aramco or its affiliates.</p>
                        <h4>Privacy and personal information</h4>
                        <p>We take usage of personal information very seriously.&nbsp; We understand that you will want
                            to know how we use your personal information.&nbsp; Our <a
                                href="{{ route('privacy') }}">privacy notice</a>&nbsp;sets out information about how
                            we use your personal information.&nbsp; This may be updated from time to time and we would
                            recommend you review this regularly and in the event of any changes.</p>
                        <h4>Disclaimer</h4>
                        <p>The materials in this website are provided "as is" and without warranties of any kind, either
                            express or implied. To the fullest extent permissible pursuant to applicable law, Saudi
                            Aramco disclaims all warranties, express or implied, including, but not limited to, implied
                            warranties of merchantability and fitness for a particular purpose.</p>
                        <p>Saudi Aramco does not warrant that the functions contained in the materials will be
                            uninterrupted or error-free, that defects will be corrected, or that this Site or the server
                            that makes it available are free of viruses or other harmful components.</p>
                        <p>Saudi Aramco does not warrant or make any representations regarding the use or the results of
                            the use of the materials in this website in terms of their correctness, accuracy,
                            reliability, or otherwise. You (and not Saudi Aramco) assume the entire cost of all
                            necessary servicing, repair or correction. Neither Saudi Aramco nor any of its affiliates
                            shall be liable for any direct, indirect, incidental, consequential, or punitive damages
                            arising out of or in any way connected with accessing or using any content on this website
                            or any content on any website or websites linked to this Site.</p>
                        <p>Saudi Aramco reserves the right to make changes to this website and to the representations
                            included as part of the website at any time without notice.</p>
                        <h4>Ownership of the copyright of this website</h4>
                        <p>All copyright in the text, graphics, user interfaces, visual interfaces, photographs,
                            trademarks, logos, sounds, music, artwork, any downloads and computer code (collectively,
                            "Content"), including but not limited to the design, structure, selection, coordination,
                            expression, "look and feel" and arrangement of such Content, contained on the Site is owned,
                            controlled or licensed by or to Saudi Aramco or its subsidiaries, and is protected by trade
                            dress, copyright, patent and trademark laws, and various other intellectual property rights
                            and unfair competition laws.&nbsp; All rights reserved.</p>
                        <p>Except as expressly provided in these Terms of Use, no part of the Site and no Content may be
                            copied, reproduced, republished, uploaded, posted, publicly displayed, encoded, translated,
                            transmitted or distributed in any way (including "mirroring") to any other computer, server,
                            website or other medium for publication or distribution or for any commercial enterprise,
                            without Saudi Aramco’s express prior written consent.</p>
                        <p>You may use information on Saudi Aramco products and services (such as data sheets, knowledge
                            base articles, and similar materials) purposely made available by Saudi Aramco for
                            downloading from the Site, provided that you (1) not remove any proprietary notice language
                            in all copies of such documents, (2) use such information only for your personal,
                            non-commercial informational purpose and do not copy or post such information on any
                            networked computer or broadcast it in any media (unless otherwise stated explicitly on the
                            Site), (3) make no modifications to any such information, and (4) not make any additional
                            representations or warranties relating to such documents.</p>
                        <h4>Ownership of trademarks</h4>
                        <p>ARAMCO, SAUDI ARAMCO, the ENERGY BURST logo, and WHERE ENERGY IS OPPORTUNITY are trademarks
                            of Saudi Arabian Oil Company.</p>
                        <h4>Applicable law</h4>
                        <p>The Kingdom of Saudi Arabia shall have non-exclusive jurisdiction over any dispute arising
                            out of your use of this service.&nbsp; Saudi Aramco reserves the right to bring proceedings
                            to the courts of the country of your location.<br>
                            In the event that any or any part of the terms contained in these terms and conditions shall
                            be determined by any competent authority to be invalid, unlawful or unenforceable to any
                            extent, such term shall to that extent be severed from the remaining terms which shall
                            continue to be valid and enforceable to the fullest extent permitted by law.&nbsp;</p>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@push('custom-scripts')
<script>
$('.header').removeClass('header--light');
$('.header').addClass('header--dark');
</script>
@endpush