
## LaraVue Notes

A public *note-taking* application based on Laravel 5.7, Vue 2 and Bootstrap 4.

The goal is to allow anyone to create and manage their notes based on a *unique* visitor token.

![Preview Index](https://i.imgur.com/IKWTu0x.png)

##### How to install?

- Clone this repository or install it through `composer create-project fullstackmx/laravue-notes`.
- Run `composer install --no-dev` for production or `composer install` for local environments.
- Run the migrations `php artisan migrate`.
- Enjoy!

**Note:** This package is homestead ready so you can use `./vendor/bin/homestead make` to init the `Homestead.yaml` file.

#### Features

- 4 different styles (colors): blue, yellow, red and green.
- No auth needed. There is an automatic *registration process* that creates or validates a public token which is the reference for restoring previous notes.
- *NULL* titles supported, because I know not all the notes require titles.
- Basic validations.
- REST friendly.
- Production and *Homestead* ready.

![Preview new note](https://i.imgur.com/I5k54GH.png)

## Contributing

Thank you for considering contributing to the project! Feel free to fork this project, work around your improvements or features and send me a PR.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
