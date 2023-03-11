<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">   
<meta name="description" content="<?php if (isset($seo)){ echo $seo['description']; } ?>"> 
<link rel="canonical" href="{{\App\Services\Admin\Misc\UrlService::url_canonical()}}"/>
<title><?php if (isset($seo)){ echo $seo['title']; } else if (isset($title)) { echo $title; } ?></title>     
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">  

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>