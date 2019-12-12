<div class=" col-lg-12 shadow border border-black cookie position-absolute col-lg-3 js-cookie-consent cookie-consent">
    <h4 class="title mt-2">Cookies</h4>
        <span class="cookie-consent__message ">
            {!! trans('cookieConsent::texts.message') !!}
		</span>
		<div class="col-sm-12"></div>
    <div class="bot-coo row mt-3 pt-4 pb-4">

        <div class="stred col-sm-4">
		<a class="link text-white" href="{{ url('/cookies')}}">Viac informácií</a>
        </div>
        <div class="stred col-sm-8 text-right">
                    <button class="butt float-right js-cookie-consent-agree cookie-consent__agree">
            {{ trans('cookieConsent::texts.agree') }}
        </button>
        </div>
    </div>

    </div>
</div>
