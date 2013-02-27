AstinaSeoBundle
===============

Allows management of page title, meta description and meta keywords.

## Installation

### Step 1: Add to composer.json

```
"require" :  {
    // ...
    "astina/seo-bundle":"dev-master",
}
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Astina\Bundle\SeoBundle\AstinaSeoBundle(),
    );
}
```

### Step 3: Configuration

There is nothing to configure!

## Usage

Place `{{ seo_meta_tags(app.request) }}` in your Twig template where you want the meta tags to be rendered.

Parameters:

```php

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $defaultTitle
     * @param array $defaults
     * @param string $titleSuffix
     * @return string
     */
    public function renderPageMetaTags(Request $request, $defaultTitle = null, array $defaults = array(), $titleSuffix = null)
```

The function tries to find a `PageMetaData` entity for the current request and uses it to render the meta tags.

@todo: UI to create/delete `PageMetaData` entitites.
