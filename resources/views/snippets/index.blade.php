<script>
        var alpha_upsell_currency_symbol = "@{{  cart.currency.symbol }}";
        var alpha_upsell_cart = "@{{  cart.item_count }}";
        var alpha_variant_id  = "@{{ product.variants[0].id }}";
        {% if template contains "product" %}
            var alpha_upsell_productId   = "@{{ product.id }}";
            var alpha_upsell_producthandle = "@{{ product.handle }}";
            var alpha_upsell_value = "@{{ product.price | money_without_currency }}";
            var alpha_upsell_product_collection_ids = [
                {% for collection in product.collections %}
                    "@{{ collection.id }}",
                {% endfor %}
            ];
            var alpha_upsell_product_tags = [
                {% for tag in product.tags %}
                    "@{{ tag | replace: '"', "" | replace: "'", "" | strip }}", 
                {% endfor %}
            ];
        {% endif %}
        var alpha_upsell_product_ids = [
            {% for item in cart.items %}
                "@{{ item.product.id }}", 
            {% endfor %}
        ];
        var alpha_upsell_collectionsIds = [
            {% for item in cart.items %}
                {% for collection in item.product.collections %}
                    "@{{ collection.id }}",
                {% endfor %}
            {% endfor %}
        ];

        var alpha_upsell_tags = [
            {% for item in cart.items %}
                {% for tag in item.product.tags %}
                    "@{{ tag | replace: '"', "" | replace: "'", "" | strip }}",
                {% endfor %}
            {% endfor %}
        ];
    var alpha_upsell_script = document.createElement('script');
    alpha_upsell_script.src = "{{ secure_asset('js/alpha_upsell.js') }}"
    alpha_upsell_script.type = "text/javascript";
    document.body.appendChild(alpha_upsell_script);
</script>