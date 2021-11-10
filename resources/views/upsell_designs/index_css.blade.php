@if ($upsell->upsellType->name != 'Pre Purchase')
    @include(getSingleUpsellCss($upsell->upsellType->name))
@else
    @include(getAtcSingleTemplateCss($upsell->setting['upsell_template_type']))
@endif
