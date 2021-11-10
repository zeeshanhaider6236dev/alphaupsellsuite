<?php
return [
    //apis used for the app
    'apis' => [
        //get shop settings i.e. shop api
        'shop' => [
            '/admin/api/2021-07/shop.json'
        ],
        //get all themes api
        'getAllThemes' => [
            '/admin/api/2020-04/themes.json'
        ],
        //save script tag api
        'saveScriptTag' => [
            '/admin/api/2020-04/script_tags.json'
        ],
        //get single asset of a theme
        'getSingleAsset' => [
            '/admin/api/2020-04/themes/',
            '/assets.json'
        ],
        //save single asset of a theme
        'saveSingleAsset' => [
            '/admin/api/2020-04/themes/',
            '/assets.json'
        ],
        //delete asset of a theme
        'deleteAsset' => [
            '/admin/api/2020-04/themes/',
            '/assets.json'
        ],
        //products count
        'getProductsCount' => [
            '/admin/api/2020-10/products/count.json'
        ],
        //apis for testing purpose

        // get all webhooks
        'getWebhooks' => [
            '/admin/api/2020-10/webhooks.json'
        ],
        'cancelCharge' => [
            '/admin/api/2020-07/recurring_application_charges/',
            '.json'
        ],
        'getProducts' => [
            '/admin/api/2020-10/products.json'
        ],
        'getProductById' => [
            '/admin/api/2020-10/products/',
            '.json'
        ],
        'getCustomCollection' => [
            '/admin/api/2020-10/custom_collections.json'
        ],
        'getAutomaticCollection' => [
            '/admin/api/2020-07/smart_collections.json'
        ],
        "getSingleAutomaticCollection" => [
            "/admin/api/2020-10/smart_collections/",
            ".json"
        ],
        "getSingleCustomCollection" => [
            "/admin/api/2020-10/custom_collections/",
            ".json"
        ],
        "shippingApi" => [
            "/admin/api/2020-10/shipping_zones.json"
        ],
        'getCollectionProducts' => [
            "/admin/api/2020-10/collections/",
            "/products.json"
        ],
        "getVariants" => [
            "/admin/api/2020-10/products/",
            '/variants.json'
        ],
        'getProductCollectionIds' => [
            '/admin/api/2020-10/collects.json'
        ],
        'getProductMetaFields' => [
            '/admin/api/2020-10/products/',
            '/metafields.json'
        ],
        //create script tag
        'createScriptTag' => [
            '/admin/api/2021-01/script_tags.json'
        ],
        //delete script tag
        'deleteScriptTag' => [
            '/admin/api/2021-01/script_tags/',
            '.json'
        ],
        //create price rule
        'createPriceRule' => [
            '/admin/api/2021-01/price_rules.json'
        ],
        //delete price rule
        'deletePriceRule' => [
            '/admin/api/2021-01/price_rules/',
            '.json'
        ],
        //create discount code
        'createDiscountCode' => [
            '/admin/api/2021-01/price_rules/',
            '/discount_codes.json'
        ]
    ],
    "graphQl" => [
        "apis" => [
            'getProductsBySearch' => [
                '{
                    products(query:"title:',
                    '*",',
                    ':',
                    '',
                    '',
                    ')
                    {
                        pageInfo{
                            hasNextPage
                            hasPreviousPage
                        }
                        edges {
                            cursor
                            node {
                                id
                                title
                                featuredImage {
                                    src
                                }
                                publishedAt
                            }
                        }
                    }
                }'
            ],
            'getTagsBySearch' => [
                '{
                    shop {
                        productTags(first: 250) {
                            edges {
                                node
                            }
                        }
                    }
                }'
            ],
            'getCollectionsBySearch' => [
                '{
                    collections(query:"title:',
                    '*",',
                    ':',
                    '',
                    '',
                    ') {
                        edges {
                            node {
                                title
                                id
                                image {
                                    src
                                }
                            }
                            cursor
                        }
                        pageInfo {
                            hasPreviousPage
                            hasNextPage
                        }
                    }
                }'
            ],
            'getProductsByIds' => [
                '{
                    nodes(ids: [',']) {
                        ...on Product {
                            id
                            handle
                            title
                            featuredImage {
                                src
                            }
                            variants(first:1){
                                edges{
                                    node{
                                        title
                                        id
                                        price
                                        compareAtPrice
                                    }
                                }
                            }
                        }
                    } 
                }'
            ],
            'getProductsByTag' => [
                '{
                    products(first: 50, query: "tag:','") {
                        pageInfo {
                            hasNextPage
                        }
                        edges {
                            node {
                                id
                                handle
                                title
                                tags
                                featuredImage {
                                        src
                                }
                                variants(first: 1) {
                                    edges {
                                        node {
                                            id
                                            compareAtPrice
                                            price
                                        }
                                    }
                                }
                            }
                        }
                    }
                }'
            ],
            'getProductIdsByTag' => [
                '{
                    products(first: 250, query: "tag:','") {
                        pageInfo {
                            hasNextPage
                        }
                        edges {
                            node {
                                id
                            }
                        }
                    }
                }'
            ],
            'getCollectionProducts' => [
                '{
                    nodes(ids: [',']) {
                        ...on Collection {
                            products(first: 50) {
                                edges {
                                    node {
                                        id
                                        handle
                                        title
                                        featuredImage {
                                            src
                                        }
                                        variants(first: 1) {
                                            edges{
                                                node {
                                                    id
                                                    price
                                                    compareAtPrice
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }'
              ],
              'getCollectionProductsIds' => [
                '{
                    nodes(ids: [',']) {
                        ...on Collection {
                            products(first: 50) {
                                edges {
                                    node {
                                        id
                                    }
                                }
                            }
                        }
                    }
                }'
              ]

            // "getVarientByProductId" => [
            //     '{
            //         product(id: "gid://shopify/Product/',
            //         '") 
            //         {
            //             variants(first: 100) {
            //                 edges {
            //                     node {
            //                         image {
            //                             src
            //                         }
            //                         id
            //                         sku
            //                         title
            //                     }
            //                 }
            //             }
            //         }
            //     }'
            // ],
            // "insertPrivateMetaField" => [
            //     'mutation($input: ProductInput!) {
            //         productUpdate(input: $input) {
            //             product {
            //                 id
            //             }
            //         }
            //     }'
            // ],
            // "getPrivateMetaField" => [
            //     '{
            //         product(id: "gid://shopify/Product/',
            //         '") {
            //             metafield(namespace: "',
            //             '", key: "',
            //             '") {
            //                 value
            //             }
            //         }
            //     }'
            // ],
            // "insertGoogleStatusTags" => [
            //     'mutation tagsAdd($id: ID!, $tags: [String!]!) {
            //         tagsAdd(id: $id, tags: $tags) {
            //             node {
            //                 id
            //             }
            //         }
            //     }'
            // ],
            // "removeGoogleStatusTags" => [
            //     'mutation tagsRemove($id: ID!, $tags: [String!]!) {
            //         tagsRemove(id: $id, tags: $tags) {
            //             node {
            //                 id
            //             }
            //         }
            //     }'
            // ],

        ]
    ],
    // constant string used in the app
    'strings' => [
        'app_snippet_key' => "snippets/".env('APP_SNIPPET_FILE_NAME').".liquid",
        "graphQlProductIdentifier" => "gid://shopify/Product/",
        "graphQlVarientIdentifier" => "gid://shopify/ProductVariant/",
        "graphQlCollectionIdentifier" => "gid://shopify/Collection/",
        "privateMetaFieldsPrefix" => env('APP_URL'),
        'app_include' => env('APP_START_IDENTIFIER')."\n {% capture snippet_content %}\n {% include '".env('APP_SNIPPET_FILE_NAME')."' %} \n{% endcapture %} \n{% unless snippet_check contains 'Liquid error' %}\n {{ snippet_content }}\n {% endunless %}\n".env('APP_END_IDENTIFIER'),
        'app_start_identifier' => env('APP_START_IDENTIFIER'),
        'app_end_identifier' => env('APP_END_IDENTIFIER'),
        'app_include_before_tag' => "</body>",
        'theme_liquid_file' => "layout/theme.liquid",
        'userEmailAddress' => env('MAIL_USERNAME'),
    ],
    'scriptTag' => [
        'event' => env('UPSELL_POST_PURCHASE_EVENT'),
        'src'   => env('UPSELL_POST_PURCHASE_SRC')
    ],

    // 'assets' => [
    //     'flags' => [
    //         "key" => "assets/alphaCurrencyFlags.png",
    //         "src" => "assets/images/flags.png"
    //     ],
    //     'css' => [
    //         "key" => "assets/alphaCurrencyCss.css",
    //         "src" => "assets/css/css.css"
    //     ]
    //     ],
    // 'defaults' => [
    //     'default_countries' => [
    //         'USD','EUR','GBP','CAD','AUD'
    //     ]
    // ]
];
