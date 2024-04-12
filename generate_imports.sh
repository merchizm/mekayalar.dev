#!/bin/bash

if [ "$#" -ne 1 ]; then
    echo "Usage: $0 <directory>"
    exit 1
fi

directory=$1
output_file="importSvgs.js"

if [ ! -d "$directory" ]; then
    echo "Directory does not exist: $directory"
    exit 1
fi

echo "" > $output_file

find "$directory" -type f -name '*.svg' | while read file; do
    relative_path="${file#$directory/}"

    filename=$(basename "$relative_path" .svg)
     clean_filename="${filename//-/}"

    import_statement="import ${clean_filename}Svg from '../../icons/${relative_path}?url';"
    echo "$import_statement" >> $output_file
done

echo "Generated imports in $output_file"
