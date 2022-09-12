[bash] #!/bin/bash
#Do something before run docker
docker-compose config
docker-compose up -d

echo ‘Wating a monment to flyway migrate your database!’
sleep 20

docker-compose up flyway

[/bash]