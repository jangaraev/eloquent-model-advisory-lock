# eloquent-model-advisory-lock

Often you face the race conditions error when working with DB-intensive
operations.

This package contains a trait with the method which helps to avoid that.

## Usage

First do reference the trait in your model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jangaraev\EloquentModelAdvisoryLock\AppliesAdvisoryLock;

class Foo extends Model
{
    use AppliesAdvisoryLock;
    
    // ...
}
```

This trait introduces the `advisoryLock()` method which receives
a callable to execute.

You then can use this method to wrap your DB intensive calls.

```php
// wrap you DB-intensive operations as a callable to the advisoryLock call
static::advisoryLock(fn () => $this->coolRelationship()->firstOrCreate());
```