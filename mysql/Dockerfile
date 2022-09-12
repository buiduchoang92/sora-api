FROM mysql:5.7

# ENV MYSQL_ROOT_PASSWORD mysql12345
# ENV MYSQL_DATABASE sora_api
# ENV MYSQL_USER root  
# ENV MYSQL_PASSWORD mysql12345
# ENV COMPOSE_CONVERT_WINDOWS_PATHS 1
# RUN -v $PWD/mysql/sora_api.sql:/docker-entrypoint-initdb.d/ mysql:5.7

# COPY sora_api.sql /docker-entrypoint-initdb.d/

# RUN chmod a+x /docker-entrypoint-initdb.d/sora_api.sql && chown root:root     /docker-entrypoint-initdb.d/sora_api.sql

EXPOSE 3306
CMD ["mysqld"]