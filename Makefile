.PHONY: test
test: vendor/bin/phpunit
	php vendor/bin/phpunit

vendor/bin/phpunit: composer.phar
	php composer.phar install

composer.phar:
	wget https://getcomposer.org/download/latest-stable/composer.phar
