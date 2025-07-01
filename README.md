# CRUD MongoDB with Docker Compose

This project is a simple PHP CRUD application that uses MongoDB as its database. Docker Compose sets up both the PHP Apache container and the MongoDB container for local development.

The repository is organized so that all PHP source code resides in the `src` directory while configuration files such as `Dockerfile` and `docker-compose.yml` remain at the project root.

## Prerequisites

- Docker
- Docker Compose

## Running the Application

1. Build and start the containers:

   ```bash
   docker-compose up --build
   ```

   The PHP application will be available on [http://localhost:8080](http://localhost:8080) and MongoDB will be accessible on port `27016` on the host.

2. Stop the containers with `Ctrl+C` and remove them using:

   ```bash
   docker-compose down
   ```

## Creating the Required Collection

The application expects a MongoDB database named `catalogosites` with a collection called `sites`. When the application runs for the first time it will attempt to insert into this collection, but you can create it manually through the Mongo shell if desired:

```bash
docker-compose exec mongo mongosh
```

Once inside the Mongo shell, run the following commands:

```javascript
use catalogosites
db.createCollection('sites')
```

You can then exit the shell with `exit`.

The application container communicates with MongoDB using the environment variables defined in `docker-compose.yml`.
