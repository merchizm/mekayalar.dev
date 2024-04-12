#!/bin/bash

directory="$(pwd)/resources/js/icons/dark"

if [ ! -d "$directory" ]; then
    echo "Directory does not exist: $directory"
    exit 1
fi

output_file="colored.html"

echo "" > $output_file

find "$directory" -type f -name '*.svg' | while read file; do
    relative_path="${file#$directory/}"
    filename=$(basename "$relative_path" .svg)
    name_of_svg="${filename%%-*}"

    import_statement="<div class="tech-card"><img :src=\"isDark ? ${name_of_svg}LightSvg : ${name_of_svg}DarkSvg\" alt=\"${name_of_svg}\"><div>${name_of_svg} <span>{{ new Date().getFullYear() - 2000 }} yıllık deneyim</span></div></div>"
    echo "$import_statement" >> $output_file
done

echo "Generated $output_file"
