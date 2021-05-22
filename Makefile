TOOLS_HOME ?= ./

.PHONY: install-phinx phinx

phinx:
	./phinx.phar status

install-phinx:
	curl -o phinx.phar -# -L https://github.com/cakephp/phinx/releases/download/0.12.6/phinx.phar
	chmod +x ./phinx.phar
