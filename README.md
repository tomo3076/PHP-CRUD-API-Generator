# PHP CRUD API Generator 🚀

![PHP CRUD API Generator](https://img.shields.io/badge/version-1.0.0-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![GitHub stars](https://img.shields.io/github/stars/tomo3076/PHP-CRUD-API-Generator.svg?style=social)

Welcome to the **PHP CRUD API Generator** repository! This tool helps you quickly create a fully functional API for your MariaDB or MySQL database using PHP. Whether you are a developer looking to streamline your API development or a beginner eager to learn, this project provides a simple and effective solution.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Configuration](#configuration)
- [Contributing](#contributing)
- [License](#license)
- [Support](#support)

## Features

- **Easy Setup**: Quickly generate APIs with minimal configuration.
- **Supports MariaDB and MySQL**: Work with the databases you know.
- **RESTful API**: Follow REST principles for easy integration.
- **Customizable**: Modify generated code to suit your needs.
- **Lightweight**: Designed to be efficient and fast.

## Installation

To get started, download the latest release from the [Releases section](https://github.com/tomo3076/PHP-CRUD-API-Generator/releases). After downloading, extract the files to your server directory.

### Prerequisites

- PHP 7.2 or higher
- MariaDB or MySQL
- Composer (for dependency management)

### Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/tomo3076/PHP-CRUD-API-Generator.git
   ```

2. **Navigate to the Directory**:
   ```bash
   cd PHP-CRUD-API-Generator
   ```

3. **Install Dependencies**:
   ```bash
   composer install
   ```

4. **Configure Your Database**: Open the `config.php` file and set your database credentials.

5. **Run the Application**: Access the API through your web server.

## Usage

Once you have installed the API generator, you can start creating your endpoints. Here’s how to use the tool effectively:

1. **Define Your Database Structure**: Create tables in your MariaDB or MySQL database.
2. **Generate the API**: Use the command line to generate your API endpoints.
   ```bash
   php generate.php
   ```
3. **Test Your API**: Use tools like Postman or curl to test the endpoints.

## API Endpoints

The API supports various endpoints for CRUD operations:

- **Create**: POST request to create a new record.
- **Read**: GET request to retrieve records.
- **Update**: PUT request to update an existing record.
- **Delete**: DELETE request to remove a record.

### Example Requests

- **Create a Record**:
   ```bash
   curl -X POST -H "Content-Type: application/json" -d '{"name": "John Doe"}' http://yourapi.com/api/users
   ```

- **Read Records**:
   ```bash
   curl -X GET http://yourapi.com/api/users
   ```

- **Update a Record**:
   ```bash
   curl -X PUT -H "Content-Type: application/json" -d '{"name": "Jane Doe"}' http://yourapi.com/api/users/1
   ```

- **Delete a Record**:
   ```bash
   curl -X DELETE http://yourapi.com/api/users/1
   ```

## Configuration

To configure your API, modify the `config.php` file. You will need to set the following parameters:

- **Database Host**: Your database server address.
- **Database Name**: The name of your database.
- **Database User**: Your database username.
- **Database Password**: Your database password.

### Example Configuration

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

## Contributing

We welcome contributions! If you would like to help improve the PHP CRUD API Generator, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add some feature'`).
5. Push to the branch (`git push origin feature/YourFeature`).
6. Open a Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

If you have any questions or need support, please check the [Releases section](https://github.com/tomo3076/PHP-CRUD-API-Generator/releases) for updates. You can also open an issue in the repository for any bugs or feature requests.

---

Thank you for using the PHP CRUD API Generator! We hope this tool makes your API development process easier and more efficient. Happy coding!