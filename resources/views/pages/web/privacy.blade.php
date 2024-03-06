@extends('layouts.web')
@section('content')
<link rel="stylesheet" href="{{asset('assets/web/plugins/slick-1.8.1/slick/slick.css')}}" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />

<nav class="breadcrumb mb-0">
    <ol class="container">
        <li><span aria-current="page">Privacy statement</span></li>
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
            <div class="header-slim__page-title">Privacy statement</div>
            <div class="header-slim__sub-title">Website information</div>
        </div>
    </div>
</div>
<div class="container min-vh-70">
    <!-- <p class="pagesubheading mt-4 mb-2  justify-content-center">Website information</p> -->
    <div class="row">
        <!-- <div class="col-12">
            <p class="aboutHeading justify-content-center my-4 mt-2">Privacy statement</p>
        </div> -->

        <div class="col-12 py-3 mt-1">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="privacyTerm-text">
                        <p>Saudi Arabian Oil Company (“Saudi Aramco”), is a Saudi joint stock company established in the
                            Kingdom of Saudi Arabia (the “Kingdom”) by virtue of Royal Decree No. M/8, dated 4/4/1409H
                            (corresponding 13/11/1988G) and registered in the city of Dhahran under commercial
                            registration no 2052101150.</p>
                        <p>Saudi Aramco, together with its subsidiaries and controlled affiliates (together the “Saudi
                            Aramco Group”), follows strict guidelines to protect personal data and ensures compliance
                            with applicable data protection laws and regulations.</p>
                        <p>Your privacy is important to us and maintaining your trust is a priority. This Privacy Notice
                            informs you that information submitted by you or collected by Saudi Aramco may be processed
                            for the purposes below.</p>
                        <h4>1. Saudi Aramco Group Websites
                        </h4>
                        <p>The Saudi Aramco website (aramco.com) (“Site”) may include links to other websites of Saudi
                            Aramco Group businesses, products and services, each of which may have their own privacy
                            notices. When visiting any of our other websites, please review and familiarize yourself
                            with the relevant privacy policy. </p>
                        <h4>2. Information we collect</h4>
                        <p>When you use the Site, we may collect information about you (“Personal Data”). This includes
                            information you may provide or provided about you such as: </p>
                        <ul>
                            <li>Name</li>
                            <li>Language</li>
                            <li>Contact details (such as telephone numbers, email address, address)</li>
                            <li>User login data</li>
                            <li>Demographic data (e.g. date of birth)</li>
                            <li>Technical Information (IP / Cookies)</li>
                            <li>If applying for a job, employment history, nationality, date of birth, and other relevant information to enable us to conduct background checks</li>
                        </ul>
                        <p>We also may collect information about you from publicly and commercially available sources
                            (as permitted by law), which we may combine with other information we collect when you visit
                            our Site.&nbsp; This may include (but is not limited to) websites where you publically
                            include information about yourself such as Linked-in, Twitter, job sites or from other third
                            party sources.</p>
                        <h4>3. Collection, processing and use of your Personal Data</h4>
                        <p>&nbsp;</p>
                        <ul>
                            <li>We collect Personal Data of users of the Site. We collect, process and use your Personal
                                Data in connection with your use of the Site in providing you services such as:</li>
                            <li>Registering to become a supplier;</li>
                            <li>Applying for a job;</li>
                            <li>Contacting us for partnership, supplier, or other business opportunities;</li>
                            <li>Business execution including entering into of agreements with customers, suppliers and
                                managing relationships with such parties;</li>
                            <li>Communicating to our customers, investors, prospective and existing employees;</li>
                            <li>Legal and/or regulatory compliance reasons including litigation and defense of claims.
                                <br>
                                We do so to provide you with the service you requested, and where appropriate with your
                                consent or based on our legitimate interest to carry out our business operations.
                            </li>
                        </ul>
                        <h4>4. How we might share your Personal Data</h4>
                        <p>We may share your Personal Data with Saudi Aramco Group companies, affiliates or other third
                            parties. We may need to do this:
                        </p>
                        <ul>
                            <li>Where we need assistance from third parties to grant you access to the Site and
                                facilitate posting of information, content and/or otherwise operate the Site;</li>
                            <li>Where have a public interest or legal duty to do so (e.g., assisting with detection of
                                crime, regulatory reporting, litigation, or defending legal rights);
                            </li>
                            <li>Where we have a duty to disclose to a competent public authority, government or
                                regulatory agency where necessary to comply with a legal or regulatory compliance
                                obligation which the relevant Saudi Aramco Group member is subject to or as permitted by
                                applicable local law; </li>
                            <li>In the event of a reorganization, merger, divestment or other sale of some or all of our
                                assets or stock, to any successor;
                            </li>
                            <li>Where required to our professional advisers or consultants, including lawyers, bankers,
                                auditors, accountants and insurers providing consultancy, legal, banking, audit,
                                accounting or insurance services to us; </li>
                            <li>To enforce or apply any agreements we have with you;
                            </li>
                            <li>To third party suppliers and vendors who we use to support our business, including but
                                not limited to the operation, features and functionality of this Site, and those who
                                provide information technology and system administration services to us; or
                            </li>
                            <li>We asked for your permission to share your Personal Data and you agreed.</li>
                        </ul>
                        <h4>5. Social Media</h4>
                        <p>We may use social media sites such as Facebook, LinkedIn and Twitter. If you use these
                            services, you should review their privacy policy for more information on how they deal with
                            your Personal Data.</p>
                        <p>Social media platforms also allow you to indicate your preferences to them about the
                            advertising you receive on their platforms. Please contact your social media platforms for
                            more information.</p>
                        <h4>6. How we protect and handle your Personal Data</h4>
                        <p>
                            We use robust technical and organizational measures to protect any personal information we
                            process about you. All Saudi Aramco personnel who have access to your Personal Data operate
                            under strict corporate guidelines to ensure the protection of the data and compliance with
                            applicable local data protection laws and regulations.</p>
                        <h4>7. International data transfers</h4>
                        <p>
                            We store and process your Personal Data in various jurisdictions, including the Kingdom of
                            Saudi Arabia. Your Personal Data may be shared with and processed by Saudi Aramco or other
                            Saudi Aramco Group subsidiaries and affiliates outside of the country in which your Personal
                            Data was collected.</p>
                        <p>The laws on processing such information, including where such information is classed as
                            "personal data", in these locations may be less stringent than in your country. It may also
                            be processed by staff operating outside of your country. We will take all steps reasonably
                            necessary and/or required by applicable data protection laws to ensure that your information
                            is treated securely and in accordance with this notice and applicable law.</p>
                        <h4>8. How long do we keep your Personal Data?</h4>
                        <p>We will keep Personal Data for as long as we have a relationship with you and when you use
                            our Site. Following end of the relationship, we shall retain this for a period of 7 years or
                            such longer period as required by law and/or to protect our legal interests. We will not
                            keep any information for longer than is strictly necessary and when we no longer need the
                            information, we will securely destroy it in accordance with our internal policies or
                            anonymize it.
                            Should you require earlier deletion, you may discuss this by <a
                                href="mailto:dataprivacy@aramco.com">contacting Saudi Aramco</a>.</p>
                        <h4>9. Your Rights</h4>
                        <p>
                            Under certain applicable laws, you may have certain rights in relation to your Personal
                            Data. These rights include right to access and rectify the Personal Data that you provided
                            to Saudi Aramco.
                        </p>
                        <p>Subject to certain limitations, users accessing this Site within and/or otherwise located
                            within the European Union (EU) may have a right under applicable laws to request Saudi
                            Aramco to provide them access to their Personal Data for the purpose(s) of: </p>
                        <ul>
                            <li>Request a copy of what Personal Data we have on you;
                            </li>
                            <li>Rectify or erase your Personal Data (add to or update/correct);
                            </li>
                            <li>Restrict the processing of your Personal Data;
                            </li>
                            <li>Object to the processing of your Personal Data; </li>
                            <li>Data Portability;</li>
                            <li>Lodge a complaint with the Supervisory Authority. </li>
                        </ul>
                        <p>For collection and use based on legitimate interests, you may object to processing of your
                            personal information. To that effect you can contact Saudi Aramco in writing at the email
                            address provided below. Should you object to the processing of your information this may,
                            without limitation, impede your access to the Site.</p>
                        <h4>10. Contact Us</h4>
                        <p>If you have any questions regarding this Privacy Statement, please contact: <a
                                href="mailto:dataprivacy@aramco.com">dataprivacy@aramco.com</a>.
                            <br> <br> <em>Date modified: 06&nbsp;October 2019 </em>
                        </p>
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