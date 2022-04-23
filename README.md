```
              ______     ____    _             _______         __
             /_  __/__ _/ / /__ (_)__  ___ _  / ___/ /__  ____/ /__
              / / / _ `/ /  '_// / _ \/ _ `/ / /__/ / _ \/ __/  '_/
             /_/  \_,_/_/_/\_\/_/_//_/\_, /  \___/_/\___/\__/_/\_\
                                     /___/
```

This is simple talking clock, it can say current time in Ukrainian.
Text below in Ukrainian.

# Годинник, що розмовляє

Нічого особливого, просто проект по приколу на один вечір :)

## Як встановити

Зробіть `git clone`, зайдіть в каталог проекту та запустіть `make`.

### Системні вимоги

 * GNU Make
 * PHP 7.4
 * ffmpeg
 * aplay

Для Debian: `sudo apt install make php8.0-cli ffmpeg alsa-utils`

## Як запустити

Просто запустіть `./demo.php` (або `php demo.php`). Має вийти щось таке:

```
gray@carmilhan:~/dev/talking_clock$ ./demo.php
десята година вісім хвилин
aplay -q data/ordinal_10.wav data/hour.wav data/cardinal_8.wav data/minutes.wav

gray@carmilhan:~/dev/talking_clock$ ./demo.php
десята година дев'ять хвилин
aplay -q data/ordinal_10.wav data/hour.wav data/cardinal_9.wav data/minutes.wav
```

## Веб-інтерфейс

Ще простіше зайти на <https://talking-clock.de.co.ua> і послухати.

Для роботи веб-інтерфейса додатково потрібен SoX.
Встановлення: `sudo apt install sox`

## Як це працює

Спочатку будується речення українською, потім запускається програвач
`aplay` з аргументами, що відповідають окремим словам.

Я тут якось надиктував купу числівників у файл `data/clock.mp3`.
За допомогою `ffmpeg` цей один великий файл ріжеться на багато
окремих маленьких wav-файлів, кожен з яких містить одне слово.

## Плани на майбутнє

 * Додати назви місяців та днів тижнів
 * Додати можливість озвучити інформацію про погоду
