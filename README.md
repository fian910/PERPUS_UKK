# PERPUS_UKK - Library Management System

## Overview
PERPUS_UKK is a comprehensive library management system built using Laravel and Laravel Livewire. This application allows library administrators to manage books, members, borrowing transactions, and generate reports efficiently.

## Features
- **User Authentication and Role-based Access Control**
  - Admin and User login capabilities
  - Role-specific dashboards and permissions

- **Book Management**
  - Add, edit, and delete books
  - Categorize books by genre, author, and publisher
  - Track book availability status
  - Book search and filtering options

- **Member Management**
  - Register new members
  - View and update member information
  - Member search functionality

- **Borrowing System**
  - Process book loans and returns
  - Track due dates and late returns
  - Automatic fine calculation for late returns

- **Reporting**
  - Generate borrowing history reports
  - View statistics on most borrowed books
  - Export reports in PDF format

## Technology Stack
- **Backend**: Laravel 9.x
- **Frontend**: 
  - Laravel Livewire for dynamic interfaces
  - Tailwind CSS for styling
  - Alpine.js for JavaScript interactions
- **Database**: MySQL
- **Authentication**: Laravel Fortify

## Requirements
- PHP >= 8.0
- Composer
- MySQL or MariaDB
- Node.js and NPM

## Installation

1. Clone the repository:
```bash
git clone https://github.com/fian910/PERPUS_UKK.git
cd PERPUS_UKK
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Laravel Livewire:
```bash
composer require livewire/livewire
```

4. Install JavaScript dependencies:
```bash
npm install && npm run dev
```

5. Create a copy of the `.env.example` file:
```bash
cp .env.example .env
```

6. Generate application key:
```bash
php artisan key:generate
```

7. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_ukk
DB_USERNAME=root
DB_PASSWORD=
```

8. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

9. Start the local development server:
```bash
php artisan serve
```

10. Access the application at `http://localhost:8000`

## Default Admin Credentials
- **Email**: admin@perpus.com
- **Password**: password

## Usage

### Admin Panel
- Manage books, categories, and publishers
- Register and manage library members
- View comprehensive reports and statistics
- Configure system settings

### Staff Panel
- Process book borrowing and returns
- Manage member information
- Generate borrowing receipts

## Contributing
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements
- [Laravel](https://laravel.com)
- [Livewire](https://laravel-livewire.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)

## Contact
- Developer: [fian910](https://github.com/fian910)
- Project Link: [https://github.com/fian910/PERPUS_UKK](https://github.com/fian910/PERPUS_UKK)
