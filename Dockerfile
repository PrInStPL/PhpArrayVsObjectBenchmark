ARG PHP_VER

FROM php:${PHP_VER}-fpm-alpine
LABEL authors="PrInSt.pl"

ENV PS0="\u@\h:\w\\$ "
ENV PS1="\u:\w\\$ "

ARG PROJECT_DIR
ENV PROJECT_DIR ${PROJECT_DIR:-/opt/project}

RUN apk update --force-refresh \
    && apk upgrade --force-refresh --no-cache \
    && apk add nano util-linux-misc

RUN mkdir ${PROJECT_DIR}

WORKDIR ${PROJECT_DIR}
