{{-- Head content --}}
@php
    $env = env('APP_ENV');

    $in_whitelisted_routes = function(): bool {
        $whitelisted_routes = ['Home', 'tips', 'about', 'faq', 'sign-up', 'sign-in'];
        return in_array(Illuminate\Support\Facades\Route::currentRouteName(), $whitelisted_routes);
    };

    $is_a_profile_path = function (): bool
    {
         return Illuminate\Support\Str::startsWith(request()->route()->uri, 'Profile');
    }
@endphp

@if($env != 'local' && ($is_a_profile_path() || $in_whitelisted_routes()))

    @push('head')
        <!-- Facebook Pixel Code -->
        <script nonce="Dwv6orAM">
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window,
                document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', '4126610240959487');
            fbq('set', 'agent', 'tmgoogletagmanager', '4126610240959487');
            fbq('track', "PageView");
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                 src="https://www.facebook.com/tr?id=4126610240959487&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->

        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-TKNLXRV2');
        </script>
        <!-- End Google Tag Manager -->

        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8MCJ5T5YQY"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-8MCJ5T5YQY');
        </script>

    @endpush

    @push('body-top')
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKNLXRV2"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endpush

    @push('body-bottom')@endpush

    @push('headers')
        <script>const vapidKey = "{{ env('VAPID_PUBLIC_KEY') }}";</script>
    @endpush

@endif


