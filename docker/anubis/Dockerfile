# syntax=docker/dockerfile:1
#
# Anubis (Techaro) with SMTEK branding.
#
# The open source edition of Anubis has no runtime theming (OVERLAY_FOLDER,
# custom CSS and custom images are BotStopper-only features), so the branding is
# applied at build time on top of the official "pre-baked" release tarball,
# following https://anubis.techaro.lol/docs/developer/building-anubis
#
# Only data files are touched (CSS appended to Xess, new static images, Spanish
# strings). Templates, JavaScript and the challenge logic are the upstream ones.
#
# To upgrade: change ANUBIS_VERSION and ANUBIS_SHA256 (the "digest" of
# anubis-src-vendor-npm-<version>.tar.gz on the GitHub release page) and bump
# BRANDING_REVISION when only the branding changes (it busts browser caches).

ARG ANUBIS_VERSION=1.28.2
ARG GO_VERSION=1.27.3

FROM alpine:3.22 AS branding
RUN apk add --no-cache imagemagick imagemagick-jpeg imagemagick-webp
WORKDIR /out
# Build context is the repository root: the existing SMTEK images are reused
# instead of duplicated in the repo.
COPY src/public/assets/img/smteklogo.png ./smtek-logo.png
COPY src/public/assets/img/heros/tcnos.jpg /tmp/hero.jpg
RUN magick /tmp/hero.jpg -auto-orient -strip -resize '1600x1600>' -quality 62 ./smtek-hero.webp

FROM golang:${GO_VERSION}-alpine AS build
ARG ANUBIS_VERSION
ARG ANUBIS_SHA256=524faa5da63fe45ccc8f070cd8bb12c2ac98599ed4832a17b42c2d09c19c66c2
ARG BRANDING_REVISION=smtek.1

RUN apk add --no-cache curl jq
WORKDIR /src

RUN curl -fsSL -o /tmp/anubis.tar.gz \
        "https://github.com/TecharoHQ/anubis/releases/download/v${ANUBIS_VERSION}/anubis-src-vendor-npm-${ANUBIS_VERSION}.tar.gz" \
    && echo "${ANUBIS_SHA256}  /tmp/anubis.tar.gz" | sha256sum -c - \
    && tar -xzf /tmp/anubis.tar.gz --strip-components=1 \
    && rm /tmp/anubis.tar.gz

COPY docker/anubis/branding/smtek.css docker/anubis/branding/es.json /tmp/branding/
COPY --from=branding /out/ ./xess/static/smtek/

# Xess serves xess.min.css in release builds; xess.css is patched too for parity.
# Spanish strings exist twice: the Go bundle (server-side) and web/static (JS).
RUN cat /tmp/branding/smtek.css >> xess/xess.min.css \
    && cat /tmp/branding/smtek.css >> xess/xess.css \
    && for f in lib/localization/locales/es.json web/static/locales/es.json; do \
           jq -s '.[0] * .[1]' "$f" /tmp/branding/es.json > /tmp/es.json && mv /tmp/es.json "$f"; \
       done

RUN CGO_ENABLED=0 go build -trimpath -o /out/anubis \
        -ldflags "-s -w -X 'github.com/TecharoHQ/anubis.Version=v${ANUBIS_VERSION}-${BRANDING_REVISION}'" \
        ./cmd/anubis \
    && /out/anubis --version

FROM gcr.io/distroless/static-debian12:nonroot
COPY --from=build /out/anubis /usr/local/bin/anubis
# Baked in so that a policy change produces a new image and Compose recreates
# the container on deploy. Development mounts docker/anubis/policy over it.
COPY docker/anubis/policy/botPolicy.yaml /data/cfg/botPolicy.yaml
ENV POLICY_FNAME=/data/cfg/botPolicy.yaml
USER nonroot
EXPOSE 8923 9090
ENTRYPOINT ["/usr/local/bin/anubis"]
