# Use official PHP image with Apache built-in
FROM php:8.2-apache

# Copy all project files into the container's web root
COPY . /var/www/html/

# Ensure proper permissions for Apache and the data file
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Render automatically assigns a dynamic port via the PORT environment variable
# We configure Apache to listen on that dynamic port
ENV PORT=10000
RUN sed -i -e 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf \
    && sed -i -e 's/80/${PORT}/g' /etc/apache2/ports.conf

# Expose the port
EXPOSE 10000
