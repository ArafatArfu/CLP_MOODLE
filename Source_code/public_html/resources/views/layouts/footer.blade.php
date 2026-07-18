<footer class="clp-footer">
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Resources</h3>
                <ul class="footer-list-menu">
                    <li>
                        <a href="{{ route('website.evaluationReport') }}">INDEPENDENT
                            EVALUATION REPORT</a>
                    </li>
                    <li>
                        <a href="{{ route('website.formativeReports') }}">FORMATIVE REPORT</a>
                    </li>
                    <li>
                        <a href="{{ route('website.annualReport') }}">ANNUAL REPORT</a>
                    </li>
                    <li>
                        <a href="{{ route('website.magazines') }}">MAGAZINES</a>
                    </li>
                    <li>
                        <a href="{{ route('website.brochure') }}">BROCHURE</a>
                    </li>
                </ul>
                <h3 class="footer-title">Contact Info</h3>
                <a style="color:black;" href="tel:+7329728362">(732) 972-8362</a> <br/>
                <a style="color:black;" href="mailto:clp@clpweb.org">clp@clpweb.org</a>

                <h3 class="footer-title">Mailing Address</h3>
                <p class="address">Computer Literacy Program (CLP)<br>6 Tharp Lane <br/> Marlboro, NJ 07746, USA</p>
            </div>

            <div class="col-sm-4 col-xs-12" style="height: 520px;">
                <h3 class="footer-title">CLP Mission</h3>
                <p style="line-height: 20px;">Empowering underprivileged youths through computer literacy training and
                    technology-aided education.</p>
                <h3 class="footer-title">Follow Us</h3>
                <div class="row">
                    <div class="footer-social">
                        <a target="_blank" href="https://facebook.com/CLPUSAA" class="fa fa-facebook social-fb"></a>
                        <a target="_blank" href="https://www.instagram.com/clp_usa/"
                           class="fa fa-instagram social-instagram"></a>
                        <a target="_blank" href="https://twitter.com/clp_usa" class="fa fa-twitter social-twitter"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A"
                           class="fa fa-youtube social-youtube"></a>
                        <a target="_blank" href="https://www.linkedin.com/company/computer-literacy-program-volunteers-for-underprivileged/" class="fa fa-linkedin social-linkedin"></a>
                    </div>
                </div>

                <h3 class="footer-title">Legal Info</h3>
                <ul class="footer-list-menu">
                    <li>
                        IRS ID: <strong>46-0646134</strong>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-list-menu">
                    <li>
                        <a href="{{route('donation.index')}}">DONATE ONLINE</a>
                    </li>
                    <li>
                        <a href="{{route('donation.mail')}}">DONATE BY MAIL</a>
                    </li>
                    <li>
                        <a href="{{route('donation.amazonSmile')}}">DONATE BY AMAZON-SMILE</a>
                    </li>
                    <li>
                        <a href="{{ route('website.sponsorClc') }}">SPONSOR A CLC</a>
                    </li>
                    <li>
                        <a href="{{ route('website.sponsorScr') }}">SPONSOR A SCR</a>
                    </li>
                    <li>
                        <a href="{{ route('website.sponsorTokai') }}">SPONSOR A TOKAI(টোকাই)-CLC</a>
                    </li>
                    <li>
                        <a href="{{ route('donation.sponsorComputer') }}">SPONSOR A COMPUTER</a>
                    </li>
                    <li>
                        <a href="{{route('website.volunteer')}}">BE A VOLUNTEER</a>
                    </li>
                    <li>
                        <a href="{{route('website.contactUs')}}">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="background-color: #232121;">
                <p class="text-center" style="color: #FFF; padding: 5px;">Copyright &copy; CLP, {!! now()->year !!}</p>
            </div>
        </div>
    </section>
</footer>
