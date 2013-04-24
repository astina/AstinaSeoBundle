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

### Step 3: Load routing config

Add routing if you want to be able to edit page meta data directly.

```yml
astina_seo:
    resource: "@AstinaSeoBundle/Resources/config/routing.yml"
```

Warning: make sure to protect this URL in your app/config/security.yml

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

### Global Defaults
Configure global default values for title, description and keywords if needed:

```yml
# app/config.yml
astina_seo:
    global_defaults:
        title: "Foo App"
        description: "The greatest and bestest app in the internet"
        keywords: "greatest, bestest"
```

@todo: UI to create/delete `PageMetaData` entitites.
