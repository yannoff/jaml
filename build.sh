#!/bin/bash

BOXBIN=`dirname $0`/box
BINDIR=bin

oldversion=`${BINDIR}/jaml --version --raw`
printf "Current version: \033[01m%s\033[00m\n" ${oldversion}

# Version number is required to run a build
if [ -z "$1" ]
then
    printf "Version number is required. Exiting\n"
    exit 1
fi

version=$1
shift 1

# The new build version must be different from the current one
if [ "${oldversion}" = "${version}" ]
then
    printf "Cannot use the same version number for 2 different builds. Exiting\n"
    exit 1
fi


printf "Building version: \033[01m%s\033[00m\n" ${version}

# Make sure vendor dir is up to date with composer-lock, and remove
# dev dependencies to be sure they won't be included in the PHAR
rm -rf vendor/*
offenbach install --no-dev --ignore-platform-reqs --no-interaction
offenbach dump-autoload --optimize --ignore-platform-reqs --no-interaction

# Update version number
sed -i "s/@@version@@/${version}/" ${BINDIR}/app.php
sed "s/@@version@@/${version}/" README.tpl > README.md

# Launch box build command
php -d phar.readonly=0 $BOXBIN build "$@"

# Post-build processing: 
# - remove phar extension from binary name
# - generate MD5 & SHA384 signature files
cd $BINDIR
mv -v jaml.phar jaml
php -r "echo hash('md5', file_get_contents('jaml'));" > jaml.md5
php -r "echo hash('sha384', file_get_contents('jaml'));" > jaml.sha384
cd -

# Restore dev dependencies into the project
offenbach install

# Restore version variable in application files
git checkout -- ${BINDIR}/app.php

# Run smoke test
${BINDIR}/jaml --version
