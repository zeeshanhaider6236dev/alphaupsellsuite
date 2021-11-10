@if ($upsell->upsellType->name != 'Pre Purchase')
    @include(getSingleUpsellJs($upsell->upsellType->name))
@else
    @include(getAtcSingleTemplateJs($upsell->setting['upsell_template_type']))
@endif
