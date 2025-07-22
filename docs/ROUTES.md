# Web Routes

Dokumentasi rute (web) untuk aplikasi **IT Standards Category**.  

| Method     | URI                                           | Name                              | Controller & Method                         | Middleware           |
| ---------- | --------------------------------------------- | --------------------------------- | -------------------------------------------- | -------------------- |
| **Guest**  |                                               |                                   |                                              |                      |
| GET        | `/`                                           | `public.categories.index`         | `PublicCategoryController@index`            | `guest`              |
| GET        | `/categories`                                 | `public.categories.index`         | `PublicCategoryController@index`            | `guest`              |
| GET        | `/categories/{category}`                      | `public.categories.show`          | `PublicCategoryController@show`             | `guest`              |
|            |                                               |                                   |                                              |                      |
| **Auth (Breeze)**                                                                                                                                |
| GET        | `/login`                                      | `login`                           | `AuthenticatedSessionController@create`     | `guest`              |
| POST       | `/login`                                      | (no name)                         | `AuthenticatedSessionController@store`      | `guest`              |
| POST       | `/logout`                                     | `logout`                          | `AuthenticatedSessionController@destroy`    | `auth`               |
| GET        | `/forgot-password`                            | `password.request`                | `PasswordResetLinkController@create`        | `guest`              |
| POST       | `/forgot-password`                            | `password.email`                  | `PasswordResetLinkController@store`         | `guest`              |
| GET        | `/reset-password/{token}`                     | `password.reset`                  | `NewPasswordController@create`              | `guest`              |
| POST       | `/reset-password`                             | `password.update`                 | `NewPasswordController@store`               | `guest`              |
|            |                                               |                                   |                                              |                      |
| **Admin**  | *prefix* `/admin`, *middleware* `auth`         |                                   |                                              |                      |
| GET        | `/admin/categories`                           | `admin.categories.index`          | `CategoryController@index`                  | `auth`               |
| GET        | `/admin/categories/create`                    | `admin.categories.create`         | `CategoryController@create`                 | `auth`               |
| POST       | `/admin/categories`                           | `admin.categories.store`          | `CategoryController@store`                  | `auth`               |
| GET        | `/admin/categories/{category}`                | `admin.categories.show`           | `CategoryController@show`                   | `auth`               |
| GET        | `/admin/categories/{category}/edit`           | `admin.categories.edit`           | `CategoryController@edit`                   | `auth`               |
| PUT/PATCH  | `/admin/categories/{category}`                | `admin.categories.update`         | `CategoryController@update`                 | `auth`               |
| DELETE     | `/admin/categories/{category}`                | `admin.categories.destroy`        | `CategoryController@destroy`                | `auth`               |
| GET        | `/admin/categories/{category}/items/create`   | `admin.categories.items.create`   | `ItemController@create`                     | `auth`               |
| POST       | `/admin/categories/{category}/items`          | `admin.categories.items.store`    | `ItemController@store`                      | `auth`               |
| GET        | `/admin/categories/{category}/items/{item}`                         | `admin.categories.items.show`               | `ItemController@show`                       | `auth`               |
| GET        | `/admin/categories/{category}/items/{item}/edit`                    | `admin.categories.items.edit`               | `ItemController@edit`                       | `auth`               |
| PUT/PATCH  | `/admin/categories/{category}/items/{item}`                         | `admin.categories.items.update`             | `ItemController@update`                     | `auth`               |
| DELETE     | `/admin/categories/{category}/items/{item}`                         | `admin.categories.items.destroy`            | `ItemController@destroy`                    | `auth`               |

