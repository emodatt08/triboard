# Triboard 

> Triboard is a full Todos Vue.js web Application which is powered by Laravel's API resources. The discription for the API can be found below.


<h2 id="screenshots">Screenshots</h2>

![](/screenshots/triboard.PNG)


## Quick Start

``` bash
# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Articles
php artisan db:seed

# Add virtual host if using Apache

# If you get an error about an encryption key
php artisan key:generate

# Initialize vue.js by running:
npm run watch
```

## Endpoints

### List all todos with links and meta
``` bash
GET /api/todos
```
### Get single todo item
``` bash
GET /api/todos/{id}
```

### Delete todo item
``` bash
DELETE  /api/todos/{id}
```

### Add a todo item
``` bash
POST /api/todos
title/body
```

### Update a todo item
``` bash
PUT  /api/todos
todo_id/title/body
```


```

## App Info

### Author

Kollan Hillary


### Version

1.0.0

### License

This project is licensed under the MIT License
