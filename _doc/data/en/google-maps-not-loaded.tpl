<h2>Why Google Maps doesn't work?</h2>

<p>Sometimes, you might have an issue with Google Maps saying the following</p>
<pre>
    Oops! Something went wrong.
    This page didn't load Google Maps correctly. See the JavaScript console for technical details.
</pre>
<p>This happend when your domain is new and has never used Google Maps prior June 22nd, 2016.</p>
<p>Google Maps recently changed its TOS and requires now an API key. So pH7CMS 2.0 and newer allows you to add a Gogole API key.</p>
<p>To do it, go to your admin panel -> Settings -> Api -> Google Maps API Key</p>
<p>We cannot do anything for that, you will just have to move your site to a domain that respects the TOS of Google Map's service</p>

<figure>
    <img src="{site_url}static/img/google-map-not-loaded.png" alt="Google Maps went wrong, not loaded" title="Google Maps went wrong, not loaded" />
    <figcaption>Google Maps now requires an API Key</figcaption>
</figure>

<figure>
    <img src="{site_url}static/img/google-map-api-form.png" alt="Google Maps Setting Form in pH7CMS Admin Panel" title="Google Maps Setting Form in pH7CMS Admin Panel" />
    <figcaption>Google Maps Setting Form in pH7CMS Admin Panel</figcaption>
</figure>


<figure>
    <img src="{site_url}static/img/get-google-api-key.png" alt="Generate Google API key on Console.Developers.Google.com" title="Generate Google API key on Console.Developers.Google.com" />
    <figcaption>Generate Google API key on <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a> and select "Google Maps JavaScript API" and "Web browser (Javascript)"<figcaption>
</figure>
