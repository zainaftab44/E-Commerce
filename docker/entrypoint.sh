#!/bin/bash

# Start Apache in the background
apache2-foreground &

# Wait for MySQL to be available
until mysql -h db -u user -ppassword -e "show databases;" > /dev/null 2>&1; do
  echo "Waiting for MySQL..."
  sleep 3
done

# Run pending migrations
for file in /var/www/html/migrations/pending/*.sql; do
  if [ -f "$file" ]; then
    echo "Running migration $file"
    mysql -h db -u user -ppassword app < "$file" && \
    mv "$file" /var/www/html/migrations/executed/
  fi
done

# Keep container running
tail -f /dev/null
