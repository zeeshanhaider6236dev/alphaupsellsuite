<?php

function getSingleUpsellCss($name = '')
{
    return 'upsell_designs.includes.css.'.str_replace(' ','_',strtolower($name));
}
function getSingleUpsellHtml($name = '')
{
    return 'upsell_designs.includes.html.'.str_replace(' ','_',strtolower($name));
}
function getSingleUpsellJs($name = '')
{
    return 'upsell_designs.includes.js.'.str_replace(' ','_',strtolower($name));
}
function getAtcSingleTemplateCss($templateType = '')
{
    return 'upsell_designs.includes.css.pre_purchase.template_'.$templateType;
}
function getAtcSingleTemplateJs($templateType = '')
{
    return 'upsell_designs.includes.js.pre_purchase.template_'.$templateType;
}
