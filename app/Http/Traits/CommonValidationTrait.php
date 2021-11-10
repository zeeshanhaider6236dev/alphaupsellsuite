<?php
namespace App\Http\Traits;


trait CommonValidationTrait {

    public function productRules()
    {
        $extra = [];
        
        $extra [] = [ 'key' => 'Tproducts', 'value' => [ "required_without_all:Tcollections,Ttags", 'array' ] ];
        $extra [] = [ 'key' => 'Tproducts.*', 'value' => [ "required", 'string', 'max:191' ] ];

        $extra [] = [ 'key' => 'Tcollections', 'value' => [ "required_without_all:Tproducts,Ttags", 'array' ] ];
        $extra [] = [ 'key' => 'Tcollections.*', 'value' => [ "required", 'string', 'max:191' ] ];

        $extra [] = [ 'key' => 'Ttags', 'value' => [ "required_without_all:Tcollections,Tproducts", 'array' ] ];
        $extra [] = [ 'key' => 'Ttags.*', 'value' => [ "required", 'string', 'max:191' ] ];
        // Appear On products rules
        if(request()->has('auto') && request('auto')==0):
            $extra [] = [ 'key' => 'Aproducts', 'value' => [ "required_without_all:Acollections,Atags", 'array' ] ];
            $extra [] = [ 'key' => 'Aproducts.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Acollections', 'value' => [ "required_without_all:Aproducts,Atags", 'array' ] ];
            $extra [] = [ 'key' => 'Acollections.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Atags', 'value' => [ "required_without_all:Acollections,Aproducts",'array' ] ];
            $extra [] = [ 'key' => 'Atags.*', 'value' => [ "required", 'string', 'max:191' ] ];
        elseif(!request()->has('auto')):
            $extra [] = [ 'key' => 'Aproducts', 'value' => [ "required_without_all:Acollections,Atags", 'array' ] ];
            $extra [] = [ 'key' => 'Aproducts.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Acollections', 'value' => [ "required_without_all:Aproducts,Atags", 'array' ] ];
            $extra [] = [ 'key' => 'Acollections.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Atags', 'value' => [ "required_without_all:Acollections,Aproducts",'array' ] ];
            $extra [] = [ 'key' => 'Atags.*', 'value' => [ "required", 'string', 'max:191' ] ];
        endif;
        $extra [] = [ 'key' => 'auto', 'value' => [ "required_without_all:Acollections,Aproducts,Atags", 'in:1,0' ] ];       
        if(request()->has('Tproducts')):
            $TproductsCount     = count(request('Tproducts'));
            $extra [] = [ 'key' => 'Tproductsimages', 'value' => [ "required_without_all:Tcollections,Ttags", 'array', "size : $TproductsCount" ] ];
            $extra [] = [ 'key' => 'Tproductsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Tproductstitles', 'value' => [ "required_without_all:Tcollections,Ttags", 'array', "size : $TproductsCount" ] ];
            $extra [] = [ 'key' => 'Tproductstitles.*', 'value' => [ "required", 'string'] ];
        elseif(request()->has('Tcollections')):
            $TcollectionsCount  = count(request('Tcollections'));
            $extra [] = [ 'key' => 'Tcollectionsimages', 'value' => [ "required_without_all:Tproducts,Ttags", 'array', "size :  $TcollectionsCount" ] ];
            $extra [] = [ 'key' => 'Tcollectionsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Tcollectionstitles', 'value' => [ "required_without_all:Tproducts,Ttags", 'array', "size :  $TcollectionsCount" ] ];
            $extra [] = [ 'key' => 'Tcollectionstitles.*', 'value' => [ "required", 'string' ] ];
        elseif(request()->has('Ttags')):
            $TtagsCount  = count(request('Ttags'));
            $extra [] = [ 'key' => 'Ttagsimages', 'value' => [ "required_without_all:Tcollections,Tproducts", 'array', "size :  $TtagsCount" ] ];
            $extra [] = [ 'key' => 'Ttagsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Ttagstitles', 'value' => [ "required_without_all:Tcollections,Tproducts", 'array', "size :  $TtagsCount" ] ];
            $extra [] = [ 'key' => 'Ttagstitles.*', 'value' => [ "required", 'string'] ];      
        endif;

         
        if(request()->has('Aproducts')):
            $AproductsCount = count(request('Aproducts'));
            $extra [] = [ 'key' => 'Aproductsimages', 'value' => [ "required_without_all:Acollections,Atags,auto", 'array', "size :  $AproductsCount" ] ];
            $extra [] = [ 'key' => 'Aproductsimages.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Aproductstitles', 'value' => [ "required_without_all:Acollections,Atags,auto", 'array', "size :  $AproductsCount" ] ];
            $extra [] = [ 'key' => 'Aproductstitles.*', 'value' => [ "required", 'string', 'max:191' ] ];
        elseif(request()->has('Acollections')):
            $AcollectionsCount  = count(request('Acollections'));
            $extra [] = [ 'key' => 'Acollectionsimages', 'value' => [ "required_without_all:Aproducts,Atags,auto", 'array', "size :  $AcollectionsCount" ] ];
            $extra [] = [ 'key' => 'Acollectionsimages.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Acollectionstitles', 'value' => [ "required_without_all:Aproducts,Atags,auto", 'array', "size :  $AcollectionsCount" ] ];
            $extra [] = [ 'key' => 'Acollectionstitles.*', 'value' => [ "required", 'string', 'max:191' ] ];
        elseif(request()->has('Atags')):
            $AtagsCount  = count(request('Atags'));
            $extra [] = [ 'key' => 'Atagsimages', 'value' => [ "required_without_all:Acollections,Aproducts,auto",'array', "size :  $AtagsCount" ] ];
            $extra [] = [ 'key' => 'Atagsimages.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Atagstitles', 'value' => [ "required_without_all:Acollections,Aproducts,auto",'array', "size :  $AtagsCount" ] ];
            $extra [] = [ 'key' => 'Atagstitles.*', 'value' => [ "required", 'string', 'max:191' ] ];
        endif;

        $extra [] = [ 'key' => 'auto', 'value' => [ "required_without_all:Acollections,Aproducts,Atags", 'in:1,0' ] ];
        return $extra;
    }

    

