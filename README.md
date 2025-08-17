# 🌿 Glowlin Earthy Bloom - Laravel Version

A modern, full-stack e-commerce platform for natural skincare products, built with Laravel, Livewire, and MySQL.

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js (for frontend assets)

### Automated Setup
```bash
# Clone the repository
git clone <your-repo-url>
cd glowlin-laravel

# Run the setup script
./setup.sh
```

### Manual Setup

1. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   Configure `.env` file:
   ```env
   APP_NAME="Glowlin Earthy Bloom"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=glowlin_earthy_bloom
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Database Setup:**
   ```bash
   php artisan migrate --seed
   ```

4. **Start development server:**
   ```bash
   php artisan serve
   ```
   
   Application will be available at: `http://localhost:8000`

## 🌐 Access Points

- **Frontend**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin
- **API Endpoints**: http://localhost:8000/api/*

## 🏗 Architecture

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Frontend      │    │   Backend       │    │   Database      │
│   (Blade +      │◄──►│   (Laravel)     │◄──►│   (MySQL)       │
│   Livewire)     │    │   (Livewire)    │    │                 │
│   Port: 8000    │    │   Port: 8000    │    │   Port: 3306    │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## 🛠 Technology Stack

### Backend
- **Framework**: Laravel 12
- **Database**: MySQL 8.0
- **ORM**: Eloquent
- **Authentication**: Laravel Breeze
- **Real-time**: Livewire 3
- **Frontend**: Blade Templates + Tailwind CSS

### Frontend
- **CSS Framework**: Tailwind CSS
- **JavaScript**: Alpine.js (included with Livewire)
- **Icons**: Heroicons
- **Fonts**: Playfair Display + Inter

## 📁 Project Structure

```
glowlin-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Route controllers
│   │   └── Middleware/      # Custom middleware
│   ├── Livewire/           # Livewire components
│   ├── Models/             # Eloquent models
│   └── Providers/          # Service providers
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   ├── views/             # Blade templates
│   │   ├── layouts/       # Layout templates
│   │   └── livewire/      # Livewire component views
│   ├── css/               # Tailwind CSS
│   └── js/                # JavaScript files
├── routes/
│   └── web.php            # Web routes
└── public/                # Public assets
```

## 🔑 Key Features

- **User Authentication** - Laravel Breeze with login/register
- **Product Management** - CRUD operations with Livewire
- **Shopping Cart** - Real-time cart with Livewire
- **Order Management** - Complete order lifecycle
- **Admin Panel** - Product and order management
- **Responsive Design** - Mobile-first approach
- **Real-time Updates** - Livewire for dynamic interactions

## 🗄 Database Schema

### Core Tables
- **users** - User accounts and authentication
- **products** - Product catalog with images
- **cart_items** - Shopping cart items
- **orders** - Order management
- **order_items** - Order details

## 🔧 Environment Variables

### Required (.env)
```env
APP_NAME="Glowlin Earthy Bloom"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=glowlin_earthy_bloom
DB_USERNAME=root
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 🚀 Deployment

### Shared Hosting (cPanel)
1. Upload files to public_html
2. Set document root to public folder
3. Configure database in .env
4. Run migrations: `php artisan migrate --seed`

### VPS/Cloud Server
1. Install LAMP stack (Linux, Apache, MySQL, PHP)
2. Clone repository
3. Set up virtual host
4. Configure .env file
5. Run setup commands

### Docker (Optional)
```bash
# Build and run with Docker
docker-compose up -d
```

## 📚 API Endpoints

### Public
- `GET /` - Home page
- `GET /products` - Products listing
- `GET /products/{id}` - Product details
- `GET /about` - About page
- `GET /contact` - Contact page

### Authentication
- `GET /login` - Login page
- `POST /login` - Login action
- `GET /register` - Register page
- `POST /register` - Register action
- `POST /logout` - Logout action

### Protected
- `GET /cart` - Shopping cart
- `POST /cart/add` - Add to cart
- `PUT /cart/update/{id}` - Update cart
- `DELETE /cart/remove/{id}` - Remove from cart
- `GET /checkout` - Checkout page
- `POST /orders` - Create order
- `GET /orders` - User orders
- `GET /profile` - User profile

### Admin
- `GET /admin` - Admin dashboard
- `GET /admin/products` - Product management
- `POST /admin/products` - Create product
- `PUT /admin/products/{id}` - Update product
- `DELETE /admin/products/{id}` - Delete product
- `GET /admin/orders` - Order management

## 🎨 UI Components

Built with **Tailwind CSS** and **Livewire**:
- Responsive navigation
- Product cards with hover effects
- Shopping cart with real-time updates
- Form components with validation
- Toast notifications
- Loading states and skeletons

## 🔒 Security Features

- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection
- Input validation
- Authentication middleware
- Role-based access control

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📊 Performance

- **Database**: Query optimization, indexing
- **Frontend**: Asset compilation, caching
- **Backend**: Route caching, config caching
- **Livewire**: Component caching, lazy loading

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection**
   - Verify MySQL is running
   - Check database credentials in .env
   - Run `php artisan migrate:status`

2. **Livewire Issues**
   - Clear caches: `php artisan optimize:clear`
   - Check Livewire assets: `php artisan livewire:publish --assets`

3. **Permission Issues**
   - Set storage permissions: `chmod -R 775 storage bootstrap/cache`
   - Create storage link: `php artisan storage:link`

4. **Composer Issues**
   - Clear composer cache: `composer clear-cache`
   - Reinstall dependencies: `composer install --no-cache`

### Debug Commands
```bash
# Laravel
php artisan serve          # Start development server
php artisan migrate        # Run migrations
php artisan db:seed        # Seed database
php artisan tinker         # Interactive shell
php artisan route:list     # List all routes

# Livewire
php artisan livewire:publish --assets  # Publish assets
php artisan livewire:discover          # Discover components

# Cache
php artisan config:clear   # Clear config cache
php artisan cache:clear    # Clear application cache
php artisan view:clear     # Clear view cache
php artisan route:clear    # Clear route cache
```

## 📈 Monitoring

- **Logs**: `storage/logs/laravel.log`
- **Debug**: Laravel Telescope (optional)
- **Performance**: Laravel Debugbar (development)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Laravel Docs
- **Livewire Docs**: https://laravel-livewire.com/docs
- **Issues**: Create an issue in the repository

## 🎉 Acknowledgments

- **Laravel** for the excellent framework
- **Livewire** for real-time interactions
- **Tailwind CSS** for utility-first styling
- **Alpine.js** for lightweight JavaScript

---

**🌿 Glowlin Earthy Bloom** - Natural skincare for a radiant you! ✨

**Last Updated**: January 2025  
**Version**: 1.0.0 (Laravel)
