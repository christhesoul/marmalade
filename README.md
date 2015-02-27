Marmalade
=========

1. Install the bloody thing

```JSON
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/christhesoul/marmalade"
  }
]
"require": {
  "christhesoul/marmalade": "dev-master",
}

```

2. Add some products in the backend. (Marmalade creates a Product custom post type.)

3. Create your add to cart button. A bit like this:

```HTML+PHP
<p><a href="#" class="btn btn-success marmalade-add-to-cart" data-product="<? the_id(); ?>">Add to cart</a></p>
````
