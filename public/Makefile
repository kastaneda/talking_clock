ASSETS := favicon.ico apple-touch-icon.png

.PHONY: all
all: $(ASSETS)

favicon.ico: favicon.svg
	rsvg-convert $< -w 32 -h 32 | convert - gif:- | convert - $@

apple-touch-icon.png: favicon.svg
	rsvg-convert $< -w 180 -h 180 \
		| convert - -background "#fff" -alpha remove -alpha off $@
	optipng $@
	advpng -z4 $@
