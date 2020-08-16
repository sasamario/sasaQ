FROM php:7.2-fpm

# composerをインストール
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
# apt-getコマンドでgit,zip,unzip,vimをインストール
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim

#docker-php-ext-install：コンテナイメージに事前に圧縮されて入っている拡張機能を解凍・インストールするコマンド
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql

# WORKDIRはRUNなどの命令を実行するときの、作業ディレクトリを指定
WORKDIR /var/www/html
