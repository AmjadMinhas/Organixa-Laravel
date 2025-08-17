#!/bin/bash

echo "🚀 Setting up Glowlin Earthy Bloom - Laravel Version"
echo "=================================================="

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.1+ first."
    exit 1
fi

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    exit 1
fi

# Check if MySQL is installed
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL is not installed. Please install MySQL first."
    echo "   You can continue with the setup, but you'll need to configure the database manually."
fi

echo "✅ Prerequisites check completed"

# Install dependencies
echo ""
echo "📦 Installing PHP dependencies..."
composer install

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "⚙️  Creating .env file..."
    cp .env.example .env
    echo "📝 Please edit .env with your database credentials"
else
    echo "✅ .env file already exists"
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Database setup
echo "🗄️  Setting up database..."
echo "📝 Please ensure your MySQL database is running and update the database credentials in .env"
echo "   Then run: php artisan migrate --seed"

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo ""
echo "✅ Setup completed!"
echo ""
echo "📋 Next Steps:"
echo "1. Configure your database in .env file"
echo "2. Run database migrations: php artisan migrate --seed"
echo "3. Start the development server: php artisan serve"
echo ""
echo "🌐 Your application will be available at:"
echo "   http://localhost:8000"
echo ""
echo "🔐 Default Login Credentials:"
echo "   Admin: admin@glowlinearthybloom.com / admin123"
echo "   User: user@example.com / user123"
echo ""
echo "🎉 Happy coding!" 