# PHP MySQL Docker Example

This project demonstrates a simple PHP + MySQL web application running in Docker containers. It includes a registration form that saves user data to a MySQL database and displays all registered users.

## Features

- PHP 8.2 with Apache
- MySQL 8.0
- User registration form (name, email)
- Data is saved and displayed in a table
- phpMyAdmin for database management
- All services run via Docker Compose

## Project Structure

```
php-mysql-docker/
├── docker-compose.yml
├── php/
│   ├── index.php
│   ├── process.php
├── sql/
│   └── init.sql
```

## Getting Started

### Prerequisites

- [Docker](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/)

### Setup & Run

1. Clone this repository:
   ```sh
   git clone https://github.com/yourusername/php-mysql-docker.git
   cd php-mysql-docker
   ```
2. Start the containers:
   ```sh
   docker-compose up -d
   ```
3. Open your browser and go to [http://localhost:8080/php/index.php](http://localhost:8080/php/index.php)
4. Access phpMyAdmin at [http://localhost:8081](http://localhost:8081) (user: `root`, password: `root`)

### Stopping the App

```sh
docker-compose down
```

## Customization

- Edit `php/index.php` and `php/process.php` for your PHP logic.
- Edit `sql/init.sql` to change the initial database schema.

## License

MIT
