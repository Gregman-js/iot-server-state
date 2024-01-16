.PHONY: *

php-cs:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --allow-risky=yes

phpstan:
	tools/phpstan/vendor/bin/phpstan analyse --memory-limit=-1

deptrac:
	tools/deptrac/vendor/bin/deptrac

rector:
	tools/rector/vendor/bin/rector process

shell:
	docker exec -it php /bin/sh
