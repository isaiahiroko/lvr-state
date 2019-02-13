# LVR State

## Introduction
A single-source-of-truth state management library for Laravel applications. Access a singleton object across your controller and views.

## Installation
1. Install using composer
    ```
    $ composer require isaiahiroko/lvr-state
    ```
2. Add provider to config/app.php
    ```
    'providers' => [

        ...

        Isaiahiroko/LvrState/Provider::class,

    ],
    ```

## API
The library has a single class with the following public methods:

+ **public function set($key, $value = null): void**
Save a value, with a given key to the store. The key can be any string. Dotted string are exploded and converted to multi-dimensional array.
For instance all the following snippet gives the same output:
    ```
    // One
    $state->set('app', [
        'name' => 'lvr-state',
        'version' => '0.0.0',
    ]);

    // Two
    $state->set([
        'app.name' => 'lvr-state',
        'app.version' => '0.0.0',
    ]);

    // Three
    $state->set('app.name' => 'lvr-state');
    $state->set('app.version' => '0.0.0');

    ```
+ **public function get($key, $default = null): mixed**
Retrieve a value from the state store. Dotted notation are converted to array keys. null is returned if the key is not found. If default value can be provided, to be return if key is not found.

    ```
    $state->get('app'); //array('app.name' => 'lvr-state', 'app.version' => '0.0.0')
    ]
    $state->get('app.name'); //lvr-state
    $state->get('app.version'); //0.0.0
    ```


+ **public function has($key): boolean**
Check if a key is available in the state store.

***All state values are kept in memory only, its not persistent or cached.***

## Usage

### In Controllers
```
use GroupApp\Services\StateService;
use App\User;

public function sample_ctrl_meth(Request $request, StateService $state)
{
    $state->set([
        'title' => 'Lvr Sample Site',
        'users' => User::where()->paginate(15),
    ]);
}

    
```
### In Views
The variable $state is automatically available in all views. It can be use to `get()` or `set()` or `has()`.

```
<title>{{ $state->get('title', 'Group App') }}</title>

<h1>{{ $state->get('app.user.entity.name') }}</h1>

<ul class="nav navbar-nav mr-auto d-md-down-none">
    @foreach($state->get('app.actions') as $action)
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ $action->url }}">{{ $action->title }}</a>
        </li>
    @endforeach
</ul>
```

## [License](./LICENSE.md)