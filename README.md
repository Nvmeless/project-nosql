# project nosql

# Installation 
To run the project locally, you'll need :

```bash
docker fully installed
 ```

Clone the projet and go to the corresponding folder

Then,
```bash
    docker run --rm --interactive --tty \
    --volume $PWD:/app \
    composer install --ignore-platform-reqs
```

Then,

* `cp .env.example .env`
* `./vendor/bin/sail up`
* `./vendor/bin/sail artisan command:import-csv `


# Usage
