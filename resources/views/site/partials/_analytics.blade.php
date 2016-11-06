    @if(app()->environment('production'))
        <!-- Piwik -->
        <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(["setDomains", ["*.profemariana.com","*.profemariana.com"]]);
        _paq.push(["setDoNotTrack", true]);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="https://bbro.dezwartepoet.nl/";
            _paq.push(['setTrackerUrl', u+'bbro.php']);
            _paq.push(['setSiteId', 15]);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'bbro.js'; s.parentNode.insertBefore(g,s);
        })();
        </script>
        <noscript><p><img src="https://bbro.dezwartepoet.nl/bbro.php?idsite=15" style="border:0;" alt="" /></p></noscript>
        <!-- End Piwik Code -->
    @endif
