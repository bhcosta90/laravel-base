#!/bin/zsh
# Check if sail is enabled
sailEnabled=$(grep -i '^SAIL_ENABLED' .env | cut -d '=' -f2 | tr '[:upper:]' '[:lower:]')
sailCommand=$([[ "$sailEnabled" = "true" ]] && echo "./vendor/bin/sail" || echo "")
echo "Running Stan"
if [ -n "$sailCommand" ]; then
    $sailCommand ./vendor/bin/rector process --dry-run
else
    ./vendor/bin/rector process --dry-run
fi
STATUS_CODE=$?
if [ $STATUS_CODE -ne 0 ]; then
    echo "Rector failed"
    exit 1
else
    echo "Rector passed"
fi
