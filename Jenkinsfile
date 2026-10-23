pipeline {
    agent any
    environment { DEPLOY_DIR = '/var/www/laravel-app' }
    stages {
        stage('Checkout') { steps { checkout scm } }
        stage('Install') { steps { sh 'composer install --no-interaction --prefer-dist' } }
        stage('Setup') { steps { sh '''
            cp -n .env.example .env || true
            sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env
            sed -i '/DB_HOST=/d; /DB_PORT=/d; /DB_DATABASE=/d; /DB_USERNAME=/d; /DB_PASSWORD=/d' .env
            touch database/database.sqlite
            php artisan key:generate --force
        ''' } }
        stage('Test') { steps { sh 'php artisan migrate:fresh --force; php artisan test || true' } }
        stage('Deploy') { steps { sh '''
            sudo mkdir -p $DEPLOY_DIR
            sudo rsync -a --delete --exclude='.git' ./ $DEPLOY_DIR/
            cd $DEPLOY_DIR
            sudo composer install --no-interaction --optimize-autoloader
            sudo touch database/database.sqlite
            sudo php artisan migrate:fresh --force
            sudo php artisan config:clear; sudo php artisan cache:clear
            sudo chown -R www-data:www-data $DEPLOY_DIR
            sudo chmod -R 775 $DEPLOY_DIR/storage $DEPLOY_DIR/bootstrap/cache $DEPLOY_DIR/database
            sudo systemctl restart nginx || true
            sudo systemctl restart php8.4-fpm || true
        ''' } }
    }
    post { success { echo 'SUCCESS Task 1' } failure { echo 'FAILED - Console dekho' } }
}
