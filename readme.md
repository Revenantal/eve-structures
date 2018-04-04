# EVE Structures

**Please note that this is still in early development, and may not be stable.** Master branch releases should be reliable enough to use, while the Dev branch should be treated as unstable.

A powerful organization tool for you to keep track of all your shiny structures in EVE online at an Alliance, Corporation, Or Personal level.

## Before Proceeding...

This application has been built primarily for cloud base structure management. This means if you are **NOT** an IT nerd, it's great for you! You can use the secure cloud based system at [EVE Structures](https://eve-structures.xyz) where your data is safe and secure. Your data will **NEVER** be shared and I work under no affiliation to any entity within EVE Online with this service.

If you are a paranoid IT Nerd, or wish to contribute to the development of EVE Structures, please feel free to continue reading below!


## Installation
### Prerequisites

At this point in time the requirements are pretty sparse, but will likely expand down the line.

* Nothing beyond the standard [Laravel 5.6 install](https://laravel.com/docs/5.6/installation)

As an Aside, I use [Laragon](https://laragon.org/) for local development.


### Installing

Assuming you meet the requirements above and have a general understanding of *nix, cd to your web root and...

```
git clone https://github.com/revenantal/eve-structures.git
cd eve-structures
```

At this point you will want to manually edit the **.env.example** file location at **/eve-structures/.env.example** and update the following key values with your appropriate data, saving the updated file as **.env**.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

EVEONLINE_CLIENT_ID=
EVEONLINE_CLIENT_SECRET=
EVEONLINE_REDIRECT=http://localhost/auth/callback
```

You can obtain your eve online details from [https://developers.eveonline.com/](https://developers.eveonline.com/).
The following scopes are required from EVE Online.

```
esi-universe.read_structures.v1
esi-corporations.read_structures.v1
esi-characters.read_corporation_roles.v1
```

Assuming you haven't left the eve-structures folder you can finish the install with the following commands.

```
composer install
npm install
php artisan migrate --seed
```

## Reporting Bugs

Please report issues using [Github](https://github.com/revenantal/eve-structures/issues).

## Social

Feel free to join us on [Discord](https://discord.gg/j6jy5E9)!