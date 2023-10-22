FROM debian:bullseye

RUN apt-get update && apt-get upgrade -y

RUN apt-get install adminer -y

WORKDIR /usr/share/adminer/

RUN mv adminer.php index.php

CMD ["php", "-S" ,"0.0.0.0:8080"]