TOOLS_HOME ?= ./
BIN_SASS ?= node-sass

.PHONY: install-phinx phinx

phinx:
	./phinx.phar status

install-phinx:
	curl -o phinx.phar -# -L https://github.com/cakephp/phinx/releases/download/0.12.6/phinx.phar
	chmod +x ./phinx.phar

compile-css:
	$(BIN_SASS) --source-map true --output-style compressed vendor/scss/sb-admin-2.scss public/css/sb-admin-2.min.css
	$(BIN_SASS) --source-map true vendor/scss/sb-admin-2.scss public/css/sb-admin-2.css
