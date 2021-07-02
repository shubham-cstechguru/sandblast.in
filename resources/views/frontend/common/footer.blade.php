@php
$cities = \App\Model\CityModel::select('city_slug', 'city_name')->get()->toArray();
$countries = \App\Model\CountryModel::select('country_slug','country_name')->get()->toArray();
$y = date('Y');
$title = DB::table('settings')->get();
$name = $title[0]->setting_title;
@endphp

<div class="foot-c py-3">
    <div class="container city_handle">
        <ul class="list-unstyled breadcrumb p-0 mx-0" style="background: none;">
            @foreach($cities as $c)
            <li class="breadcrumb-item mr-2"><a href="city/{{$c['city_slug']}}"><i class="icon-location mr-1" style="font-size: 10px;" aria-hidden="true"></i>{{$c['city_name']}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="container city_handle">
        <ul class="list-unstyled breadcrumb p-0 mx-0" style="background: none; line-height: 32px;">
            @foreach($countries as $c)
            <li class="breadcrumb-item mr-2"><a href="country/{{$c['country_slug']}}"><i class="icon-location mr-1" style="font-size: 10px;" aria-hidden="true"></i>{{$c['country_name']}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<footer class="bg-dark py-4">


    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-5">
                <div class="footer-img">
                    @if($title[0]->setting_logo)
                    <img src="{{ url('imgs/'. $title[0]->setting_logo) }}" alt="">
                    @endif
                </div>
                <div class="footer-content">
                    <p>{{ @$title[0]->setting_desc }}</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 footer-list">
                <h1 class="text-left lead"><b>Quick Links</b></h1>
                <!-- <ul class="list-unstyled" style="line-height: 32px;">
                    @foreach($cities as $c)
                    <li><a href="city/{{$c['city_slug']}}"><i class="icon-location mr-2" aria-hidden="true"></i>{{$c['city_name']}}</a></li>
                    @endforeach
                </ul> -->
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 footer-list">
                @if($title[0]->setting_mobile != '' || $title[0]->setting_whatsapp != '' || $title[0]->setting_contact_email != '')
                <h1 class="text-left lead"><b>Contact Us</b></h1>
                @endif
                <ul class="list-unstyled" style="line-height: 32px;">
                    @if($title[0]->setting_mobile != '')
                    <li><a href="tel:+91{{ @$title[0]->setting_mobile }}"><i class="icon-phone mr-2" aria-hidden="true"></i>+91 {{ @$title[0]->setting_mobile }}</a></li>
                    @endif
                    @if($title[0]->setting_whatsapp != '')
                    <li><a href=""><i class="icon-whatsapp mr-2" aria-hidden="true"></i>+91 {{ @$title[0]->setting_whatsapp }}</a></li>
                    @endif
                    @if($title[0]->setting_contact_email != '')
                    <li><a href="mailto:{{ @$title[0]->setting_contact_email }}"><i class="icon-envelope mr-2" aria-hidden="true"></i>{{ @$title[0]->setting_contact_email }}</a></li>
                    @endif
                </ul>
                @if($title[0]->setting_facebook != '' || $title[0]->setting_twitter != '' || $title[0]->setting_linkedin != '' || $title[0]->setting_youtube != '')
                <h1 class="text-left lead mt-2"><b>Follow Us On</b></h1>
                @endif
                <ul class="list-inline">
                    @if($title[0]->setting_facebook != '')
                    <li class="list-inline-item"><a href="{{ $title[0]->setting_facebook }}" target="_blank"><i class="icon-facebook" aria-hidden="true"> </i></a></li>
                    @endif
                    @if($title[0]->setting_twitter != '')
                    <li class="list-inline-item"><a href="{{ $title[0]->setting_twitter }}" target="_blank"><i class="icon-twitter" aria-hidden="true"> </i></a></li>
                    @endif
                    @if($title[0]->setting_linkedin != '')
                    <li class="list-inline-item"><a href="{{ $title[0]->setting_linkedin }}" target="_blank"><i class="icon-linkedin" aria-hidden="true"> </i></a></li>
                    @endif
                    @if($title[0]->setting_youtube != '')
                    <li class="list-inline-item"><a href="{{ $title[0]->setting_youtube }}" target="_blank"><i class="icon-youtube" aria-hidden="true"> </i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <hr style="background-color: #fff;">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-center text-white">© {{ $y }} {{ $name }} All rights reserved. Designed by A2Zproviders</p>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enquiryModalLabel">Enquiry Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['url' => url('ajax/save_order') ,'id' => 'orderForm']) }}
            <div class="modal-body">
                <input type="hidden" name="record[order_pid]" id="orderProductId" value="">
                <input type="hidden" name="record[order_qty]" id="orderQty" value="">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="record[order_name]" value="" class="form-control name" required>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="tel" name="record[order_mobile]" value="" class="form-control mobile" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="email" name="record[order_email]" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="record[order_enquiry]" rows="3" class="form-control" required></textarea>
                </div>
                <!-- <div class="row" style="display: none;>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control" name="record[order_state]" required>
                                <option value="">Select State</option>
                                <option value="Rajasthan">Rajasthan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>City</label>
                            <select class="form-control" name="record[order_city]" required>
                                <option value="">Select City</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jodhpur">Jodhpur</option>
                            </select>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send Enquiry</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div class="sticky-container">
    <ul class="sticky" style="z-index:9999;">
        <li>
            <p><a href="tel:+91{{ $title[0]->setting_mobile }}"><i class="icon-phone"></i> Call Us</a></p>
        </li>
        <li>
            <p><i class="icon-whatsapp"></i> WhatsApp</p>
        </li>
        <li>
            <p><a href="mailto:{{ @$title[0]->setting_contact_email }}"><i class="icon-envelope"></i> Mail Us</a></p>
        </li>
    </ul>
</div>

{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/multirange.js') }}
{{ HTML::script('js/popper.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
<!-- {{ HTML::script('js/bootstrap-slider.min.js') }} -->
<!-- {{ HTML::script('js/xzoom.min.js') }} -->
{{ HTML::script('js/validation.js') }}
<!-- {{ HTML::script('js/setup.js') }} -->
{{ HTML::script('js/sweetalert.min.js') }}
{{ HTML::script('js/owl.carousel.min.js') }}
{{ HTML::script('js/jquery.fancybox.min.js') }}
{{ HTML::script('js/jquery.lazy.min.js') }}
{{ HTML::script('js/custom.js') }}
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            var y = window.scrollY
            if (y >= 200) {
                $("#jp_header").addClass('fixed', 3000, "easeOutBounce");
            } else {
                $("#jp_header").removeClass('fixed');
            }
        });
    });
</script>
</body>

</html>