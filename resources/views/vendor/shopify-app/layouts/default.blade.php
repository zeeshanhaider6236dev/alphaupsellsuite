<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('assets/img/fav.png') }}" type="image/gif">
        <title>{{ config('shopify-app.app_name') }}</title>
        <link rel="stylesheet" href="{{ asset('assets') }}/css/styles.min.css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> --}}
        <link rel="stylesheet" href="{{ asset('css') }}/custom.css" />
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '609943173266497');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=609943173266497&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
        @yield('styles')
        @stack('componentCss')
    </head>
    <body> 
        @yield('content')
        @if(config('shopify-app.appbridge_enabled'))
            <script src="https://unpkg.com/@shopify/app-bridge{{ config('shopify-app.appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
            <script>
                var AppBridge = window['app-bridge'];
                var createApp = AppBridge.default;
                var app = createApp({
                    apiKey: '{{ config('shopify-app.api_key') }}',
                    shopOrigin: '{{ Auth::user()->name }}',
                    forceRedirect: true,
                });
            </script>
        @endif
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <script src="{{ asset('assets') }}/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets') }}/js/script.min.js"></script>
        {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.0/sweetalert2.all.min.js"></script>
        
        <script>
            // toastr.options.closeButton = true;
            // toastr.options.positionClass = "toast-bottom-center";
            // toastr.options.closeHtml = '<button>&times;</button>';
            function messages(response = undefined) {
                if (response.hasOwnProperty('success')) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                } else if (response.hasOwnProperty('error')) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'error',
                        title: response.error
                    })
                } else if (response.hasOwnProperty('errors')) {
                    let html = "";
                    $.each(response.errors, function (index, error) {
                        html+=`<div class="text-left"><i class="fa fa-ban text-danger"></i> ${error}</div>`;
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: html,
                    });
                }
            }
            function addSpinner(element){
                element.prop('disabled','true')
                $(element).append(`&nbsp;<span style="margin-bottom:3px;" class="spinner-border spinner-border-sm loaderClass"></span> `);
            }
            function ajaxRequest(url, callfunc = undefined, method = 'GET', data = {}) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    processData: true,
                }).done(function (response) {
                    messages(response);
                    if(callfunc){
                        callfunc(response);
                    }
                    if(response.hasOwnProperty('reload')){
                        location.reload();
                    }
                    if(response.hasOwnProperty('url')){
                        location.assign(response.url);
                    }
                }).always(function (response) {
                    if(response.hasOwnProperty('redirect')){
                        window.location.href = response.redirect;
                    }
                });
            }
            function setProperty(element,property,value){
                let elements = document.querySelectorAll(element);
                for(let i=0;i<elements.length;i++){
                    elements[i].style.setProperty(property,value,'important');
                }
            }
        </script>
        @yield('scripts')
        @stack('componentJs')
    </body>
</html>