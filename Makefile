.PHONY: all
all:
	$(MAKE) -C data
	$(MAKE) -C public

.PHONY: test
test: vendor/bin/phpunit
	php vendor/bin/phpunit

.PHONY: package
package: talking-clock.de.co.ua.tar.gz

talking-clock.de.co.ua.tar.gz:
	tar zcf $@ src/ data/*.wav public/*.*

.PHONY: cs-check
cs-check: vendor/bin/php-cs-fixer
	php vendor/bin/php-cs-fixer fix --dry-run --diff .

.PHONY: cs-fix
cs-fix: vendor/bin/php-cs-fixer
	php vendor/bin/php-cs-fixer fix --diff .

vendor/bin/phpunit vendor/bin/php-cs-fixer: composer.phar
	php composer.phar install

composer.phar:
	wget https://getcomposer.org/download/latest-stable/composer.phar