    public function targettedProductsRules()
    {
        $extra = [];
        // Targetted products rules
        $extra [] = [ 'key' => 'Tproducts', 'value' => [ "required_without_all:Tcollections,Ttags", 'array' ] ];
        $extra [] = [ 'key' => 'Tproducts.*', 'value' => [ "required", 'string', 'max:191' ] ];
        $extra [] = [ 'key' => 'Tcollections', 'value' => [ "required_without_all:Tproducts,Ttags", 'array' ] ];
        $extra [] = [ 'key' => 'Tcollections.*', 'value' => [ "required", 'string', 'max:191' ] ];
        $extra [] = [ 'key' => 'Ttags', 'value' => [ "required_without_all:Tcollections,Tproducts", 'array' ] ];
        $extra [] = [ 'key' => 'Ttags.*', 'value' => [ "required", 'string', 'max:191' ] ];

        if(request()->has('Tproducts')):
            $TproductsCount     = count(request('Tproducts'));
            $extra [] = [ 'key' => 'Tproductsimages', 'value' => [ "required_without_all:Tcollections,Ttags", 'array', "size : $TproductsCount" ] ];
            $extra [] = [ 'key' => 'Tproductsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Tproductstitles', 'value' => [ "required_without_all:Tcollections,Ttags", 'array', "size : $TproductsCount" ] ];
            $extra [] = [ 'key' => 'Tproductstitles.*', 'value' => [ "required", 'string'] ];
        elseif(request()->has('Tcollections')):
            $TcollectionsCount  = count(request('Tcollections'));
            $extra [] = [ 'key' => 'Tcollectionsimages', 'value' => [ "required_without_all:Tproducts,Ttags", 'array', "size : $TcollectionsCount" ] ];
            $extra [] = [ 'key' => 'Tcollectionsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Tcollectionstitles', 'value' => [ "required_without_all:Tproducts,Ttags", 'array', "size : $TcollectionsCount" ] ];
            $extra [] = [ 'key' => 'Tcollectionstitles.*', 'value' => [ "required", 'string' ] ];
        elseif(request()->has('Ttags')):
            $TtagsCount  = count(request('Ttags'));
            $extra [] = [ 'key' => 'Ttagsimages', 'value' => [ "required_without_all:Tcollections,Tproducts", 'array', "size : $TtagsCount" ] ];
            $extra [] = [ 'key' => 'Ttagsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Ttagstitles', 'value' => [ "required_without_all:Tcollections,Tproducts", 'array', "size : $TtagsCount" ] ];
            $extra [] = [ 'key' => 'Ttagstitles.*', 'value' => [ "required", 'string'] ];      
        endif;
        
        return $extra;
    }

