# vim: set noexpandtab
all:
	./generate-doc

install:
	cp -rv man/* /usr/share/man/
	cp -v bin/jaml /usr/bin
