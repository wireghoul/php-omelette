#!/bin/sh
cat "$1" | sed -e's@/\*@@g' -e's@\*/@@g' | grep -v '^ *$'