    /*
     * 
     * ================================================= 
     *   Which Device Rules (Desktop/Mobile)
     * =================================================
     * 
    */
    public function whichDeviceRules()
    {
        $extra = [];
        $extra [] = [ 'key' => 'work_on_desktop', 'value' => [ "nullable", "in:1" ] ];
        $extra [] = [ 'key' => 'work_on_mobile', 'value' => [ "nullable", "in:1" ] ];
        return $extra;
    }

    /*
     * 
     * ================================================= 
     *   Start And End Date Schedule Rules
     * =================================================
     * 
    */
    public function scheduleRules()
    {
        $extra = [];
        $extra [] = [ 'key' => 'start_date', 'value' => [ "required", 'date_format:Y-m-d' ] ];
        $extra [] = [ 'key' => 'end_date', 'value' => [ "nullable", 'date_format:Y-m-d', 'after:start_end' ] ];
        return $extra;
    }

    /*
     * 
     * ================================================= 
     *   Upsell Preview Heading Rules
     * =================================================
     * 
    */
    public function preivewHeadingRules($heading_name_key = "fbt_heading")
    {
        $extra = [];
        $extra [] = [ 'key' => $heading_name_key, 'value' => [ "required", 'string', 'max:191' ] ];
        $extra [] = [ 'key' => 'heading_font_family', 'value' => [ "required", 'string', 'in:'.implode(',',config('upsell.strings.fontFamily')) ] ];
        $extra [] = [ 'key' => 'heading_font_size', 'value' => [ "required", 'numeric', 'min:12', 'max:50' ] ];
        $extra [] = [ 'key' => 'heading_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'heading_align', 'value' => [ "required", 'string', 'in:left,right,center' ] ];
        return $extra;
    }

    
    /*
     * 
     * ================================================= 
     *   Native Post Purchase Heading Rules
     * =================================================
     * 
    */
    public function nativePreviewHeadingRules($heading_name_key = "native_post_purchase_heading")
    {
        $extra = [];
        $extra [] = [ 'key' => $heading_name_key, 'value' => [ "required", 'string', 'max:191' ] ];
        return $extra;
    }

    /*
     * 
     * ================================================= 
     *  Down Sell Product Rule are defined below
     * =================================================
     * 
    */
    public function nativePostPurchaseUpsellRules()
    {
        $extra = [];

        $extra [] = [ 'key' => 'name', 'value' => [ "required", 'string', 'max:191' ] ];
        

        // Rules for target Product
        $extra [] = [ 'key' => 'Tproducts', 'value' => [ "required", 'array' ] ];
        $extra [] = [ 'key' => 'Tproducts.*', 'value' => [ "required", 'string', 'max:191' ] ];
        // Rules for appear on produts
        $extra [] = [ 'key' => 'Aproducts', 'value' => [ "required", 'array' ] ];
        $extra [] = [ 'key' => 'Aproducts.*', 'value' => [ "required", 'string' ] ];
        // Rules for Downsell products
        $extra [] = [ 'key' => 'Dproducts', 'value' => [ "nullable", 'array' ] ];
        $extra [] = [ 'key' => 'Dproducts.*', 'value' => [ "required", 'string' ] ];
        // Discount Type Rules
        $extra [] = [ 
            'key' => 'native_ppu_dicount_type', 
            'value' => [ "required", "in:".implode(',',config('upsell.strings.ppuDiscountType')) ],
        ];
        // Discount value rules
        $extra [] = ['key' => 'native_ppu_dicount_value', 'value' => ['required', 'min:0', 'numeric']];
        // Time Limit toggler (Checkbox) rules
        $extra [] = [ 'key' => 'time_limit_toggler', 'value' => [ "nullable","in:1" ] ];
        // TIme Limit Duration
        $extra [] = [ 'key' => 'time_limit_duration', 'value' => [ "required_if:time_limit_toggler,1","min:0","numeric"]];
        //  Top Heading and Time Limiter Font size
        $extra [] = [ 'key' => 'font_size', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.fontsize')) ]
                    ];
        // heading alignment (center, left, right)
        $extra [] = [ 'key' => 'text_align', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_align')) ]
                    ];
        // heading and timer color (Red, Green, Yellow)
        $extra [] = [ 'key' => 'text_color', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_color')) ]
                    ];
        // heading background toggler rules (hide/show)
        $extra [] = [ 'key' => 'bg_color_toggler', 'value' => [ "nullable","in:1" ] ];

        // heading border color toggler rules (hide/show)
        $extra [] = [ 'key' => 'border_color_toggler', 'value' => [ "nullable","in:1" ] ];

        // heading quantity field toggler rules (hide/show)
        $extra [] = [ 'key' => 'quantity_toggler', 'value' => [ "nullable","in:1" ] ];

        // heading variant toggler rules (hide/show)
        $extra [] = [ 'key' => 'variant_toggler', 'value' => [ "nullable","in:1" ] ];

        //  User Welcome Message 
        $extra [] = [ 'key' => 'user_welcome_msg', 'value' => [ "required", 'string', 'max:191' ] ];

        //  Sub Heading Limiter Font size
        $extra [] = [ 'key' => 'user_heading_font_size', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.fontsize')) ]
                    ];
        // heading alignment (center, left, right)
        $extra [] = [ 'key' => 'user_heading_text_align', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_align')) ]
                    ];
        // heading and timer color (Red, Green, Yellow)
        $extra [] = [ 'key' => 'user_heading_text_color', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_color')) ]
                    ];

        //  User Welcome Message 
        $extra [] = [ 'key' => 'text_tagline_message', 'value' => [ "required", 'string', 'max:191' ] ];

        //  User Welcome Message Font size
        $extra [] = [ 'key' => 'text_font_size', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.fontsize')) ]
                    ];
        // User Welcome Message heading alignment (center, left, right)
        $extra [] = [ 'key' => 'text_heading_align', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_align')) ]
                    ];
        //  User Welcome Message heading color (Red, Green, Yellow)
        $extra [] = [ 'key' => 'text_heading_color', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_color')) ]
                    ];

        /*
         *
         *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *      Prices Rules
         *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */

        //  Original Price color (Red, Green, Yellow)
        $extra [] = [ 'key' => 'price_color', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_color')) ]
                    ];
        //  Compare At Price color (Red, Green, Yellow)
        $extra [] = [ 'key' => 'compare_at_price_color', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_color')) ]
                    ];
        //  Badge color (Red, Green, Yellow)
        $extra [] = [ 'key' => 'badge_color', 
                      'value' => [ "required","string", "in:".implode(',',config('upsell.strings.text_color')) ]
                    ];

        /*
         *
         *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *      Accept and Decline Offer button Rules
         *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $extra [] = [ 'key' => 'accept_offer_text', 
                      'value' => [ "required","string","max:191" ]
                    ];

        $extra [] = [ 'key' => 'decline_offer_text', 
                      'value' => [ "required","string","max:191" ]
                    ];

        /*
         *
         *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *      Product Images/TItle Rules
         *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        if(request()->has('Tproducts')):
            $TproductsCount     = count(request('Tproducts'));
            $extra [] = [ 'key' => 'Tproductsimages', 'value' => [ "required", 'array', "size : $TproductsCount" ] ];
            $extra [] = [ 'key' => 'Tproductsimages.*', 'value' => [ "required", 'string'] ];
            $extra [] = [ 'key' => 'Tproductstitles', 'value' => [ "required", 'array', "size : $TproductsCount" ] ];
            $extra [] = [ 'key' => 'Tproductstitles.*', 'value' => [ "required", 'string'] ];
        endif;
        if(request()->has('Aproducts')):
            $AproductsCount = count(request('Aproducts'));
            $extra [] = [ 'key' => 'Aproductsimages', 'value' => [ "required", 'array', "size :  $AproductsCount" ] ];
            $extra [] = [ 'key' => 'Aproductsimages.*', 'value' => [ "required", 'string', 'max:191' ] ];
            $extra [] = [ 'key' => 'Aproductstitles', 'value' => [ "required", 'array', "size :  $AproductsCount" ] ];
            $extra [] = [ 'key' => 'Aproductstitles.*', 'value' => [ "required", 'string', 'max:191' ] ];
        endif;
        if(request()->has('Dproducts')):
            $DproductsCount = count(request('Dproducts'));
            $extra [] = [ 'key' => 'Dproductsimages', 'value' => [ "required", 'array', "size :  $DproductsCount" ] ];
            $extra [] = [ 'key' => 'Dproductsimages.*', 'value' => [ "required", 'string', 'max:255' ] ];
            $extra [] = [ 'key' => 'Dproductstitles', 'value' => [ "required", 'array', "size :  $DproductsCount" ] ];
            $extra [] = [ 'key' => 'Dproductstitles.*', 'value' => [ "required", 'string', 'max:255' ] ];
        endif;

        return $extra;
    }
    
}