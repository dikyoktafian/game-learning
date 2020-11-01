# Game Education

### Platform Education Game-Based for Web and PWA

## Installation

Copy, paste and hit the Enter key in console line by line

* Using Git

        git clone https://github.com/dikyoktafian/game-learning.git

        cd game-learning

        composer install

        cp .env.example .env

Make sure your server, create "game" database, edit .env using your favorite editor, 
for example using nano editor, run this in console

    sudo nano .env

then

    php artisan key:generate

then

    php artisan migrate --seed

    php artisan storage:link

now get its all on your favorite browser

    http://localhost/game-learning/public

    and

    http://localhost/game-learning/public/admin

Default student are

    - student@app.com

    with default password is password

Default admin are

    - superadminstrator@app.com
    - teacher@app.com

    with default password is password