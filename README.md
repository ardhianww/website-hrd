# HRD System

A comprehensive Human Resource Management System built with Laravel, featuring employee management, attendance tracking, payroll processing, recruitment, and leave management.

## Features

### 1. Employee Management

-   Complete employee profile management
-   Personal information tracking
-   Department and position management
-   Employment status tracking
-   Salary and bank information
-   BPJS and tax information

### 2. Attendance Management

-   Daily attendance tracking
-   Multiple attendance status (present, late, early leave)
-   Location tracking for check-in/out
-   Device and IP tracking
-   Attendance history and reporting

### 3. Payroll Management

-   Monthly payroll processing
-   Automatic salary calculation
-   Support for allowances and deductions
-   Overtime and bonus management
-   Tax and BPJS calculations
-   Payslip generation
-   Payment status tracking

### 4. Recruitment Management

-   Job vacancy posting
-   Multiple employment types
-   Application tracking system
-   Resume and document management
-   Interview scheduling
-   Application status tracking
-   Candidate evaluation

### 5. Leave Management

-   Multiple leave types
-   Leave request submission
-   Attachment support
-   Approval workflow
-   Leave balance tracking
-   Leave history

## Requirements

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   SQLite/MySQL
-   Laravel 11.x

## Installation

1. Clone the repository

```bash
git clone https://github.com/yourusername/hrd-system.git
cd hrd-system
```

2. Install PHP dependencies

```bash
composer install
```

3. Install and compile frontend dependencies

```bash
npm install
npm run dev
```

4. Configure environment variables

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env`

```
DB_CONNECTION=sqlite
# or for MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hrd_system
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

7. Start the development server

```bash
php artisan serve
```

## Default Admin Account

-   Email: admin@example.com
-   Password: password

## Project Structure

```
hrd-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Application controllers
│   │   └── Middleware/     # Custom middleware
│   └── Models/            # Eloquent models
├── database/
│   ├── factories/         # Model factories for testing/seeding
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── resources/
│   ├── css/              # CSS assets
│   ├── js/               # JavaScript assets
│   └── views/            # Blade templates
│       ├── employees/    # Employee management views
│       ├── attendances/  # Attendance management views
│       ├── payrolls/     # Payroll management views
│       ├── jobs/         # Recruitment management views
│       └── leaves/       # Leave management views
├── routes/
│   └── web.php          # Web routes
├── public/              # Public assets
└── storage/            # File uploads and logs
```

## Key Files

-   `app/Models/`: Contains all model definitions
-   `database/migrations/`: Database structure
-   `database/seeders/`: Sample data generation
-   `resources/views/`: Frontend templates
-   `routes/web.php`: Route definitions

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
