@php
$mcategories = App\Model\Category::with(['scats' => function($q) {
$q->where('category_is_deleted', 'N');
}])->where('category_is_deleted', 'N')->where('category_parent', 0)->get();

$title = DB::table('settings')->get();
$name = $title[0]->setting_title;
$fav = $title[0]->setting_favicon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ url('/').'/' }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ empty($meta['title']) ? $site->setting_title : $meta['title'] }}</title>

    <link rel="icon" type="image/png" href="{{ url('imgs/'. $fav) }}" />

    @if(!empty($meta))
    <meta name="keywords" content="{{ @$meta['keywords'] }}">
    <meta name="description" content="{{ @$meta['description'] }}">

    <meta property="og:type" content="website" />
    <meta property='og:locale' content='en_US' />
    <meta property="og:site_name" content="{{ @$name }}" />
    <meta property="og:title" content="{{ empty($meta['title']) ? $site->setting_title : $meta['title'] }}" />
    <meta property="og:description" content="{{ @$meta['description'] }}" />
    <meta property="og:image" content="{{ url('imgs/sliders/3.jpg') }}" />
    <link rel="canonical" href="{{url()->current()}}" />

    <meta name="twitter:card" content="Sand Blasting Machine | Shot Blasting Machine" />
    <meta name="twitter:site" content="{{ @$name }}" />
    <meta name="twitter:title" content="{{ empty($meta['title']) ? $site->setting_title : $meta['title'] }}" />
    <meta name="twitter:description" content="{{ @$meta['description'] }}" />
    <meta name="twitter:image" content="{{ url('imgs/sliders/3.jpg') }}" />
    @endif
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FEW2E0RQ93"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-FEW2E0RQ93');
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Manufacturer",
            "url": "https://www.sandblast.in/",
            "description": "{{ empty($meta['title']) ? $site->setting_title : $meta['title'] }}"
            "Image": "{{ url('imgs/sliders/3.jpg') }}",
            "logo": "{{ url('imgs/logo.png') }}",
            "telephone": "+91 8003997469",
            "name": "Sand Blast",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Jodhpur, Rajasthan",
                "addressRegion": "India",
                "postalCode": "342027",
                "streetAddress": "P.No. 324-25, 378-79-80, khasra No. 9/4, Shree Yade Gaun, Near Banar Ring Road"
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://www.sandblast.in/?s={search_term}",
                "query-input": "required name=search_term"
            }



        }
    </script>

    <link rel="icon" href="{{ url('imgs/favicon.png') }}">

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/owl.carousel.min.css') }}
    {{ HTML::style('css/owl.theme.default.min.css') }}
    {{ HTML::style('icomoon/style.css') }}
    {{ HTML::style('css/stylesheet.css') }}
    {{ HTML::style('css/jquery.fancybox.min.css') }}
    {{ HTML::style('css/style.css') }}

    <style>
    </style>
</head>

<body>
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <header>
        <div class="header-top" id="jp_header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3 d-none d-lg-block">
                        @if($title[0]->setting_logo)
                        <a href="{{ url('/') }}"><img src="{{ url('imgs/'. $title[0]->setting_logo) }}" alt="sand blast logo"> </a>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5 form-group search-form p-0" style="margin-top: auto;">
                        <input type="text" name="search" class="form-control searchinput" placeholder="Search Product">
                        <span id="baseUrl" data-url="{{ route('ajax-search') }}"></span>
                        <ul class="search-list searchlist">
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 d-flex justify-content-between" style="align-items: center;">
                        <a href="tel:+91{{ $title[0]->setting_mobile }}"><i class="icon-call"></i> +91 {{ $title[0]->setting_mobile }}</a>
                        &nbsp; &nbsp;
                        <a href="mailto:{{ @$title[0]->setting_contact_email }}"><i class="icon-email"></i> {{ $title[0]->setting_contact_email }} </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 d-block d-lg-none" style="margin: 5px 0 0 0">
                        <a href="{{ url('/') }}"><img src="{{ url('imgs/old-logo.png') }}" alt="sand blast logo"> </a>
                    </div>
                    <div class="col-4 d-lg-none clearfix">
                        <a href="#" class="nav-icon float-right"><i class="icon-navicon"></i></a>
                    </div>
                    <div class="col-sm-12">
                        <ul class="main-navbar">
                            @foreach($mcategories as $mc)
                            <li><a href="{{ url($mc->category_slug) }}">{{ $mc->category_name }}</a>
                                @if(!empty($mc->scats->count()))
                                <span class="icon-angle-down"></span>
                                <div class="clearfix"></div>
                                @endif
                                @if(!empty($mc->scats->count()))
                                <ul>
                                    @foreach($mc->scats as $sc)
                                    <li><a style="  overflow: hidden;  max-width: 45ch;  text-overflow: ellipsis;  white-space: nowrap;" href="{{ url($mc->category_slug.'/'.$sc->category_slug) }}">{{ $sc->category_name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    