# Template Replacement
Template replacement use to replace string template using available method, property, or data from params.

# How To Install
Minimal php version is 8.0
Since this package is not publish in packagist yet, you noeed to add source of this pckage on your **composer.json** file
You can install this package via composer with 

```json
"repositories":[
  {
    "type": "vcs",
    "url": "git@github.com:classid/template-replacement.git"
  }
],
```
```
composer require classid/template-replacement
```

# Publish Vendor
You can publish vendor for modify configuration
```console
php artisan vendor:publish --provider="Classid\TemplateReplacement\TemplateReplacementProvider"
```

# How to use
This is example how to use template replacement. 
You need to prepare string template to replace by information from existing class.
From config we can define directory for class that we will iterate to replace string template.


## String template convetion (using snake case)
```php
<?php
use Classid\TemplateReplacement\TemplateReplacement;

#for placeholder, the format is using snake case. Ex: full_name
$result = TemplateReplacement::execute("Halo, my name is {full_name}. I'm {old} years old");
?>
```

## Replace variable from method and property class (static)
Create a class inside directory path that defined on **templatereplacement.php**
Mostly this way is used for static variable, such like current date, app name, or another static/configuration information.
```php
<?php

namespace App\Services\GeneralReplacement;

use Classid\TemplateReplacement\Abstracts\BaseInformation;
use Classid\TemplateReplacement\Interfaces\InformationInterface;

class InformationUserReplacement extends BaseInformation
{
    #property name using camel case format
    public string $oldYear = "13";

    #method name using camel case format
    public function getFirstName():string
    {
        return "iqbal";
    }

    public function getLastName():string
    {
        return "muliawan";
    }

    public function getFullName():string
    {
        return "iqbal atma muliawan";
    }
}



use Classid\TemplateReplacement\TemplateReplacement;

$result = TemplateReplacement::execute("Halo, my name is {full_name}. I'm {old_year} years old. I live in {address}");

#the result would be "Halo, my name is iqbal atma mulawain. I'm 13 years old. I live in {address}"
#the {address} will still remain like that, because there is no method or property to replace {address}
?>
```
## Replace variable from method and property class (dynamic)
```php
<?php

namespace App\Services\GeneralReplacement;

use Classid\TemplateReplacement\Abstracts\BaseInformation;
use Classid\TemplateReplacement\Interfaces\InformationInterface;

class InformationUserReplacement extends BaseInformation
{
    #property name using camel case format
    public string $oldYear = "13";

    #method name using camel case format
    public function getFirstName():string
    {
        return "iqbal";
    }

    public function getLastName():string
    {
        return "muliawan";
    }

    public function getFullName():string
    {
        return "iqbal atma muliawan " . self::getParameter("title");
    }
}



use Classid\TemplateReplacement\TemplateReplacement;

$result = TemplateReplacement::execute(
  "Halo, my name is {full_name}. I'm {old_year} years old. I live in {address}",
  ["title" => "S.Kom"]
);

#you can pass array as second parameter, and then get that array from dynamic method using static method self::getParameter("key_name")
#with this dynamic data you can also query inside that method
#the result would be "Halo, my name is iqbal atma mulawain S.Kom. I'm 13 years old. I live in {address}"
#the {address} will still remain like that, because there is no method or property to replace {address}
?>
```
## Replace variable using first priority data
You can override the information on the class. You just need pass array on third parameter, with key exactly same as string template.
```php
<?php

use Classid\TemplateReplacement\TemplateReplacement;

$result = TemplateReplacement::execute(
  "Halo, my name is {full_name}. I'm {old_year} years old. I live in {address}",
  ["title" => "S.Kom"],
  ["full_name" => "Budi"]
);
#the result would be "Halo, my name is Budi. I'm 13 years old. I live in {address}"

